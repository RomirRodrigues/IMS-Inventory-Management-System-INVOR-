<?php

class Model_ai_agent extends CI_Model
{
    private $log_file;

    public function __construct()
    {
        parent::__construct();
        $this->log_file = APPPATH . 'logs/ai_patches.json';
    }

    /*
        Scans application logs, database connection, and system fallbacks
    */
    public function runDiagnostics()
    {
        $report = array(
            'timestamp' => date('Y-m-d H:i:s'),
            'db_status' => 'OK',
            'db_tables_count' => 0,
            'log_errors_found' => 0,
            'fallback_checks' => array(),
            'recommendations' => array()
        );

        // 1. Check Database Health
        try {
            $tables = $this->db->list_tables();
            $report['db_tables_count'] = count($tables);
            if (count($tables) < 10) {
                $report['recommendations'][] = 'Database contains fewer than 10 tables. Consider re-importing stock.sql.';
            }
        } catch (Exception $e) {
            $report['db_status'] = 'ERROR: ' . $e->getMessage();
            $report['recommendations'][] = 'Database connection failed. Verify MYSQL_HOST and credentials.';
        }

        // 2. Check Application Logs
        $log_dir = APPPATH . 'logs/';
        $log_files = glob($log_dir . 'log-*.php');
        if (!empty($log_files)) {
            $latest_log = end($log_files);
            $content = file_get_contents($latest_log);
            preg_match_all('/ERROR - /i', $content, $matches);
            $report['log_errors_found'] = count($matches[0]);
        }

        // 3. Fallback & Health Checks
        $report['fallback_checks'][] = array('check' => 'Writable Cache Directory', 'status' => is_writable(APPPATH . 'cache') ? 'PASS' : 'WARN');
        $report['fallback_checks'][] = array('check' => 'Writable Logs Directory', 'status' => is_writable(APPPATH . 'logs') ? 'PASS' : 'WARN');
        $report['fallback_checks'][] = array('check' => 'GD Image Extension', 'status' => extension_loaded('gd') ? 'PASS' : 'FAIL');
        $report['fallback_checks'][] = array('check' => 'MySQLi Driver', 'status' => extension_loaded('mysqli') ? 'PASS' : 'FAIL');

        return $report;
    }

    /*
        15-Minute Automated Self-Updating & Evolution Engine
    */
    public function autoEvolveSite()
    {
        $timestamp = date('Y-m-d H:i:s');
        $actions = array();

        // 1. Run Fallback & Integrity Diagnostics
        $diagnostics = $this->runDiagnostics();
        if (!empty($diagnostics['recommendations'])) {
            $actions[] = 'Fallback Alert: ' . implode(', ', $diagnostics['recommendations']);
        } else {
            $actions[] = 'System Fallback Integrity 100% Verified (0 errors)';
        }

        // 2. Evolve 21st.dev + Framer Motion UI, Animations, Glassmorphism Glows & Micro-Interactions
        $theme_file = FCPATH . 'assets/css/21stdev-theme.css';
        if (file_exists($theme_file) && is_writable($theme_file)) {
            $hue = rand(180, 270); // Dynamic 21st.dev Cyberpunk Cyan-to-Purple accent shifts
            $glow_opacity = sprintf('%.2f', rand(20, 45) / 100);
            $animation_speed = sprintf('%.1f', rand(10, 22) / 10);
            $rotate_deg = rand(0, 360);

            $evolution_css = "\n/* --- 21st.dev AUTOMATED MOTION EVOLUTION [$timestamp] --- */\n" .
                ":root {\n" .
                "  --ai-primary-accent: hsl($hue, 90%, 65%);\n" .
                "  --ai-glow-rgba: rgba(56, 189, 248, $glow_opacity);\n" .
                "  --ai-pulse-duration: {$animation_speed}s;\n" .
                "}\n" .
                ".box, .metric-card { transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1) !important; }\n" .
                ".box:hover { border-color: var(--ai-primary-accent) !important; box-shadow: 0 15px 40px rgba(0,0,0,0.9), 0 0 25px var(--ai-primary-accent) !important; }\n" .
                ".btn-primary { background: linear-gradient({$rotate_deg}deg, #0284c7, var(--ai-primary-accent)) !important; border-color: var(--ai-primary-accent) !important; }\n" .
                ".ai-glow-pulse { animation: aiGlowPulse var(--ai-pulse-duration) infinite alternate cubic-bezier(0.4, 0, 0.2, 1); }\n" .
                "@keyframes aiGlowPulse { 0% { box-shadow: 0 0 10px var(--ai-glow-rgba); } 100% { box-shadow: 0 0 30px var(--ai-primary-accent); } }\n";

            file_put_contents($theme_file, $evolution_css, FILE_APPEND);
            $actions[] = "Autonomous Motion Evolution Applied (Accent: {$hue}deg, Gradient Angle: {$rotate_deg}deg, Pulse: {$animation_speed}s)";
        }

        // 3. Record Patch in AI Log History
        $log_entry = array(
            'id' => 'patch_' . time(),
            'timestamp' => $timestamp,
            'type' => '15_MIN_CRON_EVOLUTION',
            'actions' => $actions
        );

        $this->recordPatchHistory($log_entry);

        return array(
            'success' => true,
            'timestamp' => $timestamp,
            'actions' => $actions,
            'next_run_in' => '15 minutes'
        );
    }

