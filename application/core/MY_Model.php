<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

    protected $table; //Nome da tabela que será usada nessa class
    protected $primary_key; //Nome da chave primária da tabela
    protected $status_collum; //Nome da coluna do status
    protected $name_collum; //Nome da coluna de nome
    private $all_collums = array(); //Array com todas as colunas da tabela
    private $list_collums = array(); //Array com as colunas pra um list

    public function insert($data) {
        $data = array_merge($data, ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')] );
        $this->db->insert($this->table,$data);

        return $this->db->insert_id();
    }

    public function update( $data, $id_update ) {
      $data = array_merge($data, ['updated_at' => date('Y-m-d h:i:s')] );

      $this->db->where($this->primary_key, $id_update);
      $this->db->update($this->table,$data);

      return $this->db->affected_rows();
    }

    public function delete ($id_delete) {

      $this->db->where($this->primary_key,$id_delete);
      $this->db->update($this->table, ['deleted_at' => date('Y-m-d h:i:s')] );

      return $this->db->affected_rows();
    }

    public function sql($dados = array()) {
        $this->db->from($this->table);

        if ( isset($dados['limit'] ) ) {
            if ( is_array($dados['limit']) )
                $this->db->limit($dados['limit'][0],$dados['limit'][1]);
            else
                $this->db->limit($dados['limit']);
        }

        if ( isset($dados['order_by']) && trim($dados['order_by']) != "" ) {
            $this->db->order_by($dados['order_by']);
        }

        if ( isset($dados['show_deleted']) && $dados['show_deleted'] == true ) {
          $this->db->where($this->table.'.deleted_at is not null');
        } else {
          $this->db->where($this->table.'.deleted_at is null');
        }

        return $this->db;
    }

    public function record_count($data) {
        $this->db = $this->sql($data);
        return $this->db->count_all_results();
    }

    public function returnSql ($data = nui) {
        $this->db = $this->sql($data);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function changeStatus($id) {
        $this->db->select($this->status_collum);
        $this->db->from($this->table);
        $this->db->where($this->primary_key,$id);

        $query = $this->db->get();
        $result = $query->result_array();

        if ( $result[0][$this->status_collum] == 1 )
            $status = 0;
        else
            $status = 1;

        $this->db->set($this->status_collum,$status);
        $this->db->where($this->primary_key,$id);
        $this->db->update($this->table);

        return $this->db->affected_rows();
    }

    public function is_unique_non_id($name, $id) {
		$this->db->select($this->primary_key);
		$this->db->from($this->table);
		$this->db->where($this->name_collum,$name);
		$query = $this->db->get();

		$error = 0;

		foreach ( $query->result_array() as $row )
		{
			if ( $row[$this->primary_key] != $id )
				$error = 1;
		}

		if ( $error == 1 )
		{
			$this->form_validation->set_message('is_unique_non_id', 'O campo {field} contém um nome que já está na lista de categorias no momento e não pode ser duplicado');
			return false;
		} else {
			return true;
		}

	}

}
