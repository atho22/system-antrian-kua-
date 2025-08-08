<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KUA Banjarmasin Utara - Sistem Antrian</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --kemenag-green: #00923F;
            --kemenag-dark-green: #006F2F;
            --kemenag-light-green: #B5E8B9;
            --kemenag-yellow: #FFB81C;
            --kemenag-dark: #1E293B;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8FAFC;
        }
        
        .navbar-kemenag {
            background: linear-gradient(135deg, var(--kemenag-green) 0%, var(--kemenag-dark-green) 100%);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: 600;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white !important;
        }
        
        .kemenag-gradient {
            background: linear-gradient(135deg, var(--kemenag-green) 0%, var(--kemenag-dark-green) 100%);
        }
        
        .kemenag-secondary {
            background-color: var(--kemenag-yellow);
        }
        
        .btn-kemenag {
            background: linear-gradient(135deg, var(--kemenag-green) 0%, var(--kemenag-dark-green) 100%);
            border: none;
            color: white;
            font-weight: 500;
        }
        
        .btn-kemenag:hover {
            background: linear-gradient(135deg, var(--kemenag-dark-green) 0%, var(--kemenag-dark-green) 100%);
            color: white;
        }

        .footer {
            background: var(--kemenag-dark);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-kemenag">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="https://kua.kemenag.go.id/assets/images/logo-kemenag.png" alt="Logo Kemenag" height="40" class="me-2">
                <div>
                    <div class="fs-5">KUA Banjarmasin Utara</div>
                    <div class="small opacity-75">Kementerian Agama Republik Indonesia</div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('guest.create') }}">
                            <i class="fas fa-edit me-2"></i>Form Input
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('antrian*') ? 'active' : '' }}" href="{{ route('queue.index') }}">
                            <i class="fas fa-list-ol me-2"></i>Daftar Antrian
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('riwayat*') ? 'active' : '' }}" href="{{ route('queue.history') }}">
                            <i class="fas fa-history me-2"></i>Riwayat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-user-cog me-2"></i>Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @if(session('success'))
        <div class="container mb-4">
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="container mb-4">
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="mb-3">KUA Banjarmasin Utara</h5>
                    <p class="mb-0 opacity-75">Kementerian Agama Republik Indonesia</p>
                    <p class="opacity-75">Sistem Antrian Online</p>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <p class="mb-0 opacity-75">© {{ date('Y') }} KUA Banjarmasin Utara</p>
                    <p class="opacity-75">Kementerian Agama Republik Indonesia</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 