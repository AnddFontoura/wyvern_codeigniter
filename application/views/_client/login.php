<?php



?>

<!DOCTYPE html>
	<head>
		
		<title> Wyvern -  Painel Administrativo </title>

		<meta charset="utf-8">
		<meta name='description' content='Sistema administrativo Wyvern'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		 <!-- Bootstrap 3.3.7 -->
		 <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body class="hold-transition">
		<div class="login-box">
			<div class="login-logo">
				<b>Área do</b> Cliente</a>
			</div> <!-- /.login-logo -->
			
			<?php
				
				if ( isset ($errors) )
				{
					echo $errors;
				}
			
			?>
			
			<div class="login-box-body">
				<form action="<?php echo base_url('client/checkLogin'); ?>" method="post">
					<div class="form-group has-feedback">
						<input type="text" class="form-control" name='client_user' placeholder="Login" minlength='5' maxlength='15' pattern='[0-9A-Za-z]{5,15}'>
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
				
					<div class="form-group has-feedback">
						<input type="password" class="form-control" name='client_password' placeholder="Senha">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
				
					<div class="row">
						<div class="col-xs-8">
                            <label>
                                <!--input type="checkbox"> Remember Me -->
                                <a href="<?php echo base_url('client/passwordRecovery'); ?>">Esqueci a senha</a><br>
                                <a href="<?php echo base_url('client/create'); ?>">Cadastrar novo usuário</a>
                            </label>
						</div> <!-- /.col -->
						
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary btn-block btn-flat">Logar</button>
						</div> <!-- /.col -->
					</div>
				</form>
			</div> <!-- /.login-box-body -->
		</div> <!-- /.login-box -->

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
  
