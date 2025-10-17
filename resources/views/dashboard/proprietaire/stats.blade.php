@extends('layouts.layout_proprio')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-light: #3b82f6;
            --primary-dark: #1d4ed8;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
        }


        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .dashboard-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .date-filter {
            display: flex;
            gap: 10px;
        }

        .date-filter select {
            padding: 8px 15px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: var(--card-bg);
            color: var(--text-primary);
            font-size: 0.9rem;
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid var(--primary-color);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.07), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .stat-card h3 {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-bottom: 10px;
            font-weight: 500;
        }

        .stat-card .value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 5px;
        }

        .stat-card .trend {
            display: flex;
            align-items: center;
            font-size: 0.85rem;
        }

        .trend.up {
            color: #10b981;
        }

        .trend.down {
            color: #ef4444;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-container {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .chart-actions {
            display: flex;
            gap: 10px;
        }

        .chart-actions button {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .chart-actions button:hover {
            background-color: #f1f5f9;
            color: var(--primary-color);
        }

        .chart-wrapper {
            position: relative;
            height: 300px;
        }

        .bottom-charts {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 1024px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
            
            .bottom-charts {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="main-content">
        <div class="container-fluid">
            <div class="dashboard">
                <div class="dashboard-header">
                    <h1 class="dashboard-title">Tableau de Bord des Ventes</h1>
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
            <div class="row d-flex align-items-center mb-4">
                <div class=" col-md stats-cards">
                    <div class="stat-card">
                        <h3>Chiffre d'affaires</h3>
                        <div class="value">{{ number_format($chiffreAffaire, 0, ',', ' ') }} FCFA</div>
                        <div class="trend up">+12.4% vs période précédente</div>
                    </div>
                    <div class=" col-md stat-card">
                        <h3>Produits en stock</h3>
                        <div class="value">{{ $produitsEnStock }}</div>
                        <div class="trend up">+8.2% vs période précédente</div>
                    </div>
                    <div class=" col-md stat-card">
                        <h3>Nouveaux clients</h3>
                        <div class="value">128</div>
                        <div class="trend down">-2.1% vs période précédente</div>
                    </div>
                </div>
            </div>
                <div class="charts-grid">
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
                            <h2 class="chart-title">Catégories les plus vendues</h2>
                            <div class="chart-actions">
                                <button class="active">Quantité</button>
                                <button>Revenus</button>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="categoriesChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="bottom-charts">
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
                            <h2 class="chart-title">Canaux de vente</h2>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="channelsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        console.log({
        labels: {!! json_encode($labels) !!},
        data: {!! json_encode($data) !!},
        produits: {!! json_encode($produitsTop->pluck('nom')) !!},
        ventes: {!! json_encode($produitsTop->pluck('total_vendus')) !!}
    });

        // Configuration des couleurs
        const primaryColor = '#2563eb';
        const primaryLight = '#3b82f6';
        const primaryDark = '#1d4ed8';
        const bgColor = '#f8fafc';
        
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const revenueChart = new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Chiffre d\'affaires {{ now()->year }}',
            data: {!! json_encode($data) !!},
            borderColor: '#2563eb',
            backgroundColor: '#2563eb20',
            borderWidth: 3,
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
const productsCtx = document.getElementById('productsChart').getContext('2d');
const productsChart = new Chart(productsCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($produitsTop->pluck('name')) !!},
        datasets: [{
            label: 'Quantité vendue',
            data: {!! json_encode($produitsTop->pluck('total_vendus')) !!},
            backgroundColor: '#2563eb',
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

    </script>

@endsection