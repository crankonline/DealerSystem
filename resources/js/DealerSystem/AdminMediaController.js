app.controller('AdminMediaController', ['$scope', '$http', 'orderByFilter', 'AdminServices',
    function ($scope, $http, orderBy, AdminServices) {
        window.scope = $scope;

        $scope.searchMediaData = data => {
            AdminServices.loadReference(admin_reference_type.get_where_invoice, data).then(resultInvoice => {
                if (resultInvoice[0]) {
                    $scope.Invoice = resultInvoice[0];
                    AdminServices.loadReference(admin_reference_type.get_where_requisites, resultInvoice[0].id_invoice)
                        .then(resultRequisites => {
                            if(resultRequisites[0]) {
                                $scope.Invoice.Requisites = resultRequisites[0];
                                $scope.Invoice.Requisites.json = JSON.parse($scope.Invoice.Requisites.json);
                                $scope.dataRepresentatives = $scope.Invoice.Requisites.json.common.representatives;
                            } else{
                                alert('У счета на оплату нет заявки.');
                            }
                        });
                } else {
                    alert('Ничего не найдено.');
                }
            });
        }

        $scope.uploadFile = () => {
            AdminServices.callServices(admin_service_type.uploadFile, {
                id_requisites: $scope.Invoice.Requisites.id_requisites,
                id_file_type: $scope.dataFilesTypeSelected.id_file_type,
                rep_ident: $scope.dataRepresentativesSelected ?
                    $scope.dataRepresentativesSelected.person.passport.number : $scope.Invoice.inn,
                file: $scope.dataFileSelected
            }).then(result => {
                alert('Файл ' + result.data.client_name + 'сохранен.');
                location.reload();
            }, result => {
                alert('Ошибка: ' + result.data);
            }, evt => {
                $scope.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });
        }

        $scope.loadReference = reference => {
            if (reference == admin_reference_type.get_files_owner) {
                AdminServices.loadReference(reference).then(result => {
                    $scope.dataFilesOwner = [{
                        'id_file_owner': '0',
                        'name': 'Выберите тип владельца изображения'
                    }].concat(result);
                    $scope.dataFilesOwnerSelected = $scope.dataFilesOwner
                        [$scope.dataFilesOwner.findIndex(x => x.id_file_owner == 0)];
                });
            }
            if (reference == admin_reference_type.get_files_type) {
                AdminServices.loadReference(reference).then(result => {
                    $scope.dataFilesType = result;
                });
            }
        }
        $scope.loadReference(admin_reference_type.get_files_owner);
        $scope.loadReference(admin_reference_type.get_files_type);
    }]);