<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends MY_Controller {
	 
	function __construct()
	{
		CI_Controller::__construct();
		$this->load->model('bank_model');
	}
	
	public function index()
	{
		/* Configuração dos dados a serem pesquisados */
		$pagina = $this->uri->segment(3);
		
		if ( $pagina > 0)
			$pagina = $pagina*20;

		/* Filtros */
		$dados['bank_status'] = $this->input->get('bankStatus');
		$dados['id_bank'] = $this->input->get('bankId');
		$dados['bank_name'] = $this->input->get('bankName');
		
		/* Configuração da Paginação */
		$config['base_url'] = base_url('bank/index');
		$config["uri_segment"] = 3;
		$config['total_rows'] = $this->bank_model->record_count($dados); //Numero de resultados total da consulta
		$this->pagination->initialize($config); //Starta paginação
		$data['pagination'] = 	$this->pagination->create_links();

		if ( $pagina == 0 )
			$dados['limit'] = 20;
		else
			$dados['limit'] = array($pagina,20);
		
		$data['results'] = $this->bank_model->returnSql($dados);
		$data['search_data'] = $dados;

        $this->template->load('_includes/admin_template.php','_admin/list/list_bank',$data);

	}
	
	public function create($id = null)
	{	
        $data = array();
        
        if ( $id != null )
        {
            $dados['id_bank'] = $id;
            $data['edit_data'] = $this->bank_model->returnSql($dados);
        }

        $this->template->load('_includes/admin_template.php','_admin/form/form_bank',$data);
	}	
	
	public function save($id_categoria = null)
	{
		$data = array();
		
		if ( $id_categoria == null )
			$this->form_validation->set_rules('bankName', 'Nome da Categoria', 'trim|required|min_length[5]|max_length[254]|is_unique[bank.bank_name]');
        else
			$this->form_validation->set_rules('bankName', 'Nome da Categoria', 'trim|required|min_length[5]|max_length[254]|callback_is_unique_non_id['.$id_categoria.']'); //Caso seja um update, confere se o nome da categoria já não está em uso em outra categoria que não seja ela mesmo
        
		$this->form_validation->set_rules('bankActive', 'ativo', 'trim|required|regex_match[/[01]/]');
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

			
			if ( ! $this->upload->do_upload('bankImage'))
				$data['erro_upload'] = $this->upload->display_errors();
			else
				$success = array('upload_data' => $this->upload->data());
			
			$insert = array
					( 
						'bank_name' => $this->input->post('bankName'),
						'bank_status' => $this->input->post('bankStatus'),
						'bank_description' => $this->input->post('bankDescription')
					);
					
			/* Caso não tenha dado erro no upload, adiciona o nome do arquivo no banco */
			if ( !isset($data['erro_upload']) ) 
				$insert['bank_image']  = $success['upload_data']['file_name']; 	
					
			if ( $id_categoria == null )
				$this->bank_model->insert($insert);
			else 
				$this->bank_model->update($insert, $id_categoria);
			
		} //Fim condições
		
		header('Content-Type: application/json');
		echo json_encode($data);
		json_encode($data);
			
	}
	
	public function is_unique_non_id($name, $id)
	{
		return $this->bank_model->is_unique_non_id($name, $id);	
	}

	public function changeStatus($id)
	{
		$resultado = $this->bank_model->changeStatus($id);

		header('Content-Type: application/json');
		json_encode($resultado);
		echo json_encode($resultado);

	}
	
}
