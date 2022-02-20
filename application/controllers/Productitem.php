<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productitem extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('productimage_model');
		$this->load->model('productitem_model');
		$this->load->model('category_model');
		$this->load->model('subcategory_model');
		$this->load->model('categoryitem_model');
		$this->load->model('item_model');
	}

	public function index()
	{
		/* Configuração dos dados a serem pesquisados */
		$pagina = $this->uri->segment(3);

		if ( $pagina > 0)
			$pagina = $pagina*$this->limit;

		/* Filtros */
		$dados['id_product'] = $this->input->get('productId');
		$dados['product_status'] = $this->input->get('productStatus');
		$dados['product_name'] = $this->input->get('productName');
		$dados['categoryOrderBy'] = $this->input->get('categoryOrderBy');
		$dados['categoryOrderAs'] = $this->input->get('categoryOrderAs');
		$dados['order_by'] = $this->input->get('categoryOrderBy')." ".$this->input->get('categoryOrderAs');


		/* Configuração da Paginação */
		$config['base_url'] = base_url('product/index');
		$config["uri_segment"] = 3;
		$config['total_rows'] = $this->product_model->record_count($dados); //Numero de resultados total da consulta
		$this->pagination->initialize($config); //Starta paginação

		if ( $pagina == 0 )
			$dados['limit'] = $this->limit;
		else
			$dados['limit'] = array($pagina,$this->limit);

		$this->data['results'] = $this->product_model->returnSql($dados);
		$this->data['pagination'] = 	$this->pagination->create_links();

		$this->view('_admin.product.index');
		//$this->template->load('_includes/admin_template.php','_admin/list/list_product',$this->data);

	}

	public function create($id = null)
	{
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

	public function save ($id_produto = null)
	{
		$this->data = array();

		if ( $id_produto == null )
			$this->form_validation->set_rules('productName', 'nome do Produto', 'trim|required|min_length[5]|max_length[254]|is_unique[product.product_name]');
		else
			$this->form_validation->set_rules('productName', 'nome do Produto', 'trim|required|min_length[5]|max_length[254]|callback_is_unique_non_id['.$id_produto.']'); //Caso seja um update, confere se o nome da categoria já não está em uso em outra categoria que não seja ela mesmo

		$this->form_validation->set_rules('productStatus', 'ativo', 'trim|required|regex_match[/[01]/]');

		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['errors'] = validation_errors(); //Se der erro em algum campo
		} else {

			$insert = array
					(
						'product_name' => $this->input->post('productName'),
						'subcategory_id' => $this->input->post('subCategoryId'),
						'product_status' => $this->input->post('productStatus'),
						'product_nickname' => $this->input->post('productNick'),
						'product_keyword' => $this->input->post('productKeyword'),
						'product_price' => $this->input->post('productValue'),
						'product_promotion_price' => $this->input->post('productPromotionValue'),
						'product_description' => $this->input->post('productDescription'),
						'product_width' => $this->input->post('productWidth'),
						'product_height' => $this->input->post('productHeight'),
						'product_depth' => $this->input->post('productDepth'),
						'product_weight' => $this->input->post('productWeight'),
						'product_storage' => $this->input->post('productStorage'),
						'product_featured' => $this->input->post('productFeatured')
					);

			if ( $id_produto == null )
				$this->product_model->insert($insert);
			else
				$this->product_model->update($insert, $id_produto);

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
