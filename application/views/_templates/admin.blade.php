<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Wyvern | Painel Administrativo</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
  <!-- http://fancyapps.com/fancybox/3/ -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.fancybox.css'); ?>">

  <!-- Select2 cdn -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <link href="{{ base_url('assets/css/select2-bootstrap4.css') }}" rel="stylesheet" />

  <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css'); ?>">

  @yield('admin_css')

  <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Wyvern</h3>
            </div>

            <ul class="list-unstyled components">
              <p>Menu</p>
              <li class="">
                  <a href="#categorySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Categorias</a>
                  <ul class="collapse list-unstyled" id="categorySubmenu">
                    <li>
                      <a href="{{ base_url('admin/category/index') }}">Listar Categorias</a>
                    </li>
                    <li>
                      <a href="{{ base_url('admin/category/create') }}">Novas Categorias</a>
                    </li>
                  </ul>
              </li>

              <li class="">
                <a href="#subcategorySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Sub Categorias</a>
                <ul class="collapse list-unstyled" id="subcategorySubmenu">
                  <li>
                    <a href="{{ base_url('admin/subcategory/index') }}">Listar Sub Categorias</a>
                  </li>
                  <li>
                    <a href="{{ base_url('admin/subcategory/create') }}">Novas Sub Categorias</a>
                  </li>
                </ul>
              </li>

              <li class="">
                <a href="#productSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Produtos</a>
                <ul class="collapse list-unstyled" id="productSubmenu">
                  <li>
                    <a href="{{ base_url('admin/product/index') }}">Listar Produtos</a>
                  </li>
                  <li>
                    <a href="{{ base_url('admin/product/create') }}">Novos Produtos</a>
                  </li>
                </ul>
              </li>

              <li class="">
                <a href="#itemSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Itens</a>
                <ul class="collapse list-unstyled" id="itemSubmenu">
                  <li>
                    <a href="{{ base_url('admin/categoryitem/index') }}">Listar Categoria de Itens</a>
                  </li>
                  <li>
                    <a href="{{ base_url('admin/categoryitem/index') }}">Nova Categoria de Itens</a>
                  </li>
                  <li>
                    <a href="{{ base_url('admin/item/index') }}">Listar Itens</a>
                  </li>
                  <li>
                    <a href="{{ base_url('admin/item/create') }}">Novos Itens</a>
                  </li>
                </ul>
              </li>

              <li>
                <a href="#">Portfolio</a>
              </li>
            </ul>

            <ul class="list-unstyled components">
              <p>Configurações</p>
              <li class="">
                <a href="#permissionSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Permissões</a>
                <ul class="collapse list-unstyled" id="permissionSubmenu">
                  <li>
                    <a href="{{ base_url('admin/permissioncategory') }}">Categoria de Permissões</a>
                  </li>
                  <li>
                    <a href="{{ base_url('admin/permission') }}">Permissões</a>
                  </li>
                  <li>
                    <a href="{{ base_url('admin/permissiongroup') }}">Grupos de Permissões</a>
                  </li>
                </ul>
              </li>
            </ul>

            <ul class="list-unstyled CTAs">
              <li>
                <a href="{{ base_url('login/logout') }}" class="btn bg-light">
                  Logout
                </a>
              </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <button type="button" id="sidebarCollapse" class="navbar-btn">
                  <span></span>
                  <span></span>
                  <span></span>
              </button>

              <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="fas fa-align-justify"></i>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="nav navbar-nav ml-auto">
                      <li class="nav-item active">
                          <a class="nav-link" href="#">Page</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#">Page</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#">Page</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ base_url('') }}" target='_blank'>Visitar loja</a>
                      </li>
                  </ul>
              </div>
            </div>
          </nav>

          @yield('admin_content')
        </div>
    </div>

    <!--
      Production version popper
      Documentations: https://popper.js.org/docs/v2/
    -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>

    <script src="{{ base_url('assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ base_url('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ base_url('assets/js/jquery.fancybox.min.js') }}"></script>

    <!-- cdn select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="{{ base_url('assets/js/wyvern.js') }}"></script>

    @yield('admin_js')

    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2({
               theme: "bootstrap4"
            });

            $('[data-fancybox]').fancybox({
            	protect: true
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>
