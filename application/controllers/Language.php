<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller 
{
	public function switchLang($language = "") 
	{
		$language = ($language != "") ? $language : "english";
		$allowed_languages = array('english', 'spanish', 'french', 'hindi');

		if (in_array($language, $allowed_languages)) {
			$this->session->set_userdata('site_lang', $language);
		}

		$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('dashboard');
		redirect($referer);
	}
}
