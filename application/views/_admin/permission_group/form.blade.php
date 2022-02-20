
@extends('_templates.admin')

@section('admin_content')
<div class="row">
  <!-- Content Header (Page header) -->
  <div class="col-lg-12 col-sm-12 col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Permissões Grupo </li>
        <li class="breadcrumb-item active" aria-current="page">Criar</li>
      </ol>
    </nav>
  </div>

  <div class='col-md-12 col-lg-12 col-sm-12 text-right mb-3'>
    <a class='btn btn-primary' href="{{ site_url('admin/permissiongroup') }}"> Listar Grupo de Permissões </a>
  </div>

  <div class="col-lg-12 col-sm-12 col-md-12">
		<div class="card">
			<div class="card-header">
        Criar/editar Grupo Permissão
      </div>

			<div class="card-body" style="">
        <div class='row'>

  				<div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
  					<label for="permissionCategoryName">Nome do Grupo de Permissão: <i class='fa fa-question-circle' data-toggle="tooltip" data-placement="top" title="Nome que estará na pesquisa ou exibição"></i> </label>
  					<input type="text" value='@if(isset($edit_data)) {{ $edit_data[0]['p_group_name'] }} @endif' class="form-control" id="permissionGroupName"  name="permissionGroupName" placeholder="Nome da Permissão; será exibido nos campos de busca e menu" maxlength='254'>
  				</div>

  				<div class="form-group col-md-12 col-lg-12 col-sm-12 mb-3">
  					<label for="permission_status">Ativo? <i class='fa fa-question-circle' data-toggle="tooltip" data-placement="top" title="Categoria Inativa não será exibida em pesquisa em sua loja/site"></i> </label>
  					<select name='permissionGroupStatus' id='permissionGroupStatus' class="form-control">
  						<option value='1' @if(isset($edit_data['p_group_status']) && $edit_data['p_group_status'] == 1) selected @endif >Ativo</option>
  						<option value='0' @if(isset($edit_data['p_group_status']) && $edit_data['p_group_status'] == 0) selected @endif >Inativo</option>
  					</select>
  				</div>
        </div>
      </div>

			<div class="card-footer text-right">
				<button type="submit" class="btn btn-primary" id="cadastrarGrupoPermissao">Cadastrar Permissão</button>
			</div>
    </div>
  </div>
</div>
@endsection

@section('admin_js')
<script>

	$('#cadastrarPermissao').on('click', function() {
		event.preventDefault();

		var data = new FormData();

		data.append ( "permissionGroupStatus" , $( "select#permissionGroupStatus option:checked" ).val());
  	data.append ( "permissionGroupName" , $('#permissionGroupName').val());
		//console.log($('#categoryImage').files);

		/* Faz a leitura das entradas de dado para conferência.
		for (var pair of data.entries()) {
			console.log(pair+ ', ' + pair[1]);
		}*/

		var request = $.ajax({
			url: "@if(isset($edit_data)) {{ base_url('admin/permissiongroup/save/'.$edit_data[0]['id_permission']) }} @else {{ base_url('admin/permissiongroup/save') }}  @endif",
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
						text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novas Permissões',
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
