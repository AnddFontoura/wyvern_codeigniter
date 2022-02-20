@extends('_templates.admin')

@section('admin_content')

<div class="row">
  <div class="col-lg-12 col-sm-12 col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard </li>
        <li class="breadcrumb-item active" aria-current="page">Home</li>
      </ol>
    </nav>
  </div>

  <div class="col-lg-4 col-sm-12 col-md-4">
    <div class="card">
      <div class='card-header'>
        Categorias
      </div>

      <div class='card-body'>
        <h3 class="card-title text-center"><?php echo $count_category; ?></h3>
      </div>

      <div class='card-footer'>
        <a href="<?php echo base_url('admin/category'); ?>" class="small-box-footer"> Visitar Categorias <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-sm-12 col-md-4">
    <div class="card">
      <div class='card-header'>
        Sub Categorias
      </div>

      <div class='card-body'>
        <h3 class="card-title text-center"><?php echo $count_subcategory; ?></h3>
      </div>

      <div class='card-footer'>
        <a href="<?php echo base_url('admin/subcategory'); ?>" class="small-box-footer"> Visitar Sub Categorias <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-sm-12 col-md-4">
    <div class="card">
      <div class='card-header'>
        Produto
      </div>

      <div class='card-body'>
        <h3 class="card-title text-center"><?php echo $count_product; ?></h3>
      </div>

      <div class='card-footer'>
        <a href="<?php echo base_url('admin/product'); ?>" class="small-box-footer"> Visitar Produtos <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection
