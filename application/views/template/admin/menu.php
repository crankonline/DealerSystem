<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="">
                <span class="glyphicon glyphicon-cog"></span> <?php echo $UserRole . " " . $UserDistributorName . " | " . $UserShortName; ?>
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php echo (strripos($_SERVER['REQUEST_URI'], 'user')) ? 'class="active"' : NULL; ?>
                        class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><span
                                class="glyphicon glyphicon-user"></span> Пользователи <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>index.php/admin/user_roles"><span
                                        class="glyphicon glyphicon-log-in"></span> Привелегии</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/admin/user_password"><span
                                        class="glyphicon glyphicon-barcode"></span> Смена пароля</a></li>
                    </ul>
                </li>
                <li <?php echo (strripos($_SERVER['REQUEST_URI'], 'price')) ? 'class="active"' : NULL; ?>>
                    <a href="<?php echo base_url(); ?>index.php/admin/price/"><span
                                class="glyphicon glyphicon-usd"></span> Редактор цен</a>
                </li>
                <li <?php echo (strripos($_SERVER['REQUEST_URI'], 'media')) ? 'class="active"' : NULL; ?>>
                    <a href="<?php echo base_url(); ?>index.php/admin/media/"><span
                                class="glyphicon glyphicon-picture"></span> Загрузка изображений</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>index.php/authenticate/logout/"><span
                                class="glyphicon glyphicon-log-out"></span> Выход</a>
                </li>
            </ul>
        </div>
    </div>
</div>