<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plans d'abonnement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 0;
        }
        .pricing-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .pricing-header {
            text-align: center;
            margin-bottom: 60px;
            color: white;
        }
        .pricing-header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .pricing-header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        .pricing-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
        }
        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }
        .pricing-card.featured {
            border: 3px solid #2563eb;
            transform: scale(1.05);
        }
        .pricing-card.featured::before {
            content: 'POPULAIRE';
            position: absolute;
            top: 20px;
            right: -30px;
            background: #2563eb;
            color: white;
            padding: 5px 40px;
            font-size: 12px;
            font-weight: 600;
            transform: rotate(45deg);
        }
        .plan-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            color: white;
            font-size: 2rem;
        }
        .plan-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #1f2937;
        }
        .plan-price {
            font-size: 3rem;
            font-weight: 800;
            color: #2563eb;
            margin-bottom: 5px;
        }
        .plan-currency {
            font-size: 1rem;
            color: #6b7280;
        }
        .plan-duration {
            color: #6b7280;
            margin-bottom: 30px;
        }
        .plan-features {
            list-style: none;
            padding: 0;
            margin-bottom: 40px;
        }
        .plan-features li {
            padding: 10px 0;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
        }
        .plan-features li:last-child {
            border-bottom: none;
        }
        .plan-features i {
            color: #10b981;
            margin-right: 10px;
        }
        .btn-subscribe {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        .btn-subscribe:hover {
            background: linear-gradient(135deg, #1e40af, #2563eb);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
            color: white;
        }
        .btn-outline {
            background: transparent;
            border: 2px solid #2563eb;
            color: #2563eb;
        }
        .btn-outline:hover {
            background: #2563eb;
            color: white;
        }
    </style>
</head>
<body>
    <div class="pricing-container">
        <div class="pricing-header">
            <h1>Choisissez votre plan</h1>
            <p>Démarrez votre boutique en ligne avec nos plans d'abonnement flexibles</p>
        </div>

        <div class="row">
            @foreach($plans as $index => $plan)
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card {{ $index === 1 ? 'featured' : '' }}">
                    <div class="plan-icon">
                        @if($index === 0)
                            <i class="fas fa-rocket"></i>
                        @elseif($index === 1)
                            <i class="fas fa-crown"></i>
                        @else
                            <i class="fas fa-gem"></i>
                        @endif
                    </div>
                    
                    <h3 class="plan-name">{{ $plan->name }}</h3>
                    
                    <div class="plan-price">
                        {{ number_format($plan->price, 0, ',', ' ') }}
                        <span class="plan-currency">{{ $plan->currency }}</span>
                    </div>
                    
                    <p class="plan-duration">{{ $plan->duration_days }} jours</p>
                    
                    <ul class="plan-features">
                        <li><i class="fas fa-check"></i> Gestion des produits illimitée</li>
                        <li><i class="fas fa-check"></i> Système de vente complet</li>
                        <li><i class="fas fa-check"></i> Rapports et statistiques</li>
                        @if($index >= 1)
                            <li><i class="fas fa-check"></i> Support client prioritaire</li>
                        @endif
                        @if($index >= 2)
                            <li><i class="fas fa-check"></i> Intégrations avancées</li>
                            <li><i class="fas fa-check"></i> API personnalisée</li>
                        @endif
                    </ul>
                    
                    <form action="{{ route('subscribe', $plan) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-subscribe {{ $index === 1 ? '' : 'btn-outline' }}">
                            @if($index === 1)
                                <i class="fas fa-star me-2"></i>S'abonner maintenant
                            @else
                                Choisir ce plan
                            @endif
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('dashboard') }}" class="text-white text-decoration-none">
                <i class="fas fa-arrow-left me-2"></i>Retour au tableau de bord
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>