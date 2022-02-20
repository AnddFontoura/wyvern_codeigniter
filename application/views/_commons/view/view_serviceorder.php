<?php 


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Wyvern | Ordem de Serviço</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
  
    <!-- jQuery 3 -->
    <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

    <style>

        .border-black{
            border: 1px solid black;
            margin: 5px auto;
        }

    </style>
<head>


<body>
    <div class='container'>
        <div class='row'>

            <div class='col-md-12' >
                <h3> <?php echo $resultado[0]['customer_name']; ?> </h3>
            </div>

            <div class='col-md-6 '>
                <h4> <b>Data de abertura da OS:</b> </h4> 
                <p><?php echo $resultado[0]['s_order_start_date_br']; ?> </p>
            </div>

            <div class='col-md-6'>
                <h4> <b>Data de fechamento da OS:</b> </h4>
                <p> <?php if($resultado[0]['s_order_end_date'] != "0000-00-00" ) { echo $resultado[0]['s_order_end_date_br']; } ?> </p>
            </div>

            <div class='col-md-12 '>
                <h4> <b> Descrição: </b> </h4>
                <?php echo $resultado[0]['s_order_description']; ?>
            </div>
            
            <div class='col-md-6 '>
                <h4> <b> Status da OS: </b> </h4>
                <p><?php echo $resultado[0]['status_name']; ?> </p>
            </div>

            <div class='col-md-6 '>
                <h4> <b> Preço do Serviço: </b> </h4> 
                <p> R$  <?php echo number_format($resultado[0]['s_order_price'],2,",","."); ?> </p>
            </div>

            <div class='col-md-6'>
                <h4> <b> QR Code: </b> </h4>
                <img src='<?php echo base_url("upload/qr_image/$img_url"); ?>'/>
            </div>

            <div class='col-md-6'>

            </div>

            <div class='col-md-12'>
                <h5> Criado por <a href='http://fontouradesenvolvimento.com.br'> Fontoura Desenvolvimento </a> </h5>
            </div>
        </div>
    </div>    
</body>
</html>