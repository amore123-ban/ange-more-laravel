@extends('layouts.layout_proprio')


@section('content')

<style>
    :root {
      --primary-blue: #2563eb;
      --primary-blue-dark: #1e40af;
      --primary-blue-light: #3b82f6;
      --secondary-color: #3f37c9;
      --accent-color: #4895ef;
      --light-color: #f8f9fa;
      --dark-color: #212529;
      --success-color: #4cc9f0;
      --warning-color: #f72585;
      --sidebar-width: 280px;
      --header-height: 80px;
      --card-radius: 16px;
      --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .main-content {
      margin-left: var(--sidebar-width);
      padding: 5px;
      transition: all 0.3s ease;
    }
    .dashboard-header {
      background: white;
      border-radius: var(--card-radius);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      padding: 15px 25px;
      margin-bottom: 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .welcome-text {
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--primary-color);
      margin: 0;
    }

    .welcome-text span {
      color: var(--secondary-color);
    }

    .search-container {
      position: relative;
      max-width: 400px;
      width: 100%;
    }

    .search-input {
      border-radius: 50px;
      border: 1px solid #e0e0e0;
      height: 45px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
      transition: var(--transition);
    }

    .search-input:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    }

    .search-icon {
      position: absolute;
      left: 10px;
      
      top: 50%; 
      transform: translateY(-50%);
      color: #a0a0a0;
    }

    .user-profile {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: var(--accent-color);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
    }

    
    .product-header {
            background: linear-gradient(135deg, #ffffff 0%, #f0f4ff 100%);
            border-top: 4px solid #2563eb;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-header:hover {
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
    .more-pro-card {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid #f1f5f9;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .more-pro-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-blue), var(--primary-blue-light));
        }

        .more-pro-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.08);
            border-color: rgba(37, 99, 235, 0.1);
        }

        .more-pro-cat {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(59, 130, 246, 0.05));
            color: var(--primary-blue);
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.25rem 0.5rem;
            border-radius: 15px;
            display: inline-block;
            margin-bottom: 0.5rem;
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        .more-pro-nom {
            color: #1f2937 !important;
            font-weight: 600 !important;
            font-size: 1rem !important;
            line-height: 1.3;
            margin-bottom: 0.5rem;
            display: block;
        }


        .more-pro-prix {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700 !important;
            font-size: 1.1rem !important;
            margin-bottom: 0.75rem;
            display: block;
        }


        .more-pro-stock {
            background: rgba(16, 185, 129, 0.05);
            border: 1px solid rgba(16, 185, 129, 0.1);
            border-radius: 6px;
            padding: 0.375rem 0.5rem !important;
            display: flex;
            align-items: center;
            gap: 0.375rem;
            margin-bottom: 0.75rem;
        }

        .stock-indicator {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .stock-high {
            background: #10b981;
            box-shadow: 0 0 0 1px rgba(16, 185, 129, 0.2);
        }

        .more-stock-text {
            font-size: 0.8rem;
            color: #059669;
            font-weight: 500;
        }


        .pro-date {
            background: #f8fafc;
            border-radius: 6px;
            padding: 0.5rem;
            margin: 0.75rem 0 !important;
            border: 1px solid #e2e8f0;
        }

        .create-item, .update-item {
            text-align: center;
            padding: 0.125rem;
        }

        .stat-label {
            font-size: 0.65rem;
            color: #64748b;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .create-item::after {
            content: '15/01/2024';
            display: block;
            font-size: 0.7rem;
            color: #1f2937;
            font-weight: 600;
            margin-top: 0.125rem;
        }

        .update-item::after {
            content: '22/01/2024';
            display: block;
            font-size: 0.7rem;
            color: #1f2937;
            font-weight: 600;
            margin-top: 0.125rem;
        }

        .more-pro-actions {
            gap: 0.375rem;
            margin-top: 1rem;
        }

        .btn-access, .btn-manage {
            background: white;
            border: 1px solid rgb(52, 94, 180);
            border-radius: 6px;
            padding: 0.375rem;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-access::before, .btn-manage::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            transition: left 0.3s ease;
        }

        .btn-access::before {
            background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.1), transparent);
        }

        .btn-manage::before {
            background: linear-gradient(90deg, transparent, rgba(239, 68, 68, 0.1), transparent);
        }

        .btn-access:hover::before {
            left: 100%;
        }

        .btn-manage:hover::before {
            left: 100%;
        }

        .btn-access:hover {
            border-color: rgba(37, 99, 235, 0.3);
            background: rgba(37, 99, 235, 0.02);
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(37, 99, 235, 0.15);
        }

        .btn-manage:hover {
            border-color: rgba(239, 68, 68, 0.3);
            background: rgba(239, 68, 68, 0.02);
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(239, 68, 68, 0.15);
        }

        .btn-access i, .btn-manage i {
            font-size: 0.8rem;
        }

        .create-pro-card {
            background: white;
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 1.25rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 220px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .create-pro-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.02), transparent);
            transition: left 0.5s ease;
        }

        .create-pro-card:hover::before {
            left: 100%;
        }

        .create-pro-card:hover {
            border-color: var(--primary-blue);
            background: rgba(37, 99, 235, 0.01);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
        }

        .create-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .create-pro-card:hover .create-icon {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 3px 12px rgba(37, 99, 235, 0.3);
        }

        .create-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #374151;
            margin: 0;
            position: relative;
            z-index: 2;
            line-height: 1.3;
        }

        .create-pro-card:hover .create-title {
            color: var(--primary-blue);
        }

        @media (max-width: 568px) {
            .more-pro-card {
                padding: 0.875rem;
            }

            .more-pro-actions {
                justify-content: center !important;
            }

            .pro-date .col-md {
                margin-bottom: 0.25rem;
            }

            .create-pro-card {
                min-height: 180px;
                padding: 1rem;
            }

            .more-pro-nom {
                font-size: 0.9rem !important;
            }

            .more-pro-prix {
                font-size: 1rem !important;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .more-pro-card, .create-pro-card {
            animation: fadeInUp 0.5s ease-out;
        }

        .more-pro-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 40px;
            height: 40px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.02) 0%, transparent 70%);
            pointer-events: none;
        }
        
        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
            color: white;
            padding: 1.5rem 2rem;
            border-bottom: none;
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.4rem;
        }

        .btn-close-white {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }

        .btn-close-white:hover {
            opacity: 1;
        }

        .modal-body {
            padding: 2rem;
            background: #fafbfc;
        }

        .modal-footer {
            background: white;
            border-top: 1px solid #e5e7eb;
            padding: 1.5rem 2rem;
        }


        .form-floating {
            margin-bottom: 25px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: white;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
            background-color: white;
        }

        .form-label {
            color: #495057;
            font-weight: 500;
            padding-left: 5px;
        }

        .btn {
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            border: none;
            margin: 5px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #495057;
            border: 2px solid #e9ecef;
        }

        .btn-secondary:hover {
            background: #e9ecef;
            color: #495057;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 25px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .form-actions {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f8f9fa;
        }

        .form-icon {
            color: #2563eb;
            margin-right: 8px;
        }
        .modal-footer {
            padding: 1.5rem 2rem;
            border-top: 1px solid #e5e7eb;
        }

        
        /* Form Styles */
        .form-floating {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-floating > .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 1rem 1rem 1rem 3rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-floating > .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-floating > label {
            padding: 1rem 1rem 1rem 3rem;
            color: #6b7280;
            font-weight: 500;
        }

        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: var(--primary-blue);
            font-weight: 600;
        }
        .form-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-blue);
            z-index: 4;
            font-size: 1rem;
        }

        .form-floating {
            position: relative;
        }

        .form-floating::before {
            content: '';
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: var(--primary-blue);
            z-index: 4;
            font-size: 1rem;
        }

        .form-floating.input-name::before { content: '\f02d'; }
        .form-floating.input-description::before { content: '\f036'; }
        .form-floating.input-price::before { content: '\f153'; }
        .form-floating.input-category::before { content: '\f02c'; }
        .form-floating.input-stock::before { content: '\f1b2'; }
        .form-floating.input-sku::before { content: '\f02a'; }

        .price-container {
            position: relative;
        }

        .price-container::after {
            content: 'FCFA';
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-blue);
            font-weight: 600;
            font-size: 0.9rem;
            z-index: 4;
        }

        .row-fields {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .row-fields .form-floating {
            flex: 1;
            margin-bottom: 0;
        }

        .status-container {
            background: rgba(37, 99, 235, 0.05);
            border: 1px solid rgba(37, 99, 235, 0.1);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.25rem;
        }

        .form-check-input:checked {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
        }

        .form-check-label {
            font-weight: 600;
            color: #1f2937;
        }

        .alert-success {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            border: 1px solid #86efac;
            border-radius: 10px;
            color: #166534;
            margin-bottom: 1.5rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, var(--primary-blue-dark), var(--primary-blue));
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #4b5563;
            transform: translateY(-1px);
            color: white;
        }

        .btn-loading {
            opacity: 0.7;
            pointer-events: none;
        }

        @media (max-width: 568px) {
            .modal-body {
                padding: 1.5rem;
            }

            .modal-footer {
                padding: 1rem 1.5rem;
            }

            .row-fields {
                flex-direction: column;
                gap: 0;
            }

            .row-fields .form-floating {
                margin-bottom: 1.25rem;
            }
        }
  </style>

  <div class="main-content">
    <div class="container-fluid">
    <div class="product-header bg-white rounded-4 shadow-sm p-4 mb-4 border border-primary border-opacity-10">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                
                <div class="d-flex align-items-center flex-grow-1" style="min-width: 300px;">
                    
                    <div class="icon-container rounded-3 bg-primary d-flex align-items-center justify-content-center me-3 shadow">
                        <i class="fas fa-boxes text-white fs-4"></i>
                    </div>
                    
                    <div>
                        <h4 class="title-gradient fw-bold mb-1 fs-5">Gerer vos produits</h4>
                        <small class="text-muted fw-medium">Vue d'ensemble de vos produits</small>
                    </div>
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
            </div>
        </div>
            <div class="row">
                <div class="col-12">
                    <div class="bg-white rounded-3 shadow-sm p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="text-dark fw-bold mb-0">
                                <i class="fas fa-list text-primary me-2"></i>
                                Liste des produits
                            </h5>
                            <button data-bs-toggle="modal" data-bs-target="#createProductModal" class="btn btn-outline-primary rounded-3 px-4">
                                <i class="fas fa-plus me-2"></i>
                                Nouveau produit
                            </button>
                        </div>
                    
                        <div class="row g-3 mb-4">
                            <div class="col-md-3 col-6">
                                <div class="card border-0 bg-primary bg-opacity-10 h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-box text-primary fs-2 mb-2"></i>
                                        <h6 class="text-primary fw-bold mb-1">Total Produits</h6>
                                        <h4 class="text-primary fw-bold mb-0">{{$nbprods}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="card border-0 bg-success bg-opacity-10 h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-check-circle text-success fs-2 mb-2"></i>
                                        <h6 class="text-success fw-bold mb-1">En Stock</h6>
                                        <h4 class="text-success fw-bold mb-0">{{$en_stock}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="card border-0 bg-warning bg-opacity-10 h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-exclamation-triangle text-warning fs-2 mb-2"></i>
                                        <h6 class="text-warning fw-bold mb-1">Stock Faible</h6>
                                        <h4 class="text-warning fw-bold mb-0">{{$faible}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="card border-0 bg-danger bg-opacity-10 h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-times-circle text-danger fs-2 mb-2"></i>
                                        <h6 class="text-danger fw-bold mb-1">Rupture</h6>
                                        <h4 class="text-danger fw-bold mb-0">{{$rupture}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bold text-secondary">
                                            <i class="fas fa-image me-1"></i>Image
                                        </th>
                                        <th class="fw-bold text-secondary">
                                            <i class="fas fa-tag me-1"></i>Produit
                                        </th>
                                        <th class="fw-bold text-secondary">
                                            <i class="fas fa-list me-1"></i>Catégorie
                                        </th>
                                        <th class="fw-bold text-secondary">
                                            <i class="fas fa-money-bill me-1"></i>Prix
                                        </th>
                                        <th class="fw-bold text-secondary">
                                            <i class="fas fa-cubes me-1"></i>Stock
                                        </th>
                                        <th class="fw-bold text-secondary">
                                            <i class="fas fa-toggle-on me-1"></i>Statut
                                        </th>
                                        <th class="fw-bold text-secondary text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prods as $prod)
                                    <tr>
                                        <td>
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{$prod->nom}}</h6>
                                                <small class="text-muted">{{$prod->description}}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">{{$prod->category->nom}}</span>
                                        </td>
                                        <td class="fw-bold text-black">{{$prod->prix}} FCFA</td>
                                        <td>
                                            <span class="badge  bg-primary bg-opacity-10 text-primary px-3 py-2">{{$prod->quantite}}</span>
                                        </td>
                                        <td>
                                            
                                            @if($prod->quantite > $prod->quantite_min)

                                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">En stock</span>

                                            @elseif($prod->quantite <= $prod->quantite_min && $prod->quantite > 0)

                                                <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">Faible</span>

                                            @elseif($prod->quantite== 0)

                                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">En rupture</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-outline-primary btn-sm rounded-start">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm rounded-end">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <nav aria-label="Navigation des pages">
                            <ul class="pagination justify-content-center mt-4">
                                <li class="page-item disabled">
                                    <span class="page-link">Précédent</span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Suivant</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            <div class="modal " id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="createProductModalLabel">
                        <i class="fas fa-plus-circle me-2"></i>
                        Nouveau Produit
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>

                <div class="modal-body">
                  
                    <div class="alert alert-success alert-dismissible fade show d-none" id="successAlert" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        Produit créé avec succès !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <form method="POST" action="/produit-create" id="productForm">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ session('shop_id') }}">
                        <div class="form-floating input-name">
                            <input type="text" class="form-control" name="name" id="productName" placeholder="Nom du produit" required>
                            <label for="productName">Nom du produit</label>
                        </div>


                        <div class="form-floating input-description">
                            <textarea class="form-control" name="description" id="productDescription" placeholder="Description du produit" style="height: 100px" required></textarea>
                            <label for="productDescription">Description</label>
                        </div>
                        <div class="form-floating input-price price-container">
                                <input type="number" class="form-control" name="price" id="productPrice" placeholder="Prix de vente" min="0" step="0.01" required>
                                <label for="productPrice">Prix de vente</label>
                            </div>
                        <div class="row-fields">
                            <div class="form-floating input-stock">
                                <input type="number" class="form-control" name="qte" id="productStock" placeholder="Quantité en stock" min="0" required>
                                <label for="productStock">Quantité en stock</label>
                            </div>
                            <div class="form-floating input-stock">
                                <input type="number" class="form-control" name="qte_min" id="productStock" placeholder="Quantité en stock" min="0" required>
                                <label for="productStock">Stock min</label>
                            </div>
                        </div>

                        <div class="row-fields">
                            <div class="form-floating input-category">

                                <select class="form-control" name="id_categorie" id="productCategory" required>
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach ($cats as $cat)

                                        <option value="{{$cat->id}}"> {{$cat->nom}}</option>
                                    
                                    @endforeach
                                </select>
                                <label for="productCategory">Catégorie</label>

                            </div>

                            <div class="form-floating input-sku">
                                <input type="text" class="form-control" name="sku" id="productSku" placeholder="Code produit (optionnel)">
                                <label for="productSku">Code SKU (optionnel)</label>
                            </div>
                        </div>
                   
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-primary-custom" id="saveProductBtn"">
                        <i class="fas fa-save me-2"></i>Créer le produit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
            
    </div>
            
@endsection