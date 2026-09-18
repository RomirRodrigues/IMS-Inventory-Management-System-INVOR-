<?php 

class Model_auth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		This function checks if the email exists in the database
	*/
	public function check_email($email) 
	{
		if($email) {
			$sql = 'SELECT * FROM `users` WHERE email = ?';
			$query = $this->db->query($sql, array($email));
			$result = $query->num_rows();
			return ($result == 1) ? true : false;
		}

		return false;
	}

	/* 
		This function checks if the email and password matches with the database
	*/
	public function login($email, $password) {
		if($email && $password) {
			$sql = "SELECT * FROM `users` WHERE email = ?";
			$query = $this->db->query($sql, array($email));

			if($query->num_rows() == 1) {
				$result = $query->row_array();

				$hash_password = password_verify($password, $result['password']);
				if($hash_password === true) {
					return $result;	
				}
				else {
					return false;
				}

				
			}
			else {
				return false;
			}
		}
	}

	public function getUserByEmail($email)
	{
		if($email) {
			$sql = "SELECT * FROM `users` WHERE email = ?";
			$query = $this->db->query($sql, array($email));
			return $query->row_array();
		}
		return false;
	}

	public function createGoogleUser($email, $name = 'Google User')
	{
		$username = strtolower(explode('@', $email)[0]);
		$random_password = password_hash(bin2hex(random_bytes(8)), PASSWORD_DEFAULT);

		$data = array(
			'username' => $username,
			'password' => $random_password,
			'email' => $email,
			'firstname' => $name,
			'lastname' => '(Google SSO)',
			'phone' => '0000000000',
			'gender' => 1
		);

		$this->db->insert('users', $data);
		$user_id = $this->db->insert_id();

		// Assign Admin Group Permission by default (group_id = 1)
		$group_data = array('user_id' => $user_id, 'group_id' => 1);
		$this->db->insert('user_group', $group_data);

		return $this->getUserByEmail($email);
	}
}