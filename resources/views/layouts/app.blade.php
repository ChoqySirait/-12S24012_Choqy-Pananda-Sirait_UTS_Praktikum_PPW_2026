<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEL Lab Equipment & Asset Tracking System - DEL-LEATS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --del-navy: #003366;
            --del-navy-dark: #002244;
            --del-gold: #f4b41a;
        }
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .bg-del-navy {
            background-color: var(--del-navy) !important;
        }
        .text-del-gold {
            color: var(--del-gold) !important;
        }
        .btn-del-primary {
            background-color: var(--del-navy);
            color: #ffffff;
            border: none;
        }
        .btn-del-primary:hover {
            background-color: var(--del-navy-dark);
            color: var(--del-gold);
        }
        .badge-tersedia { background-color: #d1e7dd; color: #0f5132; }
        .badge-dipinjam { background-color: #fff3cd; color: #664d03; }
        .badge-dalam_perbaikan { background-color: #f8d7da; color: #842029; }
        .card-img-asset { height: 190px; object-fit: cover; }
        .cis-header-title {
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <header class="bg-del-navy text-white py-2 border-bottom border-warning border-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-white text-dark rounded-circle px-2 py-1 fw-bold fs-5 text-del-navy">
                    DEL
                </div>
                <div>
                    <h1 class="h6 mb-0 fw-bold cis-header-title text-uppercase">INSTITUT TEKNOLOGI DEL</h1>
                    <small class="text-del-gold" style="font-size: 0.78rem;">Sistem Informasi Pelayanan Inventaris & Aset Lab (DEL-LEATS)</small>
                </div>
            </div>
            <div class="d-none d-md-block text-end">
                <small class="d-block text-white-50" style="font-size: 0.75rem;">Laboratorium Sistem Informasi & Komputer</small>
                <small class="badge bg-warning text-dark fw-bold">IS - Integrated Services</small>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-2">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#delNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="delNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('equipments.index') ? 'active text-del-gold fw-bold' : '' }}" href="{{ route('equipments.index') }}">
                            <i class="bi bi-grid-3x3-gap-fill me-1"></i> Katalog Aset
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('equipments.create') ? 'active text-del-gold fw-bold' : '' }}" href="{{ route('equipments.create') }}">
                            <i class="bi bi-plus-circle-fill me-1"></i> Tambah Aset
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('loans.create') ? 'active text-del-gold fw-bold' : '' }}" href="{{ route('loans.create') }}">
                            <i class="bi bi-journal-arrow-up me-1"></i> Ajukan Peminjaman
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4 flex-grow-1">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-del-navy text-white text-center py-3 mt-auto border-top border-warning border-2">
        <div class="container">
            <small class="d-block">&copy; {{ date('Y') }} <strong>Institut Teknologi Del ( IT DEL)</strong></small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>