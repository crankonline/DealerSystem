<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container theme-showcase" role="main" ng-app="DealerSystem">
    <div ng-controller="AdminDistributoreditorController">
        <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере  ?>
            <div class="alert alert-danger">
                <strong>Oh snap!</strong> <?php echo $error_message; ?>
            </div>
        <?php else: ?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span>
                        Регистрация дистрибьютора
                    </h3>
                </div>
                <div class="panel-body">
                    <strong>Псевдоним</strong>
                    <input type="text"
                           class="form-control"
                           ng-model="dataDistributorSelect.short_name">
                    <strong>ИНН</strong>
                    <input type="text"
                           class="form-control"
                           numbers-only
                           ng-model="dataDistributorSelect.inn_distributor">
                    <strong>ОКПО</strong>
                    <input type="text"
                           numbers-only
                           class="form-control"
                           ng-model="dataDistributorSelect.okpo">
                    <strong>Код район налоговой</strong>
                    <input type="text"
                           class="form-control"
                           numbers-only
                           ng-model="dataDistributorSelect.sti_code">
                    <strong>Ройон налоговой текстом</strong>
                    <input type="text"
                           class="form-control"
                           ng-model="dataDistributorSelect.sti_region">
                    <strong>Банк БИК</strong>
                    <input type="text"
                           class="form-control"
                           numbers-only
                           ng-model="dataDistributorSelect.bank_bik">
                    <strong>Наименование банка</strong>
                    <input type="text"
                           class="form-control"
                           ng-model="dataDistributorSelect.bank_name">
                    <strong>Расчетный счет</strong>
                    <input type="text"
                           class="form-control"
                           numbers-only
                           ng-model="dataDistributorSelect.bank_account">
                    <strong>Полное наименование</strong>
                    <input type="text"
                           class="form-control"
                           ng-model="dataDistributorSelect.full_name">
                    <strong>Юридичекий адресс дистрибьютора</strong>
                    <input type="text"
                           class="form-control"
                           ng-model="dataDistributorSelect.address">
                    <hr/>
                </div>
                <div align="center">
                    <p>
                        <button type="submit"
                                class="btn btn-success"
                                ng-click="saveDistributor()">
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
<script src="<?php echo base_url("resources/js/DealerSystem/AdminDistributoreditorController.js"); ?>"></script>
