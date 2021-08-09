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
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-minus"></span>
                        Удаление дистрибьютора
                    </h3>
                </div>
                <div class="panel-body">
                    <select class="form-control"
                            ng-model="dataDistributorSelect"
                            ng-options="option.full_name
                                for option in dataDistributor track by option.id_distributor"
                            ng-change="changeDistributorSelect()">
                    </select>
                    <hr/>

                </div>
                <div align="center" ng-hide="dataDistributorSelect.id_distributor === '0'">
                    <p>
                        <button type="submit"
                                class="btn btn-danger"
                                ng-click="deleteDistributor()">
                            <span class="glyphicon glyphicon-save"></span>
                            Удалить
                        </button>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="<?php echo base_url("resources/js/DealerSystem/AdminServices.js"); ?>"></script>
<script src="<?php echo base_url("resources/js/DealerSystem/AdminDistributoreditorController.js"); ?>"></script>
