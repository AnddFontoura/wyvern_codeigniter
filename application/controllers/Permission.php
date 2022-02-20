<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('permission_model');
		$this->load->model('permissioncategory_model');
	}

	public function index()	{
		/* Configuração dos dados a serem pesquisados */
		$pagina = $this->uri->segment(3);

		if ( $pagina > 0)
			$pagina = $pagina*$this->limit;

		/* Filtros */
		$dados['id_permission'] = $this->input->get('permissionId');
		$dados['permission_status'] = $this->input->get('permissionStatus');
		$dados['permission_name'] = $this->input->get('permissionName');
		$dados['id_permission_category'] = $this->input->get('permissionCategoryId');
		$dados['categoryOrderBy'] = $this->input->get('categoryOrderBy');
		$dados['categoryOrderAs'] = $this->input->get('categoryOrderAs');
		$dados['order_by'] = $this->input->get('categoryOrderBy')." ".$this->input->get('categoryOrderAs');


		/* Configuração da Paginação */
		$config['base_url'] = base_url('permission/index');
		$config["uri_segment"] = 3;
		$config['total_rows'] = $this->permission_model->record_count($dados); //Numero de resultados total da consulta
		$this->pagination->initialize($config); //Starta paginação

		if ( $pagina == 0 )
			$dados['limit'] = $this->limit;
		else
			$dados['limit'] = array($pagina,$this->limit);

		$this->data['results'] = $this->permission_model->returnSql($dados);
		$this->data['pagination'] = 	$this->pagination->create_links();

		$this->view('_admin.permission.index');
		//$this->template->load('_includes/admin_template.php','_admin/list/list_permission',$this->data);

	}

	public function create($id = null) {
		$id_subcategoria = null;
		$dados = [];

		if ( $id != null ) {
      $dados['id_permission'] = $id;
			$this->data['edit_data'] = $this->permission_model->returnSql($dados);
			$id_subcategoria = $this->data['edit_data'][0]['permission_category_id'];
    }

		$this->data['select_permissioncategory'] = $this->permissioncategory_model->selectPermissionCategory($dados, $id_subcategoria);

		$this->view('_admin.permission.form');
	}

	public function save ($id_produto = null) {
		$this->data = array();

		if ( $id_produto == null )
			$this->form_validation->set_rules('permissionName', 'nome do Produto', 'trim|required|min_length[3]|max_length[254]|is_unique[permission.permission_name]');
		else
			$this->form_validation->set_rules('permissionName', 'nome do Produto', 'trim|required|min_length[3]|max_length[254]|callback_is_unique_non_id['.$id_produto.']'); //Caso seja um update, confere se o nome da categoria já não está em uso em outra categoria que não seja ela mesmo

		$this->form_validation->set_rules('permissionStatus', 'ativo', 'trim|required|regex_match[/[01]/]');

		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() == FALSE) {
			$this->data['errors'] = validation_errors(); //Se der erro em algum campo
		} else {

			$insert = [
				'permission_name' => $this->input->post('permissionName'),
				'permission_category_id' => $this->input->post('permissionCategoryId'),
				'permission_status' => $this->input->post('permissionStatus')
			];

			if ( $id_produto == null )
				$this->permission_model->insert($insert);
			else
				$this->permission_model->update($insert, $id_produto);

		} //Fim condições

		header('Content-Type: application/json');
		echo json_encode($this->data);
		json_encode($this->data);

	}

	public function changeStatuspermission ($id = null) {
		$resultado = $this->permission_model->changeStatus($id);

		header('Content-Type: application/json');
		json_encode($resultado);
		echo json_encode($resultado);

	}

	public function is_unique_non_id($name, $id) {
		return $this->permission_model->is_unique_non_id($name, $id);
	}

}
