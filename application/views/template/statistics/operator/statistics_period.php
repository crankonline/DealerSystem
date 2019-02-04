<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main">
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <strong>Oh snap! </strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <?php $this->load->view('template/statistics/operator/statistics_menu'); //меню оператора?>
        <?php if (isset($period_start) && isset($period_end)): ?>
            <div class="alert alert-info">
                <strong>Отображена статистика за : </strong> <?php echo $period_start . ' - ' . $period_end; ?>
            </div>
        <?php endif; ?>
        <div class="jumbotron">
            <form action="<?php echo base_url() . "index.php/statistics/statistics_view_operator_period/" ?>" method="post">
                <h3><span class="glyphicon glyphicon-user"></span> Персональная статистика за указанный период</h3>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="input-group date" id="datetimepicker1">
                            <input type="text" class="form-control" name="period_start"/>
                            <span class="input-group-addon">
                                <span class="glyphicon-calendar glyphicon"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="input-group date" id="datetimepicker2">
                            <input type="text" class="form-control" name="period_end"/>
                            <span class="input-group-addon">
                                <span class="glyphicon-calendar glyphicon"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Собрать статтистику</button>
                </div>
            </form>
            <?php if (isset($statistics_period_self)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Дата</th>
                            <th>Количество ЭЦП</th>
                            <th>Количество РуТокен</th>
                            <th>Количество обработанных заявок</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $edscount = 0;
                        $tokencount = 0;
                        $invoice = 0;
                        foreach ($statistics_period_self as $val):
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
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><h4>Итого</h4></td>
                            <td><strong></strong></td>
                            <td><h4><?php echo $edscount; ?></h4></td>
                            <td><h4><?php echo $tokencount; ?></h4></td>
                            <td><h4><?php echo $invoice; ?></h4></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php if ($this->session->userdata['logged_in']['Show_Statistics_Operators'])://если есть доступ к стату всех операторов?>
                <?php foreach ($statistics_period_operators as $key => $operator): ?>
                    <div class="well">
                        <h3><span class="glyphicon glyphicon-stats"></span> Статистика за указанный переод - <?php echo $operator['name']; ?></h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Дата</th>
                                    <th>Количество ЭЦП</th>
                                    <th>Количество РуТокен</th>
                                    <th>Количество обработанных заявок</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $edscount = 0;
                                $eds_error_count = 0;
                                $tokencount = 0;
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
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td><h4>Итого</h4></td>
                                    <td><strong></strong></td>
                                    <td><h4><?php echo $edscount; ?></h4></td>
                                    <td><h4><?php echo $tokencount; ?></h4></td>
                                    <td><h4><?php echo $invoice; ?></h4></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
                <div class="well">
                    <h3><span class="glyphicon glyphicon-stats"></span> Общая статистика за указанный переод </h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Дата</th>
                                <th>Количество ЭЦП</th>
                                <th>Количество РуТокен</th>
                                <th>Количество обработанных заявок</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $edscount = 0;
                            $eds_error_count = 0;
                            $tokencount = 0;
                            $invoice = 0;
                            foreach ($statistics_period_all as $val):
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
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td><h4>Итого</h4></td>
                                <td><strong></strong></td>
                                <td><h4><?php echo $edscount; ?></h4></td>
                                <td><h4><?php echo $tokencount; ?></h4></td>
                                <td><h4><?php echo $invoice; ?></h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>
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