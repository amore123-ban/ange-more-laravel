<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Employé - EzStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        .dropdown-menu {
            display: none;
            position: absolute;
            z-index: 1000;
            min-width: 10rem;
            padding: 0.5rem 0;
            margin: 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 0.375rem;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.25rem 1rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            text-decoration: none;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
        }

        .dropdown-item:hover {
            color: #1e2125;
            background-color: #e9ecef;
        }

        .custom-dropdown {
            position: relative;
            display: inline-block;
        }

        .custom-dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            min-width: 200px;
            padding: 0.5rem 0;
            margin: 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 0.375rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .custom-dropdown-menu.show {
            display: block;
        }

        .custom-dropdown-item {
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            text-decoration: none;
            white-space: nowrap;
            background-color: #fff;
            border: 0;
            cursor: pointer;
        }

        .custom-dropdown-item:hover {
            color: #1e2125;
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <section class="">
        <!-- Sidebar pour employé -->
        @include('dashboard.employe.sidebar')

        {{-- Contenu principal --}}
        <div class="">
            <div class="topbar" style="margin-left:280px;">
                <!-- Topbar -->
            </div>
            <!-- Contenu de la page -->
            <main>
                @yield('content')
            </main>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function toggleShopDropdown() {
            const dropdownMenu = document.getElementById('shop-dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.toggle('show');
                console.log('Dropdown toggled');
            }
        }
        
        // Fermer le dropdown quand on clique ailleurs
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.custom-dropdown');
            const dropdownMenu = document.getElementById('shop-dropdown-menu');
            
            if (dropdown && dropdownMenu) {
                if (!dropdown.contains(event.target)) {
                    dropdownMenu.classList.remove('show');
                }
            }
        });
    </script>
</body>
</html>