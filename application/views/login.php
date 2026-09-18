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
<body class="bg-black text-slate-300 antialiased min-h-screen flex flex-col selection:bg-slate-700 selection:text-white relative" style="font-family: 'Inter', sans-serif;">

    <!-- Global Dither Overlay -->
    <div class="fixed inset-0 z-50 pointer-events-none opacity-[0.15]" style="background-image: url('data:image/svg+xml,%3Csvg%20viewBox%3D%220%200%202%202%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Crect%20width%3D%221%22%20height%3D%221%22%20fill%3D%22%23ffffff%22%2F%3E%3Crect%20x%3D%221%22%20y%3D%221%22%20width%3D%221%22%20height%3D%221%22%20fill%3D%22%23ffffff%22%2F%3E%3C%2Fsvg%3E'); background-size: 2px 2px;"></div>

    <!-- Visualization Background Canvas -->
    <div class="fixed inset-0 z-0 overflow-hidden bg-black">
        <div class="absolute inset-0 z-0 opacity-10" style="background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.01) 0%, rgba(0, 0, 0, 0) 80%);"></div>
        <canvas id="flow-canvas" class="absolute inset-0 w-full h-full z-10"></canvas>
    </div>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center justify-center relative z-30 px-6 py-12 min-h-screen w-full">
        
        <!-- Gateway Card with Hover Border Gradient -->
        <div class="max-w-md w-full bg-black/95 backdrop-blur-xl rounded-2xl p-7 md:p-8 shadow-2xl flex flex-col relative group border border-white/[0.08]">
            
            <!-- Base Border -->
            <div class="absolute inset-0 border border-white/[0.04] rounded-2xl pointer-events-none transition-colors duration-500 group-hover:border-transparent"></div>
            
            <!-- Hover Gradient Border -->
            <div class="absolute inset-0 p-[1px] bg-[linear-gradient(110deg,transparent,rgba(255,255,255,0.15),transparent)] [mask-image:linear-gradient(#fff_0_0)_content-box,linear-gradient(#fff_0_0)] [mask-composite:exclude] [-webkit-mask-composite:xor] pointer-events-none rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10"></div>

            <!-- Header Text -->
            <div class="text-center mb-6 w-full relative z-20">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-black/50 border border-slate-700/50 mb-4 shadow-inner">
                    <iconify-icon icon="solar:cpu-bolt-linear" width="24" height="24" stroke-width="1.5" class="text-slate-200"></iconify-icon>
                </div>
                <h1 id="reveal-title" class="text-3xl md:text-4xl font-thin tracking-tight text-white leading-tight mb-2 uppercase flex flex-wrap justify-center gap-x-2">
                    <span class="overflow-hidden inline-block pt-1"><span class="reveal-word inline-block translate-y-[120%]">Nexus</span></span>
                    <span class="overflow-hidden inline-block pt-1"><span class="reveal-word inline-block translate-y-[120%]">Gateway</span></span>
                </h1>
                <p class="text-xs text-slate-500 font-extralight leading-relaxed">
                    Authenticate identity or register new operative access to initialize secure framework uplink.
                </p>
            </div>

            <!-- Tab Navigation: Login vs Sign Up -->
            <div class="grid grid-cols-2 gap-1 p-1 bg-slate-950 border border-slate-800 rounded-xl mb-6 relative z-20">
                <button type="button" id="tab-login-btn" onclick="switchAuthTab('login')" class="py-2 text-xs font-light tracking-widest uppercase rounded-lg transition-all text-white bg-slate-800 border border-slate-700 shadow-sm">
                    Sign In
                </button>
                <button type="button" id="tab-register-btn" onclick="switchAuthTab('register')" class="py-2 text-xs font-light tracking-widest uppercase rounded-lg transition-all text-slate-400 hover:text-white">
                    Create Account
                </button>
            </div>

            <!-- Error Alerts -->
            <?php if(!empty($errors)): ?>
                <div class="mb-5 p-3 rounded-lg bg-red-950/60 border border-red-800/60 text-red-300 text-xs font-light text-center relative z-20">
                    <?php echo $errors; ?>
                </div>
            <?php endif; ?>
            <?php if(!empty($reg_errors)): ?>
                <div class="mb-5 p-3 rounded-lg bg-red-950/60 border border-red-800/60 text-red-300 text-xs font-light text-center relative z-20">
                    <?php echo $reg_errors; ?>
                </div>
            <?php endif; ?>

            <!-- LOGIN FORM -->
            <form id="login-form-box" action="<?php echo base_url('auth/login'); ?>" method="post" class="space-y-4 relative z-20">
                <div>
                    <label for="email" class="text-xs font-light text-slate-400 mb-1.5 block uppercase tracking-widest">Email or Username</label>
                    <div class="relative rounded-lg bg-black/80 group/input">
                        <input type="text" id="email" name="email" required autocomplete="off" class="relative w-full bg-transparent px-3 py-2 text-sm text-slate-200 focus:outline-none z-20 border border-slate-800 rounded-lg focus:border-slate-500 placeholder-slate-700 font-extralight" placeholder="admin@admin.com">
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label for="password" class="text-xs font-light text-slate-400 block uppercase tracking-widest">Security Key</label>
                    </div>
                    <div class="relative rounded-lg bg-black/80 group/input">
                        <input type="password" id="password" name="password" required autocomplete="off" class="relative w-full bg-transparent px-3 py-2 text-sm text-slate-200 focus:outline-none z-20 border border-slate-800 rounded-lg focus:border-slate-500 placeholder-slate-700 font-extralight" placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#0a0a0a] hover:bg-[#111] text-white text-xs font-light py-2.5 rounded-lg transition-all mt-2 uppercase tracking-widest relative border border-white/10 shadow-lg">
                    Initialize Uplink
                </button>
            </form>

            <!-- REGISTRATION FORM -->
            <form id="register-form-box" action="<?php echo base_url('auth/register'); ?>" method="post" class="space-y-3 relative z-20 hidden">
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-[11px] font-light text-slate-400 mb-1 block uppercase tracking-wider">First Name</label>
                        <input type="text" name="firstname" required class="w-full bg-transparent px-3 py-1.5 text-xs text-slate-200 border border-slate-800 rounded-lg focus:border-slate-500 font-extralight" placeholder="John">
                    </div>
                    <div>
                        <label class="text-[11px] font-light text-slate-400 mb-1 block uppercase tracking-wider">Last Name</label>
                        <input type="text" name="lastname" required class="w-full bg-transparent px-3 py-1.5 text-xs text-slate-200 border border-slate-800 rounded-lg focus:border-slate-500 font-extralight" placeholder="Doe">
                    </div>
                </div>
                <div>
                    <label class="text-[11px] font-light text-slate-400 mb-1 block uppercase tracking-wider">Email Address</label>
                    <input type="email" name="email" required class="w-full bg-transparent px-3 py-1.5 text-xs text-slate-200 border border-slate-800 rounded-lg focus:border-slate-500 font-extralight" placeholder="user@company.com">
                </div>
                <div>
                    <label class="text-[11px] font-light text-slate-400 mb-1 block uppercase tracking-wider">Choose Username</label>
                    <input type="text" name="username" required class="w-full bg-transparent px-3 py-1.5 text-xs text-slate-200 border border-slate-800 rounded-lg focus:border-slate-500 font-extralight" placeholder="johndoe">
                </div>
                <div>
                    <label class="text-[11px] font-light text-slate-400 mb-1 block uppercase tracking-wider">Create Security Password</label>
                    <input type="password" name="password" required class="w-full bg-transparent px-3 py-1.5 text-xs text-slate-200 border border-slate-800 rounded-lg focus:border-slate-500 font-extralight" placeholder="••••••••">
                </div>

                <button type="submit" class="w-full bg-sky-950 hover:bg-sky-900 border border-sky-500/40 text-sky-200 text-xs font-light py-2.5 rounded-lg transition-all uppercase tracking-widest shadow-lg mt-2">
                    Create Operative Account
                </button>
            </form>

            <!-- Divider -->
            <div class="relative flex items-center py-5 z-20">
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

    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script>
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
