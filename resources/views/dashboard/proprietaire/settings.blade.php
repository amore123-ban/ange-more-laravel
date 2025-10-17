@extends('layouts.layout_proprio')

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
      --primary-color: #2563eb;
      --primary-light: #3b82f6;
      --primary-dark: #1d4ed8;
      --primary-subtle: rgba(37, 99, 235, 0.1);
      --primary-ghost: rgba(37, 99, 235, 0.05);
    }

    /* ===== STYLES NAVBAR ONGLETS ===== */
    .settings-header {
        background: linear-gradient(135deg, white 0%, #f8fafc 100%);
        border-bottom: 1px solid rgba(37, 99, 235, 0.1);
        box-shadow: 0 2px 10px rgba(37, 99, 235, 0.08);
        margin-left: var(--sidebar-width);
        margin-bottom: 1.5rem;
        margin-top: 1rem;
        border-radius: 0.75rem;
        border: 2px solid #2563eb;
    }

    .settings-icon {
        width: 3rem;
        height: 3rem;
        background: var(--primary-subtle);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        margin-right: 1rem;
    }

    .nav-tabs-custom {
        border-bottom: 2px solid #e9ecef;
        background: white;
        border-radius: 0.75rem 0.75rem 0 0;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
        height: 60px;
        flex-wrap: nowrap;
        margin-left: var(--sidebar-width);
    }

    .nav-tabs-custom .nav-link {
        border: none;
        color: #6b7280;
        font-weight: 500;
        padding: 1.25rem 2rem;
        border-radius: 0;
        transition: all 0.3s ease;
        position: relative;
        white-space: nowrap;
        min-width: fit-content;
    }

    .nav-tabs-custom .nav-link:hover {
        color: var(--primary-color);
        background: var(--primary-ghost);
        border-color: transparent;
    }

    .nav-tabs-custom .nav-link.active {
        color: var(--primary-color);
        background: var(--primary-ghost);
        border-color: transparent;
        font-weight: 600;
    }

    .nav-tabs-custom .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        border-radius: 2px 2px 0 0;
    }

    .tab-icon {
        margin-right: 0.5rem;
        font-size: 1.1em;
    }

    .tab-content-custom {
        background: white;
        border-radius: 0 0 0.75rem 0.75rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        min-height: 500px;
        margin-left: var(--sidebar-width);
    }

    .content-card {
        background: white;
        border-radius: 0.75rem;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }

    .content-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.1);
    }

    .badge-custom {
        background: var(--primary-subtle);
        color: var(--primary-color);
        font-weight: 500;
        padding: 0.375rem 0.75rem;
        border-radius: 2rem;
    }

    .btn-primary-custom {
        background: var(--primary-color);
        border-color: var(--primary-color);
        border-radius: 0.5rem;
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
    }

    .btn-primary-custom:hover {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        color: white;
    }

    .fade-in {
        animation: fadeIn 0.4s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .main-content {
      margin-left: 0;
      padding: 0;
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
      color: var(--primary-color);
      margin: 0;
    }

    .welcome-text span {
      color: var(--secondary-color);
    }

    .search-container {
      position: relative;
      max-width: 350px;
      width: 100%;
    }

    .search-input {
      border-radius: 40px;
      border: 1px solid #e0e0e0;
      height: 40px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
      transition: var(--transition);
    }

    .search-input:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.12);
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%; 
      transform: translateY(-50%);
      color: #a0a0a0;
    }

    .user-profile {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .user-avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background-color: var(--accent-color);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
    }

    /* ===== CARTES BOUTIQUE COMPACTES ===== */
    .shop-card {
        background: white;
        border-radius: var(--card-radius);
        padding: 1.2rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
        transition: var(--transition);
        height: 100%;
        position: relative;
        overflow: hidden;
        min-height: 220px;
    }

    .shop-card::before {
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

    .shop-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.12);
        border-color: var(--primary-blue);
    }

    .shop-card:hover::before {
        transform: scaleX(1);
    }

    .shop-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        margin-bottom: 0.8rem;
        position: relative;
        overflow: hidden;
    }

    .shop-icon::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
        transform: rotate(45deg);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }

    .shop-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.4rem;
        line-height: 1.3;
    }

    .shop-description {
        color: #64748b;
        font-size: 0.85rem;
        margin-bottom: 0.8rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .shop-stats {
        display: flex;
        gap: 0.8rem;
        margin-bottom: 0.8rem;
        padding: 0.6rem 0;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
    }

    .stat-item {
        text-align: center;
        flex: 1;
    }

    .stat-value {
        font-size: 1rem;
        font-weight: 600;
        color: var(--primary-blue);
        display: block;
        line-height: 1.2;
    }

    .stat-label {
        font-size: 0.7rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .shop-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-access {
        flex: 1;
        background: var(--primary-blue);
        color: white;
        border: none;
        padding: 0.5rem 0.8rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: var(--transition);
    }

    .btn-access:hover {
        background: var(--primary-blue-dark);
        transform: translateY(-1px);
        color: white;
    }

    .btn-manage {
        width: 36px;
        height: 36px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        transition: var(--transition);
    }

    .btn-manage:hover {
        background: var(--primary-blue);
        color: white;
        border-color: var(--primary-blue);
    }

    .status-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 0.25rem 0.5rem;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .status-active {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    /* ===== CARTE CRÉATION AVEC ANIMATIONS ===== */
    .create-shop-card {
        background: linear-gradient(135deg, #f8fafc, #e2e8f0);
        border: 2px dashed #cbd5e1;
        border-radius: var(--card-radius);
        padding: 1.5rem;
        text-align: center;
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 220px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .create-shop-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.1), transparent);
        transition: left 0.6s ease;
    }

    .create-shop-card:hover::before {
        left: 100%;
    }

    .create-shop-card:hover {
        border-color: var(--primary-blue);
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.15);
    }

    .create-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.6rem;
        margin-bottom: 0.8rem;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .create-icon::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.6s ease;
    }

    .create-shop-card:hover .create-icon {
        transform: scale(1.1) rotate(360deg);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
    }

    .create-shop-card:hover .create-icon::before {
        width: 100%;
        height: 100%;
    }

    .create-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.4rem;
        transition: var(--transition);
    }

    .create-shop-card:hover .create-title {
        color: var(--primary-blue);
        transform: translateY(-2px);
    }

    .create-subtitle {
        color: #64748b;
        font-size: 0.85rem;
        line-height: 1.4;
        transition: var(--transition);
    }

    .create-shop-card:hover .create-subtitle {
        color: #475569;
    }

    /* Animation d'apparition des cartes */
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

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .animate-delay-1 { animation-delay: 0.1s; }
    .animate-delay-2 { animation-delay: 0.2s; }
    .animate-delay-3 { animation-delay: 0.3s; }

    /* Animation de pulsation pour attirer l'attention */
    @keyframes pulse-create {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    .create-shop-card {
        animation: pulse-create 3s ease-in-out infinite;
    }

    .create-shop-card:hover {
        animation: none;
    }

    /* Effet de particules flottantes */
    .create-shop-card::after {
        content: '✨';
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 1.2rem;
        opacity: 0;
        animation: float-sparkle 2s ease-in-out infinite;
    }

    @keyframes float-sparkle {
        0%, 100% {
            opacity: 0;
            transform: translateY(0px);
        }
        50% {
            opacity: 1;
            transform: translateY(-10px);
        }
    }

    .create-shop-card:hover::after {
        animation: float-sparkle 1s ease-in-out infinite;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
            padding: 12px;
        }
        
        .settings-header {
            margin-left: 0;
        }
        
        .nav-tabs-custom {
            margin-left: 0;
            border-radius: 0;
        }
        
        .tab-content-custom {
            margin-left: 0;
            border-radius: 0;
        }

        .nav-tabs-custom .nav-link {
            padding: 1rem 1.25rem;
            font-size: 0.9rem;
        }

        .shop-card, .create-shop-card {
            padding: 1rem;
            min-height: 200px;
        }

        .shop-icon, .create-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .create-icon {
            width: 56px;
            height: 56px;
            font-size: 1.4rem;
        }

        .shop-stats {
            flex-direction: row;
            gap: 0.5rem;
        }

        .shop-actions {
            flex-direction: row;
        }
        
        .tab-icon {
            margin-right: 0.25rem;
        }
    }

    @media (max-width: 576px) {
        .nav-tabs-custom .nav-link {
            padding: 0.875rem 1rem;
            font-size: 0.85rem;
        }
    }
