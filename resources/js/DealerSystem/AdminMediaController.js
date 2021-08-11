app.controller('AdminMediaController', ['$scope', '$http', 'orderByFilter', 'AdminServices',
    function ($scope, $http, orderBy, AdminServices) {
        window.scope = $scope;

        // $scope.loadReference = reference => {
        //     if (reference == admin_reference_type.get_files_type) {
        //         AdminServices.loadReference(admin_reference_type.get_files_type).then(result_file_type => {
        //             AdminServices.loadReference(admin_reference_type.get_files_owner).then(result_file_owner => {
        //                 angular.forEach(result_file_type, value => {
        //                     value.file_owner = result_file_owner[result_file_owner.findIndex(x => x.id_file_owner == value.file_owner_id)].name;
        //                 });
        //                 $scope.Files_type = result_file_type
        //             });
        //         });
        //     }
        // }
        //
        // $scope.searchMediaData = (data) => {
        //     AdminServices.loadReference(admin_reference_type.get_where_invoice, data).then(resultInvoice => {
        //         $scope.Invoice = resultInvoice[0];
        //         if (resultInvoice[0] != undefined) {
        //             AdminServices.loadReference(admin_reference_type.get_where_requisites, resultInvoice[0].id_invoice)
        //                 .then(resultRequisites => {
        //                     if (resultRequisites[0] != undefined) {
        //                         $scope.Invoice.Requisites = resultRequisites[0];
        //                         $scope.Invoice.Requisites.requisites_invoice_id = resultInvoice[0]; //chain object
        //                         $scope.Invoice.Requisites.json = JSON.parse($scope.Invoice.Requisites.json);
        //                         AdminServices.loadReference(admin_reference_type.get_where_files_juridical,
        //                             resultRequisites[0].id_requisites).then(resultFiles_juridical => {
        //                             angular.forEach(resultFiles_juridical, value => {
        //                                 value.filetype_id = $scope.Files_type[$scope.Files_type.findIndex(x => x.id_file_type = value.filetype_id)];
        //                             });
        //                             $scope.Invoice.Requisites.Files = orderBy(resultFiles_juridical, 'filetype_id.id_file_type', false);
        //                             console.log($scope.Invoice);
        //                         });
        //                     } else {
        //                         alert('У счета на оплату нет заявки.');
        //                     }
        //                 });
        //         } else {
        //             alert('Ничего не найден.');
        //         }
        //     });
        // }
        //$scope.loadReference(admin_reference_type.get_files_type);

        $scope.searchMediaData = data => {
            AdminServices.loadReference(admin_reference_type.get_where_invoice, data).then(resultInvoice => {
                if (resultInvoice[0] != undefined) {
                    $scope.Invoice = resultInvoice[0];
                    AdminServices.loadReference(admin_reference_type.get_where_requisites, resultInvoice[0].id_invoice)
                        .then(resultRequisites => {
                            $scope.Invoice.Requisites = resultRequisites[0];
                            $scope.Invoice.Requisites.json = JSON.parse($scope.Invoice.Requisites.json);
                            $scope.dataRepresentatives = $scope.Invoice.Requisites.json.common.representatives;
                        });
                } else {
                    alert('Ничего не найдено.');
                }
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