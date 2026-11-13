<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Rekomendasi Solusi IT')</title>
    <style>
        :root {
            --bg: #f5f8f5;
            --surface: #ffffff;
            --text: #202b24;
            --muted: #718078;
            --border: #e1e9e3;
            --primary: #198754;
            --primary-dark: #146c43;
            --primary-soft: #e8f5ec;
            --good: #12805c;
            --good-bg: #e3f6ee;
            --mid: #a45a00;
            --mid-bg: #fff1dc;
            --low: #b42318;
            --low-bg: #fde8e6;
            --shadow: 0 1px 2px rgba(16,24,40,.06),
                    0 8px 24px rgba(16,24,40,.06);
        }
        @media (prefers-color-scheme: dark) {
        :root {
            --bg: #101a14;
            --surface: #19271e;
            --text: #e8f1ea;
            --muted: #a0b2a5;
            --border: #304438;
            --primary: #4caf72;
            --primary-dark: #65c989;
            --primary-soft: #243d2d;
            --good: #4ade9b;
            --good-bg: #12302a;
            --mid: #fbbf5c;
            --mid-bg: #3a2c12;
            --low: #ff8a80;
            --low-bg: #3a1a1a;
            --shadow: 0 1px 2px rgba(0,0,0,.4),
                    0 8px 24px rgba(0,0,0,.3);
        }
    }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.55;
        }
        .wrap { max-width: 820px; margin: 0 auto; padding: 0 20px; }

        /* Header */
        .topbar { background: var(--surface); border-bottom: 1px solid var(--border); }
        .topbar .wrap { display: flex; align-items: center; justify-content: space-between; height: 64px; }
        .brand { display: flex; align-items: center; gap: 10px; font-weight: 700; color: var(--text); text-decoration: none; }
        .brand .logo {
            width: 36px; height: 36px; border-radius: 10px; display: grid; place-items: center;
            background: linear-gradient(135deg, #198754, #36A568); color: #fff;
        }
        .nav a { color: var(--muted); text-decoration: none; font-size: 14px; font-weight: 600; margin-left: 18px; }
        .nav a:hover { color: var(--primary); }

        main { padding: 32px 0 56px; }
        .hero h1 { margin: 0 0 6px; font-size: 28px; letter-spacing: -.02em; }
        .hero p { margin: 0 0 24px; color: var(--muted); }

        /* Card & form */
        .card {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 16px; box-shadow: var(--shadow); padding: 22px;
        }
        label { display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px; }
        input[type=text], textarea {
            width: 100%; padding: 12px 14px; font: inherit; color: var(--text);
            background: var(--bg); border: 1px solid var(--border); border-radius: 10px;
            transition: border-color .15s, box-shadow .15s;
        }
        textarea { resize: vertical; min-height: 110px; }
        input[type=text]:focus, textarea:focus {
            outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-soft);
        }
        .field { margin-bottom: 16px; }
        .error { color: var(--low); font-size: 13px; margin-top: 6px; }

        .btn {
            display: inline-flex; align-items: center; gap: 8px; cursor: pointer;
            border: 0; border-radius: 10px; padding: 11px 20px; font: inherit; font-weight: 600;
            background: var(--primary); color: #fff; text-decoration: none; transition: background .15s, transform .05s;
        }
        .btn:hover { background: var(--primary-dark); }
        .btn:active { transform: translateY(1px); }
        .btn[disabled] { opacity: .7; cursor: wait; }
        .btn-ghost { background: transparent; color: var(--primary); border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--primary-soft); }
        .actions { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-top: 4px; }

        .chips { display: flex; flex-wrap: wrap; gap: 8px; margin: 14px 0 18px; }
        .chips span { font-size: 13px; color: var(--muted); align-self: center; margin-right: 2px; }
        .chip {
            font: inherit; font-size: 13px; cursor: pointer; padding: 6px 12px; border-radius: 999px;
            background: var(--primary-soft); color: var(--primary); border: 1px solid transparent;
        }
        .chip:hover { border-color: var(--primary); }

        .alert {
            padding: 12px 16px; border-radius: 10px; margin-bottom: 18px; font-size: 14px;
            background: var(--good-bg); color: var(--good); font-weight: 600;
        }

        /* Hasil */
        .section-title { display: flex; align-items: baseline; justify-content: space-between; margin: 32px 0 14px; }
        .section-title h2 { margin: 0; font-size: 20px; }
        .section-title small { color: var(--muted); }
        .result { margin-bottom: 14px; }
        .result-head { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 12px; }
        .rank {
            width: 30px; height: 30px; border-radius: 8px; display: grid; place-items: center;
            background: var(--primary-soft); color: var(--primary); font-weight: 700; font-size: 14px; flex: none;
        }
        .badge { font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 999px; }
        .badge.good { background: var(--good-bg); color: var(--good); }
        .badge.mid  { background: var(--mid-bg);  color: var(--mid); }
        .badge.low  { background: var(--low-bg);  color: var(--low); }
        .meter { height: 8px; border-radius: 999px; background: var(--bg); overflow: hidden; margin-bottom: 16px; }
        .meter i { display: block; height: 100%; border-radius: 999px; }
        .meter i.good { background: var(--good); }
        .meter i.mid  { background: var(--mid); }
        .meter i.low  { background: var(--low); }
        .label { font-size: 12px; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); font-weight: 700; margin-bottom: 4px; }
        .kasus { margin: 0 0 14px; font-weight: 600; }
        .solusi {
            background: var(--primary-soft); border-left: 4px solid var(--primary);
            border-radius: 10px; padding: 12px 14px; font-size: 15px; white-space: pre-line;
        }
        .copy { margin-top: 12px; font-size: 13px; padding: 7px 12px; }

        .empty { text-align: center; padding: 36px 22px; }
        .empty .icon { font-size: 36px; margin-bottom: 8px; }
        .empty p { color: var(--muted); max-width: 520px; margin: 6px auto 0; }

        .hint { margin-top: 20px; font-size: 13px; color: var(--muted); }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="wrap">
            <a href="/" class="brand">
                <span class="logo">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                </span>
                Solusi IT
            </a>
            <nav class="nav">
                <a href="/">Cari Solusi</a>
                <a href="/kasus/create">Tambah Kasus</a>
            </nav>
        </div>
    </header>

    <main class="wrap">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>