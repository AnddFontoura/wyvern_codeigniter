<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Subcategory_model extends MY_Model {

		public function __construct() {
      parent::__construct();
      $this->table = 'subcategory';
			$this->primary_key = 'id_subcategory';
			$this->status_collum = 'subcategory_status';
			$this->name_collum = 'subcategory_name';
		}

		public function sql ($data = null) {
			parent::sql($data);

			$this->db->select('
				subcategory.id_subcategory,
				subcategory.subcategory_name,
				subcategory.subcategory_status,
				subcategory.subcategory_image,
				subcategory.subcategory_description,
				category.id_category,
				category.category_name,
				category.category_status,
				category.category_image,
				category.category_description
			');

			$this->db->join('category', 'category.id_category = subcategory.category_id');

			if ( isset ($data['subcategory_status']) && $data['subcategory_status'] != "" )
				$this->db->where('subcategory.subcategory_status',$data['subcategory_status']);

			if ( isset ($data['category_status']) && $data['category_status'] != "" )
				$this->db->where('category.category_status',$data['category_status']);

			if ( isset ($data['category_id']) && $data['category_id'] != "" )
				$this->db->where('subcategory.category_id',$data['category_id']);

			if ( isset ($data['id_category']) && $data['id_category'] != "" )
				$this->db->where('subcategory.id_category',$data['id_subcategory']);

			if ( isset ($data['category_name']) && $data['category_name'] != "" )
				$this->db->like('category.category_name',$data['category_name']);

			if ( isset ($data['subcategory_name']) && $data['subcategory_name'] != "" )
				$this->db->like('subcategory.subcategory_name',$data['subcategory_name']);

			//echo $this->db->get_compiled_select();

			return $this->db;
		}

		public function selectSubCategory($data = array(),$id_subcategoria = null)
		{
			$query = $this->returnSql($data);
			$categoria = "";

			$select = " <select name='subCategoryId' id='subCategoryId' class='form-control select2'> ";
			foreach ( $query as $result ) {
				if ( $result['category_name'] != $categoria ) {
					$categoria = $result['category_name'];
					$select .= " </optgroup> <optgroup label='$categoria'> ";
				}

				if ( $id_subcategoria == $result['id_subcategory']) {
					$option = " selected ";
				} else {
					$option = " ";
				}

				$select .= " <option value='{$result['id_subcategory']}' $option> {$result['subcategory_name']} </option>";

				if ( $result['subcategory_status'] == 0)
					$select .= "(Inativo)";

				$select .= "</option>";
			}
			$select .= "</select>";

			return $select;

		}

	}

?>
