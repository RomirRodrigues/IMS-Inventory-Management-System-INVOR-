<?php 

class Model_ai extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_products');
		$this->load->model('model_orders');
	}

	/*
	* Get AI Demand Prediction and Reorder Recommendations for all active products
	*/
	public function getDemandForecasts()
	{
		$products = $this->model_products->getProductData();
		$forecasts = array();

		foreach ($products as $product) {
			$product_id = $product['id'];
			$current_qty = (int)$product['qty'];

			// Fetch monthly sales historical quantities for this product from orders_item
			$sql = "SELECT oi.qty, o.date_time 
					FROM `orders_item` oi 
					JOIN `orders` o ON o.id = oi.order_id 
					WHERE oi.product_id = ? AND o.paid_status = 1 
					ORDER BY o.date_time ASC";
			$query = $this->db->query($sql, array($product_id));
			$sales_records = $query->result_array();

			$monthly_demand = array_fill(1, 12, 0);
			$total_units_sold = 0;

			foreach ($sales_records as $rec) {
				if (!empty($rec['date_time'])) {
					$month = (int)date('n', (int)$rec['date_time']);
					$monthly_demand[$month] += (int)$rec['qty'];
					$total_units_sold += (int)$rec['qty'];
				}
			}

			// Simple Exponential Smoothing Calculation
			$alpha = 0.4;
			$forecast = 0;
			$demand_values = array_values($monthly_demand);

			if (count($demand_values) > 0) {
				$s = $demand_values[0];
				for ($i = 1; $i < count($demand_values); $i++) {
					$s = $alpha * $demand_values[$i] + (1 - $alpha) * $s;
				}
				$forecast = max(1, round($s));
			}

			// If no order history yet, estimate default 10 units demand
			if ($total_units_sold == 0) {
				$forecast = 10;
			}

			$safety_stock = ceil($forecast * 0.25);
			$recommended_reorder = max(0, ($forecast + $safety_stock) - $current_qty);

			// Calculate Stockout Risk %
			$risk_percentage = 0;
			if ($current_qty <= 0) {
				$risk_percentage = 100;
			} elseif ($forecast > 0) {
				$risk_percentage = min(100, round((($forecast - $current_qty) / $forecast) * 100));
				if ($risk_percentage < 0) $risk_percentage = 0;
			}

			$risk_level = 'Low';
			if ($risk_percentage >= 75) {
				$risk_level = 'Critical';
			} elseif ($risk_percentage >= 40) {
				$risk_level = 'Moderate';
			}

			$forecasts[] = array(
				'product_id' => $product['id'],
				'product_name' => $product['name'],
				'sku' => $product['sku'],
				'current_stock' => $current_qty,
				'total_units_sold' => $total_units_sold,
				'predicted_demand_30d' => $forecast,
				'recommended_reorder' => $recommended_reorder,
				'stockout_risk_pct' => $risk_percentage,
				'risk_level' => $risk_level,
				'monthly_breakdown' => $demand_values
			);
		}

		return $forecasts;
	}
}
