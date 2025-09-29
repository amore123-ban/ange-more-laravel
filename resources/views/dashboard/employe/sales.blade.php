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
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
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

    .ecommerce-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .products-section {
        background: white;
        border-radius: var(--card-radius);
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
    }

    .cart-section {
        background: white;
        border-radius: var(--card-radius);
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
        position: sticky;
        top: 20px;
        height: fit-content;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
        margin-top: 16px;
    }

    .product-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 16px;
        border: 2px solid transparent;
        transition: var(--transition);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .product-card:hover {
        border-color: var(--primary-blue);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.15);
    }

    .product-card.selected {
        border-color: var(--primary-blue);
        background: rgba(37, 99, 235, 0.05);
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
        margin: 0 auto 12px;
    }

    .product-name {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 8px;
        text-align: center;
        font-size: 0.9rem;
    }

    .product-price {
        font-weight: 700;
        color: var(--primary-blue);
        text-align: center;
        margin-bottom: 8px;
    }

    .product-stock {
        font-size: 0.8rem;
        text-align: center;
        padding: 4px 8px;
        border-radius: 20px;
        font-weight: 500;
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

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-info {
        flex: 1;
    }

    .cart-item-name {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 0.9rem;
    }

    .cart-item-price {
        color: var(--primary-blue);
        font-size: 0.8rem;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .quantity-btn {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
    }

    .quantity-btn:hover {
        background: var(--primary-blue);
        color: white;
        border-color: var(--primary-blue);
    }

    .quantity-input {
        width: 40px;
        text-align: center;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 4px;
        font-size: 0.9rem;
    }

    .remove-btn {
        color: #dc2626;
        cursor: pointer;
        padding: 4px;
        border-radius: 4px;
        transition: var(--transition);
    }

    .remove-btn:hover {
        background: rgba(220, 38, 38, 0.1);
    }

    .cart-summary {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 2px solid #e2e8f0;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .summary-total {
        font-weight: 700;
        font-size: 1.2rem;
        color: var(--primary-blue);
        border-top: 1px solid #e2e8f0;
        padding-top: 8px;
        margin-top: 8px;
    }

    .checkout-form {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #e2e8f0;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        width: 100%;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px;
        transition: var(--transition);
        font-size: 0.9rem;
    }

    .form-control:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    .btn-checkout {
        width: 100%;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: var(--transition);
        cursor: pointer;
    }

    .btn-checkout:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .btn-checkout:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .search-container {
        position: relative;
        margin-bottom: 16px;
    }

    .search-input {
        width: 100%;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 16px 12px 40px;
        transition: var(--transition);
    }

    .search-input:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
    }

    .empty-cart {
        text-align: center;
        padding: 40px 20px;
        color: #64748b;
    }

    .empty-cart i {
        font-size: 3rem;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
            padding: 12px;
        }
        
        .ecommerce-container {
            grid-template-columns: 1fr;
        }
        
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
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
                    <h4 class="mb-0 fw-bold text-dark">Point de Vente <span class="employee-badge">EMPLOYÉ</span></h4>
                    <small class="text-muted">Interface moderne de vente avec panier</small>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
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
            
            <div class="col-lg-3 col-md-6 mb-3">
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
            
            <div class="col-lg-3 col-md-6 mb-3">
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
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Articles dans le panier</h6>
                            <h3 class="mb-0 fw-bold text-warning" id="cart-count">0</h3>
                        </div>
                        <div class="stats-icon bg-warning bg-opacity-10">
                            <i class="fas fa-shopping-cart text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- E-commerce Interface -->
        <div class="ecommerce-container">
            <!-- Products Section -->
            <div class="products-section">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-box me-2 text-primary"></i>
                    Produits Disponibles
                </h5>
                
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="productSearch" class="search-input" placeholder="Rechercher un produit...">
                </div>
                
                <div class="product-grid" id="productGrid">
                    @forelse($prods as $product)
                        <div class="product-card" data-product-id="{{ $product->id }}" data-product-name="{{ $product->nom }}" data-product-price="{{ $product->prix }}" data-product-stock="{{ $product->quantite }}">
                            <div class="product-image">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="product-name">{{ $product->nom }}</div>
                            <div class="product-price">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</div>
                            <div class="product-stock {{ $product->quantite > $product->quantite_min ? 'stock-good' : ($product->quantite > 0 ? 'stock-low' : 'stock-out') }}">
                                {{ $product->quantite > $product->quantite_min ? 'En stock' : ($product->quantite > 0 ? 'Stock faible' : 'Rupture') }}
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-box-open text-muted" style="font-size: 3rem;"></i>
                            <h4 class="mt-3 text-muted">Aucun produit trouvé</h4>
                            <p class="text-muted">Aucun produit n'est disponible dans cette boutique.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Cart Section -->
            <div class="cart-section">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-shopping-cart me-2 text-primary"></i>
                    Panier de Vente
                </h5>
                
                <div id="cartItems">
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <h6>Votre panier est vide</h6>
                        <p class="mb-0">Sélectionnez des produits pour commencer</p>
                    </div>
                </div>
                
                <div class="cart-summary" id="cartSummary" style="display: none;">
                    <div class="summary-row">
                        <span>Sous-total:</span>
                        <span id="subtotal">0 FCFA</span>
                    </div>
                    <div class="summary-row summary-total">
                        <span>Total:</span>
                        <span id="total">0 FCFA</span>
                    </div>
                </div>
                
                <form id="checkoutForm" class="checkout-form" style="display: none;">
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ $shop->id ?? '' }}">
                    <input type="hidden" name="total" id="totalInput">
                    
                    <div class="form-group">
                        <label class="form-label">Nom du Client</label>
                        <input type="text" name="client_name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Mode de Paiement</label>
                        <select name="mode_paiement" class="form-control" required>
                            <option value="">Sélectionner...</option>
                            <option value="Espèces">Espèces</option>
                            <option value="Mobile Money">Mobile Money</option>
                            <option value="Carte Bancaire">Carte Bancaire</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Montant Reçu</label>
                        <input type="number" name="montant_recu" class="form-control" required>
                    </div>
                    
                    <button type="submit" class="btn-checkout">
                        <i class="fas fa-credit-card me-2"></i>
                        Finaliser la Vente
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let cart = [];
let products = [];

