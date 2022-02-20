<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

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
    
    public function test() //Work
	{

        $config['protocol'] = 'smtp';
        $config['charset'] = 'iso-8859-1';
        $config['smtp_host'] = 	"smtp.hostinger.com.br";
        $config['smtp_user'] = 	"contato@fontouradesenvolvimento.com.br";
        $config['smtp_pass'] = 	"f6cqby9326";
        $config['smtp_port'] = 	465;
        $config['smtp_crypto'] = 	"ssl";

        $this->email->initialize($config);
        
        $this->email->from('contato@fontouradesenvolvimento.com.br', 'Andre Fontoura');
        $this->email->to('andd.fontoura@hotmail.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();
    }
    
}
