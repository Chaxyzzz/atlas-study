<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATLAS Study — Pure Black Edition</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-black: #000000;
            --surface-dark: #0B0B0C;
            --card-glass: rgba(17, 17, 17, 0.85);
            --border-subtle: rgba(255, 255, 255, 0.12);
            --text-primary: #ffffff;
            --text-secondary: #9CA3AF;
            --text-muted: #71737A;
            --accent-silver: #E5E7EB;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: var(--bg-black);
            color: var(--text-primary);
            font-family: 'Plus Jakarta Sans', Inter, -apple-system, BlinkMacSystemFont, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* Fullscreen Cinematic Container */
        .cinematic-container {
            position: relative;
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            background: radial-gradient(circle at 50% 40%, #0d0d0f 0%, #000000 75%);
            z-index: 1;
        }

        /* Language Switcher Badge on Opening Screen */
        .opening-lang-switcher {
            position: absolute;
            top: 2rem;
            right: 2.5rem;
            z-index: 20;
            display: flex;
            gap: 0.5rem;
        }

        .lang-btn-pill {
            padding: 0.4rem 0.85rem;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 9999px;
            color: var(--text-secondary);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-subtle);
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .lang-btn-pill.active, .lang-btn-pill:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.35);
        }

        /* Particle Canvas */
        #particle-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 2;
        }

        /* Ambient Lighting & Effects */
        .ambient-glow-1 {
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 550px;
            height: 550px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.045) 0%, rgba(0, 0, 0, 0) 70%);
            filter: blur(90px);
            pointer-events: none;
            z-index: 1;
            animation: pulseGlow 8s ease-in-out infinite alternate;
        }

        .ambient-glow-2 {
            position: absolute;
            bottom: 15%;
            left: 30%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.02) 0%, rgba(0, 0, 0, 0) 70%);
            filter: blur(100px);
            pointer-events: none;
            z-index: 1;
        }

        .vignette-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: radial-gradient(circle at 50% 50%, transparent 50%, rgba(0, 0, 0, 0.88) 100%);
            pointer-events: none;
            z-index: 3;
        }

        @keyframes pulseGlow {
            0% { opacity: 0.4; transform: translate(-50%, -50%) scale(0.95); }
            100% { opacity: 0.85; transform: translate(-50%, -50%) scale(1.05); }
        }

        /* Center Content Box */
        .opening-content {
            position: relative;
            z-index: 10;
            max-width: 680px;
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: fadeInContent 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fadeInContent {
            0% { opacity: 0; transform: translateY(20px) scale(0.98); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        .opening-logo {
            margin-bottom: 2.5rem;
            transform: scale(1.35);
        }

        .opening-welcome-caption {
            font-size: 1.05rem;
            font-weight: 400;
            line-height: 1.75;
            color: var(--text-secondary);
            max-width: 620px;
            margin-bottom: 2.75rem;
            text-align: center;
            letter-spacing: 0.01em;
        }

        /* MASUK Button */
        .btn-masuk {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.88rem 3.3rem;
            font-size: 0.88rem;
            font-weight: 700;
            letter-spacing: 0.22em;
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-subtle);
            border-radius: 9999px;
            cursor: pointer;
            outline: none;
            overflow: hidden;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        }

        .btn-masuk:hover {
            transform: scale(1.03);
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.35);
            box-shadow: 0 0 35px rgba(255, 255, 255, 0.18), 0 8px 32px rgba(0, 0, 0, 0.6);
            color: #ffffff;
        }

        .btn-masuk:active {
            transform: scale(0.98);
        }

        /* Glassmorphism Login Gateway Modal */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.82);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .modal-backdrop.active {
            opacity: 1;
            pointer-events: auto;
        }

        .login-card {
            position: relative;
            width: 100%;
            max-width: 440px;
            background: var(--card-glass);
            border: 1px solid var(--border-subtle);
            border-radius: 28px;
            padding: 2.75rem 2.25rem 2.5rem;
            box-shadow: 0 32px 96px rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            transform: scale(0.92) translateY(20px);
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            text-align: center;
        }

        .modal-backdrop.active .login-card {
            transform: scale(1) translateY(0);
        }

        .btn-close-modal {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-secondary);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .btn-close-modal:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
        }

        .login-header-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.35rem;
            letter-spacing: -0.01em;
        }

        .login-header-sub {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-bottom: 2.25rem;
        }

        /* Login Action Buttons & Forms */
        .login-option-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.85rem;
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            border-radius: 9999px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            outline: none;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-google {
            background: #ffffff;
            color: #000000;
            border: 1px solid #ffffff;
        }

        .btn-google:hover {
            background: #e5e7eb;
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.25);
            transform: translateY(-1px);
        }

        .btn-phone-trigger {
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            border: 1px solid var(--border-subtle);
        }

        .btn-phone-trigger:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-1px);
        }

        /* Phone & OTP Step Forms */
        .phone-form-step {
            display: none;
            text-align: left;
            margin-top: 1rem;
            animation: fadeInStep 0.3s ease forwards;
        }

        .phone-form-step.active {
            display: block;
        }

        @keyframes fadeInStep {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-label-custom {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .input-dark-custom {
            width: 100%;
            padding: 0.95rem 1.25rem;
            background: rgba(0, 0, 0, 0.6);
            border: 1px solid var(--border-subtle);
            border-radius: 14px;
            color: #ffffff;
            font-size: 1rem;
            font-family: inherit;
            outline: none;
            transition: all 0.3s ease;
            margin-bottom: 1.25rem;
        }

        .input-dark-custom:focus {
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.8);
        }

        .btn-submit-action {
            width: 100%;
            padding: 1rem;
            background: #ffffff;
            color: #000000;
            font-size: 0.95rem;
            font-weight: 700;
            border-radius: 9999px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .btn-submit-action:hover {
            background: #e5e7eb;
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.2);
        }

        .otp-notice {
            background: rgba(255, 255, 255, 0.06);
            border: 1px border-subtle;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
            font-size: 0.82rem;
            color: var(--text-secondary);
            text-align: center;
        }

        .otp-notice strong {
            color: #ffffff;
        }

        .btn-back-options {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-top: 1rem;
            cursor: pointer;
            transition: color 0.2s ease;
            width: 100%;
            text-align: center;
        }

        .btn-back-options:hover {
            color: #ffffff;
        }

        .status-alert {
            font-size: 0.85rem;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            display: none;
        }

        .status-alert.error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            display: block;
        }

        .status-alert.success {
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #86efac;
            display: block;
        }
    </style>
