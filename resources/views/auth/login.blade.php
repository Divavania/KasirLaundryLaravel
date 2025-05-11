<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Kasir Laundry</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
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
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="30" cy="30" r="20" fill="rgba(76,175,80,0.1)"/><circle cx="170" cy="50" r="15" fill="rgba(76,175,80,0.15)"/><circle cx="100" cy="150" r="25" fill="rgba(76,175,80,0.1)"/><circle cx="50" cy="100" r="10" fill="rgba(76,175,80,0.2)"/></svg>');
            background-size: 300px;
            opacity: 0.3;
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
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 90%;
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.8s ease forwards;
            border: 1px solid rgba(76, 175, 80, 0.2);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: #4caf50;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2e7d32;
            font-weight: 700;
            font-size: 28px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        h2::before {
            content: '\f7e4';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            display: block;
            font-size: 40px;
            color: #4caf50;
            margin-bottom: 10px;
            opacity: 0.8;
        }
        .input-group {
            position: relative;
            margin-bottom: 25px;
        }
        .input-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #4caf50;
            font-size: 16px;
        }
        .input-group input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            background-color: #f8faf8;
            font-size: 14px;
            transition: all 0.3s ease;
            box-sizing: border-box;
            color: #333;
        }
        .input-group input:focus {
            border-color: #2e7d32;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(46, 125, 50, 0.2);
            outline: none;
        }
        .input-group input::placeholder {
            color: #999;
            font-weight: 300;
        }
        .btn-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        button {
            background: #4caf50;
            color: #fff;
            padding: 14px 40px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        button:hover {
            background: #2e7d32;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
            transform: translateY(-2px);
        }
        button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        button:active::after {
            width: 200px;
            height: 200px;
        }
        .error-message, .success-message {
            text-align: center;
            font-size: 13px;
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 10px;
            font-weight: 400;
        }
        .error-message {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }
        .success-message {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }
        @media (max-width: 400px) {
            .login-container {
                padding: 30px 20px;
                width: 95%;
            }
            h2 {
                font-size: 24px;
            }
            h2::before {
                font-size: 32px;
            }
            button {
                padding: 12px 30px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Kasir Laundry</h2>

        @if (session('error'))
            <div class="error-message">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" id="username" name="username" placeholder="Masukkan username">
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Masukkan password">
            </div>

            <div class="btn-wrapper">
                <button type="submit">Login</button>
            </div>
        </form>

        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>