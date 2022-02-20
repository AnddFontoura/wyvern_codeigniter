<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['per_page'] = 10;
$config['full_tag_open'] = "<ul class='pagination'>";
$config['full_tag_close'] = "</ul>";

/* Primeira página */
$config['first_link'] = "Primeira";
$config['first_tag_open'] = "<ul class='pagination'><li>";
$config['first_tag_close'] = "</li>";

/* Última página */
$config['last_link'] = "Última";
$config['last_tag_open'] = "<li>";
$config['last_tag_close'] = "</li></ul>";

/* Próxima página */
$config['next_link'] = "&gt;";
$config['next_tag_open'] = "<li>";
$config['next_tag_close'] = "</li>";

/* Anterior */
$config['prev_link'] = "&lt;";
$config['prev_tag_open'] = "<li>";
$config['prev_tag_close'] = "</li>";

/* Atual */
$config['cur_tag_open'] = "<li class='active'><a  href='#'>";
$config['cur_tag_close'] = "</a></li>";

/* Digitos */
$config['num_tag_open'] = "<li>";
$config['num_tag_close'] = "</li>";

$config['reuse_query_string'] = true;
$config['use_page_numbers'] = TRUE;
$config['attributes'] = array('class' => 'page-link');

?>
