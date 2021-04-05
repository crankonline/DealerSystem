app.controller('InvoiceCreateController', ['$scope', '$http', 'orderByFilter', function ($scope, $http, orderBy) {
    window.scope = $scope;

    const inventory_type = {
        eds: 1,
        token: 2
    }

    $http.post('/index.php/invoice/invoice_reference', {
        reference: 'price'
    }).then(function (response) {
        $scope.InventoryName = [{
            id_inventory: '0',
            inventory_name: 'Выберите значение',
            price: '0.00',
            inventory_type_id: 0
        }].concat(orderBy(response.data.filter(function (value) {
            return value.inventory_type_id == inventory_type.eds ||
                value.inventory_type_id == inventory_type.token;
        }), 'inventory_name', false));
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
            inventory_type_id: $scope.dataInventory.inventory_type_id,
            inventoryPrice: $scope.inventoryPriceValue,
            inventoryCount: $scope.dataCount.selectedOption['value'],
            inventoryPriceAll: $scope.inventoryPriceAllValue
        });

        if ($scope.dataInventory.inventory_type_id == inventory_type.eds) {
            angular.forEach($scope.InventoryName, function (item) {
                if (item.inventory_type_id == inventory_type.eds) {
                    $scope.tmp.push($scope.InventoryName[$scope.InventoryName.findIndex(x => x.id_inventory == item.id_inventory)]);
                }
            });
            $scope.InventoryName = $scope.InventoryName.filter(function (value, index, arr) {
                return value.inventory_type_id != inventory_type.eds;
            });
        } else {
            $scope.InventoryName.splice($scope.InventoryName.findIndex(x => x.id_inventory == $scope.dataInventory.id_inventory), 1); //удаляем из массива выбранное
        }
        $scope.calculate();
        $scope.dataCount.selectedOption = $scope.dataCount.availableOptions[0];//значение по умолчанию
        $scope.dataInventory = $scope.InventoryName[$scope.InventoryName.findIndex(x => x.id_inventory == 0)];
        $scope.InventoryName = orderBy($scope.InventoryName, 'inventory_name', false);
    };
    $scope.removeChoice = function (z) {
        if ($scope.inventory_row[z].inventory_type_id == inventory_type.eds) {
            angular.forEach($scope.tmp, function (item) {
                if (item.inventory_type_id == inventory_type.eds) {
                    $scope.InventoryName.push($scope.tmp[$scope.tmp.findIndex(x => x.id_inventory == item.id_inventory)]);
                }
            });
            $scope.tmp = $scope.tmp.filter(function (value) {
                return value.inventory_type_id != inventory_type.eds;
            });
        } else {
            $scope.InventoryName.splice($scope.inventory_row[z].inventoryId, 0, {
                id_inventory: $scope.inventory_row[z].inventoryId,
                inventory_name: $scope.inventory_row[z].inventoryText,
                price: $scope.inventory_row[z].inventoryPrice
            });
        }//добавляем в массив удаленный улемент с соблюдением порядкового номера (наркомания просто)
        $scope.inventory_row.splice(z, 1);
        $scope.calculate();
        $scope.InventoryName = orderBy($scope.InventoryName, 'inventory_name', false);
    };
    $scope.searchInn = function () {
        if ($scope.Inn && $scope.Inn.length == 14) {
            $http.post('/index.php/invoice/invoice_reference', {
                reference: 'inn',
                id: $scope.Inn
            }).then(function (response) {
                $scope.company_name = response.data.company_name;
            }, function (response) {
            });
        }
    };
}]);