</style>
<div class="main-content">
    <div class="container-fluid">
        
<!-- Header de la section Paramètres -->
        <div class="settings-header">
            <div class="container-fluid py-4">
                <div class="d-flex align-items-center">
                    <div class="settings-icon">
                        <i class="fas fa-cog fa-lg"></i>
                    </div>
                    <div>
                        <h1 class="h3 mb-1 fw-semibold">Paramètres</h1>
                        <p class="text-muted mb-0">Gérez vos boutiques, profil et abonnements</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation par onglets -->
        <div class="flex-grow-1">
            <div class="container-fluid p-0">
                <ul class="nav nav-tabs nav-tabs-custom" id="settingsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="boutiques-tab" data-bs-toggle="tab" data-bs-target="#boutiques" type="button" role="tab">
                            <i class="fas fa-store tab-icon"></i>Mes Boutiques
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab">
                            <i class="fas fa-user tab-icon"></i>Profil
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="abonnements-tab" data-bs-toggle="tab" data-bs-target="#abonnements" type="button" role="tab">
                            <i class="fas fa-crown tab-icon"></i>Mes Abonnements
                        </button>
                    </li>
                </ul>

                <div class="tab-content tab-content-custom mt-3" id="settingsTabContent">
                    <div class="tab-pane fade show active fade-in" id="boutiques" role="tabpanel">
                        <div class="main-content">
                            <div class="container-fluid">
                                

                                @if(Auth::user()->role === 'proprietaire')
                                    <div class="row g-4">
                                        @forelse($shops as $shop)
                                            <div class="col-lg-4 col-md-6">
                                                <div class="shop-card">
                                                    <span class="status-badge status-active">Actif</span>
                                                    <div class="shop-icon">
                                                        <i class="fas fa-store"></i>
                                                    </div>
                                                    <h3 class="shop-name">{{ $shop->nom }}</h3>
                                                    <p class="shop-description">{{ $shop->description ?? 'Aucune description' }}</p>
                                                    
                                                    <div class="shop-stats">
                                                        <div class="stat-item">
                                                            <span class="stat-value"></span>
                                                            <span class="stat-label">Produits</span>
                                                        </div>
                                                        <div class="stat-item">
                                                            <span class="stat-value"></span>
                                                            <span class="stat-label">Ventes</span>
                                                        </div>
                                                        <div class="stat-item">
                                                            <span class="stat-value"></span>
                                                            <span class="stat-label">Note</span>
                                                        </div>
                                                    </div>

                                                    <div class="shop-actions">
                                                        <form action="{{ route('shop-selected', $shop->id)  }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                                            <button class="btn btn-access" type="submit">
                                                                <i class="fas fa-arrow-right me-2"></i>Accéder
                                                            </button>
                                                        </form>
                                                        <button class="btn btn-manage">
                                                            <i class="fas fa-cog"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="empty-state">
                                                <i class="fas fa-store-slash"></i>
                                                <h4>Aucune boutique trouvée</h4>
                                                <p>Créez votre première boutique pour commencer à vendre.</p>
                                                <a href="{{ route('shop.create') }}" class="btn btn-primary mt-3">
                                                    <i class="fas fa-plus"></i> Créer une boutique
                                                </a>
                                            </div>
                                        @endforelse
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="create-shop-card animate-fade-in-up animate-delay-2" onclick="createNewShop()">
                                                <div class="create-icon">
                                                    <i class="fas fa-plus"></i>
                                                </div>
                                                <h3 class="create-title">🚀 Créer une nouvelle boutique</h3>
                                                <p class="create-subtitle">Lancez votre nouvelle boutique en ligne en quelques clics et commencez à vendre immédiatement</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning text-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Vous n'avez pas la permission de voir cette section.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Onglet Profil -->
                    <div class="tab-pane fade" id="profil" role="tabpanel">
                        <div class="p-4">
                            <h4 class="mb-4">Informations du Profil</h4>
                            
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="content-card p-4 text-center">
                                            <i class="fas fa-user fs-2 text-primary"></i>
                                        <h5 class="mb-1">{{ Auth::user()->name ?? 'Utilisateur' }}</h5>
                                        <p class="text-muted mb-3">{{ Auth::user()->role ?? 'Membre' }}</p>
                                        <button class="btn btn-outline-primary btn-sm">Changer la photo</button>
                                    </div>
                                </div>
                                
                                <div class="col-md-8">
                                    <div class="content-card p-4">
                                        <form method="POST" action="">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Nom</label>
                                                    <input type="text" class="form-control" value="{{ Auth::user()->name ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control" value="{{ Auth::user()->email ?? '' }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Téléphone</label>
                                                    <input type="tel" class="form-control"value="{{ Auth::user()->telephone ?? '' }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Bio</label>
                                                    <textarea class="form-control" rows="3" placeholder="Parlez-nous de vous..."></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-outline-primary">Sauvegarder</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Onglet Mes Abonnements -->
                    <div class="tab-pane fade" id="abonnements" role="tabpanel">
                        <div class="p-4">
                            <h4 class="mb-4">Mes Abonnements</h4>
                            
                            <div class="row g-4">
                                <div class="col-lg-4">
                                    <div class="content-card p-4 border border-primary border-2">
                                        <div class="text-center mb-3">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: fit-content;">
                                                <i class="fas fa-crown text-primary fa-2x"></i>
                                            </div>
                                            <h5 class="text-primary">Plan Premium</h5>
                                            <p class="text-muted mb-0">Abonnement actuel</p>
                                        </div>
                                        <div class="text-center mb-4">
                                            <span class="h3 fw-bold">29€</span>
                                            <span class="text-muted">/mois</span>
                                        </div>
                                        <ul class="list-unstyled mb-4">
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Boutiques illimitées</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Analytics avancées</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Support prioritaire</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Intégrations premium</li>
                                        </ul>
                                        <div class="text-center">
                                            <button class="btn btn-outline-primary w-100">Gérer l'abonnement</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-8">
                                    <div class="content-card p-4">
                                        <h5 class="mb-3">Historique des paiements</h5>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Montant</th>
                                                        <th>Statut</th>
                                                        <th>Facture</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>15 Jan 2024</td>
                                                        <td>29€</td>
                                                        <td><span class="badge bg-success">Payé</span></td>
                                                        <td><a href="#" class="text-primary">Télécharger</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>15 Déc 2023</td>
                                                        <td>29€</td>
                                                        <td><span class="badge bg-success">Payé</span></td>
                                                        <td><a href="#" class="text-primary">Télécharger</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>15 Nov 2023</td>
                                                        <td>29€</td>
                                                        <td><span class="badge bg-success">Payé</span></td>
                                                        <td><a href="#" class="text-primary">Télécharger</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.shop-card, .create-shop-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 150);
        });
    });

    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function (e) {
            const targetPane = document.querySelector(e.target.getAttribute('data-bs-target'));
            targetPane.classList.add('fade-in');
            
            setTimeout(() => {
                targetPane.classList.remove('fade-in');
            }, 400);
        });
    });
    function createNewShop() {
        const createCard = document.querySelector('.create-shop-card');
        createCard.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            createCard.style.transform = 'translateY(-3px) scale(1.02)';
            
            window.location.href = "{{ route('shop.create') }}";
        }, 150);
    }

    function handleTabsScroll() {
        const tabsContainer = document.querySelector('.nav-tabs-custom');
        if (tabsContainer && tabsContainer.scrollWidth > tabsContainer.clientWidth) {
            tabsContainer.style.justifyContent = 'flex-start';
        } else if (tabsContainer) {
            tabsContainer.style.justifyContent = 'center';
        }
    }

    window.addEventListener('resize', handleTabsScroll);
    document.addEventListener('DOMContentLoaded', handleTabsScroll);

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'info' ? '#2563eb' : '#10b981'};
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            z-index: 9999;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateX(100%);
            transition: transform 0.3s ease;
        `;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
</script>

@endsection