<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissiongroup extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('permissiongroup_model');
	}

	public function index()	{
		/* Configuração dos dados a serem pesquisados */
		$pagina = $this->uri->segment(3);

		if ( $pagina > 0)
			$pagina = $pagina*$this->limit;

		/* Filtros */
		$dados['id_permissiongroup'] = $this->input->get('permissiongroupId');
		$dados['p_group_status'] = $this->input->get('permissiongroupStatus');
		$dados['p_group_name'] = $this->input->get('permissiongroupName');
		$dados['categoryOrderBy'] = $this->input->get('categoryOrderBy');
		$dados['categoryOrderAs'] = $this->input->get('categoryOrderAs');
		$dados['order_by'] = $this->input->get('categoryOrderBy')." ".$this->input->get('categoryOrderAs');


		/* Configuração da Paginação */
		$config['base_url'] = base_url('permissiongroup/index');
		$config["uri_segment"] = 3;
		$config['total_rows'] = $this->permissiongroup_model->record_count($dados); //Numero de resultados total da consulta
		$this->pagination->initialize($config); //Starta paginação

		if ( $pagina == 0 )
			$dados['limit'] = $this->limit;
		else
			$dados['limit'] = array($pagina,$this->limit);

		$this->data['results'] = $this->permissiongroup_model->returnSql($dados);
		$this->data['pagination'] = 	$this->pagination->create_links();

		$this->view('_admin.permission_group.index');
		//$this->template->load('_includes/admin_template.php','_admin/list/list_permissiongroup',$this->data);

	}

	public function create($id = null) {
		$id_subcategoria = null;
		$dados = [];

		if ( $id != null ) {
      $dados['id_permissiongroup'] = $id;
			$this->data['edit_data'] = $this->permissiongroup_model->returnSql($dados);
    }

		$this->view('_admin.permission_group.form');
	}

	public function save ($id_produto = null) {
		$this->data = array();

		if ( $id_produto == null )
			$this->form_validation->set_rules('permissionGroupName', 'nome do Produto', 'trim|required|min_length[5]|max_length[254]|is_unique[permissiongroup.permissiongroup_name]');
		else
			$this->form_validation->set_rules('permissionGroupName', 'nome do Produto', 'trim|required|min_length[5]|max_length[254]|callback_is_unique_non_id['.$id_produto.']'); //Caso seja um update, confere se o nome da categoria já não está em uso em outra categoria que não seja ela mesmo

		$this->form_validation->set_rules('permissionGroupStatus', 'ativo', 'trim|required|regex_match[/[01]/]');

		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['errors'] = validation_errors(); //Se der erro em algum campo
		} else {

			$insert = [
				'p_group_name' => $this->input->post('permissionGroupName'),
				'p_group_status' => $this->input->post('permissionGroupStatus'),
			];

			if ( $id_produto == null )
				$this->permissiongroup_model->insert($insert);
			else
				$this->permissiongroup_model->update($insert, $id_produto);

		} //Fim condições

		header('Content-Type: application/json');
		echo json_encode($this->data);
		json_encode($this->data);

	}

	public function changeStatuspermissiongroup ($id = null) {
		$resultado = $this->permissiongroup_model->changeStatus($id);

		header('Content-Type: application/json');
		json_encode($resultado);
		echo json_encode($resultado);

	}

	public function is_unique_non_id($name, $id) {
		return $this->permissiongroup_model->is_unique_non_id($name, $id);
	}

	public function createImage($id_permissiongroup = null, $id_permissiongroup_image = null) {
		$this->data = array();

		if ( $id_permissiongroup != null )
        {
			$dados['id_permissiongroup'] = $id_permissiongroup;
			$dados['p_group_id'] = $id_permissiongroup;
			$dados['p_image_status'] = 1;
			$this->data['p_group_data'] = $this->permissiongroup_model->returnSql($dados);
			$this->data['p_group_images'] = $this->permissiongroupimage_model->returnSql($dados);
		}

		if ( $id_permissiongroup_image != null)
			$this->data['image_edit'] = $this->permissiongroupimage_model->returnSql(['id_permissiongroup_image' => $id_permissiongroup_image]);

		$this->template->load('_includes/admin_template.php','_admin/form/form_permissiongroup_image',$this->data);
	}

}