// Initialiser les produits
document.addEventListener('DOMContentLoaded', function() {
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        const product = {
            id: card.dataset.productId,
            name: card.dataset.productName,
            price: parseFloat(card.dataset.productPrice),
            stock: parseInt(card.dataset.productStock)
        };
        products.push(product);
        
        // Ajouter événement de clic
        card.addEventListener('click', function() {
            if (product.stock > 0) {
                addToCart(product);
            }
        });
    });
    
    // Recherche de produits
    document.getElementById('productSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        productCards.forEach(card => {
            const productName = card.dataset.productName.toLowerCase();
            if (productName.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

function addToCart(product) {
    const existingItem = cart.find(item => item.id === product.id);
    
    if (existingItem) {
        if (existingItem.quantity < product.stock) {
            existingItem.quantity++;
        } else {
            alert('Stock insuffisant pour ce produit');
            return;
        }
    } else {
        cart.push({
            id: product.id,
            name: product.name,
            price: product.price,
            quantity: 1,
            stock: product.stock
        });
    }
    
    updateCartDisplay();
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    updateCartDisplay();
}

function updateQuantity(productId, newQuantity) {
    const item = cart.find(item => item.id === productId);
    if (item) {
        if (newQuantity <= 0) {
            removeFromCart(productId);
        } else if (newQuantity <= item.stock) {
            item.quantity = newQuantity;
            updateCartDisplay();
        } else {
            alert('Stock insuffisant pour ce produit');
        }
    }
}

function updateCartDisplay() {
    const cartItems = document.getElementById('cartItems');
    const cartSummary = document.getElementById('cartSummary');
    const checkoutForm = document.getElementById('checkoutForm');
    const cartCount = document.getElementById('cart-count');
    
    cartCount.textContent = cart.length;
    
    if (cart.length === 0) {
        cartItems.innerHTML = `
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h6>Votre panier est vide</h6>
                <p class="mb-0">Sélectionnez des produits pour commencer</p>
            </div>
        `;
        cartSummary.style.display = 'none';
        checkoutForm.style.display = 'none';
    } else {
        let total = 0;
        cartItems.innerHTML = cart.map(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            return `
                <div class="cart-item">
                    <div class="cart-item-info">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-price">${item.price.toLocaleString()} FCFA</div>
                    </div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="updateQuantity('${item.id}', ${item.quantity - 1})">-</button>
                        <input type="number" class="quantity-input" value="${item.quantity}" min="1" max="${item.stock}" onchange="updateQuantity('${item.id}', parseInt(this.value))">
                        <button class="quantity-btn" onclick="updateQuantity('${item.id}', ${item.quantity + 1})">+</button>
                    </div>
                    <div class="remove-btn" onclick="removeFromCart('${item.id}')">
                        <i class="fas fa-trash"></i>
                    </div>
                </div>
            `;
        }).join('');
        
        document.getElementById('subtotal').textContent = total.toLocaleString() + ' FCFA';
        document.getElementById('total').textContent = total.toLocaleString() + ' FCFA';
        document.getElementById('totalInput').value = total;
        
        cartSummary.style.display = 'block';
        checkoutForm.style.display = 'block';
    }
}

// Gestion du formulaire de checkout
document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    // Ajouter les produits au formulaire
    cart.forEach((item, index) => {
        formData.append(`products[${index}]`, item.id);
        formData.append(`quantities[${index}]`, item.quantity);
    });
    
    // Soumettre le formulaire
    fetch('{{ route("sales.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Vente enregistrée avec succès !');
            cart = [];
            updateCartDisplay();
            this.reset();
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur lors de l\'enregistrement de la vente');
    });
});
</script>

@endsection