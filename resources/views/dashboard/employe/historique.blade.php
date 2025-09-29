@extends('layouts.layout_employe')

@section('content')
<style>
    :root {
        --primary-blue: #2563eb;
        --primary-blue-dark: #1e40af;
        --primary-blue-light: #3b82f6;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --light-color: #f8f9fa;
        --dark-color: #212529;
        --success-color: #4cc9f0;
        --warning-color: #f72585;
        --sidebar-width: 280px;
        --header-height: 80px;
        --card-radius: 12px;
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .main-content {
        margin-left: var(--sidebar-width);
        padding: 16px;
        transition: all 0.3s ease;
    }

    .dashboard-header {
        background: white;
        border-radius: var(--card-radius);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        padding: 12px 20px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .welcome-text {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--primary-blue);
        margin: 0;
    }

    .employee-badge {
        background: linear-gradient(135deg, var(--success-color), #34d399);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 10px;
    }

    .stats-card {
        background: white;
        border-radius: var(--card-radius);
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
        transition: var(--transition);
        margin-bottom: 16px;
        position: relative;
        overflow: hidden;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-blue), var(--primary-blue-light));
    }

    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.12);
    }

    .stats-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .sales-table-container {
        background: white;
        border-radius: var(--card-radius);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    .table-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 2px solid #e2e8f0;
        padding: 1rem 1.5rem;
    }

    .table th {
        border: none;
        font-weight: 600;
        color: var(--dark-color);
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        padding: 1rem 1.5rem;
    }

    .table td {
        border: none;
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(37, 99, 235, 0.02);
        transform: scale(1.001);
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .status-completed {
        background: rgba(5, 150, 105, 0.1);
        color: #059669;
    }

    .client-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .client-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .sale-amount {
        font-weight: 700;
        color: var(--primary-blue);
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        margin: 0 0.125rem;
    }

    .action-btn:hover {
        transform: scale(1.1);
    }

    .btn-view { background: rgba(37, 99, 235, 0.1); color: var(--primary-blue); }

    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
            padding: 12px;
        }
    }
</style>

<div class="main-content">
    <div class="container-fluid">
        <div class="dashboard-header">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="fas fa-history text-primary fs-4"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold text-dark">Historique des Ventes <span class="employee-badge">EMPLOYÉ</span></h4>
                    <small class="text-muted">Consultez l'historique des ventes</small>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Total des Ventes</h6>
                            <h3 class="mb-0 fw-bold text-primary">{{ number_format($totalventes, 0, ',', ' ') }} FCFA</h3>
                        </div>
                        <div class="stats-icon bg-primary bg-opacity-10">
                            <i class="fas fa-euro-sign text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Nombre de Ventes</h6>
                            <h3 class="mb-0 fw-bold text-primary">{{ $nbventes }}</h3>
                        </div>
                        <div class="stats-icon bg-info bg-opacity-10">
                            <i class="fas fa-shopping-bag text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Vente Moyenne</h6>
                            <h3 class="mb-0 fw-bold text-primary">{{ $nbventes > 0 ? number_format($totalventes / $nbventes, 0, ',', ' ') : 0 }} FCFA</h3>
                        </div>
                        <div class="stats-icon bg-warning bg-opacity-10">
                            <i class="fas fa-calculator text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Boutique</h6>
                            <h3 class="mb-0 fw-bold text-success">{{ $shop->nom ?? 'N/A' }}</h3>
                        </div>
                        <div class="stats-icon bg-success bg-opacity-10">
                            <i class="fas fa-store text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Table -->
        <div class="sales-table-container">
            <div class="table-header">
                <h5 class="mb-0 fw-semibold">Historique des Ventes</h5>
            </div>
            
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Client</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <td>
                                <div class="fw-semibold text-primary">#{{ $sale->id }}</div>
                                <small class="text-muted">{{ $sale->mode_paiement }}</small>
                            </td>
                            <td>
                                <div class="client-info">
                                    <div class="client-avatar">
                                        {{ strtoupper(substr($sale->client_name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="fw-medium">{{ $sale->client_name }}</div>
                                        <small class="text-muted">Client</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="sale-amount">{{ number_format($sale->total, 0, ',', ' ') }} FCFA</div>
                            </td>
                            <td>
                                <span class="status-badge status-completed">
                                    <i class="fas fa-check-circle"></i>
                                    {{ $sale->status }}
                                </span>
                            </td>
                            <td>
                                <div class="text-muted">{{ $sale->created_at->format('d/m/Y H:i') }}</div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('facture.download', $sale->id) }}" class="action-btn btn-view" title="Télécharger facture">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-shopping-cart text-muted" style="font-size: 3rem;"></i>
                                <h4 class="mt-3 text-muted">Aucune vente trouvée</h4>
                                <p class="text-muted">Aucune vente n'a été enregistrée pour le moment.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection