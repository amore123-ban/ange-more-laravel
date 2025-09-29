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

    .sales-form {
        background: white;
        border-radius: var(--card-radius);
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.1);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .product-item {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        border: 1px solid #e2e8f0;
    }

    .product-select {
        width: 100%;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.5rem;
    }

    .quantity-input {
        width: 80px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.5rem;
        text-align: center;
    }

    .total-display {
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        color: white;
        padding: 1rem;
        border-radius: 8px;
        text-align: center;
        font-size: 1.2rem;
        font-weight: bold;
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
                    <i class="fas fa-shopping-cart text-primary fs-4"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold text-dark">Nouvelle Vente <span class="employee-badge">EMPLOYÉ</span></h4>
                    <small class="text-muted">Enregistrez une nouvelle vente</small>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Total Ventes</h6>
                            <h3 class="mb-0 fw-bold text-primary">{{ $nbventes }}</h3>
                        </div>
                        <div class="stats-icon bg-primary bg-opacity-10">
                            <i class="fas fa-shopping-bag text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Produits Disponibles</h6>
                            <h3 class="mb-0 fw-bold text-success">{{ $nbprods }}</h3>
                        </div>
                        <div class="stats-icon bg-success bg-opacity-10">
                            <i class="fas fa-boxes text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Boutique</h6>
                            <h3 class="mb-0 fw-bold text-info">{{ $shop->nom ?? 'N/A' }}</h3>
                        </div>
                        <div class="stats-icon bg-info bg-opacity-10">
                            <i class="fas fa-store text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Form -->
        <div class="sales-form">
            <form action="{{ route('sales.store') }}" method="POST" id="salesForm">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $shop->id ?? '' }}">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Nom du Client</label>
                            <input type="text" name="client_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Mode de Paiement</label>
                            <select name="mode_paiement" class="form-control" required>
                                <option value="">Sélectionner...</option>
                                <option value="Espèces">Espèces</option>
                                <option value="Mobile Money">Mobile Money</option>
                                <option value="Carte Bancaire">Carte Bancaire</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Montant Reçu</label>
                            <input type="number" name="montant_recu" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Total</label>
                            <input type="number" name="total" id="totalAmount" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <!-- Products Selection -->
                <div class="form-group">
                    <label class="form-label">Produits</label>
                    <div id="productsContainer">
                        <div class="product-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="products[]" class="product-select" required>
                                        <option value="">Sélectionner un produit...</option>
                                        @foreach($prods as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->prix }}">{{ $product->nom }} - {{ number_format($product->prix, 0, ',', ' ') }} FCFA</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="quantities[]" class="quantity-input" placeholder="Qté" min="1" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeProduct(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="addProduct()">
                        <i class="fas fa-plus"></i> Ajouter un produit
                    </button>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save"></i> Enregistrer la Vente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function addProduct() {
        const container = document.getElementById('productsContainer');
        const newProduct = document.createElement('div');
        newProduct.className = 'product-item';
        newProduct.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <select name="products[]" class="product-select" required>
                        <option value="">Sélectionner un produit...</option>
                        @foreach($prods as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->prix }}">{{ $product->nom }} - {{ number_format($product->prix, 0, ',', ' ') }} FCFA</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="quantities[]" class="quantity-input" placeholder="Qté" min="1" required>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeProduct(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        container.appendChild(newProduct);
    }

    function removeProduct(button) {
        button.closest('.product-item').remove();
        calculateTotal();
    }

    function calculateTotal() {
        let total = 0;
        const products = document.querySelectorAll('.product-select');
        const quantities = document.querySelectorAll('.quantity-input');
        
        products.forEach((product, index) => {
            if (product.value && quantities[index].value) {
                const price = parseFloat(product.selectedOptions[0].dataset.price);
                const quantity = parseFloat(quantities[index].value);
                total += price * quantity;
            }
        });
        
        document.getElementById('totalAmount').value = total;
    }

    // Add event listeners
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('productsContainer').addEventListener('change', calculateTotal);
        document.getElementById('productsContainer').addEventListener('input', calculateTotal);
    });
</script>

@endsection