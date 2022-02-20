
@extends('_templates.admin')

@section('admin_content')
<div class="row">
  <!-- Content Header (Page header) -->
  <div class="col-lg-12 col-sm-12 col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Item</li>
        <li class="breadcrumb-item active" aria-current="page">Criar</li>
      </ol>
    </nav>
  </div>

  <div class='col-md-12 col-lg-12 col-sm-12 text-right mb-3'>
    <a class='btn btn-primary' href='{{ site_url('admin/item') }}'> Listar Item </a>
  </div>

  <div class="col-lg-12 col-sm-12 col-md-12">
		<div class="card">
			<div class="card-header">
        Criar/editar Categoria
      </div>

			<div class="card-body" style="">
				<div class="form-group mb-3">
				  <label for="categoryId">Classificação do Item</label>
					<?php echo $select_classificacao; ?>
				</div>

				<div class="form-group mb-3">
				  <label for="itemName">Nome do Item :</label>
				  <input type="text" value='@if(isset($edit_data)) {{ $edit_data[0]['item_name'] }} @endif' class="form-control" id="itemName"  name="itemName" placeholder="Nome da Classificação; será exibido nos campos de busca" maxlength='254'>

				</div>

				<div class="form-group mb-3">
					<label for="itemDescription">Descrição (Opcional)</label>
					<form>
						<textarea id="itemDescription" name="itemDescription" rows="10" cols="80">@if(isset($edit_data)) {{ $edit_data[0]['item_description'] }} @endif </textarea>
					</form>
				</div>

				<div class="form-group mb-3">
				  <label for="itemStatus">Ativo?</label>
					<select name='itemStatus' id='itemStatus' class="form-control">
						<option value='1' @if(isset($edit_data[0]['item_status']) && $edit_data[0]['item_status'] == 1) selected @endif>Ativo</option>
						<option value='0' @if(isset($edit_data[0]['item_status']) && $edit_data[0]['item_status'] == 0) selected @endif>Inativo</option>
					</select>
				</div>
			</div>

			<div class="card-footer text-right">
				<button type="submit" class="btn btn-primary" id="cadastrarCategoria">Cadastrar Classificação do item</button>
			</div>
		</div>
	</div>
@endsection

@section('admin_js')
	<script>

	  let editorData;

	  ClassicEditor
	  .create( document.querySelector( '#itemDescription' ) )
	  .then( editor => {
	    editorData = editor;
	  })
	  .catch( error => {
	    console.error( error );
	  });

		$('#cadastrarCategoria').on('click', function() {
			event.preventDefault();

			var data = new FormData();

			data.append ( "itemName" , $('#itemName').val());
			data.append ( "itemStatus" , $( "select#itemStatus option:checked" ).val());
			data.append ( "categoryItemId" , $( "select#categoryItemId option:checked" ).val());
			data.append ( "itemDescription" , editorData.getData() );

			//console.log($('#categoryImage')[0].files[0]);

			/* Faz a leitura das entradas de dado para conferência.
			for (var pair of data.entries()) {
				console.log(pair[0]+ ', ' + pair[1]);
			}*/

			var request = $.ajax({
				url: "@if(isset($edit_data[0])) {{ base_url('admin/item/save/'.$edit_data[0]['id_item']) }} @else {{ base_url('admin/item/save') }}  @endif",
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
							text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novas categorias',
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
