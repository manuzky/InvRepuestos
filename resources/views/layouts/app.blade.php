<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Inventario de Repuestos')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 255px;
            --sidebar-bg: #172033;
            --sidebar-hover: #26344d;
            --primary-color: #2563eb;
        }

        body {
            background: #f1f5f9;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--sidebar-bg);
            color: white;
            z-index: 1040;
            transition: transform .3s;
            overflow-y: auto;
        }

        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 22px;
            font-size: 19px;
            font-weight: bold;
            border-bottom: 1px solid #ffffff15;
            color: white;
            text-decoration: none;
        }

        .sidebar-section {
            color: #8492a8;
            font-size: 11px;
            font-weight: bold;
            padding: 24px 22px 10px;
            text-transform: uppercase;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 22px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 14px;
            transition: .2s;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            color: white;
            background: var(--sidebar-hover);
        }

        .sidebar-link.active {
            border-left: 3px solid #60a5fa;
        }

        .sidebar-link i {
            font-size: 17px;
            width: 20px;
        }

        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .topbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .content {
            padding: 30px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #dbeafe;
            color: #1d4ed8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .sidebar-overlay {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                background: #0008;
                z-index: 1030;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .content {
                padding: 20px 15px;
            }

            .topbar {
                padding: 0 15px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">

        <a href="{{ route('inicio') }}" class="sidebar-brand">
            <i class="bi bi-car-front-fill me-2 text-primary"></i>
            INV REPUESTOS
        </a>

        {{---------------------------------------------------------------------------------------}}

        <div class="sidebar-section">Menú principal</div>

        <a href="{{ route('inicio') }}"
           class="sidebar-link {{ request()->routeIs('inicio') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i>
            Inicio
        </a>

        {{---------------------------------------------------------------------------------------}}

        @if(auth()->user()->canAny(['productos.view', 'categorias.view', 'marcas.view', 'proveedores.view']))
            <div class="sidebar-section">Inventario</div>

            @can('productos.view')
                <a href="#" class="sidebar-link">
                    <i class="bi bi-box-seam"></i>
                    Productos
                </a>
            @endcan

            @can('categorias.view')
                <a href="{{ route('categorias.index') }}"
                class="sidebar-link {{ request()->routeIs('categorias.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i>
                    Categorías
                </a>
            @endcan

            @can('marcas.view')
                <a href="{{ route('marcas.index') }}"
                class="sidebar-link {{ request()->routeIs('marcas.*') ? 'active' : '' }}">
                    <i class="bi bi-award"></i>
                    Marcas
                </a>
            @endcan

            @can('proveedores.view')
                <a href="{{ route('proveedores.index') }}"
                class="sidebar-link {{ request()->routeIs('proveedores.*') ? 'active' : '' }}">
                    <i class="bi bi-truck"></i>
                    Proveedores
                </a>
            @endcan
        @endif

        {{---------------------------------------------------------------------------------------}}

        <div class="sidebar-section">Operaciones</div>

        <a href="#" class="sidebar-link">
            <i class="bi bi-box-arrow-in-down"></i>
            Entradas
        </a>

        <a href="#" class="sidebar-link">
            <i class="bi bi-cart3"></i>
            Ventas
        </a>

        <a href="#" class="sidebar-link">
            <i class="bi bi-person-lines-fill"></i>
            Clientes
        </a>

        {{---------------------------------------------------------------------------------------}}

        @if(auth()->user()->canAny(['usuarios.view', 'cargos.view', 'roles.view']))
            <div class="sidebar-section">Administración</div>

            @can('usuarios.view')
                <a href="{{ route('usuarios.index') }}"
                class="sidebar-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    Usuarios y empleados
                </a>
            @endcan

            @can('cargos.view')
                <a href="{{ route('cargos.index') }}"
                class="sidebar-link {{ request()->routeIs('cargos.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i>
                    Cargos
                </a>
            @endcan

            @can('roles.view')
                <a href="{{ route('roles.index') }}"
                class="sidebar-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                    <i class="bi bi-shield-lock"></i>
                    Roles y permisos
                </a>
            @endcan
        @endif

        {{---------------------------------------------------------------------------------------}}

        <div class="sidebar-section">Sistema</div>

        <a href="#" class="sidebar-link">
            <i class="bi bi-bar-chart-line"></i>
            Reportes
        </a>

    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Contenido principal -->
    <div class="main-wrapper">

        <!-- Header -->
        <header class="topbar">

            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-md-none" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-5"></i>
                </button>

                <span class="fw-semibold text-dark">
                    @yield('title', 'Inicio')
                </span>
            </div>

            <div class="dropdown">
                <button class="btn d-flex align-items-center gap-2"
                        data-bs-toggle="dropdown">

                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="text-start d-none d-sm-block">
                        <div class="fw-semibold small">
                            {{ Auth::user()->name }} {{ Auth::user()->apellidos }}
                        </div>
                        <div class="text-muted" style="font-size: 11px">
                            {{ Auth::user()->getRoleNames()->implode(', ') }}
                        </div>
                    </div>

                    <i class="bi bi-chevron-down small"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li>
                        <span class="dropdown-item-text text-muted small">
                            {{ Auth::user()->email }}
                        </span>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </header>

        <!-- Página -->
        <main class="content">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
    </script>

    @stack('scripts')
</body>
</html>
