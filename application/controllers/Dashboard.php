<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dashboard';
		
		$this->load->model('model_products');
		$this->load->model('model_orders');
		$this->load->model('model_users');
		$this->load->model('model_stores');
	}

	/* 
	* It only redirects to the manage category page
	* It passes the total product, total paid orders, total users, and total stores information
	into the frontend.
	*/
	public function index()
	{
		$this->data['total_products'] = $this->model_products->countTotalProducts();
		$this->data['total_paid_orders'] = $this->model_orders->countTotalPaidOrders();
		$this->data['total_users'] = $this->model_users->countTotalUsers();
		$this->data['total_stores'] = $this->model_stores->countTotalStores();

		$this->data['total_low_stock'] = $this->model_products->countLowStockProducts(5);
		$this->data['total_out_of_stock'] = $this->model_products->countOutOfStockProducts();
		$this->data['total_revenue'] = $this->model_orders->getTotalRevenue();
		$this->data['currency'] = $this->company_currency();

		$this->data['recent_orders'] = $this->model_orders->getRecentOrders(5);
		$this->data['low_stock_items'] = $this->model_products->getLowStockProducts(5);

		$year = date('Y');
		$this->data['selected_year'] = $year;
		$this->data['monthly_sales'] = json_encode($this->model_orders->getMonthlySalesData($year));

		$user_id = $this->session->userdata('id');
		$is_admin = ($user_id == 1) ? true : false;

		$this->data['is_admin'] = $is_admin;
		$this->render_template('dashboard', $this->data);
	}
}