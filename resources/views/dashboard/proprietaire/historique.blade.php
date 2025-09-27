

@extends('layouts.layout_proprio')

@section('content')

<title>Registre des Ventes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-light: #3b82f6;
            --primary-dark: #1d4ed8;
            --secondary-color: #f8fafc;
            --accent-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --success-color: #059669;
            --warning-color: #d97706;
            --danger-color: #dc2626;
        }

        .main-content {
      margin-left: var(--sidebar-width);
      padding: 20px;
      background: linear-gradient(135deg, #ffffff 0%, rgb(165, 192, 230) 100%);
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
        width:600px;
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


        .stats-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.3s ease;
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
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px -5px rgba(37, 99, 235, 0.15);
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
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(226, 232, 240, 0.8);
            overflow: hidden;
        }

        .table-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-bottom: 2px solid var(--accent-color);
        }

        .table th {
            border: none;
            font-weight: 600;
            color: var(--text-primary);
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
            color: var(--success-color);
        }

        .status-pending {
            background: rgba(217, 119, 6, 0.1);
            color: var(--warning-color);
        }

        .status-cancelled {
            background: rgba(220, 38, 38, 0.1);
            color: var(--danger-color);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }

        .btn-primary-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
        }

        .search-container {
            position: relative;
        }

        .search-container .form-control {
            padding-left: 2.5rem;
            border-radius: 10px;
            border: 2px solid var(--accent-color);
            transition: all 0.3s ease;
        }

        .search-container .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.1);
        }

        .search-container i {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
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

        .btn-view { background: rgba(37, 99, 235, 0.1); color: var(--primary-color); }
        .btn-edit { background: rgba(217, 119, 6, 0.1); color: var(--warning-color); }
        .btn-delete { background: rgba(220, 38, 38, 0.1); color: var(--danger-color); }

        .pagination .page-link {
            border: none;
            color: var(--text-secondary);
            margin: 0 0.125rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .pagination .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .pagination .page-link:hover {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary-color);
        }

        .filter-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--accent-color);
            margin-bottom: 1.5rem;
        }

        .sale-amount {
            font-weight: 700;
            color: var(--primary-color);
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
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        @media (max-width: 768px) {
            .main-header {
                padding: 1.5rem 0;
            }
            
            .stats-card {
                margin-bottom: 1rem;
            }
            
            .table-responsive {
                border-radius: 0;
            }
            
            .filter-card {
                padding: 1rem;
            }
        }

        .animate-in {
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
<header class="main-content">
         <div class="sale-header bg-white rounded-4 shadow-sm p-4 mb-4 border border-primary border-opacity-10">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                
                <div class="d-flex align-items-center flex-grow-1" style="min-width: 300px;">
                    
                    <div class="icon-container rounded-3 bg-primary d-flex align-items-center justify-content-center me-3 shadow">
                        <i class="fas fa-users text-white fs-4"></i>
                    </div>
                    
                    <div>
                        <h4 class="title-gradient fw-bold mb-1 fs-5">Gerer vos employes</h4>
                        <small class="text-muted fw-medium"> Suivi et gestion de toutes les transactions </small>
                    </div>
                </div>
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchProduct" class=" search-input" placeholder="Rechercher un employe...">
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
                            <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Se déconnecter
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
         <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card animate-in">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Total des Ventes</h6>
                            <h3 class="mb-0 fw-bold text-primary">{{$totalventes}} FCFA</h3>
                            <small class="text-success">
                                <i class="fas fa-arrow-up me-1"></i>
                                +12.5% ce mois
                            </small>
                        </div>
                        <div class="stats-icon bg-primary bg-opacity-10" >
                            <i class="fas fa-euro-sign text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card animate-in" style="animation-delay: 0.1s;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Nombre de Ventes</h6>
                            <h3 class="mb-0 fw-bold text-primary">{{$nbventes}}</h3>
                            <small class="text-success">
                                <i class="fas fa-arrow-up me-1"></i>
                                +8.3% ce mois
                            </small>
                        </div>
                        <div class="stats-icon bg-info bg-opacity-10">
                            <i class="fas fa-shopping-bag text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card animate-in" style="animation-delay: 0.2s;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Vente Moyenne</h6>
                            <h3 class="mb-0 fw-bold text-primary">{{$prixMoyenVentes}} FCFA</h3>
                            <small class="text-warning">
                                <i class="fas fa-minus me-1"></i>
                                -2.1% ce mois
                            </small>
                        </div>
                        <div class="stats-icon bg-warning bg-opacity-10">
                            <i class="fas fa-calculator text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card animate-in" style="animation-delay: 0.3s;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2 fw-medium">Clients Uniques</h6>
                            <h3 class="mb-0 fw-bold text-primary">789</h3>
                            <small class="text-success">
                                <i class="fas fa-arrow-up me-1"></i>
                                +15.7% ce mois
                            </small>
                        </div>
                        <div class="stats-icon bg-danger bg-opacity-10">
                            <i class="fas fa-users text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-card animate-in" style="animation-delay: 0.4s;">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
                    <div class="search-container">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" style="width:450px;" placeholder="Rechercher par client, référence...">
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 mb-3 mb-lg-0">
                    <select class="form-select">
                        <option>Tous les statuts</option>
                        <option>Complétée</option>
                        <option>En attente</option>
                        <option>Annulée</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-3 mb-3 mb-lg-0">
                    <select class="form-select">
                        <option>Cette semaine</option>
                        <option>Ce mois</option>
                        <option>Ce trimestre</option>
                        <option>Cette année</option>
                    </select>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <button class="btn btn-outline-primary me-2">
                        <i class="fas fa-filter me-1"></i>
                        Filtres
                    </button>
                    <button class="btn btn-primary-custom">
                        <i class="fas fa-download me-1"></i>
                        Exporter
                    </button>
                </div>
            </div>
        </div>

        <!-- Sales Table -->
        <div class="sales-table-container animate-in" style="animation-delay: 0.5s;">
            <div class="table-header p-4">
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
                    <tbody id="salesTableBody">
                        @foreach($sales as $sale)
                        <tr>
                            <td>
                                <div class="fw-semibold text-primary">{{$sale->id}}</div>
                                <small class="text-muted">{{$sale->mode_paiement}}</small>
                            </td>
                            <td>
                                <div class="client-info">
                                    <div class="client-avatar">
                                        {{ strtoupper(substr($sale->client_name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="fw-medium">{{$sale->client_name}}</div>
                                        <small class="text-muted">client</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="sale-amount">{{$sale->total}} FCFA</div>
                            </td>
                            <td>
                                {{$sale->status}}
                            </td>
                            <td>
                                <div class="text-muted">{{$sale->created_at}}</div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button class="action-btn btn-view" title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn btn-edit" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Affichage de <strong>1-10</strong> sur <strong>247</strong> ventes
            </div>
            <nav aria-label="Pagination">
                <ul class="pagination mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
@endsection