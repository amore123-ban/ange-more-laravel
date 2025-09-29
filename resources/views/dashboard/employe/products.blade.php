@extends('layouts.layout_employe')

@section('title', 'Gestion des Produits')

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

    .product-image {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
    }

    .btn-group .btn {
        margin-right: 2px;
    }

    .badge {
        font-size: 0.75em;
    }

    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .card-body {
        padding: 1.5rem;
    }

    .modal-content {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
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
        <!-- Header -->
        <div class="dashboard-header">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="fas fa-box text-primary fs-4"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold text-dark">Gestion des Produits <span class="employee-badge">EMPLOYÉ</span></h4>
                    <small class="text-muted">Gérez votre inventaire de produits</small>
                </div>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="fas fa-plus me-2"></i>Ajouter un Produit
            </button>
        </div>

        <!-- Statistiques -->
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

        <!-- Filtres et Recherche -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Rechercher un produit...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="categoryFilter">
                    <option value="">Toutes les catégories</option>
                    @foreach($cats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="stockFilter">
                    <option value="">Tous les stocks</option>
                    <option value="stock">En stock</option>
                    <option value="low">Stock faible</option>
                    <option value="out">Rupture</option>
                </select>
            </div>
        </div>

        <!-- Liste des Produits -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="productsTable">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Nom</th>
                                        <th>Description</th>
                                        <th>Catégorie</th>
                                        <th>Prix</th>
                                        <th>Stock</th>
                                        <th>Stock Min</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($prods as $product)
                                    <tr data-product-id="{{ $product->id }}" data-category="{{ $product->category_id }}">
                                        <td>
                                            <div class="product-image">
                                                <i class="fas fa-box text-muted fa-2x"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>{{ $product->nom }}</strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ Str::limit($product->description, 50) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $product->category->nom ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <strong class="text-success">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $product->quantite }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning">{{ $product->quantite_min }}</span>
                                        </td>
                                        <td>
                                            @if($product->quantite == 0)
                                                <span class="badge bg-danger">Rupture</span>
                                            @elseif($product->quantite <= $product->quantite_min)
                                                <span class="badge bg-warning">Stock faible</span>
                                            @else
                                                <span class="badge bg-success">En stock</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" onclick="editProduct({{ $product->id }})" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" onclick="deleteProduct({{ $product->id }})" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-box-open fa-3x mb-3"></i>
                                                <h5>Aucun produit trouvé</h5>
                                                <p>Commencez par ajouter votre premier produit</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajouter Produit -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addProductForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="addName" class="form-label">Nom du produit *</label>
                                <input type="text" class="form-control" id="addName" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="addCategory" class="form-label">Catégorie *</label>
                                <select class="form-select" id="addCategory" name="id_categorie" required>
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach($cats as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="addDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="addDescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="addPrice" class="form-label">Prix (FCFA) *</label>
                                <input type="number" class="form-control" id="addPrice" name="price" min="0" step="1" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="addQuantity" class="form-label">Quantité *</label>
                                <input type="number" class="form-control" id="addQuantity" name="qte" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="addMinQuantity" class="form-label">Stock minimum *</label>
                                <input type="number" class="form-control" id="addMinQuantity" name="qte_min" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Ajouter le Produit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier Produit -->
<div class="modal fade" id="editProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier le Produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editProductForm">
                <input type="hidden" id="editProductId" name="product_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editName" class="form-label">Nom du produit *</label>
                                <input type="text" class="form-control" id="editName" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editCategory" class="form-label">Catégorie *</label>
                                <select class="form-select" id="editCategory" name="id_categorie" required>
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach($cats as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="editPrice" class="form-label">Prix (FCFA) *</label>
                                <input type="number" class="form-control" id="editPrice" name="price" min="0" step="1" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="editQuantity" class="form-label">Quantité *</label>
                                <input type="number" class="form-control" id="editQuantity" name="qte" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="editMinQuantity" class="form-label">Stock minimum *</label>
                                <input type="number" class="form-control" id="editMinQuantity" name="qte_min" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Enregistrer les Modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Variables globales
let products = @json($prods);
let categories = @json($cats);

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    initializeFilters();
    initializeForms();
});

// Initialisation des filtres
function initializeFilters() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const stockFilter = document.getElementById('stockFilter');
    
    searchInput.addEventListener('input', filterProducts);
    categoryFilter.addEventListener('change', filterProducts);
    stockFilter.addEventListener('change', filterProducts);
}

