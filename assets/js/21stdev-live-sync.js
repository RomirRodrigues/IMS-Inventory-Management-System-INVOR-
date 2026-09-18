/* ==========================================================================
   21st.dev + Framer Motion Real-Time Live UI Hot-Sync & Evolution Engine
   ========================================================================== */

(function () {
    let lastPatchId = null;

    // Hot-reload stylesheet dynamically without page refresh
    function hotReloadCss() {
        const links = document.getElementsByTagName('link');
        for (let i = 0; i < links.length; i++) {
            const link = links[i];
            if (link.rel === 'stylesheet' && link.href.includes('21stdev-theme.css')) {
                const newHref = link.href.split('?')[0] + '?v=' + new Date().getTime();
                link.href = newHref;
            }
        }
    }

    // Show 21st.dev Framer Motion Toast Notification
    function showEvolutionToast(msg) {
        let toast = document.getElementById('21stdev-ai-toast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = '21stdev-ai-toast';
            toast.style.cssText = `
                position: fixed;
                bottom: 24px;
                right: 24px;
                z-index: 99999;
                background: rgba(10, 10, 10, 0.95);
                border: 1px solid rgba(56, 189, 248, 0.4);
                box-shadow: 0 10px 40px rgba(56, 189, 248, 0.25);
                backdrop-filter: blur(16px);
                border-radius: 14px;
                padding: 12px 18px;
                color: #f8fafc;
                font-family: 'Inter', sans-serif;
                font-size: 12px;
                display: flex;
                align-items: center;
                gap: 12px;
                transform: translateY(100px);
                opacity: 0;
                transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            `;
            toast.innerHTML = `
                <div style="width: 10px; height: 10px; border-radius: 50%; background: #38bdf8; box-shadow: 0 0 10px #38bdf8; animation: ping 1.5s infinite;"></div>
                <div>
                    <strong style="display:block; text-transform:uppercase; letter-spacing:1px; font-size:10px; color:#38bdf8;">21st.dev Motion AI</strong>
                    <span id="21stdev-ai-toast-msg">Site Updated Live without Refresh</span>
                </div>
            `;
            document.body.appendChild(toast);
        }

        const msgSpan = document.getElementById('21stdev-ai-toast-msg');
        if (msgSpan) msgSpan.textContent = msg || '15-Min AI Evolution Applied Live';

        // Trigger Motion Entrance
        requestAnimationFrame(() => {
            toast.style.transform = 'translateY(0)';
            toast.style.opacity = '1';
        });

        // Auto Hide after 4 seconds
        setTimeout(() => {
            toast.style.transform = 'translateY(100px)';
            toast.style.opacity = '0';
        }, 4000);
    }

    // Check for AI Evolutions in the background every 15 seconds
    function checkLiveSync() {
        if (!window.location.origin) return;
        const syncUrl = window.location.origin + (window.location.pathname.startsWith('/InventorySystem') ? '/InventorySystem' : '') + '/ai_agent/history';
        
        fetch(syncUrl)
            .then(r => r.json())
            .then(history => {
                if (history && history.length > 0) {
                    const latest = history[0];
                    if (lastPatchId && lastPatchId !== latest.id) {
                        // New 15-min evolution or patch detected!
                        hotReloadCss();
                        showEvolutionToast(latest.actions ? latest.actions[0] : '21st.dev Motion Evolution Live');
                    }
                    lastPatchId = latest.id;
                }
            })
            .catch(() => {});
    }

    // Initial check and periodic polling
    document.addEventListener('DOMContentLoaded', () => {
        checkLiveSync();
        setInterval(checkLiveSync, 15000); // 15-second background polling
    });
})();
