<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Product_model extends MY_Model {

	  public function __construct()
	  {
      parent::__construct();
      $this->table = 'product';
			$this->primary_key = 'id_product';
			$this->status_collum = 'product_status';
			$this->name_collum = 'product_name';
		}

		public function sql ($data = null)
		{
			parent::sql($data);

			$this->db->select('
				product.id_product,
				product.product_name,
				product.product_status,
				product.product_description,
				product.product_nickname,
				product.product_promotion_price,
				product.product_price,
				product.product_keyword,
				product.subcategory_id,
				product.product_storage,
				product.product_width,
				product.product_height,
				product.product_depth,
				product.product_weight,
				product.product_featured,
				subcategory.subcategory_name,
				category.category_name
			');

			$this->db->join('subcategory','product.subcategory_id = subcategory.id_subcategory');
			$this->db->join('category','category.id_category = subcategory.category_id');

			if ( isset ($data['product_status']) )
				$this->db->where('product.product_status',$data['product_status']);

			if ( isset ($data['category_status']) )
				$this->db->where('category.category_status',$data['c_ativo']);

			if ( isset ($data['subcategory_status']) )
				$this->db->where('subcategory.subcategory_status',$data['s_ativo']);

			if ( isset ($data['id_product']) )
				$this->db->where('product.id_product',$data['id_product']);

			if ( isset ($data['id_subcategory']) )
				$this->db->where('subcategory.id_subcategory',$data['id_subcategory']);

			if ( isset ($data['product_featured']) )
				$this->db->where('product.product_featured',$data['product_featured']);

			if ( isset ($data['id_category']) )
				$this->db->where('category.id_ccategory',$data['id_category']);

			//var_dump($this->db);

			return $this->db;
		}

	}

?>
