<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends MY_Controller {

	function __construct()
	{
		CI_Controller::__construct();
		$this->load->model('plan_model');
		$this->load->model('plantype_model');
	}
	
	public function index()
	{
		/* Configuração dos dados a serem pesquisados */
		$dados = array();
		
		/* Configuração da Paginação */
		$config['base_url'] = base_url('plan/index');
		$config["uri_segment"] = 3;
		$config['total_rows'] = $this->plan_model->record_count($dados); //Numero de resultados total da consulta
		$this->pagination->initialize($config); //Starta paginação
	
		$data['results'] = $this->plan_model->returnSql($dados);
		$data['pagination'] = 	$this->pagination->create_links();
        
		$this->template->load('_includes/admin_template.php','_admin/list/list_plan',$data);
		
	}
	
	public function create($id = null)
	{	
		$data = array();
		$id_plan_type = null;

		if ( $id != null )
        {
            $dados['id_plan'] = $id;
			$data['edit_data'] = $this->plan_model->returnSql($dados);

			$id_plan_type = $data['edit_data'][0]['plan_type_id'];
		}
		
		$data['select'] = $this->plantype_model->selectPlanType($data, $id_plan_type);
		
		$this->template->load('_includes/admin_template.php','_admin/form/form_plan',$data);
	}	

	public function save($id_plan = null)
	{
		$data = array();

		if ( $id_plan == null )
			$this->form_validation->set_rules('planName', 'Nome do Plano', 'trim|required|min_length[5]|max_length[254]|is_unique[plan.plan_name]');
        else
			$this->form_validation->set_rules('planName', 'Nome da Plano', 'trim|required|min_length[5]|max_length[254]|callback_is_unique_non_id['.$id_plan.']'); //Caso seja um update, confere se o nome da categoria já não está em uso em outra categoria que não seja ela mesmo
        
		$this->form_validation->set_rules('planActive', 'ativo', 'trim|required|regex_match[/[01]/]');

		$this->form_validation->set_error_delimiters('', '');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['errors'] = validation_errors(); //Se der erro em algum campo
		} else {	
			$insert = array
					( 
						'plan_name' => $this->input->post('planName'),
						'plan_status' => $this->input->post('planActive'),
						'plan_description' => $this->input->post('planDescription'),
						'plan_price' => $this->input->post('planPrice'),
						'plan_type_id' => $this->input->post('planTypeId')
					);
	
			if ( $id_plan == null )
				$this->plan_model->insert($insert);
			else 
				$this->plan_model->update($insert, $id_plan);

		} //Fim condições

		header('Content-Type: application/json');
		echo json_encode($data);
		json_encode($data);
	
	}

	public function is_unique_non_id($name, $id)
	{
		return $this->plan_model->is_unique_non_id($name, $id);	
	}

	public function changeStatus($id)
	{
		$resultado = $this->plan_model->changeStatus($id);

		header('Content-Type: application/json');
		json_encode($resultado);
		echo json_encode($resultado);

	}
}
