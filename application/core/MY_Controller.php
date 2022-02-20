<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use Philo\Blade\Blade;

class MY_Controller extends CI_Controller {

  protected $class_name;
  /**
  *@Blade
  */
  protected $blade;

  /**
  *$data Array
  */
  protected $data = [];

  /* Limit on query */
  protected $limit = 10;

  public function __construct(){
    parent::__construct();
    //initialize instance blade.
    $this->blade = new Blade(VIEWPATH, APPPATH.'/cache/');

  }

  /**
  * render view with Blade instance
  */
  protected function view($view, $data = [], $return = false){
    $this->data = array_merge($this->data, $data);
    $blview = $this->blade->view()->make($view, $this->data)->render();
    if(! $return )
       return print( $blview );
    return $blview;

  }

  public function uploadImage($file) {

    $insert = [];

    if(!is_dir("./upload/".$this->class_name))
      mkdir("./upload/".$this->class_name, 0777, TRUE);

    /* Envia o arquivo primeiro */
		$config['upload_path']          = "./upload/".$this->class_name;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['file_ext_tolower']     = true;
		$config['encrypt_name']        	= true;

    $this->upload->initialize($config);

    //var_dump($this->upload->do_upload($file));

		if ( $this->upload->do_upload($file) ) {
			$this->data['erro_upload'] = $this->upload->display_errors();
		} else {
			$success = ['upload_data' => $this->upload->data()];
    }

    var_dump($success);

    /* Caso não tenha dado erro no upload, adiciona o nome do arquivo no banco */
    if ( !isset($this->data['erro_upload']) )
      $insert['image']  = $success['upload_data']['file_name'];

    return $insert;
  }

  public function imageThumb ($image_path) {

      $config['image_library'] = 'gd2';
      $config['source_image'] = $image_path;
      $config['create_thumb'] = TRUE;
      $config['width']         = 400;

      $this->load->library('image_lib', $config);

      $this->image_lib->resize();
  }

  public function imageCrop ($image_path) {
      list($width, $height) = getimagesize($image_path);

      //$width = largura
      //$height = altura

      $config['image_library'] = 'gd2';
      $config['source_image'] = $image_path;
      $config['x_axis'] = 100;
      $config['y_axis'] = 60;

      $this->image_lib->initialize($config);

      if ( ! $this->image_lib->crop()) {
        echo $this->image_lib->display_errors();
      }

  }
}
