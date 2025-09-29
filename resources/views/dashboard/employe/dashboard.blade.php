@extends('layouts.layout_employe')

@section('content')
<style>
    :root {
        --brand: #2563eb;
        --brand-700: #1e40af;
        --brand-500: #3b82f6;
        --brand-400: #60a5fa;
        --brand-100: #dbeafe;
        --brand-50: #eff6ff;
        --bg: #f8fafc;
        --card: #ffffff;
        --text: #0f172a;
        --text-light: #475569;
        --muted: #64748b;
        --border: #e2e8f0;
        --success: #10b981;
        --success-light: #34d399;
        --warning: #f59e0b;
        --warning-light: #fbbf24;
        --danger: #ef4444;
        --danger-light: #f87171;
        --info: #06b6d4;
        --info-light: #22d3ee;
        --sidebar-width: 280px;
        --radius: 12px;
        --radius-lg: 16px;
        --shadow-sm: 0 2px 8px rgba(15, 23, 42, 0.06);
        --shadow-md: 0 6px 20px rgba(15, 23, 42, 0.10);
        --shadow-lg: 0 15px 35px rgba(15, 23, 42, 0.12);
        --shadow-xl: 0 20px 45px rgba(15, 23, 42, 0.18);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-fast: all 0.15s ease-out;
    }

    body {
        font-family: 'poppins', sans-serif;
        letter-spacing: -0.01em;
    }

    .main-content {
        margin-left: var(--sidebar-width);
        padding: 20px;
        background: linear-gradient(135deg, var(--bg) 0%, #f1f5f9 100%);
        min-height: 100vh;
        position: relative;
        transition: all 0.3s ease;
    }

    .main-content::before {
        content: '';
        position: fixed;
        top: 0;
        left: var(--sidebar-width);
        right: 0;
        height: 150px;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.04) 0%, rgba(59, 130, 246, 0.02) 100%);
        z-index: -1;
    }

    .dashboard-topbar {
        background: linear-gradient(135deg, var(--card) 0%, rgba(255, 255, 255, 0.95) 100%);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        padding: 16px 20px;
        margin-bottom: 20px;
        border: 1px solid rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        position: relative;
        overflow: hidden;
    }

    .dashboard-topbar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--brand), var(--brand-400), var(--info));
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
    }

    .dashboard-topbar h4 {
        color: var(--text);
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 2px;
        background: linear-gradient(135deg, var(--text), var(--text-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .dashboard-topbar small {
        color: var(--muted);
        font-weight: 500;
        font-size: 0.825rem;
    }

    .employee-badge {
        background: linear-gradient(135deg, var(--success), var(--success-light));
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 10px;
    }

    .stats-card {
        background: linear-gradient(135deg, var(--card) 0%, rgba(255, 255, 255, 0.9) 100%);
        border-radius: var(--radius-lg);
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        margin-bottom: 16px;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--brand), transparent);
        opacity: 0;
        transition: var(--transition);
    }

    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: rgba(37, 99, 235, 0.2);
    }

    .stats-card:hover::before {
        opacity: 1;
    }

    .stats-card .card-body {
        padding: 18px;
    }

    .icon-wrapper {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        position: relative;
        overflow: hidden;
        margin-bottom: 12px;
    }

    .icon-wrapper::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }

    .icon-wrapper.primary {
        background: linear-gradient(135deg, var(--brand), var(--brand-500));
    }

    .icon-wrapper.success {
        background: linear-gradient(135deg, var(--success), var(--success-light));
    }

    .icon-wrapper.warning {
        background: linear-gradient(135deg, var(--warning), var(--warning-light));
    }

    .icon-wrapper.danger {
        background: linear-gradient(135deg, var(--danger), var(--danger-light));
    }

    .stats-number {
        font-size: 1.8rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--text), var(--brand));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 3px;
        line-height: 1.2;
    }

    .stats-label {
        color: var(--muted);
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 6px;
    }

    .stats-description {
        color: var(--text-light);
        font-size: 0.8rem;
        line-height: 1.3;
    }

    .activity-card {
        background: linear-gradient(135deg, var(--card) 0%, rgba(255, 255, 255, 0.95) 100%);
        border-radius: var(--radius-lg);
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: var(--shadow-md);
        margin-bottom: 16px;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .activity-header {
        background: linear-gradient(135deg, var(--brand), var(--brand-500));
        padding: 14px 18px;
        color: white;
        position: relative;
    }

    .activity-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    }

    .activity-item {
        padding: 14px 18px;
        border-bottom: 1px solid var(--border);
        transition: var(--transition);
        position: relative;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item:hover {
        background: var(--brand-50);
        transform: translateX(3px);
    }

    .activity-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        position: relative;
        overflow: hidden;
    }

    .activity-icon.success {
        background: linear-gradient(135deg, var(--success), var(--success-light));
    }

    .activity-icon.info {
        background: linear-gradient(135deg, var(--info), var(--info-light));
    }

    .activity-icon.warning {
        background: linear-gradient(135deg, var(--warning), var(--warning-light));
    }

    .activity-content h6 {
        font-weight: 600;
        color: var(--text);
        margin-bottom: 2px;
        font-size: 0.875rem;
    }

    .activity-content p {
        color: var(--text-light);
        margin-bottom: 3px;
        font-size: 0.8rem;
    }

    .activity-time {
        color: var(--muted);
        font-size: 0.7rem;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
            padding: 14px;
        }
        
        .dashboard-topbar {
            padding: 14px 16px;
            text-align: center;
        }
        
        .stats-card .card-body {
            padding: 16px;
        }
        
        .stats-number {
            font-size: 1.5rem;
        }

        .icon-wrapper {
            width: 40px;
            height: 40px;
        }
    }
