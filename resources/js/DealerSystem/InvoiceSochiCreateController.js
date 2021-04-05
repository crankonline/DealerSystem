app.controller('InvoiceSochiCreateController', ['$scope', '$http', '$window', 'orderByFilter', function ($scope, $http, $window, orderBy) {
    window.scope = $scope;

    const inventory_type = {
        form: 3
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
            return value.inventory_type_id == inventory_type.form;
        }), 'inventory_name', false));
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

        $scope.InventoryName.splice($scope.InventoryName.findIndex(x => x.id_inventory == $scope.dataInventory.id_inventory), 1); //удаляем из массива выбранное
        $scope.calculate();
        $scope.dataCount.selectedOption = $scope.dataCount.availableOptions[0];//значение по умолчанию
        $scope.dataInventory = $scope.InventoryName[$scope.InventoryName.findIndex(x => x.id_inventory == 0)];
        $scope.InventoryName = orderBy($scope.InventoryName, 'inventory_name', false);
    };
    $scope.removeChoice = function (z) {
        $scope.InventoryName.splice($scope.inventory_row[z].inventoryId, 0, {
            id_inventory: $scope.inventory_row[z].inventoryId,
            inventory_name: $scope.inventory_row[z].inventoryText,
            price: $scope.inventory_row[z].inventoryPrice
        });
        //добавляем в массив удаленный улемент с соблючдением порядкового номера (наркомания просто)
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
                $scope.company_city = response.data.city;
                response.data.apartment = response.data.apartment == null ? '' : ', ' + response.data.apartment;
                $scope.company_address = response.data.street + ', ' + response.data.building +
                    response.data.apartment;
                $scope.company_bankbik = response.data.bankbik;
                $scope.company_bankname = response.data.bankname;
                $scope.company_bankaccount = response.data.bankaccount;

            }, function (response) {

            });
        }
    };
}]);