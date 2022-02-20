<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pedidos
        <small>Lista de Pedidos</small>
      </h1>
 
    </section>
	 <!-- Main content -->
    <section class="content">
  
   <div class="row">
        <div class="col-md-12">
		<!-- general form elements -->
			<div class="box box-default color-palette-box">
				<div class="box-header with-border">
					<div class="btn-group pull-right">
						<a class='btn btn-primary' href='<?php echo site_url('cliente/orderCreate'); ?>'> Novo Pedido </a>		
					</div>
				</div>
				
				<div class="box-body">
					<table class='table table-bordered table-striped'>
						<tr>
							<th>ID</th>
							<th>Data do Pedido</th>
							<th>Status do Pedido</th>
							<th>Opções</th>
						</tr>
					<?php
						$i = 1;
						foreach ( $results as $dado_tabela )
						{
							echo 
							"
								<tr>
									<td>{$dado_tabela['id_order']}</td>
									<td>{$dado_tabela['order_date']}</td>
									<td>{$dado_tabela['status_name']}</td>
									<td>
										<div class='btn-group'>
											<a class='btn btn-default' href='".site_url('order/show/'.$dado_tabela['id_product'])."' data-toggle='tooltip' title='{$dado_tabela['id_order']}'> Detalhes do Pedido </a> 
											<a class='btn btn-info' href='".site_url('product/createImage/'.$dado_tabela['id_product'])."'> Galeria de Imagens </a> 
											<a class='btn btn-warning' href='".site_url('product/createItens/'.$dado_tabela['id_product'])."'> Itens do Produto </a> 
											<a class='btn btn-primary' href='".site_url('product/create/'.$dado_tabela['id_product'])."'> Editar </a> 
							";
							
							if ( $dado_tabela['product_status'] == 0 )
							{
								echo "<button class='btn btn-success'  onClick='return dialogActive(\"Você tem certeza?\",\"Você está prestes a ativar esse item, deseja continuar?\",\"warning\",\"".site_url("item/changeStatus/".$dado_tabela['id_product'])." \");'> Ativar </button> ";
							} else {
								echo "<button class='btn btn-danger' onClick='return dialogActive(\"Você tem certeza?\",\"Você está prestes a inativar esse item, deseja continuar?\",\"warning\",\"".site_url("item/changeStatus/".$dado_tabela['id_product'])." \");'> Inativar </button> ";
							}								
							
							
							echo 
							"			</div>
									</td>
								</tr>
							
							";
							
							$i++;
						}
					?>
					</table>
				</div>
				
				<div class='box-footer'>
					<?php echo $pagination; ?>
				</div>
			</div>
		</div>
		
	</div>