</style>

<div class="main-content">
    <div class="container-fluid">
        <div class="dashboard-topbar d-flex justify-content-between align-items-center animate-fade-in-up">
            <div>
                <h4>Tableau de bord Employé <span class="employee-badge">EMPLOYÉ</span></h4>
                <small>Vue d'ensemble de votre activité en tant qu'employé</small>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar me-2 align-items-center">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="d-none d-md-block text-start me-2">
                            <div class="fw-semibold small">{{ Auth::user()->name ?? 'Utilisateur' }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Employé</div>
                        </div>
                    </button>
                    
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" style="min-width: 280px;">
                        <li class="bg-primary text-white p-3 rounded-top">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar-small me-3">
                                    <i class="fas fa-user"></i>
                                </div>
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

        <div class="row">
            <div class="col-md-4 col-lg-4 mb-3">
                <div class="stats-card animate-fade-in-up animate-delay-1">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="more">
                            <div class="stats-label">Ventes aujourd'hui</div>
                            <div class="stats-number">{{ $nbventes }}</div>
                            <div class="stats-description">Ventes effectuées aujourd'hui</div>
                        </div>
                        <div class="icon-wrapper bg-primary bg-opacity-10">
                            <i class="fas fa-shopping-cart text-primary" style="font-size: 1.2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-lg-4 mb-3">
                <div class="stats-card animate-fade-in-up animate-delay-1">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="more">
                            <div class="stats-label">Produits en stock</div>
                            <div class="stats-number">{{ $en_stock }}</div>
                            <div class="stats-description">Produits disponibles</div>
                        </div>
                        <div class="icon-wrapper bg-success bg-opacity-10">
                            <i class="fas fa-boxes text-success" style="font-size: 1.2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 mb-3">
                <div class="stats-card animate-fade-in-up animate-delay-1">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="more">
                            <div class="stats-label">Stock faible</div>
                            <div class="stats-number">{{ $faible }}</div>
                            <div class="stats-description">Produits à réapprovisionner</div>
                        </div>
                        <div class="icon-wrapper bg-warning bg-opacity-10">
                            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 1.2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 mb-3">
                <div class="activity-card animate-fade-in-up animate-delay-4">
                    <div class="activity-header">
                        <h5 class="text-white mb-0" style="font-size: 1rem;">
                            <i class="fas fa-bolt me-2"></i>Activité Récente
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon success">
                                    <i class="fas fa-shopping-cart text-white" style="font-size: 0.9rem;"></i>
                                </div>
                                <div class="activity-content flex-grow-1">
                                    <h6>💰 Nouvelle vente</h6>
                                    <p>Vente effectuée avec succès</p>
                                    <small class="activity-time">Il y a quelques minutes</small>
                                </div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon info">
                                    <i class="fas fa-box text-white" style="font-size: 0.9rem;"></i>
                                </div>
                                <div class="activity-content flex-grow-1">
                                    <h6>📦 Gestion des produits</h6>
                                    <p>Produits mis à jour dans le stock</p>
                                    <small class="activity-time">Il y a 1 heure</small>
                                </div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon warning">
                                    <i class="fas fa-exclamation-triangle text-white" style="font-size: 0.9rem;"></i>
                                </div>
                                <div class="activity-content flex-grow-1">
                                    <h6>⚠️ Stock faible</h6>
                                    <p>Certains produits nécessitent un réapprovisionnement</p>
                                    <small class="activity-time">Il y a 2 heures</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="activity-card animate-fade-in-up animate-delay-4">
                    <div class="activity-header">
                        <h5 class="text-white mb-0" style="font-size: 1rem;">
                            <i class="fas fa-info-circle me-2"></i>Informations Boutique
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon info">
                                    <i class="fas fa-store text-white" style="font-size: 0.9rem;"></i>
                                </div>
                                <div class="activity-content flex-grow-1">
                                    <h6>🏪 {{ $shop->nom ?? 'Boutique' }}</h6>
                                    <p>{{ $shop->adresse ?? 'Adresse non renseignée' }}</p>
                                    <small class="activity-time">Votre boutique assignée</small>
                                </div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <div class="activity-icon success">
                                    <i class="fas fa-phone text-white" style="font-size: 0.9rem;"></i>
                                </div>
                                <div class="activity-content flex-grow-1">
                                    <h6>📞 Contact</h6>
                                    <p>{{ $shop->telephone ?? 'Téléphone non renseigné' }}</p>
                                    <small class="activity-time">Contact boutique</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- Section Statistiques -->
<section id="statistiques" class="mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="stats-card">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4">
                            <i class="fas fa-chart-bar text-primary me-2"></i>
                            Statistiques Détaillées
                        </h4>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h6 class="fw-semibold mb-3">Performance des Ventes</h6>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Total des ventes:</span>
                                    <strong class="text-primary">{{ $nbventes }}</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Chiffre d'affaires:</span>
                                    <strong class="text-success">{{ number_format($totalventes, 0, ',', ' ') }} FCFA</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Vente moyenne:</span>
                                    <strong class="text-info">{{ $nbventes > 0 ? number_format($totalventes / $nbventes, 0, ',', ' ') : 0 }} FCFA</strong>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <h6 class="fw-semibold mb-3">État du Stock</h6>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Total produits:</span>
                                    <strong class="text-primary">{{ $nbprods }}</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>En stock:</span>
                                    <strong class="text-success">{{ $en_stock }}</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Stock faible:</span>
                                    <strong class="text-warning">{{ $faible }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection