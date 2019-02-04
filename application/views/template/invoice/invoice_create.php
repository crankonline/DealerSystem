<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container theme-showcase" role="main" ng-app="InvoiceConstruct">
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <strong>Oh snap! </strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            <strong>Памятка: </strong>Внимательно заполните поля ИНН, НАИМЕНОВАНИЕ КОМПАНИИ и ТОВАРОНО МЕТЕРИАЛЬНЫХ ЦЕННОСТЕЙ!!!
        </div>
        <form action="<?php echo base_url(); ?>index.php/invoice/invoice_create_save/" method="post">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span> Основные реквизиты</h3>
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
                                       ng-model="val">
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
                                       maxlength="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div ng-controller="IvoiceController">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-usd"></span> Пречисление товарно материальных ценностей</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Позиция</th>
                                    <th>Наименование</th>
                                    <th>Стоимость за 1 ед.</th>
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
                <div align="center" ng-hide="PriceAll == '0.00'" ><button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Создать счет на оплату</button></div>
            </div>
        </form>
    <?php endif; ?>
</div>

<script type="text/javascript">
    // Code goes here
    var app = angular.module('InvoiceConstruct', []);
    app.controller('IvoiceController', ['$scope','$http','$window', function ($scope, $http, $window) {
        window.scope = $scope;

        $http.post('<?php echo base_url(); ?>index.php/invoice/invoice_price_reference', {}).
                            then(function (response) {
                                $scope.InventoryName = [{id_inventory: '0', inventory_name: 'Выберите значение', price:'0.00'}].concat(response.data);
                                $scope.dataInventory = $scope.InventoryName[$scope.InventoryName.findIndex(x => x.id_inventory == 0)];
                            });                           

        $scope.dataCount = {
            availableOptions: [
                {value: '1', name: 'Количество - 1'},
                {value: '2', name: 'Количество - 2'},
                {value: '3', name: 'Количество - 3'},
                {value: '4', name: 'Количество - 4'},
                {value: '5', name: 'Количество - 5'},
                {value: '6', name: 'Количество - 6'},
                {value: '7', name: 'Количество - 7'},
                {value: '8', name: 'Количество - 8'},
                {value: '9', name: 'Количество - 9'},
                {value: '10', name: 'Количество - 10'},
                {value: '11', name: 'Количество - 11'},
                {value: '12', name: 'Количество - 12'}
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
        $scope.addNewChoice = function () {
            $scope.inventory_row.push({
                inventoryText: $scope.dataInventory.inventory_name,
                inventoryId: $scope.dataInventory.id_inventory,
                inventoryPrice: $scope.inventoryPriceValue,
                inventoryCount: $scope.dataCount.selectedOption['value'],
                inventoryPriceAll: $scope.inventoryPriceAllValue
            });
  
            $scope.InventoryName.splice($scope.InventoryName.findIndex(x => x.id_inventory == $scope.dataInventory.id_inventory),1); //удаляем из массива выбранное
            $scope.calculate();
            $scope.dataCount.selectedOption = $scope.dataCount.availableOptions[0];//значение по умолчанию

            //$scope.changeInventory($scope.dataInventory.selectedOption.value);
            $scope.dataInventory = $scope.InventoryName[$scope.InventoryName.findIndex(x => x.id_inventory == 0)];
        };
        $scope.removeChoice = function (z) {
            $scope.InventoryName.splice($scope.inventory_row[z].inventoryId, 0, {id_inventory: $scope.inventory_row[z].inventoryId, inventory_name: $scope.inventory_row[z].inventoryText, price: $scope.inventory_row[z].inventoryPrice});//добавляем в массив удаленный улемент с соблючдением порядкового номера (наркомания просто)            
            $scope.inventory_row.splice(z, 1);
            $scope.calculate();
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