<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Item_model extends MY_Model {

		public function __construct() {
      parent::__construct();
      $this->table = 'item';
			$this->primary_key = 'id_item';
			$this->status_collum = 'item_status';
			$this->name_collum = 'item_name';
		}

		public function sql ($data = null)
		{
			parent::sql();

			$this->db->select('
				id_item,
				item.item_name,
				item.item_status,
				item.item_description,
				category_item.id_category_item,
				category_item.c_item_name,
				category_item.c_item_description,
				category_item.c_item_status
			');

			$this->db->join('category_item','item.item_category_id = category_item.id_category_item');

			if ( isset ($data['item_status']) )
				$this->db->where('item.item_status',$data['item_status']);

			if ( isset ($data['c_item_status']) )
				$this->db->where('category_item.c_item_status',$data['c_item_status']);

			if ( isset ($data['id_item']) )
				$this->db->where('item.id_item',$data['id_item']);

			if ( isset ($data['id_category_item']) )
				$this->db->where('category_item.id_category_item',$data['id_category_item']);

				if ( isset ($data['item_name']) )
				$this->db->where('item.item_name',$data['item_name']);

			if ( isset ($data['c_item_name']) )
				$this->db->where('category_item.c_item_name',$data['c_item_name']);

			if ( isset ($data['item_name_like']) )
				$this->db->like('item.item_name',$data['item_name_like']);

			if ( isset ($data['c_item_name_like']) )
				$this->db->like('category_item.c_item_name',$data['c_item_name_like']);

			//echo $this->db->get_compiled_select();

			return $this->db;
		}

		public function selectCheckItem($data = array())
		{
			$query = $this->returnSql($data);
			$classificacao = "";

			$select = "";
			$i = 0;

			foreach ( $query as $result )
			{
				if ( $result['c_item_name'] != $classificacao )
				{
					if ( $i > 0)
						$select .= " </div> </div>";

					$classificacao = $result['c_item_name'];
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

				$select .= "<div class='col-md-4'> <label class='checkbox-inline'><input name='itemId[]' id='itemId' type='checkbox' value='{$result['id_item']}'>{$result['item_name']}</label> </div> ";
			}

			$select .= " </div> </div>";

			return $select;

		}

	}

?>
