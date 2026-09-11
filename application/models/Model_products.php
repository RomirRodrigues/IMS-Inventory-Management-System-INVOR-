<?php 

class Model_products extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getProductData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM `products` where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM `products` ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveProductData()
	{
		$sql = "SELECT * FROM `products` WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('products', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('products', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('products');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalProducts()
	{
		$sql = "SELECT * FROM `products`";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function countLowStockProducts($threshold = 5)
	{
		$sql = "SELECT * FROM `products` WHERE CAST(qty AS SIGNED) <= ? AND CAST(qty AS SIGNED) > 0 AND availability = 1";
		$query = $this->db->query($sql, array((int)$threshold));
		return $query->num_rows();
	}

	public function countOutOfStockProducts()
	{
		$sql = "SELECT * FROM `products` WHERE CAST(qty AS SIGNED) <= 0 AND availability = 1";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getLowStockProducts($threshold = 5)
	{
		$sql = "SELECT * FROM `products` WHERE CAST(qty AS SIGNED) <= ? AND availability = 1 ORDER BY CAST(qty AS SIGNED) ASC";
		$query = $this->db->query($sql, array((int)$threshold));
		return $query->result_array();
	}

}