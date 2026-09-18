<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-black text-slate-200 min-h-screen">
  <!-- Content Header (Page header) -->
  <section class="content-header px-6 pt-6 pb-2 border-b border-white/[0.08]">
    <h1 class="text-2xl font-thin tracking-widest text-white uppercase flex items-center gap-3">
      <iconify-icon icon="solar:cpu-bolt-bold-duotone" class="text-sky-400" width="28" height="28"></iconify-icon>
      AI Autonomous Code Maintenance Engine
    </h1>
    <ol class="breadcrumb bg-transparent px-0 py-2 text-xs text-slate-500">
      <li><a href="<?php echo base_url('dashboard') ?>" class="text-slate-400 hover:text-white"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active text-sky-400">AI Code Patcher</li>
    </ol>
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
              Autonomous Command Terminal
            </h3>
            <span class="badge bg-sky-500/20 text-sky-300 border border-sky-500/30 text-[10px] px-2 py-1 uppercase tracking-widest">Self-Healing Active</span>
          </div>
          
          <div class="box-body pt-4">
            <p class="text-xs text-slate-400 font-extralight mb-4">
              Issue natural language instructions to inspect code, apply patches to controllers/views, check fallback mechanisms, or upgrade system features automatically.
            </p>

            <div class="space-y-4">
              <div>
                <label class="text-xs uppercase tracking-widest text-slate-400 font-light block mb-2">Prompt / Instruction for AI Agent</label>
                <div class="relative">
                  <textarea id="ai-prompt-input" rows="3" class="w-full bg-black/90 border border-slate-800 rounded-lg p-3 text-sm text-slate-200 focus:outline-none focus:border-sky-500 font-mono placeholder-slate-700" placeholder="e.g. Run diagnostics and inspect website fallbacks, or patch theme styling..."></textarea>
                </div>
              </div>

              <div class="flex gap-3">
                <button type="button" onclick="sendAiCommand()" class="bg-sky-600 hover:bg-sky-500 text-white text-xs uppercase tracking-widest px-5 py-2.5 rounded-lg font-light transition-all flex items-center gap-2 shadow-lg">
                  <iconify-icon icon="solar:play-bold" width="16" height="16"></iconify-icon>
                  Execute AI Agent Command
                </button>
                <button type="button" onclick="runDiagnostics()" class="bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs uppercase tracking-widest px-4 py-2.5 rounded-lg font-light transition-all flex items-center gap-2">
                  <iconify-icon icon="solar:restart-square-linear" width="16" height="16"></iconify-icon>
                  Run Full Self-Diagnostics
                </button>
              </div>
            </div>

            <!-- Terminal Output Log Box -->
            <div class="mt-6">
              <label class="text-xs uppercase tracking-widest text-slate-400 font-light block mb-2">Real-time Terminal Execution Log</label>
              <pre id="terminal-output" class="bg-black border border-slate-800 rounded-lg p-4 text-xs font-mono text-emerald-400 h-48 overflow-y-auto whitespace-pre-wrap">
[SYSTEM INITIALIZED] AI Code Maintenance Engine connected.
[STATUS] Ready to receive prompts, inspect system fallbacks, and patch codebase.
              </pre>
            </div>
          </div>
        </div>
      </div>

      <!-- Live Health & Fallback Metrics -->
      <div class="col-md-5">
        <div class="box bg-slate-950/80 border border-white/10 rounded-xl shadow-2xl p-5 mb-6">
          <div class="box-header with-border pb-3 border-b border-slate-800">
            <h3 class="box-title text-base font-light text-white uppercase tracking-wider flex items-center gap-2">
              <iconify-icon icon="solar:shield-check-bold" class="text-emerald-400"></iconify-icon>
              Fallback & Health Status
            </h3>
          </div>
          
          <div class="box-body pt-4 space-y-4">
            <div class="flex justify-between items-center p-3 rounded-lg bg-black/60 border border-slate-800">
              <span class="text-xs font-extralight text-slate-400">Database Tables Count</span>
              <span class="text-sm font-mono font-bold text-white"><?php echo isset($diagnostics['db_tables_count']) ? $diagnostics['db_tables_count'] : 0; ?> Tables</span>
            </div>

            <div class="flex justify-between items-center p-3 rounded-lg bg-black/60 border border-slate-800">
              <span class="text-xs font-extralight text-slate-400">Log Errors Flagged</span>
              <span class="text-sm font-mono font-bold text-emerald-400"><?php echo isset($diagnostics['log_errors_found']) ? $diagnostics['log_errors_found'] : 0; ?> Errors</span>
            </div>

            <div class="space-y-2 pt-2">
              <h4 class="text-xs uppercase tracking-widest text-slate-400 font-light">System Fallback Checks</h4>
              <?php if(isset($diagnostics['fallback_checks'])): ?>
                <?php foreach($diagnostics['fallback_checks'] as $chk): ?>
                  <div class="flex justify-between items-center p-2.5 rounded bg-black/40 border border-slate-800/80 text-xs">
                    <span class="text-slate-300 font-light"><?php echo $chk['check']; ?></span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono <?php echo $chk['status'] === 'PASS' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-amber-500/20 text-amber-300 border border-amber-500/30'; ?>">
                      <?php echo $chk['status']; ?>
                    </span>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>

<script>
function appendLog(msg) {
    const term = document.getElementById('terminal-output');
    const timestamp = new Date().toLocaleTimeString();
    term.textContent += '\n[' + timestamp + '] ' + msg;
    term.scrollTop = term.scrollHeight;
}

function sendAiCommand() {
    const prompt = document.getElementById('ai-prompt-input').value;
    if (!prompt.trim()) {
        alert('Please enter a prompt or instruction for the AI agent.');
        return;
    }

    appendLog('Sending AI Autonomous Request: "' + prompt + '"...');

    fetch('<?php echo base_url("ai_agent/execute_command"); ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'prompt=' + encodeURIComponent(prompt)
    })
    .then(r => r.json())
    .then(data => {
        appendLog('AI ACTION EXECUTED: ' + data.action_taken);
        appendLog(JSON.stringify(data.details, null, 2));
    })
    .catch(err => {
        appendLog('ERROR: Failed to communicate with AI Agent backend.');
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
</script>
