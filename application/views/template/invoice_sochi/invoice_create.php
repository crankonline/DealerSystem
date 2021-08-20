<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container theme-showcase" role="main" ng-app="DealerSystem">
    <div ng-controller="InvoiceSochiCreateController">
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger">
                <strong>Oh snap! </strong> <?php echo $error_message; ?>
            </div>
        <?php else: ?>
            <!--        <div class="alert alert-warning">-->
            <!--            <strong>Памятка: </strong>Внимательно заполните поля ИНН, НАИМЕНОВАНИЕ КОМПАНИИ и ТОВАРОНО МЕТЕРИАЛЬНЫХ ЦЕННОСТЕЙ!!!-->
            <!--        </div>-->
            <form action="<?php echo base_url(); ?>index.php/invoice_sochi/invoice_create_save/" method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span> Основные реквизиты
                            баланс СОчИ</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon">Введите</span>
                                    <input type="text"
                                           numbers-only
                                           class="form-control"
                                           name="InvoiceDataInn"
                                           placeholder="ИНН"
                                           required=""
                                           minlength="14"
                                           maxlength="14"
                                           ng-model="Inn"
                                           ng-change="searchInn()">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon">Введите</span>
                                    <input type="text"
                                           class="form-control"
                                           name="InvoiceCompanyName"
                                           placeholder="Наименование компании"
                                           required=""
                                           minlength="5"
                                           maxlength="100"
                                           ng-model="company_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon">Введите</span>
                                    <input type="text"
                                           class="form-control"
                                           name="InvoiceCompanyBankBik"
                                           placeholder="БИК - Не обязательно"
                                           minlength="5"
                                           maxlength="100"
                                           ng-model="company_bankbik">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon">Введите</span>
                                    <input type="text"
                                           class="form-control"
                                           name="InvoiceCompanyBankName"
                                           placeholder="Наименование банка - Не обязательно"
                                           minlength="5"
                                           maxlength="100"
                                           ng-model="company_bankname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon">Введите</span>
                                    <input type="text"
                                           class="form-control"
                                           name="InvoiceCompanyBankAccount"
                                           placeholder="Расчетный счет - Не обязательно"
                                           minlength="5"
                                           maxlength="100"
                                           ng-model="company_bankaccount">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon">Введите</span>
                                    <input type="text"
                                           class="form-control"
                                           name="InvoiceCompanyCity"
                                           placeholder="Населеный пункт"
                                           required=""
                                           minlength="5"
                                           maxlength="100"
                                           ng-model="company_city">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon">Введите</span>
                                    <input type="text"
                                           class="form-control"
                                           name="InvoiceCompanyAddress"
                                           placeholder="Адрес - Улица, Дом, Квартира"
                                           required=""
                                           minlength="5"
                                           maxlength="100"
                                           ng-model="company_address">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-usd"></span> Пречисление услуг</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Позиция</th>
                                <th>Наименование</th>
                                <th>Стоимость за 1 месяц</th>
                                <th>Количество</th>
                                <th>Стоимость</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr data-ng-repeat="field in inventory_row track by $index">
                                <td><strong>{{$index + 1}}</strong></td>
                                <td>
                                    <!--                                        <select class="form-control" name="SellDataInventoryId[]" readonly="true" ng-options="option.name for option in dataInventory.availableOptions track by option.value"
                                                                                ng-model="field.inventory">
                                                                        </select>-->
                                    <input type="text" class="form-control" readonly="true"
                                           ng-model="field.inventoryText">
                                    <input type="hidden" value="{{field.inventoryId}}" name="SellDataInventoryId[]"
                                           ng-model="field.inventoryId">
                                    <!--    <input type="text" class="form-control" name="Inventory[]" placeholder="{{field.inventoryPlaceHolder}}" readonly="true" ng-model="field.inventory">-->
                                </td>
                                <td><input type="text" class="form-control" name="SellDataPrice[]"
                                           placeholder="{{field.inventoryPricePlaceHolder}}" readonly="true"
                                           ng-model="field.inventoryPrice"></td>
                                <td><input type="text" class="form-control" name="SellDataInventoryCount[]"
                                           placeholder="{{field.inventoryCountPlaceHolder}}" readonly="true"
                                           ng-model="field.inventoryCount"></td>
                                <td><input type="text" class="form-control" name="SellDataInventoryPriceAll[]"
                                           placeholder="{{field.inventoryPriceAllPlaceHolder}}" readonly="true"
                                           ng-model="field.inventoryPriceAll"></td>
                                <td>
                                    <button type="button" class="btn btn-danger" ng-click="removeChoice($index)">
                                        <span class="glyphicon glyphicon-minus"></span> Удалить
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <select class="form-control"
                                            ng-model="dataInventory"
                                            ng-options="option.inventory_name disable when option.id_inventory === null for option in InventoryName track by option.id_inventory"
                                            ng-change="changeInventory()">
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" readonly="true"
                                           ng-model="inventoryPriceValue"></td>
                                <td><select class="form-control"
                                            ng-options="option.name for option in dataCount.availableOptions track by option.value"
                                            ng-model="dataCount.selectedOption" ng-change="changeInventory()">
                                    </select></td>
                                <td><input type="text" class="form-control" readonly="true"
                                           ng-model="inventoryPriceAllValue"></td>
                                <td>
                                    <button type="button" class="btn btn-warning" ng-click="addNewChoice()"
                                            ng-hide="dataInventory.id_inventory == 0"><span
                                                class="glyphicon glyphicon-plus"></span> Добавить
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="alert alert-info">
                            <h4><strong>Итоговоя сумма: </strong>{{PriceAll}}</h4>
                        </div>
                    </div>
                </div>
                <div align="center" ng-hide="PriceAll == '0.00'">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span>
                        Создать счет на оплату
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
<script src="<?php echo base_url("resources/js/DealerSystem/InvoiceSochiCreateController.js"); ?>"></script>