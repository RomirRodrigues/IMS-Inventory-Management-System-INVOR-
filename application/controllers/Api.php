<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_auth');
		$this->load->model('model_products');
		$this->load->model('model_orders');
		$this->load->model('model_stores');
		$this->load->model('model_users');
		$this->load->model('model_company');

		// Set JSON response header for API requests
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: Content-Type, Authorization');
		header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

		if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
			exit(0);
		}
	}

	/*
	* API Login: POST /api/login
	*/
	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if (empty($username) || empty($password)) {
			// Check JSON payload
			$json_data = json_decode(file_get_contents('php://input'), true);
			if ($json_data) {
				$username = isset($json_data['username']) ? $json_data['username'] : '';
				$password = isset($json_data['password']) ? $json_data['password'] : '';
			}
		}

		if (empty($username) || empty($password)) {
			echo json_encode(array('success' => false, 'message' => 'Username and password required'));
			return;
		}

		$email_exists = $this->model_auth->check_email($username);

		if ($email_exists) {
			$login = $this->model_auth->login($username, $password);
			if ($login) {
				$token = base64_encode($login['id'] . ':' . time() . ':' . md5($login['email']));
				echo json_encode(array(
					'success' => true,
					'message' => 'Login successful',
					'token' => $token,
					'user' => array(
						'id' => $login['id'],
						'username' => $login['username'],
						'email' => $login['email'],
						'firstname' => $login['firstname'],
						'lastname' => $login['lastname']
					)
				));
				return;
			}
		}

		echo json_encode(array('success' => false, 'message' => 'Invalid username or password'));
	}

	/*
	* API Products List: GET /api/products
	*/
	public function products()
	{
		$products = $this->model_products->getProductData();
		$data = array();

		foreach ($products as $p) {
			$store = $this->model_stores->getStoresData($p['store_id']);
			$data[] = array(
				'id' => $p['id'],
				'sku' => $p['sku'],
				'name' => $p['name'],
				'price' => (float)$p['price'],
				'qty' => (int)$p['qty'],
				'image' => base_url($p['image']),
				'store' => isset($store['name']) ? $store['name'] : '',
				'availability' => ($p['availability'] == 1) ? 'Active' : 'Inactive',
				'stock_status' => ((int)$p['qty'] <= 0) ? 'Out of Stock' : (((int)$p['qty'] <= 5) ? 'Low Stock' : 'In Stock')
			);
		}

		echo json_encode(array('success' => true, 'count' => count($data), 'data' => $data));
	}

	/*
	* API Product Barcode Scan Lookup: GET /api/scan?sku=XYZ
	*/
	public function scan()
	{
		$sku = $this->input->get('sku');
		if (empty($sku)) {
			echo json_encode(array('success' => false, 'message' => 'SKU parameter required'));
			return;
		}

		$sql = "SELECT * FROM `products` WHERE sku = ?";
		$query = $this->db->query($sql, array($sku));
		$product = $query->row_array();

		if ($product) {
			$store = $this->model_stores->getStoresData($product['store_id']);
			echo json_encode(array(
				'success' => true,
				'product' => array(
					'id' => $product['id'],
					'sku' => $product['sku'],
					'name' => $product['name'],
					'price' => (float)$product['price'],
					'qty' => (int)$product['qty'],
					'image' => base_url($product['image']),
					'store' => isset($store['name']) ? $store['name'] : ''
				)
			));
		} else {
			echo json_encode(array('success' => false, 'message' => 'Product not found for SKU: ' . $sku));
		}
	}

	/*
	* API Dashboard KPIs: GET /api/dashboard
	*/
	public function dashboard()
	{
		$company = $this->model_company->getCompanyData(1);

		$total_products = $this->model_products->countTotalProducts();
		$total_paid_orders = $this->model_orders->countTotalPaidOrders();
		$total_low_stock = $this->model_products->countLowStockProducts(5);
		$total_revenue = $this->model_orders->getTotalRevenue();

		echo json_encode(array(
			'success' => true,
			'data' => array(
				'total_products' => $total_products,
				'total_paid_orders' => $total_paid_orders,
				'total_low_stock' => $total_low_stock,
				'total_revenue' => $total_revenue,
				'currency' => isset($company['currency']) ? $company['currency'] : 'USD'
			)
		));
	}
}
