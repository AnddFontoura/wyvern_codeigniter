
@extends('_templates.admin')

@section('admin_content')
<div class="row">
  <!-- Content Header (Page header) -->
  <div class="col-lg-12 col-sm-12 col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Produto </li>
        <li class="breadcrumb-item active" aria-current="page">Criar</li>
      </ol>
    </nav>
  </div>

  <div class='col-md-12 col-lg-12 col-sm-12 text-right mb-3'>
    <a class='btn btn-primary' href="{{ site_url('admin/product') }}"> Listar Produtos </a>
  </div>

  <div class="col-lg-12 col-sm-12 col-md-12">
		<div class="card">
			<div class="card-header">
        Criar/editar Produto
      </div>

			<div class="card-body" style="">
        <div class='row'>
          <div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
            <label for="categoryId">Sub Categoria</label>
            {!! $select_subcategory !!}
          </div>

  				<div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
  					<label for="productName">Nome do Produto: <i class='fa fa-question-circle' data-toggle="tooltip" data-placement="top" title="Nome que estará na pesquisa ou exibição"></i> </label>
  					<input type="text" value='@if(isset($edit_data)) {{ $edit_data[0]['product_name'] }} @endif' class="form-control" id="productName"  name="productName" placeholder="Nome do Produto; será exibido nos campos de busca e menu" maxlength='254'>
  				</div>

          <div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
            <label for="productNick">Apelido: <span class='small'> (Opcional) </span></label>
            <input type="text" name='productNick' id='productNick' value='@if(isset($edit_data)) {{ $edit_data[0]['product_nickname'] }} @endif' class="form-control" id="exampleInputPassword1" placeholder="Nome do produto">
          </div>

  				<div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
  					<label for="productDescription">Descrição <span class='small'> (Opcional) </span>: </label>
  					<form>
  						<textarea id="productDescription" name="productDescription" rows="10" cols="80">@if(isset($edit_data)) {{ $edit_data[0]['product_description'] }} @endif</textarea>
  					</form>
  				</div>

  				<div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
  					<label for="productKeyword">Palavras chave: <span class='small'> (Opcional) </span> </label> <button class='btn btn-sm btn-danger' data-toggle="tooltip" data-placement="top" data-html='true' title="Não é necessário colocar vírgula ou ponto, apenas espaço entre os nomes" > ? </button>

  					<form>
  						<textarea class='form-control' id="productKeyword" name="productKeyword" rows="3" >@if(isset($edit_data)) {{ $edit_data[0]['product_keyword'] }} @endif</textarea>
  					</form>

  				</div>

          <div class="form-group  col-md-6 col-lg-6 col-sm-12 mb-3">
            <label for="">Valor <span class='small'> (Opcional) </span></label>
            <input type="text" name='productValue' value='@if(isset($edit_data)) {{ $edit_data[0]['product_price'] }} @endif' class="form-control" id="productValue" placeholder="Utilize apenas números, separe por vírgula as casas decimais">
          </div>

          <div class="form-group  col-md-6 col-lg-6 col-sm-12 mb-3">
            <label for="">Valor Promocional <span class='small'> (Opcional) </span></label>
            <input type="text" name='productValue' value='@if(isset($edit_data)) {{ $edit_data[0]['product_promotion_price'] }} @endif' class="form-control" id="productPromotionValue" placeholder="Utilize apenas números, separe por vírgula as casas decimais">
          </div>

          <div class="form-group  col-md-4 col-lg-4 col-sm-12 mb-3">
            <label for="">Largura <span class='small'> (Opcional) </span></label>
            <input type="text" name='productWidth' value='@if(isset($edit_data)) {{ $edit_data[0]['product_width'] }} @endif' class="form-control" id="productWidth" placeholder="Utilize apenas números, separe por vírgula as casas decimais">
          </div>

          <div class="form-group  col-md-4 col-lg-4 col-sm-12 mb-3">
            <label for="">Altura <span class='small'> (Opcional) </span></label>
            <input type="text" name='productHeight' value='@if(isset($edit_data)) {{ $edit_data[0]['product_height'] }} @endif' class="form-control" id="productHeight" placeholder="Utilize apenas números, separe por vírgula as casas decimais">
          </div>

          <div class="form-group  col-md-4 col-lg-4 col-sm-12 mb-3">
            <label for="">Profundidade <span class='small'> (Opcional) </span></label>
            <input type="text" name='productDepth' value='@if(isset($edit_data)) {{ $edit_data[0]['product_depth'] }} @endif' class="form-control" id="productDepth" placeholder="Utilize apenas números, separe por vírgula as casas decimais">
          </div>

          <div class="form-group  col-md-6 col-lg-6 col-sm-12 mb-3">
            <label for="">Peso <span class='small'> (Opcional) </span></label>
            <input type="text" name='productWeight' value='<?php if ( isset ($edit_data) ) { echo $edit_data[0]['product_weight']; } ?>' class="form-control" id="productWeight" placeholder="Utilize apenas números, separe por vírgula as casas decimais">
          </div>

          <div class="form-group  col-md-6 col-lg-6 col-sm-12 mb-3">
            <label for="">Quantidade em Estoque <span class='small'> (Opcional) </span></label>
            <input type="text" name='productWeight' value="@if(isset($edit_data)) {{ $edit_data[0]['product_storage'] }} @endif" class="form-control" id="productStorage" placeholder="Utilize apenas números, separe por vírgula as casas decimais">
          </div>

          <div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
            <label for="">Produto em Destaque? <span class='small'> (Opcional) </span></label>
            <select name='productFeatured' id='productFeatured' class="form-control">
              <option value='1' @if(isset($edit_data['product_featured']) && $edit_data['product_featured'] == 1) selected @endif>Sim</option>
              <option value='0' @if(isset($edit_data['product_featured']) && $edit_data['product_featured'] == 0) selected @endif>Não</option>
            </select>
          </div>

  				<div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
  					<label for="product_status">Ativo? <i class='fa fa-question-circle' data-toggle="tooltip" data-placement="top" title="Categoria Inativa não será exibida em pesquisa em sua loja/site"></i> </label>
  					<select name='productStatus' id='productStatus' class="form-control">
  						<option value='1' @if(isset($edit_data['product_status']) && $edit_data['product_status'] == 1) selected @endif >Ativo</option>
  						<option value='0' @if(isset($edit_data['product_status']) && $edit_data['product_status'] == 0) selected @endif >Inativo</option>
  					</select>
  				</div>
        </div>
      </div>

			<div class="card-footer text-right">
				<button type="submit" class="btn btn-primary" id="cadastrarProduto">Cadastrar Produto</button>
			</div>
    </div>
  </div>
</div>
@endsection

@section('admin_js')
<script>

  let editorData;

  ClassicEditor
	  .create( document.querySelector( '#productDescription' ) )
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

  	data.append ( "subCategoryId" , $( "select#subCategoryId option:checked" ).val());
  	data.append ( "productName" , $('#productName').val());
  	data.append ( "productNick" , $('#productNick').val());
  	data.append ( "productDescription" ,  editorData.getData() );
  	data.append ( "productKeyword" , $('#productKeyword').val() );
  	data.append ( "productValue" , $('#productValue').val());
  	data.append ( "productPromotionValue" , $('#productPromotionValue').val());
  	data.append ( "productStatus" , $( "select#productStatus option:checked" ).val());
  	data.append ( "productFeatured" , $( "select#productFeatured option:checked" ).val());
  	data.append ( "productWeight" , $('#productWeight').val());
  	data.append ( "productHeight" , $('#productHeight').val());
  	data.append ( "productWidth" , $('#productWidth').val());
  	data.append ( "productDepth" , $('#productDepth').val());
  	data.append ( "productStorage" , $('#productStorage').val());

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
						text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novos Produtos',
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
