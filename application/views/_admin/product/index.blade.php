
@extends('_templates.admin')

@section('admin_content')
<div class="row">
  <!-- Content Header (Page header) -->
  <div class="col-lg-12 col-sm-12 col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Produto</li>
        <li class="breadcrumb-item active" aria-current="page">Lista</li>
      </ol>
    </nav>
  </div>

  <div class='col-md-12 col-lg-12 col-sm-12 text-right mb-3'>
    <a class='btn btn-primary' href='<?php echo site_url('admin/product/create'); ?>'> Novo Produto </a>
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
							<label for="productName">Id do Produto:</label>
							<input type="text" value='<?php if ( isset ($search_data) ) { echo $search_data['id_product']; } ?>' class="form-control" id="productId"  name="productId" placeholder="Pesquise o produto pelo Id" maxlength='254'>
						</div>

						<div class="form-group col-md-4">
							<label for="productName">Nome do Produto:</label>
							<input type="text" value='<?php if ( isset ($search_data) ) { echo $search_data['product_name']; } ?>' class="form-control" id="productName"  name="productName" placeholder="Pesquise o produto pelo nome" maxlength='254'>
						</div>

						<div class="form-group col-md-4">
							<label for="productName">Status do Produto</label>
							<select name='productStatus' id='productStatus' class="form-control">
								<option value='' >Qualquer status</option>
								<option value='1' <?php if ( isset ($search_data['product_status']) && $search_data['product_status'] == 1) { echo "selected"; } ?>>Ativo</option>
								<option value='0' <?php if ( isset ($search_data['product_status']) && $search_data['product_status'] === 0) { echo "selected"; } ?>>Inativo</option>
							</select>
						</div>

						<div class="form-group col-md-4">
							<label for="productName">Ordenar por</label>
							<select name='productOrderBy' id='productOrderBy' class="form-control">
								<option value='id_product' <?php if ( isset ($search_data['productOrderBy']) && $search_data['productOrderBy'] === 'id_product') { echo "selected"; } ?>>ID</option>
								<option value='product_name' <?php if ( isset ($search_data['productOrderBy']) && $search_data['productOrderBy'] === 'product_name') { echo "selected"; } ?>>Nome</option>
                <option value='product_status' <?php if ( isset ($search_data['productOrderBy']) && $search_data['productOrderBy'] === 'subproduct_status') { echo "selected"; } ?>>Status</option>
              </select>
						</div>

						<div class="form-group col-md-4">
							<label for="productName">Ordenar de forma</label>
							<select name='productOrderAs' id='productOrderAs' class="form-control">
								<option value='asc' <?php if ( isset ($search_data['productOrderAs']) && $search_data['productOrderAs'] === "asc" ) { echo "selected"; } ?>>Crescente</option>
                <option value='desc' <?php if ( isset ($search_data['productOrderAs']) && $search_data['productOrderAs'] === "desc" ) { echo "selected"; } ?>>Decrescente</option>
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
        Nenhum produto cadastrado
      </div>
    @else
      <div class="row row-cols-1 row-cols-md-2">
	      @foreach ( $results as $dado_tabela )
          <div class="col mb-3">
            <div class="card h-100">
              <div class="card-header">
                ID: {{ $dado_tabela['id_product'] }}
              </div>
              <div class="card-body">
                <div class='row'>
                  <div class='col-md-12 col-lg-12 col-sm-12'>
                    <p class="card-text"><small class="text-muted">Produto:</small></p>
                    <h5 class="card-title">{{ $dado_tabela['product_name'] }}</h5>
                  </div>

                  <div class='col-md-6 col-lg-6 col-sm-12'>
                    <p class="card-text"><small class="text-muted">Categoria:</small></p>
                    <h5 class="card-title">{{ $dado_tabela['category_name'] }}</h5>
                  </div>

                  <div class='col-md-6 col-lg-6 col-sm-12'>
                    <p class="card-text"><small class="text-muted">Sub Categoria:</small></p>
                    <h5 class="card-title">{{ $dado_tabela['subcategory_name'] }}</h5>
                  </div>

                  <div class='col-md-6 col-lg-6 col-sm-12'>
                    <p class="card-text"><small class="text-muted">Status:</small></p>
                    <h5 class="card-title @if($dado_tabela['product_status'] == 1) badge badge-success @else badge badge-danger @endif">@if($dado_tabela['product_status'] ==1) Ativo @else Inativo @endif  </h5>
                  </div>

                </div>
              </div>
              <div class="card-footer text-right">
                <div class='btn-group'>
                  <a class='btn btn-secondary' href="{{ base_url('admin/item/edit/'.$dado_tabela['id_product']) }}"> Itens </a>
                  <a class='btn btn-warning' href="{{ base_url('admin/productimage/view/'.$dado_tabela['id_product']) }}"> Imagens </a>
                  <a class='btn btn-primary' href="{{ base_url('admin/product/edit/'.$dado_tabela['id_product']) }}"> Editar </a>
                  <button class="btn @if($dado_tabela['product_status'] == 0) btn-success @else btn-danger @endif" data-id="{{ $dado_tabela['id_product'] }}" id="changeStatus"> @if($dado_tabela['product_status'] == 0) Ativar @else Inativar @endif </button>
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
          url: "{{ base_url('admin/product/changeStatus/') }}"+id,
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
