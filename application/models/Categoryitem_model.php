<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Categoryitem_model extends MY_Model {

		public function __construct() {
      parent::__construct();
      $this->table = 'category_item';
			$this->primary_key = 'id_category_item';
			$this->status_collum = 'c_item_status';
			$this->name_collum = 'c_item_name';
		}

		public function sql ($data = null) {
			parent::sql($data);

			$this->db->select('
				id_category_item,
				c_item_name,
				c_item_status,
				c_item_description'
			);

			if ( isset ($data['c_item_status']) )
				$this->db->where('c_item_status',$data['c_item_status']);

			if ( isset ($data['c_item_name']))
				$this->db->where('c_item_name',$data['c_item_name']);

			if ( isset ($data['c_item_name_like']))
				$this->db->like('c_item_name',$data['c_item_name']);

			if ( isset ($data['id_classification_item']) )
				$this->db->where('id_classification_item',$data['id_classification_item']);

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

		public function selectClassification($data = array(),$id_classification = null)
		{
			$query = $this->returnSql($data);

			$select = " <select name='categoryItemId' id='categoryItemId' class='form-control select2'> ";
			foreach ( $query as $result )
			{
				if ( $id_classification == $result['id_category_item'] )
					$selected = "selected";
				else
					$selected = "";

				$select .= " <option value='{$result['id_category_item']}' $selected>{$result['c_item_name']}";

				if ($result['c_item_status'] == 0 )
					$select .= " (Inativo)";

				$select .= " </option>";
			}
			$select .= "</select>";

			return $select;

		}

	}

?>
