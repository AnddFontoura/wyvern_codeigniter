
@extends('_templates.admin')

@section('admin_content')
<div class="row">
  <!-- Content Header (Page header) -->
  <div class="col-lg-12 col-sm-12 col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Produto</li>
        <li class="breadcrumb-item" aria-current="page">Lista</li>
      </ol>
    </nav>
  </div>

  <div class='col-md-12 col-lg-12 col-sm-12 text-right mb-3'>
    <a class='btn btn-primary' href='<?php echo site_url('admin/product'); ?>'> Lista Produto </a>
  </div>

  <div class="col-lg-12 col-sm-12 col-md-12">

	</div>

  <div class="col-lg-6 col-sm-6 col-md-12 mt-3">
		<div class='card'>
			<div class='card-header'>
				Cadastrar Imagem
			</div>

			<div class='card-body'>
				<div class='row'>

					<div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
						<label for="productNick">Imagem: <span class='small'> (Opcional) </span></label>
						<input type="file" name='productImagePath' id='productImagePath' value='@if(isset($edit_data)) {{ $edit_data[0]['product_nickname'] }} @endif' class="form-control" id="exampleInputPassword1" placeholder="Nome do produto">
					</div>

          <div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
            <label for="productNick">Nome da imagem: <span class='small'> (Opcional) </span></label>
            <input type="text" name='productImageName' id='productImageName' value='@if(isset($edit_data)) {{ $edit_data[0]['product_nickname'] }} @endif' class="form-control" id="exampleInputPassword1" placeholder="Nome do produto">
          </div>

  				<div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
  					<label for="productDescription">Descrição da imagem <span class='small'> (Opcional) </span>: </label>
  					<form>
  						<textarea id="productImageDescription" name="productImageDescription" rows="10" cols="80">@if(isset($edit_data)) {{ $edit_data[0]['product_description'] }} @endif</textarea>
  					</form>
  				</div>

  				<div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
  					<label for="product_status">Ativo? <i class='fa fa-question-circle' data-toggle="tooltip" data-placement="top" title="Categoria Inativa não será exibida em pesquisa em sua loja/site"></i> </label>
  					<select name='productImageStatus' id='productImageStatus' class="form-control">
  						<option value='1' @if(isset($edit_data['product_status']) && $edit_data['product_status'] == 1) selected @endif >Ativo</option>
  						<option value='0' @if(isset($edit_data['product_status']) && $edit_data['product_status'] == 0) selected @endif >Inativo</option>
  					</select>
  				</div>

  				<div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
  					<label for="product_status">Principal? <i class='fa fa-question-circle' data-toggle="tooltip" data-placement="top" title="Categoria Inativa não será exibida em pesquisa em sua loja/site"></i> </label>
  					<select name='productImageMain' id='productImageMain' class="form-control">
						<option value='0' @if(isset($edit_data['product_status']) && $edit_data['product_status'] == 0) selected @endif >Não</option>
  						<option value='1' @if(isset($edit_data['product_status']) && $edit_data['product_status'] == 1) selected @endif >Sim</option>
  					</select>
  				</div>

  				<div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
  					<label for="product_status">Ordem <i class='fa fa-question-circle' data-toggle="tooltip" data-placement="top" title="Categoria Inativa não será exibida em pesquisa em sua loja/site"></i> </label>
						<input type="number" name='productImageNumber' id='productImageNumber' value='@if(isset($edit_data)) {{ $edit_data[0]['product_nickname'] }} @endif' class="form-control" id="exampleInputPassword1" placeholder="Ordem da imagem">
  				</div>

				</div>
			</div>

			<div class='card-footer text-right'>
				<div id="cadastrarImagem" class='btn btn-success'> Cadastrar Imagem </div>
			</div>
		</div>
	</div>

  <div class="col-md-6 col-lg-6 col-sm-12 mt-3">
		@if ( empty($produto_imagem) )
      <div class="alert alert-danger" role="alert">
        Nenhuma imagem cadastrada
      </div>
    @else
      <div class="row">
	      @foreach ( $produto_imagem as $dado_tabela )
          <div class="@if($dado_tabela['p_image_main'] == 1) col-md-12 @else col-md-4 @endif col-lg-12 col-sm-12">
						<a href="image_2.jpg" data-fancybox="gallery" data-caption="Caption #2">
							<img src="thumbnail_2.jpg" alt="" />
						</a>

						<div class="btn-dock">
							<div class='btn-group'>
								<a class='btn btn-secondary' href="{{ base_url('admin/item/edit/'.$dado_tabela['id_product']) }}"> Itens </a>
								<a class='btn btn-warning' href="{{ base_url('admin/productimage/view/'.$dado_tabela['id_product']) }}"> Imagens </a>
								<a class='btn btn-primary' href="{{ base_url('admin/product/edit/'.$dado_tabela['id_product']) }}"> Editar </a>
								<button class="btn @if($dado_tabela['product_status'] == 0) btn-success @else btn-danger @endif" data-id="{{ $dado_tabela['id_product'] }}" id="changeStatus"> @if($dado_tabela['product_status'] == 0) Ativar @else Inativar @endif </button>
							</div>
						</div>
					</div>
        @endforeach
      </div>
    @endif
  </div>

</div>
@endsection

@section('admin_js')
<script>

  let editorData;

  ClassicEditor
	  .create( document.querySelector( '#productImageDescription' ) )
	  .then( editor => {
	    editorData = editor;
      console.log(editorData);
	  })
	  .catch( error => {
	    console.error( error );
	  });

	$('#cadastrarProduto').on('click', function() {
		event.preventDefault();

		var data = new FormData();

  	data.append ( "productImagePath", $( "sproductImagePath" ).files);
  	data.append ( "productImageName", $('#productImageName').val());
  	data.append ( "productImageNumber", $('#productImageNumber').val());
  	data.append ( "productImageDescription",  editorData.getData() );
  	data.append ( "productImageStatus", $( "select#productImageStatus option:checked" ).val());
  	data.append ( "productImageMain", $( "select#productImageMain option:checked" ).val());

		//console.log($('#categoryImage').files);

		/* Faz a leitura das entradas de dado para conferência.
		for (var pair of data.entries()) {
			console.log(pair+ ', ' + pair[1]);
		}*/

		var request = $.ajax({
			url: "@if(isset($edit_data)) {{ base_url('admin/product/save/'.$edit_data[0]['id_product']) }} @else {{ base_url('admin/product/save') }}  @endif",
			method: "POST",
			data: data,
			dataType: "json",

			/* Upload Process */
			cache: false,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType

			beforeSend: function() {
				Swal.fire({
					title: 'Aguarde',
					text: 'Gravando seus dados',
					icon: 'warning',
					showConfirmButton: false
				})
			},

			success: function(data){

				if ( typeof data['errors'] !== 'undefined' )
				{
					Swal.fire({
						title: 'Problema Encontrado',
						text: data['errors'],
						type: 'error'
					})
				} else {
					Swal.fire({
						title: 'Pronto!',
						text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novas imagens ao seu produto',
						icon: 'success',
						buttons: true,
					})
					.then((buttonClick) => {
						if (buttonClick) {
						  location.reload();
						}
					});
				}
			},

			error: function(data) {
				Swal.fire(
				  'Erro',
				  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
				  'error'
				)
			}
		});
	});

</script>
@endsection
