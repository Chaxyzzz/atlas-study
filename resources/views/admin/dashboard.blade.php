<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ATLAS Study</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #000000;
            color: #ffffff;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: #0B0B0C;
            border-right: 1px solid #1a1a1a;
            padding: 32px 24px;
        }

        .logo {
            margin-bottom: 48px;
        }

        .logo .brand-logo {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            line-height: 1.1;
            font-family: 'Plus Jakarta Sans', 'Sora', 'Manrope', 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .logo .brand-logo-top {
            display: flex;
            align-items: baseline;
            gap: 0.4rem;
            font-size: 1.6rem;
            line-height: 1;
        }

        .logo .brand-logo-top .brand-name-bold {
            font-weight: 800;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }

        .logo .brand-logo-top .brand-name-light {
            font-weight: 400;
            color: #9CA3AF;
            letter-spacing: 0;
        }

        .logo .brand-logo-bottom {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            color: #71717A;
            margin-top: 0.2rem;
            text-transform: uppercase;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            color: #888888;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #1a1a1a;
            color: #ffffff;
        }

        .nav-link svg {
            margin-right: 12px;
            width: 14px;
            height: 14px;
        }

        .main-content {
            margin-left: 280px;
            padding: 48px 64px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 48px;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #1a1a1a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 600;
        }

        .user-name {
            font-size: 14px;
            font-weight: 500;
        }

        .btn-logout {
            padding: 12px 24px;
            background: transparent;
            border: 1px solid #1a1a1a;
            color: #ffffff;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-logout:hover {
            background: #1a1a1a;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 48px;
        }

        .stat-card {
            background: #0B0B0C;
            border: 1px solid #1a1a1a;
            border-radius: 16px;
            padding: 32px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            border-color: #333333;
            transform: translateY(-4px);
        }

        .stat-label {
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 1px;
            color: #888888;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .stat-value {
            font-size: 36px;
            font-weight: 300;
            margin-bottom: 8px;
        }

        .stat-change {
            font-size: 12px;
            color: #4ade80;
        }

        .section-title {
            font-size: 20px;
            font-weight: 400;
            margin-bottom: 24px;
            letter-spacing: 0.5px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .category-card {
            background: #0B0B0C;
            border: 1px solid #1a1a1a;
            border-radius: 16px;
            padding: 32px;
            transition: all 0.3s ease;
        }

        .category-card:hover {
            border-color: #333333;
            transform: translateY(-4px);
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .category-name {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .category-description {
            font-size: 14px;
            color: #888888;
            margin-bottom: 24px;
        }

        .sub-categories {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .sub-category-tag {
            padding: 8px 16px;
            background: #1a1a1a;
            border-radius: 20px;
            font-size: 12px;
            color: #888888;
        }

        .btn-add {
            padding: 8px 16px;
            background: #ffffff;
            color: #000000;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            background: #e0e0e0;
        }
    </style>
</head>
<body>
    @include('components.particle-background')
    <aside class="sidebar">
        <div class="logo">
            @include('components.logo')
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    {{ __('app.admin.dashboard') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                    {{ __('app.nav.categories') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.lessons.index') }}" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="23 7 16 12 23 17 23 7"></polygon>
                        <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                    </svg>
                    {{ __('app.nav.lessons') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('ai.analyzer') }}" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2a10 10 0 1 0 10 10H12V2z"></path>
                        <path d="M12 12 2.1 12.05"></path>
                        <path d="M12 12 18.9 5.1"></path>
                    </svg>
                    {{ __('app.nav.ai_analyzer') }}
                </a>
            </li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="header">
            <h1>{{ __('app.admin.dashboard') }}</h1>
            <div class="header-actions">
                <div class="user-info">
                    <div class="user-avatar">
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar_url }}" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                        @else
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        @endif
                    </div>
                    <span class="user-name">{{ Auth::user()->name ?? 'Zakky Mubaraq' }}</span>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">{{ __('app.nav.logout') }}</button>
                </form>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">{{ __('app.admin.total_categories') }}</div>
                <div class="stat-value">{{ App\Models\Category::count() }}</div>
                <div class="stat-change">Core Education Pillars</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">{{ __('app.admin.total_lessons') }}</div>
                <div class="stat-value">{{ App\Models\Lesson::count() }}</div>
                <div class="stat-change">Published Lessons</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">AI Analyses</div>
                <div class="stat-value">{{ App\Models\AiLog::count() }}</div>
                <div class="stat-change">Feature ready</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">{{ __('app.admin.total_users') }}</div>
                <div class="stat-value">{{ App\Models\User::count() }}</div>
                <div class="stat-change">Registered Members</div>
            </div>
        </div>

        <h2 class="section-title">Core Education Pillars</h2>

        <div class="categories-grid">
            @php
                $categories = App\Models\Category::roots()->orderBy('order')->get();
            @endphp

            @foreach($categories as $category)
                <div class="category-card">
                    <div class="category-header">
                        <h3 class="category-name">{{ $category->name }}</h3>
                        <a href="{{ route('admin.lessons.create', ['category_id' => $category->id]) }}" class="btn-add">+ Add Lesson</a>
                    </div>
                    <p class="category-description">{{ $category->description }}</p>
                    <div class="sub-categories">
                        @foreach($category->children as $child)
                            <span class="sub-category-tag">{{ $child->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>
