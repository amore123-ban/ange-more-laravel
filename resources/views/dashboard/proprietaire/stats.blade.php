@extends('layouts.layout_proprio')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    :root {
        --primary-color: #2563eb;
        --primary-light: #3b82f6;
        --primary-dark: #1d4ed8;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --bg-color: #f8fafc;
        --card-bg: #ffffff;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --border-color: #e2e8f0;
        --sidebar-width: 280px;
    }

    .main-content {
        margin-left: var(--sidebar-width);
        padding: 20px;
        background: var(--bg-color);
        min-height: 100vh;
    }

    .dashboard-header {
        background: linear-gradient(135deg, #ffffff 0%, #f0f4ff 100%);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        flex-wrap: wrap;
        gap: 20px;
    }

    .dashboard-info {
        flex: 1;
        min-width: 250px;
    }

    .dashboard-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .dashboard-subtitle {
        color: var(--text-secondary);
        font-size: 1rem;
        margin-top: 8px;
        font-weight: 500;
    }

    .date-filter {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    .date-filter select {
        padding: 12px 16px;
        border-radius: 10px;
        border: 2px solid var(--border-color);
        background-color: var(--card-bg);
        color: var(--text-primary);
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
        min-width: 160px;
    }

    .date-filter select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 16px;
    }

    .stat-icon.revenue {
        background: linear-gradient(135deg, var(--success-color), #047857);
        color: white;
    }

    .stat-icon.products {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
    }

    .stat-icon.clients {
        background: linear-gradient(135deg, var(--warning-color), #d97706);
        color: white;
    }

    .stat-icon.orders {
        background: linear-gradient(135deg, var(--danger-color), #dc2626);
        color: white;
    }

    .stat-card h3 {
        font-size: 0.9rem;
        color: var(--text-secondary);
        margin-bottom: 8px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-card .value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
        line-height: 1.2;
    }

    .stat-card .trend {
        display: flex;
        align-items: center;
        font-size: 0.85rem;
        font-weight: 500;
        gap: 4px;
    }

    .trend.up {
        color: var(--success-color);
    }

    .trend.down {
        color: var(--danger-color);
    }

    .charts-section {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }

    .chart-container {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border-color);
    }

    .chart-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .chart-actions {
        display: flex;
        gap: 8px;
    }

    .chart-actions button {
        background: #f1f5f9;
        border: none;
        color: var(--text-secondary);
        cursor: pointer;
        font-size: 0.85rem;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.2s ease;
        font-weight: 500;
    }

    .chart-actions button:hover,
    .chart-actions button.active {
        background: var(--primary-color);
        color: white;
    }

    .chart-wrapper {
        position: relative;
        height: 350px;
    }

    .bottom-charts {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 20px;
    }

    .loading-spinner {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
        color: var(--text-secondary);
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
        animation: fadeInUp 0.6s ease-out;
    }

    /* === RESPONSIVE DESIGN === */

    /* Large Desktop (1200px+) */
    @media (min-width: 1200px) {
        .dashboard-header {
            flex-wrap: nowrap;
        }
        
        .dashboard-info {
            flex: 1;
        }
        
        .date-filter {
            flex-shrink: 0;
        }
    }

    /* Medium Desktop/Tablet Landscape (992px - 1199px) */
    @media (max-width: 1199px) and (min-width: 992px) {
        .main-content {
            margin-left: 0;
            padding: 20px;
        }
        
        .dashboard-header {
            flex-direction: column !important;
            align-items: stretch !important;
            text-align: center;
            gap: 16px;
        }
        
        .dashboard-info {
            min-width: auto;
        }
        
        .date-filter {
            justify-content: center;
        }
        
        .charts-section {
            grid-template-columns: 1fr;
        }
    }

    /* Tablet Portrait (768px - 991px) */
    @media (max-width: 991px) and (min-width: 768px) {
        .main-content {
            margin-left: 0;
            padding: 20px;
        }
        
        .dashboard-header {
            flex-direction: column !important;
            align-items: stretch !important;
            text-align: center;
            gap: 16px;
            padding: 20px;
        }
        
        .dashboard-title {
            font-size: 1.7rem;
        }
        
        .date-filter {
            justify-content: center;
            gap: 10px;
        }
        
        .date-filter select {
            min-width: 140px;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        
        .charts-section {
            grid-template-columns: 1fr;
        }
        
        .bottom-charts {
            grid-template-columns: 1fr;
        }
    }

    /* Large Mobile (576px - 767px) */
    @media (max-width: 767px) and (min-width: 576px) {
        .main-content {
            margin-left: 0;
            padding: 16px;
        }
        
        .dashboard-header {
            flex-direction: column !important;
            align-items: stretch !important;
            text-align: center;
            gap: 16px;
            padding: 18px;
        }
        
        .dashboard-title {
            font-size: 1.5rem;
        }
        
        .dashboard-subtitle {
            font-size: 0.9rem;
        }
        
        .date-filter {
            flex-direction: column;
            gap: 10px;
        }
        
        .date-filter select {
            width: 100%;
            min-width: auto;
            margin: 0;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .chart-header {
            flex-direction: column;
            gap: 12px;
        }
    }

    /* Mobile (max-width: 575px) */
    @media (max-width: 575px) {
        .main-content {
            margin-left: 0 !important;
            padding: 12px;
        }
        
        .dashboard-header {
            flex-direction: column !important;
            align-items: stretch !important;
            justify-content: center !important;
            text-align: center;
            gap: 12px;
            padding: 16px;
            margin-bottom: 20px;
        }
        
        .dashboard-info {
            min-width: auto;
            width: 100%;
        }
        
        .dashboard-title {
            font-size: 1.3rem;
            line-height: 1.3;
        }
        
        .dashboard-subtitle {
            font-size: 0.85rem;
            margin-top: 6px;
        }
        
        .date-filter {
            flex-direction: column !important;
            gap: 8px;
            width: 100%;
        }
        
        .date-filter select {
            width: 100% !important;
            min-width: auto !important;
            padding: 10px 12px;
            font-size: 0.85rem;
        }
        
        .stats-grid {
            grid-template-columns: 1fr !important;
            gap: 12px;
        }
        
        .chart-header {
            flex-direction: column !important;
            gap: 10px;
            text-align: center;
        }
        
        .chart-actions {
            justify-content: center;
            flex-wrap: wrap;
            gap: 6px;
        }
        
        .chart-actions button {
            padding: 6px 10px;
            font-size: 0.75rem;
        }
    }

    /* Very Small Mobile (max-width: 400px) */
    @media (max-width: 400px) {
        .main-content {
            padding: 8px;
        }
        
        .dashboard-header {
            padding: 12px;
            margin-bottom: 16px;
            border-radius: 12px;
        }
        
        .dashboard-title {
            font-size: 1.15rem;
        }
        
        .dashboard-subtitle {
            font-size: 0.8rem;
        }
        
        .date-filter select {
            padding: 8px 10px;
            font-size: 0.8rem;
        }
    }

    /* Landscape Mobile */
    @media (max-width: 767px) and (orientation: landscape) and (max-height: 500px) {
        .dashboard-header {
            flex-direction: row !important;
            justify-content: space-between !important;
            align-items: center !important;
            text-align: left;
            gap: 16px;
            padding: 12px 16px;
        }
        
        .dashboard-info {
            min-width: auto;
        }
        
        .dashboard-title {
            font-size: 1.2rem;
            margin: 0;
        }
        
        .dashboard-subtitle {
            font-size: 0.8rem;
            margin-top: 4px;
        }
        
        .date-filter {
            flex-direction: row !important;
            gap: 8px;
        }
        
        .date-filter select {
            width: auto !important;
            min-width: 120px !important;
            padding: 6px 10px;
            font-size: 0.75rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    /* Default breakpoints from original */
    @media (max-width: 1200px) {
        .charts-section {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
            padding: 16px;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .bottom-charts {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="main-content">
    <div class="container-fluid">
        <!-- Header -->
        <div class="dashboard-header animate-fade-in">
            <div class="dashboard-info">
                <h1 class="dashboard-title">Tableau de Bord des Ventes</h1>
                <p class="dashboard-subtitle">Vue d'ensemble de vos performances commerciales</p>
            </div>
            <div class="date-filter">
                <select id="period">
                    <option value="7days">7 derniers jours</option>
                    <option value="30days" selected>30 derniers jours</option>
                    <option value="90days">90 derniers jours</option>
                    <option value="1year">Cette année</option>
                </select>
                <select id="compare">
                    <option value="none">Sans comparaison</option>
                    <option value="previous">Période précédente</option>
                    <option value="lastyear">Même période l'an dernier</option>
                </select>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid animate-fade-in">
            <div class="stat-card">
                <div class="stat-icon revenue">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Chiffre d'affaires</h3>
                <div class="value">{{ number_format($chiffreAffaire, 0, ',', ' ') }} FCFA</div>
                <div class="trend up">
                    <i class="fas fa-arrow-up"></i>
                    +12.4% vs période précédente
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon products">
                    <i class="fas fa-boxes"></i>
                </div>
                <h3>Produits en stock</h3>
                <div class="value">{{ $produitsEnStock }}</div>
                <div class="trend up">
                    <i class="fas fa-arrow-up"></i>
                    +8.2% vs période précédente
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon clients">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Nouveaux clients</h3>
                <div class="value">128</div>
                <div class="trend down">
                    <i class="fas fa-arrow-down"></i>
                    -2.1% vs période précédente
                </div>
            </div>
        </div>

        <!-- Main Charts -->
        <div class="charts-section animate-fade-in">
            <div class="chart-container">
                <div class="chart-header">
                    <h2 class="chart-title">Évolution du chiffre d'affaires</h2>
                    <div class="chart-actions">
                        <button>Jour</button>
                        <button>Semaine</button>
                        <button class="active">Mois</button>
                    </div>
                </div>
                <div class="chart-wrapper">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h2 class="chart-title">Top Produits</h2>
                    <div class="chart-actions">
                        <button class="active">Quantité</button>
                        <button>Revenus</button>
                    </div>
                </div>
                <div class="chart-wrapper">
                    <canvas id="topProductsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bottom Charts -->
        <div class="bottom-charts animate-fade-in">
            <div class="chart-container">
                <div class="chart-header">
                    <h2 class="chart-title">Performances des produits</h2>
                </div>
                <div class="chart-wrapper">
                    <canvas id="productsChart"></canvas>
                </div>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h2 class="chart-title">Répartition des ventes</h2>
                </div>
                <div class="chart-wrapper">
                    <canvas id="salesDistributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Données depuis le serveur
    const labels = {!! json_encode($labels ?? []) !!};
    const data = {!! json_encode($data ?? []) !!};
    const produitsTop = {!! json_encode($produitsTop ?? collect()) !!};
    
    console.log('Données reçues:', { labels, data, produitsTop });

    // Configuration des couleurs
    const colors = {
        primary: '#2563eb',
        primaryLight: '#3b82f6',
        success: '#10b981',
        warning: '#f59e0b',
        danger: '#ef4444',
        purple: '#8b5cf6',
        pink: '#ec4899'
    };

    // Configuration par défaut de Chart.js
    Chart.defaults.font.family = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
    Chart.defaults.color = '#64748b';

    // 1. Graphique du chiffre d'affaires
    if (document.getElementById('revenueChart')) {
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: labels.length ? labels : ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
                datasets: [{
                    label: 'Chiffre d\'affaires {{ now()->year }}',
                    data: data.length ? data : [50000, 75000, 60000, 90000, 85000, 120000],
                    borderColor: colors.primary,
                    backgroundColor: colors.primary + '20',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: colors.primary,
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9'
                        },
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat('fr-FR').format(value) + ' FCFA';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // 2. Graphique des top produits (Doughnut)
    if (document.getElementById('topProductsChart')) {
        const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
        const topProductsData = produitsTop.length ? 
            produitsTop.map(p => p.total_vendus || 0) : 
            [30, 25, 20, 15, 10];
        const topProductsLabels = produitsTop.length ? 
            produitsTop.map(p => p.nom || 'Produit') : 
            ['Produit A', 'Produit B', 'Produit C', 'Produit D', 'Produit E'];

        new Chart(topProductsCtx, {
            type: 'doughnut',
            data: {
                labels: topProductsLabels,
                datasets: [{
                    data: topProductsData,
                    backgroundColor: [
                        colors.primary,
                        colors.success,
                        colors.warning,
                        colors.purple,
                        colors.pink
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    }

    // 3. Graphique des performances des produits
    if (document.getElementById('productsChart')) {
        const productsCtx = document.getElementById('productsChart').getContext('2d');
        const productsData = produitsTop.length ? 
            produitsTop.map(p => p.total_vendus || 0) : 
            [45, 38, 32, 28, 25, 20];
        const productsLabels = produitsTop.length ? 
            produitsTop.map(p => (p.nom || 'Produit').substring(0, 15) + (p.nom?.length > 15 ? '...' : '')) : 
            ['Produit A', 'Produit B', 'Produit C', 'Produit D', 'Produit E', 'Produit F'];

        new Chart(productsCtx, {
            type: 'bar',
            data: {
                labels: productsLabels,
                datasets: [{
                    label: 'Quantité vendue',
                    data: productsData,
                    backgroundColor: colors.primary,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // 4. Graphique de répartition des ventes
    if (document.getElementById('salesDistributionChart')) {
        const salesCtx = document.getElementById('salesDistributionChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'polarArea',
            data: {
                labels: ['En ligne', 'En magasin', 'Mobile', 'Téléphone'],
                datasets: [{
                    data: [40, 35, 15, 10],
                    backgroundColor: [
                        colors.primary + '80',
                        colors.success + '80',
                        colors.warning + '80',
                        colors.danger + '80'
                    ],
                    borderColor: [
                        colors.primary,
                        colors.success,
                        colors.warning,
                        colors.danger
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    }

    // Animation des cartes de statistiques
    const animateValue = (element, start, end, duration) => {
        const startTimestamp = performance.now();
        const step = (timestamp) => {
            const elapsed = timestamp - startTimestamp;
            const progress = Math.min(elapsed / duration, 1);
            const current = Math.floor(progress * (end - start) + start);
            element.textContent = new Intl.NumberFormat('fr-FR').format(current) + 
                                 (element.textContent.includes('FCFA') ? ' FCFA' : '');
            
            if (progress < 1) {
                requestAnimationFrame(step);
            }
        };
        requestAnimationFrame(step);
    };

    // Animer les valeurs des cartes
    setTimeout(() => {
        const valueElements = document.querySelectorAll('.stat-card .value');
        valueElements.forEach(element => {
            const text = element.textContent.replace(/[^\d]/g, '');
            const value = parseInt(text) || 0;
            if (value > 0) {
                element.textContent = '0';
                animateValue(element, 0, value, 2000);
            }
        });
    }, 500);
});
</script>

@endsection