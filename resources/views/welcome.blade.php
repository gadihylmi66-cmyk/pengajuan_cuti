<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #8b5cf6;
            --gradient: linear-gradient(135deg, #6366f1, #8b5cf6);

            --bg-main: #f4f6fb;
            --bg-card: #ffffff;

            --text-main: #1f2937;
            --text-secondary: #6b7280;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: var(--bg-main);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 90%;
            max-width: 1100px;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 50px;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
        }

        .nav-btn a {
            text-decoration: none;
            color: var(--text-main);
            padding: 10px 18px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .nav-btn a:hover {
            background: var(--primary);
            color: white;
        }

        .btn-primary {
            background: var(--primary);
            color: white !important;
            font-weight: 600;
        }

        /* Hero */
        .hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero span {
            color: var(--primary);
        }

        .hero p {
            color: var(--text-secondary);
            margin-bottom: 25px;
        }

        .buttons a {
            display: inline-block;
            margin-right: 10px;
            padding: 12px 22px;
            border-radius: 10px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-start {
            background: var(--gradient);
            color: white;
        }

        .btn-start:hover {
            opacity: 0.9;
        }

        .btn-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        /* Card */
        .cards {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card {
            padding: 20px;
            border-radius: 16px;
            background: var(--bg-card);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            margin-bottom: 10px;
            color: var(--primary);
        }

        .card p {
            font-size: 14px;
            color: var(--text-secondary);
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 60px;
            font-size: 14px;
            color: var(--text-secondary);
        }

        /* Animation */
        .fade {
            animation: fadeUp 1s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media(max-width: 768px) {
            .hero {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .buttons a {
                display: block;
                margin: 10px auto;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>

<body>

<div class="container fade">

    <div class="navbar">
        <div class="logo">MyApp</div>

        <div class="nav-btn">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-primary">Register</a>
                @endif
            @endauth
        </div>
    </div>

    <div class="hero">

        <div>
            <h1>
                Welcome to <br>
                <span>Modern App</span>
            </h1>

            <p>
                Aplikasi Laravel modern, ringan, dan siap digunakan untuk kebutuhan bisnis kamu.
            </p>

            <div class="buttons">
                <a href="{{ route('login') }}" class="btn-start">Get Started</a>
                <a href="#" class="btn-outline">Learn More</a>
            </div>
        </div>

        <div class="cards">
            <div class="card">
                <h3>⚡ Fast</h3>
                <p>Performa cepat dan optimal.</p>
            </div>

            <div class="card">
                <h3>🎨 Modern</h3>
                <p>Desain elegan dan kekinian.</p>
            </div>

            <div class="card">
                <h3>🔒 Secure</h3>
                <p>Keamanan terjamin untuk aplikasi.</p>
            </div>
        </div>

    </div>

    <div class="footer">
        © {{ date('Y') }} MyApp. All rights reserved.
    </div>

</div>

</body>
</html>