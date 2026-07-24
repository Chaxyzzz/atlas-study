<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATLAS Study - Premium Education Platform</title>
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

        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 48px 24px;
            background: linear-gradient(180deg, #0B0B0C 0%, #000000 100%);
        }

        .logo {
            margin-bottom: 48px;
            text-align: center;
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
            gap: 0.75rem;
            font-size: 4.5rem;
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
            font-size: 1.25rem;
            font-weight: 600;
            letter-spacing: 0.35em;
            color: #71717A;
            margin-top: 0.5rem;
            text-transform: uppercase;
        }

        .tagline {
            font-size: 24px;
            font-weight: 300;
            color: #cccccc;
            margin-bottom: 64px;
            max-width: 600px;
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 24px;
            margin-bottom: 96px;
        }

        .btn-primary {
            padding: 16px 40px;
            background: #ffffff;
            color: #000000;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
        }

        .btn-secondary {
            padding: 16px 40px;
            background: transparent;
            color: #ffffff;
            border: 1px solid #1a1a1a;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: #1a1a1a;
        }

        .pillars {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 32px;
            max-width: 1200px;
            width: 100%;
            margin-bottom: 96px;
        }

        .pillar-card,
        .pillar-card-link {
            background: #0B0B0C;
            border: 1px solid #1a1a1a;
            border-radius: 20px;
            padding: 40px 32px;
            transition: all 0.4s ease;
            cursor: pointer;
            display: block;
            color: inherit;
            text-decoration: none;
        }

        .pillar-card:hover,
        .pillar-card-link:hover {
            border-color: #333333;
            transform: translateY(-8px);
        }

        .pillar-icon {
            width: 48px;
            height: 48px;
            margin-bottom: 24px;
            opacity: 0.8;
        }

        .pillar-title {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .pillar-description {
            font-size: 14px;
            color: #888888;
            line-height: 1.6;
        }

        .ai-feature {
            background: linear-gradient(135deg, #0B0B0C 0%, #111111 100%);
            border: 1px solid #1a1a1a;
            border-radius: 24px;
            padding: 64px;
            max-width: 1000px;
            text-align: center;
        }

        .ai-badge {
            display: inline-block;
            padding: 8px 20px;
            background: linear-gradient(135deg, #4ade80, #22c55e);
            color: #000000;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .ai-title {
            font-size: 36px;
            font-weight: 300;
            margin-bottom: 16px;
        }

        .ai-description {
            font-size: 16px;
            color: #888888;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .ai-features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 48px;
        }

        .ai-feature-item {
            text-align: left;
        }

        .ai-feature-item h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .ai-feature-item p {
            font-size: 13px;
            color: #888888;
            line-height: 1.5;
        }

        .footer {
            margin-top: 96px;
            text-align: center;
            color: #444444;
            font-size: 13px;
        }

        .footer a {
            color: #888888;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .logo h1 {
                font-size: 48px;
                letter-spacing: 16px;
            }

            .pillars {
                grid-template-columns: 1fr;
            }

            .ai-features {
                grid-template-columns: 1fr;
            }

            .cta-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    @include('components.particle-background')
    <div class="hero">
        <div class="logo">
            @include('components.logo')
        </div>

        <p class="tagline">
            Master the art of visual storytelling through our premium educational platform. 
            Photography, Videography, Editing, and Design — elevated to perfection.
        </p>

        <div class="cta-buttons">
            <a href="{{ route('ai.analyzer') }}" class="btn-primary">Try AI Vision Analyzer</a>
            <a href="{{ route('admin.login') }}" class="btn-secondary">Admin Access</a>
        </div>

        <div class="pillars">
            <a href="{{ route('categories.show', 'fotografi') }}" class="pillar-card pillar-card-link">
                <svg class="pillar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg>
                <h3 class="pillar-title">FOTOGRAFI</h3>
                <p class="pillar-description">Master exposure, composition, and studio lighting techniques</p>
            </a>

            <a href="{{ route('categories.show', 'videografi') }}" class="pillar-card pillar-card-link">
                <svg class="pillar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                </svg>
                <h3 class="pillar-title">VIDEOGRAFI</h3>
                <p class="pillar-description">Cinematic camera movements, framing, and production management</p>
            </a>

            <a href="{{ route('categories.show', 'editing') }}" class="pillar-card pillar-card-link">
                <svg class="pillar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                <h3 class="pillar-title">EDITING</h3>
                <p class="pillar-description">Professional pacing, color grading, and sound design mastery</p>
            </a>

            <a href="{{ route('categories.show', 'design') }}" class="pillar-card pillar-card-link">
                <svg class="pillar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M12 19l7-7 3 3-7 7-3-3z"></path>
                    <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
                    <path d="M2 2l7.586 7.586"></path>
                    <circle cx="11" cy="11" r="2"></circle>
                </svg>
                <h3 class="pillar-title">DESIGN</h3>
                <p class="pillar-description">Visual identity, typography, and graphic design principles</p>
            </a>
        </div>

        <div class="ai-feature">
            <div class="ai-badge">AI Powered</div>
            <h2 class="ai-title">ATLAS AI Vision Analyzer</h2>
            <p class="ai-description">
                Upload your photography or still frames for instant cinematic analysis. 
                Our AI detects shot types, evaluates composition, and extracts color palettes.
            </p>

            <div class="ai-features">
                <div class="ai-feature-item">
                    <h4>Shot Detection</h4>
                    <p>Medium shots, close-ups, OTS, and more</p>
                </div>
                <div class="ai-feature-item">
                    <h4>Composition Analysis</h4>
                    <p>Rule of thirds, symmetry, leading lines</p>
                </div>
                <div class="ai-feature-item">
                    <h4>Color Extraction</h4>
                    <p>5-color palette from your images</p>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>ATLAS Studio © 2026 — Built for visual storytellers</p>
            <p style="margin-top: 8px;">
                <a href="{{ route('admin.login') }}">Admin Login</a> · 
                <a href="{{ route('ai.analyzer') }}">AI Analyzer</a>
            </p>
        </div>
    </div>
</body>
</html>
