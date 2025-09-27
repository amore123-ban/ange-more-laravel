<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récupération de mot de passe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-blue-theme { 
            font-family: 'poppins', sans serif;
            background : linear-gradient(to bottom right, #f0f4ff, #ffffff);

        }
        .btn-blue {
            background-color: #2563eb;
            color: white;
        }
        .btn-blue:hover {
            background-color: #2563eb;
            color: white;
        }
        .card-header-blue {
            background-color: #2563eb;
            color: white;
        }
    </style>
</head>
<body class="bg-blue-theme">
    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-5">

                <div class="card shadow">

                    <div class="card-header card-header-blue py-3">

                        <h3 class="mb-0 text-center">Reinitialisation du mot de passe</h3>
                    </div>
                    <div class="card-body p-4">

                        <form method="post" action="/forgot-password">
                            @csrf
                            
                            <div class="mb-4 text-center">
                                <i class="bi bi-shield-lock" style="font-size: 3rem; color: #2563eb;"></i>
                            </div>
                            
                            <p class="text-muted mb-4">Entrez votre adresse email et nous vous enverrons un lien pour reinitialiser votre mot de passe.</p>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="votre@email.com" required>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-blue btn-lg">
                                    Envoyer le lien de reinitialisation
                                </button>
                            </div>
                            
                            <div class="text-center mt-3">
                                <a href="/login" class="text-decoration-none text-primary">Retour a la connexion</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>