</head>
<body>
    <canvas id="particle-canvas"></canvas>

    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>
    <div class="vignette-overlay"></div>

    <div class="opening-lang-switcher">
        <a href="{{ route('lang.switch', 'id') }}" class="lang-btn-pill {{ App::getLocale() == 'id' ? 'active' : '' }}">🇮🇩 ID</a>
        <a href="{{ route('lang.switch', 'en') }}" class="lang-btn-pill {{ App::getLocale() == 'en' ? 'active' : '' }}">🇺🇸 EN</a>
    </div>

    <main class="cinematic-container">
        <div class="opening-content">
            <div class="opening-logo">
                @include('components.logo')
            </div>

            <p class="opening-welcome-caption">
                {!! __('app.opening.welcome_caption') !!}
            </p>

            <button class="btn-masuk" id="btnMasuk" aria-label="Masuk ke platform">
                <span>{{ __('app.opening.enter') }}</span>
            </button>
        </div>
    </main>

    <!-- Glassmorphism Login Gateway Modal -->
    <div class="modal-backdrop" id="loginModalBackdrop">
        <div class="login-card">
            <button class="btn-close-modal" id="btnCloseModal" aria-label="Close modal">&times;</button>
            
            <div class="login-header">
                <h2 class="login-header-title">{{ __('app.opening.welcome_back') }}</h2>
                <p class="login-header-sub">{{ __('app.opening.continue_learning') }}</p>
            </div>

            <div id="statusAlert" class="status-alert"></div>

            <!-- Option Select View -->
            <div id="loginOptionsView">
                <a href="{{ route('auth.google') }}" class="login-option-btn btn-google" id="btnGoogleAuth">
                    <svg width="18" height="18" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    {{ __('app.opening.continue_google') }}
                </a>

                <button class="login-option-btn btn-phone-trigger" id="btnPhoneTrigger">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    {{ __('app.opening.continue_phone') }}
                </button>
            </div>

            <!-- Phone Step 1: Input Phone Number -->
            <form id="phoneStepForm" class="phone-form-step">
                <label class="form-label-custom">{{ __('app.opening.phone_label') }}</label>
                <input type="tel" id="inputPhone" class="input-dark-custom" placeholder="081234567890" required>
                <button type="submit" class="btn-submit-action" id="btnSendOtp">{{ __('app.opening.send_otp') }}</button>
                <button type="button" class="btn-back-options" id="btnBackToOptions">{{ __('app.opening.choose_other') }}</button>
            </form>

            <!-- Phone Step 2: Verify OTP -->
            <form id="otpStepForm" class="phone-form-step">
                <div class="otp-notice">
                    {{ __('app.opening.demo_otp_notice') }} <strong id="displayPhone"></strong>.<br>
                    <span>(Demo OTP: <strong>888888</strong>)</span>
                </div>
                <label class="form-label-custom">{{ __('app.opening.enter_otp') }}</label>
                <input type="text" id="inputOtp" class="input-dark-custom" maxlength="6" placeholder="888888" style="text-align: center; letter-spacing: 0.4em; font-size: 1.25rem;" required>
                <button type="submit" class="btn-submit-action" id="btnVerifyOtp">{{ __('app.opening.verify_login') }}</button>
                <button type="button" class="btn-back-options" id="btnBackToPhone">{{ __('app.opening.change_phone') }}</button>
            </form>
        </div>
    </div>

    <!-- Particle Canvas Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const canvas = document.getElementById('particle-canvas');
            const ctx = canvas.getContext('2d');

            let width, height;
            let particles = [];

            function resize() {
                width = canvas.width = window.innerWidth;
                height = canvas.height = window.innerHeight;
            }

            class Particle {
                constructor() {
                    this.reset();
                }

                reset() {
                    this.x = Math.random() * width;
                    this.y = Math.random() * height;
                    this.radius = Math.random() * 1.5 + 0.5;
                    this.vx = (Math.random() - 0.5) * 0.25;
                    this.vy = -Math.random() * 0.35 - 0.05;
                    this.alpha = Math.random() * 0.15 + 0.05;
                }

                update() {
                    this.x += this.vx;
                    this.y += this.vy;

                    if (this.y < -10 || this.x < -10 || this.x > width + 10) {
                        this.y = height + 10;
                        this.x = Math.random() * width;
                    }
                }

                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(229, 231, 235, ${this.alpha})`;
                    ctx.fill();
                }
            }

            function initParticles() {
                resize();
                const particleCount = Math.floor((width * height) / 14000);
                particles = [];
                for (let i = 0; i < particleCount; i++) {
                    particles.push(new Particle());
                }
            }

            function animate() {
                ctx.clearRect(0, 0, width, height);
                particles.forEach(p => {
                    p.update();
                    p.draw();
                });
                requestAnimationFrame(animate);
            }

            window.addEventListener('resize', () => {
                resize();
            });

            initParticles();
            animate();

            // Modal & Auth Logic
            const btnMasuk = document.getElementById('btnMasuk');
            const modalBackdrop = document.getElementById('loginModalBackdrop');
            const btnCloseModal = document.getElementById('btnCloseModal');

            const loginOptionsView = document.getElementById('loginOptionsView');
            const phoneStepForm = document.getElementById('phoneStepForm');
            const otpStepForm = document.getElementById('otpStepForm');
            
            const btnPhoneTrigger = document.getElementById('btnPhoneTrigger');
            const btnBackToOptions = document.getElementById('btnBackToOptions');
            const btnBackToPhone = document.getElementById('btnBackToPhone');
            
            const statusAlert = document.getElementById('statusAlert');
            const displayPhone = document.getElementById('displayPhone');

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            function showAlert(msg, isError = true) {
                statusAlert.textContent = msg;
                statusAlert.className = `status-alert ${isError ? 'error' : 'success'}`;
            }

            function clearAlert() {
                statusAlert.textContent = '';
                statusAlert.className = 'status-alert';
            }

            btnMasuk.addEventListener('click', () => {
                modalBackdrop.classList.add('active');
                clearAlert();
                loginOptionsView.style.display = 'block';
                phoneStepForm.classList.remove('active');
                otpStepForm.classList.remove('active');
            });

            btnCloseModal.addEventListener('click', () => {
                modalBackdrop.classList.remove('active');
            });

            modalBackdrop.addEventListener('click', (e) => {
                if (e.target === modalBackdrop) {
                    modalBackdrop.classList.remove('active');
                }
            });

            // Switch to Phone Step
            btnPhoneTrigger.addEventListener('click', () => {
                clearAlert();
                loginOptionsView.style.display = 'none';
                phoneStepForm.classList.add('active');
                otpStepForm.classList.remove('active');
            });

            btnBackToOptions.addEventListener('click', () => {
                clearAlert();
                loginOptionsView.style.display = 'block';
                phoneStepForm.classList.remove('active');
                otpStepForm.classList.remove('active');
            });

            btnBackToPhone.addEventListener('click', () => {
                clearAlert();
                phoneStepForm.classList.add('active');
                otpStepForm.classList.remove('active');
            });

            // Send OTP
            phoneStepForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                clearAlert();
                const phone = document.getElementById('inputPhone').value.trim();
                if (!phone) return;

                try {
                    const res = await fetch('{{ route("auth.phone.send") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ phone })
                    });
                    const data = await res.json();
                    if (data.success) {
                        displayPhone.textContent = phone;
                        phoneStepForm.classList.remove('active');
                        otpStepForm.classList.add('active');
                        document.getElementById('inputOtp').value = '888888';
                    } else {
                        showAlert(data.message || 'Gagal mengirim OTP.');
                    }
                } catch (err) {
                    showAlert('Gagal mengirim OTP. Periksa jaringan.');
                }
            });

            // Verify OTP
            otpStepForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                clearAlert();
                const phone = displayPhone.textContent;
                const otp = document.getElementById('inputOtp').value.trim();

                try {
                    const res = await fetch('{{ route("auth.phone.verify") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ phone, otp })
                    });
                    const data = await res.json();
                    if (data.success) {
                        showAlert('Berhasil masuk!', false);
                        setTimeout(() => {
                            window.location.href = data.redirect || '{{ route("home") }}';
                        }, 400);
                    } else {
                        showAlert(data.message || 'Kode OTP salah.');
                    }
                } catch (err) {
                    showAlert('Gagal melakukan verifikasi.');
                }
            });
        });
    </script>
</body>
</html>
