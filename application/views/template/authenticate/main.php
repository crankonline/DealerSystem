<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!-- saved from url=(0038)http://bootstrap-3.ru/examples/signin/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>resources/img/favicon.ico">
        <title>Авторизация</title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>resources/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>resources/css/signin.css" rel="stylesheet">

    </head>

    <body>

    <div class="container">
        <form class="form-signin" role="form">
            <?php
            if (isset($error_message)) {
                echo "<div class='alert alert-danger'>";
                echo $error_message;
                echo "</div>";
            }
            ?>
            <h2 class="form-signin-heading" align="center">Форма авторицации</h2>
            
            <button class="btn btn-lg btn-primary btn-block" 
                    type="button"
                    onclick="location.href='<?php echo base_url();?>index.php/authenticate/auth_token';">
                <span class="glyphicon glyphicon-certificate"></span> РуТокен
            </button>
            <button class="btn btn-lg btn-primary btn-block" 
                    type="button"
                    onclick="location.href='<?php echo base_url();?>index.php/authenticate/auth_cloud';">
                <span class="glyphicon glyphicon-cloud"></span> Облоко
            </button>
            <button class="btn btn-lg btn-primary btn-block" 
                    type="button"
                    onclick="location.href='<?php echo base_url();?>index.php/authenticate/auth_login';">
                <span class="glyphicon glyphicon-user"></span> Логин
            </button>
        </form>

    </div> <!-- /container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

    </body>
</html>