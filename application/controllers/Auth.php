<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_auth');
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{
		$this->logged_in();

		// Check Rate Limiting
		$attempts = $this->session->userdata('login_attempts') ? $this->session->userdata('login_attempts') : 0;
		$last_attempt = $this->session->userdata('last_attempt_time') ? $this->session->userdata('last_attempt_time') : 0;

		if ($attempts >= 5 && (time() - $last_attempt) < 300) {
			$remaining_seconds = 300 - (time() - $last_attempt);
			$this->data['errors'] = "Too many failed login attempts! Please wait $remaining_seconds seconds before trying again.";
			$this->load->view('login', $this->data);
			return;
		}

		$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
           	$email_exists = $this->model_auth->check_email($this->input->post('email'));

           	if($email_exists == TRUE) {
           		$login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));

           		if($login) {
					// Reset attempt counter
					$this->session->unset_userdata('login_attempts');
					$this->session->unset_userdata('last_attempt_time');

           			$logged_in_sess = array(
           				'id' => $login['id'],
				        'username'  => $login['username'],
				        'email'     => $login['email'],
				        'logged_in' => TRUE
					);

					$this->session->set_userdata($logged_in_sess);
           			redirect('dashboard', 'refresh');
           		}
           		else {
					$attempts++;
					$this->session->set_userdata('login_attempts', $attempts);
					$this->session->set_userdata('last_attempt_time', time());
           			$this->data['errors'] = 'Incorrect username/password combination (Attempt '.$attempts.' of 5)';
           			$this->load->view('login', $this->data);
           		}
           	}
           	else {
				$attempts++;
				$this->session->set_userdata('login_attempts', $attempts);
				$this->session->set_userdata('last_attempt_time', time());
           		$this->data['errors'] = 'Email does not exist';

           		$this->load->view('login', $this->data);
           	}	
        }
        else {
            // false case
            $this->load->view('login');
        }	
	}

	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login', 'refresh');
	}

}
