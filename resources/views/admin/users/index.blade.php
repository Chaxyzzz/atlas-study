<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - ATLAS Study Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            z-index: 100;
        }

        .logo {
            margin-bottom: 48px;
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
            width: 16px;
            height: 16px;
        }

        .main-content {
            margin-left: 280px;
            padding: 48px 48px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
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

        /* 8 Stats Cards Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: rgba(11, 11, 12, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid #1a1a1a;
            border-radius: 14px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            border-color: #333333;
            transform: translateY(-3px);
        }

        .stat-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1px;
            color: #888888;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 26px;
            font-weight: 300;
            color: #ffffff;
        }

        /* Controls Section */
        .controls-card {
            background: #0B0B0C;
            border: 1px solid #1a1a1a;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .controls-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .search-input {
            width: 320px;
            background: #141416;
            border: 1px solid #26262a;
            border-radius: 8px;
            padding: 10px 16px;
            color: #ffffff;
            font-size: 13px;
            outline: none;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            border-color: #4a4a50;
        }

        .export-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-export {
            padding: 9px 14px;
            background: #141416;
            border: 1px solid #26262a;
            color: #d1d1d6;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-export:hover {
            background: #222226;
            color: #ffffff;
            border-color: #4a4a50;
        }

        .filter-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-select {
            background: #141416;
            border: 1px solid #26262a;
            border-radius: 8px;
            padding: 9px 12px;
            color: #d1d1d6;
            font-size: 12px;
            outline: none;
            cursor: pointer;
        }

        .filter-select option {
            background: #141416;
            color: #ffffff;
        }

        .btn-filter {
            padding: 9px 16px;
            background: #ffffff;
            color: #000000;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-filter:hover {
            background: #e0e0e0;
        }

        .btn-reset {
            padding: 9px 14px;
            background: transparent;
            border: 1px solid #26262a;
            color: #888888;
            border-radius: 8px;
            font-size: 12px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-reset:hover {
            color: #ffffff;
            border-color: #4a4a50;
        }

        /* Alert Messages */
        .alert {
            padding: 14px 20px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 24px;
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #4ade80;
        }
        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
        }

        /* Table Container & 14 Columns */
        .table-container {
            background: #0B0B0C;
            border: 1px solid #1a1a1a;
            border-radius: 16px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        th {
            background: #141416;
            padding: 14px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: #888888;
            border-bottom: 1px solid #1a1a1a;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid #1a1a1a;
            font-size: 13px;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #111113;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar-img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #26262a;
        }

        .user-meta-name {
            font-weight: 600;
            color: #ffffff;
        }

        .user-meta-sub {
            font-size: 11px;
            color: #888888;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 8px;
            border-radius: 16px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-google { background: rgba(66, 133, 244, 0.15); color: #60a5fa; border: 1px solid rgba(66, 133, 244, 0.3); }
        .badge-phone { background: rgba(34, 197, 94, 0.15); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3); }
        .badge-local { background: rgba(168, 85, 247, 0.15); color: #c084fc; border: 1px solid rgba(168, 85, 247, 0.3); }

        .badge-super-admin { background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.4); }
        .badge-admin { background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3); }
        .badge-teacher { background: rgba(59, 130, 246, 0.15); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.3); }
        .badge-student { background: rgba(107, 114, 128, 0.15); color: #9ca3af; border: 1px solid rgba(107, 114, 128, 0.3); }
        .badge-guest { background: rgba(75, 85, 99, 0.15); color: #6b7280; border: 1px solid rgba(75, 85, 99, 0.3); }

        .badge-active { background: rgba(34, 197, 94, 0.15); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3); }
        .badge-verified { background: rgba(6, 182, 212, 0.15); color: #22d3ee; border: 1px solid rgba(6, 182, 212, 0.3); }
        .badge-inactive { background: rgba(107, 114, 128, 0.15); color: #9ca3af; border: 1px solid rgba(107, 114, 128, 0.3); }
        .badge-suspended { background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.4); }
        .badge-pending { background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3); }

        .badge-lang { background: #18181b; color: #d1d1d6; border: 1px solid #27272a; }

        /* Action Buttons */
        .actions {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-action {
            padding: 5px 10px;
            border: 1px solid #26262a;
            background: #141416;
            color: #d1d1d6;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-action:hover {
            background: #222226;
            color: #ffffff;
            border-color: #3f3f46;
        }

        .btn-action-warning { border-color: rgba(245, 158, 11, 0.3); color: #fbbf24; }
        .btn-action-warning:hover { background: rgba(245, 158, 11, 0.2); color: #ffffff; }

        .btn-action-success { border-color: rgba(34, 197, 94, 0.3); color: #4ade80; }
        .btn-action-success:hover { background: rgba(34, 197, 94, 0.2); color: #ffffff; }

        .btn-action-danger { border-color: rgba(239, 68, 68, 0.3); color: #f87171; }
        .btn-action-danger:hover { background: rgba(239, 68, 68, 0.8); color: #ffffff; }

        .btn-action-disabled { opacity: 0.4; cursor: not-allowed; pointer-events: none; }

        /* Pagination */
        .pagination-wrapper {
            padding: 16px 20px;
            border-top: 1px solid #1a1a1a;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Modal Backdrop & Glass Container */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(14px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-backdrop.active {
            display: flex;
        }

        .modal-card {
            background: #0B0B0C;
            border: 1px solid #26262a;
            border-radius: 20px;
            width: 100%;
            max-width: 620px;
            padding: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
            position: relative;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            border-bottom: 1px solid #1a1a1a;
            padding-bottom: 16px;
        }

        .modal-header h3 {
            font-size: 20px;
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        .modal-close {
            background: transparent;
            border: none;
            color: #888888;
            font-size: 20px;
            cursor: pointer;
            transition: color 0.2s;
        }

        .modal-close:hover {
            color: #ffffff;
        }

        .profile-modal-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-top: 16px;
        }

        .detail-item {
            background: #141416;
            border: 1px solid #1f1f23;
            border-radius: 12px;
            padding: 12px 14px;
        }

        .detail-item-full {
            grid-column: span 2;
        }

        .detail-label {
            font-size: 10px;
            color: #888888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 13px;
            color: #ffffff;
            font-weight: 500;
            word-break: break-all;
        }

        /* Form Inputs */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            color: #aaaaaa;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            background: #141416;
            border: 1px solid #26262a;
            border-radius: 8px;
            padding: 10px 14px;
            color: #ffffff;
            font-size: 13px;
            outline: none;
        }

        .form-control:focus {
            border-color: #4a4a50;
        }
    </style>
</head>
<body>
    @include('components.particle-background')
    
    @php
        $currentUser = Auth::user();
        $isSuperAdmin = $currentUser->isSuperAdmin();
    @endphp

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
                <a href="{{ route('admin.users.index') }}" class="nav-link active">
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
            <div>
                <h1>User Management</h1>
                <p style="color: #888888; font-size: 14px; margin-top: 4px;">Sistem Administrasi Pengguna Enterprise — ATLAS Study Platform.</p>
            </div>
            <div class="header-actions">
                <div class="user-info">
                    <div class="user-avatar">
                        @if($currentUser->avatar)
                            <img src="{{ $currentUser->avatar_url }}" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                        @else
                            {{ substr($currentUser->name ?? 'A', 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <div class="user-name">{{ $currentUser->name }}</div>
                        <div style="font-size:11px; color:#888888;">{{ $isSuperAdmin ? 'Super Administrator' : 'Administrator' }}</div>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                ✕ {{ session('error') }}
            </div>
        @endif

        <!-- 8 User Statistics Dashboard Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total Users</div>
                <div class="stat-value">{{ $stats['total_users'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Google Users</div>
                <div class="stat-value" style="color: #60a5fa;">{{ $stats['google_users'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Phone Users</div>
                <div class="stat-value" style="color: #4ade80;">{{ $stats['phone_users'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Administrators</div>
                <div class="stat-value" style="color: #fbbf24;">{{ $stats['admins'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Teachers</div>
                <div class="stat-value" style="color: #38bdf8;">{{ $stats['teachers'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Students</div>
                <div class="stat-value" style="color: #9ca3af;">{{ $stats['students'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Registered Today</div>
                <div class="stat-value" style="color: #c084fc;">{{ $stats['today_registrations'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Active Today</div>
                <div class="stat-value" style="color: #34d399;">{{ $stats['active_today'] }}</div>
            </div>
        </div>

        <!-- Controls: Instant Search, Export & Multi-filters -->
        <form action="{{ route('admin.users.index') }}" method="GET" class="controls-card">
            <div class="controls-top">
                <input type="text" name="search" value="{{ request('search') }}" class="search-input" placeholder="Search name, username, email, phone, Google ID...">
                
                <div class="export-actions">
                    <a href="{{ route('admin.users.export.csv', request()->all()) }}" class="btn-export">
                        📄 Export CSV
                    </a>
                    <a href="{{ route('admin.users.export.excel', request()->all()) }}" class="btn-export">
                        📊 Export Excel
                    </a>
                    <a href="{{ route('admin.users.export.pdf', request()->all()) }}" target="_blank" class="btn-export">
                        🖨️ Export PDF
                    </a>
                </div>
            </div>

            <div class="filter-row">
                <select name="provider" class="filter-select">
                    <option value="">Provider: All</option>
                    <option value="google" {{ request('provider') == 'google' ? 'selected' : '' }}>Google</option>
                    <option value="phone" {{ request('provider') == 'phone' ? 'selected' : '' }}>Phone</option>
                    <option value="local" {{ request('provider') == 'local' ? 'selected' : '' }}>Local</option>
                    <option value="github" {{ request('provider') == 'github' ? 'selected' : '' }}>GitHub</option>
                    <option value="microsoft" {{ request('provider') == 'microsoft' ? 'selected' : '' }}>Microsoft</option>
                    <option value="apple" {{ request('provider') == 'apple' ? 'selected' : '' }}>Apple</option>
                </select>

                <select name="role" class="filter-select">
                    <option value="">Role: All</option>
                    <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                    <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                    <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="guest" {{ request('role') == 'guest' ? 'selected' : '' }}>Guest</option>
                </select>

                <select name="status" class="filter-select">
                    <option value="">Status: All</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>

                <select name="language" class="filter-select">
                    <option value="">Language: All</option>
                    <option value="id" {{ request('language') == 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                    <option value="en" {{ request('language') == 'en' ? 'selected' : '' }}>English</option>
                </select>

                <select name="sort_by" class="filter-select">
                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Sort: Registration Date</option>
                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Sort: Name</option>
                    <option value="last_login_at" {{ request('sort_by') == 'last_login_at' ? 'selected' : '' }}>Sort: Last Login</option>
                    <option value="role" {{ request('sort_by') == 'role' ? 'selected' : '' }}>Sort: Role</option>
                    <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>Sort: Status</option>
                    <option value="preferred_language" {{ request('sort_by') == 'preferred_language' ? 'selected' : '' }}>Sort: Language</option>
                </select>

                <select name="sort_order" class="filter-select">
                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending (Z-A / Newest)</option>
                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending (A-Z / Oldest)</option>
                </select>

                <button type="submit" class="btn-filter">Apply</button>
                @if(request()->anyFilled(['search', 'provider', 'role', 'status', 'language', 'sort_by', 'sort_order']))
                    <a href="{{ route('admin.users.index') }}" class="btn-reset">Reset</a>
                @endif
            </div>
        </form>

        <!-- 14 Columns Professional Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Login Provider</th>
                        <th>Role</th>
                        <th>Preferred Language</th>
                        <th>Status</th>
                        <th>Registration Date</th>
                        <th>Last Login</th>
                        <th>Last Login IP</th>
                        <th>Browser</th>
                        <th>Device</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        @php
                            $roleStr = $user->role ?: ($user->is_admin ? 'admin' : 'student');
                            $statusStr = $user->status ?: 'active';
                            $provStr = $user->effective_provider;
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="avatar-img">
                            </td>
                            <td>
                                <span class="user-meta-name">{{ $user->name }}</span>
                            </td>
                            <td>
                                <span class="user-meta-sub">{{ $user->username ? '@' . ltrim($user->username, '@') : '-' }}</span>
                            </td>
                            <td style="color: #d1d1d6;">{{ $user->email }}</td>
                            <td>
                                @if($provStr === 'google')
                                    <span class="badge badge-google">Google</span>
                                @elseif($provStr === 'phone')
                                    <span class="badge badge-phone">Phone</span>
                                @else
                                    <span class="badge badge-local">{{ ucfirst($provStr) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($roleStr === 'super_admin')
                                    <span class="badge badge-super-admin">Super Admin</span>
                                @elseif($roleStr === 'admin')
                                    <span class="badge badge-admin">Administrator</span>
                                @elseif($roleStr === 'teacher')
                                    <span class="badge badge-teacher">Teacher</span>
                                @elseif($roleStr === 'guest')
                                    <span class="badge badge-guest">Guest</span>
                                @else
                                    <span class="badge badge-student">Student</span>
                                @endif
                            </td>
                            <td>
                                @if(($user->preferred_language ?? 'id') === 'en')
                                    <span class="badge badge-lang">English</span>
                                @else
                                    <span class="badge badge-lang">Bahasa Indonesia</span>
                                @endif
                            </td>
                            <td>
                                @if($statusStr === 'active')
                                    <span class="badge badge-active">Active</span>
                                @elseif($statusStr === 'verified')
                                    <span class="badge badge-verified">Verified</span>
                                @elseif($statusStr === 'suspended')
                                    <span class="badge badge-suspended">Suspended</span>
                                @elseif($statusStr === 'pending')
                                    <span class="badge badge-pending">Pending</span>
                                @else
                                    <span class="badge badge-inactive">Inactive</span>
                                @endif
                            </td>
                            <td style="color: #888888; font-size: 12px;">
                                {{ $user->created_at ? $user->created_at->format('d M Y, H:i') . ' WIB' : '-' }}
                            </td>
                            <td style="color: #888888; font-size: 12px;">
                                {{ $user->last_login_at ? $user->last_login_at->format('d M Y, H:i') . ' WIB' : 'Never' }}
                            </td>
                            <td style="color: #888888; font-size: 12px;">
                                {{ $user->last_login_ip ?: '-' }}
                            </td>
                            <td style="color: #888888; font-size: 12px;">
                                {{ $user->browser ?: 'Chrome 139' }}
                            </td>
                            <td style="color: #888888; font-size: 12px;">
                                {{ $user->device ?: 'Desktop' }}
                            </td>
                            <td style="text-align: right;">
                                <div class="actions" style="justify-content: flex-end;">
                                    <!-- View Modal Trigger -->
                                    <button type="button" class="btn-action" onclick="openViewModal({{ $user->id }})">View</button>

                                    <!-- Edit Modal Trigger -->
                                    <button type="button" class="btn-action" onclick="openEditModal({{ json_encode($user) }})">Edit</button>

                                    <!-- Activate Toggle Form -->
                                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @if($user->isActive())
                                            <button type="submit" class="btn-action btn-action-warning" onclick="return confirm('Nonaktifkan pengguna {{ $user->name }}?')">Deactivate</button>
                                        @else
                                            <button type="submit" class="btn-action btn-action-success" onclick="return confirm('Aktifkan pengguna {{ $user->name }}?')">Activate</button>
                                        @endif
                                    </form>

                                    <!-- Suspend Action (Super Admin Only) -->
                                    @if($isSuperAdmin)
                                        <form action="{{ route('admin.users.suspend', $user) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-action btn-action-warning" onclick="return confirm('Tangguhkan (Suspend) akun {{ $user->name }}?')">Suspend</button>
                                        </form>
                                    @endif

                                    <!-- Reset Session Form -->
                                    <form action="{{ route('admin.users.reset-session', $user) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-action" onclick="return confirm('Reset sesi pengguna {{ $user->name }}?')">Reset Session</button>
                                    </form>

                                    <!-- Delete Form (Super Admin Only) -->
                                    @if($isSuperAdmin)
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-action-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $user->name }}? Action ini tidak dapat dibatalkan.')">Delete</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn-action btn-action-disabled" title="Hanya Super Administrator yang dapat menghapus pengguna.">Delete</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" style="text-align: center; padding: 48px; color: #888888;">
                                Tidak ada pengguna ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($users->hasPages())
                <div class="pagination-wrapper">
                    <div style="color: #888888; font-size: 13px;">
                        Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} pengguna
                    </div>
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            @endif
        </div>
    </main>

    <!-- USER DETAIL MODAL -->
    <div id="viewUserModal" class="modal-backdrop">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Detail Profile User</h3>
                <button type="button" class="modal-close" onclick="closeModal('viewUserModal')">✕</button>
            </div>
            
            <div style="text-align: center; margin-bottom: 24px;">
                <img id="detailAvatar" src="" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid #333336; margin-bottom: 12px;">
                <h4 id="detailName" style="font-size: 18px; font-weight: 600;"></h4>
                <p id="detailUsername" style="color: #888888; font-size: 13px;"></p>
            </div>

            <div class="profile-modal-grid">
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div id="detailEmail" class="detail-value"></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Email Verified</div>
                    <div id="detailEmailVerified" class="detail-value"></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Phone</div>
                    <div id="detailPhone" class="detail-value"></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Google ID</div>
                    <div id="detailGoogleId" class="detail-value"></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Provider</div>
                    <div id="detailProvider" class="detail-value"></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Role</div>
                    <div id="detailRole" class="detail-value"></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Preferred Language</div>
                    <div id="detailLanguage" class="detail-value"></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status</div>
                    <div id="detailStatus" class="detail-value"></div>
                </div>
                <div class="detail-item detail-item-full">
                    <div class="detail-label">Registration Date</div>
                    <div id="detailRegisteredDate" class="detail-value"></div>
                </div>
                <div class="detail-item detail-item-full">
                    <div class="detail-label">Last Login Timestamp</div>
                    <div id="detailLastLoginAt" class="detail-value"></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Last Login IP</div>
                    <div id="detailLastLoginIp" class="detail-value"></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Device Type</div>
                    <div id="detailDevice" class="detail-value"></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Browser</div>
                    <div id="detailBrowser" class="detail-value"></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Operating System</div>
                    <div id="detailOS" class="detail-value"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT USER MODAL -->
    <div id="editUserModal" class="modal-backdrop">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Edit Data Pengguna</h3>
                <button type="button" class="modal-close" onclick="closeModal('editUserModal')">✕</button>
            </div>

            <form id="editUserForm" method="POST" action="">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" id="editName" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" id="editUsername" name="username" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" id="editEmail" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" id="editPhone" name="phone" class="form-control">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label class="form-label">Role {{ !$isSuperAdmin ? '(Super Admin Only)' : '' }}</label>
                        <select id="editRole" name="role" class="form-control" {{ !$isSuperAdmin ? 'disabled' : '' }} required>
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                            <option value="admin">Administrator</option>
                            <option value="super_admin">Super Administrator</option>
                            <option value="guest">Guest</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select id="editStatus" name="status" class="form-control" required>
                            <option value="active">Active</option>
                            <option value="verified">Verified</option>
                            <option value="inactive">Inactive</option>
                            <option value="suspended">Suspended</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Preferred Language</label>
                    <select id="editLanguage" name="preferred_language" class="form-control" required>
                        <option value="id">Bahasa Indonesia</option>
                        <option value="en">English</option>
                    </select>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px;">
                    <button type="button" class="btn-reset" onclick="closeModal('editUserModal')">Batal</button>
                    <button type="submit" class="btn-filter">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        function openViewModal(userId) {
            fetch('/admin/users/' + userId)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('detailAvatar').src = data.avatar;
                    document.getElementById('detailName').innerText = data.name;
                    document.getElementById('detailUsername').innerText = data.username;
                    document.getElementById('detailEmail').innerText = data.email;
                    document.getElementById('detailEmailVerified').innerText = data.email_verified;
                    document.getElementById('detailPhone').innerText = data.phone;
                    document.getElementById('detailGoogleId').innerText = data.google_id;
                    document.getElementById('detailProvider').innerText = data.provider;
                    document.getElementById('detailRole').innerText = data.role;
                    document.getElementById('detailLanguage').innerText = data.preferred_language;
                    document.getElementById('detailStatus').innerText = data.status;
                    document.getElementById('detailRegisteredDate').innerText = data.registered_date;
                    document.getElementById('detailLastLoginAt').innerText = data.last_login_at;
                    document.getElementById('detailLastLoginIp').innerText = data.last_login_ip;
                    document.getElementById('detailDevice').innerText = data.device;
                    document.getElementById('detailBrowser').innerText = data.browser;
                    document.getElementById('detailOS').innerText = data.operating_system;

                    document.getElementById('viewUserModal').classList.add('active');
                })
                .catch(err => alert('Gagal memuat detail pengguna.'));
        }

        function openEditModal(user) {
            document.getElementById('editUserForm').action = '/admin/users/' + user.id;
            document.getElementById('editName').value = user.name || '';
            document.getElementById('editUsername').value = user.username || '';
            document.getElementById('editEmail').value = user.email || '';
            document.getElementById('editPhone').value = user.phone || '';
            
            var roleKey = user.role || (user.is_admin ? 'admin' : 'student');
            document.getElementById('editRole').value = roleKey;
            document.getElementById('editStatus').value = user.status || 'active';
            document.getElementById('editLanguage').value = user.preferred_language || 'id';

            document.getElementById('editUserModal').classList.add('active');
        }
    </script>
</body>
</html>
