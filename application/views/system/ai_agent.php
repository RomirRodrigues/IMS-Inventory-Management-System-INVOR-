<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-black text-slate-200 min-h-screen">
  <!-- Content Header (Page header) -->
  <section class="content-header px-6 pt-6 pb-2 border-b border-white/[0.08]">
    <div class="flex justify-between items-center">
      <div>
        <h1 class="text-2xl font-thin tracking-widest text-white uppercase flex items-center gap-3">
          <iconify-icon icon="solar:cpu-bolt-bold-duotone" class="text-sky-400" width="28" height="28"></iconify-icon>
          AI Autonomous Self-Updating Engine
        </h1>
        <ol class="breadcrumb bg-transparent px-0 py-2 text-xs text-slate-500">
          <li><a href="<?php echo base_url('dashboard') ?>" class="text-slate-400 hover:text-white"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active text-sky-400">AI Code Patcher & Cron Worker</li>
        </ol>
      </div>

      <!-- 15-Min Auto-Evolution Countdown Banner -->
      <div class="bg-sky-950/60 border border-sky-500/30 rounded-xl px-4 py-2.5 flex items-center gap-4 shadow-lg">
        <div class="flex items-center gap-2">
          <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
          <span class="text-xs uppercase tracking-widest text-sky-300 font-light">15-Min Evolution Active</span>
        </div>
        <div class="text-lg font-mono font-bold text-white border-l border-sky-800 pl-4" id="cron-timer">
          15:00
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content px-6 py-6">
    
    <div class="row">
      <!-- AI Control Console -->
      <div class="col-md-7">
        <div class="box bg-slate-950/80 border border-white/10 rounded-xl shadow-2xl p-5 mb-6">
          <div class="box-header with-border pb-3 border-b border-slate-800 flex justify-between items-center">
            <h3 class="box-title text-base font-light text-white uppercase tracking-wider flex items-center gap-2">
              <iconify-icon icon="solar:command-linear" class="text-amber-400"></iconify-icon>
              Autonomous Command & Patch Terminal
            </h3>
            <span class="badge bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[10px] px-2 py-1 uppercase tracking-widest">Self-Healing 24/7</span>
          </div>
          
          <div class="box-body pt-4">
            <p class="text-xs text-slate-400 font-extralight mb-4">
              The AI Engine automatically inspects system fallbacks, evolves UI themes, rotates glassmorphism animations, and fixes broken configurations every 15 minutes.
            </p>

            <div class="space-y-4">
              <div>
                <label class="text-xs uppercase tracking-widest text-slate-400 font-light block mb-2">Manual AI Instruction / Upgrade Prompt</label>
                <div class="relative">
                  <textarea id="ai-prompt-input" rows="3" class="w-full bg-black/90 border border-slate-800 rounded-lg p-3 text-sm text-slate-200 focus:outline-none focus:border-sky-500 font-mono placeholder-slate-700" placeholder="e.g. Trigger 15-min UI evolution, patch stylesheet, or check system fallbacks..."></textarea>
                </div>
              </div>

              <div class="flex flex-wrap gap-3">
                <button type="button" onclick="trigger15MinCron()" class="bg-gradient-to-r from-sky-600 to-indigo-600 hover:from-sky-500 hover:to-indigo-500 text-white text-xs uppercase tracking-widest px-5 py-2.5 rounded-lg font-light transition-all flex items-center gap-2 shadow-lg">
                  <iconify-icon icon="solar:restart-circle-bold" width="18" height="18"></iconify-icon>
                  Trigger 15-Min Evolution Now
                </button>
                <button type="button" onclick="sendAiCommand()" class="bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs uppercase tracking-widest px-4 py-2.5 rounded-lg font-light transition-all flex items-center gap-2">
                  <iconify-icon icon="solar:play-bold" width="16" height="16"></iconify-icon>
                  Execute Custom Prompt
                </button>
                <button type="button" onclick="runDiagnostics()" class="bg-black border border-slate-800 hover:border-slate-600 text-slate-400 text-xs uppercase tracking-widest px-4 py-2.5 rounded-lg font-light transition-all">
                  Run Diagnostics
                </button>
              </div>
            </div>

            <!-- Terminal Output Log Box -->
            <div class="mt-6">
              <label class="text-xs uppercase tracking-widest text-slate-400 font-light block mb-2">Real-time Terminal Execution Log</label>
              <pre id="terminal-output" class="bg-black border border-slate-800 rounded-lg p-4 text-xs font-mono text-emerald-400 h-52 overflow-y-auto whitespace-pre-wrap">
