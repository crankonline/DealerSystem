<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main" ng-app="StatErrorEds" ng-controller="StatErrorEdsData">
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <strong>Oh snap! </strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>    
        <div class="alert alert-warning">
            <span class="glyphicon glyphicon-warning-sign"></span> Внимание данный запрос будет обрабатываться дельше чем обычно! Чем больше указан период, тем дольше происходит обработка! 
            Данную статистику рекомендуется смотреть, когда не происходит процесс выдачи ЭЦП!
        </div>

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
            <form action="<?php echo base_url() . "index.php/statistics/statistics_view_error_eds" ?>" method="post">
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
                    <?php foreach ($reiting['statistics_reiting_eds_error'] as $value): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $value['name']; ?> </td>
                            <td><div class="progress">
                                    <div class="progress-bar progress-bar-<?php
                                    if ($value['count'] <= 20) {
                                        echo 'info';
                                    }if ($value['count'] > 20 && $value['count'] <= 50) {
                                        echo 'warning';
                                    }if ($value['count'] > 50) {
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

        <?php if (isset($statistics_period_operators)): ?>
            <div class="well" ng-repeat="(key, Operators) in CapitalisticOperatorsData | orderBy:'-totaldigits.eds_error_count'">
                <h3><span class="glyphicon glyphicon-stats"></span> Статистика за указанный период - {{Operators.name}}</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th ng-hide="!operator[key]">Дата</th>
                            <th>Кол-во ЭП <br> по счетам</th>
                            <th>Кол-во выданных <br> ЭП по факту</th>
                            <th>Разница <br> ЭП по факту</th>
                            <th>РуТокен</th>
                            <th>Кол-во заявок</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="cursor: pointer;"
                            ng-click="newtabeds(OperatorData.requisites_creating_date_time, Operators.id_users)"
                            ng-repeat="(key_data, OperatorData) in Operators.data"
                            ng-class="{'danger': OperatorData.EDS_error_count.EDS_count_error != 0, 'success': OperatorData.EDS_error_count.EDS_count_error == 0}"
                            ng-hide="!operator[key]">
                            <td>{{key_data + 1}} <span class="glyphicon glyphicon-eye-open"></span></td>
                            <td>{{OperatorData.requisites_creating_date_time}}</td>
                            <td>{{OperatorData.edscount}}</td>
                            <td>{{OperatorData.EDS_error_count.EDS_count_pki}}</td>
                            <td><ng-if ng-if="OperatorData.EDS_error_count.EDS_count_error < 0">Не выдано - {{(OperatorData.EDS_error_count.EDS_count_error) | makePositive}}</ng-if>
                    <ng-if ng-if="OperatorData.EDS_error_count.EDS_count_error >= 0">{{OperatorData.EDS_error_count.EDS_count_error}}</ng-if>
                    </td>
                    <td>{{OperatorData.tokencount}}</td>
                    <td>{{OperatorData.invoice_count}}</td>
                    </tr>
                    <tr>
                        <td><h4>Итого</h4></td>
                        <td ng-hide="!operator[key]"><strong></strong></td>
                        <td><h4>{{Operators.totaldigits.edscount}}</h4></td>
                        <td><h4>{{Operators.totaldigits.eds_count_pki}}</h4></td>
                        <td><h4>{{Operators.totaldigits.eds_error_count}}</h4></td>
                        <td><h4>{{Operators.totaldigits.tokencount}}</h4></td>
                        <td><h4>{{Operators.totaldigits.invoicecount}}</h4></td>
                    </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-block" ng-click="operator[key] = !operator[key]">
                    <span class = "glyphicon" ng-class="{ 'glyphicon-arrow-down': !operator[key], 'glyphicon-arrow-up': operator[key] }"></span> 
                    <ng-if ng-if="!operator[key]">Рзвернуть</ng-if>
                    <ng-if ng-if="operator[key]">Свернуть</ng-if>
                </button>
            </div>
        <?php endif; ?>
        <?php if ($this->session->userdata['logged_in']['UserRoleID'] == 4): ?>
            <div class="alert alert-danger">
               <button type="button" class="btn btn-block" onclick="window.open('/index.php/statistics/statistics_view_error_eds_pki_ext/')">Все ЭП выданные за месяц</button>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<link href="<?php echo base_url(); ?>resources/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>resources/js/moment-with-locales.min.js"></script>
<script src="<?php echo base_url(); ?>resources/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
        var StatErrorEds = angular.module("StatErrorEds", []).filter('makePositive', function(){
        return function(num){return Math.abs(num); }
        });
        StatErrorEds.controller("StatErrorEdsData", function($scope){
        window.scope = $scope;
        $scope.baseurl = "<?php echo base_url(); ?>";
        $scope.CapitalisticOperatorsData = <?php echo isset($statistics_period_operators) ? json_encode($statistics_period_operators) : "null"; ?>;
        $scope.newtabeds = function(Date, Userid){
        window.open('/index.php/statistics/statistics_view_error_eds_ext/' + Date + ' 00:00/' + Date + ' 23:59/' + Userid);
        };
        $scope.TotalDigits = function(){
        for (var i = 0; i < $scope.CapitalisticOperatorsData.length; i++){
        var edscount = 0, eds_count_pki = 0, eds_error_count = 0, tokencount = 0, invoicecount = 0, index = 0;
        for (var ii = 0; ii < $scope.CapitalisticOperatorsData[i].data.length; ii++){
        edscount += parseInt($scope.CapitalisticOperatorsData[i].data[ii].edscount);
        eds_count_pki += parseInt($scope.CapitalisticOperatorsData[i].data[ii].EDS_error_count.EDS_count_pki);
        eds_error_count += parseInt($scope.CapitalisticOperatorsData[i].data[ii].EDS_error_count.EDS_count_error) < 0  ?
                0 : parseInt($scope.CapitalisticOperatorsData[i].data[ii].EDS_error_count.EDS_count_error);
        tokencount += parseInt($scope.CapitalisticOperatorsData[i].data[ii].tokencount);
        invoicecount += parseInt($scope.CapitalisticOperatorsData[i].data[ii].invoice_count);
        }
        $scope.CapitalisticOperatorsData[i].totaldigits = {'index':i, 'edscount': edscount, 'eds_count_pki': eds_count_pki, 'eds_error_count': eds_error_count, 'tokencount': tokencount, 'invoicecount': invoicecount};
        }
        };
        scope.TotalDigits();
        });
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
