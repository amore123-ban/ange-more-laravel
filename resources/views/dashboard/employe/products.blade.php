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

    .product-card {
        background: white;
        border-radius: var(--card-radius);
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
        transition: var(--transition);
        margin-bottom: 16px;
    }

    .product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.12);
    }

    .product-image {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        margin-right: 1rem;
    }

    .stock-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .stock-good {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    .stock-low {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
    }

    .stock-out {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
    }

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
                    <i class="fas fa-box text-primary fs-4"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold text-dark">Gestion des Produits <span class="employee-badge">EMPLOYÉ</span></h4>
                    <small class="text-muted">Gérez les produits de votre boutique</small>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Total Produits</h6>
                            <h3 class="mb-0 fw-bold text-primary">{{ $nbprods }}</h3>
                        </div>
                        <div class="stats-icon bg-primary bg-opacity-10">
                            <i class="fas fa-boxes text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">En Stock</h6>
                            <h3 class="mb-0 fw-bold text-success">{{ $en_stock }}</h3>
                        </div>
                        <div class="stats-icon bg-success bg-opacity-10">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Stock Faible</h6>
                            <h3 class="mb-0 fw-bold text-warning">{{ $faible }}</h3>
                        </div>
                        <div class="stats-icon bg-warning bg-opacity-10">
                            <i class="fas fa-exclamation-triangle text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Rupture</h6>
                            <h3 class="mb-0 fw-bold text-danger">{{ $rupture }}</h3>
                        </div>
                        <div class="stats-icon bg-danger bg-opacity-10">
                            <i class="fas fa-times-circle text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products List -->
        <div class="row">
            @forelse($prods as $product)
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="product-card">
                        <div class="d-flex align-items-center">
                            <div class="product-image">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">{{ $product->nom }}</h6>
                                <p class="text-muted mb-2 small">{{ $product->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</span>
                                    <span class="stock-badge {{ $product->quantite > $product->quantite_min ? 'stock-good' : ($product->quantite > 0 ? 'stock-low' : 'stock-out') }}">
                                        {{ $product->quantite > $product->quantite_min ? 'En stock' : ($product->quantite > 0 ? 'Stock faible' : 'Rupture') }}
                                    </span>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">Quantité: <strong>{{ $product->quantite }}</strong> | Min: {{ $product->quantite_min }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-box-open text-muted" style="font-size: 3rem;"></i>
                        <h4 class="mt-3 text-muted">Aucun produit trouvé</h4>
                        <p class="text-muted">Aucun produit n'est disponible dans cette boutique.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection