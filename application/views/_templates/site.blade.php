<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Wyvern | Loja Virtual </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
  <!-- http://fancyapps.com/fancybox/3/ -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.fancybox.css'); ?>">
  <!-- Select2 cdn -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="<?php echo base_url('assets/css/wyvern.css'); ?>">

  @yield('site_css')
</head>

<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <div class='container'>
      <a class="navbar-brand" href="#">Wyvern Demo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Categorias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sub Categorias</a>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li class="nav-item"><a class="nav-link" href="../navbar/">Exemplo Site</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('client/index'); ?>">Área do Cliente</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/index'); ?>">Área do Adm</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class='container margin-top-70'>
      @yield('site_content')
  </div>

 <!-- Footer -->
  <footer class="page-footer font-small unique-color-dark margin-top-70">
    <div class='bg-light'>
      <div class="container">
        <div class="row py-4 d-flex align-items-center">
          <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
            <h6 class="mb-0">Get connected with us on social networks!</h6>
          </div>

          <div class="col-md-6 col-lg-7 text-center text-md-right">

            <!-- Facebook -->
            <a class="fb-ic">
              <i class="fa fa-facebook white-text mr-4"> </i>
            </a>
            <!-- Twitter -->
            <a class="tw-ic">
              <i class="fa fa-twitter white-text mr-4"> </i>
            </a>
            <!-- Google +-->
            <a class="gplus-ic">
              <i class="fa fa-google-plus white-text mr-4"> </i>
            </a>
            <!--Linkedin -->
            <a class="li-ic">
              <i class="fa fa-linkedin white-text mr-4"> </i>
            </a>
            <!--Instagram-->
            <a class="ins-ic">
              <i class="fa fa-instagram white-text"> </i>
            </a>

          </div>
          <!-- Grid column -->

        </div>
        <!-- Grid row-->

      </div>
    </div>

    <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase font-weight-bold">Fontoura Desenvolvimento</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>Here you can use rows and columns here to organize your footer content. Lorem ipsum dolor sit amet, consectetur
            adipisicing elit.</p>
        </div>

        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase font-weight-bold">Serviços</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <a href="#!">Aluguel de Sistemas</a>
          </p>
          <p>
            <a href="#!">Desenvolvimento sob demanda</a>
          </p>
          <p>
            <a href="#!">Ajustes em Sistemas</a>
          </p>
          <p>
            <a href="#!">Integrações</a>
          </p>
        </div>

        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase font-weight-bold">Acesso Rapido</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <a href="#!">Categorias</a>
          </p>
          <p>
            <a href="#!">Produtos</a>
          </p>
          <p>
            <a href="#!">Portifólio</a>
          </p>
          <p>
            <a href="#!">Contato</a>
          </p>

        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase font-weight-bold">Contato</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <i class="fa fa-home mr-3"></i> Rua Osni Martins Cruz, 322, Santa Bárbara do Oeste, São Paulo</p>
          <p>
            <i class="fa fa-envelope mr-3"></i> contato@fontouradesenvolvimento.com.br </p>
          <p>
            <i class="fa fa-phone mr-3"></i> (19) 9 9111 6353</p>
        </div>
      </div>
    </div>

    <div class="footer-copyright text-center py-3">© <?php echo date('Y'); ?> Copyright:
      <a href="https://fontouradesenvolvimento.com.br/"> Fontoura Desenvolvimento</a>
    </div>
  </footer>
  <!-- Footer -->

  <script src="{{ base_url('assets/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ base_url('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ base_url('assets/js/jquery.fancybox.min.js') }}"></script>

  <!--
    Production version popper
    Documentations: https://popper.js.org/docs/v2/
  -->
  <script src="https://unpkg.com/@popperjs/core@2"></script>

  <!-- cdn select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <script src="{{ base_url('assets/js/wyvern.js') }}"></script>

  <script>
  $(function () {
      $('[data-toggle="tooltip"]').tooltip()
  })
  </script>
  @yield('site_js')
</body>
</html>
