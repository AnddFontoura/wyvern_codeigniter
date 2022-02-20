<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategory extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('subcategory_model');
	}

	public function index()
	{
		/* Configuração dos dados a serem pesquisados */
		$pagina = $this->uri->segment(3);

		if ( $pagina > 0)
			$pagina = $pagina*$this->limit;

		/* Filtros */
		$dados['category_status'] = $this->input->get('categoryStatus');
		$dados['id_category'] = $this->input->get('categoryId');
		$dados['category_name'] = $this->input->get('categoryName');
		$dados['subcategory_status'] = $this->input->get('subCategoryStatus');
		$dados['id_subcategory'] = $this->input->get('subCategoryId');
		$dados['subcategory_name'] = $this->input->get('subCategoryName');
		$dados['order_by'] = $this->input->get('categoryOrderBy')." ".$this->input->get('categoryOrderAs');

		/* Configuração da Paginação */
		$config['base_url'] = base_url('subcategory/index');
		$config["uri_segment"] = 3;
		$config['total_rows'] = $this->subcategory_model->record_count($dados); //Numero de resultados total da consulta
		$this->pagination->initialize($config); //Starta paginação
		$this->data['pagination'] = 	$this->pagination->create_links();

		if ( $pagina == 0 )
			$dados['limit'] = $this->limit;
		else
			$dados['limit'] = array($pagina,$this->limit);

		$this->data['results'] = $this->subcategory_model->returnSql($dados);
		$this->data['search_data'] = $dados;

		$this->view('_admin.subcategory.index');
        //$this->template->load('_includes/admin_template.php','_admin/list/list_subcategory',$data);

	}

	public function create($id = null)
	{
		$this->data = array();
		$category_id = null;

		if ( $id != null ) {
			$dados['id_subcategory'] = $id;
			$this->data['edit_data'] = $this->subcategory_model->returnSql($dados);
			$category_id = $this->data['edit_data'][0]['category_id'];

			if ( empty($this->data['edit_data'])) {
				$this->data['erro'] = "Não foi encontrada uma categoria com esse ID";
				redirect('admin/subcategory');
			}
		}

    $select['subcategory_status'] = 1;
		$select['order_by'] = "category_name asc";

		$this->data['select_categoria'] = $this->category_model->selectCategory($select, $category_id);

		$this->view('_admin.subcategory.form');

	}

	public function save($id = null)
	{
		$data = array();

		$id_subcategoria = $id;

        if ( $id_subcategoria == null )
            $this->form_validation->set_rules('categorySubName', 'Nome da Sub Categoria', 'trim|required|min_length[5]|max_length[254]|is_unique[subcategory.subcategory_name]');
        else
            $this->form_validation->set_rules('categorySubName', 'Nome da Sub Categoria', 'trim|required|min_length[5]|max_length[254]|callback_is_unique_non_id['.$id_subcategoria.']'); //Caso seja um update, confere se o nome da categoria já não está em uso em outra categoria que não seja ela mesmo

        $this->form_validation->set_rules('categorySubStatus', 'ativo', 'trim|required|regex_match[/[01]/]');
        $this->form_validation->set_rules('categoryId', 'Categoria', 'trim|required|regex_match[/[0-9]{1,10}/]');

		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['errors'] = validation_errors(); //Se der erro em algum campo
		} else {

			/* Envia o arquivo primeiro */
			$config['upload_path']          = './upload/subcategoria/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 10000;
			//$config['max_width']            = 1024;
			//$config['max_height']           = 768;
			$config['file_ext_tolower']     = true;
			$config['encrypt_name']        	= true;
			$this->upload->initialize($config);


			if ( ! $this->upload->do_upload('categorySubImage'))
				$data['erro_upload'] = $this->upload->display_errors();
			else
				$success = array('upload_data' => $this->upload->data());

			$insert = [
				'category_id' => $_POST['categoryId'],
				'subcategory_name' => $_POST['categorySubName'],
				'subcategory_status' => $_POST['categorySubStatus'],
				'subcategory_description' => $_POST['categorySubDescription']
			];

			/* Caso não tenha dado erro no upload, adiciona o nome do arquivo no banco */
			if ( !isset($data['erro_upload']) )
				$insert['subcategory_image']  = $success['upload_data']['file_name'];

			if ( $id_subcategoria == null )
				$this->subcategory_model->insert($insert);
			else
				$this->subcategory_model->update($insert, $id_subcategoria);

		} //Fim condições

		header('Content-Type: application/json');
		echo json_encode($this->data);
		json_encode($this->data);

	}

	public function is_unique_non_id($name, $id) {
		return $this->subcategory_model->is_unique_non_id($name, $id);
	}

	public function changeStatus($id) {
		$resultado = $this->subcategory_model->changeStatus($id);

		header('Content-Type: application/json');
		json_encode($resultado);
		echo json_encode($resultado);
	}

}
