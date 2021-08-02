app.service('AdminServices', function ($http, $uibModal) {

    this.loadReference = (reference, data = null) => {
        return $http.post('/index.php/admin/references', {
            reference: reference,
            data: (data) ? {invoice_serial_number: data} : null
        }).then((response) => {
            if (reference === admin_reference_type.get_where_invoice) {
                return response.data;
            }
        }, (response) => {
            console.log('Error: ' + response.data)
        });
    }
});