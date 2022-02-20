<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Productitem_model extends MY_Model {

        public function __construct()
        {
            parent::__construct();
            $this->table = 'product_has_item';
			$this->primary_key = 'id_product_has_item';
			$this->status_collum = 'product_status';
			$this->name_collum = 'product_name';
		}

		public function sql ($data = null)
		{
			parent::sql();

			$this->db->select('
				id_product_has_item,
				product_id,
				item_id
			');
			
			if ( isset ($data['item_id']) )
				$this->db->where('product_has_item.item_id',$data['item_id']);
		
			if ( isset ($data['product_id']) )
				$this->db->where('product_has_item.product_id',$data['product_id']);
		
			if ( isset($data['limit'] ) )
			{
				if ( is_array($data['limit']) )
					$this->db->limit($data['limit'][0],$data['limit'][1]);
				else
					$this->db->limit($data['limit']);
			}
			
			if ( isset($data['order_by'] ) )
				$this->db->order_by($data['order_by']);	
				
			return $this->db;
        }

        
		public function selectCheckItem($data)
		{
			$query = $this->sqlModel($data);
			$classificacao = "";
			
			$select = "";
			$i = 0;
			
			foreach ( $query->result_array() as $result )
			{
				if ( $result['classificacao_nome'] != $classificacao )
				{
					if ( $i > 0)
						$select .= " </div> </div>";
					
					$classificacao = $result['classificacao_nome'];
					$select .= 
					"		
						<div class='box box-solid box-primary'>
							<div class='box-header with-border'>
								<h3 class='box-title'>$classificacao</h3>
							</div>
						
							<div class='box-body'>
					";
					
					$i++;
				}
				
				$select .= "<div class='col-md-4'> <label class='checkbox-inline'><input name='itemId' id='itemId' type='checkbox' value='{$result['id_item']}'>{$result['item_nome']}</label> </div> ";
			}
			
			$select .= " </div> </div>";
			
			return $select;
			
		}
        
		public function clearProductItem($data)
		{
			$this->db->where($data);
			$this->db->delete('product_has_item');
		}
    }
?>