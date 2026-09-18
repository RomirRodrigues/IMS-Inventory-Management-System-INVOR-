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
           	$email_exists = $this->model_auth->check_email($this->input->post('email'));

           	if($email_exists == TRUE) {
           		$login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));

           		if($login) {
					// Reset attempt counter
					$this->session->unset_userdata('login_attempts');
					$this->session->unset_userdata('last_attempt_time');

					// Generate 2FA 6-digit PIN
					$two_factor_code = (string)rand(100000, 999999);
					$this->session->set_userdata(array(
						'pending_user' => $login,
						'two_factor_code' => $two_factor_code,
						'two_factor_expires' => time() + 300
					));

           			redirect('auth/verify_2fa', 'refresh');
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
            $this->load->view('login');
        }	
	}

	/*
	* 2FA 6-Digit PIN Verification Method
	*/
	public function verify_2fa()
	{
		$pending_user = $this->session->userdata('pending_user');
		$expected_code = $this->session->userdata('two_factor_code');
		$expires = $this->session->userdata('two_factor_expires');

		if (empty($pending_user) || empty($expected_code)) {
			redirect('auth/login', 'refresh');
			return;
		}

		if (time() > $expires) {
			$this->session->unset_userdata(array('pending_user', 'two_factor_code', 'two_factor_expires'));
			$this->data['errors'] = '2FA Security PIN expired. Please log in again.';
			$this->load->view('login', $this->data);
			return;
		}

		if ($this->input->post('pin')) {
			$entered_pin = trim($this->input->post('pin'));
			if ($entered_pin === (string)$expected_code) {
				// Authenticate session
				$logged_in_sess = array(
					'id' => $pending_user['id'],
					'username'  => $pending_user['username'],
					'email'     => $pending_user['email'],
					'logged_in' => TRUE
				);
				$this->session->set_userdata($logged_in_sess);
				$this->session->unset_userdata(array('pending_user', 'two_factor_code', 'two_factor_expires'));
				redirect('dashboard', 'refresh');
				return;
			} else {
				$this->data['errors'] = 'Invalid 2FA Security PIN code!';
			}
		}

		$this->data['two_factor_code'] = $expected_code;
		$this->load->view('auth/verify_2fa', $this->data);
	}

	/*
	* Google OAuth SSO Login Endpoint
	*/
	public function googleLogin()
	{
		$google_email = $this->input->post('email');
		$google_name = $this->input->post('name');

		if (empty($google_email)) {
			$json_data = json_decode(file_get_contents('php://input'), true);
			if ($json_data) {
				$google_email = isset($json_data['email']) ? $json_data['email'] : '';
				$google_name = isset($json_data['name']) ? $json_data['name'] : 'Google User';
			}
		}

		if (empty($google_email)) {
			echo json_encode(array('success' => false, 'message' => 'Google email payload required'));
			return;
		}

		$user = $this->model_auth->getUserByEmail($google_email);

		if (!$user) {
			// Auto-register Google account
			$user = $this->model_auth->createGoogleUser($google_email, $google_name);
		}

		if ($user) {
			// Generate 2FA 6-digit PIN
			$two_factor_code = (string)rand(100000, 999999);
			$this->session->set_userdata(array(
				'pending_user' => $user,
				'two_factor_code' => $two_factor_code,
				'two_factor_expires' => time() + 300
			));

			echo json_encode(array(
				'success' => true,
				'redirect' => base_url('auth/verify_2fa')
			));
		} else {
			echo json_encode(array('success' => false, 'message' => 'Google authentication failed'));
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
