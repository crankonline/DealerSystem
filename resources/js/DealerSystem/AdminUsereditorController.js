app.controller('AdminUsereditorController', ['$scope', '$http', 'orderByFilter', function ($scope, $http, orderBy) {
    window.scope = $scope;

    $scope.loadReference = (reference) => {
        $http.post('/index.php/admin/references', {
            reference: reference
        }).then((response) => {
            if (reference === admin_reference_type.get_users) {
                $scope.dataUsers = [{
                    "id_users": '0',
                    "name": 'Выберите пользователя'
                }].concat(orderBy(response.data, 'role_id', false));
                $scope.dataUsersSelect = $scope.dataUsers[$scope.dataUsers.findIndex(x => x.id_users == 0)];
            }
            if (reference === admin_reference_type.get_acl) {
                $scope.dataAcl = orderBy(response.data, 'id_acl', false);
            }
            if (reference === admin_reference_type.get_users_acl) {
                $scope.dataUsersAcl = response.data;
                if ($scope.SelectedUserAcl) {
                    $scope.changeUsersSelect();
                }
            }
            if (reference === admin_reference_type.get_role) {
                $scope.dataRole = orderBy(response.data, 'name', false);
            }
            if (reference === admin_reference_type.get_distributor) {
                $scope.dataDistributor = orderBy(response.data, 'id_distributor', false);
            }
        });
    }

    $scope.changeUsersSelect = () => {
        $scope.SelectedUserAcl = $scope.dataUsersAcl.filter((value) => {
            return value.users_id === $scope.dataUsersSelect.id_users;
        });
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

        $scope.NewPassword1 = '';
        $scope.NewPassword2 = '';

        $scope.loadReference(admin_reference_type.get_role);
        $scope.loadReference(admin_reference_type.get_distributor);
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

        $http.post('/index.php/admin/save_users_acl', {
            data: $scope.SelectedUserAcl
        }).then((response) => {
            $scope.loadReference(admin_reference_type.get_users_acl);
            alert('Привилегии успешно обновлены.');
        });
    }

    $scope.updateUsers = () => {
        if ($scope.NewPassword1 !== '') {
            $scope.dataUsersSelect.user_password = CryptoJS.SHA1($scope.NewPassword1).toString();
        }
        $http.post('/index.php/admin/update_users', {
            data: $scope.dataUsersSelect
        }).then((response) => {
            alert('Данные успешно обновлены.');
        });
    }

    $scope.loadReference(admin_reference_type.get_users);
    $scope.loadReference(admin_reference_type.get_acl);
    $scope.loadReference(admin_reference_type.get_users_acl);
}])
;