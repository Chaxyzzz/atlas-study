<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - ATLAS Study</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #000000;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 40px;
        }

        .logo {
            text-align: center;
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
            gap: 0.5rem;
            font-size: 2rem;
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
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.25em;
            color: #71717A;
            margin-top: 0.25rem;
            text-transform: uppercase;
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

        .form-group input {
            width: 100%;
            padding: 16px;
            background: #0B0B0C;
            border: 1px solid #1a1a1a;
            border-radius: 8px;
            color: #ffffff;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #ffffff;
            background: #111111;
        }

        .form-group input::placeholder {
            color: #444444;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: #ffffff;
            color: #000000;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        .btn-login:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
        }

        .error {
            color: #ff4444;
            font-size: 13px;
            margin-top: 8px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #444444;
        }
    </style>
</head>
<body>
    @include('components.particle-background')
    <div class="login-container">
        <div class="logo">
            @include('components.logo')
        </div>

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="form-group">
                <label for="username">Email or Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    placeholder="atlasstudio90@gmail.com or username"
                    value="{{ old('username') }}"
                    required
                    autofocus
                >
                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Enter your password"
                    required
                >
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                Sign In
            </button>
        </form>

        <div class="footer">
            ATLAS Studio © 2026
        </div>
    </div>
</body>
</html>
