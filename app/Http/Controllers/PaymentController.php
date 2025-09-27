<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NotchPay\NotchPay;
use NotchPay\Payment;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        NotchPay::setApiKey(env('NOTCHPAY_API_KEY'));
        try {
            $payment = Payment::initialize([
                'amount' => $request->amount,
                'email' => $request->email,
                'currency' => $request->currency ?? 'XAF',
                'callback' => route('payment.callback'),
                'reference' => uniqid('order_'),
                'description' => 'Paiement de commande Sellify',
                'channels' => ['mobile_money', 'card'],
                'metadata' => [
                    'user_id' => auth()->id(),
                    'order_id' => $request->order_id ?? null
                ]
            ]);
            
            // Redirect user to payment URL
            return redirect($payment->authorization_url);
        } catch(\NotchPay\Exceptions\ApiException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        NotchPay::setApiKey(env('NOTCHPAY_API_KEY'));
        $reference = $request->reference ?? $request->get('reference');
        try {
            $payment = Payment::verify($reference);
            if ($payment->transaction->status === 'complete') {
                // Payment was successful
                // TODO: Deliver product or service, save transaction, etc.
                return redirect()->route('commande.success')->with('success', 'Paiement effectué avec succès!');
            } else {
                // Payment is not yet completed or failed
                return redirect()->route('panier')->with('error', 'Le paiement a échoué ou est incomplet.');
            }
        } catch(\NotchPay\Exceptions\ApiException $e) {
            return redirect()->route('panier')->with('error', $e->getMessage());
        }
    }

    public function paiementSuccess(Request $request)
{
    $user = auth()->user();
    $panier = session()->get('panier', []);

    if (empty($panier)) {
        return redirect()->route('panier')->with('error', 'Votre panier est vide.');
    }

    // Créer la commande
    $commande = Commande::create([
        'user_id' => $user->id,
        'montant' => collect($panier)->sum(fn($item) => $item['prix'] * $item['quantite']),
        'statut' => 'payee',
    ]);

    // Ajouter les produits de la commande
    foreach ($panier as $produitId => $item) {
        CommandeProduit::create([
            'commande_id' => $commande->id,
            'produit_id' => $produitId,
            'quantite' => $item['quantite'],
            'prix' => $item['prix'],
        ]);
    }

    // Vider le panier
    session()->forget('panier');

    // Rediriger avec message animé
    return redirect()->route('commande.confirmation', $commande->id)
        ->with('success', 'Votre commande est en route 🚚');
}

}
