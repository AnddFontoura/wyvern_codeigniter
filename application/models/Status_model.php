<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Status_model extends MY_Model {

        public function __construct()
        {
            parent::__construct();
            $this->table = 'status';
			$this->primary_key = 'id_status';
			$this->status_collum = 'status_available';
			$this->name_collum = 'status_name';
        }

		public function sql ($data = null)
		{
			parent::sql();

            $this->db->select('
                id_status,
                status_name, 
                status_service_order, 
                status_order, 
                status_available
            ');

			if ( isset ($data['id_status']) && $data['id_status'] != "" )
                $this->db->where('id_status',$data['id_status']);     
			
            if ( isset ($data['status_name']) && $data['status_name'] != "" )
                $this->db->like('status_name',$data['status_name']);
                
			if ( isset ($data['status_service_order']) && $data['status_service_order'] != "" )
                $this->db->where('status_service_order',$data['status_service_order']);
            
			if ( isset ($data['status_order']) && $data['status_order'] != "" )
                $this->db->where('status_order',$data['status_order']);
			
			if ( isset ($data['status_available']) && $data['status_available'] != "" )
				$this->db->where('status_available',$data['status_available']);
			
            if ( isset($data['limit'] ) )
            {
                if ( is_array($data['limit']) )
                    $this->db->limit($data['limit'][0],$data['limit'][1]);
                else
                    $this->db->limit($data['limit']);
            }
            
			if ( isset($data['order_by'] ) )
			{
				if ( is_array($data['order_by']) )
					$this->db->order_by($data['order_by'][0],$data['order_by'][1]);
				else
					$this->db->order_by($data['order_by']);
			}
			
			//echo $this->db->get_compiled_select();
			
			return $this->db;
		}
		
		public function selectStatus($data = array())
		{
			$query = $this->returnSql($data);
			
			$select = " <select name='statusId' id='statusId' class='form-control'> ";
			foreach ( $query as $result )
			{
				
				$select .= " <option value='{$result['id_status']}'>".$result['status_name'];
				
				if ( $result['status_available'] == 0)
					$select .= "(Inativo)";

				$select .= "</option>";
			}
			$select .= "</select>";
			
			return $select;
			
        }
        

	}

?>