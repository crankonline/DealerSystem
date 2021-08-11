const admin_reference_type = {
    get_users: 'get_users',
    get_acl: 'get_acl',
    get_users_acl: 'get_users_acl',
    save_users_acl: 'save_users_acl',
    get_role: 'get_role',
    get_distributor: 'get_distributor',
    get_where_invoice: 'get_where_invoice',
    get_where_requisites: 'get_where_requisites',
    get_where_files_juridical: 'get_where_files_juridical',
    get_files_type: 'get_files_type',
    get_files_owner: 'get_files_owner'
};

const admin_service_type = {
    saveUserAcl: 'save_users_acl',
    saveUsers: 'save_users',
    deleteUsers: 'delete_users',
    saveDistributor: 'save_distributor',
    deleteDistributor: 'delete_distributor'
}

app.service('AdminServices', function ($http) {

    this.callServices = (url_part, data) => {
        return $http.post('/index.php/admin/' + url_part, {
            data: data
        }).then(response => {
            return response.data
        }, response => {
            console.log('Error: ' + response.data);
        });

    }

    this.loadReference = (reference, data = null) => {
        return $http.post('/index.php/admin/references', {
            reference: reference,
            data: data
        }).then(response => {
            return response.data;
        }, response => {
            console.log('Error: ' + response.data);
        });
    }
});