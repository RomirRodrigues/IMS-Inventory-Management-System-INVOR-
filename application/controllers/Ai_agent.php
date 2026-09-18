<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ai_agent extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->load->model('model_ai_agent');
        $this->data['page_title'] = 'AI Autonomous Code Maintenance Engine';
    }

    public function index()
    {
        $this->data['diagnostics'] = $this->model_ai_agent->runDiagnostics();
        $this->render_template('system/ai_agent', $this->data);
    }

    public function diagnose()
    {
        header('Content-Type: application/json');
        echo json_encode($this->model_ai_agent->runDiagnostics());
    }

    public function execute_command()
    {
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
