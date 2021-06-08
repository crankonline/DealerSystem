app.controller('RequisitesShowController', ['$scope', '$uibModal', '$log', '$http', function ($scope, $uibModal, $log, $http) {
    //window.scope = $scope;

    let pc = this;
    pc.data = {
        Text: 'Сканированное изображение',
        Image: ''
    };

    $scope.showImage = function (file_ident) {
        $http.post('/index.php/requisites/get_image_reference', {
            file_ident: file_ident,
            large: true
        }).then(function (response) {
            pc.data.Image = response.data;
            let modalInstance = $uibModal.open({
                animation: true,
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                templateUrl: url,
                controller: 'ModalInstanceCtrl',
                controllerAs: 'pc',
                size: 'lg',
                resolve: {
                    data: () => pc.data
                }
            });
            modalInstance.result.then(function () {
            }, () => modalInstance.close());
        }, (response) => console.log(response.data))
    };
}]);

app.controller('ModalInstanceCtrl', function ($uibModalInstance, data) {
    let pc = this;
    pc.data = data;

    pc.ok = function () {
        pc.data = {};
        $uibModalInstance.close();
    };
});