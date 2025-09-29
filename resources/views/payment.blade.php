<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement - {{ $plan->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .payment-container {
            max-width: 600px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .payment-header {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .payment-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .payment-body {
            padding: 40px;
        }
        .plan-summary {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
        }
        .plan-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2563eb;
            margin-bottom: 10px;
        }
        .plan-price {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 5px;
        }
        .plan-duration {
            color: #6b7280;
            font-size: 1rem;
        }
        .payment-methods {
            margin-bottom: 30px;
        }
        .payment-method {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .payment-method:hover {
            border-color: #2563eb;
            background: #f8fafc;
        }
        .payment-method.selected {
            border-color: #2563eb;
            background: #eff6ff;
        }
        .payment-method input[type="radio"] {
            margin-right: 15px;
        }
        .payment-method label {
            font-weight: 600;
            color: #374151;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .payment-method i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        .btn-pay {
            background: linear-gradient(135deg, #10b981, #34d399);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        .btn-pay:hover {
            background: linear-gradient(135deg, #059669, #10b981);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
            color: white;
        }
        .security-info {
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
            font-size: 0.9rem;
        }
        .security-info i {
            color: #10b981;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <div class="payment-header">
            <h1><i class="fas fa-credit-card me-2"></i>Paiement sécurisé</h1>
            <p>Finalisez votre abonnement {{ $plan->name }}</p>
        </div>
        
        <div class="payment-body">
            <div class="plan-summary">
                <div class="plan-name">{{ $plan->name }}</div>
                <div class="plan-price">{{ number_format($plan->price, 0, ',', ' ') }} {{ $plan->currency }}</div>
                <div class="plan-duration">Valable {{ $plan->duration_days }} jours</div>
            </div>

            <form id="paymentForm" action="{{ route('pay', $plan) }}" method="POST">
                @csrf
                
                <div class="payment-methods">
                    <h5 class="mb-3">Méthode de paiement</h5>
                    
                    <div class="payment-method" onclick="selectPaymentMethod('mobile_money')">
                        <label>
                            <input type="radio" name="payment_method" value="mobile_money" required>
                            <i class="fas fa-mobile-alt text-primary"></i>
                            Mobile Money (Orange Money, MTN Mobile Money)
                        </label>
                    </div>
                    
                    <div class="payment-method" onclick="selectPaymentMethod('card')">
                        <label>
                            <input type="radio" name="payment_method" value="card" required>
                            <i class="fas fa-credit-card text-success"></i>
                            Carte bancaire (Visa, Mastercard)
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-pay">
                    <i class="fas fa-lock me-2"></i>Payer {{ number_format($plan->price, 0, ',', ' ') }} {{ $plan->currency }}
                </button>
            </form>

            <div class="security-info">
                <i class="fas fa-shield-alt"></i>
                Paiement 100% sécurisé avec NotchPay
            </div>
        </div>
    </div>

    <script>
        function selectPaymentMethod(method) {
            // Désélectionner toutes les méthodes
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('selected');
            });
            
            // Sélectionner la méthode cliquée
            event.currentTarget.classList.add('selected');
            
            // Cocher le radio button
            document.querySelector(`input[value="${method}"]`).checked = true;
        }

        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            // Afficher un loader
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Redirection vers le paiement...';
            submitBtn.disabled = true;
            
            // Simuler la redirection vers NotchPay
            setTimeout(() => {
                alert('Redirection vers NotchPay en cours...');
                // Ici, vous redirigeriez vers l'URL de paiement NotchPay
                // window.location.href = 'https://notchpay.co/pay/...';
            }, 2000);
        });
    </script>
</body>
</html>