<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {

	public function category() {

		$this->load->model('category_model');
		/* Filtros */
		$dados['category_status'] = $this->input->post('categoryStatus');
		$dados['id_category'] = $this->input->post('categoryId');
		$dados['category_name'] = $this->input->post('categoryName');
		$dados['categoryOrderBy'] = $this->input->post('categoryOrderBy');
		$dados['categoryOrderAs'] = $this->input->post('categoryOrderAs');
		$dados['order_by'] = $this->input->post('categoryOrderBy')." ".$this->input->get('categoryOrderAs');

		$data['results'] = $this->category_model->returnSql($dados);

		header('Content-Type: application/json');
		echo json_encode($data);
		json_encode($data);
	}

	public function subcategory() {

		$this->load->model('subcategory_model');
		/* Filtros */
		$dados['category_status'] = $this->input->get('categoryStatus');
		$dados['id_category'] = $this->input->get('categoryId');
		$dados['category_name'] = $this->input->get('categoryName');
		$dados['subcategory_status'] = $this->input->get('subCategoryStatus');
		$dados['id_subcategory'] = $this->input->get('subCategoryId');
		$dados['subcategory_name'] = $this->input->get('subCategoryName');
		$dados['order_by'] = $this->input->get('categoryOrderBy')." ".$this->input->get('categoryOrderAs');

		$data['results'] = $this->subcategory_model->returnSql($dados);
		header('Content-Type: application/json');
		echo json_encode($data);
		json_encode($data);

	}

}

?>
