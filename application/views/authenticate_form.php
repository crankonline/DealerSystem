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
        <script type="text/javascript" src="<?php echo base_url(); ?>resources/js/Token_Rutoken.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>resources/js/Token_PluginManager.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>resources/js/jquery.min.js"></script>
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
        <!-- /container -->
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <style type="text/css">
            button {
            }
            #plugin {
                width: 0px;
                height: 0px;
            }
        </style>
        <object type="application/x-rutoken-pki" id="plugin" style="position: absolute; opacity: 0;"></object>
        <div class="container">
            <?php
            if (isset($error_message)) {
                echo "<div class='alert alert-danger'>";
                echo $error_message;
                echo "</div>";
            }
            ?>
            <form class="form-signin" role="form" name="authorization" onsubmit="Sign(); return false;"
                  action="<?php echo base_url(); ?>index.php/authenticate/user_login_process_cert" method = "post">
                <h2 class="form-signin-heading" align="center">Авторизация</h2>
                <select class="form-control" id="tokenlist" required=""></select>
                <input type="password" class="form-control" placeholder="ПИН-КОД" required="" maxlength="14" autocomplete="off" id="pincode"  onkeypress="SignOnEnter(event);">
<!--                <input type="hidden" name="istest" value = "1" />-->
                <input type="hidden" name="cms" />
                <input type="hidden" name="token_number" />
                <div class="field">
                    <button class="btn btn-lg btn-primary btn-block" type="submit" id="signButton">Войти</button>
                    <button class="btn btn-lg btn-primary btn-block" type="button" onclick="TokenListLoader();">Обновить список</button>
                </div>
            </form>
        </div>
        <script type = "text/javascript">
            var PM = new PluginManager();
            function TokenListLoader() {
                PM.getTokenList().then(function (devices) {
                   //var plugin = PM.getPlugin();
                    var x = document.getElementById("tokenlist");
                    x.innerHTML = '';
                    var length = x.options.length;
                    for (i = 0; i < length; i++) {
                        x.options[i] = null;
                    }
                    window.device = [];
                    for (var i = 0; i < devices.length; i++) {
                        var option = document.createElement("option");
                        option.value = i;
                        option.text = "Рутокен #" + devices[i].id;
                        x.add(option, x[i]);
                    }
                });
            }
            TokenListLoader();

            function SignOnEnter(event) {
                if (event.which == 13 || event.keyCode == 13)
                {
                    Sign();
                }
            }

            function checkEnter(e) {
                e = e || event;
                var txtArea = /textarea/i.test((e.target || e.srcElement).tagName);
                return txtArea || (e.keyCode || e.which || e.charCode || 0) !== 13;
            }
            document.querySelector('form').onkeypress = checkEnter;

            function Sign() {
                if (document.getElementById("tokenlist").value == "") {
                    alert('Токен не выбран');
                    return;
                }
                if (document.getElementById('pincode').value.toString().trim() == '') {
                    alert('Введите пин-код');
                    return;
                }
                var tokenV = document.getElementById("tokenlist").value;
                var pincodeV = document.getElementById('pincode').value.toString().trim();
                console.log(tokenV);
                console.log(pincodeV);
                PM.login(tokenV, pincodeV)
                        .then(function (auth) {
                            PM.getDeviceInfo().then(function (serial) {
                                document.authorization.cms.value = auth;
                                document.authorization.token_number.value = serial;
                                document.authorization.submit();
                                //return true;
                            });
                        })
                        .catch(function (error) {
                            alert(error.message);
                            console.log(error);
                        });
            }
            document.authorization.onSuccess = function (response) {
                if (response.success) {
                    window.location.href = "?";
                } else
                {
                    document.authorization.pincode.value = "";
                }
            }
            document.authorization.onFailure = function (a) {
                alert('Ошибка сервера');
                document.authorization.pincode.value = "";
            }
        </script>
    </body>
</html>