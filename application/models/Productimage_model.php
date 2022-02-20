<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Productimage_model extends MY_Model {

		public function __construct() {
			parent::__construct();
			$this->table = 'product_image';
			$this->primary_key = 'id_product_image';
			$this->status_collum = 'p_image_status';
			$this->name_collum = 'p_image_name';
		}

		public function sql ($data = null)
		{
			parent::sql();

			$this->db->select('
				product_image.id_product_image,
				product_image.p_image_path,
				product_image.p_image_status,
				product_image.p_image_main,
				product_image.p_image_order,
				product_image.p_image_name,
				product_image.p_image_description
			');

			if ( isset ($data['id_product_image']))
				$this->db->where('product_image.id_product_image',$data['id_product_image']);

			if ( isset ($data['product_id']))
				$this->db->where('product_image.product_id',$data['product_id']);

			if ( isset ($data['p_image_status']))
				$this->db->where('product_image.p_image_status', $data['p_image_status']);

			//echo $this->db->get_compiled_select();

			return $this->db;
		}

		public function clearProductImage($data)
		{
			$this->db->where($data);
			$this->db->delete('product_image');
		}
    }

?>
