<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - <?php echo get_setting('site_title'); ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom Admin CSS -->
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }
        
        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-radius: 0;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 3px solid var(--accent-color);
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }
        
        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            background-color: var(--primary-color);
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }
        
        .navbar .form-control {
            padding: .75rem 1rem;
            border-width: 0;
            border-radius: 0;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            border: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--accent-color) 0%, #2980b9 100%);
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }
        
        .btn-success {
            background: linear-gradient(135deg, var(--success-color) 0%, #229954 100%);
            border: none;
            border-radius: 25px;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #e67e22 100%);
            border: none;
            border-radius: 25px;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, var(--danger-color) 0%, #c0392b 100%);
            border: none;
            border-radius: 25px;
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead th {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            font-weight: 600;
        }
        
        .badge {
            border-radius: 15px;
            padding: 5px 10px;
        }
        
        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .pagination .page-link {
            border-radius: 50px;
            margin: 0 2px;
            border: none;
            color: var(--primary-color);
        }
        
        .pagination .page-link:hover,
        .pagination .page-item.active .page-link {
            background-color: var(--accent-color);
            color: white;
        }
        
        @media (max-width: 767.98px) {
            .sidebar {
                top: 5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Top Navigation -->
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-white" href="index.php">
            <i class="fas fa-truck me-2"></i>
            İstanbul Nakliyat Admin
        </a>
        
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3 text-white" href="logout.php">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    Çıkış Yap
                </a>
            </div>
        </div>
    </nav>