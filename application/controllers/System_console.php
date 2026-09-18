<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class System_console extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		$this->data['page_title'] = 'Future Enhancements & System Matrix';
	}

	public function index()
	{
		$this->render_template('system/enhancements', $this->data);
	}
}
