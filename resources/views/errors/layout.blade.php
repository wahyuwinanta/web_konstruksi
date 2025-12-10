<!-- resources/views/errors/layout.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Terjadi Kesalahan')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        :root {
            --bg: #f2f5fb;
            --surface: #ffffff;
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --text: #1e293b;
            --muted: #64748b;
            --radius: 18px;
            --shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg);
            font-family: 'Poppins', sans-serif;
            color: var(--text);
        }

        .card {
            background: var(--surface);
            padding: 48px 38px;
            width: 92%;
            max-width: 560px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            text-align: center;
            animation: slideUp 0.4s ease;
        }

        .code {
            font-size: 72px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .message {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 14px;
        }

        .desc {
            font-size: 16px;
            color: var(--muted);
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 12px 22px;
            border-radius: var(--radius);
            font-weight: 600;
            text-decoration: none;
            background: var(--primary);
            color: #fff;
            transition: 0.2s ease;
        }

        .btn:hover {
            background: var(--primary-dark);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="code">@yield('code', 'Error')</div>
        <div class="message">@yield('message')</div>
        <div class="desc">@yield('description', 'Terjadi kesalahan pada sistem. Silakan coba lagi nanti.')</div>
        <a class="btn" href="{{ url('/') }}">Kembali ke Beranda</a>
    </div>

</body>

</html>
