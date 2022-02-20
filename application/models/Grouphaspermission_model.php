<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Permissioncategory_model extends MY_Model {

		public function __construct() {
			parent::__construct();
			$this->table = 'category';
			$this->primary_key = 'id_category';
			$this->status_collum = 'category_status';
			$this->name_collum = 'category_name';
		}

		public function sql ($data = null)
		{
			parent::sql($data);

			$this->db->select('
				id_category,
				category_name,
				category_status,
				category_image,
				category_description
			');

			if ( isset ($data['category_name']) && $data['category_name'] != "" )
				$this->db->like('category_name',$data['category_name']);

			if ( isset ($data['category_status']) && $data['category_status'] != "" )
				$this->db->where('category_status',$data['category_status']);

			if ( isset ($data['id_category']) && $data['id_category'] != "" )
				$this->db->where('id_category',$data['id_category']);

			//echo $this->db->get_compiled_select();

			return $this->db;
		}

		public function selectCategory($data = array())
		{
			$query = $this->returnSql($data);

			$select = " <select name='categoryId' id='categoryId' class='form-control select2'> ";
			foreach ( $query as $result )
			{

				$select .= " <option value='{$result['id_category']}'>".$result['category_name'];

				if ( $result['category_status'] == 0)
					$select .= "(Inativo)";

				$select .= "</option>";
			}
			$select .= "</select>";

			return $select;

        }

	}

?>
