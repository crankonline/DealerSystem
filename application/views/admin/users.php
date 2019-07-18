<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container theme-showcase" role="main" ng-app="AdminUsers">

    <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере  ?>
        <div class="alert alert-danger">
            <strong>Oh snap!</strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Роль</th>
                    <th>Логин</th>
    <!--                    <th>Серийный номер устройства</th>
                    <th>Серийный номер сертификата</th>-->
                    <th>Изменить пароль</th>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($user_data as $user_item):
                    ?>
                    <tr > 
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $user_item->id_users; ?></td>
                        <td><?php echo $user_item->username; ?></td>
                        <td><?php echo $user_item->name; ?></td>
                        <td><?php echo $user_item->user_login; ?></td>
        <!--                        <td><?php //echo $user_item->token_number;                  ?></td>
                        <td><?php //echo $user_item->cert_number;                  ?></td>-->
                        <td>
                            <input type="password" name="password" id="<?php echo $user_item->id_users; ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <div ng-controller="Test">
        <button type="button" ng-click="getPrivileges()">sdfsfd</button>

        <div class="alert alert-danger" ng-hide="!Error">
            <p ng-bind-html ="Error"></p>
        </div>

        <div class="panel panel-primary" ng-hide="!Privileges">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Роли в системе</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Роль</th>
                            <th>Описание</th>
                            <th>Значение</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-class="{success: Privileges.create_invoice !== null, danger: Privileges.create_invoice === null,}">
                            <td>Create_Invoice</td>
                            <td>Доступ к созданию счетов на оплату и регистрации заявки (оператор)</td>
                            <td ng-if="Privileges.create_invoice !== null">ДА</td>
                            <td ng-if="Privileges.create_invoice === null">НЕТ</td>
                        </tr>
                        <tr ng-class="{success: Privileges.change_invoice !== null, danger: Privileges.change_invoice === null}">
                            <td>Change_Invoice</td>
                            <td>Доступ к измененю ИНН и названия компании в счете на оплату (оператор)</td>
                            <td ng-if="Privileges.change_invoice !== null">ДА</td>
                            <td ng-if="Privileges.change_invoice === null">НЕТ</td>
                        </tr>
                        <tr ng-class="{success: Privileges.payer_invoce !== null, danger: Privileges.payer_invoce === null}">
                            <td>Payer_Invoce</td>
                            <td>Доступ к активации оплаты (старший оператор, менеджер, руководитель)</td>
                            <td ng-if="Privileges.payer_invoce !== null">ДА</td>
                            <td ng-if="Privileges.payer_invoce === null">НЕТ</td>
                        </tr>
                        <tr ng-class="{success: Privileges.reassing_invoice !== null, danger: Privileges.reassing_invoice === null}">
                            <td>Reassing_Invoice</td>
                            <td>Доступ к переназначению счетов на оплату между операторами и активации оплаты (менеджер, старший оператор)</td>
                            <td ng-if="Privileges.reassing_invoice !== null">ДА</td>
                            <td ng-if="Privileges.reassing_invoice === null">НЕТ</td>
                        </tr>
                        <tr ng-class="{success: Privileges.show_operator !== null, danger: Privileges.show_operator === null}">
                            <td>Show_Operator</td>
                            <td>Доступ к спискам в рамках дистрибьютора (старший оператор, менеджер, руководитель)</td>
                            <td ng-if="Privileges.show_operator !== null">ДА</td>
                            <td ng-if="Privileges.show_operator === null">НЕТ</td>
                        </tr>
                        <tr ng-class="{success: Privileges.show_statistics !== null, danger: Privileges.show_statistics === null}">
                            <td>Show_Statistics</td>
                            <td>Доступ к модулю статистики (оператор, руководитель)</td>
                            <td ng-if="Privileges.show_statistics !== null">ДА</td>
                            <td ng-if="Privileges.show_statistics === null">НЕТ</td>
                        </tr>
                        <tr ng-class="{success: Privileges.show_statistics_operators !== null, danger: Privileges.show_statistics_operators === null}">
                            <td>Show_Statistics_Operators</td>
                            <td>Доступ к модулю статистики по всем операторам (старший оператор)</td>
                            <td ng-if="Privileges.show_statistics_operators !== null">ДА</td>
                            <td ng-if="Privileges.show_statistics_operators === null">НЕТ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    var app = angular.module('AdminUsers', []);
    app.controller('Test', ['$scope', '$http', '$sce', function ($scope, $http, $sce) {
            window.scope = $scope;

            $scope.getPrivileges = function () {
                $scope.Privileges = null;
                $scope.Error = null;
                $http.post('<?php echo base_url('admin/get_privileges'); ?>', {login: 'manage'})
                        .then(function (response) {
                            $scope.Privileges = response.data;
                        }, function (response) {
                            $scope.Error = $sce.trustAsHtml('Ошибка: ' + response.status + '<br> Сообщение: ' + response.data);
                        });
            };

        }]);
</script>
