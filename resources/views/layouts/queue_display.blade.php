<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KUA Banjarmasin Utara - Sistem Antrian</title>
    
    <link rel="icon" href="{{ asset('logo-kemenag.png') }}" type="image/x-icon">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

    <footer class="footer">
        </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>