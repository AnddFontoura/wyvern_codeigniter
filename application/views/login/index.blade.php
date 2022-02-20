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

	<style>
		html, body {
			/* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#c5deea+0,8abbd7+31,066dab+100;Web+2.0+Blue+3D+%231 */
			background: #c5deea; /* Old browsers */
			background: -moz-linear-gradient(45deg,  #c5deea 0%, #8abbd7 31%, #066dab 100%); /* FF3.6-15 */
			background: -webkit-linear-gradient(45deg,  #c5deea 0%,#8abbd7 31%,#066dab 100%); /* Chrome10-25,Safari5.1-6 */
			background: linear-gradient(45deg,  #c5deea 0%,#8abbd7 31%,#066dab 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
			background-attachment: fixed;
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c5deea', endColorstr='#066dab',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
		}
	</style>
  <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
</head>

<body>
	<div class="container">
		<div class="row" style="margin-top: 100px;">
			<div class="col-md-4"></div>

			<div class="col-md-4">
				<h2 class='text-center'> <b>Painel</b>Administrativo</a> </h2>

        @if(isset($errors))
					@if(isset ($errors['erro_login']))
							<div class='alert alert-danger'>
								{!! $errors['erro_login'] !!}
							</div>
					@else
						{!! $errors !!}
					@endif
				@endif

				<form action="{{ base_url('login/checkLogin') }}" method="post" style="margin-top: 50px;">
					<div class="form-group">
						<label for="exampleInputEmail1">Usuário</label>
						<input type="text" class="form-control" name='login_text' placeholder="Login" minlength='5' maxlength='15' pattern='[0-9A-Za-z]{5,15}'>
					</div>

					<div class="form-group">
						<label for="exampleInputEmail1">Senha</label>
						<input type="password" class="form-control" name='passw_text' placeholder="Senha">
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Logar</button>
					</div>
				</form>
			</div>

			<div class="col-md-4"></div>
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
          $('.select2').select2();

          $('#sidebarCollapse').on('click', function () {
              $('#sidebar').toggleClass('active');
              $(this).toggleClass('active');
          });
      });
  </script>
</body>

	</head>
	<body class="hold-transition">


		<!-- Bootstrap 3.3.7 -->
		<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="<?php echo base_url('assets/bower_components/jquery-ui/jquery-ui.min.js'); ?>"></script>
		<!-- SweetAlert -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.5/sweetalert2.all.min.js"></script>
		<!-- iCheck -->
		<script src="<?php echo base_url(); ?>plugins/iCheck/icheck.min.js"></script>
		<script>
		  $(function () {
			$('input').iCheck({
			  checkboxClass: 'icheckbox_square-blue',
			  radioClass: 'iradio_square-blue',
			  increaseArea: '20%' // optional
			});
		  });
		</script>
		<script src="<?php echo base_url(); ?>js/wyvern.js"></script>
	</body>
</html>
