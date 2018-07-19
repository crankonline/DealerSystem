<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($statistics_reiting)
?>
<div class="container theme-showcase" role="main">
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <strong>Oh snap! </strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>    

        <?php $this->load->view('template/statistics/boss/statistics_menu'); //меню оператора?>

        <?php if (isset($period_start) && isset($period_end)): ?>
            <div class="alert alert-info">
                <strong>Отображена статистика за : </strong> <?php echo $period_start . ' - ' . $period_end; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <strong>Отображена статистика за : </strong> текущий месяц.
            </div>
        <?php endif; ?>

        <div class="jumbotron">
            <form action="<?php echo base_url() . "index.php/statistics/statistics_view_boss_main/" ?>" method="post">
                <h3><span class="glyphicon glyphicon-user"></span> Собрать статистику за указанный период</h3>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="input-group date" id="datetimepicker1">
                            <input type="text" class="form-control" name="period_start" required="" value="<?php echo (isset($period_start) ? $period_start : NULL) ?>"/>
                            <span class="input-group-addon">
                                <span class="glyphicon-calendar glyphicon"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="input-group date" id="datetimepicker2">
                            <input type="text" class="form-control" name="period_end" required="" value="<?php echo (isset($period_end) ? $period_end : NULL) ?>"/>
                            <span class="input-group-addon">
                                <span class="glyphicon-calendar glyphicon"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Собрать статистику</button>
                </div>
            </form>
        </div>

        <div class="well">
            <h3><span class="glyphicon glyphicon-tower"></span> Рейтинг операторов</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Место</th>
                        <th>ФИО</th>
                        <th style="width: 600px">Шкала</th>
                        <th>%</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($statistics_reiting as $value): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $value->username; ?> </td>
                            <td><div class="progress">
                                    <div class="progress-bar progress-bar-<?php
                                    if ($value->count <= 15) {
                                        echo 'danger';
                                    }if ($value->count > 16 && $value->count <= 50) {
                                        echo 'warning';
                                    }if ($value->count >= 51) {
                                        echo 'success';
                                    }
                                    ?>" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value->count . "%" ?>">
                                        <span class="sr-only"><?php echo $value->count . "%" ?></span>
                                    </div>
                                </div></td>
                            <td><?php echo number_format($value->count, 1, '.', ' ') . " %" ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="well">
            <h3><span class="glyphicon glyphicon-stats"></span> Общая cтатистика продаж по всем операторам</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Дата</th>
                        <th>Кол-во ЭП <br> по счетам</th>
                        <th>РуТокен</th>
                        <th>Кол-во заявок</th>
                        <th><span class="glyphicon glyphicon-usd"></span><th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $edscount = 0;
                    $tokencount = 0;
                    $pay_sum = 0;
                    $invoice = 0;
                    foreach ($statistics_daily_all as $val):
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $val->requisites_creating_date_time; ?></td>
                            <td><?php
                                echo $val->edscount;
                                $edscount += $val->edscount;
                                ?></td>
                            <td><?php
                                echo $val->tokencount;
                                $tokencount += $val->tokencount;
                                ?></td>
                            <td><?php
                                echo $val->invoice_count;
                                $invoice += $val->invoice_count;
                                ?></td>
                            <td><?php
                                echo number_format($val->pay_sum, 2, '.', ' ');
                                $pay_sum += $val->pay_sum;
                                ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td><h4>Итого</h4></td>
                        <td><strong></strong></td>
                        <td><h4><?php echo $edscount; ?></h4></td>
                        <td><h4><?php echo $tokencount; ?></h4></td>
                        <td><h4><?php echo $invoice; ?></h4></td>
                        <td><h4><?php echo number_format($pay_sum, 2, '.', ' '); ?></h4></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php foreach ($statistics_daily_operators as $key => $operator): ?>
            <div class="well">
                <h3><span class="glyphicon glyphicon-stats"></span> Статистика оператора - <?php echo $operator['name']; ?></h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Дата</th>
                            <th>Кол-во ЭП <br> по счетам</th>
                            <th>РуТокен</th>
                            <th>Кол-во заявок</th>
                            <th><span class="glyphicon glyphicon-usd"></span><th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $edscount = 0;
                        $tokencount = 0;
                        $pay_sum = 0;
                        $invoice = 0;
                        foreach ($operator['data'] as $val):
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $val->requisites_creating_date_time; ?></td>
                                <td><?php
                                    echo $val->edscount;
                                    $edscount += $val->edscount;
                                    ?></td>
                                <td><?php
                                    echo $val->tokencount;
                                    $tokencount += $val->tokencount;
                                    ?></td>
                                <td><?php
                                    echo $val->invoice_count;
                                    $invoice += $val->invoice_count;
                                    ?></td>
                                <td><?php
                                    echo number_format($val->pay_sum, 2, '.', ' ');
                                    $pay_sum += $val->pay_sum;
                                    ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><h4>Итого</h4></td>
                            <td><strong></strong></td>
                            <td><h4><?php echo $edscount; ?></h4></td>
                            <td><h4><?php echo $tokencount; ?></h4></td>
                            <td><h4><?php echo $invoice; ?></h4></td>
                            <td><h4><?php echo number_format($pay_sum, 2, '.', ' '); ?></h4></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<link href="<?php echo base_url(); ?>resources/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>resources/js/moment-with-locales.min.js"></script>
<script src="<?php echo base_url(); ?>resources/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
    $(function () {
        //Установим для виджета русскую локаль с помощью параметра language и значения ru
        $('#datetimepicker1').datetimepicker(
                {language: 'ru'}
        );
        $('#datetimepicker2').datetimepicker(
                {language: 'ru'}
        );
    });
</script>