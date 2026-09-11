<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification 
{
	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('email');
		$this->CI->load->model('model_company');
	}

	/*
	* Send email notification for low stock items
	*/
	public function sendLowStockAlert($product_name, $sku, $qty, $recipient_email)
	{
		if (empty($recipient_email)) return false;

		$company = $this->CI->model_company->getCompanyData(1);
		$company_name = isset($company['company_name']) ? $company['company_name'] : 'Inventory System';

		$subject = "[Low Stock Alert] Product '$product_name' is running low!";
		$message = "<h2>Low Stock Warning</h2>";
		$message .= "<p>Store: <strong>$company_name</strong></p>";
		$message .= "<p>The following product has reached a critical stock level:</p>";
		$message .= "<ul>";
		$message .= "<li><strong>Product:</strong> $product_name</li>";
		$message .= "<li><strong>SKU:</strong> $sku</li>";
		$message .= "<li><strong>Remaining Qty:</strong> $qty</li>";
		$message .= "</ul>";
		$message .= "<p>Please restock this item as soon as possible.</p>";

		$this->CI->email->from('noreply@inventorysystem.com', $company_name);
		$this->CI->email->to($recipient_email);
		$this->CI->email->subject($subject);
		$this->CI->email->message($message);
		$this->CI->email->set_mailtype('html');

		return @$this->CI->email->send();
	}

	/*
	* Send email notification for new order created
	*/
	public function sendOrderNotification($bill_no, $customer_name, $net_amount, $recipient_email)
	{
		if (empty($recipient_email)) return false;

		$company = $this->CI->model_company->getCompanyData(1);
		$company_name = isset($company['company_name']) ? $company['company_name'] : 'Inventory System';

		$subject = "[Order Created] Bill #$bill_no";
		$message = "<h2>New Order Processed</h2>";
		$message .= "<p>Bill No: <strong>$bill_no</strong></p>";
		$message .= "<p>Customer Name: <strong>$customer_name</strong></p>";
		$message .= "<p>Net Amount: <strong>$net_amount</strong></p>";

		$this->CI->email->from('noreply@inventorysystem.com', $company_name);
		$this->CI->email->to($recipient_email);
		$this->CI->email->subject($subject);
		$this->CI->email->message($message);
		$this->CI->email->set_mailtype('html');

		return @$this->CI->email->send();
	}
}
