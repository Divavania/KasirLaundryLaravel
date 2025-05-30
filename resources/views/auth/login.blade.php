<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Khalifah Laundry</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #e8f5e9, #f5f5f5);
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow: hidden;
        }
        body.dark-mode {
            background: #121212 !important;
            color: #e0e0e0 !important;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="30" cy="30" r="15" fill="rgba(40,167,69,0.08)"/><circle cx="170" cy="50" r="10" fill="rgba(40,167,69,0.1)"/><circle cx="100" cy="150" r="20" fill="rgba(40,167,69,0.08)"/><circle cx="50" cy="100" r="8" fill="rgba(40,167,69,0.12)"/></svg>');
            background-size: 300px;
            opacity: 0.2;
            z-index: -1;
            animation: float 20s infinite linear;
        }
        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0); }
        }
        .login-container {
            background: #ffffff;
            padding: 30px 25px;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 95%;
            position: relative;
            animation: fadeIn 0.6s ease forwards;
            border: 1px solid rgba(40, 167, 69, 0.15);
        }
        body.dark-mode .login-container {
            background: #2a2a2a !important;
            border-color: #444 !important;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2e7d32;
            font-weight: 600;
            font-size: 24px;
            letter-spacing: 0.3px;
        }
        body.dark-mode h2 {
            color: #a5d6a7 !important;
        }
        h2::before {
            content: '\f7e4';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            display: block;
            font-size: 32px;
            color: #28a745;
            margin-bottom: 8px;
            opacity: 0.8;
        }
        body.dark-mode h2::before {
            color: #a5d6a7 !important;
        }
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        .input-group i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #28a745;
            font-size: 14px;
        }
        body.dark-mode .input-group i {
            color: #a5d6a7 !important;
        }
        .input-group input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #d4edda;
            border-radius: 6px;
            background-color: #f8faf8;
            font-size: 14px;
            transition: all 0.3s ease;
            box-sizing: border-box;
            color: #333;
        }
        body.dark-mode .input-group input {
            background: #333 !important;
            border-color: #444 !important;
            color: #e0e0e0 !important;
        }
        .input-group input:focus {
            border-color: #2e7d32;
            background-color: #fff;
            box-shadow: 0 0 6px rgba(46, 125, 50, 0.2);
            outline: none;
        }
        body.dark-mode .input-group input:focus {
            border-color: #a5d6a7 !important;
            background: #444 !important;
            box-shadow: 0 0 6px rgba(165, 214, 167, 0.2) !important;
        }
        .input-group input::placeholder {
            color: #999;
            font-weight: 300;
        }
        body.dark-mode .input-group input::placeholder {
            color: #aaa !important;
        }
        .btn-success {
            background: #28a745;
            border-color: #28a745;
            color: #fff;
            padding: 10px 30px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-align: center;
        }
        .btn-success:hover {
            background: #2e7d32;
            border-color: #2e7d32;
            box-shadow: 0 3px 8px rgba(46, 125, 50, 0.2);
            transform: translateY(-1px);
        }
        .alert-danger, .alert-success {
            font-size: 13px;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 6px;
            font-weight: 400;
            text-align: center;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        body.dark-mode .alert-danger {
            background: #5c2a2f !important;
            border-color: #7a3a3f !important;
            color: #f8d7da !important;
        }
        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }
        body.dark-mode .alert-success {
            background: #3a4e3b !important;
            border-color: #5a6e5b !important;
            color: #e8f5e9 !important;
        }
        .dark-mode-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        @media (max-width: 400px) {
            .login-container {
                padding: 20px 15px;
            }
            h2 {
                font-size: 20px;
            }
            h2::before {
                font-size: 28px;
            }
            .input-group input {
                padding: 8px 15px 8px 35px;
                font-size: 13px;
            }
            .btn-success {
                padding: 8px 20px;
                font-size: 14px;
            }
            .dark-mode-toggle {
                top: 10px;
                right: 10px;
            }
        }
    </style>
</head>
<body>
    <button id="darkModeToggle" class="btn btn-sm btn-outline-success dark-mode-toggle" title="Toggle Dark Mode">
        <i id="darkModeIcon" class="fas fa-moon"></i>
    </button>
    <div class="login-container">
        <h2>Login Kasir Laundry</h2>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" id="username" name="username" placeholder="Masukkan username" value="{{ old('username') }}" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <div class="btn-wrapper">
                <button type="submit" class="btn-success">Login</button>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dark mode persistence
        const toggleButton = document.getElementById('darkModeToggle');
        const icon = document.getElementById('darkModeIcon');

        // Apply saved mode on page load
        const savedMode = localStorage.getItem('theme') || 'light';
        if (savedMode === 'dark') {
            document.body.classList.add('dark-mode');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        } else {
            document.body.classList.remove('dark-mode');
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        }

        // Toggle dark mode on button click
        toggleButton.addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');
            const isDarkMode = document.body.classList.contains('dark-mode');
            localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
            icon.classList.toggle('fa-moon', !isDarkMode);
            icon.classList.toggle('fa-sun', isDarkMode);
        });
    </script>
</body>
</html>