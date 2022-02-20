<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Permissiongroup_model extends MY_Model {

		public function __construct() {
			parent::__construct();
			$this->table = 'permission_group';
			$this->primary_key = 'id_permission_group';
			$this->status_collum = 'p_group_status';
			$this->name_collum = 'p_group_name';
		}

		public function sql ($data = null) {
			parent::sql($data);

			$this->db->select('
				id_permission_group,
				p_group_name,
				p_group_status
			');

			if ( isset ($data['p_group_name']) && $data['p_group_name'] != "" )
				$this->db->where('p_group_name',$data['p_group_name']);

			if ( isset ($data['p_group_status']) && $data['p_group_status'] != "" )
				$this->db->where('p_group_status',$data['p_group_status']);

			if ( isset ($data['id_permission_group']) && $data['id_permission_group'] != "" )
				$this->db->where('id_permission_group',$data['id_permission_group']);

			//echo $this->db->get_compiled_select();

			return $this->db;
		}

		public function selectpermission($data = array()) {
			$query = $this->returnSql($data);

			$select = " <select name='permissionGroupId' id='permissionGroupId' class='form-control select2'> ";
			foreach ( $query as $result ) {

				if ( $id_subcategoria == $result['id_permission_group']) {
					$option = " selected ";
				} else {
					$option = " ";
				}

				$select .= " <option value='{$result['id_permission_group']}' $option>".$result['p_group_name'];

				if ( $result['p_group_status'] == 0)
					$select .= "(Inativo)";

				$select .= "</option>";
			}
			$select .= "</select>";

			return $select;

        }

	}

?>
