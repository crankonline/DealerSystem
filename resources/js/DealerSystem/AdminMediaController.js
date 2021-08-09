app.controller('AdminMediaController', ['$scope', '$http', 'orderByFilter', 'AdminServices',
    function ($scope, $http, orderBy, AdminServices) {
        window.scope = $scope;

        $scope.searchMediaData = (data) => {
            let PromiseInvoice = AdminServices.loadReference(admin_reference_type.get_where_invoice, data);
            PromiseInvoice.then((resultInvoice) => {
                let id_invoice = resultInvoice.id_invoice;
                let PromiseRequisites = AdminServices.loadReference(admin_reference_type.get_where_requisites, data);
                //console.log(invoice_id);
            });
        }
    }]);