// Filtrage des produits
function filterProducts() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const categoryFilter = document.getElementById('categoryFilter').value;
    const stockFilter = document.getElementById('stockFilter').value;
    
    const rows = document.querySelectorAll('#productsTable tbody tr');
    
    rows.forEach(row => {
        const productId = row.getAttribute('data-product-id');
        if (!productId) return; // Skip empty row
        
        const product = products.find(p => p.id == productId);
        if (!product) return;
        
        let showRow = true;
        
        // Filtre par recherche
        if (searchTerm) {
            const searchableText = (product.nom + ' ' + (product.description || '')).toLowerCase();
            showRow = showRow && searchableText.includes(searchTerm);
        }
        
        // Filtre par catégorie
        if (categoryFilter) {
            showRow = showRow && product.category_id == categoryFilter;
        }
        
        // Filtre par stock
        if (stockFilter) {
            switch(stockFilter) {
                case 'stock':
                    showRow = showRow && product.quantite > product.quantite_min;
                    break;
                case 'low':
                    showRow = showRow && product.quantite <= product.quantite_min && product.quantite > 0;
                    break;
                case 'out':
                    showRow = showRow && product.quantite == 0;
                    break;
            }
        }
        
        row.style.display = showRow ? '' : 'none';
    });
}

// Initialisation des formulaires
function initializeForms() {
    // Formulaire d'ajout
    document.getElementById('addProductForm').addEventListener('submit', function(e) {
        e.preventDefault();
        addProduct();
    });
    
    // Formulaire de modification
    document.getElementById('editProductForm').addEventListener('submit', function(e) {
        e.preventDefault();
        updateProduct();
    });
}

// Ajouter un produit
function addProduct() {
    const formData = new FormData(document.getElementById('addProductForm'));
    
    fetch('{{ route("product.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('success', data.message);
            document.getElementById('addProductForm').reset();
            bootstrap.Modal.getInstance(document.getElementById('addProductModal')).hide();
            location.reload(); // Recharger pour afficher le nouveau produit
        } else {
            showAlert('error', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'Erreur lors de l\'ajout du produit');
    });
}

// Modifier un produit
function editProduct(productId) {
    const product = products.find(p => p.id == productId);
    if (!product) return;
    
    // Remplir le formulaire
    document.getElementById('editProductId').value = product.id;
    document.getElementById('editName').value = product.nom;
    document.getElementById('editDescription').value = product.description || '';
    document.getElementById('editCategory').value = product.category_id;
    document.getElementById('editPrice').value = product.prix;
    document.getElementById('editQuantity').value = product.quantite;
    document.getElementById('editMinQuantity').value = product.quantite_min;
    
    // Afficher le modal
    new bootstrap.Modal(document.getElementById('editProductModal')).show();
}

// Mettre à jour un produit
function updateProduct() {
    const productId = document.getElementById('editProductId').value;
    const formData = new FormData(document.getElementById('editProductForm'));
    
    fetch(`/produits/${productId}`, {
        method: 'PUT',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('success', data.message);
            bootstrap.Modal.getInstance(document.getElementById('editProductModal')).hide();
            location.reload(); // Recharger pour afficher les modifications
        } else {
            showAlert('error', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'Erreur lors de la modification du produit');
    });
}

// Supprimer un produit
function deleteProduct(productId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce produit ? Cette action est irréversible.')) {
        fetch(`/produits/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message);
                location.reload(); // Recharger pour supprimer le produit de la liste
            } else {
                showAlert('error', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'Erreur lors de la suppression du produit');
        });
    }
}

// Afficher une alerte
function showAlert(type, message) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    // Insérer l'alerte en haut de la page
    const container = document.querySelector('.main-content');
    container.insertAdjacentHTML('afterbegin', alertHtml);
    
    // Supprimer automatiquement après 5 secondes
    setTimeout(() => {
        const alert = container.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 5000);
}
</script>

@endsection