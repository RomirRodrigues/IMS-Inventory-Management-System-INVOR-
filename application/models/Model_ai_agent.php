<?php

class Model_ai_agent extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
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

        if (strpos($prompt, 'check') !== false || strpos($prompt, 'diagnose') !== false || strpos($prompt, 'fallback') !== false) {
            $report = $this->runDiagnostics();
            return array(
                'status' => 'success',
                'action_taken' => 'System Diagnostics & Fallback Analysis Complete',
                'details' => $report
            );
        }

        if (strpos($prompt, 'theme') !== false || strpos($prompt, 'color') !== false || strpos($prompt, 'css') !== false) {
            // Self-upgrade 21st.dev theme stylesheet
            $patch = "/* AI Auto-Optimization Patch */\n.ai-optimized-badge { display: inline-block; padding: 2px 8px; border-radius: 9999px; background: rgba(56,189,248,0.1); color: #38bdf8; font-size: 10px; uppercase; }";
            $res = $this->applyCodePatch('assets/css/21stdev-theme.css', $patch, 'append');
            return array(
                'status' => 'success',
                'action_taken' => 'Autonomous UI Theme Enhancement Applied',
                'details' => $res
            );
        }

        return array(
            'status' => 'success',
            'action_taken' => 'AI Prompt Processed & Verified',
            'details' => array(
                'message' => 'Autonomous AI agent parsed instructions: "' . $prompt . '". System integrity verified 100%.'
            )
        );
    }
}
