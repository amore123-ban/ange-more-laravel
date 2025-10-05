<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture #{{ $sale->id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-light: #3b82f6;
            --primary-dark: #1d4ed8;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --soft-bg: #f8fafc;
            --soft-border: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #6b7280;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: var(--text-primary);
            line-height: 1.6;
            margin: 0;
            padding: 20px 0;
        }

        /* Système de grille CSS natif */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }

        .col {
            flex: 1;
            padding: 0 15px;
        }

        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            padding: 0 15px;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 15px;
        }

        .col-md-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
            padding: 0 15px;
        }

        /* Classes utilitaires */
        .align-items-center {
            align-items: center;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .text-md-end {
            text-align: right;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        .text-danger {
            color: var(--danger) !important;
        }

        .fw-bold {
            font-weight: 700 !important;
        }

        .me-2 {
            margin-right: 0.5rem;
        }

        .mb-1 {
            margin-bottom: 0.25rem;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        /* Icônes CSS pures */
        .icon {
            display: inline-block;
            width: 1em;
            height: 1em;
            text-align: center;
            font-style: normal;
        }

        .icon-store::before { content: "🏪"; }
        .icon-map::before { content: "📍"; }
        .icon-phone::before { content: "📞"; }
        .icon-calendar::before { content: "📅"; }
        .icon-credit-card::before { content: "💳"; }
        .icon-wallet::before { content: "💰"; }
        .icon-info::before { content: "ℹ️"; }
        .icon-user::before { content: "👤"; }
        .icon-check::before { content: "✅"; }
        .icon-clock::before { content: "⏰"; }
        .icon-times::before { content: "❌"; }
        .icon-heart::before { content: "❤️"; }
        .icon-print::before { content: "🖨️"; }

        .invoice-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .invoice-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(37, 99, 235, 0.1);
            border: 1px solid var(--soft-border);
            overflow: hidden;
            animation: slideInUp 0.8s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .invoice-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            padding: 3rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .invoice-header::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .invoice-header::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .company-logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .company-name {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .company-details {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.8;
        }

        .company-details div {
            margin-bottom: 0.25rem;
        }

        .invoice-body {
            padding: 2.5rem;
        }

        .invoice-meta {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.03), rgba(59, 130, 246, 0.03));
            border: 2px solid rgba(37, 99, 235, 0.1);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .invoice-meta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
            border-radius: 16px 16px 0 0;
        }

        .invoice-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .meta-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
        }

        .meta-content h6 {
            margin: 0;
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-content p {
            margin: 0;
            font-weight: 500;
            color: var(--text-secondary);
        }

        .client-section {
            background: rgba(16, 185, 129, 0.05);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .client-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            color: var(--success);
            font-weight: 600;
        }

        .client-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .invoice-table-container {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--soft-border);
            overflow: hidden;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .table-modern {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            border: none;
        }

        .table-modern thead {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        }

        .table-modern thead th {
            border: none;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            color: white;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.5px;
        }

        .table-modern tbody td {
            border: none;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        .table-modern tbody tr {
            transition: all 0.3s ease;
        }

        .table-modern tbody tr:hover {
            background-color: rgba(37, 99, 235, 0.02);
            transform: scale(1.001);
        }

        .product-name {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 1rem;
        }

        .quantity-badge {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary-color);
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            display: inline-block;
            min-width: 50px;
        }

        .price-cell {
            font-weight: 600;
            color: var(--text-primary);
        }

        .total-cell {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .totals-card {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border: 2px solid var(--soft-border);
            border-radius: 16px;
            padding: 2rem;
            margin-left: auto;
            max-width: 400px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--soft-border);
        }

        .total-row:last-child {
            border-bottom: none;
            padding-top: 1.5rem;
            margin-top: 1rem;
            border-top: 3px solid var(--primary-color);
        }

        .total-final {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color);
        }

        .change-section {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1rem;
            text-align: center;
        }

        .change-amount {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--warning);
        }

        .payment-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .status-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .footer-section {
            background: var(--soft-bg);
            border-top: 1px solid var(--soft-border);
            padding: 2rem;
            text-align: center;
        }

        .footer-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .footer-text {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .print-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 1.25rem;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
            transition: all 0.3s ease;
            z-index: 1000;
            cursor: pointer;
        }

        .print-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(37, 99, 235, 0.4);
            color: white;
        }

        .header-content {
            font-size: 1.5rem; 
            font-weight: 600; 
            opacity: 0.9;
        }

        @media print {
            body {
                background: white;
            }
            
            .invoice-container {
                max-width: none;
                margin: 0;
                padding: 0;
            }
            
            .print-button {
                display: none;
            }
            
            .invoice-card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }

        @media (max-width: 768px) {
            .invoice-container {
                padding: 0 10px;
            }
            
            .invoice-header {
                padding: 2rem 1.5rem;
            }
            
            .company-name {
                font-size: 2rem;
            }
            
            .invoice-body {
                padding: 1.5rem;
            }
            
            .meta-grid {
                grid-template-columns: 1fr;
            }
            
            .totals-card {
                max-width: none;
                margin: 0;
            }
            
            .print-button {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 1rem;
            }

            /* Responsive columns sur mobile */
            .col-md-4,
            .col-md-6,
            .col-md-8 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .text-md-end {
                text-align: left;
            }

            .row {
                margin: 0;
            }

            .col-md-4,
            .col-md-6,
            .col-md-8 {
                padding: 0;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-card">
            <!-- Header avec informations de l'entreprise -->
            <div class="invoice-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="company-logo">
                            <span class="icon icon-store"></span>
                        </div>
                        <h1 class="company-name">{{ $sale->shop->nom ?? 'Ma Boutique' }}</h1>
                        <div class="company-details">
                            @if($sale->shop->adresse ?? '')
                            <div><span class="icon icon-map me-2"></span>{{ $sale->shop->adresse }}</div>
                            @endif
                            @if($sale->shop->telephone ?? '')
                            <div><span class="icon icon-phone me-2"></span>{{ $sale->shop->telephone }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="invoice-number">FACTURE</div>
                        <div class="header-content">
                            #{{ $sale->id }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Corps de la facture -->
            <div class="invoice-body">
                <!-- Informations de la facture -->
                <div class="invoice-meta">
                    <div class="meta-grid">
                        <div class="meta-item">
                            <div class="meta-icon">
                                <span class="icon icon-calendar"></span>
                            </div>
                            <div class="meta-content">
                                <h6>Date d'émission</h6>
                                <p>{{ $sale->created_at->format('d/m/Y à H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="meta-item">
                            <div class="meta-icon">
                                <span class="icon icon-credit-card"></span>
                            </div>
                            <div class="meta-content">
                                <h6>Mode de paiement</h6>
                                <p>{{ $sale->mode_paiement }}</p>
                            </div>
                        </div>
                        
                        <div class="meta-item">
                            <div class="meta-icon">
                                <span class="icon icon-wallet"></span>
                            </div>
                            <div class="meta-content">
                                <h6>Montant reçu</h6>
                                <p>{{ number_format($sale->montant_recu, 0, ',', ' ') }} FCFA</p>
                            </div>
                        </div>
                        
                        <div class="meta-item">
                            <div class="meta-icon">
                                <span class="icon icon-info"></span>
                            </div>
                            <div class="meta-content">
                                <h6>Statut</h6>
                                <div>
                                    @php
                                        $statusClass = match(strtolower($sale->status)) {
                                            'payée', 'payé', 'paid', 'terminé', 'terminée' => 'status-success',
                                            'en attente', 'pending' => 'status-warning',
                                            'annulée', 'cancelled' => 'status-danger',
                                            default => 'status-warning'
                                        };
                                        $statusIcon = match(strtolower($sale->status)) {
                                            'payée', 'payé', 'paid', 'terminé', 'terminée' => 'icon-check',
                                            'en attente', 'pending' => 'icon-clock',
                                            'annulée', 'cancelled' => 'icon-times',
                                            default => 'icon-clock'
                                        };
                                    @endphp
                                    <span class="payment-status {{ $statusClass }}">
                                        <span class="icon {{ $statusIcon }}"></span>
                                        {{ ucfirst($sale->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations client -->
                <div class="client-section">
                    <div class="client-title">
                        <span class="icon icon-user"></span>
                        <span>Informations Client</span>
                    </div>
                    <div class="client-name">{{ $sale->client_name }}</div>
                    <div class="text-muted">Client #{{ $sale->id }}</div>
                </div>

                <!-- Tableau des articles -->
                <div class="invoice-table-container">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 45%;">Produit</th>
                                <th style="width: 15%;" class="text-center">Quantité</th>
                                <th style="width: 20%;" class="text-end">Prix unitaire</th>
                                <th style="width: 20%;" class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale->items as $item)
                            <tr>
                                <td>
                                    <div class="product-name">{{ $item->product->nom }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="quantity-badge">{{ $item->quantite }}</span>
                                </td>
                                <td class="text-end price-cell">
                                    {{ number_format($item->prix, 0, ',', ' ') }} FCFA
                                </td>
                                <td class="text-end total-cell">
                                    {{ number_format($item->prix * $item->quantite, 0, ',', ' ') }} FCFA
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Section des totaux -->
                <div class="totals-card">
                    <div class="total-row">
                        <span>Sous-total</span>
                        <span class="fw-bold">{{ number_format($sale->items->sum(fn($i) => $i->prix * $i->quantite), 0, ',', ' ') }} FCFA</span>
                    </div>
                    <div class="total-row total-final">
                        <span>Total TTC</span>
                        <span>{{ number_format($sale->total, 0, ',', ' ') }} FCFA</span>
                    </div>
                </div>

                <!-- Monnaie rendue si applicable -->
                @if($sale->montant_recu > $sale->total)
                <div class="change-section">
                    <div><strong>Monnaie rendue</strong></div>
                    <div class="change-amount">{{ number_format($sale->montant_recu - $sale->total, 0, ',', ' ') }} FCFA</div>
                </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="footer-section">
                <div class="footer-title">
                    <span class="icon icon-heart text-danger me-2"></span>
                    Merci pour votre achat !
                </div>
                <div class="footer-text">
                    Cette facture a été générée automatiquement le {{ now()->format('d/m/Y à H:i') }}<br>
                    Pour toute question, n'hésitez pas à nous contacter.
                </div>
            </div>
        </div>
    </div>

    <!-- Bouton d'impression flottant -->
    <button class="print-button" onclick="window.print()" title="Imprimer la facture">
        <span class="icon icon-print"></span>
    </button>
</body>
</html>
