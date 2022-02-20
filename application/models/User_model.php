<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class User_model extends MY_Model {

		public function __construct() {
      parent::__construct();
      $this->table = 'user';
			$this->primary_key = 'id_user';
			$this->status_collum = 'user_status';
			$this->name_collum = 'user_name';
		}

		public function sql ($data = null)
		{
			$this->db->select('id_user, user_name, user_status, user_type_id');
			$this->db->from('user');

			if ( isset($data['user_name']) && isset($data['user_password']) && $data['user_name'] != "" && $data['user_password'] != "" )
			{
				$this->db->where('user_name',$data['user_name']);
				$this->db->where('user_password',$data['user_password']);
			} else {

				if ( isset ($data['user_status']) )
					$this->db->where('user_status',$data['user_status']);

				if ( isset ($data['id_user']) )
					$this->db->where('id_user',$data['id_user']);

				if ( isset ($data['user_name']) )
					$this->db->where('user_name',$data['user_name']);

				if ( isset ($data['user_last_session']) )
					$this->db->where('user_last_session',$data['user_last_session']);

			}
			//echo $this->db->get_compiled_select();

			return $this->db;
		}


	}

?>
