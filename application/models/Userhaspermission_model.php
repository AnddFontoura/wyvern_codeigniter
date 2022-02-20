<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Userhaspermission_model extends MY_Model {

		public function __construct() {
			parent::__construct();
			$this->table = 'user_has_permission';
			$this->primary_key = 'id_u_has_p';
			$this->status_collum = 'u_has_p_status';
			//$this->name_collum = 'category_name';
		}

		public function sql ($data = null)
		{
			parent::sql($data);

			$this->db->select('
				id_u_has_p,
				id_permission_category,
				p_category_name,
				p_category_status,
				id_permission,
				permission_name,
				permission_status,
				id_user,
				user_name,
				user_status
			');

			$this->db->join('permission_category', 'permission_category.id_permission_category = permission.id_permission_category');
			$this->db->join('permission', 'permission.id_permission = user_has_permission.permission_id');
			$this->db->join('user', 'user_has_permission.user_id = user.id_user');

			if ( isset ($data['id_permission_category']) && $data['id_permission_category'] != "" )
				$this->db->where('id_permission_category',$data['id_permission_category']);

			if ( isset ($data['p_category_name']) && $data['p_category_name'] != "" )
				$this->db->where('p_category_name',$data['p_category_name']);

			if ( isset ($data['p_category_status']) && $data['p_category_status'] != "" )
				$this->db->where('p_category_status',$data['p_category_status']);

			if ( isset ($data['id_permission']) && $data['id_permission'] != "" )
				$this->db->where('id_permission',$data['id_permission']);

			if ( isset ($data['permission_name']) && $data['permission_name'] != "" )
				$this->db->where('permission_name',$data['permission_name']);

			if ( isset ($data['permission_status']) && $data['permission_status'] != "" )
				$this->db->where('permission_status',$data['permission_status']);

			if ( isset ($data['id_user']) && $data['id_user'] != "" )
				$this->db->where('id_user',$data['id_user']);

			if ( isset ($data['user_name']) && $data['user_name'] != "" )
				$this->db->v('user_name',$data['user_name']);

			if ( isset ($data['user_status']) && $data['user_status'] != "" )
				$this->db->where('user_status',$data['user_status']);

			//echo $this->db->get_compiled_select();

			return $this->db;
		}

	}

?>
