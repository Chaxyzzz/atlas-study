<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Analysis History - ATLAS Study</title>
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

        .header {
            text-align: center;
            padding: 64px 24px 48px;
            background: linear-gradient(180deg, #0B0B0C 0%, #000000 100%);
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
            font-size: 2.5rem;
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
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 0.3em;
            color: #71717A;
            margin-top: 0.3rem;
            text-transform: uppercase;
        }

        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 48px 24px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 32px;
            color: #888888;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #ffffff;
        }

        .history-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 24px;
        }

        .history-card {
            background: #0B0B0C;
            border: 1px solid #1a1a1a;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .history-card:hover {
            border-color: #333333;
            transform: translateY(-4px);
        }

        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #111111;
        }

        .card-content {
            padding: 24px;
        }

        .card-shot {
            font-size: 14px;
            font-weight: 600;
            color: #4ade80;
            margin-bottom: 8px;
        }

        .card-composition {
            font-size: 12px;
            color: #888888;
            margin-bottom: 16px;
        }

        .card-colors {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
        }

        .color-dot {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #1a1a1a;
        }

        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #666666;
        }

        .empty-state {
            text-align: center;
            padding: 80px 24px;
            color: #888888;
        }

        .empty-state h3 {
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            margin-bottom: 24px;
        }

        .btn-primary {
            display: inline-block;
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
        }
    </style>
</head>
<body>
    @include('components.particle-background')


    <div class="main-content">
        <a href="{{ route('ai.analyzer') }}" class="back-link">← Back to Analyzer</a>

        @if($aiLogs->count() > 0)
            <div class="history-grid">
                @foreach($aiLogs as $log)
                    <div class="history-card">
                        <img src="https://images.pexels.com/photos/7934552/pexels-photo-7934552.jpeg?auto=compress&cs=tinysrgb&w=1200" alt="Camera equipment preview" class="card-image">
                        <div class="card-content">
                            <div class="card-shot">{{ $log->shot_type }}</div>
                            <div class="card-composition">
                                {{ $log->composition_score }}% composition score
                            </div>
                            <div class="card-colors">
                                @if($log->color_palette)
                                    @foreach(array_slice($log->color_palette, 0, 5) as $color)
                                        <div class="color-dot" style="background-color: {{ $color }};" title="{{ $color }}"></div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="card-meta">
                                <span>{{ $log->created_at->format('M d, Y - H:i') }}</span>
                                <span>{{ $log->user ? $log->user->name : 'Guest' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h3>No analysis history yet</h3>
                <p>Upload your first image to start analyzing</p>
                <a href="{{ route('ai.analyzer') }}" class="btn-primary">Go to Analyzer</a>
            </div>
        @endif
    </div>
</body>
</html>
