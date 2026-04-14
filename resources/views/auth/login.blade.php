<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Pesawat Trip.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            background: 
                linear-gradient(rgba(30, 58, 138, 0.7), rgba(59, 130, 246, 0.6)),
                url('https://cdn.pixabay.com/photo/2014/10/07/13/48/mountain-477832_1280.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, 
                rgba(59, 130, 246, 0.2) 0%, 
                rgba(96, 165, 250, 0.2) 50%,
                rgba(30, 58, 138, 0.2) 100%);
            animation: overlayShift 15s ease-in-out infinite;
            z-index: 1;
            pointer-events: none;
        }

        @keyframes overlayShift {
            0%, 100% { opacity: 0.4; transform: translateX(-20px); }
            50% { opacity: 0.6; transform: translateX(20px); }
        }

        .login-container {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 3.5rem 3rem;
            border-radius: 24px;
            box-shadow: 
                0 40px 80px rgba(0,0,0,0.3),
                0 0 0 1px rgba(255,255,255,0.8);
            width: 100%;
            max-width: 420px;
            animation: slideUp 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border: 1px solid rgba(255,255,255,0.5);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 1rem;
            color: #1e3a8a;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            opacity: 0;
            animation: fadeInUp 0.8s ease-out 0.2s forwards;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 2.8rem;
            font-size: 1.05rem;
            font-weight: 500;
            opacity: 0;
            animation: fadeInUp 0.6s ease-out 0.4s forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .form-group:nth-child(2) { animation-delay: 0.3s; }
        .form-group:nth-child(3) { animation-delay: 0.4s; }
        button { animation-delay: 0.5s; }

        label {
            display: block;
            margin-bottom: 0.8rem;
            color: #1f2937;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.025em;
            text-transform: uppercase;
        }

        input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255,255,255,0.95);
            font-family: 'Montserrat', sans-serif;
        }

        input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            transform: translateY(-2px);
        }

        input::placeholder {
            color: #9ca3af;
            font-weight: 500;
        }

        button {
            width: 100%;
            padding: 20px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.025em;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            font-family: 'Montserrat', sans-serif;
            text-transform: uppercase;
            margin-bottom: 2.2rem;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 25px 50px rgba(59, 130, 246, 0.4);
        }

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        button:hover::before {
            left: 100%;
        }

        .register-link {
            text-align: center;
            opacity: 0;
            animation: fadeInUp 0.6s ease-out 0.6s forwards;
        }

        .register-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.025em;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
        }

        .register-link a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .register-link a::after {
            content: '→';
            font-size: 0.9rem;
        }

        @media (max-width: 480px) {
            body {
                background-attachment: scroll;
            }
            .login-box {
                padding: 2.8rem 2.2rem;
                margin: 1rem;
            }
            .logo {
                font-size: 1.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">Pesawat Arga.com</div>
            <p class="subtitle">Masuk ke akun Anda dan lanjutkan perjalanan</p>
            
            <form action="/login" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan alamat email" required>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>
                
                <button type="submit">Masuk Sekarang</button>
            </form>
            
            <div class="register-link">
                <a href="/register">Belum punya akun? Daftar</a>
            </div>
        </div>
    </div>
</body>
</html>



