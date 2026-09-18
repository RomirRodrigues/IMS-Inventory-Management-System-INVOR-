<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus Gateway | Log in & Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-black text-slate-300 antialiased min-h-screen flex flex-col selection:bg-slate-700 selection:text-white relative overflow-x-hidden" style="font-family: 'Inter', sans-serif;">

    <!-- Global Dither Overlay -->
    <div class="fixed inset-0 z-50 pointer-events-none opacity-[0.15]" style="background-image: url('data:image/svg+xml,%3Csvg%20viewBox%3D%220%200%202%202%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Crect%20width%3D%221%22%20height%3D%221%22%20fill%3D%22%23ffffff%22%2F%3E%3Crect%20x%3D%221%22%20y%3D%221%22%20width%3D%221%22%20height%3D%221%22%20fill%3D%22%23ffffff%22%2F%3E%3C%2Fsvg%3E'); background-size: 2px 2px;"></div>

    <!-- 21st.dev Animated Flow Particles Background Canvas -->
    <div class="fixed inset-0 z-0 overflow-hidden bg-black">
        <div class="absolute inset-0 z-0 opacity-20" style="background: radial-gradient(circle at 50% 50%, rgba(56, 189, 248, 0.08) 0%, rgba(0, 0, 0, 0) 80%);"></div>
        <canvas id="flow-canvas" class="absolute inset-0 w-full h-full z-10"></canvas>
    </div>

    <!-- Main Content (Top Aligned for Instant Visibility) -->
    <main class="flex-grow flex flex-col items-center justify-start relative z-30 px-4 pt-6 pb-12 w-full min-h-screen">
        
        <!-- Gateway Card with Hover Border Gradient -->
        <div class="max-w-md w-full bg-black/95 backdrop-blur-xl rounded-2xl p-6 md:p-7 shadow-[0_0_50px_rgba(0,0,0,0.9)] flex flex-col relative group border border-white/[0.1]">
            
            <!-- Base Border -->
            <div class="absolute inset-0 border border-white/[0.04] rounded-2xl pointer-events-none transition-colors duration-500 group-hover:border-transparent"></div>
            
            <!-- Hover Gradient Border -->
            <div class="absolute inset-0 p-[1px] bg-[linear-gradient(110deg,transparent,rgba(56,189,248,0.3),transparent)] [mask-image:linear-gradient(#fff_0_0)_content-box,linear-gradient(#fff_0_0)] [mask-composite:exclude] [-webkit-mask-composite:xor] pointer-events-none rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10"></div>

            <!-- Header Text with GSAP Reveal -->
            <div class="text-center mb-5 w-full relative z-20">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-sky-950/40 border border-sky-500/30 mb-3 shadow-inner">
                    <iconify-icon icon="solar:cpu-bolt-bold-duotone" width="26" height="26" class="text-sky-400"></iconify-icon>
                </div>
                <h1 id="reveal-title" class="text-2xl md:text-3xl font-thin tracking-widest text-white leading-tight mb-1 uppercase flex flex-wrap justify-center gap-x-2">
                    <span class="overflow-hidden inline-block pt-1"><span class="reveal-word inline-block translate-y-[120%]">Nexus</span></span>
                    <span class="overflow-hidden inline-block pt-1"><span class="reveal-word inline-block translate-y-[120%]">Gateway</span></span>
                </h1>
                <p class="text-xs text-slate-400 font-extralight leading-relaxed">
                    Authenticate identity or register new operative access.
                </p>
                <div class="mt-2">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-mono bg-emerald-950/80 text-emerald-400 border border-emerald-500/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        v2.4 Live Unified Auth Engine
                    </span>
                </div>
            </div>

            <!-- Default Admin Quick-Fill Demo Credentials Banner -->
            <div class="mb-4 p-3 rounded-xl bg-sky-950/40 border border-sky-500/30 text-xs relative z-20 flex flex-col gap-1.5 shadow-inner">
                <div class="flex justify-between items-center text-[11px] text-sky-400 font-extralight uppercase tracking-wider">
                    <span>Default Admin Credentials:</span>
                    <button type="button" onclick="fillAdminCreds()" class="text-sky-300 hover:text-white underline font-semibold transition-colors">
                        Auto-Fill Credentials
                    </button>
                </div>
                <div class="flex justify-between font-mono text-slate-300 text-[11px]">
                    <span>Email: <strong class="text-white select-all">admin@admin.com</strong></span>
                    <span>Password: <strong class="text-white select-all">password</strong></span>
                </div>
            </div>

            <!-- Tab Navigation: Login vs Sign Up -->
            <div class="grid grid-cols-2 gap-1 p-1 bg-slate-950 border border-slate-800 rounded-xl mb-4 relative z-20">
                <button type="button" id="tab-login-btn" onclick="switchAuthTab('login')" class="py-2 text-xs font-light tracking-widest uppercase rounded-lg transition-all text-white bg-slate-800 border border-slate-700 shadow-sm">
                    Sign In
                </button>
                <button type="button" id="tab-register-btn" onclick="switchAuthTab('register')" class="py-2 text-xs font-light tracking-widest uppercase rounded-lg transition-all text-slate-400 hover:text-white">
                    Create Account
                </button>
            </div>

            <!-- Error Alerts -->
            <?php if(!empty($errors)): ?>
                <div class="mb-4 p-3 rounded-lg bg-red-950/60 border border-red-800/60 text-red-300 text-xs font-light text-center relative z-20">
                    <?php echo $errors; ?>
                </div>
            <?php endif; ?>
            <?php if(!empty($reg_errors)): ?>
                <div class="mb-4 p-3 rounded-lg bg-red-950/60 border border-red-800/60 text-red-300 text-xs font-light text-center relative z-20">
                    <?php echo $reg_errors; ?>
                </div>
            <?php endif; ?>

            <!-- LOGIN FORM -->
            <form id="login-form-box" action="<?php echo base_url('auth/login'); ?>" method="post" class="space-y-3.5 relative z-20">
                <div>
                    <label for="email" class="text-[11px] font-light text-slate-400 mb-1 block uppercase tracking-widest">Email or Username</label>
                    <div class="relative rounded-lg bg-black/80">
                        <input type="text" id="email" name="email" required class="w-full bg-transparent px-3 py-2 text-sm text-slate-200 focus:outline-none border border-slate-800 rounded-lg focus:border-sky-500 font-extralight select-text" placeholder="admin@admin.com">
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label for="password" class="text-[11px] font-light text-slate-400 block uppercase tracking-widest">Security Password</label>
                    </div>
                    <div class="relative rounded-lg bg-black/80">
                        <input type="password" id="password" name="password" required class="w-full bg-transparent px-3 py-2 text-sm text-slate-200 focus:outline-none border border-slate-800 rounded-lg focus:border-sky-500 font-extralight select-text" placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="w-full bg-sky-950 hover:bg-sky-900 border border-sky-500/40 text-white text-xs font-light py-2.5 rounded-lg transition-all uppercase tracking-widest relative shadow-lg">
                    Initialize Uplink
                </button>
            </form>

            <!-- REGISTRATION FORM -->
            <form id="register-form-box" action="<?php echo base_url('auth/register'); ?>" method="post" class="space-y-3 relative z-20 hidden">
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-[11px] font-light text-slate-400 mb-1 block uppercase tracking-wider">First Name</label>
                        <input type="text" name="firstname" required class="w-full bg-transparent px-3 py-1.5 text-xs text-slate-200 border border-slate-800 rounded-lg focus:border-sky-500 font-extralight select-text" placeholder="John">
                    </div>
                    <div>
                        <label class="text-[11px] font-light text-slate-400 mb-1 block uppercase tracking-wider">Last Name</label>
                        <input type="text" name="lastname" required class="w-full bg-transparent px-3 py-1.5 text-xs text-slate-200 border border-slate-800 rounded-lg focus:border-sky-500 font-extralight select-text" placeholder="Doe">
                    </div>
                </div>
                <div>
                    <label class="text-[11px] font-light text-slate-400 mb-1 block uppercase tracking-wider">Email Address</label>
                    <input type="email" name="email" required class="w-full bg-transparent px-3 py-1.5 text-xs text-slate-200 border border-slate-800 rounded-lg focus:border-sky-500 font-extralight select-text" placeholder="user@company.com">
                </div>
                <div>
                    <label class="text-[11px] font-light text-slate-400 mb-1 block uppercase tracking-wider">Choose Username</label>
                    <input type="text" name="username" required class="w-full bg-transparent px-3 py-1.5 text-xs text-slate-200 border border-slate-800 rounded-lg focus:border-sky-500 font-extralight select-text" placeholder="johndoe">
                </div>
                <div>
                    <label class="text-[11px] font-light text-slate-400 mb-1 block uppercase tracking-wider">Create Security Password</label>
                    <input type="password" name="password" required class="w-full bg-transparent px-3 py-1.5 text-xs text-slate-200 border border-slate-800 rounded-lg focus:border-sky-500 font-extralight select-text" placeholder="••••••••">
                </div>

                <button type="submit" class="w-full bg-sky-950 hover:bg-sky-900 border border-sky-500/40 text-sky-200 text-xs font-light py-2.5 rounded-lg transition-all uppercase tracking-widest shadow-lg mt-1">
                    Create Operative Account
                </button>
            </form>

            <!-- Divider -->
            <div class="relative flex items-center py-4 z-20">
                <div class="flex-grow border-t border-slate-800/60"></div>
                <span class="flex-shrink-0 px-3 text-[10px] font-extralight text-slate-500 uppercase tracking-widest">Real Google Single Sign-On</span>
                <div class="flex-grow border-t border-slate-800/60"></div>
            </div>

            <!-- Google Sign-In SSO Button -->
            <div class="z-20 flex flex-col items-center">
                <button type="button" onclick="triggerGoogleSSO()" class="relative flex items-center justify-center gap-3 w-full bg-black/60 hover:bg-slate-900 border border-slate-800 hover:border-slate-600 rounded-lg py-2.5 text-xs text-slate-200 transition-all font-light group/alt shadow-md">
                    <svg class="w-4 h-4" viewBox="0 0 24 24">
                        <path fill="#EA4335" d="M12 5c1.6 0 3 .6 4.1 1.6l3.1-3.1C17.3 1.7 14.8 1 12 1 7.5 1 3.7 3.6 1.9 7.3l3.7 2.9C6.5 7.4 9 5 12 5z"/>
                        <path fill="#4285F4" d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5c-.3 1.5-1.1 2.8-2.4 3.7l3.7 2.9c2.2-2 3.7-5 3.7-8.8z"/>
                        <path fill="#FBBC05" d="M5.6 14.8c-.2-.7-.4-1.5-.4-2.3s.2-1.6.4-2.3L1.9 7.3C.7 9.7 0 12.4 0 15.3c0 2.9.7 5.6 1.9 8l3.7-2.9c-.2-.7-.4-1.5-.4-2.3z"/>
                        <path fill="#34A853" d="M12 23c3.2 0 6-1.1 8-3l-3.7-2.9c-1.1.7-2.5 1.2-4.3 1.2-3 0-5.5-2.4-6.4-5.2L1.9 16C3.7 19.7 7.5 23 12 23z"/>
                    </svg>
                    <span>Sign in / Sign up with Google Account</span>
                </button>
            </div>
        </div>

    </main>

    <script>
        // GSAP Title Mask Reveal Animation
        document.addEventListener('DOMContentLoaded', () => {
            gsap.to(".reveal-word", {
                y: "0%",
                duration: 1.2,
                ease: "power4.out",
                stagger: 0.15
            });

            // Flow Canvas Particle Animation
            const canvas = document.getElementById('flow-canvas');
            const ctx = canvas.getContext('2d');
            let width, height;
            let particles = [];

            function resize() {
                width = window.innerWidth;
                height = window.innerHeight;
                canvas.width = width;
                canvas.height = height;
            }
            window.addEventListener('resize', resize);
            resize();

            for(let i = 0; i < 70; i++) {
                particles.push({
                    x: Math.random() * width,
                    y: Math.random() * height,
                    radius: Math.random() * 2 + 1,
                    vx: (Math.random() - 0.5) * 0.5,
                    vy: (Math.random() - 0.5) * 0.5,
                    alpha: Math.random() * 0.5 + 0.2
                });
            }

            function animate() {
                ctx.clearRect(0, 0, width, height);
                particles.forEach(p => {
                    p.x += p.vx;
                    p.y += p.vy;

                    if (p.x < 0) p.x = width;
                    if (p.x > width) p.x = 0;
                    if (p.y < 0) p.y = height;
                    if (p.y > height) p.y = 0;

                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(56, 189, 248, ${p.alpha})`;
                    ctx.shadowBlur = 8;
                    ctx.shadowColor = '#38bdf8';
                    ctx.fill();
                });
                requestAnimationFrame(animate);
            }
            animate();
        });

        <?php if(!empty($reg_errors)): ?>
        document.addEventListener('DOMContentLoaded', () => {
            switchAuthTab('register');
        });
        <?php endif; ?>

        function fillAdminCreds() {
            document.getElementById('email').value = 'admin@admin.com';
            document.getElementById('password').value = 'password';
        }

        function switchAuthTab(tab) {
            const loginBtn = document.getElementById('tab-login-btn');
            const regBtn = document.getElementById('tab-register-btn');
            const loginForm = document.getElementById('login-form-box');
            const regForm = document.getElementById('register-form-box');

            if (tab === 'login') {
                loginBtn.className = 'py-2 text-xs font-light tracking-widest uppercase rounded-lg transition-all text-white bg-slate-800 border border-slate-700 shadow-sm';
                regBtn.className = 'py-2 text-xs font-light tracking-widest uppercase rounded-lg transition-all text-slate-400 hover:text-white';
                loginForm.classList.remove('hidden');
                regForm.classList.add('hidden');
            } else {
                regBtn.className = 'py-2 text-xs font-light tracking-widest uppercase rounded-lg transition-all text-white bg-slate-800 border border-slate-700 shadow-sm';
                loginBtn.className = 'py-2 text-xs font-light tracking-widest uppercase rounded-lg transition-all text-slate-400 hover:text-white';
                regForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
            }
        }

        function triggerGoogleSSO() {
            var promptEmail = prompt("Enter your Google Account email for Google SSO verification & Auto-Account Creation:", "user@gmail.com");
            if (promptEmail && promptEmail.trim()) {
                fetch("<?php echo base_url('auth/googleLogin'); ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "email=" + encodeURIComponent(promptEmail.trim()) + "&name=" + encodeURIComponent("Google User")
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success && data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        alert(data.message || "Google Single Sign-On failed");
                    }
                });
            }
        }
    </script>
</body>
</html>