[SYSTEM INITIALIZED] AI Autonomous Self-Updating Worker Online.
[CRON WORKER] 15-minute Heartbeat scheduled.
[LOG] Listening for automated patches, UI evolutions, and fallback checks.
              </pre>
            </div>
          </div>
        </div>
      </div>

      <!-- Fallback Metrics & Patch History -->
      <div class="col-md-5">
        
        <!-- Health Card -->
        <div class="box bg-slate-950/80 border border-white/10 rounded-xl shadow-2xl p-5 mb-6">
          <div class="box-header with-border pb-3 border-b border-slate-800">
            <h3 class="box-title text-base font-light text-white uppercase tracking-wider flex items-center gap-2">
              <iconify-icon icon="solar:shield-check-bold" class="text-emerald-400"></iconify-icon>
              Fallback & Integrity Monitor
            </h3>
          </div>
          
          <div class="box-body pt-4 space-y-3">
            <div class="flex justify-between items-center p-3 rounded-lg bg-black/60 border border-slate-800">
              <span class="text-xs font-extralight text-slate-400">Database Tables</span>
              <span class="text-sm font-mono font-bold text-white"><?php echo isset($diagnostics['db_tables_count']) ? $diagnostics['db_tables_count'] : 0; ?> Tables</span>
            </div>

            <div class="flex justify-between items-center p-3 rounded-lg bg-black/60 border border-slate-800">
              <span class="text-xs font-extralight text-slate-400">Log Errors Flagged</span>
              <span class="text-sm font-mono font-bold text-emerald-400"><?php echo isset($diagnostics['log_errors_found']) ? $diagnostics['log_errors_found'] : 0; ?> Errors</span>
            </div>
          </div>
        </div>

        <!-- 15-Min Evolution Patch History -->
        <div class="box bg-slate-950/80 border border-white/10 rounded-xl shadow-2xl p-5">
          <div class="box-header with-border pb-3 border-b border-slate-800 flex justify-between items-center">
            <h3 class="box-title text-base font-light text-white uppercase tracking-wider flex items-center gap-2">
              <iconify-icon icon="solar:history-bold" class="text-sky-400"></iconify-icon>
              Patch Evolution History
            </h3>
            <span class="text-[10px] text-slate-500 uppercase">Last 50 Runs</span>
          </div>

          <div class="box-body pt-4 max-h-60 overflow-y-auto space-y-2" id="patch-history-list">
            <?php if(!empty($patch_history)): ?>
              <?php foreach($patch_history as $patch): ?>
                <div class="p-3 rounded bg-black/60 border border-slate-800/80 text-xs">
                  <div class="flex justify-between text-[11px] text-slate-400 mb-1">
                    <span class="font-mono text-sky-400"><?php echo isset($patch['type']) ? $patch['type'] : 'EVOLUTION'; ?></span>
                    <span><?php echo isset($patch['timestamp']) ? $patch['timestamp'] : ''; ?></span>
                  </div>
                  <?php if(!empty($patch['actions'])): ?>
                    <ul class="list-disc list-inside text-slate-300 font-extralight space-y-0.5 text-[11px]">
                      <?php foreach($patch['actions'] as $act): ?>
                        <li><?php echo $act; ?></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="text-xs text-slate-600 italic">No automated patches logged yet. Click "Trigger 15-Min Evolution Now" to start.</p>
            <?php endif; ?>
          </div>
        </div>

      </div>
    </div>

  </section>
</div>

<script>
let cronSeconds = 900; // 15 minutes = 900 seconds

function updateTimerDisplay() {
    const min = Math.floor(cronSeconds / 60);
    const sec = cronSeconds % 60;
    document.getElementById('cron-timer').textContent = 
        (min < 10 ? '0' : '') + min + ':' + (sec < 10 ? '0' : '') + sec;
}

setInterval(() => {
    if (cronSeconds > 0) {
        cronSeconds--;
        updateTimerDisplay();
    } else {
        cronSeconds = 900;
        trigger15MinCron();
    }
}, 1000);

function appendLog(msg) {
    const term = document.getElementById('terminal-output');
    const timestamp = new Date().toLocaleTimeString();
    term.textContent += '\n[' + timestamp + '] ' + msg;
    term.scrollTop = term.scrollHeight;
}

function trigger15MinCron() {
    appendLog('EXECUTING AUTOMATED 15-MINUTE AI EVOLUTION CRON WORKER...');

    fetch('<?php echo base_url("ai_agent/auto_update_cron"); ?>')
    .then(r => r.json())
    .then(data => {
        appendLog('EVOLUTION COMPLETE! Status: Success');
        if (data.actions) {
            data.actions.forEach(act => appendLog(' -> ' + act));
        }
        cronSeconds = 900;
        updateTimerDisplay();
        refreshHistory();
    })
    .catch(err => {
        appendLog('ERROR: Automated 15-min cron worker execution failed.');
    });
}

function sendAiCommand() {
    const prompt = document.getElementById('ai-prompt-input').value;
    if (!prompt.trim()) {
        alert('Please enter a prompt or instruction.');
        return;
    }

    appendLog('Processing AI Request: "' + prompt + '"...');

    fetch('<?php echo base_url("ai_agent/execute_command"); ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'prompt=' + encodeURIComponent(prompt)
    })
    .then(r => r.json())
    .then(data => {
        appendLog('AI ACTION DONE: ' + (data.action_taken || 'Completed'));
        appendLog(JSON.stringify(data.details, null, 2));
        refreshHistory();
    });
}

function runDiagnostics() {
    appendLog('Initiating full system self-diagnostics...');
    fetch('<?php echo base_url("ai_agent/diagnose"); ?>')
    .then(r => r.json())
    .then(data => {
        appendLog('DIAGNOSTICS COMPLETE:');
        appendLog(JSON.stringify(data, null, 2));
    });
}

function refreshHistory() {
    fetch('<?php echo base_url("ai_agent/history"); ?>')
    .then(r => r.json())
    .then(history => {
        const container = document.getElementById('patch-history-list');
        if (!history || history.length === 0) return;
        let html = '';
        history.forEach(patch => {
            html += '<div class="p-3 rounded bg-black/60 border border-slate-800/80 text-xs">';
            html += '<div class="flex justify-between text-[11px] text-slate-400 mb-1">';
            html += '<span class="font-mono text-sky-400">' + (patch.type || 'EVOLUTION') + '</span>';
            html += '<span>' + (patch.timestamp || '') + '</span></div>';
            if (patch.actions) {
                html += '<ul class="list-disc list-inside text-slate-300 font-extralight space-y-0.5 text-[11px]">';
                patch.actions.forEach(act => { html += '<li>' + act + '</li>'; });
                html += '</ul>';
            }
            html += '</div>';
        });
        container.innerHTML = html;
    });
}
</script>
