<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
        }
        .reset-message {
            font-size: 18px;
            color: #2563eb;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .token-box {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        .token-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 10px;
        }
        .token-value {
            font-family: 'Courier New', monospace;
            background: #ffffff;
            padding: 15px;
            border-radius: 8px;
            border: 2px solid #2563eb;
            color: #2563eb;
            font-weight: 600;
            font-size: 18px;
            letter-spacing: 2px;
            word-break: break-all;
        }
        .instructions {
            background: #e7f3ff;
            border-left: 4px solid #2563eb;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 10px 10px 0;
        }
        .instructions h3 {
            color: #2563eb;
            margin-top: 0;
        }
        .instructions ol {
            margin: 10px 0;
            padding-left: 20px;
        }
        .instructions li {
            margin: 8px 0;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: 600;
            text-align: center;
            margin: 20px 0;
            transition: transform 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-2px);
            color: white;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .security-note {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
        }
        .security-note strong {
            color: #856404;
        }
        .expiry-note {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔐 Réinitialisation de mot de passe</h1>
            <p>Demande de réinitialisation de votre mot de passe</p>
        </div>
        
        <div class="content">
            <div class="reset-message">
                Demande de réinitialisation reçue
            </div>
            
            <p>Vous avez demandé la réinitialisation de votre mot de passe. Utilisez le code de vérification ci-dessous pour procéder à la réinitialisation.</p>
            
            <div class="token-box">
                <div class="token-label">Code de vérification :</div>
                <div class="token-value">{{ $token }}</div>
            </div>
            
            <div class="instructions">
                <h3>📋 Comment utiliser ce code</h3>
                <ol>
                    <li>Copiez le code de vérification ci-dessus</li>
                    <li>Retournez sur la page de réinitialisation</li>
                    <li>Entrez votre email et le code de vérification</li>
                    <li>Créez votre nouveau mot de passe</li>
                </ol>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ url('/password-forgot') }}" class="cta-button">
                    🔄 Réinitialiser mon mot de passe
                </a>
            </div>
            
            <div class="expiry-note">
                <strong>⏰ Important :</strong> 
                Ce code de vérification expire dans 1 heure pour des raisons de sécurité.
            </div>
            
            <div class="security-note">
                <strong>🔒 Note de sécurité :</strong> 
                Si vous n'avez pas demandé cette réinitialisation, ignorez cet email. Votre mot de passe ne sera pas modifié.
            </div>
            
            <p>Si vous avez des difficultés ou des questions, contactez notre équipe de support.</p>
            
            <p>Cordialement,<br>
            <strong>L'équipe EzStore</strong></p>
        </div>
        
        <div class="footer">
            <p>Cet email a été envoyé automatiquement. Merci de ne pas y répondre.</p>
            <p>© {{ date('Y') }} EzStore. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>