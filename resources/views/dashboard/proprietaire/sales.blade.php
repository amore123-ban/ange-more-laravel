@extends('layouts.layout_proprio')

@section('content')
<!-- En-tête META et CSS -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    :root {
      --primary-blue: #2563eb;
      --primary-blue-dark: #1e40af;
      --primary-blue-light: #3b82f6;
      --sidebar-width: 280px;
    }

    .main-content {
      margin-left: var(--sidebar-width);
      padding: 20px;
      background: #f8fafc;
      min-height: 100vh;
    }

    .sale-header {
            background: linear-gradient(135deg, #ffffff 0%, #f0f4ff 100%);
            border-top: 4px solid #2563eb;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

    .sale-header:hover {
        transform: translateY(-2px);
    }

    .icon-container {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        width: 60px;
        height: 60px;
        transition: transform 0.3s ease;
    }

    .icon-container:hover {
        transform: scale(1.05);
    }

    .boutique-select {
        background: linear-gradient(135deg, #fff5f5, #ffe5e5);
        border: 2px solid #fed7d7;
        color: #dc3545;
        transition: all 0.3s ease;
    }

    .boutique-select:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .boutique-select:hover {
        border-color: #dc3545;
        transform: translateY(-1px);
    }

    .title-gradient {
        background: linear-gradient(135deg, #2d3748, #4a5568);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .search-container {
        position: relative;
        width: 620px;
    }

    .search-input {
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        padding-left: 45px;
        height: 45px;
        transition: all 0.3s ease;
        background: white;
    }

    .search-input:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary-blue);
        z-index: 5;
    }
    .boutique-selector {
    background: var(--brand-50);
    border: 2px solid var(--brand-100);
    border-radius: 12px;
    padding: 10px 14px;
    font-weight: 500;
    color: var(--brand-700);
    transition: var(--transition);
    min-width: 180px;
    font-size: 0.875rem;
    }

    .boutique-selector:focus {
        outline: none;
        border-color: var(--brand);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        background: white;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        margin-right: 8px;
    }

    .card-style-1 {
        background: white;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .card-style-1::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-blue), var(--primary-blue-light));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .card-style-1:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.12);
        border-color: rgba(37, 99, 235, 0.2);
    }

    .card-style-1:hover::before {
        transform: scaleX(1);
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.12);
        border-color: rgba(37, 99, 235, 0.2);
    }

    .product-card:hover::before {
        transform: scaleX(1);
    }

    .product-image {
        width: 100%;
        height: 120px;
        object-fit: cover;
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        font-size: 2rem;
    }

    .product-name {
        font-size: 0.95rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .product-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-blue);
        margin-bottom: 0.5rem;
    }

    .product-stock {
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .stock-high {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .stock-low {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .stock-out {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .btn-select-product {
        width: 100%;
        background: var(--primary-blue);
        border: none;
        color: white;
        padding: 0.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-top: 0.75rem;
    }

    .btn-select-product:hover {
        background: var(--primary-blue-dark);
        transform: translateY(-1px);
        color: white;
    }
    .btn-add {
        background: var(--primary-blue);
        border: none;
        color: white;
        padding: 0.5rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-add:hover {
        background: var(--primary-blue-dark);
        transform: translateY(-1px);
        color: white;
    }

    .btn-add:disabled {
        background: #6b7280;
        cursor: not-allowed;
        transform: none;
    }

    .summary-item {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 8px;
        border-left: 3px solid var(--primary-blue);
    }

    .summary-item:last-child {
        margin-bottom: 0;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeInUp 0.5s ease-out;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
            padding: 16px;
        }

        .search-container {
            max-width: 100%;
            margin-bottom: 1rem;
        }

        .sales-header .row > div {
            margin-bottom: 1rem;
        }

        .modal-dialog.modal-lg {
            margin: 10px;
            max-width: calc(100vw - 20px);
        }
    }
</style>

<div class="main-content">
    <div class="container-fluid">
        
        <div class="sale-header bg-white rounded-4 shadow-sm p-4 mb-4 border border-primary border-opacity-10">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                
                <div class="d-flex align-items-center flex-grow-1" style="min-width: 300px;">
                    
                    <div class="icon-container rounded-3 bg-primary d-flex align-items-center justify-content-center me-3 shadow">
                        <i class="fas fa-shopping-cart text-white fs-4"></i>
                    </div>
                    
                    <div>
                        <h4 class="title-gradient fw-bold mb-1 fs-5">Gerer vos ventes</h4>
                        <small class="text-muted fw-medium">Enregistrer des ventes et generer des factures</small>
                    </div>
                </div>
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchProduct" class="form-control search-input" placeholder="Rechercher un produit...">
                </div>
                
                <div style="min-width: 250px;">
                    <label class="form-label text-secondary fw-semibold text-uppercase small mb-2">
                        <i class="fas fa-filter me-1"></i>
                        Filtrer par boutique
                    </label>
                    <form action="#" method="GET" id="boutiqueFilterForm">
                      @csrf
                        <select name="shop_id" id="boutiqueSelect" class="boutique-select form-select fw-semibold rounded-3 shadow-sm">
                          @if($shop)
                              <option value="{{ $shop->id }}"
                                  {{ request('shop_id') == $shop->id ? 'selected' : '' }}>
                                  {{ $shop->nom }}
                              </option>
                          @endif
                        </select>
                    </form>
                </div>
                <div class="dropdown">
                    <button class=" boutique-selector dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar me-2 align-items-center">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="d-none d-md-block text-start me-2">
                            <div class="fw-semibold small">{{ Auth::user()->name ?? 'Utilisateur' }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Administrateur</div>
                        </div>
                    </button>
                    
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" style="min-width: 280px;">
                        <li class="bg-primary text-white p-3 rounded-top">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar-small me-3">
                                <i class="fas fa-user"></i>
                                <div>
                                    <div class="fw-semibold">{{ Auth::user()->name ?? 'Utilisateur' }}</div>
                                    <small class="opacity-75">{{ Auth::user()->email ?? 'email@example.com' }}</small>
                                </div>
                            </div>
                        </li>

                        <li><hr class="dropdown-divider my-2"></li>
                        
                        <li>
                            <a class="dropdown-item py-2" href="#">
                                <i class="fas fa-envelope me-2 text-primary"></i>
                                {{ Auth::user()->email ?? 'email@example.com' }}
                            </a>
                        </li>
                        
                        <li>
                            <a class="dropdown-item py-2" href="#">
                                <i class="fas fa-user me-2 text-info"></i>
                                Mon Profil
                            </a>
                        </li>
                        
                        <li>
                            <a class="dropdown-item py-2" href="#">
                                <i class="fas fa-cog me-2 text-warning"></i>
                                Paramètres
                            </a>
                        </li>
                        
                        <li>
                            <a class="dropdown-item py-2" href="#">
                                <i class="fas fa-bell me-2 text-secondary"></i>
                                Notifications
                                <span class="badge bg-danger ms-auto">3</span>
                            </a>
                        </li>

                        <li><hr class="dropdown-divider my-2"></li>
                        
                        <li>
                            <a class="dropdown-item py-2 text-danger" 
                            href="{{ route('logout') }}" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Se déconnecter
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="noProductsMessage" class="alert alert-info d-none">
            Aucun produit ne correspond à votre recherche.
        </div>

        <div class="row g-4">
            <div class="col-8">
                <div class="row g-4">
                    @foreach($prods as $prod)
                    <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card-style-1 product-card animate-fade-in" data-product-id="{{ $prod->id }}">
                            <div class="p-3">
                                <div class="product-image mb-3">
                                    @if($prod->image)
                                        <img src="{{ asset('storage/' . $prod->image) }}" alt="{{ $prod->nom }}" class="img-fluid">
                                    @else
                                        <div class="no-image">
                                            <i class="fas fa-box fa-2x"></i>
                                        </div>
                                    @endif
                                </div>
                                <h6 class="product-name">{{ $prod->nom }}</h6>
                                <div class="product-price">{{ number_format($prod->prix, 0, ',', ' ') }} FCFA</div>
                                <span class="product-stock {{ $prod->quantite > 10 ? 'stock-high' : ($prod->quantite > 0 ? 'stock-low' : 'stock-out') }}">
                                    <i class="fas fa-circle fs-6"></i>
                                    {{ $prod->quantite }} en stock
                                </span>
                                <button class="btn-select-product" onclick="addToCart({{ $prod->id }}, '{{ $prod->nom }}', {{ $prod->prix }}, {{ $prod->quantite }})"
                                    {{ $prod->quantite <= 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-plus me-2"></i>Ajouter
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Panier -->
            <div class="col-4 panier">
                <!-- Carte Panier Initiale -->
                <div class="card-style-1 sticky-top" style="top: 20px;" id="cart-card">
                    <div class="p-3">
                        <span class="product-stock stock-high text-center fs-5 mb-3 d-block">
                            <i class="fas fa-shopping-cart me-2"></i>Panier
                        </span>
                        <div id="cart-items" class="mb-3">
                        </div>
                        <div class="border-top pt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Total:</span>
                                <span class="fw-bold text-primary" id="cart-total">0 FCFA</span>
                            </div>
                        </div>
                        <button class="btn-add w-100" onclick="showOrderSummary()" id="validate-cart-btn" disabled>
                            <i class="fas fa-check me-2"></i>Valider la vente
                        </button>
                    </div>
                </div>

                <!-- Carte Récapitulatif (cachée initialement) -->
                <div class="card-style-1 sticky-top" style="top: 20px; display: none;" id="summary-card">
                    <div class="p-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="product-stock stock-high text-center fs-5">
                                <i class="fas fa-receipt me-2"></i>Récapitulatif
                            </span>
                            <button class="btn btn-outline-secondary btn-sm" onclick="backToCart()">
                                <i class="fas fa-arrow-left"></i>
                            </button>
                        </div>
                        
                        <div id="order-summary-items" class="mb-3">
                            <!-- Les articles seront injectés ici -->
                        </div>
                        
                        <div class="border-top pt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Nombre d'articles:</span>
                                <span class="fw-bold" id="total-items">0</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="fw-bold fs-5">Total à payer:</span>
                                <span class="fw-bold text-primary fs-5" id="final-total">0 FCFA</span>
                            </div>
                        </div>
                        
                        <button class="btn-add w-100" data-bs-toggle="modal" data-bs-target="#confirmSaleModal" id="continue-to-payment-btn">
                            <i class="fas fa-arrow-right me-2"></i>Continuer vers le paiement
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal de confirmation de vente amélioré -->
            <div class="modal fade" id="confirmSaleModal" tabindex="-1" aria-labelledby="confirmSaleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="confirmSaleForm" onsubmit="submitSaleForm(event)">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="confirmSaleModalLabel">
                                    <i class="fas fa-cash-register me-2"></i>Finaliser la vente
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Récapitulatif dans le modal -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="mb-3"><i class="fas fa-list me-2"></i>Récapitulatif de la commande</h6>
                                        <div id="modal-order-summary" class="mb-3">
                                            <!-- Récapitulatif sera injecté ici -->
                                        </div>
                                        <div class="alert alert-info">
                                            <strong>Total: <span id="modal-total">0 FCFA</span></strong>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="mb-3"><i class="fas fa-user me-2"></i>Informations client</h6>
                                        <div class="mb-3">
                                            <label for="clientName" class="form-label">Nom du client</label>
                                            <input type="text" class="form-control" id="clientName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="montantPercu" class="form-label">Montant perçu (FCFA)</label>
                                            <input type="number" class="form-control" id="montantPercu" required min="0" oninput="calculateChange()">
                                        </div>
                                        <div class="mb-3">
                                            <label for="modePaiement" class="form-label">Mode de paiement</label>
                                            <select class="form-select" id="modePaiement" required>
                                                <option value="">-- Choisir --</option>
                                                <option value="espèces">Espèces</option>
                                                <option value="mobile money">Mobile Money</option>
                                                <option value="carte bancaire">Carte Bancaire</option>
                                                <option value="virement">Virement</option>
                                            </select>
                                        </div>
                                        <div class="alert alert-warning" id="change-display" style="display: none;">
                                            <strong>Monnaie à rendre: <span id="change-amount">0 FCFA</span></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check me-2"></i>Confirmer la vente
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

document.getElementById('searchProduct').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const productCards = document.querySelectorAll('.product-card');
    const noProductsMessage = document.getElementById('noProductsMessage');
    let hasVisibleProducts = false;
    
    productCards.forEach(card => {
        const productName = card.querySelector('.product-name').textContent.toLowerCase();
        if (productName.includes(searchTerm)) {
            card.style.display = '';
            hasVisibleProducts = true;
        } else {
            card.style.display = 'none';
        }
    });
    
    if (hasVisibleProducts || searchTerm === '') {
        noProductsMessage.classList.add('d-none');
    } else {
        noProductsMessage.classList.remove('d-none');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.animate-fade-in');
    if (cards) {
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }
});

let cart = [];
let currentCartData = [];
const MAX_QUANTITY = 99;

function addToCart(id, nom, prix, quantite_max) {
    const existingItem = cart.find(item => item.id === id);
    
    if (existingItem) {
        if (existingItem.quantite < Math.min(quantite_max, MAX_QUANTITY)) {
            existingItem.quantite++;
            updateCartDisplay();
        } else {
            showCustomAlert('Quantité maximum atteinte pour ce produit');
        }
    } else {
        cart.push({
            id: id,
            nom: nom,
            prix: prix,
            quantite: 1,
            quantite_max: quantite_max
        });
        updateCartDisplay();
    }
}

function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    updateCartDisplay();
}

function updateQuantity(id, delta) {
    const item = cart.find(item => item.id === id);
    if (item) {
        const newQuantity = item.quantite + delta;
        if (newQuantity > 0 && newQuantity <= Math.min(item.quantite_max, MAX_QUANTITY)) {
            item.quantite = newQuantity;
            updateCartDisplay();
        }
    }
}

function updateCartDisplay() {
    const cartContainer = document.getElementById('cart-items');
    const total = cart.reduce((sum, item) => sum + (item.prix * item.quantite), 0);
    
    cartContainer.innerHTML = cart.map(item => `
        <div class="cart-item mb-3 pb-3 border-bottom">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="product-name mb-0">${item.nom}</h6>
                <button class="btn btn-sm text-danger" onclick="removeFromCart(${item.id})">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="quantity-controls">
                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(${item.id}, -1)">-</button>
                    <span class="mx-2 item-quantity">${item.quantite}</span>
                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(${item.id}, 1)">+</button>
                </div>
                <div class="text-primary fw-bold item-total">
                    ${(item.prix * item.quantite).toLocaleString()} FCFA
                </div>
            </div>
            <div class="d-none item-price">${item.prix.toLocaleString()} FCFA</div>
        </div>
    `).join('');

    document.getElementById('cart-total').textContent = `${total.toLocaleString()} FCFA`;
    
    // Activer/désactiver le bouton de validation
    const validateBtn = document.getElementById('validate-cart-btn');
    validateBtn.disabled = cart.length === 0;
}

function showOrderSummary() {
    if (cart.length === 0) {
        showCustomAlert("Votre panier est vide !");
        return;
    }
    
    // Récupérer les données du panier
    const cartTotal = document.getElementById('cart-total').textContent;
    
    // Collecter les données des articles
    currentCartData = [];
    let totalItems = 0;
    
    cart.forEach(item => {
        currentCartData.push({
            name: item.nom,
            quantity: item.quantite,
            price: item.prix.toLocaleString() + ' FCFA',
            total: (item.prix * item.quantite).toLocaleString() + ' FCFA'
        });
        
        totalItems += item.quantite;
    });
    
    // Générer le HTML du récapitulatif
    const summaryHTML = currentCartData.map(item => `
        <div class="summary-item">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">${item.name}</div>
                    <small class="text-muted">${item.quantity} × ${item.price}</small>
                </div>
                <div class="fw-bold text-primary">${item.total}</div>
            </div>
        </div>
    `).join('');
    
    // Mettre à jour la carte récapitulatif
    document.getElementById('order-summary-items').innerHTML = summaryHTML;
    document.getElementById('total-items').textContent = totalItems;
    document.getElementById('final-total').textContent = cartTotal;
    
    // Cacher la carte panier et afficher le récapitulatif
    document.getElementById('cart-card').style.display = 'none';
    document.getElementById('summary-card').style.display = 'block';
}

function backToCart() {
    // Retour à la carte panier
    document.getElementById('summary-card').style.display = 'none';
    document.getElementById('cart-card').style.display = 'block';
}

// Quand le modal s'ouvre, mettre à jour le récapitulatif dans le modal
document.getElementById('confirmSaleModal').addEventListener('show.bs.modal', function() {
    // Mettre à jour le récapitulatif dans le modal
    const modalSummaryHTML = currentCartData.map(item => `
        <div class="d-flex justify-content-between mb-2">
            <span>${item.name} (${item.quantity})</span>
            <span>${item.total}</span>
        </div>
    `).join('');
    
    document.getElementById('modal-order-summary').innerHTML = modalSummaryHTML;
    document.getElementById('modal-total').textContent = document.getElementById('final-total').textContent;
});

function calculateChange() {
    const totalText = document.getElementById('final-total').textContent;
    const total = parseFloat(totalText.replace(/[^\d]/g, '')) || 0;
    const received = parseFloat(document.getElementById('montantPercu').value) || 0;
    const change = received - total;
    
    const changeDisplay = document.getElementById('change-display');
    const changeAmount = document.getElementById('change-amount');
    
    if (received > 0 && change >= 0) {
        changeAmount.textContent = change.toLocaleString() + ' FCFA';
        changeDisplay.style.display = 'block';
        if (change > 0) {
            changeDisplay.className = 'alert alert-warning';
        } else {
            changeDisplay.className = 'alert alert-success';
        }
    } else {
        changeDisplay.style.display = 'none';
    }
}

function showCustomAlert(message) {
    const modal = document.createElement('div');
    modal.className = 'fixed-top d-flex align-items-center justify-content-center';
    modal.style.cssText = 'position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999;';
    modal.innerHTML = `
        <div class="bg-white p-4 rounded shadow-lg" style="max-width: 400px; margin: 20px;">
            <div class="text-center mb-3">
                <i class="fas fa-exclamation-circle text-warning fs-1"></i>
            </div>
            <p class="text-center mb-4">${message}</p>
            <div class="text-center">
                <button class="btn btn-primary" onclick="this.closest('.fixed-top').remove()">OK</button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
}

function submitSaleForm(event) {
    // event.preventDefault(); // Empêche le rechargement de la page

    if (cart.length === 0) {
        showCustomAlert("Votre panier est vide !");
        return;
    }

    const clientName = document.getElementById('clientName').value.trim();
    const montantPercu = parseFloat(document.getElementById('montantPercu').value);
    const modePaiement = document.getElementById('modePaiement').value;
    const total = cart.reduce((sum, item) => sum + (item.prix * item.quantite), 0);

    if (!clientName) {
        showCustomAlert("Veuillez entrer le nom du client.");
        return;
    }

    if (isNaN(montantPercu) || montantPercu < total) {
        showCustomAlert("Le montant perçu doit être supérieur ou égal au total (" + total.toLocaleString() + " FCFA).");
        return;
    }

    const saleData = {
        client_name: clientName,
        montant_recu: montantPercu,
        mode_paiement: modePaiement,
        total: total,
        items: cart.map(item => ({
            product_id: item.id,
            quantite: item.quantite,
            prix: item.prix
        }))
    };

    const submitBtn = document.querySelector('#confirmSaleForm button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Traitement...';
    submitBtn.disabled = true;

    fetch('/api/sales', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(saleData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showCustomAlert('Vente effectuée avec succès !');
            cart = [];
            updateCartDisplay();

            const modal = bootstrap.Modal.getInstance(document.getElementById('confirmSaleModal'));
            modal.hide();

            setTimeout(() => {
                backToCart();
                document.getElementById('confirmSaleForm').reset();
                document.getElementById('change-display').style.display = 'none';
            }, 500);
        } else {
            showCustomAlert('Erreur lors de la vente : ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showCustomAlert('Une erreur est survenue lors du traitement de la vente');
    })
    .finally(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>

@endsection