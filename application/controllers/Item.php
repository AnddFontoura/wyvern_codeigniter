<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('categoryitem_model');
		$this->load->model('item_model');
	}

	public function index($status = null)
	{
		/* Configuração dos dados a serem pesquisados */
		$dados['c_item_status'] = $status;

		/* Configuração da Paginação */
		$config['base_url'] = base_url('item/'.$dados['c_item_status']);
		$config["uri_segment"] = 3;
		$config['total_rows'] = $this->item_model->record_count($dados); //Numero de resultados total da consulta
		$this->pagination->initialize($config); //Starta paginação

		$this->data['results'] = $this->item_model->returnSql($dados);
		$this->data['pagination'] = 	$this->pagination->create_links();
		$this->data['search_classificationitem'] = $this->categoryitem_model->selectClassification();

		$this->view('_admin.item.index');
	}

	public function create($id = null)
	{
		$this->data = array();
		$dados = array();

		$id_classification = null;

    if ( $id != null )
    {
      $dados['id_item'] = $id;
			$this->data['edit_data'] = $this->item_model->returnSql($dados);
			$id_classification = $this->data['edit_data']['0']['id_category_item'];
		}

		$this->data['select_classificacao'] = $this->categoryitem_model->selectClassification($dados,$id_classification);

		$this->view('_admin.item.form');
	}

	public function save ($id = null)
	{
		$this->data = array();

		$id_item = $id;

		if ( $id_item == null )
			$this->form_validation->set_rules('itemName', 'nome do item', 'trim|required|min_length[5]|max_length[254]|is_unique[item.item_name]');
		else
			$this->form_validation->set_rules('itemName', 'nome do item', 'trim|required|min_length[5]|max_length[254]|callback_is_unique_non_id['.$id_item.']'); //Caso seja um update, confere se o nome da categoria já não está em uso em outra categoria que não seja ela mesmo

		$this->form_validation->set_rules('itemStatus', 'ativo', 'trim|required|regex_match[/[01]/]');
		$this->form_validation->set_rules('categoryItemId', 'classficação do item', 'trim|required|regex_match[/[0-9]{1,10}/]');

		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['errors'] = validation_errors(); //Se der erro em algum campo
		} else {

		$insert = array
		(
			'item_category_id' => $_POST['categoryItemId'],
			'item_name' => $_POST['itemName'],
			'item_status' => $_POST['itemStatus'],
			'item_description' => $_POST['itemDescription']
		);

			if ( $id_item == null )
				$this->item_model->insert($insert);
			else
				$this->item_model->update($insert, $id_item);

		} //Fim condições

		header('Content-Type: application/json');
		echo json_encode($this->data);
		json_encode($this->data);

	}

	public function is_unique_non_id($name, $id)
	{
		return $this->item_model->is_unique_non_id($name, $id);
	}

	public function changeStatus($id)
	{
		$resultado = $this->item_model->changeStatus($id);

		header('Content-Type: application/json');
		json_encode($resultado);
		echo json_encode($resultado);
	}

}
