<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category - ATLAS Study</title>
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
            margin-bottom: 48px;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 300;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .breadcrumb {
            font-size: 14px;
            color: #888888;
        }

        .breadcrumb a {
            color: #888888;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            color: #ffffff;
        }

        .form-container {
            background: #0B0B0C;
            border: 1px solid #1a1a1a;
            border-radius: 16px;
            padding: 40px;
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 1px;
            color: #888888;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 16px;
            background: #111111;
            border: 1px solid #1a1a1a;
            border-radius: 8px;
            color: #ffffff;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #ffffff;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
        }

        .checkbox-group label {
            margin-bottom: 0;
            text-transform: none;
            color: #ffffff;
        }

        .form-actions {
            display: flex;
            gap: 16px;
            margin-top: 32px;
        }

        .btn-primary {
            padding: 16px 32px;
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
        }

        .btn-secondary {
            padding: 16px 32px;
            background: transparent;
            color: #ffffff;
            border: 1px solid #1a1a1a;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: #1a1a1a;
        }

        .error {
            color: #ff4444;
            font-size: 13px;
            margin-top: 8px;
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
            <h1>Create Category</h1>
            <div class="breadcrumb">
                <a href="{{ route('admin.categories.index') }}">Categories</a> / Create
            </div>
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        required
                        autofocus
                    >
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slug">Slug (optional)</label>
                    <input 
                        type="text" 
                        id="slug" 
                        name="slug" 
                        value="{{ old('slug') }}"
                        placeholder="Auto-generated from name"
                    >
                    @error('slug')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="parent_id">Parent Category (optional)</label>
                    <select id="parent_id" name="parent_id">
                        <option value="">None (Root Category)</option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea 
                        id="description" 
                        name="description"
                        placeholder="Category description..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="order">Order</label>
                    <input 
                        type="number" 
                        id="order" 
                        name="order" 
                        value="{{ old('order', 0) }}"
                        min="0"
                    >
                    @error('order')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input 
                            type="checkbox" 
                            id="is_active" 
                            name="is_active" 
                            value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}
                        >
                        <label for="is_active">Active</label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Create Category</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
