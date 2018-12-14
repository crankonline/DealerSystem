<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/account/">
                <span class="glyphicon glyphicon-user"></span> <?php echo $UserRole . " " . $UserDistributorName . " | " . $UserShortName; ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php echo (strripos($_SERVER['REQUEST_URI'], 'dash')) ? 'class="active"' : NULL; ?>><a href="<?php echo base_url(); ?>index.php/dash/"><span class="glyphicon glyphicon-home"></span> Главная</a></li>
                <li <?php echo (strripos($_SERVER['REQUEST_URI'], 'price')) ? 'class="active"' : NULL; ?>><a href="<?php echo base_url(); ?>index.php/price/price_view/"><span class="glyphicon glyphicon-usd"></span>Цены</a></li>
                <?php if ($this->session->userdata['logged_in']['Show_Statistics']): //проверка на доступ?>
                    <li <?php echo (strripos($_SERVER['REQUEST_URI'], 'statistics')) ? 'class="active"' : NULL; ?>><a href="<?php echo base_url(); ?>index.php/statistics/"><span class="glyphicon glyphicon-stats"></span> Статистика</a></li>
                <?php endif; ?>
                <li <?php echo (strripos($_SERVER['REQUEST_URI'], 'invoice')) ? 'class="active"' : NULL; ?> class="dropdown" style="width: 192px;">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> Счета на оплату <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php if ($this->session->userdata['logged_in']['Create_Invoice'] == TRUE): ?>
                            <li><a href="<?php echo base_url(); ?>index.php/invoice/invoice_create_view/"><span class="glyphicon glyphicon-file"></span> Создать счет на оплату</a></li>
                        <?php endif; ?>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>index.php/invoice/invoice_list_view/pay"><span class="glyphicon glyphicon-list"></span> Оплаченные</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/invoice/invoice_list_view/nonpay"><span class="glyphicon glyphicon-list"></span><span class="badge pull-right"><?php echo $this->invoice_model->menu_invoice_nonpay_count(); ?></span>  Не опплаченные</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/invoice/invoice_list_view/"><span class="glyphicon glyphicon-th-list"></span> Все</a></li>
                    </ul>
                </li>
                <li <?php echo (strripos($_SERVER['REQUEST_URI'], 'requisites')) ? 'class="active"' : NULL; ?> class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book"></span> Заявки<b class="caret"></b></a>
                    <ul class="dropdown-menu" style="width: 172px;">
                        <li><a href="<?php echo base_url(); ?>index.php/requisites/requisites_list_view/"><span class="glyphicon glyphicon-list"></span> Заполненные</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/invoice/invoice_list_view/wait"><span class="glyphicon glyphicon-list"></span> <span class="badge pull-right"><?php echo $this->invoice_model->menu_invoice_pay_count(); ?></span>Ожидающие</a></li>
<!--                        <li><a href="<?php // echo base_url();   ?>index.php/requisites/requisites_list_view/nondone"><span class="glyphicon glyphicon-certificate"></span> Для ЕНОТ</a></li>
                        <li><a href="<?php //echo base_url();   ?>index.php/requisites/requisites_list_view/nondone"><span class="glyphicon glyphicon-certificate"></span> Для Соц.фонд</a></li>
                        <li><a href="<?php //echo base_url();   ?>index.php/requisites/requisites_list_view/nondone"><span class="glyphicon glyphicon-certificate"></span> Для стороних систем</a></li>-->
                        <!--                        <li class="divider"></li>
                                                <li class="dropdown-header">Архив</li>
                                                <li><a href="#"><span class="glyphicon glyphicon-calendar"></span> Январь 2017</a></li>
                                                <li><a href="#"><span class="glyphicon glyphicon-calendar"></span> Февраль 2017</a></li>
                                                <li><a href="#"><span class="glyphicon glyphicon-calendar"></span> Март 2017</a></li>-->
                    </ul>
                </li>
                <li <?php echo (strripos($_SERVER['REQUEST_URI'], 'pki/')) ? 'class="active"' : NULL; ?>>
                    <a href="<?php echo base_url(); ?>index.php/pki/pki_search_view/"><span class="glyphicon glyphicon-certificate"></span> Сертификаты</a>
                </li>
                <li><a href="<?php echo base_url(); ?>index.php/authenticate/logout/"><span class="glyphicon glyphicon-log-out"></span> Выход</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>