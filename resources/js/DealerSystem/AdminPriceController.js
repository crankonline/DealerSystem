app.controller('AdminPriceController', ['$scope', '$http', 'orderByFilter', function ($scope, $http, orderBy) {
    window.scope = $scope;

    $scope.dataInventoryBuffer = null;

    $scope.loadDataInventory = () => {
        $http.post('/index.php/invoice/invoice_reference', {
            reference: 'price'
        }).then((response) => {
            $scope.InventoryName = [{
                id_inventory: '0',
                inventory_name: 'Выберите значение',
                price: '0.00',
                inventory_type_id: 0
            }].concat(orderBy(response.data, 'inventory_name', false));
            $scope.dataInventoryBuffer = response.data;
            $scope.dataInventory = $scope.InventoryName[$scope.InventoryName.findIndex(x => x.id_inventory == 0)];
            $scope.changeInventory();
        });
    }

    $scope.changeInventory = () => {
        $scope.dataInventoryId = $scope.dataInventory.id_inventory;
        $scope.dataInventoryName = $scope.dataInventory.inventory_name;
        $scope.dataInventoryPrice = Math.ceil($scope.dataInventory.price);
    }

    $scope.savePrice = () => {
        if (!$scope.dataInventoryPrice || !$scope.dataInventoryName) {
            alert('Введите корректные данные.');
            return;
        }
        $http.post('/index.php/admin/save_price', {
            dataInventoryId: $scope.dataInventoryId,
            dataInventoryName: $scope.dataInventoryName,
            dataInventoryPrice: $scope.dataInventoryPrice
        }).then((response) => {
            $scope.loadDataInventory();
        }, (response) => {
            alert(response.data);
        });
    }

    $scope.loadDataInventory();

}]);