<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Bank_model extends MY_Model {

		public function __construct()
        {
            parent::__construct();
            $this->table = 'bank';
			$this->primary_key = 'id_bank';
			$this->status_collum = 'bank_status';
			$this->name_collum = 'bank_name';
		}

		public function sql ($data = null)
		{
			parent::sql();

			$this->db->select('
				id_bank, 
				bank_name, 
				bank_code, 
				bank_status
			');
        
            if ( isset ($data['id_bank']) && $data['id_bank'] != "" )
                $this->db->where('id_bank',$data['id_bank']);
            
            if ( isset ($data['bank_name']) && $data['bank_name'] != "" )
                $this->db->like('bank_name',$data['bank_name']);
            
            if ( isset ($data['bank_code']) && $data['bank_code'] != "" )
                $this->db->where('bank_code',$data['bank_code']);
            
            if ( isset ($data['bank_status']) && $data['bank_status'] != "" )
                $this->db->where('bank_status',$data['bank_status']);
            
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
			
			$select = " <select name='bankId' id='bankId' class='form-control select2'> ";
			foreach ( $query as $result )
			{
				
				$select .= " <option value='{$result['id_bank']}'>".$result['bank_code']." - ".$result['bank_name']."</option>";
			}
			$select .= "</select>";
			
			return $select;
        }
	
	}

?>