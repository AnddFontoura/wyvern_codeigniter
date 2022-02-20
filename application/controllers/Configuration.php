<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends MY_Controller {
	 
	function __construct()
	{
		CI_Controller::__construct();
		$this->load->model('configuration_model');
	}
	
	public function index()
	{
		/* Configuração dos dados a serem pesquisados */
		$pagina = $this->uri->segment(3);
		
		if ( $pagina > 0)
			$pagina = $pagina*20;

		/* Filtros */
		$dados['configuration_status'] = $this->input->get('configurationStatus');
		$dados['id_configuration'] = $this->input->get('configurationId');
		$dados['configuration_name'] = $this->input->get('configurationName');
		
		/* Configuração da Paginação */
		$config['base_url'] = base_url('configuration/index');
		$config["uri_segment"] = 3;
		$config['total_rows'] = $this->configuration_model->record_count($dados); //Numero de resultados total da consulta
		$this->pagination->initialize($config); //Starta paginação
		$data['pagination'] = 	$this->pagination->create_links();

		if ( $pagina == 0 )
			$dados['limit'] = 20;
		else
			$dados['limit'] = array($pagina,20);
		
		$data['results'] = $this->configuration_model->returnSql($dados);
		$data['search_data'] = $dados;

        $this->template->load('_includes/admin_template.php','_admin/list/list_configuration',$data);

	}
	
	public function create($id = null)
	{	
        $data = array();
        
        if ( $id != null )
        {
            $dados['id_configuration'] = $id;
            $data['edit_data'] = $this->configuration_model->returnSql($dados);
        }

        $this->template->load('_includes/admin_template.php','_admin/form/form_configuration',$data);
	}	
	
	public function save($id_categoria = null)
	{
		$data = array();
		
		if ( $id_categoria == null )
			$this->form_validation->set_rules('configurationName', 'Nome da Categoria', 'trim|required|min_length[5]|max_length[254]|is_unique[configuration.configuration_name]');
        else
			$this->form_validation->set_rules('configurationName', 'Nome da Categoria', 'trim|required|min_length[5]|max_length[254]|callback_is_unique_non_id['.$id_categoria.']'); //Caso seja um update, confere se o nome da categoria já não está em uso em outra categoria que não seja ela mesmo
        
		$this->form_validation->set_rules('configurationActive', 'ativo', 'trim|required|regex_match[/[01]/]');
		$this->form_validation->set_error_delimiters('', '');

		if ($this->form_validation->run() == FALSE)
		{
			$data['errors'] = validation_errors(); //Se der erro em algum campo
		} else {
			
			/* Envia o arquivo primeiro */
			$config['upload_path']          = './upload/categoria/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 10000;
			//$config['max_width']            = 1024;
			//$config['max_height']           = 768;
			$config['file_ext_tolower']     = true;
			$config['encrypt_name']        	= true;
			$this->upload->initialize($config);

			
			if ( ! $this->upload->do_upload('configurationImage'))
				$data['erro_upload'] = $this->upload->display_errors();
			else
				$success = array('upload_data' => $this->upload->data());
			
			$insert = array
					( 
						'configuration_name' => $this->input->post('configurationName'),
						'configuration_status' => $this->input->post('configurationStatus'),
						'configuration_description' => $this->input->post('configurationDescription')
					);
					
			/* Caso não tenha dado erro no upload, adiciona o nome do arquivo no banco */
			if ( !isset($data['erro_upload']) ) 
				$insert['configuration_image']  = $success['upload_data']['file_name']; 	
					
			if ( $id_categoria == null )
				$this->configuration_model->insert($insert);
			else 
				$this->configuration_model->update($insert, $id_categoria);
			
		} //Fim condições
		
		header('Content-Type: application/json');
		echo json_encode($data);
		json_encode($data);
			
	}
	
	public function is_unique_non_id($name, $id)
	{
		return $this->configuration_model->is_unique_non_id($name, $id);	
	}

	public function changeStatus($id)
	{
		$resultado = $this->configuration_model->changeStatus($id);

		header('Content-Type: application/json');
		json_encode($resultado);
		echo json_encode($resultado);

	}
	
}
