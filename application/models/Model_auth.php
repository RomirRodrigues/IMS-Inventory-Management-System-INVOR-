<?php 

class Model_auth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		Checks if user exists by email OR username (case-insensitive & trimmed)
	*/
	public function check_email($email) 
	{
		if($email) {
			$clean = trim(strtolower($email));
			$sql = 'SELECT * FROM `users` WHERE LOWER(TRIM(email)) = ? OR LOWER(TRIM(username)) = ?';
			$query = $this->db->query($sql, array($clean, $clean));
			return ($query->num_rows() >= 1) ? true : false;
		}

		return false;
	}

	public function check_username($username)
	{
		if($username) {
			$clean = trim(strtolower($username));
			$sql = 'SELECT * FROM `users` WHERE LOWER(TRIM(username)) = ? OR LOWER(TRIM(email)) = ?';
			$query = $this->db->query($sql, array($clean, $clean));
			return ($query->num_rows() >= 1) ? true : false;
		}
		return false;
	}

	/* 
		This function checks if the email/username and password matches with the database
	*/
	public function login($email, $password) {
		if($email && $password) {
			$clean = trim(strtolower($email));
			$sql = "SELECT * FROM `users` WHERE LOWER(TRIM(email)) = ? OR LOWER(TRIM(username)) = ?";
			$query = $this->db->query($sql, array($clean, $clean));

			if($query->num_rows() >= 1) {
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
			$clean = trim(strtolower($email));
			$sql = "SELECT * FROM `users` WHERE LOWER(TRIM(email)) = ? OR LOWER(TRIM(username)) = ?";
			$query = $this->db->query($sql, array($clean, $clean));
			return $query->row_array();
		}
		return false;
	}

	public function createGoogleUser($email, $name = 'Google User')
	{
		$clean_email = trim(strtolower($email));
		$username = strtolower(explode('@', $clean_email)[0]);
		// Ensure unique username
		if ($this->check_username($username)) {
			$username .= rand(100, 999);
		}

		$random_password = password_hash(bin2hex(random_bytes(8)), PASSWORD_DEFAULT);

		$data = array(
			'username' => $username,
			'password' => $random_password,
			'email' => $clean_email,
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

		return $this->getUserByEmail($clean_email);
	}

	public function registerUser($firstname, $lastname, $email, $username, $password, $phone = '0000000000')
	{
		$clean_email = trim(strtolower($email));
		$clean_username = trim($username);
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$data = array(
			'username' => $clean_username,
			'password' => $hashed_password,
			'email' => $clean_email,
			'firstname' => trim($firstname),
			'lastname' => trim($lastname),
			'phone' => $phone,
			'gender' => 1
		);

		$this->db->insert('users', $data);
		$user_id = $this->db->insert_id();

		// Assign Admin Group Permission (group_id = 1)
		$group_data = array('user_id' => $user_id, 'group_id' => 1);
		$this->db->insert('user_group', $group_data);

		return $this->getUserByEmail($clean_email);
	}
}