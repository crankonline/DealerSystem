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
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span>
                        Смена пароля
                    </h3>
                </div>
                <div class="panel-body">
                    <strong>Выберите пользователя</strong>
                    <select class="form-control"
                            ng-model="dataUsersSelect"
                            ng-options="option.user_login +' '+ option.surname +' '+ option.name disable when option.id_users === null
                                for option in dataUsers track by option.id_users"
                            ng-change="changeUsersSelect()">
                    </select>
                    <hr/>
                    <div ng-hide="dataUsersSelect.id_users === '0'">
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
                <div align="center" ng-hide="dataUsersSelect.id_users === '0' || NewPassword1 != NewPassword2">
                    <p>
                        <button type="submit"
                                class="btn btn-success"
                                ng-click="updateUsers()">
                            <span class="glyphicon glyphicon-save"></span>
                            Сохранить
                        </button>
                    </p>
                </div>
            </div>
            <div class="alert alert-danger" ng-hide="NewPassword1 == NewPassword2">
                Введенные пароли должны совпадать.
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="<?php echo base_url("resources/js/DealerSystem/AdminUsereditorController.js"); ?>"></script>
<script src="<?php echo base_url("resources/js/sha1.js"); ?>"></script>