<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture #{{ $sale->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
        }
        .company-info {
            margin-bottom: 30px;
        }
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .invoice-details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #2563eb;
            color: white;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
        }
        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #2563eb;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $sale->shop->nom ?? 'Boutique' }}</h1>
        <p>{{ $sale->shop->adresse ?? '' }}</p>
        <p>Tél: {{ $sale->shop->telephone ?? '' }}</p>
    </div>

    <div class="invoice-info">
        <div class="company-info">
            <h3>Facture #{{ $sale->id }}</h3>
            <p><strong>Date:</strong> {{ $sale->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Client:</strong> {{ $sale->client_name }}</p>
        </div>
        
        <div class="invoice-details">
            <p><strong>Mode de paiement:</strong> {{ $sale->mode_paiement }}</p>
            <p><strong>Montant reçu:</strong> {{ number_format($sale->montant_recu, 0, ',', ' ') }} FCFA</p>
            <p><strong>Statut:</strong> {{ $sale->status }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->items as $item)
            <tr>
                <td>{{ $item->product->nom }}</td>
                <td>{{ $item->quantite }}</td>
                <td>{{ number_format($item->prix, 0, ',', ' ') }} FCFA</td>
                <td>{{ number_format($item->prix * $item->quantite, 0, ',', ' ') }} FCFA</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <p><strong>Total: <span class="total-amount">{{ number_format($sale->total, 0, ',', ' ') }} FCFA</span></strong></p>
        @if($sale->montant_recu > $sale->total)
        <p>Monnaie: {{ number_format($sale->montant_recu - $sale->total, 0, ',', ' ') }} FCFA</p>
        @endif
    </div>

    <div class="footer">
        <p>Merci pour votre achat !</p>
        <p>Cette facture a été générée automatiquement le {{ now()->format('d/m/Y à H:i') }}</p>
    </div>
</body>
</html>