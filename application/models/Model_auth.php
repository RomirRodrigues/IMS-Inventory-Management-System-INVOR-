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
			return ($result >= 1) ? true : false;
		}

		return false;
	}

	public function check_username($username)
	{
		if($username) {
			$sql = 'SELECT * FROM `users` WHERE username = ?';
			$query = $this->db->query($sql, array($username));
			return ($query->num_rows() >= 1) ? true : false;
		}
		return false;
	}

	/* 
		This function checks if the email and password matches with the database
	*/
	public function login($email, $password) {
		if($email && $password) {
			$sql = "SELECT * FROM `users` WHERE email = ? OR username = ?";
			$query = $this->db->query($sql, array($email, $email));

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
			$sql = "SELECT * FROM `users` WHERE email = ?";
			$query = $this->db->query($sql, array($email));
			return $query->row_array();
		}
		return false;
	}

	public function createGoogleUser($email, $name = 'Google User')
	{
		$username = strtolower(explode('@', $email)[0]);
		// Ensure unique username
		if ($this->check_username($username)) {
			$username .= rand(100, 999);
		}

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

	public function registerUser($firstname, $lastname, $email, $username, $password, $phone = '0000000000')
	{
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$data = array(
			'username' => $username,
			'password' => $hashed_password,
			'email' => $email,
			'firstname' => $firstname,
			'lastname' => $lastname,
			'phone' => $phone,
			'gender' => 1
		);

		$this->db->insert('users', $data);
		$user_id = $this->db->insert_id();

		// Assign Admin Group Permission (group_id = 1)
		$group_data = array('user_id' => $user_id, 'group_id' => 1);
		$this->db->insert('user_group', $group_data);

		return $this->getUserByEmail($email);
	}
}