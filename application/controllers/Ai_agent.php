<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ai_agent extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_ai_agent');
        $this->data['page_title'] = 'AI Autonomous Code Maintenance Engine';
    }

    public function index()
    {
        $this->not_logged_in();
        $this->data['diagnostics'] = $this->model_ai_agent->runDiagnostics();
        $this->data['patch_history'] = $this->model_ai_agent->getPatchHistory();
        $this->render_template('system/ai_agent', $this->data);
    }

    /*
        15-Minute Automated Self-Updating Cron Endpoint
        Can be pinged via Render Cron, Linux crontab, or JS Heartbeat
    */
    public function auto_update_cron()
    {
        header('Content-Type: application/json');
        $res = $this->model_ai_agent->autoEvolveSite();
        echo json_encode($res);
    }

    public function diagnose()
    {
        $this->not_logged_in();
        header('Content-Type: application/json');
        echo json_encode($this->model_ai_agent->runDiagnostics());
    }

    public function history()
    {
        $this->not_logged_in();
        header('Content-Type: application/json');
        echo json_encode($this->model_ai_agent->getPatchHistory());
    }

    public function execute_command()
    {
        $this->not_logged_in();
        header('Content-Type: application/json');
        $prompt = $this->input->post('prompt');
        if (empty($prompt)) {
            $json = json_decode(file_get_contents('php://input'), true);
            $prompt = isset($json['prompt']) ? $json['prompt'] : '';
        }

        if (empty($prompt)) {
            echo json_encode(array('status' => 'error', 'message' => 'Empty prompt provided.'));
            return;
        }

        $result = $this->model_ai_agent->processAiCommand($prompt);
        echo json_encode($result);
    }

    public function apply_patch()
    {
        $this->not_logged_in();
        header('Content-Type: application/json');
        $target_file = $this->input->post('target_file');
        $code_snippet = $this->input->post('code_snippet');
        $action = $this->input->post('action') ? $this->input->post('action') : 'append';

        if (empty($target_file) || empty($code_snippet)) {
            echo json_encode(array('success' => false, 'message' => 'Target file and code snippet are required.'));
            return;
        }

        $res = $this->model_ai_agent->applyCodePatch($target_file, $code_snippet, $action);
        echo json_encode($res);
    }
}
