<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forecast extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'AI Demand Prediction & Stock Forecasting';
		$this->load->model('model_ai');
		$this->load->model('model_products');
	}

	public function index()
	{
		$this->data['forecasts'] = $this->model_ai->getDemandForecasts();
		$this->render_template('forecast/index', $this->data);
	}
}
