<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container theme-showcase" role="main" ng-app="DealerSystem">
    <div ng-controller="AdminUsereditorController">
        <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере  ?>
            <div class="alert alert-danger">
                <strong>Oh snap!</strong> <?php echo $error_message; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                <p>Это административная панель. Здесь можно управлять параметрами дилерской системы.
                    Будьте внимательны, любые изменения не подлежат отмене.</p>
            </div>
            <div class="alert alert-info">
                Выберете нужный пункт меню и приступайте к работе.
            </div>

            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-edit"></span>
                        Редактирование пользователя
                    </h3>
                </div>
                <div class="panel-body">
                    <select class="form-control"
                            ng-model="dataUsersSelect"
                            ng-options="option.user_login +' '+ option.surname +' '+ option.name
                            disable when option.id_users === null
                                for option in dataUsers track by option.id_users"
                            ng-change="changeUsersSelect()">
                    </select>
                    <hr/>
                    <div ng-hide="dataUsersSelect.id_users=== '0'">
                        <strong>Логин</strong>
                        <input type="text"
                               class="form-control"
                               ng-model="dataUsersSelect.user_login">
                        <strong>Фамилия</strong>
                        <input type="text"
                               class="form-control"
                               ng-model="dataUsersSelect.surname">
                        <strong>Имя</strong>
                        <input type="text"
                               class="form-control"
                               ng-model="dataUsersSelect.name">
                        <strong>Отчество</strong>
                        <input type="text"
                               class="form-control"
                               ng-model="dataUsersSelect.patronymic_name">
                        <hr/>
                        <strong>Роль в системе</strong>
                        <select class="form-control"
                                ng-model="dataUsersSelect.role_id">
                            <option ng-repeat="option in dataRole"
                                    value="{{option.id_role}}">{{option.name}}
                            </option>
                        </select>
                        <strong>Дистрибьютор</strong>
                        <select class="form-control"
                                ng-model="dataUsersSelect.distributor_id">
                            <option ng-repeat="option in dataDistributor"
                                    value="{{option.id_distributor}}">{{option.full_name}}
                            </option>
                        </select>
                        <hr/>
                        <strong>Введите новый пароль</strong>
                        <input type="password"
                               class="form-control "
                               ng-model="NewPassword1">
                        <strong>Повторно введите новый пароль</strong>
                        <input type="password"
                               class="form-control"
                               ng-model="NewPassword2">
                    </div>
                </div>
                <div class="alert alert-danger" ng-hide="NewPassword1 == NewPassword2">
                    Введенные пароли должны совпадать.
                </div>
            </div>
                <div align="center" ng-hide="dataUsersSelect.id_users=== '0'">
                    <p>
                        <button type="submit"
                                class="btn btn-success"
                                ng-click="saveUsers()">
                            <span class="glyphicon glyphicon-save"></span>
                            Сохранить
                        </button>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="<?php echo base_url("resources/js/DealerSystem/AdminServices.js"); ?>"></script>
<script src="<?php echo base_url("resources/js/DealerSystem/AdminUsereditorController.js"); ?>"></script>
<script src="<?php echo base_url("resources/js/sha1.js"); ?>"></script>
