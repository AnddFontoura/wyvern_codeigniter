<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->model('subcategory_model');
		//$this->load->model('classificationitem_model');
		//$this->load->model('item_model');
	}

	public function index() {

		if ( $this->session->userdata('wyvern_user') != null && $this->session->userdata('wyvern_user') != 0 ) {
			$this->retrieveHome();
		} else {
			$this->view('login.index');
		}

	}

	public function dashboard()
	{
    $dados = array();

    $this->data['count_category'] = $this->category_model->record_count($dados);
    $this->data['count_subcategory'] = $this->subcategory_model->record_count($dados);
    $this->data['count_product'] = $this->product_model->record_count($dados);
  	//$this->data['count_classificationitem'] = $this->classificationitem_model->record_count($dados);
    //$this->data['count_item'] = $this->item_model->record_count($dados);

		$this->view('_admin.dashboard.index');

	}

}
