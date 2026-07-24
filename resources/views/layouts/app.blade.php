<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'ATLAS Study'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --bg: #050505;
            --bg-secondary: #0D0D0D;
            --card: #111111;
            --card-hover: #181818;
            --border: rgba(255,255,255,.06);
            --text-primary: #ffffff;
            --text-secondary: #9CA3AF;
            --accent-1: #22C55E;
            --accent-2: #3B82F6;
            --radius: 1.25rem;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            min-height: 100vh;
        }

        html {
            scroll-behavior: smooth;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .container {
            max-width: 1280px;
        }

        .page-section {
            padding: 80px 0;
        }

        .section-card {
            background: #111111;
            border: 1px solid #232323;
            border-radius: 16px;
            transition: transform .3s ease, border-color .3s ease, box-shadow .3s ease, background .3s ease;
        }

        .brand-logo {
            display: inline-flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            text-align: left;
            line-height: 1.1;
        }

        .brand-logo-top {
            display: flex;
            align-items: baseline;
            gap: 0.45rem;
            font-size: 1.44rem;
            line-height: 1;
            letter-spacing: normal;
            color: #ffffff;
        }

        .brand-logo-top .brand-name-bold {
            font-weight: 800;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .brand-logo-top .brand-name-light {
            font-weight: 300;
            color: #888A90;
            letter-spacing: 0.01em;
        }

        .brand-logo-bottom {
            font-size: 0.60rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            color: #71737A;
            margin-top: 0.22rem;
            text-transform: uppercase;
            line-height: 1;
        }

        .section-card:hover,
        .card-hover:hover {
            transform: translateY(-5px);
            border-color: rgba(255,255,255,.12);
            background: var(--card-hover);
            box-shadow: 0 24px 80px rgba(0,0,0,.35);
        }

        .section-card {
            background: var(--card);
        }

        .card-hover {
            transition: transform .3s ease, border-color .3s ease, box-shadow .3s ease, background .3s ease;
        }

        .rounded-xl {
            border-radius: 1.25rem;
        }

        .text-muted-custom {
            color: var(--text-secondary) !important;
        }

        .bg-secondary-custom {
            background: var(--bg-secondary) !important;
        }

        .btn-outline-white {
            color: var(--text-primary);
            border: 1px solid rgba(255,255,255,.18);
            background: transparent;
            border-radius: 999px;
            transition: all .3s ease;
        }

        .btn-outline-white:hover,
        .btn-outline-white:focus {
            color: var(--bg);
            background: var(--text-primary);
            border-color: var(--text-primary);
        }

        .btn-accent {
            color: var(--bg);
            background: var(--accent-2);
            border: 1px solid transparent;
            border-radius: 999px;
            transition: all .3s ease;
        }

        .btn-accent:hover,
        .btn-accent:focus {
            background: var(--accent-1);
            color: var(--bg);
        }

        .form-control-dark {
            background: #0B0B0D;
            color: var(--text-primary);
            border: 1px solid #232323;
            border-radius: 999px;
        }

        .form-control-dark:focus {
            background: #111111;
            color: var(--text-primary);
            box-shadow: none;
            border-color: var(--accent-2);
        }

        .section-title {
            font-size: 1.35rem;
            font-weight: 600;
            margin-bottom: 1rem;
            letter-spacing: .01em;
        }

        .badge-category {
            display: inline-flex;
            align-items: center;
            padding: .45rem .85rem;
            border-radius: 999px;
            background: rgba(255,255,255,.05);
            color: var(--text-secondary);
            border: 1px solid rgba(255,255,255,.08);
            font-size: .8rem;
            font-weight: 500;
        }

        .hero-panel {
            background: linear-gradient(180deg, rgba(255,255,255,.04) 0%, rgba(255,255,255,0) 100%);
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 2rem;
        }

        .hero-title {
            font-size: clamp(2.125rem, 3.5vw, 4rem);
            line-height: 1.05;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-copy {
            color: var(--text-secondary);
            max-width: 620px;
            margin-top: 1rem;
            line-height: 1.7;
            font-size: 1.125rem;
        }

        .hero-image {
            max-height: 300px;
            object-fit: cover;
            width: 100%;
            border-radius: 16px;
        }

        .article-content {
            line-height: 1.85;
            color: #E5E7EB;
            word-break: break-word;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content h2,
        .article-content h3,
        .article-content h4 {
            color: #fff;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .article-content ul,
        .article-content ol {
            padding-left: 1.4rem;
            margin-bottom: 1.5rem;
        }

        .article-content li {
            margin-bottom: .75rem;
        }

        .section-divider {
            height: 1px;
            background: rgba(255,255,255,.08);
            border: none;
            margin: 3rem 0;
        }

        .footer-dark {
            background: var(--bg-secondary);
            border-top: 1px solid rgba(255,255,255,.06);
        }

        .footer-dark a {
            color: var(--text-secondary);
        }

        .footer-dark a:hover {
            color: #ffffff;
        }

        .navbar-dark-custom {
            position: sticky;
            top: 0;
            z-index: 1030;
            background: var(--bg);
            border-bottom: 1px solid #232323;
            padding: 0.5rem 0;
            min-height: 64px;
        }

        .navbar-dark-custom .navbar-nav {
            gap: 1.75rem;
            margin-left: 1.5rem;
        }

        .navbar-dark-custom .nav-link {
            color: var(--text-secondary);
            transition: all .3s ease;
            padding: .65rem .85rem;
            border-radius: 999px;
        }

        .navbar-dark-custom .nav-link:hover,
        .navbar-dark-custom .nav-link.active {
            color: #ffffff;
            background: rgba(255,255,255,.08);
            border: 1px solid #232323;
        }

        .navbar-brand {
            display: inline-flex;
            align-items: center;
            margin-right: 1.25rem;
            text-decoration: none;
            padding: 0;
        }

        .letter-spacing {
            letter-spacing: .22em;
        }

        .navbar-dark-custom .navbar-toggler {
            border-color: rgba(255,255,255,.18);
        }

        .navbar-dark-custom .navbar-toggler-icon {
            filter: invert(1);
        }

        @media (max-width: 992px) {
            .site-main { padding-top: 2rem; }
            .navbar-dark-custom .navbar-nav {
                gap: .75rem;
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .site-main { padding: 40px 0; }
            .navbar-dark-custom .navbar-collapse { background: var(--bg); padding: 1rem; border-radius: 1rem; }
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('components.particle-background')

    @include('partials.navbar')

    <main class="container my-5">
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.user-profile-modals')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
