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
        <?php $this->load->view('template/statistics/operator/statistics_menu'); //меню оператора?>
        <div class="well">
            <h3><span class="glyphicon glyphicon-stats"></span> Статистика за текущий месяц - <?php echo $UserName ?></h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Дата</th>
                        <th>Кол-во ЭП <br> по счетам</th>
                        <th>РуТокен</th>
                        <th>Кол-во заявок</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $edscount = 0;
                    $tokencount = 0;
                    $invoice = 0;
                    foreach ($statistics_daily_self as $val):
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
            <?php foreach ($statistics_daily_operators as $key => $operator): ?>
                <div class="well">
                    <h3><span class="glyphicon glyphicon-stats"></span> Статистика за текущий месяц - <?php echo $operator['name']; ?></h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Дата</th>
                                <th>Кол-во ЭП <br> по счетам</th>
                                <th>РуТокен</th>
                                <th>Кол-во заявок</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $edscount = 0;
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
                <h3><span class="glyphicon glyphicon-stats"></span> Общая статистика за текущий месяц </h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Дата</th>
                            <th>Кол-во ЭП <br> по счетам</th>
                            <th>РуТокен</th>
                            <th>Кол-во заявок</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $edscount = 0;
                        $tokencount = 0;
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
    </div>
<?php endif; ?>
