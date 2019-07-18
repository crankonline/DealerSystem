<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="">
                <span class="glyphicon glyphicon-user"></span> <?php echo $UserRole . " " . $UserDistributorName . " | " . $UserShortName; ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php echo (strripos($_SERVER['REQUEST_URI'], 'price')) ? 'class="active"' : NULL; ?>>
                    <a href="<?php echo base_url(); ?>index.php/price/price_view/"><span class="glyphicon glyphicon-user"></span> Пользователи</a>
                </li>

                <li <?php echo (strripos($_SERVER['REQUEST_URI'], 'price')) ? 'class="active"' : NULL; ?>>
                    <a href="<?php echo base_url(); ?>index.php/price/price_view/"><span class="glyphicon glyphicon-usd"></span>ТМЦ</a>
                </li>
                <li><a href="<?php echo base_url(); ?>index.php/authenticate/logout/"><span class="glyphicon glyphicon-log-out"></span> Выход</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>