@extends('_templates.admin')

@section('admin_content')
<div class="row">
  <!-- Content Header (Page header) -->
  <div class="col-lg-12 col-sm-12 col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Categoria do Item</li>
        <li class="breadcrumb-item active" aria-current="page">Lista</li>
      </ol>
    </nav>
  </div>

  <div class='col-md-12 col-lg-12 col-sm-12 text-right mb-3'>
    <a class='btn btn-primary' href='<?php echo site_url('admin/categoryitem/create'); ?>'> Nova Categoria de Item </a>
  </div>

  <div class="col-lg-12 col-sm-12 col-md-12">
	  <form role="form" id='searchproduct' method='GET' action="{{ base_url('admin/product/index') }}">
  		<div class="card">
  			<div class="card-header">
  				Ferramentas de Pesquisa
  			</div>

				<div class="card-body" style="">
					<div class='row'>
						<div class="form-group col-md-4">
							<label for="categoryName">Id da Categoria do Item:</label>
							<input type="text" value='@if(isset($search_data)) {{ $search_data['id_item'] }} @endif' class="form-control" id="itemId"  name="itemId" placeholder="Pesquise o item pelo Id" maxlength='254'>
						</div>

						<div class="form-group col-md-4">
							<label for="categoryName">Nome do Item:</label>
							<input type="text" value='@if(isset($search_data)) {{ $search_data['item_name'] }} @endif' class="form-control" id="itemName"  name="itemName" placeholder="Pesquise o item pelo nome" maxlength='254'>
						</div>

						<div class="form-group col-md-4">
							<label for="categoryName">Status do Item</label>
							<select name='categoryStatus' id='categoryStatus' class="form-control">
								<option value='' >Qualquer status</option>
								<option value='1' @if(isset($search_data['item_status']) && $search_data['item_status'] == 1) selected @endif>Ativo</option>
								<option value='0' @if(isset($search_data['item_status']) && $search_data['item_status'] == 0) selected @endif>Inativo</option>
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
        Nenhuma Categoria de Item cadastrada
      </div>
    @else
      <div class="row row-cols-1 row-cols-md-2">
	      @foreach ( $results as $dado_tabela )
          <div class="col mb-3">
            <div class="card h-100">
              <div class="card-header">
                ID: {{ $dado_tabela['id_category_item'] }}
              </div>
              <div class="card-body">
                <div class='row'>
                  <div class='col-md-6 col-lg-6 col-sm-12'>
                    <p class="card-text"><small class="text-muted">Categoria do item:</small></p>
                    <h5 class="card-title">{{ $dado_tabela['c_item_name'] }}</h5>
                  </div>

                  <div class='col-md-6 col-lg-6 col-sm-12'>
                    <p class="card-text"><small class="text-muted">Status:</small></p>
                    <h5 class="card-title @if($dado_tabela['c_item_status'] == 1) badge badge-success @else badge badge-danger @endif">@if($dado_tabela['c_item_status'] ==1) Ativo @else Inativo @endif  </h5>
                  </div>

                  <div class='col-md-12 col-lg-12 col-sm-12'>
                    <p class="card-text"><small class="text-muted">Descrição:</small></p>
                    <p class="card-text">{!! $dado_tabela['c_item_description'] !!}</p>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <div class='btn-group'>
                  <a class='btn btn-primary' href="{{ base_url('admin/categoryitem/edit/'.$dado_tabela['id_category_item']) }}"> Editar </a>
                  <button class="btn @if($dado_tabela['c_item_status'] == 0) btn-success @else btn-danger @endif" data-id="{{ $dado_tabela['id_category_item'] }}" id="changeStatus"> @if($dado_tabela['c_item_status'] == 0) Ativar @else Inativar @endif </button>
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
        text: "Você está prestes a mudar o status desse item, você tem certeza que deseja continuar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, continuar'
      }).then((result) => {
        if (result.value) {
          var request = $.ajax({
            url: "{{ base_url('admin/item/changeStatus/') }}"+id,
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
