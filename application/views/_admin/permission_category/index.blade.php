
@extends('_templates.admin')

@section('admin_content')
<div class="row">
  <!-- Content Header (Page header) -->
  <div class="col-lg-12 col-sm-12 col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Permissão</li>
        <li class="breadcrumb-item active" aria-current="page">Lista</li>
      </ol>
    </nav>
  </div>

  <div class='col-md-12 col-lg-12 col-sm-12 text-right mb-3'>
    <a class='btn btn-primary' href='<?php echo site_url('admin/permissioncategory/create'); ?>'> Nova Categoria de Permissão </a>
  </div>

  <div class="col-lg-12 col-sm-12 col-md-12">
		<form role="form" id='searchPermission' method='GET' action="{{ base_url('admin/permission/index') }}">
			<div class="card">
				<div class="card-header">
          Ferramentas de Pesquisa
        </div>

				<div class="card-body" style="">
					<div class='row'>
						<div class="form-group col-md-4">
							<label for="permissionName">Id da Categoria:</label>
							<input type="text" value='<?php if ( isset ($search_data) ) { echo $search_data['id_permission_category']; } ?>' class="form-control" id="permissionCategoryId"  name="permissionId" placeholder="Pesquise a categoria pelo Id" maxlength='254'>
						</div>

						<div class="form-group col-md-4">
							<label for="permissionName">Nome da Categoria:</label>
							<input type="text" value='<?php if ( isset ($search_data) ) { echo $search_data['p_category_name']; } ?>' class="form-control" id="permissionCategoryName"  name="permissionName" placeholder="Pesquise a categoria pelo nome" maxlength='254'>
						</div>

						<div class="form-group col-md-4">
							<label for="permissionName">Status da Categoria</label>
							<select name='permissionCategoryStatus' id='permissionCategoryStatus' class="form-control">
								<option value='' >Qualquer status</option>
								<option value='1' <?php if ( isset ($search_data['p_category_status']) && $search_data['p_category_status'] == 1) { echo "selected"; } ?>>Ativo</option>
								<option value='0' <?php if ( isset ($search_data['p_category_status']) && $search_data['p_category_status'] == 0) { echo "selected"; } ?>>Inativo</option>
							</select>
						</div>

						<div class="form-group col-md-4">
							<label for="permissionName">Ordenar por</label>
							<select name='permissionCategoryOrderBy' id='permissionCategoryOrderBy' class="form-control">
								<option value='id_permission_category' <?php if ( isset ($search_data['permissionCategoryOrderBy']) && $search_data['permissionOrderBy'] === 'id_permission') { echo "selected"; } ?>>ID</option>
								<option value='p_category_name' <?php if ( isset ($search_data['permissionCategoryOrderBy']) && $search_data['permissionOrderBy'] === 'permission_name') { echo "selected"; } ?>>Nome</option>
                <option value='p_category_status' <?php if ( isset ($search_data['permissionCategoryOrderBy']) && $search_data['permissionOrderBy'] === 'subpermission_status') { echo "selected"; } ?>>Status</option>
              </select>
						</div>

						<div class="form-group col-md-4">
							<label for="permissionName">Ordenar de forma</label>
							<select name='permissionOrderAs' id='permissionOrderAs' class="form-control">
								<option value='asc' <?php if ( isset ($search_data['permissionCategoryOrderAs']) && $search_data['permissionOrderAs'] === "asc" ) { echo "selected"; } ?>>Crescente</option>
                <option value='desc' <?php if ( isset ($search_data['permissionCategoryOrderAs']) && $search_data['permissionOrderAs'] === "desc" ) { echo "selected"; } ?>>Decrescente</option>
							</select>
						</div>
          </div>
        </div>

				<div class="card-footer text-right">
					<input type="submit" class='btn btn-success' value='Pesquisar'>
				</div>
      </div>
		</form>
  </div>

  <div class="col-md-12 col-lg-12 col-sm-12 mt-3">
		@if ( empty($results) )
      <div class="alert alert-danger" role="alert">
        Nenhuma categoria de permissão cadastrada
      </div>
    @else
      <div class="row row-cols-1 row-cols-md-2">
	      @foreach ( $results as $dado_tabela )
          <div class="col mb-3">
            <div class="card h-100">
              <div class="card-header">
                ID: {{ $dado_tabela['id_permission_category'] }}
              </div>
              <div class="card-body">
                <div class='row'>
                  <div class='col-md-6 col-lg-6 col-sm-12'>
                    <p class="card-text"><small class="text-muted">Categoria da Permissão:</small></p>
                    <h5 class="card-title">{{ $dado_tabela['p_category_name'] }}</h5>
                  </div>

                  <div class='col-md-6 col-lg-6 col-sm-12'>
                    <p class="card-text"><small class="text-muted">Status:</small></p>
                    <h5 class="card-title @if($dado_tabela['p_category_status'] == 1) badge badge-success @else badge badge-danger @endif">@if($dado_tabela['p_category_status'] ==1) Ativo @else Inativo @endif  </h5>
                  </div>

                </div>
              </div>
              <div class="card-footer text-right">
                <div class='btn-group'><a class='btn btn-primary' href="{{ base_url('admin/permissioncategory/edit/'.$dado_tabela['id_permission_category']) }}"> Editar </a>
                  <button class="btn @if($dado_tabela['p_category_status'] == 0) btn-success @else btn-danger @endif" data-id="{{ $dado_tabela['id_permission_category'] }}" id="changeStatus"> @if($dado_tabela['p_category_status'] == 0) Ativar @else Inativar @endif </button>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>

  <div class="col-md-12 col-lg-12 col-sm-12 text-center">
		{{ $pagination }}
  </div>

</div>
@endsection

@section('admin_js')
<script>
  $('#changeStatus').on('click', function() {
    var id = $(this).data('id');

    Swal.fire({
      title: "Atenção!",
      text: "Você está prestes a mudar o status desse produto você tem certeza que deseja continuar?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, continuar'
    }).then((result) => {
      if (result.value) {
        var request = $.ajax({
          url: "{{ base_url('admin/permission/changeStatus/') }}"+id,
          method: "POST",
          data: { id : id },
          dataType: "json"
        });

        request.done(function() {
          Swal.fire({
            title: 'Pronto!',
            text: 'A alteração foi realizada com sucesso',
            type: 'success',
            buttons: true,
          })
          .then((buttonClick) => {
            if (buttonClick) {
              location.reload();
            }
          });
        });

        request.fail(function( ) {
          Swal.fire(
            'Erro',
            'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
            'error'
          )
        });
      } else if (result.dismiss === 'cancel') {
        Swal.fire(
          'Operação Cancelada',
          'Nenhuma alteração foi realizada.',
          'error'
        )
      }
    });
  });
</script>
@endsection
