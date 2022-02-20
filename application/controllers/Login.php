<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index() {

		if ( $this->session->userdata('wyvern_user') != null && $this->session->userdata('wyvern_user') != 0 ) {
			$this->retrieveHome();
		} else {
			$this->view('login.index');
		}

	}

	public function checkLogin() {
		$this->form_validation->set_rules('login_text', 'Login', 'trim|required|min_length[5]|max_length[15]');
		$this->form_validation->set_rules('passw_text', 'Senha', 'trim|required|min_length[5]|max_length[15]');

		if ($this->form_validation->run() == FALSE) {
			$this->data['errors'] = validation_errors(); //Se der erro em algum campo
			$this->view('login.index');
		} else {

			/* Prepara os dados para consulta. */
			$data = array (
				'user_name' => $this->input->post('login_text'),
				'user_password' => md5($this->input->post('passw_text')),
				'user_status' => 1
			);

			$return = $this->user_model->returnSql($data);

			if ( is_array($return) && !empty($return)) {
				/* Caso tenha achado um usuario. */

				$id_session = session_id();
				$this->session->set_userdata('session_id', $id_session);
				$this->session->set_userdata('wyvern_user', $return[0]['id_user']);

				$this->user_model->update(['user_last_session' => $id_session], $return[0]['id_user']);

				$this->retrieveHome($return[0]['user_type_id']);

			} else {
				$this->data['errors'] = "<ul> <li> Login e/ou senha incorreto(s) <ul> <li>";
				$this->view('login.index');
			}

		}
	}

	public function logout() {
		unset($_SESSION['wyvern_user']);
		unset($_SESSION['wyvern_user_permission']);
		unset($_SESSION['session_id']);
		session_destroy();
		redirect('/login/index', 'refresh');
	}

	public function retrieveHome ( $type = null ) {

		if ( $type != null ) {
			switch($type) {
				case 1: //Case Developer
				case 2: //Case Admin
				case 3: //Case Manager
				case 4: //Case Employee
				case 5: //Case Service Provider
					redirect("/admin/dashboard");
				case 9: //Case Client
					redirect("/client/dashboard");
					break;
			}
		} else {
			$data['id_user'] = $this->session->userdata('wyvern_user');
			$data['user_last_session'] = $this->session->userdata('session_id');

			$cli = $this->user_model->returnSql($data);

			if ( is_array($cli) && !empty($cli)) {
				$this->retrieveHome($return[0]['user_type_id']);
			} else {
				$this->data['errors'] = "<ul> <li> Houve um problema de permissão, favor logar novamente <ul> <li>";
				$this->view('login.index');
			}

		}
	}
}

?>
