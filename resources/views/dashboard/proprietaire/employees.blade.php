@extends('layouts.layout_proprio')

@section('content')
<!-- En-tête META et CSS -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    :root {
        --primary-color: #2563eb;
        --primary-hover: #1d4ed8;
        --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        --card-hover-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
      --primary-blue: #2563eb;
      --primary-blue-dark: #1e40af;
      --primary-blue-light: #3b82f6;
      --sidebar-width: 280px;
       --color-blue-300:rgb(165, 192, 230);
    }

    .main-content {
      margin-left: var(--sidebar-width);
      padding: 20px;
      background: linear-gradient(135deg, #ffffff 0%, rgb(165, 192, 230) 100%);
      min-height: 100vh;
    }

    .sale-header {
        background: linear-gradient(135deg, #ffffff 0%, #f0f4ff 100%);
        border-top: 4px solid #2563eb;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .sale-header:hover {
        transform: translateY(-2px);
    }

    .icon-container {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        width: 60px;
        height: 60px;
        transition: transform 0.3s ease;
    }

    .icon-container:hover {
        transform: scale(1.05);
    }

    .boutique-select {
        background: linear-gradient(135deg, #fff5f5, #ffe5e5);
        border: 2px solid #fed7d7;
        color: #dc3545;
        transition: all 0.3s ease;
    }

    .boutique-select:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .boutique-select:hover {
        border-color: #dc3545;
        transform: translateY(-1px);
    }

    .title-gradient {
        background: linear-gradient(135deg, #2d3748, #4a5568);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .search-container {
        position: relative;
        width: 620px;
    }

    .search-input {
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        padding-left: 45px;
        height: 45px;
        width:600px;
        transition: all 0.3s ease;
        background: white;
    }

    .search-input:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary-blue);
        z-index: 5;
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

    .btn-add {
        background: var(--primary-blue);
        border: none;
        color: white;
        padding: 0.5rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-add:hover {
        background: var(--primary-blue-dark);
        transform: translateY(-1px);
        color: white;
    }

   
    .modal-content {
            border-radius: 25px;
            border: none;
            box-shadow: 0 30px 80px rgba(37, 99, 235, 0.15);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 50%, #6366f1 100%);
            color: white;
            border-bottom: none;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .modal-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
            opacity: 0.3;
        }

        .modal-header > * {
            position: relative;
            z-index: 1;
        }

        .modal-body {
            padding: 3rem;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        }

        .form-floating {
            position: relative;
            margin-bottom: 2rem;
        }

        .form-control {
            border-radius: 15px;
            border: 2px solid #e2e8f0;
            padding: 1.5rem 1.25rem 0.75rem;
            font-size: 1.1rem;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            background: white;
            box-shadow: 0 2px 10px rgba(37, 99, 235, 0.02);
            height: auto;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 6px #3b82f6;
            background: white;
            transform: translateY(-2px);
        }

        .form-control:not(:placeholder-shown) {
            border-color: var(--primary-color);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.05);
        }

        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            opacity: 1;
            transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
            color: var(--primary-color);
            font-weight: 600;
        }

        .form-floating > label {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            padding: 1.5rem 1.25rem 0.75rem;
            overflow: hidden;
            text-align: start;
            text-overflow: ellipsis;
            white-space: nowrap;
            pointer-events: none;
            border: 2px solid transparent;
            transform-origin: 0 0;
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
            color: #6b7280;
            font-weight: 500;
            font-size: 1.1rem;
        }

        .form-label {
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }

        .form-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1rem;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
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
        animation: fadeInUp 0.5s ease-out;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
            padding: 16px;
        }

        .search-container {
            max-width: 100%;
            margin-bottom: 1rem;
        }

        .sales-header .row > div {
            margin-bottom: 1rem;
        }

        .modal-dialog.modal-lg {
            margin: 10px;
            max-width: calc(100vw - 20px);
        }
    }
     body {
            background-color: #f8f9fa;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        }
        
        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .employee-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            border: none;
            overflow: hidden;
        }
        
        .employee-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-hover-shadow);
        }
        
        .employee-image {
            height: 120px;
            width: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid var(--primary-color);
            margin: 0 auto;
        }
        
        .employee-details {
            padding: 1.5rem;
        }
        
        .employee-name {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .employee-position {
            color: #6c757d;
            font-weight: 500;
        }
        
        .employee-contact {
            border-top: 1px solid #e9ecef;
            padding-top: 1rem;
            margin-top: 1rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        .section-title {
            position: relative;
            padding-bottom: 0.5rem;
            margin-bottom: 2rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .action-buttons .btn {
            margin-right: 0.5rem;
        }
</style>

<div class="main-content">
    <div class="container-fluid">
        
        <div class="sale-header bg-white rounded-4 shadow-sm p-4 mb-4 border border-primary border-opacity-10">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                
                <div class="d-flex align-items-center flex-grow-1" style="min-width: 300px;">
                    
                    <div class="icon-container rounded-3 bg-primary d-flex align-items-center justify-content-center me-3 shadow">
                        <i class="fas fa-users text-white fs-4"></i>
                    </div>
                    
                    <div>
                        <h4 class="title-gradient fw-bold mb-1 fs-5">Gerer vos employes</h4>
                        <small class="text-muted fw-medium">Vue d'ensemble sur vos employes</small>
                    </div>
                </div>
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchProduct" class=" search-input" placeholder="Rechercher un employe...">
                </div>
                
                <div style="min-width: 250px;">
                    <label class="form-label text-secondary fw-semibold text-uppercase small mb-2">
                        <i class="fas fa-filter me-1"></i>
                        Filtrer par boutique
                    </label>
                    <form action="#" method="GET" id="boutiqueFilterForm">
                      @csrf
                        <select name="shop_id" id="boutiqueSelect" class="boutique-select form-select fw-semibold rounded-3 shadow-sm">
                          @if($shop)
                              <option value="{{ $shop->id }}"
                                  {{ request('shop_id') == $shop->id ? 'selected' : '' }}>
                                  {{ $shop->nom }}
                              </option>
                          @endif
                        </select>
                    </form>
                </div>
                <div class="dropdown">
                    <button class=" boutique-selector dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar me-2 align-items-center">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="d-none d-md-block text-start me-2">
                            <div class="fw-semibold small">{{ Auth::user()->name ?? 'Utilisateur' }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Administrateur</div>
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
                            <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Se déconnecter
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="noProductsMessage" class="alert alert-info d-none">
            Aucun produit ne correspond à votre recherche.
        </div>

        <div class="row g-4 shadow-2 shadow-black mt-3 d-flex justify-content-end">
            
            <div class="modal" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <div>
                                <h4 class="modal-title mb-2" id="addEmployeeModalLabel">
                                    <i class="fas fa-user-plus me-3"></i>Ajouter un Nouvel Employé
                                </h4>
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/employe-create" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md">
                                        <div class="mb-4">
                                            <label for="employeeName" class="form-label">
                                                <i class="fas fa-user me-2" style="color: var(--primary-color);"></i>Nom Complet
                                            </label>
                                            <input type="text" class="form-control" name="name" id="employeeName" placeholder="Ex: Jean Dupont" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="employeeEmail" class="form-label">
                                                <i class="fas fa-envelope me-2" style="color: var(--primary-color);"></i>Adresse Email
                                            </label>
                                            <input type="email" class="form-control" name="email" id="employeeEmail" placeholder="Ex: jean.dupont@entreprise.com" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 pt-0">
                                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                                        <i class="fas fa-times me-2"></i>Annuler
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="submitEmployee">
                                        <span class="loading-spinner spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                        <i class="fas fa-paper-plane me-2"></i>Ajouter et Inviter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="section-title">Liste des Employés</h2>
            </div>
           <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <button class="btn btn-add btn-lg shadow" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                    <i class="fas fa-user-plus me-2"></i>Ajouter un employé
                </button>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($employes as $employe)
            <div class="col-md-6 col-lg-4">
                <div class="employee-card">
                    <div class="text-center pt-4">
                        {{-- <img src="{{ $employe->photo_url ?? 'https://via.placeholder.com/120' }}" class="employee-image"> --}}
                    </div>
                    <div class="employee-details">
                        <h5 class="employee-name">{{ $employe->name }}</h5>
                        <p class="employee-position">Employé(e)</p>
                        <p class="mb-2">
                            <i class="fas fa-building me-2 text-muted"></i>
                            {{ $shop->nom  ?? 'Boutique inconnue' }}
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-calendar me-2 text-muted"></i>
                            Employé depuis: {{ $employe->created_at }}
                        </p>
                        
                        <div class="employee-contact">
                            <p class="mb-1"><i class="fas fa-phone me-2 text-muted"></i> {{ $employe->phone ?? 'Non renseigné' }}</p>
                            <p class="mb-0">
                                <i class="fas fa-envelope me-2 text-muted"></i>
                                {{ $employe->email }}
                            </p>
                        </div>
                        
                        <div class="action-buttons mt-3">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cet employé ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>

@endsection