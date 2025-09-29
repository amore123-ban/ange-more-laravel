<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use NotchPay\NotchPay;

class CheckoutController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'amount' => 'required|numeric|min:100',
            'email' => 'required|email'
        ]);

        // initialiser notchPay
        NotchPay::setApiKey(env('NOTCHPAY_SECRET_KEY'));

        try {
            // Creer une transaction 
            $transaction = \NotchPay\Transaction::create([
                'amount' => $request->amount,
                'currency' => $request->currency ?? 'XAF',
                'email' => $request->email,
                'callback_url' => route('payment.callback'),
                'metadata' => [
                    'user_id' => auth()->id(),
                    'location' => $request->location ?? null,
                ],
            ]);

            // retoune les infos sur le frontend
            return response()->json([
                'reference' => $transaction['reference'],
                'authorization_url' => $transaction['authorization_url'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function callback(Request $request){

        // verifier l'evenement

        $data = $request->all();

        // verifier statuts et enregistrement dans la base de donnees

        if ($data['status'] === 'success'){
            return response()->json(['message' => 'Callback recu']);
        }

    }
}
