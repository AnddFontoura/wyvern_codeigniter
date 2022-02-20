<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		CI_Controller::__construct();
		$this->load->model('user_model');
	}

	public function index($status = 1)
	{
		/* Configuração dos dados a serem pesquisados */
		$dados['user_status'] = $status;

		/* Configuração da Paginação */
		$config['base_url'] = base_url('user/'.$dados['user_status']);
		$config["uri_segment"] = 3;
		$config['total_rows'] = $this->user_model->record_count($dados); //Numero de resultados total da consulta
		$this->pagination->initialize($config); //Starta paginação

		$data['results'] = $this->user_model->returnuser($dados);
		$data['pagination'] = 	$this->pagination->create_links();


        $this->template->load('_includes/template.php','list/list_user',$data);
	}

	public function create($id = null)
	{
		$data = array();

        if ( $id != null )
        {
            $dados['id_category'] = $id;
            $data['edit_data'] = $this->category_model->returnCategory($dados);
        }

        $this->template->load('_includes/template.php','form/form_user',$data);

	}

	public function save ($id = null)
	{
		$data = array();

		$id_user = $id;

		if ( $id_user == null )
			$this->form_validation->set_rules('userName', 'nome do user', 'trim|required|min_length[5]|max_length[254]|is_unique[user.user_name]');
		else
			$this->form_validation->set_rules('userName', 'nome do user', 'trim|required|min_length[5]|max_length[254]|callback_is_unique_non_id['.$id_user.']'); //Caso seja um update, confere se o nome da categoria já não está em uso em outra categoria que não seja ela mesmo

		$this->form_validation->set_rules('userActive', 'ativo', 'trim|required|regex_match[/[01]/]');
		$this->form_validation->set_rules('userSenha2', 'senha', 'trim|required');
		$this->form_validation->set_rules('userSenha', 'senha', 'trim|required|matches[userSenha2]');

		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() == FALSE)
		{
			$data['errors'] = validation_errors(); //Se der erro em algum campo
		} else {

			$insert = array
					(
						'user_name' => $this->input->post('userName'),
						'user_password' => md5($this->input->post('userSenha'),
						'user_status' =>	$this->input->post('userActive')
					);

			if ( $id_user == null )
				$this->user_model->insert($insert);
			else
				$this->user_model->update($insert, $id_user);

		} //Fim condições

		header('Content-Type: application/json');
		echo json_encode($data);
		json_encode($data);

	}

}
