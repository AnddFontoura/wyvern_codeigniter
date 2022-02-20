<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissioncategory extends MY_Controller {

	function __construct() {
		parent::__construct();
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
		$dados['categoryOrderBy'] = $this->input->get('categoryOrderBy');
		$dados['categoryOrderAs'] = $this->input->get('categoryOrderAs');
		$dados['order_by'] = $this->input->get('permissionOrderBy')." ".$this->input->get('permissionOrderAs');


		/* Configuração da Paginação */
		$config['base_url'] = base_url('permission/index');
		$config["uri_segment"] = 3;
		$config['total_rows'] = $this->permissioncategory_model->record_count($dados); //Numero de resultados total da consulta
		$this->pagination->initialize($config); //Starta paginação

		if ( $pagina == 0 )
			$dados['limit'] = $this->limit;
		else
			$dados['limit'] = array($pagina,$this->limit);

		$this->data['results'] = $this->permissioncategory_model->returnSql($dados);
		$this->data['pagination'] = 	$this->pagination->create_links();

		$this->view('_admin.permission_category.index');
		//$this->template->load('_includes/admin_template.php','_admin/list/list_permission',$this->data);

	}

	public function create($id = null) {
		$id_permission = null;
		$dados = [];

		if ( $id != null ) {
      $dados['id_permission'] = $id;
			$this->data['edit_data'] = $this->permissioncategory_model->returnSql($dados);
    }

		$this->view('_admin.permission_category.form');
	}

	public function save ($id_permission = null) {
		$this->data = [];

		if ( $id_produto == null )
			$this->form_validation->set_rules('permissionCategoryName', 'nome da Permissão', 'trim|required|min_length[5]|max_length[254]|is_unique[permission.permission_name]');
		else
			$this->form_validation->set_rules('permissionCategoryName', 'nome da Permissão', 'trim|required|min_length[5]|max_length[254]|callback_is_unique_non_id['.$id_produto.']'); //Caso seja um update, confere se o nome da categoria já não está em uso em outra categoria que não seja ela mesmo

		$this->form_validation->set_rules('permissionCategoryStatus', 'ativo', 'trim|required|regex_match[/[01]/]');

		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() == FALSE) {
			$this->data['errors'] = validation_errors(); //Se der erro em algum campo
		} else {
			$insert = [
				'p_category_name' => $this->input->post('permissionCategoryName'),
				'p_category_status' => $this->input->post('permissionCategoryStatus')
			];

			if ( $id_permission == null )
				$permission = $this->permissioncategory_model->insert($insert);
			else
				$permission = $this->permissioncategory_model->update($insert, $id_permission);

			if( $this->input->post('permissionMakeCrud') == 1) {
				$array_permissions = [ 'create', 'read', 'update', 'delete' ];

				foreach ( $array_permissions as $permission ) {

					$tem_permissao = $this->permission_model->returnSql([
							'permission_name' => $permission,
							'permission_category_id' => $permission['id_permission_category'],
					]);

					if ( is_array($tem_permissao) && !is_empty($tem_permissao) ) {
						$this->permission->insert([
							'permission_name' => $permission,
							'permission_category_id' => $permission['id_permission_category'],
							'permission_status' => 1
						]);
					}
				}
			}
		} //Fim condições

		header('Content-Type: application/json');
		echo json_encode($this->data);
		json_encode($this->data);

	}

	public function changeStatusPermission ($id = null) {
		$resultado = $this->permissioncategory_model->changeStatus($id);

		header('Content-Type: application/json');
		json_encode($resultado);
		echo json_encode($resultado);
	}

	public function is_unique_non_id($name, $id) {
		return $this->permissioncategory_model->is_unique_non_id($name, $id);
	}

}
