<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container theme-showcase" role="main" ng-app="InvoiceConstruct">
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <strong>Oh snap! </strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>
<!--        <div class="alert alert-warning">-->
<!--            <strong>Памятка: </strong>Внимательно заполните поля ИНН, НАИМЕНОВАНИЕ КОМПАНИИ и ТОВАРОНО МЕТЕРИАЛЬНЫХ ЦЕННОСТЕЙ!!!-->
<!--        </div>-->
        <form action="<?php echo base_url(); ?>index.php/invoice_sochi/invoice_create_save/" method="post">
        <div ng-controller="IvoiceController">  
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span> Основные реквизиты баланс СОчИ</h3>
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
                                        <input type="text" class="form-control" readonly="true" ng-model="field.inventoryText">
                                        <input type="hidden" value="{{field.inventoryId}}" name="SellDataInventoryId[]" ng-model="field.inventoryId">
                                    <!--    <input type="text" class="form-control" name="Inventory[]" placeholder="{{field.inventoryPlaceHolder}}" readonly="true" ng-model="field.inventory">-->
                                    </td>                        
                                    <td><input type="text" class="form-control" name = "SellDataPrice[]" placeholder="{{field.inventoryPricePlaceHolder}}" readonly="true" ng-model="field.inventoryPrice"></td>
                                    <td><input type="text" class="form-control" name = "SellDataInventoryCount[]" placeholder="{{field.inventoryCountPlaceHolder}}" readonly="true" ng-model="field.inventoryCount"></td>
                                    <td><input type="text" class="form-control" name = "SellDataInventoryPriceAll[]" placeholder="{{field.inventoryPriceAllPlaceHolder}}" readonly="true" ng-model="field.inventoryPriceAll"></td>
                                    <td><button type="button" class="btn btn-danger" ng-click="removeChoice($index)"><span class="glyphicon glyphicon-minus"></span> Удалить</button></td>
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
                                    <td><input type="text" class="form-control" readonly="true" ng-model="inventoryPriceValue"></td>
                                    <td><select class="form-control"  ng-options="option.name for option in dataCount.availableOptions track by option.value" 
                                                ng-model="dataCount.selectedOption" ng-change="changeInventory()">
                                        </select></td>
                                    <td><input type="text" class="form-control" readonly="true" ng-model="inventoryPriceAllValue"></td>
                                    <td><button type="button" class="btn btn-warning" ng-click="addNewChoice()" ng-hide="dataInventory.id_inventory == 0"><span class="glyphicon glyphicon-plus"></span> Добавить</button></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="alert alert-info">
                            <h4><strong>Итоговоя сумма: </strong>{{PriceAll}}</h4>
                        </div>
                    </div>
                </div>
                <div align="center" ng-hide="PriceAll == '0.00'" >
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Создать счет на оплату</button>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>

