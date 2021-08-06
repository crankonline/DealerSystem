app.controller('AdminUsereditorController', ['$scope', '$http', 'orderByFilter',
    'AdminServices', function ($scope, $http, orderBy, AdminServices) {
        window.scope = $scope;

        $scope.loadReference = (reference) => {
            if (reference === admin_reference_type.get_users) {
                if (!(window.document.URL.indexOf('user_create') + 1)) {
                    AdminServices.loadReference(admin_reference_type.get_users).then((result_get_users) => {
                        $scope.dataUsers = [{
                            "id_users": '0',
                            "name": 'Выберите пользователя'
                        }].concat(orderBy(result_get_users, 'role_id', false));
                        $scope.dataUsersSelect = $scope.dataUsers[$scope.dataUsers.findIndex(x => x.id_users == 0)];
                    });
                } else {
                    $scope.dataUsersSelect = {
                        'role_id': '3',
                        'distributor_id': '1'
                    }
                }
            }
            if (reference === admin_reference_type.get_acl) {
                AdminServices.loadReference(admin_reference_type.get_acl).then((result_get_acl) => {
                    $scope.dataAcl = orderBy(result_get_acl, 'id_acl', false);
                });
            }
            if (reference === admin_reference_type.get_users_acl) {
                AdminServices.loadReference(admin_reference_type.get_users_acl).then((result_get_users_acl) => {
                    $scope.dataUsersAcl = result_get_users_acl
                    if ($scope.SelectedUserAcl) {
                        $scope.changeUsersSelect();
                    }
                });
            }
            if (reference === admin_reference_type.get_role) {
                AdminServices.loadReference(admin_reference_type.get_role).then((result_get_role) => {
                    $scope.dataRole = orderBy(result_get_role, 'name', false);
                });
            }
            if (reference === admin_reference_type.get_distributor) {
                AdminServices.loadReference(admin_reference_type.get_distributor).then((result_get_distributor) => {
                    $scope.dataDistributor = orderBy(result_get_distributor, 'id_distributor', false);
                });
            }
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
            AdminServices.callServices(admin_service_type.saveUserAcl, $scope.SelectedUserAcl).then(response => {
                $scope.loadReference(admin_reference_type.get_users_acl);
                alert(response);
            });
        }

        $scope.saveUsers = () => {
            if ($scope.NewPassword1 !== '') {
                $scope.dataUsersSelect.user_password = CryptoJS.SHA1($scope.NewPassword1).toString();
            }
            AdminServices.callServices(admin_service_type.saveUsers, $scope.dataUsersSelect).then(response => {
                alert(response);
                //$scope.loadReference(admin_reference_type.get_users);
                location.reload();
            });
        }

        $scope.deleteUsers = () => {
            AdminServices.callServices(admin_service_type.deleteUsers, $scope.dataUsersSelect).then(response => {
                $scope.loadReference(admin_reference_type.get_users);
                alert(response);
            });
        }

        $scope.loadReference(admin_reference_type.get_role);
        $scope.loadReference(admin_reference_type.get_distributor);
        $scope.loadReference(admin_reference_type.get_users);
        $scope.loadReference(admin_reference_type.get_acl);
        $scope.loadReference(admin_reference_type.get_users_acl);
    }])
;