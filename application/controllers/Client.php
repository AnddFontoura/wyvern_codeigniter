<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

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
		$this->load->model('customer_model');
	}

	public function index()
	{
		//echo $_SESSION['client_user'];

		if ( isset ($_SESSION['wyvern_client_user']) && $_SESSION['wyvern_client_user'] != 0 ) 
		{
			$data = array();
			$dados = array();
		
			$this->template->load('_includes/client_template.php','_client/dashboard',$data);
		} else {
			$this->load->view('/_client/login');
		}
		
	}

	public function checkLogin()
	{
		$this->form_validation->set_rules('client_user', 'Login', 'trim|required|min_length[5]|max_length[15]');
		$this->form_validation->set_rules('client_password', 'Senha', 'trim|required|min_length[5]|max_length[15]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['errors'] = validation_errors(); //Se der erro em algum campo
			
			$this->load->view('/_client/login',$data);
		} else {
			
			/* Prepara os dados para consulta. */
			$data = array ( 
				'customer_login' => $this->input->post('client_user'), 
				'customer_password' => md5($this->input->post('client_password')), 
				'customer_status' => 1 
			);
			
			$return = $this->customer_model->returnSql($data);

			//var_dump($return);

			if ( is_array($return) && !empty($return) )
			{
				$_SESSION['wyvern_client_user'] = $return[0]['id_customer'];
				/* Direciona o usuario pro login */
				redirect('/client/index', 'refresh');
			} else {
				$data['errors'] = config_item('error_prefix')."<p>Login e/ou senha incorreto(s)".config_item('error_suffix'); 
				$this->load->view('/_client/login',$data);
			}
			
		}
	}

	public function logOut()
	{
		unset($_SESSION['wyvern_client_user']);
		session_destroy();
		redirect('/client/index', 'refresh');
	}

	public function order () {

		$this->load->model('order_model');
		
		$pesquisa = [
			'customer_id' => $_SESSION['wyvern_client_user'],
			'order_by' => ['order.status_id','desc']
		];

		$resultado['results'] = $this->order_model->returnSql($pesquisa);

		$this->template->load('_includes/client_template.php','_client/list/list_order',$resultado);
	}

	public function serviceOrderList ()
	{
		$this->load->model('serviceorder_model');

		$pesquisa['customer_id'] = $this->session->item('wyvern_client_user');

		$resultado = $this->serviceorder_model->returnSql($pesquisa);

		$this->template->load('_includes/client_template.php','_client/list/list_serviceorder',$resultado);

	}

	public function serviceOrderView ($id_service_order)
	{
		$this->load->model('serviceorder_model');

		if ( $this->session->item('wyvern_client_user') != null && !empty($this->session->item('wyvern_client_user')) )
			$pesquisa['customer_id'] = $this->session->item('wyvern_client_user');
		else 
		{
			//Caso não seja dentro da sessão, arrumar um jeito de deixar uma pessoa não logada ver
			//Minha ideia é colocar um get como validation, que vai por um md5 no nome da pessoa
			//e comparar com o retorno pra saber se é válido
		}

		$pesquisa['id_service_order'] = $id_service_order;

		$resultado = $this->serviceorder_model->returnSql($pesquisa);

		$this->template->load('_includes/client_template.php','_commons/view/view_serviceorder',$resultado); //De repente criar um _common onde ficarão todos os view comum a todo mundo... só acho
	}
}
