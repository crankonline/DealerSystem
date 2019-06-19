<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

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
            <form class="form-signin" id="from" role="form" action="<?php echo base_url(); ?>index.php/authenticate/user_login_process"
                  method="post">
                      <?php
                      if (isset($error_message)) {
                          echo "<div class='alert alert-danger'>";
                          echo $error_message;
                          echo "</div>";
                      }
                      ?>
                <h2 class="form-signin-heading" align="center">Авторизация</h2>
                <input type="text" id = "username" name="username" class="form-control" placeholder="Логин" required="" autofocus="">
                <input type="password" name="password" class="form-control" placeholder="Пароль" required="">
                <!--            <label class="checkbox">
                                <input type="checkbox" value="remember-me"> Запомнить меня
                            </label>
                -->
                <button class="btn btn-lg btn-primary btn-block" type="submit">Вход</button>
            </form>
        </div> 
    </body>
</html>