<!-- resources/views/errors/minimal.blade.php -->
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'Error')</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg:#0f1724; /* dark slate */
      --card:#0b1220;
      --accent:#60a5fa; /* blue-400 */
      --muted:#94a3b8;
      --danger:#ef4444;
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;font-family:Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;background:linear-gradient(180deg,#071024 0%,#0b1730 100%);color:#e6eef8}
    .wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px}
    .card{width:100%;max-width:720px;background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));border:1px solid rgba(255,255,255,0.04);backdrop-filter:blur(6px);padding:28px;border-radius:14px;box-shadow:0 10px 30px rgba(2,6,23,0.6);display:grid;grid-template-columns:120px 1fr;gap:20px;align-items:center}
    .code{font-size:56px;font-weight:700;color:var(--accent);text-align:center}
    .content h1{margin:0;font-size:20px;letter-spacing:0.02em}
    .content p{margin:8px 0 0;color:var(--muted);line-height:1.5}
    .actions{margin-top:18px;display:flex;gap:12px;flex-wrap:wrap}
    .btn{display:inline-block;padding:10px 16px;border-radius:10px;text-decoration:none;font-weight:600}
    .btn-primary{background:linear-gradient(90deg,var(--accent),#3b82f6);color:#05203b}
    .btn-secondary{background:transparent;border:1px solid rgba(255,255,255,0.06);color:var(--muted)}
    .meta{font-size:13px;color:rgba(230,238,248,0.38);margin-top:10px}

    /* responsive */
    @media (max-width:520px){
      .card{grid-template-columns:1fr; text-align:center}
      .content{order:2}
      .code{order:1;font-size:48px}
      .actions{justify-content:center}
    }

    /* utility */
    .debug{font-family:monospace;color:#94a3b8;font-size:12px;margin-top:12px}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card" role="presentation" aria-labelledby="error-title">
      <div class="code" aria-hidden="true">@yield('code')</div>

      <div class="content">
        <h1 id="error-title">@yield('message')</h1>
        <p>@yield('description', 'Terjadi kesalahan pada server. Silakan coba lagi atau hubungi administrator jika masalah berlanjut.')</p>

        <div class="actions">
          <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
          <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="meta">
          @if(isset($exception))
            <div class="debug">Code: {{ $exception->getCode() }} &middot; File: {{ basename($exception->getFile()) }}:{{ $exception->getLine() }}</div>
          @endif
        </div>
      </div>
    </div>
  </div>
</body>
</html>