<script type="text/javascript">
    // Code goes here
    var app = angular.module('InvoiceConstruct', []);
    app.controller('IvoiceController', ['$scope', '$http', '$window', 'orderByFilter', function ($scope, $http, $window, orderBy) {
            window.scope = $scope;

            //$scope.inn = '1';
            //$scope.company_name = '1';
            $http.post('<?php echo base_url(); ?>index.php/invoice/invoice_reference', {reference: 'price_sochi'}).
                    then(function (response) {
                        $scope.InventoryName = [{id_inventory: '0', inventory_name: 'Выберите значение', price: '0.00'}].concat(response.data);
                        $scope.dataInventory = $scope.InventoryName[$scope.InventoryName.findIndex(x => x.id_inventory == 0)];
                    });

            $scope.dataCount = {
                availableOptions: [
                    {value: '1', name: '1 - месяц'},
                    {value: '2', name: '2 - месяца'},
                    {value: '3', name: '3 - месяца'},
                    {value: '4', name: '4 - месяца'},
                    {value: '5', name: '5 - месяцев'},
                    {value: '6', name: '6 - месяцев'},
                    {value: '7', name: '7 - месяцев'},
                    {value: '8', name: '8 - месяцев'},
                    {value: '9', name: '9 - месяцев'},
                    {value: '10', name: '10 - месяцев'},
                    {value: '11', name: '11 - месяцев'},
                    {value: '12', name: '12 - месяцев'}
                ],
                selectedOption: {value: '1', name: 'Количество - 1'} //This sets the default value of the select in the ui
            };

            $scope.inventoryPriceValue = '0.00';
            $scope.inventoryPriceAllValue = $scope.inventoryPriceValue * $scope.dataCount.selectedOption['value'];
            $scope.PriceAll = '0.00';


            $scope.changeInventory = function () {
                $scope.inventoryPriceValue = $scope.dataInventory.price;
                $scope.inventoryPriceAllValue = ($scope.dataInventory.price * $scope.dataCount.selectedOption['value']).toFixed(2);
            };

            $scope.calculate = function () {
                $scope.PriceAll = '0.00';
                angular.forEach($scope.inventory_row, function (value) {
                    $scope.PriceAll = parseFloat($scope.PriceAll) + parseFloat(value.inventoryPriceAll);
                });
                $scope.inventoryPriceValue = '0.00';//значение по умолчанию
                $scope.inventoryPriceAllValue = '0.00';//значение по умолчанию
            };

            $scope.inventory_row = [];
            $scope.tmp = [];
            $scope.addNewChoice = function () {
                $scope.inventory_row.push({
                    inventoryText: $scope.dataInventory.inventory_name,
                    inventoryId: $scope.dataInventory.id_inventory,
                    inventoryPrice: $scope.inventoryPriceValue,
                    inventoryCount: $scope.dataCount.selectedOption['value'],
                    inventoryPriceAll: $scope.inventoryPriceAllValue
                });

                if ($scope.dataInventory.id_inventory == 1 || $scope.dataInventory.id_inventory == 3 || $scope.dataInventory.id_inventory == 5 || $scope.dataInventory.id_inventory == 6) { // тип тмц брать из БД
                    $scope.tmp.push($scope.InventoryName[$scope.InventoryName.findIndex(x => x.id_inventory == 1)]);
                    $scope.tmp.push($scope.InventoryName[$scope.InventoryName.findIndex(x => x.id_inventory == 3)]);
                    $scope.tmp.push($scope.InventoryName[$scope.InventoryName.findIndex(x => x.id_inventory == 5)]);
                    $scope.tmp.push($scope.InventoryName[$scope.InventoryName.findIndex(x => x.id_inventory == 6)]);
                    $scope.tmp.push($scope.InventoryName[$scope.InventoryName.findIndex(x => x.id_inventory == 9)]);

                    $scope.InventoryName.splice($scope.InventoryName.findIndex(x => x.id_inventory == 1), 1);
                    $scope.InventoryName.splice($scope.InventoryName.findIndex(x => x.id_inventory == 3), 1);
                    $scope.InventoryName.splice($scope.InventoryName.findIndex(x => x.id_inventory == 5), 1);
                    $scope.InventoryName.splice($scope.InventoryName.findIndex(x => x.id_inventory == 6), 1);
                    $scope.InventoryName.splice($scope.InventoryName.findIndex(x => x.id_inventory == 9), 1);
                } else {
                    $scope.InventoryName.splice($scope.InventoryName.findIndex(x => x.id_inventory == $scope.dataInventory.id_inventory), 1); //удаляем из массива выбранное
                }
                $scope.calculate();
                $scope.dataCount.selectedOption = $scope.dataCount.availableOptions[0];//значение по умолчанию

                //$scope.changeInventory($scope.dataInventory.selectedOption.value);
                $scope.dataInventory = $scope.InventoryName[$scope.InventoryName.findIndex(x => x.id_inventory == 0)];
            };
            $scope.removeChoice = function (z) {
                if ($scope.inventory_row[z].inventoryId == 1 || $scope.inventory_row[z].inventoryId == 3 || $scope.inventory_row[z].inventoryId == 5 || $scope.inventory_row[z].inventoryId == 6) {// тип тмц брать из БД
                    $scope.InventoryName = $scope.InventoryName.concat($scope.tmp);
                    $scope.InventoryName = orderBy($scope.InventoryName, 'id_inventory', false);
                }else{

                $scope.InventoryName.splice($scope.inventory_row[z].inventoryId, 0, {
                    id_inventory: $scope.inventory_row[z].inventoryId,
                    inventory_name: $scope.inventory_row[z].inventoryText,
                    price: $scope.inventory_row[z].inventoryPrice
                });}//добавляем в массив удаленный улемент с соблючдением порядкового номера (наркомания просто)            
                $scope.inventory_row.splice(z, 1);
                $scope.calculate();
            };
            $scope.searchInn = function() {
                if($scope.Inn && $scope.Inn.length == 14) {
                    $http.post('<?php echo base_url(); ?>index.php/invoice/invoice_reference', {reference: 'inn', id: $scope.Inn}).
                    then(function (response) {                       
                        $scope.company_name = response.data.company_name;
                        $scope.company_city = response.data.city;
                        response.data.apartment = response.data.apartment == null ? '': ', '+response.data.apartment;
                        $scope.company_address = response.data.street + ', ' + response.data.building +
                            response.data.apartment ;
                        $scope.company_bankbik = response.data.bankbik;
                        $scope.company_bankname = response.data.bankname;
                        $scope.company_bankaccount = response.data.bankaccount;

                    }, function (response){
                        
                    });
                }
            };
        }]);

    app.directive('numbersOnly', function () {
        return {
            require: 'ngModel',
            link: function (scope, element, attr, ngModelCtrl) {
                function fromUser(text) {
                    if (text) {
                        var transformedInput = text.replace(/[^0-9]/g, '');

                        if (transformedInput !== text) {
                            ngModelCtrl.$setViewValue(transformedInput);
                            ngModelCtrl.$render();
                        }
                        return transformedInput;
                    }
                    return undefined;
                }
                ngModelCtrl.$parsers.push(fromUser);
            }
        };
    });

</script>