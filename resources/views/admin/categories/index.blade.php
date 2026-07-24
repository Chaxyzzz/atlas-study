<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - ATLAS Study</title>
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
            gap: 0.35rem;
            font-size: 1.45rem;
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
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            color: #71717A;
            margin-top: 0.2rem;
            text-transform: uppercase;
        }

        .nav-menu {
            list-style: none;
            margin-top: 48px;
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
        
        .nav-link svg {
            margin-right: 12px;
            width: 14px;
            height: 14px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #1a1a1a;
            color: #ffffff;
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

        .btn-primary {
            padding: 12px 24px;
            background: #ffffff;
            color: #000000;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
        }

        .table-container {
            background: #0B0B0C;
            border: 1px solid #1a1a1a;
            border-radius: 16px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #1a1a1a;
            padding: 20px 24px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #888888;
        }

        td {
            padding: 20px 24px;
            border-bottom: 1px solid #1a1a1a;
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #111111;
        }

        .actions {
            display: flex;
            gap: 12px;
        }

        .btn-action {
            padding: 8px 16px;
            border: 1px solid #1a1a1a;
            background: transparent;
            color: #ffffff;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-action:hover {
            background: #1a1a1a;
        }

        .btn-delete {
            border-color: #ff4444;
            color: #ff4444;
        }

        .btn-delete:hover {
            background: #ff4444;
            color: #ffffff;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-active {
            background: #4ade80;
            color: #000000;
        }

        .badge-inactive {
            background: #1a1a1a;
            color: #888888;
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
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    Dashboard
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
                <a href="{{ route('admin.categories.index') }}" class="nav-link active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                    Categories
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.lessons.index') }}" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="23 7 16 12 23 17 23 7"></polygon>
                        <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                    </svg>
                    Lessons
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('ai.analyzer') }}" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2a10 10 0 1 0 10 10H12V2z"></path>
                        <path d="M12 12 2.1 12.05"></path>
                        <path d="M12 12 18.9 5.1"></path>
                    </svg>
                    AI Vision
                </a>
            </li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="header">
            <h1>Categories</h1>
            <a href="{{ route('admin.categories.create') }}" class="btn-primary">+ Add Category</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Parent</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                                @if($category->children->count() > 0)
                                    <span style="color: #888888; font-size: 12px;">({{ $category->children->count() }} sub)</span>
                                @endif
                            </td>
                            <td style="color: #888888;">{{ $category->slug }}</td>
                            <td>{{ $category->parent ? $category->parent->name : '-' }}</td>
                            <td>
                                @if($category->is_active)
                                    <span class="badge badge-active">Active</span>
                                @else
                                    <span class="badge badge-inactive">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn-action">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        
                        @foreach($category->children as $child)
                            <tr>
                                <td style="padding-left: 48px;">↳ {{ $child->name }}</td>
                                <td style="color: #888888;">{{ $child->slug }}</td>
                                <td>{{ $child->parent->name }}</td>
                                <td>
                                    @if($child->is_active)
                                        <span class="badge badge-active">Active</span>
                                    @else
                                        <span class="badge badge-inactive">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('admin.categories.edit', $child) }}" class="btn-action">Edit</a>
                                        <form action="{{ route('admin.categories.destroy', $child) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
