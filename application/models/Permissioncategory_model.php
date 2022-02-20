<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Permissioncategory_model extends MY_Model {

		public function __construct() {
			parent::__construct();
			$this->table = 'permission_category';
			$this->primary_key = 'id_permission_category';
			$this->status_collum = 'p_category_status';
			$this->name_collum = 'p_category_name';
		}

		public function sql ($data = null) {
			parent::sql($data);

			$this->db->select('
				id_permission_category,
				p_category_name,
				p_category_status
			');

			if ( isset ($data['id_permission_category']) && $data['id_permission_category'] != "" )
				$this->db->like('id_permission_category',$data['id_permission_category']);

			if ( isset ($data['p_category_name']) && $data['p_category_name'] != "" )
				$this->db->where('p_category_name',$data['p_category_name']);

			if ( isset ($data['p_category_status']) && $data['p_category_status'] != "" )
				$this->db->where('p_category_status',$data['p_category_status']);

			//echo $this->db->get_compiled_select();

			return $this->db;
		}

		public function selectPermissionCategory($data = array()) {
			$query = $this->returnSql($data);

			$select = " <select name='permissionCategoryId' id='permissionCategoryId' class='form-control select2'> ";
			foreach ( $query as $result )
			{

				$select .= " <option value='{$result['id_permission_category']}'>".$result['p_category_name'];

				if ( $result['p_category_status'] == 0)
					$select .= "(Inativo)";

				$select .= "</option>";
			}
			$select .= "</select>";

			return $select;

        }

	}

?>
