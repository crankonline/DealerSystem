app.controller('InvoiceCreateController', ['$scope', '$http', 'orderByFilter', function ($scope, $http, orderBy) {
    window.scope = $scope;

    $http.post('/index.php/invoice/invoice_reference', {
        reference: 'price'
    }).then(function (response) {
        $scope.InventoryName = [{
            id_inventory: '0',
            inventory_name: 'Выберите значение',
            price: '0.00'
        }].concat(response.data);
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
    $scope.tmp = [];
    $scope.addNewChoice = function () {
        $scope.inventory_row.push({
            inventoryText: $scope.dataInventory.inventory_name,
            inventoryId: $scope.dataInventory.id_inventory,
            inventoryPrice: $scope.inventoryPriceValue,
            inventoryCount: $scope.dataCount.selectedOption['value'],
            inventoryPriceAll: $scope.inventoryPriceAllValue
        });

        if ($scope.dataInventory.id_inventory == 1 || $scope.dataInventory.id_inventory == 3 ||
            $scope.dataInventory.id_inventory == 5 || $scope.dataInventory.id_inventory == 6) { // тип тмц брать из БД
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
        if ($scope.inventory_row[z].inventoryId == 1 || $scope.inventory_row[z].inventoryId == 3 ||
            $scope.inventory_row[z].inventoryId == 5 || $scope.inventory_row[z].inventoryId == 6) {// тип тмц брать из БД
            $scope.InventoryName = $scope.InventoryName.concat($scope.tmp);
            $scope.tmp=[];
            $scope.InventoryName = orderBy($scope.InventoryName, 'id_inventory', false);
        } else {

            $scope.InventoryName.splice($scope.inventory_row[z].inventoryId, 0, {
                id_inventory: $scope.inventory_row[z].inventoryId,
                inventory_name: $scope.inventory_row[z].inventoryText,
                price: $scope.inventory_row[z].inventoryPrice
            });
        }//добавляем в массив удаленный улемент с соблюдением порядкового номера (наркомания просто)
        $scope.inventory_row.splice(z, 1);
        $scope.calculate();
    };
    $scope.searchInn = function () {
        if ($scope.Inn && $scope.Inn.length == 14) {
            $http.post('<?php echo base_url(); ?>index.php/invoice/invoice_reference', {
                reference: 'inn',
                id: $scope.Inn
            }).then(function (response) {
                $scope.company_name = response.data.company_name;
            }, function (response) {

            });
        }
    };
}]);