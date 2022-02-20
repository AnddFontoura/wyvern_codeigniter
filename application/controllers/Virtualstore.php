<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Virtualstore extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('subcategory_model');
		$this->load->model('item_model');
		$this->load->model('categoryitem_model');
		$this->load->model('product_model');
		$this->load->model('productimage_model');
		//$this->load->model('producthasitem_model');
	}

  public function index() {
    $this->data = array();

    $search_category['category_status'] = 1;
    $this->data['category'] = $this->category_model->returnSql($search_category);

    $search_subcategory['subcategory_status'] = 1;
    $this->data['subcategory'] = $this->subcategory_model->returnSql($search_category);

    $search_product['product_status'] = 1;
    $search_product['product_featured'] = 1;
    $this->data['product'] = $this->product_model->returnSql($search_product);

    if ( !empty($this->data['product']) ) {
      for ($i = 0; $i < sizeof($this->data['product']); $i++) {
        $search_image['product_id'] = $this->data['product'][$i]['id_product'];
        $search_image['p_image_status'] = 1;
        $search_image['limit'] = 1;
        $search_image['order_by'] = array( 'p_image_main','desc');
        $temp_data = $this->productimage_model->returnSql($search_image);

        if (!empty($temp_data))
          $this->data['product'][$i]['image_info'] = $temp_data[0];
      }
    }

    $this->view('_site.store.home');
    //$this->template->load('_includes/site_template.php','_site/main_page',$this->data);

  }

  public function productCategory($id_category) {

  }

  public function productSubCategory($id_sub_category) {

  }

  public function productPage($id_product) {
    $this->data = array();

    $search_product = array(
      'id_product' => $id_product,
      'product_status' => 1
    );

    $this->data['product'] = $this->product_model->returnSql($search_product);

    if ( !empty($this->data['product']) )
    {
      //Adiciona as imagens do produto.
      for ($i = 0; $i < sizeof($this->data['product']); $i++)
      {
        $search_image = array (
          'product_id' => $this->data['product'][$i]['id_product'],
          'p_image_status' => 1,
          //'limit' => 1,
          'order_by' => array( 'p_image_main','desc')
        );

        $temp_data = $this->productimage_model->returnSql($search_image);

        if  ( !empty($temp_data))
          $this->data['product'][$i]['image_info'] = $temp_data;
      }

      $this->data['item_info'] = array();

      for ( $i = 0; $i < sizeof($this->data['product']); $i++)
      {
        $search_item = array (
          'product_id' => $this->data['product'][$i]['id_product'],
          //'limit' => 1,
          'order_by' => array( 'classification_item_id','desc')
        );

        $temp_data = $this->producthasitem_model->returnSql($search_item);

        if ( !empty($temp_data) )
          $this->data['item_info'] = $temp_data;
      }
    }

    $this->view('_site.store.product');
    //$this->template->load('_includes/site_template.php','_site/product_page',$this->data);
  }


}
