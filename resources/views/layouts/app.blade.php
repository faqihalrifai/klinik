<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMKLINIK - @yield('title', 'Admin Dashboard')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            overflow-x: hidden;
        }
        
        #wrapper {
            display: flex;
            width: 100%;
        }

        #sidebar {
            width: 250px;
            background: #1abc9c; /* Hijau Toska */
            color: #fff;
            min-height: 100vh;
            transition: all 0.3s;
            position: fixed;
            z-index: 100;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #16a085; /* Slightly darker */
            text-align: center;
        }

        #sidebar .sidebar-header h3 {
            margin: 0;
            font-weight: 700;
            letter-spacing: 1px;
        }

        #sidebar .user-profile {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        #sidebar .user-profile img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 3px solid rgba(255,255,255,0.3);
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 1.05em;
            display: block;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: 0.3s;
        }

        #sidebar ul li a:hover, #sidebar ul li.active > a {
            background: #16a085;
            color: #fff;
            border-left: 4px solid #fff;
        }

        #sidebar ul li a i {
            width: 25px;
            text-align: center;
            margin-right: 10px;
        }

        #page-content-wrapper {
            width: calc(100% - 250px);
            margin-left: 250px;
            transition: all 0.3s;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            background: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-main {
            padding: 30px;
            flex-grow: 1;
        }

        /* Card Colors */
        .card-pink { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
        .card-green { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
        .card-blue { background-color: #d1ecf1; border-color: #bee5eb; color: #0c5460; }
        .card-yellow { background-color: #fff3cd; border-color: #ffeeba; color: #856404; }

        .stat-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.2s;
            margin-bottom: 20px;
            border: 0;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        .stat-card .card-body {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-card .icon {
            font-size: 3rem;
            opacity: 0.7;
        }

        .stat-card .inner h3 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }

        .stat-card .inner p {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f0f0f0;
            font-weight: 600;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }
            #sidebar.active {
                margin-left: 0;
            }
            #page-content-wrapper {
                width: 100%;
                margin-left: 0;
            }
            #page-content-wrapper.active {
                transform: translateX(250px);
            }
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>SIMKLINIK</h3>
            </div>
            
            <div class="user-profile">
                <img src="https://ui-avatars.com/api/?name=Admin&background=ffffff&color=1abc9c" alt="User">
                <h5 class="mb-0 mt-2">Administrator</h5>
                <small><i class="fas fa-circle text-success" style="font-size: 0.6em;"></i> Online</small>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                </li>
                <li class="{{ request()->routeIs('pasien.*') ? 'active' : '' }}">
                    <a href="{{ route('pasien.index') }}"><i class="fas fa-users"></i> Data Pasien</a>
                </li>
                <li class="{{ request()->routeIs('dokter.*') ? 'active' : '' }}">
                    <a href="{{ route('dokter.index') }}"><i class="fas fa-user-md"></i> Data Dokter</a>
                </li>
                <li class="{{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                    <a href="{{ route('jadwal.index') }}"><i class="fas fa-calendar-alt"></i> Jadwal Konsultasi</a>
                </li>
                <li class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                    <a href="{{ route('laporan.index') }}"><i class="fas fa-file-medical-alt"></i> Laporan Medis</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Top Navbar -->
            <nav class="top-navbar">
                <div>
                    <button class="btn btn-outline-secondary d-md-none" id="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h4 class="mb-0 ms-2 d-inline-block text-secondary" style="font-weight: 600;">@yield('title', 'Dashboard')</h4>
                </div>
                <div>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=1abc9c&color=fff" alt="User" class="rounded-circle me-2" width="35">
                            <span class="d-none d-sm-inline">Administrator</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm me-2 text-muted"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog fa-sm me-2 text-muted"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt fa-sm me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="content-main">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("menu-toggle").addEventListener("click", function(e) {
            e.preventDefault();
            document.getElementById("sidebar").classList.toggle("active");
            document.getElementById("page-content-wrapper").classList.toggle("active");
        });
    </script>
</body>
</html>
