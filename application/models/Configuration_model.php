<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Configuration_model extends MY_Model {

		public function __construct()
        {
            parent::__construct();
            $this->table = 'configuration';
			$this->primary_key = 'id_configuration';
			$this->status_collum = 'configuration_status';
			$this->name_collum = 'configuration_login';
		}

		public function sql ($data = null)
		{
			parent::sql();

			$this->db->select('
				id_configuration, 
				configuration_name, 
				configuration_value, 
				configuration_status
			');
        
            if ( isset ($data['id_configuration']) && $data['id_configuration'] != "" )
                $this->db->where('id_configuration',$data['id_configuration']);
            
            if ( isset ($data['configuration_name']) && $data['configuration_name'] != "" )
                $this->db->like('configuration_name',$data['configuration_name']);
            
            if ( isset ($data['configuration_value']) && $data['configuration_value'] != "" )
                $this->db->where('configuration_value',$data['configuration_value']);
            
            if ( isset ($data['configuration_status']) && $data['configuration_status'] != "" )
                $this->db->where('configuration_status',$data['configuration_status']);
            
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
		
		public function selectCustomer($data = array())
		{
			$query = $this->returnSql($data);
			
			$select = " <select name='configurationId' id='configurationId' class='form-control'> ";
			foreach ( $query as $result )
			{
				
				$select .= " <option value='{$result['id_configuration']}'>".$result['configuration_name']."</option>";
			}
			$select .= "</select>";
			
			return $select;
        }
	
	}

?>