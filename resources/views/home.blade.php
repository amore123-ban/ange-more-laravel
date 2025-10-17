
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ezstore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"?>
  <style>
    body{
      font-family: 'poppins', sans serif;
      background: linear-gradient(to bottom right, #f0f4ff, #ffffff);
    }
    
    nav{
      direction:flex;
      align-items:center;
      justify-content:space-between;
      margin-top:9px;
      margin-left:15px;
      margin-right:15px;
      border-radius:20px;
    }
    
    .navbar-nav .nav-link {
      position: relative;
      font-weight: 500;
      color: #000;
      transition: color 0.3s;
    }

    .navbar-nav .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background-color: #2563eb;
      transition: width 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: #2563eb;
    }

    .navbar-nav .nav-link:hover::after {
      width: 100%;
    }
    
    img{
      width:140px;
    }
    
    .hero img {
      width: auto;
      max-width: 100%;
      height: auto;
      min-width: 300px;
    }
    
    .glass-navbar {
      background: rgba(255, 255, 255, 0.2); 
      backdrop-filter: blur(5px);         
      -webkit-backdrop-filter: blur(5px); 
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
    }

    .hero {
      background: linear-gradient(to bottom right, #2563eb10, #3b82f610);
      padding-top: 6rem;
      padding-bottom: 4rem;
    }
    
    .btn-outline-custom {
      border: 1px solid #2563eb;  
      color: #2563eb;
      background-color: transparent;
      transition: 0.3s;
    }

    .btn-outline-custom:hover {
      background-color: #2563eb;
      color: white;
    }

    .btn-reverse {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #2563eb;
      color: white;
      border-radius: 5px;
      transition: 0.3s;
    }

    .btn-reverse:hover {
      background-color: transparent;
      color: #2563eb;
      border: 1px solid #2563eb;
    }
    
    .btn-follow-cursor {
      position: relative;
      transition: transform 0.15s ease;
      will-change: transform;
      z-index: 1;
    }

    .feature-card:hover {
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
      transition: 0.3s;
    }
    
    .mor{
      color: #2563eb;
    }

    .contact,.pricing,.features{
      color:#2563eb;
      font-size:34px;
    }

    textarea{
      width:550px;
      height:200px;
      border-radius:5px;
      border:1px solid gray ;
    }
    
    .text:focus{
      border-color:#2563eb;
    }

    .hover-opacity-100:hover {
      opacity: 1 !important;
      text-decoration: underline;
    }
  
    .opacity-75 {
      opacity: 0.75;
    }
  
    footer a {
      transition: all 0.3s ease;
    }
  
    footer i {
      transition: transform 0.3s ease;
    }
  
    footer a:hover i {
      transform: translateY(-3px);
    }

    /* ===== RESPONSIVE STYLES ===== */
    
    /* Mobile First - Base styles for small screens */
    @media (max-width: 576px) {
      .hero {
        padding-top: 4rem;
        padding-bottom: 2rem;
      }
      
      .display-5 {
        font-size: 2rem !important;
        line-height: 1.2;
      }
      
      .hero .col-7 {
        flex: 0 0 100%;
        max-width: 100%;
        text-align: center;
        margin-bottom: 2rem;
      }
      
      .hero .col-md {
        flex: 0 0 100%;
        max-width: 100%;
        text-align: center;
      }
      
             .hero img {
         max-width: 80%;
         height: auto;
         min-width: 250px;
       }
      
      .btn {
        display: block;
        width: 100%;
        margin-bottom: 1rem;
      }
      
      .btn + .btn {
        margin-left: 0;
      }
      
      .contact, .pricing, .features {
        font-size: 2rem;
      }
      
      textarea {
        width: 100%;
        max-width: 100%;
      }
      
      .navbar-brand img {
        width: 100px;
      }
      
      .card {
        margin-bottom: 1.5rem;
      }
      
      .pricing .col-lg-4 {
        margin-bottom: 2rem;
      }
      
      footer .col-lg-5,
      footer .col-lg-3,
      footer .col-lg-4 {
        margin-bottom: 2rem;
        text-align: center;
      }
      
      footer .d-flex.flex-column.flex-md-row {
        text-align: center;
      }
      
      .navbar-nav {
        text-align: center;
        margin-top: 1rem;
      }
      
      .navbar-nav .nav-item {
        margin: 0.5rem 0;
      }
    }
    
    /* Tablet styles */
    @media (min-width: 577px) and (max-width: 768px) {
      .hero {
        padding-top: 5rem;
        padding-bottom: 3rem;
      }
      
      .display-5 {
        font-size: 2.5rem !important;
      }
      
      .hero .col-7 {
        flex: 0 0 100%;
        max-width: 100%;
        text-align: center;
        margin-bottom: 2rem;
      }
      
      .hero .col-md {
        flex: 0 0 100%;
        max-width: 100%;
        text-align: center;
      }
      
             .hero img {
         max-width: 70%;
         height: auto;
         min-width: 300px;
       }
      
      .btn {
        margin: 0.5rem;
      }
      
      .contact, .pricing {
        font-size: 2.5rem;
      }
      
      textarea {
        width: 100%;
        max-width: 100%;
      }
      
      .pricing .col-lg-4 {
        margin-bottom: 2rem;
      }
    }
    
    /* Small desktop styles */
    @media (min-width: 769px) and (max-width: 992px) {
      .hero {
        padding-top: 5.5rem;
        padding-bottom: 3.5rem;
      }
      
      .display-5 {
        font-size: 3rem !important;
      }
      
      .hero .col-7 {
        flex: 0 0 60%;
        max-width: 60%;
      }
      
      .hero .col-md {
        flex: 0 0 40%;
        max-width: 40%;
      }
      
      .hero img {
        max-width: 100%;
        height: auto;
        min-width: 400px;
      }
      
      .contact, .pricing {
        font-size: 3rem;
      }
      
      textarea {
        width: 100%;
        max-width: 100%;
      }
    }
    
    /* Large desktop styles */
    @media (min-width: 993px) {
      .hero {
        padding-top: 6rem;
        padding-bottom: 4rem;
      }
      
      .display-5 {
        font-size: 3.5rem !important;
      }
      
      .hero .col-7 {
        flex: 0 0 50%;
        max-width: 50%;
      }
      
      .hero .col-md {
        flex: 0 0 50%;
        max-width: 50%;
      }
      
      .hero img {
        max-width: 100%;
        height: auto;
        min-width: 500px;
      }
      
      .contact, .pricing {
        font-size: 3.5rem;
      }
    }
    
    /* Additional responsive improvements */
    @media (max-width: 768px) {
      .container {
        padding-left: 1rem;
        padding-right: 1rem;
      }
      
      .row {
        margin-left: -0.5rem;
        margin-right: -0.5rem;
      }
      
      .col, .col-md, .col-lg {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
      }
      
      .card-body {
        padding: 1.5rem;
      }
      
      .form-control {
        font-size: 16px; /* Prevents zoom on iOS */
      }
      
      .navbar-collapse {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 10px;
        margin-top: 1rem;
        padding: 1rem;
      }
    }
    
    /* Smooth scrolling for anchor links */
    html {
      scroll-behavior: smooth;
    }
    
    /* Improve button spacing on mobile */
    @media (max-width: 576px) {
      .hero .btn {
        margin-bottom: 1rem;
        padding: 12px 24px;
        font-size: 14px;
      }
    }
    
    /* Improve card spacing */
    @media (max-width: 768px) {
      .card {
        margin-bottom: 1.5rem;
      }
      
      .feature-card {
        height: auto !important;
      }
    }
    
    /* Improve form responsiveness */
    @media (max-width: 576px) {
      .form {
        padding: 1rem;
      }
      
      .form-control {
        margin-bottom: 1rem;
      }
    }
    
    /* Improve footer responsiveness */
    @media (max-width: 768px) {
      footer {
        text-align: center;
      }
      
      footer .row > div {
        margin-bottom: 2rem;
      }
      
      footer .d-flex.flex-column.flex-md-row {
        flex-direction: column !important;
      }
      
      footer .d-flex.flex-column.flex-md-row > div {
        margin-bottom: 1rem;
      }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
   <header>
    <nav class="navbar navbar-expand-lg glass-navbar fixed-top">
      <div class="container">
        <a class="navbar-brand fw-bold" href="#home">
          <img src="./images/Ezstore.png" alt="Ezstore Logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="mainNavbar">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item mx-3"><a class="nav-link" href="#home">Accueil</a></li>
            <li class="nav-item mx-3"><a class="nav-link" href="#features">Fonctionnalités</a></li>
            <li class="nav-item mx-3"><a class="nav-link" href="#pricing">Abonnements</a></li>
            <li class="nav-item mx-3"><a class="nav-link" href="#contact">Contact</a></li>
          </ul>
          <a href="/login-register" class="btn btn-outline-custom "  style="margin-right:20px;">Se connecter</a>
          <!-- <a href="" class="btn btn-reverse" style="height:40px;"><i class="fas fa-user-plus me-2 "></i> S'inscire</a> -->
        </div>
      </div>
    </nav>
  </header>
  
  <!-- hero section -->
<section id="home" class="hero">
  <div class="container mt-5">
    <div class="row justify-content-between align-items-center">
     <div class="col-lg-7 col-md-12 col-sm-12 mt-5">
      <h1 class="display-5 fw-bold">
        Gérez votre boutique électronique
        <span class="mor">en toute simplicité</span>
      </h1>
       <p class="lead mt-3">
        EzStore est la solution complète pour optimiser la gestion de votre boutique électronique : stocks, ventes, factures et bien plus encore.
       </p>
       <div class="mt-4">
          <a href="{{route('plans')}}" class="btn btn-outline-custom btn-follow-cursor me-3 mb-2">
            <i class="fas fa-rocket me-2"></i>
            Démarrer gratuitement
          </a>
          <a href="" class="btn btn-reverse btn-follow-cursor mb-2">
            <i class="fas fa-play me-2"></i>
            Voir la démo
          </a>
        </div>
      </div>
      <div class="col-lg-5 col-md-12 col-sm-12 text-center">
        <img src="./images/Work.png" class="img-fluid" alt="EzStore Dashboard"/>
      </div>
    </div>
  </div>
  </section>

  <section id="features"></section>
  <!-- Features -->
    <section class="mt-5 py-5 bg-light">
  <div class="container">
    <h2 class="text-center text-primary fw-bold mb-4 pricing ">Fonctionnalités principales</h2>
    <p class="text-center text-muted mx-auto mb-5" style="max-width: 700px;">
      Tout ce dont vous avez besoin pour gérer efficacement votre boutique électronique
    </p>

    <div class="row g-4">
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card h-100 shadow-sm border-0 feature-card">
          <div class="card-body">
            <div class="bg-secondary bg-opacity-10 rounded d-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
              <i class="fas fa-boxes text-primary fs-5"></i>
            </div>
            <h5 class="card-title fw-semibold">Gestion des stocks</h5>
            <p class="card-text">Suivi en temps réel des entrées et sorties de produits électroniques dans chaque boutique.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card h-100 shadow-sm border-0 feature-card">
          <div class="card-body">
            <div class="bg-secondary bg-opacity-10 rounded d-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
              <i class="fas fa-receipt text-primary fs-5"></i>
            </div>
            <h5 class="card-title fw-semibold">Facturation automatisée</h5>
            <p class="card-text">Générez des factures rapidement pour vos ventes avec export en PDF.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card h-100 shadow-sm border-0 feature-card">
          <div class="card-body">
            <div class="bg-secondary bg-opacity-10 rounded d-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
              <i class="fas fa-store-alt text-primary fs-5"></i>
            </div>
            <h5 class="card-title fw-semibold">Multi-boutiques</h5>
            <p class="card-text">Gérez plusieurs points de vente avec des utilisateurs différents par boutique.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card h-100 shadow-sm border-0 feature-card">
          <div class="card-body">
            <div class="bg-secondary bg-opacity-10 rounded d-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
              <i class="fas fa-users-cog text-primary fs-5"></i>
            </div>
             <h5 class="card-title fw-semibold">Gestion du personnel</h5>
            <p class="card-text">Attribuez des rôles et suivez l'activité de votre équipe par boutique.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card h-100 shadow-sm border-0 feature-card">
          <div class="card-body">
            <div class="bg-secondary bg-opacity-10 rounded d-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
              <i class="fas fa-chart-line text-primary fs-5"></i>
            </div>
            <h5 class="card-title fw-semibold">Statistiques & rapports</h5>
            <p class="card-text">Visualisez les performances commerciales à travers des tableaux de bord dynamiques.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card h-100 shadow-sm border-0 feature-card">
          <div class="card-body">
            <div class="bg-secondary bg-opacity-10 rounded d-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
              <i class="fas fa-lock text-primary fs-5"></i>
            </div>
            <h5 class="card-title fw-semibold">Accès sécurisé</h5>
            <p class="card-text">Connexion sécurisée avec gestion des droits utilisateurs selon les profils.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


  <!-- Pricing -->
   
  <section id="pricing"></section>
  <section id="pricing" class="py-5 mt-5">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-8 text-center">
        <h2 class="pricing fw-bold"> Tarifs transparents </h2>
        <p class="text-muted"> Choisissez le plan qui correspond à vos besoins </p>
      </div>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card shadow-lg h-100">
          <div class="card-body p-4">
            <h3 class="h4 fw-semibold mb-3">Basique</h3>
            <div class="display-6 fw-bold text-primary mb-4">
              5000 FCFA
              <span class="fs-6 text-muted">/mois</span>
            </div>
            <ul class="list-unstyled mb-4">
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> Jusqu'à 100 produits
              </li>
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> 1 utilisateur
              </li>
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> Support email
              </li>
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> Rapports de base
              </li>
            </ul>
            <button class="btn btn-outline-custom w-100 py-2 fw-semibold">Commencer</button>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card shadow-lg h-100">
          <div class="card-body p-4">
            <h3 class="h4 fw-semibold mb-3">Standard</h3>
            <div class="display-6 fw-bold text-primary mb-4">
              15 000 FCFA
              <span class="fs-6 text-muted">/mois</span>
            </div>
            <ul class="list-unstyled mb-4">
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> Produits illimités
              </li>
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> 5 utilisateurs
              </li>
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> Support prioritaire
              </li>
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> Analytics avancés
              </li>
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> Accès API
              </li>
            </ul>
            <button class="btn btn-outline-custom w-100 py-2 fw-semibold">Commencer</button>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card shadow-lg h-100">
          <div class="card-body p-4">
            <h3 class="h4 fw-semibold mb-3">Premium</h3>
            <div class="display-6 fw-bold text-primary mb-4">
              30 000 FCFA
              <span class="fs-6 text-muted">/mois</span>
            </div>
            <ul class="list-unstyled mb-4">
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> Tous les avantages Standard
              </li>
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> Comptes équipe illimités
              </li>
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> Support téléphonique 24/7
              </li>
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> Intégration ERP
              </li>
              <li class="d-flex align-items-center mb-2">
                <i class="fas fa-check text-success me-2"></i> Sauvegardes automatiques
              </li>
            </ul>
            <button class="btn btn-outline-custom w-100 py-2 fw-semibold">Commencer</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


  <!-- Contact -->
   
  <section id="contact"></section>
  <section id="contact" class="py-5 mt-5">
    <div class="container">
      <div class="row d-flex justify-content-center mb-5">
        <div class="col-md-8 text-center">
          <h2 class="contact fw-bold"> Nous contacter</h2>
          <p class="text-muted">Une question, une demande ? Laissez-nous un message !</p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
          <div class="form">
            <form>
              <div class="form-group mb-3">
                <input type="text" class="form-control" placeholder="Entrer votre nom"/>
              </div>
              <div class="form-group mb-3">
                <input type="email" class="form-control" placeholder="Entrer votre email"/>
              </div>
              <div class="form-group mb-3">
                <textarea class="form-control" rows="5" placeholder="Votre message"></textarea>
              </div>
              <button type="submit" class="btn btn-outline-custom">
                Envoyer
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
   <footer class="bg-primary text-white py-5 mt-3">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-5 col-md-6 col-sm-12">
        <div class="d-flex align-items-center mb-3">
          <img src="./images/Ezstore_blanck.png" alt="EzStore Logo" width="120" class="me-2">
        </div>
        <p class="opacity-75">Solution de gestion de boutique pour professionnels de l'électronique.</p>
        <div class="mt-3">
          <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in"></i></a>
          <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-12">
        <h5 class="fw-bold mb-3">Navigation</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2">
            <a href="#home" class="nav-link p-0 text-white opacity-75 hover-opacity-100">Accueil</a>
          </li>
          <li class="nav-item mb-2">
            <a href="#features" class="nav-link p-0 text-white opacity-75 hover-opacity-100">Fonctionnalités</a>
          </li>
          <li class="nav-item mb-2">
            <a href="#pricing" class="nav-link p-0 text-white opacity-75 hover-opacity-100">Abonnements</a>
          </li>
          <li class="nav-item mb-2">
            <a href="#contact" class="nav-link p-0 text-white opacity-75 hover-opacity-100">Contact</a>
          </li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12">
        <h5 class="fw-bold mb-3">Contact</h5>
        <ul class="list-unstyled">
          <li class="mb-2 d-flex align-items-center">
            <i class="fas fa-envelope me-2"></i>
            <span>angebangue1@gmail.com</span>
          </li>
          <li class="mb-2 d-flex align-items-center">
            <i class="fas fa-phone-alt me-2"></i>
            <span>+237 6 52 56 56 06</span>
          </li>
          <li class="mb-2 d-flex align-items-center">
            <i class="fas fa-map-marker-alt me-2"></i>
            <span>Douala, Cameroun</span>
          </li>
        </ul>
      </div>
    </div>

    <hr class="my-4 opacity-25">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center pt-3">
      <div class="mb-3 mb-md-0">
        &copy; 2025 EzStore. Tous droits réservés.
      </div>
      <div>
        <a href="#" class="text-white text-decoration-none me-3">Conditions d'utilisation</a>
        <a href="#" class="text-white text-decoration-none">Politique de confidentialité</a>
      </div>
    </div>
  </div>
</footer>

<style>
  .bg-primary {
    background-color: #2563eb !important;
  }
  
  .hover-opacity-100:hover {
    opacity: 1 !important;
    text-decoration: underline;
  }
  
  .opacity-75 {
    opacity: 0.75;
  }
  
  footer a {
    transition: all 0.3s ease;
  }
  
  footer i {
    transition: transform 0.3s ease;
  }
  
  footer a:hover i {
    transform: translateY(-3px);
  }
</style>

<script>
  document.querySelectorAll('.btn-follow-cursor').forEach(button => {
    button.addEventListener('mousemove', (e) => {
      const rect = button.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      const centerX = rect.width / 2;
      const centerY = rect.height / 2;

      const moveX = (x - centerX) * 0.2;
      const moveY = (y - centerY) * 0.2;

      button.style.transform = `translate(${moveX}px, ${moveY}px)`;
    });

    button.addEventListener('mouseleave', () => {
      button.style.transform = 'translate(0px, 0px)';
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


