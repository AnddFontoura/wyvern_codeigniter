<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*

	Helper Fontoura

*/


	function showCategory ( )
	{
		$ci=& get_instance();
		$ci->load->database();
		$ci->load->model('category_model');

		$filtro = array(
			'category_status' => 1,
			'order_by' => "category_name asc"
		);

		$data = $ci->category_model->returnSql($filtro);

		echo "
		<div class='list-group'>
			<button type='button' class='list-group-item list-group-item-action active'>
				Categorias
			</button>
		";
		for ( $i = 0; $i < sizeof($data); $i++)
		{
			echo "
				<a class='list-group-item list-group-item-action' href='".base_url('loja/categoria/'.$data[$i]['id_category'])."'>{$data[$i]['category_name']}</a>
			";
		}
		echo "</div>";
	}

?>