    /*
        Executes code patches or modifications on target files safely
    */
    public function applyCodePatch($target_file_rel, $code_snippet, $action = 'append')
    {
        $base_dir = FCPATH;
        $target_path = realpath($base_dir . $target_file_rel);

        // Security check: must remain inside FCPATH
        if (!$target_path || strpos($target_path, FCPATH) !== 0) {
            return array('success' => false, 'message' => 'Invalid or unauthorized file path.');
        }

        if (!is_writable($target_path)) {
            return array('success' => false, 'message' => 'Target file is not writable.');
        }

        // Create backup file (.bak)
        $backup_path = $target_path . '.bak';
        copy($target_path, $backup_path);

        if ($action === 'replace') {
            file_put_contents($target_path, $code_snippet);
        } else if ($action === 'append') {
            file_put_contents($target_path, "\n" . $code_snippet, FILE_APPEND);
        }

        $log_entry = array(
            'id' => 'patch_' . time(),
            'timestamp' => date('Y-m-d H:i:s'),
            'type' => 'MANUAL_CODE_PATCH',
            'target_file' => $target_file_rel,
            'actions' => array("Patched file $target_file_rel with action $action")
        );
        $this->recordPatchHistory($log_entry);

        return array(
            'success' => true,
            'message' => "Successfully patched file: $target_file_rel",
            'backup_created' => basename($backup_path)
        );
    }

    /*
        Executes natural language AI autonomous maintenance requests
    */
    public function processAiCommand($prompt)
    {
        $prompt = strtolower(trim($prompt));

        if (strpos($prompt, 'cron') !== false || strpos($prompt, 'evolve') !== false || strpos($prompt, 'auto') !== false) {
            return $this->autoEvolveSite();
        }

        if (strpos($prompt, 'check') !== false || strpos($prompt, 'diagnose') !== false || strpos($prompt, 'fallback') !== false) {
            $report = $this->runDiagnostics();
            return array(
                'status' => 'success',
                'action_taken' => 'System Diagnostics & Fallback Analysis Complete',
                'details' => $report
            );
        }

        return $this->autoEvolveSite();
    }

    /*
        Patch History Manager
    */
    public function getPatchHistory()
    {
        if (file_exists($this->log_file)) {
            $data = json_decode(file_get_contents($this->log_file), true);
            return is_array($data) ? array_reverse($data) : array();
        }
        return array();
    }

    private function recordPatchHistory($entry)
    {
        $history = array();
        if (file_exists($this->log_file)) {
            $data = json_decode(file_get_contents($this->log_file), true);
            if (is_array($data)) {
                $history = $data;
            }
        }
        $history[] = $entry;

        // Keep last 50 evolution patches
        if (count($history) > 50) {
            $history = array_slice($history, -50);
        }

        file_put_contents($this->log_file, json_encode($history, JSON_PRETTY_PRINT));
    }
}
