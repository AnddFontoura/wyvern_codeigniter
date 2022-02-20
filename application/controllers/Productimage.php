<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productimage extends MY_Controller {

	/*
	* $route['admin/productimage/view/(:num)'] 									= 'productimage/view/$1';
	* $route['admin/productimage/create/(:num)']								= 'productimage/create/$1';
	* $route['admin/productimage/edit/(:num)/(:num)'] 					= 'productimage/create/$1/$2';
	* $route['admin/productimage/save/(:num)'] 									= 'productimage/save/$1';
	* $route['admin/productimage/save/(:num)/(:num)'] 					= 'productimage/save/$1/$2';
	* $route['admin/productimage/changeStatus/(:num)'] 					= 'productimage/changeStatus/$1';
	*/
	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('productimage_model');
	}

	/*
	* View exibe uns detalhes do produto e as imagens desse produto, com form para adicionar ou remover
	* $route['admin/productimage/view/(:num)'] 									= 'productimage/view/$1';
	*/
	public function view_image($id_product) {
		if ($id_product) {
			$this->data['produto'] = $this->product_model->returnSql(['id_product' => $id_product]);

			if ( count($this->data['produto']) > 0 ) {
				$this->data['produto_imagem'] = $this->productimage_model->returnSql([
					'product_id' => $id_product,
					'order_by' => ' product_image.p_image_main desc, product_image.order asc'
				]);
			}

			$this->view('_admin.product.image.view');
		}
	}
	/*
	* $route['admin/productimage/view/(:num)'] 									= 'productimage/view/$1';
	* $route['admin/productimage/create/(:num)']								= 'productimage/create/$1';
	* $route['admin/productimage/edit/(:num)/(:num)'] 					= 'productimage/create/$1/$2';
	* $route['admin/productimage/save/(:num)'] 									= 'productimage/save/$1';
	* $route['admin/productimage/save/(:num)/(:num)'] 					= 'productimage/save/$1/$2';
	* $route['admin/productimage/changeStatus/(:num)'] 					= 'productimage/changeStatus/$1';
	*/

	/*
	* Create
	* $route['admin/productimage/create/(:num)']								= 'productimage/create/$1';
	*/
	public function create($id_product, $id_product_image = null) {
		$id_subcategoria = null;
		$dados = [];

		if ( $id != null ) {
      $dados['id_product'] = $id;
			$this->data['edit_data'] = $this->product_model->returnSql($dados);
			$id_subcategoria = $this->data['edit_data'][0]['subcategory_id'];
    }

		$this->data['select_subcategory'] = $this->subcategory_model->selectSubCategory($dados, $id_subcategoria);

		$this->view('_admin.product.form');
	}

	public function save ($id_product_image = null) {

		$this->data = array();
		$this->form_validation->set_rules('productImageStatus', 'ativo', 'trim|required|regex_match[/[01]/]');

		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['errors'] = validation_errors(); //Se der erro em algum campo
		} else {

			$insert = [
				'p_image_path' => $this->input->post("productImagePath"),
				'p_image_name' => $this->input->post("productImageName"),
				'p_image_order' => $this->input->post("productImageNumber"),
				'p_image_description' => $this->input->post("productImageDescription"),
				'p_image_status' => $this->input->post("productImageStatus"),
				'p_image_main' => $this->input->post("productImageMain"),
			];

			if ( $id_produto == null )
				$this->productimage_model->insert($insert);
			else
				$this->productimage_model->update($insert, $id_product_image);

		} //Fim condições

		header('Content-Type: application/json');
		echo json_encode($this->data);
		json_encode($this->data);

	}

	public function changeStatusProduct ($id = null)
	{
		$resultado = $this->product_model->changeStatus($id);

		header('Content-Type: application/json');
		json_encode($resultado);
		echo json_encode($resultado);

	}

	public function is_unique_non_id($name, $id)
	{
		return $this->product_model->is_unique_non_id($name, $id);
	}

	public function createImage($id_product = null, $id_product_image = null)
	{
		$this->data = array();

		if ( $id_product != null )
        {
			$dados['id_product'] = $id_product;
			$dados['product_id'] = $id_product;
			$dados['p_image_status'] = 1;
			$this->data['product_data'] = $this->product_model->returnSql($dados);
			$this->data['product_images'] = $this->productimage_model->returnSql($dados);
		}

		if ( $id_product_image != null)
			$this->data['image_edit'] = $this->productimage_model->returnSql(['id_product_image' => $id_product_image]);

		$this->template->load('_includes/admin_template.php','_admin/form/form_product_image',$this->data);
	}

}
