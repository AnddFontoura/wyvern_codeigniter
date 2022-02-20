<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoryitem extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('categoryitem_model');
	}

	public function index($status = null) {
		/* Configuração dos dados a serem pesquisados */
		$dados['c_item_status'] = $status;

		/* Configuração da Paginação */
		$config['base_url'] = base_url('categoria/'.$dados['c_item_status']);
		$config["uri_segment"] = 3;
		$config['total_rows'] = $this->categoryitem_model->record_count($dados); //Numero de resultados total da consulta
		$this->pagination->initialize($config); //Starta paginação

		$this->data['results'] = $this->categoryitem_model->returnSql($dados);
		$this->data['pagination'] = 	$this->pagination->create_links();

		$this->view("_admin.category_item.index");
	}


	public function create($id = null) {
    $this->data = array();

    if ( $id != null ) {
      $dados['id_category_item'] = $id;
      $this->data['edit_data'] = $this->categoryitem_model->returnSql($dados);
    }

		$this->view("_admin.category_item.form");
	}

	public function save ($id = null) {

		$this->data = array();
		$id_category_item = $id;

		if ( $id_category_item == null )
			$this->form_validation->set_rules('categoryItemName', 'Nome da Categoria', 'trim|required|min_length[5]|max_length[254]|is_unique[category_item.c_item_name]');
		else
			$this->form_validation->set_rules('categoryItemName', 'Nome da Categoria', 'trim|required|min_length[5]|max_length[254]|callback_is_unique_non_id['.$id_category_item.']'); //Caso seja um update, confere se o nome da categoria já não está em uso em outra categoria que não seja ela mesmo

		$this->form_validation->set_rules('categoryItemStatus', 'ativo', 'trim|required|regex_match[/[01]/]');

		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['errors'] = validation_errors(); //Se der erro em algum campo
		} else {

			$insert = array
					(
						'c_item_name' => $_POST['categoryItemName'],
						'c_item_status' => $_POST['categoryItemStatus'],
						'c_item_description' => $_POST['categoryItemDescription']
					);

			if ( $id_category_item == null )
				$this->categoryitem_model->insert($insert);
			else
				$this->categoryitem_model->update($insert, $id_category_item);

		} //Fim condições

		header('Content-Type: application/json');
		echo json_encode($this->data);
		json_encode($this->data);

	}

	public function is_unique_non_id($name, $id) {
		return $this->categoryitem_model->is_unique_non_id($name, $id);
	}

	public function changeStatus($id) {
		$resultado = $this->categoryitem_model->changeStatus($id);

		header('Content-Type: application/json');
		json_encode($resultado);
		echo json_encode($resultado);
	}

}
