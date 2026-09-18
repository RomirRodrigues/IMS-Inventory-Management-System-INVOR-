<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus Gateway | 2FA Security Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-black text-slate-300 antialiased min-h-screen flex flex-col relative" style="font-family: 'Inter', sans-serif;">

    <!-- Global Dither Overlay -->
    <div class="fixed inset-0 z-50 pointer-events-none opacity-[0.15]" style="background-image: url('data:image/svg+xml,%3Csvg%20viewBox%3D%220%200%202%202%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Crect%20width%3D%221%22%20height%3D%221%22%20fill%3D%22%23ffffff%22%2F%3E%3Crect%20x%3D%221%22%20y%3D%221%22%20width%3D%221%22%20height%3D%221%22%20fill%3D%22%23ffffff%22%2F%3E%3C%2Fsvg%3E'); background-size: 2px 2px;"></div>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center justify-center relative z-30 px-6 py-12 min-h-screen w-full">
        
        <!-- 2FA Card -->
        <div class="max-w-md w-full bg-black/95 backdrop-blur-xl rounded-2xl p-7 md:p-8 shadow-2xl flex flex-col relative group border border-white/[0.08]">
            
            <div class="text-center mb-6 w-full relative z-20">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-amber-500/10 border border-amber-500/30 mb-5 shadow-inner">
                    <iconify-icon icon="solar:shield-keyhole-linear" width="30" height="30" class="text-amber-400"></iconify-icon>
                </div>
                <h1 class="text-2xl md:text-3xl font-thin tracking-tight text-white leading-tight mb-2 uppercase">
                    Two-Factor Auth
                </h1>
                <p class="text-xs text-slate-400 font-extralight leading-relaxed">
                    Security Uplink Required. Enter the 6-digit PIN below to complete verification.
                </p>
            </div>

            <!-- Display Real Generated 2FA Code Prompt -->
            <?php if(isset($two_factor_code)): ?>
                <div class="mb-6 p-4 rounded-xl bg-sky-950/40 border border-sky-500/30 text-center relative z-20">
                    <p class="text-[11px] uppercase tracking-widest text-sky-400 font-extralight mb-1">Your 2FA Security PIN</p>
                    <div class="text-3xl font-mono tracking-widest text-white font-bold"><?php echo $two_factor_code; ?></div>
                    <p class="text-[10px] text-slate-400 font-extralight mt-1">Expires in 5 minutes</p>
                </div>
            <?php endif; ?>

            <?php if(!empty($errors)): ?>
                <div class="mb-5 p-3 rounded-lg bg-red-950/60 border border-red-800/60 text-red-300 text-xs font-light text-center relative z-20">
                    <?php echo $errors; ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo base_url('auth/verify_2fa'); ?>" method="post" class="space-y-5 relative z-20">
                <div>
                    <label for="pin" class="text-xs font-light text-slate-400 mb-2 block uppercase tracking-widest text-center">Enter 6-Digit Security PIN</label>
                    <div class="relative rounded-lg bg-black/80">
                        <input type="text" id="pin" name="pin" maxlength="6" required autocomplete="off" autofocus class="w-full bg-transparent px-4 py-3 text-2xl text-center tracking-[12px] font-mono text-white focus:outline-none border border-slate-800 rounded-lg focus:border-amber-400" placeholder="••••••">
                    </div>
                </div>

                <button type="submit" class="w-full bg-amber-500/20 hover:bg-amber-500/30 border border-amber-500/50 text-amber-300 text-sm font-light py-3 rounded-lg transition-all uppercase tracking-widest shadow-lg">
                    Verify & Unlock Gateway
                </button>

                <div class="text-center pt-2">
                    <a href="<?php echo base_url('auth/logout'); ?>" class="text-xs text-slate-500 hover:text-slate-300 transition-colors uppercase tracking-wider">Cancel Session</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
