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
        <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico">

        <title>TOKEN</title>


        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>resources/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>resources/css/signin.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

    <div class="container">
        <form class="form-signin" role="form"  action="<?php echo base_url(); ?>index.php/authenticate/user_login_process" method="post">
            <?php
            if (isset($error_message)) {
                echo "<div class='alert alert-danger'>";
                echo $error_message;
                echo "</div>";
            }
            ?>
            <h2 class="form-signin-heading" align="center">Авторизация</h2>
            <input type="text" name ="username" class="form-control" placeholder="Login" required="" autofocus="">
            <input type="password" name="password" class="form-control" placeholder="Password" required="">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Запомнить меня
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Вход</button>
        </form>

    </div> <!-- /container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

    </body>
</html>