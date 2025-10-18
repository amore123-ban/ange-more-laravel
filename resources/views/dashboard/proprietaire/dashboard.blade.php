@extends('layouts.layout_proprio')

@section('content')
@php
use Illuminate\Support\Str;
@endphp

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

  

    .online-dot {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 12px;
    height: 12px;
    background: #10b981;
    border: 2px solid white;
    border-radius: 50%;
  }

    .user-avatar-small {
    width: 36px;
    height: 36px;
  }

    .dropdown-toggle::after {
        transition: transform 0.3s ease;
    }

    .dropdown-toggle[aria-expanded="true"]::after {
        transform: rotate(180deg);
    }

  .more-icon{
    color: var(--brand-700);
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

  .icon-wrapper.info {
    background: linear-gradient(135deg, var(--info), var(--info-light));
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

  .stats-trend {
    display: inline-flex;
    align-items: center;
    padding: 3px 6px;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
    margin-top: 6px;
  }

  .stats-trend.positive {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
  }

  .stats-trend.negative {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger);
  }

  .chart-card {
    background: linear-gradient(135deg, var(--card) 0%, rgba(255, 255, 255, 0.95) 100%);
    border-radius: var(--radius-lg);
    border: 1px solid rgba(255, 255, 255, 0.8);
    box-shadow: var(--shadow-md);
    transition: var(--transition);
    margin-bottom: 16px;
    backdrop-filter: blur(10px);
    overflow: hidden;
  }

  .chart-card:hover {
    box-shadow: var(--shadow-lg);
  }

  .chart-header {
    padding: 18px 18px 0;
    border-bottom: 1px solid var(--border);
    margin-bottom: 16px;
  }

  .chart-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 3px;
  }

  .chart-subtitle {
    color: var(--muted);
    font-size: 0.8rem;
  }

  .period-buttons {
    display: flex;
    background: var(--bg);
    border-radius: 10px;
    padding: 3px;
    gap: 3px;
  }

  .period-btn {
    background: transparent;
    border: none;
    padding: 6px 12px;
    border-radius: 7px;
    font-weight: 500;
    color: var(--muted);
    transition: var(--transition-fast);
    cursor: pointer;
    font-size: 0.8rem;
  }

  .period-btn.active,
  .period-btn:hover {
    background: var(--brand);
    color: white;
    box-shadow: 0 2px 6px rgba(37, 99, 235, 0.3);
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

  .activity-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.5s ease;
  }

  .activity-item:hover .activity-icon::before {
    left: 100%;
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

  /* ===== Table Compacte ===== */
  .table-card {
    background: linear-gradient(135deg, var(--card) 0%, rgba(255, 255, 255, 0.95) 100%);
    border-radius: var(--radius-lg);
    border: 1px solid rgba(255, 255, 255, 0.8);
    box-shadow: var(--shadow-md);
    margin-bottom: 16px;
    overflow: hidden;
    backdrop-filter: blur(10px);
  }

  .table-header {
    padding: 18px;
    border-bottom: 1px solid var(--border);
    background: linear-gradient(135deg, var(--bg), rgba(248, 250, 252, 0.5));
  }

  .table-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 3px;
  }

  .table-subtitle {
    color: var(--muted);
    font-size: 0.8rem;
  }

  .premium-table {
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
  }

  .premium-table thead th {
    background: linear-gradient(135deg, var(--bg), rgba(248, 250, 252, 0.8));
    padding: 12px 18px;
    font-weight: 600;
    color: var(--text);
    border-bottom: 2px solid var(--border);
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .premium-table tbody tr {
    transition: var(--transition);
  }

  .premium-table tbody tr:hover {
    background: linear-gradient(135deg, var(--brand-50), rgba(239, 246, 255, 0.5));
    transform: scale(1.01);
  }

  .premium-table tbody td {
    padding: 12px 18px;
    border-bottom: 1px solid var(--border);
    font-weight: 500;
    color: var(--text-light);
    font-size: 0.875rem;
  }

  .action-btn {
    background: var(--brand-50);
    color: var(--brand);
    border: 2px solid var(--brand-100);
    border-radius: 8px;
    padding: 6px 10px;
    transition: var(--transition);
    cursor: pointer;
    font-size: 0.8rem;
  }

  .action-btn:hover {
    background: var(--brand);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(37, 99, 235, 0.3);
  }

  .btn-premium {
    background: linear-gradient(135deg, var(--brand), var(--brand-500));
    border: none;
    color: white;
    font-weight: 600;
    padding: 10px 18px;
    border-radius: 10px;
    transition: var(--transition);
    box-shadow: 0 3px 10px rgba(37, 99, 235, 0.3);
    position: relative;
    overflow: hidden;
    font-size: 0.875rem;
  }

  .btn-premium::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
  }

  .btn-premium:hover::before {
    left: 100%;
  }

  .btn-premium:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
  }

  .btn-outline-premium {
    background: transparent;
    border: 2px solid var(--brand);
    color: var(--brand);
    font-weight: 600;
    padding: 8px 16px;
    border-radius: 10px;
    transition: var(--transition);
    font-size: 0.8rem;
  }

  .btn-outline-premium:hover {
    background: var(--brand);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
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

  .animate-fade-in-up {
    animation: fadeInUp 0.5s ease-out;
  }

  .animate-delay-1 { animation-delay: 0.1s; }
  .animate-delay-2 { animation-delay: 0.2s; }
  .animate-delay-3 { animation-delay: 0.3s; }
  .animate-delay-4 { animation-delay: 0.4s; }

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
        <h4> Tableau de bord</h4>
        <small>Vue d'ensemble de votre activité en temps réel</small>
      </div>
      <div class="position-relative">
        <i class="fas fa-store more-icon position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); z-index: 10;"></i>
        <form action="{{ route('dashboard') }}" method="GET" id="boutiqueFilterForm">    
          <select name="boutique_id" id="boutiqueSelect" class="boutique-selector ps-4">
            @if($shop)
              <option value="{{ $shop->id }}" 
                  {{ request('shop_id') == $shop->id ? 'selected' : '' }}>
                  <i class="fas fa-store text-primary fs-4"></i>{{ $shop->nom }}
              </option>
            @endif
          </select>
        </form>
      </div>
      <div class="d-flex align-items-center gap-3">
        <div class="dropdown">
            <button class=" boutique-selector dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-avatar me-2 align-items-center">
                  {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="d-none d-md-block text-start me-2">
                    <div class="fw-semibold small">{{ Auth::user()->name ?? 'Utilisateur' }}</div>
                    <div class="text-muted" style="font-size: 0.75rem;">{{ Auth::user()->role ?? 'Administrateur' }}</div>
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
    </div>
    <div class="row">
      <div class="col-md-4 col-lg-4 mb-3">
        <div class="stats-card animate-fade-in-up animate-delay-1">
          <div class="card-body  d-flex justify-content-between align-items-center">
           <div class="more">
            <div class="stats-label">Ventes ce mois</div>
              <div class="stats-number">{{$nbventes}}</div>
              <div class="stats-description">Excellent performance ce mois-ci</div>
              <div class="stats-trend positive">
                <i class="fas fa-chart-line me-1"></i>
                Données en temps réel
              </div>
            </div>
            <div class="icon-wrapper bg-primary bg-opacity-10">
              <i class="fas fa-shopping-cart text-primary" style="font-size: 1.2rem;"></i>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4 col-lg-4 mb-3">
        <div class="stats-card animate-fade-in-up animate-delay-1">
          <div class="card-body  d-flex justify-content-between align-items-center">
           <div class="more">
            <div class="stats-label">Produits en stock</div>
              <div class="stats-number">{{$en_stock}}</div>
              <div class="stats-description">Excellent performance ce mois-ci</div>
              <div class="stats-trend positive">
                <i class="fas fa-chart-line me-1"></i>
                Données en temps réel
              </div>
            </div>
            <div class="icon-wrapper bg-success bg-opacity-10">
              <i class="fas fa-boxes text-success" style="font-size: 1.2rem;"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-lg-4 mb-3">
        <div class="stats-card animate-fade-in-up animate-delay-1">
          <div class="card-body  d-flex justify-content-between align-items-center">
           <div class="more">
            <div class="stats-label">Chiffre d'affaires</div>
              <div class="stats-number">{{$totalventes}} FCFA</div>
              <div class="stats-description">Excellent performance ce mois-ci</div>
              <div class="stats-trend positive">
                <i class="fas fa-chart-line me-1"></i>
                Données en temps réel
              </div>
            </div>
            <div class="icon-wrapper bg-warning bg-opacity-10">
              <i class="fas fa-shopping-cart text-warning" style="font-size: 1.2rem;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 mb-3">
        <div class="chart-card animate-fade-in-up animate-delay-4">
          <div class="chart-header">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <h5 class="chart-title">📈 Évolution des ventes</h5>
                <p class="chart-subtitle">Analyse des performances sur la période sélectionnée</p>
              </div>
              <div class="period-buttons">
                <a href="{{ route('dashboard', ['period' => 7]) }}" 
                  class="period-btn {{ $period == 7 ? 'active' : '' }} text-decoration-none">7j</a>

                <a href="{{ route('dashboard', ['period' => 30]) }}" 
                  class="period-btn {{ $period == 30 ? 'active' : '' }} text-decoration-none">30j</a>

                <a href="{{ route('dashboard', ['period' => 90]) }}" 
                  class="period-btn {{ $period == 90 ? 'active' : '' }} text-decoration-none">3m</a>
              </div>
            </div>
          </div>
          <div class="card-body" style="padding: 16px;">
            <canvas id="salesChart" style="height: 250px;"></canvas>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-3">
        <div class="activity-card animate-fade-in-up animate-delay-4">
          <div class="activity-header">
            <h5 class="text-white mb-0" style="font-size: 1rem;">
              <i class="fas fa-bolt me-2"></i>Activité Récente
            </h5>
          </div>
          <div class="card-body p-0">
            @if($sales->count() > 0)
              @foreach($sales->take(3) as $sale)
                <div class="activity-item">
                  <div class="d-flex align-items-center">
                    <div class="activity-icon success">
                      <i class="fas fa-shopping-cart text-white" style="font-size: 0.9rem;"></i>
                    </div>
                    <div class="activity-content flex-grow-1">
                      <h6>💰 Nouvelle vente</h6>
                      <p>{{ $sale->client_name }} - {{ number_format($sale->total, 0, ',', ' ') }} FCFA</p>
                      <small class="activity-time">{{ $sale->created_at->diffForHumans() }}</small>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <div class="activity-item">
                <div class="d-flex align-items-center">
                  <div class="activity-icon info">
                    <i class="fas fa-info-circle text-white" style="font-size: 0.9rem;"></i>
                  </div>
                  <div class="activity-content flex-grow-1">
                    <h6>📊 Aucune activité récente</h6>
                    <p>Commencez par enregistrer votre première vente</p>
                    <small class="activity-time">Aujourd'hui</small>
                  </div>
                </div>
              </div>
            @endif

            @if($faibles->count() > 0)
              <div class="activity-item">
                <div class="d-flex align-items-center">
                  <div class="activity-icon warning">
                    <i class="fas fa-exclamation-triangle text-white" style="font-size: 0.9rem;"></i>
                  </div>
                  <div class="activity-content flex-grow-1">
                    <h6>⚠️ Stock faible</h6>
                    <p>{{ $faibles->count() }} produit(s) nécessitent un réapprovisionnement</p>
                    <small class="activity-time">Attention requise</small>
                  </div>
                </div>
              </div>
            @endif

            <div class="text-center p-3">
              <button class="btn-outline-premium">
                <i class="fas fa-eye me-1"></i>Voir tout
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="table-card animate-fade-in-up animate-delay-4">
          <div class="table-header">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h5 class="table-title "> <p class=" ps-2 border-3 border-start border-primary">Alerte Stock</p></h5>
                <p class="table-subtitle">Produits nécessitant un réapprovisionnement</p>
              </div>
              <a href="{{ route('produit')}}" class="btn-premium text-decoration-none" href="/produits">
                <i class="fas fa-plus me-1"></i>Réapprovisionner
              </a>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="premium-table w-100">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nom du produit</th>
                  <th>Catégorie</th>
                  <th>Prix unitaire</th>
                  <th>Stock restant</th>
                  <th>Statut</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($faibles as $prod)
                <tr>
                  <td><span class="fw-bold text-primary">#{{$prod->id}}</span></td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="icon-wrapper bg-danger bg-opacity-10 me-2" style="width: 32px; height: 32px;">
                        <i class="fas fa-box text-danger" style="font-size: 0.8rem;"></i>
                      </div>
                      <div>
                        <strong style="font-size: 0.875rem;">{{$prod->nom}}</strong>
                        <br><small class="text-muted" style="font-size: 0.75rem;">{{$prod->description ? Str::limit($prod->description, 30) : 'Aucune description'}}</small>
                      </div>
                    </div>
                  </td>
                  <td><span class="badge bg-primary bg-opacity-10 text-primary" style="font-size: 0.7rem;">{{$prod->category->nom ?? 'Non catégorisé'}}</span></td>
                  <td><strong>{{number_format($prod->prix, 0, ',', ' ')}} FCFA</strong></td>
                  <td>
                    <span class="badge bg-danger bg-opacity-10 text-danger" style="font-size: 0.7rem;">{{$prod->quantite}} unités</span>
                  </td>
                  <td>
                    <span class="badge bg-warning bg-opacity-10 text-warning" style="font-size: 0.7rem;">Stock faible</span>
                  </td>
                  <td>
                    <a href="{{ route('produit') }}" class="action-btn">
                      <i class="fas fa-edit me-1"></i>Gérer
                    </a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="text-center py-4">
                    <i class="fas fa-check-circle text-success" style="font-size: 2rem;"></i>
                    <h5 class="mt-3 text-muted">Excellent !</h5>
                    <p class="text-muted">Tous vos produits ont un stock suffisant</p>
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


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($dates), 
            datasets: [{
                label: 'Montant des ventes',
                data: @json($totals),
                borderColor: '#2563eb',
                backgroundColor: 'rgba(63, 112, 186, 0.2)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#2563eb',
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: (context) => context.raw + ' FCFA'
                    }
                }
            },
            scales: {
                x: { title: { display: true, text: 'Date' }},
                y: { beginAtZero: true, title: { display: true, text: 'Montant (FCFA)' }}
            }
        }
    });
</script>

@endsection