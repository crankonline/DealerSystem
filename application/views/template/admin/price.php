<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container theme-showcase" role="main" ng-app="DealerSystem">
    <div ng-controller="AdminPriceController">
        <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере  ?>
            <div class="alert alert-danger">
                <strong>Oh snap!</strong> <?php echo $error_message; ?>
            </div>
        <?php else: ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span>
                        Текуцие ТМЦ
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Наименование товара</th>
                            <th>Цена</th>
                        </thead>
                        <tbody>
                        <tr data-ng-repeat="row in dataInventoryBuffer track by $index">
                            <td>{{$index + 1}}</td>
                            <td>{{row.inventory_name}}</td>
                            <td>{{row.price}}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-cog"></span>
                        Редактирование ТМЦ
                    </h3>
                </div>
                <div class="panel-body">
                    <strong>Выберите ТМЦ</strong>
                    <select class="form-control"
                            ng-model="dataInventory"
                            ng-options="option.inventory_name +' - '+ option.price disable when option.id_inventory === null
                                for option in InventoryName track by option.id_inventory"
                            ng-change="changeInventory()">
                    </select>
                    <hr/>
                    <input type="text"
                           hidden
                           ng-model="dataInventoryId">
                    <strong>Наименование</strong>
                    <input type="text"
                           class="form-control"
                           ng-disabled="dataInventory.id_inventory === '0'"
                           ng-model="dataInventoryName">
                    <strong>Цена</strong>
                    <input type="text"
                           class="form-control"
                           money-only
                           ng-disabled="dataInventory.id_inventory === '0'"
                           ng-model="dataInventoryPrice">
                </div>
                <div align="center" ng-hide="dataInventory.id_inventory === '0'">
                    <p>
                        <button type="submit"
                                class="btn btn-success"
                                ng-click="savePrice()">
                            <span class="glyphicon glyphicon-save"></span>
                            Сохранить
                        </button>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="<?php echo base_url("resources/js/DealerSystem/AdminPriceController.js"); ?>"></script>