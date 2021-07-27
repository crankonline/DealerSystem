app.controller('AdminUsereditorController', ['$scope', '$http', 'orderByFilter', function ($scope, $http, orderBy) {
    window.scope = $scope;

    const reference_type = {
        get_users: 'get_users',
        get_acl: 'get_acl',
        get_users_acl: 'get_users_acl',
        save_users_acl: 'save_users_acl'
    };
    $scope.SelectedUserAcl = [];

    $scope.loadReference = (reference) => {
        $http.post('/index.php/admin/references', {
            reference: reference
        }).then((response) => {
            if (reference === reference_type.get_users) {
                $scope.dataUsers = [{
                    "id_users": '0',
                    "name": 'Выберите пользователя'
                }].concat(orderBy(response.data, 'role_id', false));
                $scope.dataUsersSelect = $scope.dataUsers[$scope.dataUsers.findIndex(x => x.id_users == 0)];
            }
            if (reference === reference_type.get_acl) {
                $scope.dataAcl = orderBy(response.data, 'id_acl', false);
            }
            if (reference === reference_type.get_users_acl) {
                $scope.dataUsersAcl = response.data;
            }
        });
    }

    $scope.changeUsersSelect = () => {
        $scope.SelectedUserAcl = $scope.dataUsersAcl.filter((value) => {
            return value.users_id === $scope.dataUsersSelect.id_users;
        });
        console.log($scope.SelectedUserAcl);
        angular.forEach($scope.dataAcl, (acl) => {
            acl.checked = false;
        });
        angular.forEach($scope.dataAcl, (acl) => {
            angular.forEach($scope.SelectedUserAcl, (user_acl) => {
                if (acl.id_acl === user_acl.acl_id) {
                    acl.checked = true;
                }
            });
        });
    }

    $scope.saveUserAcl = () => {
        $scope.SelectedUserAcl = [];
        angular.forEach($scope.dataAcl, (acl) => {
            if (acl.checked == true) {
                let item = {
                    users_id: $scope.dataUsersSelect.id_users,
                    acl_id: acl.id_acl,
                    access: 't'
                };
                $scope.SelectedUserAcl.push(item);
            }
        });

        console.log($scope.SelectedUserAcl);
        //$scope.loadReference($scope.SelectedUserAcl);
        $http.post('/index.php/admin/save_users_acl', {
            data : $scope.SelectedUserAcl
        }).then ((response) =>{

        });
    }

    $scope.loadReference(reference_type.get_users);
    $scope.loadReference(reference_type.get_acl);
    $scope.loadReference(reference_type.get_users_acl);
}]);