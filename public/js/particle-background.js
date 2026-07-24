/**
 * Premium Interactive Particle Background
 * Floating calm particles with smooth mouse repulsion and easing return.
 */
(function () {
    'use strict';

    let canvas = document.getElementById('particle-canvas');
    if (!canvas) {
        canvas = document.createElement('canvas');
        canvas.id = 'particle-canvas';
        canvas.setAttribute('aria-hidden', 'true');
        document.body.prepend(canvas);
    }

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    let width = 0;
    let height = 0;
    let particles = [];
    let animationFrameId = null;
    let isTabActive = true;

    const mouse = {
        x: -9999,
        y: -9999,
        active: false,
        timer: null
    };

    function getTargetParticleCount(w) {
        if (w > 1024) return 110;  // Desktop: 100-120
        if (w >= 768) return 80;   // Tablet: 70-90
        return 50;                 // Mobile: 40-60
    }

    function resizeCanvas() {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
        const targetCount = getTargetParticleCount(width);
        
        if (particles.length === 0) {
            initParticles(targetCount);
        } else {
            adjustParticles(targetCount);
        }
    }

    class Particle {
        constructor() {
            this.init();
        }

        init() {
            this.baseX = Math.random() * width;
            this.baseY = Math.random() * height;
            
            // Slow, calm floating trajectory
            const angle = Math.random() * Math.PI * 2;
            const speed = 0.12 + Math.random() * 0.18; // ~0.12 to 0.30 px/frame
            this.vx = Math.cos(angle) * speed;
            this.vy = Math.sin(angle) * speed;

            // Discrete particle sizes: 1px, 2px, 3px
            const r = Math.random();
            this.size = r < 0.5 ? 1 : (r < 0.85 ? 2 : 3);

            // Particle Color: White (#FFFFFF) or Light Gray (#D9D9D9)
            this.color = Math.random() > 0.45 ? '255, 255, 255' : '217, 217, 217';
            
            // Opacity range: 15% to 40% (0.15 to 0.40)
            this.alpha = 0.15 + Math.random() * 0.25;

            // Repulsion offsets for smooth interaction & return
            this.offsetX = 0;
            this.offsetY = 0;
            this.renderX = this.baseX;
            this.renderY = this.baseY;
        }

        update() {
            // Update floating base position
            this.baseX += this.vx;
            this.baseY += this.vy;

            // Gentle edge wrapping
            if (this.baseX < -10) this.baseX = width + 10;
            if (this.baseX > width + 10) this.baseX = -10;
            if (this.baseY < -10) this.baseY = height + 10;
            if (this.baseY > height + 10) this.baseY = -10;

            // Mouse repulsion calculation
            let targetOffsetX = 0;
            let targetOffsetY = 0;

            if (mouse.active) {
                const currentX = this.baseX + this.offsetX;
                const currentY = this.baseY + this.offsetY;
                const dx = currentX - mouse.x;
                const dy = currentY - mouse.y;
                const distance = Math.hypot(dx, dy);
                const repulsionRadius = 100;

                if (distance < repulsionRadius && distance > 0) {
                    // Soft repulsion displacement between 20px and 40px
                    const factor = (1 - distance / repulsionRadius);
                    const pushAmount = 20 + factor * 20; // 20px to 40px
                    targetOffsetX = (dx / distance) * pushAmount;
                    targetOffsetY = (dy / distance) * pushAmount;
                }
            }

            // Smooth easing towards target displacement or back to 0 (no snapping/bouncing)
            this.offsetX += (targetOffsetX - this.offsetX) * 0.06;
            this.offsetY += (targetOffsetY - this.offsetY) * 0.06;

            this.renderX = this.baseX + this.offsetX;
            this.renderY = this.baseY + this.offsetY;
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.renderX, this.renderY, this.size / 2, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(${this.color}, ${this.alpha.toFixed(3)})`;
            ctx.fill();
        }
    }

    function initParticles(count) {
        particles = [];
        for (let i = 0; i < count; i++) {
            particles.push(new Particle());
        }
    }

    function adjustParticles(targetCount) {
        if (particles.length < targetCount) {
            const countToAdd = targetCount - particles.length;
            for (let i = 0; i < countToAdd; i++) {
                particles.push(new Particle());
            }
        } else if (particles.length > targetCount) {
            particles.length = targetCount;
        }
    }

    function animate() {
        if (!isTabActive) return;

        ctx.clearRect(0, 0, width, height);

        for (let i = 0; i < particles.length; i++) {
            particles[i].update();
            particles[i].draw();
        }

        animationFrameId = requestAnimationFrame(animate);
    }

    // Window Events
    window.addEventListener('resize', debounce(resizeCanvas, 100));

    window.addEventListener('mousemove', (e) => {
        mouse.x = e.clientX;
        mouse.y = e.clientY;
        mouse.active = true;

        clearTimeout(mouse.timer);
        mouse.timer = setTimeout(() => {
            mouse.active = false;
        }, 1500);
    });

    window.addEventListener('mouseleave', () => {
        mouse.active = false;
    });

    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            isTabActive = false;
            if (animationFrameId) {
                cancelAnimationFrame(animationFrameId);
                animationFrameId = null;
            }
        } else {
            if (!isTabActive) {
                isTabActive = true;
                animate();
            }
        }
    });

    function debounce(func, wait) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    // Run on DOM content loaded or immediate
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            resizeCanvas();
            animate();
        });
    } else {
        resizeCanvas();
        animate();
    }
})();
