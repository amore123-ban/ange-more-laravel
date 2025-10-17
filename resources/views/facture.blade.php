<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture #{{ $sale->id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
    
<style>
        :root {
            --primary-color: #2563eb;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-light: #e2e8f0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            line-height: 1.5;
            margin: 0;
            padding: 20px;
            background: #f8fafc;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--primary-color);
        }

        .company-name {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .invoice-number {
            text-align: right;
        }

        .invoice-number h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            color: var(--text-primary);
        }

        .invoice-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .info-section h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 0.5rem 0;
        }

        .info-section p {
            margin: 0;
            color: var(--text-secondary);
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        .invoice-table th {
            background: var(--primary-color);
            color: white;
            padding: 0.75rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .invoice-table th:last-child,
        .invoice-table td:last-child {
            text-align: right;
        }

        .invoice-table td {
            padding: 0.75rem;
            border-bottom: 1px solid var(--border-light);
        }

        .product-name {
            font-weight: 500;
        }

        .product-details {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-top: 0.25rem;
        }

        .product-badge {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary-color);
            padding: 0.125rem 0.375rem;
            border-radius: 3px;
            font-size: 0.7rem;
            font-weight: 500;
            margin-right: 0.25rem;
        }

        .invoice-footer {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 2rem;
            align-items: start;
        }

        .totals {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 6px;
            max-width: 300px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .total-row:last-child {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
            border-top: 2px solid var(--border-light);
            padding-top: 0.5rem;
            margin-top: 1rem;
        }

        .qr-section {
            text-align: center;
            padding: 1rem;
            border: 2px solid var(--border-light);
            border-radius: 6px;
            max-width: 200px;
        }

        .qr-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
        }

        .qr-canvas {
            border-radius: 4px;
        }

        .qr-text {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: 0.75rem;
        }

        .print-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 1.25rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            transition: transform 0.2s;
        }

        .print-button:hover {
            transform: translateY(-2px);
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .invoice-container {
                box-shadow: none;
                padding: 0;
                max-width: none;
            }
            
            .print-button {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .invoice-header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .invoice-info {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .invoice-footer {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .qr-section {
                max-width: none;
            }

            .invoice-table th,
            .invoice-table td {
                padding: 0.5rem;
                font-size: 0.875rem;
            }
        }
        .qr-image {
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .qr-image:hover {
            transform: scale(1.05);
        }

        .qr-error {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 120px;
            height: 120px;
            background: #f8fafc;
            border: 2px dashed #e2e8f0;
            border-radius: 4px;
            margin: 0 auto;
        }

    @media print {
        .qr-image {
            box-shadow: none;
        }
    }
</style>
</head>
<body>
    <div class="invoice-container">
        <!-- En-tête simple -->
        <div class="invoice-header">
           <div class="company">
                <div class="company-name">{{ $sale->shop->nom ?? 'Ma Boutique' }}</div>
                <div class="company-details">
                    @if($sale->shop->adresse ?? '')
                    <div><span class="icon icon-map me-2"></span>{{ $sale->shop->adresse }}</div>
                    @endif
                    @if($sale->shop->telephone ?? '')
                    <div><span class="icon icon-phone me-2"></span>{{ $sale->shop->telephone }}</div>
                    @endif
                </div>
           </div>
            <div class="invoice-number">
            </div>
        </div>

        <!-- Informations essentielles -->
        <div class="invoice-info">
            <div class="info-section">
                <h3>Client</h3>
                <p>{{ $sale->client_name }}</p>
            </div>
            <div class="info-section">
                <h3>Date</h3>
                <p>{{ $sale->created_at->format('d/m/Y à H:i') }}</p>
                <p style="margin-top: 0.25rem;">{{ $sale->mode_paiement }}</p>
            </div>
        </div>

        <!-- Tableau des articles -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Qté</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($sale->items as $item)
                <tr>
                    <td>
                        <div class="product-name">{{ $item->product->nom ?? 'Produit inconnu' }}</div>

                        @php
                            $detailsArray = $item->details->first()?->details ?? [];
                        @endphp

                        @if($detailsArray && count($detailsArray) > 0)
                            <div class="product-details">
                                @foreach($detailsArray as $key => $value)
                                    @if($value)
                                        <span class="product-badge">{{ ucfirst($key) }}: {{ $value }}</span>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </td>
                    <td>{{ $item->quantite }}</td>
                    <td>{{ number_format($item->prix, 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($item->prix * $item->quantite, 0, ',', ' ') }} FCFA</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer avec totaux et QR Code -->
        <div class="invoice-footer">
            <div class="totals">
                <div class="total-row">
                    <span>Sous-total:</span>
                    <span>{{ number_format($sale->items->sum(fn($i) => $i->prix * $i->quantite), 0, ',', ' ') }} FCFA</span>
                </div>
                <div class="total-row">
                    <span>Total:</span>
                    <span>{{ number_format($sale->total, 0, ',', ' ') }} FCFA</span>
                </div>
                @if($sale->montant_recu > $sale->total)
                <div class="total-row" style="font-size: 1rem; color: var(--text-secondary);">
                    <span>Monnaie rendue:</span>
                    <span>{{ number_format($sale->montant_recu - $sale->total, 0, ',', ' ') }} FCFA</span>
                </div>
                @endif
            </div>

            <!-- Section QR Code -->
            <div class="qr-section">
                <div class="qr-title">Accès en ligne</div>
                
                @if(isset($qrCodeBase64) && $qrCodeBase64)
                    <div class="qr-container">
                        <img src="{{ $qrCodeBase64 }}" 
                            alt="QR Code Facture #{{ $sale->id }}" 
                            class="qr-image"
                            style="width: 120px; height: 120px; border-radius: 4px;">
                    </div>
                @else
                    <div class="qr-error">
                        <div style="padding: 1rem; color: #6b7280; font-size: 0.875rem;">
                            ⚠️ QR Code indisponible
                        </div>
                    </div>
                @endif
                
                <div class="qr-text">Scannez pour voir la facture</div>
            </div>
        </div>
    </div>

    <!-- Bouton d'impression -->
    <button class="print-button" onclick="window.print()" title="Imprimer">
        🖨️
    </button>

    <script>
       
        // Raccourci clavier pour impression
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'p') {
                e.preventDefault();
                window.print();
            }
        });
    </script>
</body>
</html>
