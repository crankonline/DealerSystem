<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($statistics_daily_all)
?>
<div class="container theme-showcase" role="main">
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <strong>Oh snap! </strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>    
        <?php $this->load->view('template/statistics/boss/statistics_menu'); //меню оператора?>
        <div class="alert alert-warning">
            <span class="glyphicon glyphicon-warning-sign"></span> Внимание данный запрос будет обрабатываться дельше чем обычно! Чем больше указан период, тем дольше происходит обработка! 
            Данную статистику рекомендуется смотреть, когда не происходит процесс выдачи ЭЦП!
        </div>

        <?php if (isset($period_start) && isset($period_end)): ?>
            <div class="alert alert-info">
                <strong>Отображена статистика за : </strong> <?php echo $period_start . ' - ' . $period_end; ?>
            </div>
        <?php endif; ?>

        <div class="jumbotron">
            <form action="<?php echo base_url() . "index.php/statistics/statistics_view_boss_error_eds" ?>" method="post">
                <h3><span class="glyphicon glyphicon-user"></span> Указать период</h3>
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
        </div>

        <div class="well">
            <h3><span class="glyphicon glyphicon-tower"></span> Рейтинг операторов по ошибкам за указанный период</h3>
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
                    <?php foreach ($statistics_reiting_eds_error as $value): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $value['name']; ?> </td>
                            <td><div class="progress">
                                    <div class="progress-bar progress-bar-<?php
                                    if ($value['count'] <= 20) {
                                        echo 'info';
                                    }if ($value['count'] > 20 && $value['count'] <= 80) {
                                        echo 'warning';
                                    }if ($value['count'] > 80) {
                                        echo 'danger';
                                    }
                                    ?>" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value['count'] . "%" ?>">
                                        <span class="sr-only"><?php echo $value['count'] . "%" ?></span>
                                    </div>
                                </div></td>
                            <td><?php echo number_format($value['count'], 1, '.', ' ') . " %" ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($statistics_period_all)): ?>
            <div class="well">
                <h3><span class="glyphicon glyphicon-stats"></span> Общая статистика за указанный период </h3>
                <table class="table">
                    <thead>
                        <tr><th>#</th>
                            <th>Дата</th>
                            <th>Кол-во ЭП <br> по счетам</th>
                            <th>Кол-во выданных <br> ЭП по факту</th>
                            <th>Разница <br> ЭП по факту</th>
                            <th>РуТокен</th>
                            <th>Кол-во заявок</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $edscount = 0;
                        $eds_count_pki_all = 0;
                        $eds_count_error_pki = 0;
                        $tokencount = 0;
                        $invoice = 0;
                        foreach ($statistics_period_all as $val):
                            ?>
                            <tr onclick="window.open('<?php
                            echo base_url() . "index.php/statistics/statistics_view_operator_error_eds_pki_ext/" .
                            $val->requisites_creating_date_time . " 00:00/" . $val->requisites_creating_date_time . " 23:59"
                            ?>', '_blank')" 
                                style="cursor: pointer;"
            <?php echo ($val->EDS_error_count->EDS_count_error_pki != 0) ? 'class="danger"' : 'class="success"' ?>
                                >
                                <td><?php echo $i++; ?> <span class="glyphicon glyphicon-eye-open"></span></td>
                                <td><?php echo $val->requisites_creating_date_time; ?></td>
                                <td><?php
                                    echo $val->edscount;
                                    $edscount += $val->edscount;
                                    ?></td>
                                <td><?php
                                    echo $val->EDS_error_count->EDS_count_pki_all;
                                    $eds_count_pki_all += $val->EDS_error_count->EDS_count_pki_all;
                                    ?></td>
                                <td> <?php
                                    echo ($val->EDS_error_count->EDS_count_error_pki < 0) ? 'Не выдано - ' . abs($val->EDS_error_count->EDS_count_error_pki) : $val->EDS_error_count->EDS_count_error_pki;
                                    $eds_count_error_pki += ($val->EDS_error_count->EDS_count_error_pki < 0) ? 0 : $val->EDS_error_count->EDS_count_error_pki;
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
                            <td><h4><?php echo $eds_count_pki_all; ?></h4></td>
                            <td><h4><?php echo $eds_count_error_pki; ?></h4></td>
                            <td><h4><?php echo $tokencount; ?></h4></td>
                            <td><h4><?php echo $invoice; ?></h4></td>
                        </tr>
                    </tbody>
                </table>
                <?php ($edscount == 0) ? $persent = 0 : $persent = abs($eds_count_error_pki * 100 / $edscount); //  $eds_count_error_pki ?>
        <?php if ($persent > 1): ?>
                    <div class="alert alert-danger">
                        Разрешенная погрешность в выдаче составлятет 2 %<br>
                        <span class="glyphicon glyphicon-warning-sign"></span> На текущий момент это <?php echo $eds_count_error_pki; ?> ЭП или <?php echo number_format ($persent,1,'.',' '); ?> %
                    </div>
        <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($statistics_period_operators)): ?>
        <?php foreach ($statistics_period_operators as $key => $operator): ?>
                <div class="well">
                    <h3><span class="glyphicon glyphicon-stats"></span> Статистика за указанный период - <?php echo $operator['name']; ?></h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Дата</th>
                                <th>Кол-во ЭП <br> по счетам</th>
                                <th>Кол-во выданных <br> ЭП по факту</th>
                                <th>Разница <br> ЭП по факту</th>
                                <th>РуТокен</th>
                                <th>Кол-во заявок</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $edscount = 0;
                            $eds_count_pki = 0;
                            $eds_error_count = 0;
                            $tokencount = 0;
                            $invoice = 0;
                            foreach ($operator['data'] as $val):
                                ?>
                                <tr onclick="window.open('<?php
                                echo base_url() . "index.php/statistics/statistics_view_operator_error_eds_ext/" .
                                $val->requisites_creating_date_time . " 00:00/" . $val->requisites_creating_date_time . " 23:59/" . $operator['id_users']
                                ?>', '_blank')" style="cursor: pointer;"
                <?php echo ($val->EDS_error_count->EDS_count_error != 0) ? 'class="danger"' : 'class="success"' ?>
                                    >
                                    <td><?php echo $i++; ?> <span class="glyphicon glyphicon-eye-open"></span></td>
                                    <td><?php echo $val->requisites_creating_date_time; ?></td>
                                    <td><?php
                                        echo $val->edscount;
                                        $edscount += $val->edscount;
                                        ?></td>
                                    <td><?php
                                        echo $val->EDS_error_count->EDS_count_pki;
                                        $eds_count_pki += $val->EDS_error_count->EDS_count_pki;
                                        ?></td>
                                    <td><?php
                                        echo ($val->EDS_error_count->EDS_count_error < 0) ? 'Не выдано - ' . abs($val->EDS_error_count->EDS_count_error) : $val->EDS_error_count->EDS_count_error;
                                        $eds_error_count += ($val->EDS_error_count->EDS_count_error < 0) ? 0 : $val->EDS_error_count->EDS_count_error;
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
                                <td><h4><?php echo $eds_count_pki; ?></h4></td>
                                <td><h4><?php echo $eds_error_count; ?></h4></td>
                                <td><h4><?php echo $tokencount; ?></h4></td>
                                <td><h4><?php echo $invoice; ?></h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
<?php endif; ?>
</div>
<link href="<?php echo base_url(); ?>resources/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>resources/js/moment-with-locales.min.js"></script>
<script src="<?php echo base_url(); ?>resources/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
                    $(function () {
                        //Установим для виджета русскую локаль с помощью параметра language и значения ru
                        $('#datetimepicker1').datetimepicker({
                            language: 'ru',
                        });
                        $('#datetimepicker2').datetimepicker(
                                {language: 'ru'}
                        );
                    });
</script>
