app.controller('RequisitesShowController', ['$scope', '$uibModal', '$log', '$http', 'ModalImageService',
    function ($scope, $uibModal, $log, $http, ModalImageService) {
    //window.scope = $scope;

    let pc = this;
    pc.data = {
        Text: 'Сканированное изображение',
        Image: ''
    };

    $scope.showImage = function (file_ident){
        ModalImageService.ShowModalImage(file_ident);
    }
}]);