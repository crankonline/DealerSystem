<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main" ng-app="StatMainBoss" ng-controller="StatMainBossData">
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <strong>Oh snap! </strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>    
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
            <form action="<?php echo base_url() . "index.php/statistics/statistics_view_main/" ?>" method="post">
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
                                    }if ($value->count > 15 && $value->count <= 50) {
                                        echo 'warning';
                                    }if ($value->count > 50) {
                                        echo 'success';
                                    }
                                    ?>" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value->count . "%" ?>">
                                        <span class="sr-only"><?php echo $value->count . "%" ?></span>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo number_format($value->count, 1, '.', ' ') . " %" ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($statistics_daily_all)): //переделать на ангуляр бльть)?>
            <div class="well">
                <h3>
                    <span class="glyphicon glyphicon-stats"></span> Общая cтатистика продаж по всем операторам  
                </h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th ng-hide="!cummunism">Дата</th>
                            <th>Кол-во ЭП <br> по счетам</th>
                            <th>РуТокен</th>
                            <th>Кол-во заявок</th>
                            <?php if($this->session->userdata['logged_in']['UserRoleID'] == 4) :?>
                                <th><span class="glyphicon glyphicon-usd"></span></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="(key_dd, DailyData) in CommunismData.data" ng-hide="!cummunism">
                            <td>{{key_dd + 1}}</td>
                            <td>{{DailyData.requisites_creating_date_time}}</td>
                            <td>{{DailyData.edscount}}</td>
                            <td>{{DailyData.tokencount}}</td>
                            <td>{{DailyData.invoice_count}}</td>
                            <?php if($this->session->userdata['logged_in']['UserRoleID'] == 4):?>
                                <td>{{DailyData.pay_sum}}</td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td><h4>Итого</h4></td>
                            <td ng-hide="!cummunism"><strong></strong></td>
                            <td><h4>{{CommunismData.totaldigits.endscount}}</h4></td>
                            <td><h4>{{CommunismData.totaldigits.tokencount}}</h4></td>
                            <td><h4>{{CommunismData.totaldigits.invoice_count}}</h4></td>
                            <?php if($this->session->userdata['logged_in']['UserRoleID'] == 4):?>
                                <td><h4>{{CommunismData.totaldigits.pay_sum| number:'2'}}</h4></td>
                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-block" ng-click="cummunism = !cummunism">
                    <span class = "glyphicon" ng-class="{ 'glyphicon-arrow-down': !cummunism, 'glyphicon-arrow-up': cummunism }"></span> 
                    <ng-if ng-if="!cummunism">Рзвернуть</ng-if>
                    <ng-if ng-if="cummunism">Свернуть</ng-if>
                </button>
            </div>
        <?php endif; ?>
        <div class="well" ng-repeat="(key_p, OperatorData) in CapitalisticOperatorsData">
            <h3>
                <span class="glyphicon glyphicon-stats"></span> Статистика оператора - {{OperatorData.name}}
            </h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th ng-hide="!operator[key_p]">Дата</th>
                        <th>Кол-во ЭП <br> по счетам</th>
                        <th>РуТокен</th>
                        <th>Кол-во заявок</th>
                        <?php if($this->session->userdata['logged_in']['UserRoleID'] == 4) :?>
                            <th><span class="glyphicon glyphicon-usd"></span><th>
                        <?php endif;?>
                    </tr>
                </thead>
                <tbody>     
                    <tr ng-repeat="(key, Data) in OperatorData.data" ng-hide="!operator[key_p]">
                        <td>{{key + 1}}</td>
                        <td>{{Data.requisites_creating_date_time}}</td>
                        <td>{{Data.edscount}}</td>
                        <td>{{Data.tokencount}}</td>
                        <td>{{Data.invoice_count}}</td>
                        <?php if($this->session->userdata['logged_in']['UserRoleID'] == 4) :?>
                            <td>{{Data.pay_sum| number:'2'}}</td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td><h4>Итого</h4></td>
                        <td ng-hide="!operator[key_p]"><strong></strong></td>
                        <td><h4>{{OperatorData.totaldigits.endscount}}</h4></td>
                        <td><h4>{{OperatorData.totaldigits.tokencount}}</h4></td>
                        <td><h4>{{OperatorData.totaldigits.invoice_count}}</h4></td>
                        <?php if($this->session->userdata['logged_in']['UserRoleID'] == 4) :?>
                            <td><h4>{{OperatorData.totaldigits.pay_sum| number:' 2'}}</h4></td>
                        <?php endif;?>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-block" ng-click="operator[key_p] = !operator[key_p]">
                <span class = "glyphicon" ng-class="{ 'glyphicon-arrow-down': !operator[key_p], 'glyphicon-arrow-up': operator[key_p] }"></span> 
                <ng-if ng-if="!operator[key_p]">Рзвернуть</ng-if>
                <ng-if ng-if="operator[key_p]">Свернуть</ng-if>
            </button>
        </div>
    </div>
<?php endif; ?>
<link href="<?php echo base_url(); ?>resources/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>resources/js/moment-with-locales.min.js"></script>
<script src="<?php echo base_url(); ?>resources/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
                var StatMainBoss = angular.module("StatMainBoss", []);
                StatMainBoss.controller("StatMainBossData", function($scope){
                window.scope = $scope;
                $scope.CapitalisticOperatorsData = <?php echo isset($statistics_daily_operators) ? json_encode($statistics_daily_operators) : "null"; ?>;
                $scope.CommunismData = <?php echo isset($statistics_daily_all) ? json_encode($statistics_daily_all) : "null"; ?>;
                });
                $(function () {
                //Установим для виджета русскую локаль с помощью параметра language и значения ru
                $('#datetimepicker1').datetimepicker(
                {language: 'ru',
                 format: 'YYYY-MM-DD HH:mm'}
                );
                $('#datetimepicker2').datetimepicker(
                {language: 'ru',
                 format: 'YYYY-MM-DD HH:mm'}
                );
                });
</script>