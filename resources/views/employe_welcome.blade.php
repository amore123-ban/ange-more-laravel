<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identifiants de Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-light: #3b82f6;
            --primary-ultra-light: #dbeafe;
            --primary-soft: rgba(37, 99, 235, 0.08);
            --soft-gray: #f8fafc;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --border-soft: #e2e8f0;
            --success: #10b981;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, var(--soft-gray) 100%);
            min-height: 100vh;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .main-container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 24px;
            box-shadow: 
                0 20px 60px rgba(37, 99, 235, 0.08),
                0 8px 30px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            position: relative;
        }

        .main-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
        }

        .header-section {
            background: linear-gradient(135deg, var(--primary-ultra-light), rgba(37, 99, 235, 0.03));
            padding: 3rem 2.5rem 2rem;
            text-align: center;
            position: relative;
        }

        .header-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
        }

        .main-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.2);
            position: relative;
            overflow: hidden;
        }

        .main-icon::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            animation: shine 3s ease-in-out infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .main-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .main-subtitle {
            color: var(--text-muted);
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
        }

        .content-section {
            padding: 2.5rem;
        }

        .credentials-card {
            background: var(--soft-gray);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-soft);
            position: relative;
        }

        .credential-item {
            margin-bottom: 1.5rem;
        }

        .credential-item:last-child {
            margin-bottom: 0;
        }

        .credential-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .credential-value {
            background: white;
            border: 2px solid var(--border-soft);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-dark);
            position: relative;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .credential-value:hover {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-soft);
        }

        .copy-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .copy-btn:hover {
            background: var(--primary-soft);
            color: var(--primary);
        }
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .toast-custom {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            border-left: 4px solid var(--success);
        }

        @media (max-width: 576px) {
            .main-container {
                margin: 1rem;
                border-radius: 20px;
            }
            
            .header-section,
            .content-section {
                padding: 2rem 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="main-container fade-in">
        <div class="header-section">
            <div class="main-icon">
                <i class="fas fa-key"></i>
            </div>
            <h1 class="main-title">Identifiants de Connexion</h1>
            <p class="main-subtitle">Vos identifiants ont été générés et envoyés dans votre boîte mail</p>
            <div class="credentials-card">
                <div class="credential-item">
                    <div class="credential-label">Nom d'utilisateur</div>
                    <div class="credential-value" id="username">
                        <span>{{$user->email}}</span>
                        <button class="copy-btn" onclick="copyToClipboard('username')" title="Copier">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>

                <div class="credential-item">
                    <div class="credential-label">Mot de passe temporaire</div>
                    <div class="credential-value" id="password">
                        <span>{{$password}}</span>
                        <button class="copy-btn" onclick="copyToClipboard('password')" title="Copier">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="toast-container">
            <div class="toast toast-custom" id="copyToast" role="alert">
                <div class="toast-body d-flex align-items-center">
                    <i class="fas fa-check-circle text-success me-2"></i>
                    <span>Copié dans le presse-papiers !</span>
                </div>
            </div>
        </div>
    </div>   
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      
        async function copyToClipboard(elementId) {
            const element = document.querySelector(`#${elementId} span`);
            const text = element.textContent;
            
            try {
                await navigator.clipboard.writeText(text);
                showToast();
                
                const button = document.querySelector(`#${elementId} .copy-btn`);
                const icon = button.querySelector('i');
                icon.className = 'fas fa-check';
                button.style.color = '#10b981';
                
                setTimeout(() => {
                    icon.className = 'fas fa-copy';
                    button.style.color = '';
                }, 2000);
                
            } catch (err) {
                console.error('Erreur lors de la copie:', err);
                const textArea = document.createElement('textarea');
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                showToast();
            }
        }
         function showToast() {
            const toast = new bootstrap.Toast(document.getElementById('copyToast'));
            toast.show();
        }
    </script>
</body>
</html>
