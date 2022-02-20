<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Permission_model extends MY_Model {

		public function __construct() {
			parent::__construct();
			$this->table = 'permission';
			$this->primary_key = 'id_permission';
			$this->status_collum = 'permission_status';
			$this->name_collum = 'permission_name';
		}

		public function sql ($data = null) {
			parent::sql($data);

			$this->db->select('
				id_permission_category,
				p_category_name,
				p_category_status,
				id_permission,
				permission_name,
				permission_status
			');

			$this->db->join('permission_category', 'permission_category.id_permission_category = permission.permission_category_id');

			if ( isset ($data['id_permission_category']) && $data['id_permission_category'] != "" )
				$this->db->where('id_permission_category',$data['id_permission_category']);

			if ( isset ($data['id_permission']) && $data['id_permission'] != "" )
				$this->db->where('id_permission',$data['id_permission']);

			if ( isset ($data['p_category_name']) && $data['p_category_name'] != "" )
				$this->db->where('p_category_name',$data['p_category_name']);

			if ( isset ($data['permission_name']) && $data['permission_name'] != "" )
				$this->db->where('permission_name',$data['permission_name']);

			if ( isset ($data['p_category_status']) && $data['p_category_status'] != "" )
				$this->db->where('p_category_status',$data['p_category_status']);

			if ( isset ($data['permission_status']) && $data['permission_status'] != "" )
				$this->db->where('permission_status',$data['permission_status']);

			//echo $this->db->get_compiled_select();

			return $this->db;
		}

		public function selectPermission($data = array()) {
			$query = $this->returnSql($data);

			$select = " <select name='permissionId' id='permissionId' class='form-control select2'> ";
			foreach ( $query as $result ) {
				if ( $result['p_category_name'] != $categoria ) {
					$categoria = $result['p_category_name'];
					$select .= " </optgroup> <optgroup label='$categoria'> ";
				}

				if ( $id_subcategoria == $result['id_permission']) {
					$option = " selected ";
				} else {
					$option = " ";
				}

				$select .= " <option value='{$result['id_permission']}' $option>".$result['permission_name'];

				if ( $result['permission_status'] == 0)
					$select .= "(Inativo)";

				$select .= "</option>";
			}
			$select .= "</select>";

			return $select;

        }

	}

?>
