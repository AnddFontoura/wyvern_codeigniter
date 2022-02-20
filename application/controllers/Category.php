<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('category_model');
	}

	public function index()	{
		/* Configuração dos dados a serem pesquisados */
		$pagina = $this->uri->segment(3);

		if ( $pagina > 0)
			$pagina = $pagina*$this->limit;

		/* Filtros */
		$dados['category_status'] = $this->input->get('categoryStatus');
		$dados['id_category'] = $this->input->get('categoryId');
		$dados['category_name'] = $this->input->get('categoryName');
		$dados['categoryOrderBy'] = $this->input->get('categoryOrderBy');
		$dados['categoryOrderAs'] = $this->input->get('categoryOrderAs');
		$dados['order_by'] = $this->input->get('categoryOrderBy')." ".$this->input->get('categoryOrderAs');

		//var_dump($dados);

		/* Configuração da Paginação */
		$config['base_url'] = base_url('category/index');
		$config["uri_segment"] = 3;
		$config['total_rows'] = $this->category_model->record_count($dados); //Numero de resultados total da consulta
		$this->pagination->initialize($config); //Starta paginação
		$this->data['pagination'] = 	$this->pagination->create_links();

		if ( $pagina == 0 )
			$dados['limit'] = $this->limit;
		else
			$dados['limit'] = array($pagina,$this->limit);

		$this->data['results'] = $this->category_model->returnSql($dados);
		$this->data['search_data'] = $dados;

		$this->view('_admin.category.index');
    //$this->template->load('_includes/admin_template.php','_admin/list/list_category',$this->data);

	}

	public function create($id = null) {
		$this->data = array();

		if ( $id != null ) {
		$dados['id_category'] = $id;
		$this->data['edit_data'] = $this->category_model->returnSql($dados);

				if ( empty($this->data['edit_data'])) {
					$this->data['erro'] = "Não foi encontrada uma categoria com esse ID";
					redirect('admin/category');
				}
			}

		$this->view('_admin.category.form');
	}

	public function save($id_categoria = null) {
		$this->data = array();

		if ( $id_categoria == null )
			$this->form_validation->set_rules('categoryName', 'Nome da Categoria', 'trim|required|min_length[5]|max_length[254]|is_unique[category.category_name]');
        else
			$this->form_validation->set_rules('categoryName', 'Nome da Categoria', 'trim|required|min_length[5]|max_length[254]|callback_is_unique_non_id['.$id_categoria.']'); //Caso seja um update, confere se o nome da categoria já não está em uso em outra categoria que não seja ela mesmo

		$this->form_validation->set_rules('categoryStatus', 'ativo', 'trim|required|regex_match[/[01]/]');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == FALSE) {
			$this->data['errors'] = validation_errors(); //Se der erro em algum campo
		} else {

			if ( ! $this->upload->do_upload('categoryImage'))
				$this->data['erro_upload'] = $this->upload->display_errors();
			else
				$success = ['upload_data' => $this->upload->data()];

			$insert = [
				'category_name' => $this->input->post('categoryName'),
				'category_status' => $this->input->post('categoryStatus'),
				'category_description' => $this->input->post('categoryDescription')
			];

			/* Caso não tenha dado erro no upload, adiciona o nome do arquivo no banco */
			if ( !isset($this->data['erro_upload']) )
				$insert['category_image']  = $success['upload_data']['file_name'];

			if ( $id_categoria == null )
				$id_category = $this->category_model->insert($insert);
			else
				$this->category_model->update($insert, $id_categoria);

		} //Fim condições

		header('Content-Type: application/json');
		echo json_encode($this->data);
		json_encode($this->data);

	}

	public function is_unique_non_id($name, $id) {
		return $this->category_model->is_unique_non_id($name, $id);
	}

	public function changeStatus($id) {
		$resultado = $this->category_model->changeStatus($id);

		header('Content-Type: application/json');
		json_encode($resultado);
		echo json_encode($resultado);
	}

}
