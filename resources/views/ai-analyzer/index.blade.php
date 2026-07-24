<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATLAS AI Vision Analyzer</title>
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
            padding: 40px 24px 32px;
            background: linear-gradient(180deg, #0B0B0C 0%, #000000 100%);
        }

        .logo {
            margin-bottom: 16px;
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
            font-size: 3rem;
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
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.3em;
            color: #71717A;
            margin-top: 0.3rem;
            text-transform: uppercase;
        }

        .subtitle {
            font-size: 18px;
            font-weight: 300;
            color: #888888;
            margin-top: 24px;
        }

        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 48px 24px;
        }

        .upload-zone {
            border: 2px dashed #1a1a1a;
            border-radius: 24px;
            padding: 80px 40px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: #0B0B0C;
        }

        .upload-zone:hover,
        .upload-zone.dragover {
            border-color: #ffffff;
            background: #111111;
        }

        .upload-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            opacity: 0.5;
        }

        .upload-text {
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 8px;
        }

        .upload-subtext {
            font-size: 14px;
            color: #888888;
        }

        .preview-container {
            display: none;
            margin-top: 48px;
        }

        .preview-image {
            width: 100%;
            max-height: 600px;
            object-fit: contain;
            border-radius: 16px;
            background: #0B0B0C;
        }

        .analysis-panel {
            display: none;
            margin-top: 48px;
            background: #0B0B0C;
            border: 1px solid #1a1a1a;
            border-radius: 24px;
            padding: 48px;
        }

        .analysis-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
        }

        .analysis-card {
            background: #111111;
            border: 1px solid #1a1a1a;
            border-radius: 16px;
            padding: 32px;
        }

        .card-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #888888;
            margin-bottom: 16px;
        }

        .card-value {
            font-size: 24px;
            font-weight: 300;
            margin-bottom: 8px;
        }

        .card-subvalue {
            font-size: 14px;
            color: #888888;
        }

        .color-palette {
            display: flex;
            gap: 16px;
            margin-top: 16px;
        }

        .color-swatch {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            border: 2px solid #1a1a1a;
            transition: transform 0.3s ease;
        }

        .color-swatch:hover {
            transform: scale(1.1);
        }

        .color-code {
            font-size: 11px;
            color: #888888;
            text-align: center;
            margin-top: 8px;
        }

        .score-bar {
            height: 8px;
            background: #1a1a1a;
            border-radius: 4px;
            margin-top: 16px;
            overflow: hidden;
        }

        .score-fill {
            height: 100%;
            background: linear-gradient(90deg, #4ade80, #22c55e);
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .notes {
            grid-column: 1 / -1;
            background: #111111;
            border: 1px solid #1a1a1a;
            border-radius: 16px;
            padding: 32px;
        }

        .notes-text {
            font-size: 14px;
            line-height: 1.6;
            color: #cccccc;
        }

        .btn-analyze {
            display: none;
            margin: 32px auto 0;
            padding: 16px 48px;
            background: #ffffff;
            color: #000000;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-analyze:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
        }

        .loading {
            display: none;
            text-align: center;
            padding: 48px;
        }

        .spinner {
            width: 48px;
            height: 48px;
            border: 3px solid #1a1a1a;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 24px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loading-text {
            font-size: 16px;
            color: #888888;
        }

        input[type="file"] {
            display: none;
        }
    </style>
</head>
<body>
    @include('components.particle-background')
    <div class="header">
        <p class="subtitle">{{ __('app.ai.subtitle') }}</p>
    </div>

    <div class="main-content">
        <div class="upload-zone" id="uploadZone">
            <svg class="upload-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            <p class="upload-text">{{ __('app.ai.drag_drop') }}</p>
            <p class="upload-subtext">{{ __('app.ai.click_browse') }}</p>
            <input type="file" id="fileInput" accept="image/*">
        </div>

        <div class="preview-container" id="previewContainer">
            <img id="previewImage" class="preview-image" src="https://images.pexels.com/photos/7934552/pexels-photo-7934552.jpeg?auto=compress&cs=tinysrgb&w=1200" alt="Camera equipment preview">
            <button class="btn-analyze" id="analyzeBtn">{{ __('app.ai.analyze_btn') }}</button>
        </div>

        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p class="loading-text">{{ __('app.ai.analyzing') }}</p>
        </div>

        <div class="analysis-panel" id="analysisPanel">
            <div class="analysis-grid">
                <div class="analysis-card">
                    <div class="card-label">{{ __('app.ai.shot_detection') }}</div>
                    <div class="card-value" id="shotType">-</div>
                    <div class="card-subvalue">{{ __('app.ai.shot_type') }}</div>
                </div>

                <div class="analysis-card">
                    <div class="card-label">{{ __('app.ai.composition') }}</div>
                    <div class="card-value" id="compositionText">-</div>
                    <div class="score-bar">
                        <div class="score-fill" id="scoreFill" style="width: 0%"></div>
                    </div>
                </div>

                <div class="analysis-card">
                    <div class="card-label">{{ __('app.ai.color_palette') }}</div>
                    <div class="color-palette" id="colorPalette">
                        <!-- Colors will be inserted here -->
                    </div>
                </div>

                <div class="analysis-card">
                    <div class="card-label">{{ __('app.ai.lighting') }}</div>
                    <div class="card-value">94%</div>
                    <div class="card-subvalue">AI model accuracy</div>
                </div>

                <div class="notes">
                    <div class="card-label">{{ __('app.ai.analysis_notes') }}</div>
                    <p class="notes-text" id="notesText">-</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const uploadZone = document.getElementById('uploadZone');
        const fileInput = document.getElementById('fileInput');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const analyzeBtn = document.getElementById('analyzeBtn');
        const loading = document.getElementById('loading');
        const analysisPanel = document.getElementById('analysisPanel');

        uploadZone.addEventListener('click', () => fileInput.click());

        uploadZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadZone.classList.add('dragover');
        });

        uploadZone.addEventListener('dragleave', () => {
            uploadZone.classList.remove('dragover');
        });

        uploadZone.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadZone.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                handleFile(file);
            }
        });

        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                handleFile(file);
            }
        });

        function handleFile(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
                analyzeBtn.style.display = 'block';
                uploadZone.style.display = 'none';
                analysisPanel.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        analyzeBtn.addEventListener('click', async () => {
            const file = fileInput.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('image', file);

            analyzeBtn.style.display = 'none';
            loading.style.display = 'block';

            try {
                const response = await fetch('{{ route('ai.analyze') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData,
                });

                const result = await response.json();

                loading.style.display = 'none';
                analysisPanel.style.display = 'block';

                document.getElementById('shotType').textContent = result.data.shot_type;
                document.getElementById('compositionText').textContent = result.data.composition_text;
                document.getElementById('scoreFill').style.width = result.data.composition_score + '%';
                document.getElementById('notesText').textContent = result.data.notes;

                const colorPalette = document.getElementById('colorPalette');
                colorPalette.innerHTML = '';
                result.data.color_palette.forEach(color => {
                    const swatch = document.createElement('div');
                    swatch.className = 'color-swatch';
                    swatch.style.backgroundColor = color;
                    swatch.title = color;
                    colorPalette.appendChild(swatch);
                });

            } catch (error) {
                console.error('Error:', error);
                loading.style.display = 'none';
                analyzeBtn.style.display = 'block';
                alert('Error analyzing image. Please try again.');
            }
        });
    </script>
</body>
</html>
