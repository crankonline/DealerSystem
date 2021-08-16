app.controller('AdminDistributoreditorController', ['$scope', '$http', 'orderByFilter',
    'AdminServices', function ($scope, $http, orderBy, AdminServices) {
        window.scope = $scope;

        $scope.loadReference = (reference) => {
            if (reference === admin_reference_type.get_distributor) {
                if (!(window.document.URL.indexOf('distributor_create') + 1)) {
                    AdminServices.loadReference(reference).then((result) => {
                        $scope.dataDistributor = [{
                            "id_distributor": '0',
                            "full_name": 'Выберите дистрибьютора'
                        }].concat(orderBy(result, 'id_distributor', false));
                        $scope.dataDistributorSelect =
                            $scope.dataDistributor[$scope.dataDistributor.findIndex(x => x.id_distributor == 0)];
                    });
                }
            }
        }

        $scope.saveDistributor = () => {
            if ($scope.dataDistributorSelect.full_name === '' || $scope.dataDistributorSelect.short_name === '') {
                alert('Поле псевдоним и полное наименование должны быть заполнены');
                return;
            }
            AdminServices.callServices(admin_service_type.saveDistributor, $scope.dataDistributorSelect)
                .then(response => {
                    alert(response);
                    //$scope.loadReference(admin_reference_type.get_distributor);
                    location.reload(); //не могу понять почему не обновляется dataDistributor на странице
                });
        }

        $scope.deleteDistributor = () => {
            AdminServices.callServices(admin_service_type.deleteDistributor, $scope.dataDistributorSelect)
                .then(response => {
                    $scope.loadReference(admin_reference_type.get_distributor);
                    alert(response);
                });
        }

        $scope.loadReference(admin_reference_type.get_distributor);
    }]);