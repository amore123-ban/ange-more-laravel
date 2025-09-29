<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue dans l'équipe</title>
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
        .welcome-message {
            font-size: 18px;
            color: #2563eb;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .credentials-box {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }
        .credential-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #dee2e6;
        }
        .credential-item:last-child {
            border-bottom: none;
        }
        .credential-label {
            font-weight: 600;
            color: #495057;
        }
        .credential-value {
            font-family: 'Courier New', monospace;
            background: #ffffff;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            color: #2563eb;
            font-weight: 600;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Bienvenue dans l'équipe !</h1>
            <p>Votre compte employé a été créé avec succès</p>
        </div>
        
        <div class="content">
            <div class="welcome-message">
                Bonjour {{ $user->name }},
            </div>
            
            <p>Nous sommes ravis de vous accueillir dans notre équipe ! Votre compte employé a été créé et vous pouvez maintenant accéder à la plateforme.</p>
            
            <div class="credentials-box">
                <h3 style="margin-top: 0; color: #2563eb;">🔑 Vos identifiants de connexion</h3>
                <div class="credential-item">
                    <span class="credential-label">Email :</span>
                    <span class="credential-value">{{ $user->email }}</span>
                </div>
                <div class="credential-item">
                    <span class="credential-label">Mot de passe temporaire :</span>
                    <span class="credential-value">{{ $password }}</span>
                </div>
            </div>
            
            <div class="instructions">
                <h3>📋 Prochaines étapes</h3>
                <ol>
                    <li>Connectez-vous avec vos identifiants ci-dessus</li>
                    <li>Changez votre mot de passe lors de votre première connexion</li>
                    <li>Explorez les fonctionnalités disponibles</li>
                    <li>Contactez votre responsable en cas de question</li>
                </ol>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ url('/login-register') }}" class="cta-button">
                    🚀 Se connecter maintenant
                </a>
            </div>
            
            <div class="security-note">
                <strong>🔒 Note de sécurité :</strong> 
                Ce mot de passe est temporaire. Veuillez le changer dès votre première connexion pour des raisons de sécurité.
            </div>
            
            <p>Si vous avez des questions ou besoin d'aide, n'hésitez pas à contacter votre responsable ou l'équipe de support.</p>
            
            <p>Bienvenue dans l'équipe !<br>
            <strong>L'équipe EzStore</strong></p>
        </div>
        
        <div class="footer">
            <p>Cet email a été envoyé automatiquement. Merci de ne pas y répondre.</p>
            <p>© {{ date('Y') }} EzStore. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>