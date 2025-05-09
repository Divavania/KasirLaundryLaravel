<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Kasir Laundry</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f5f5f5;
            font-family: 'Poppins', sans-serif;
        }
    
        .login-container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            width: 380px;
            animation: fadeIn 1s ease forwards;
        }
    
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2e7d32;
            font-weight: 700;
            font-size: 26px;
        }
    
        .input-group {
            position: relative;
            margin-bottom: 20px;
            padding-left: 5px;
            padding-right: 5px;
        }
    
        .input-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #999;
        }
    
        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            font-size: 14px;
            transition: 0.3s;
            box-sizing: border-box;
        }
    
        .input-group input:focus {
            border-color: #4caf50;
            background-color: #fff;
            outline: none;
        }
    
        .btn-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
    
        button {
            background: #4caf50;
            color: #fff;
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.3s;
        }
    
        button:hover {
            background: #388e3c;
        }
    
        .error-message, .success-message {
            text-align: center;
            font-size: 14px;
            margin-bottom: 16px;
            padding: 10px;
            border-radius: 8px;
        }
    
        .error-message {
            background-color: #ffebee;
            color: #c62828;
        }
    
        .success-message {
            background-color: #e8f5e9;
            color: #2e7d32;
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