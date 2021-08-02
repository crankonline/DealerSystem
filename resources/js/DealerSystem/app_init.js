let app = angular.module('DealerSystem',
    ['ngFileUpload', 'checklist-model', 'ngCookies', 'ui.bootstrap', 'wipImageZoom']);

app.directive('gkedMask', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    let transformedInput = text.replace(/[^0-9.]/g, '');
                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return undefined;
            }

            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});

app.directive('numbersOnly', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    let transformedInput = text.replace(/[^0-9]/g, '');
                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return null;
            }

            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});

app.directive('moneyOnly', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    let transformedInput = text.replace(/[^0-9-]/g, '');
                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return null;
            }

            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});

app.directive('telephoneCell', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    let transformedInput = text.replace(/[^0-9, ]/g, '');
                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return null;
            }

            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});

app.directive('passportOnly', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    let transformedInput = text.replace(/[^A-Z0-9\-]/g, '');
                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return null;
            }

            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});

app.directive('upperCase', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attrs, modelCtrl) {
            let upperCaseFunc = function (inputValue) {

                if (typeof inputValue == "undefined") {
                    return;
                }
                let upperCasedString = inputValue.toUpperCase();
                if (upperCasedString !== inputValue) {
                    modelCtrl.$setViewValue(upperCasedString);
                    modelCtrl.$render();
                }
                return upperCasedString;
            }
            modelCtrl.$parsers.push(upperCaseFunc);
            upperCaseFunc(scope[attrs.ngModel]);
        }
    };
});

app.directive('dateMask', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    let transformedInput = text.replace(/[^0-9.]/g, '');
                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return null;
            }

            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});

app.directive('fioMask', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    let transformedInput = text.replace(/[^А-Яа-я ]/g, '');
                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return null;
            }

            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});

app.directive('trimValidator', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    let transformedInput = text.trim();
                    ngModelCtrl.$setViewValue(transformedInput);
                    ngModelCtrl.$render();
                    return transformedInput;
                }
                return null;
            }

            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});


app.service('shareData', function () {
    return {
        setData: setData,
        getData: getData,
        shared_data: {}
    }

    function setData(data) {
        this.shared_data = data
    }

    function getData() {
        return this.shared_data
    }
});

app.service('ModalImageService', function ($http, $uibModal) {
    let pc = this;
    pc.data = {
        Text: 'Сканированное изображение',
        Image: ''
    };
    this.ShowModalImage = function (file_ident) {
        $http.post('/index.php/requisites/get_image_reference', {
            file_ident: file_ident,
            large: true
        }).then(function (response) {
            pc.data.Image = response.data;
            let modalInstance = $uibModal.open({
                animation: true,
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                template:
                    '<div class="modal-body" id="modal-body">\n' +
                    '    <img id="modal-image" \n' +
                    '         wip-image-zoom\n' +
                    '         ng-src="{{pc.data.Image}}">\n' +
                    '</div>\n' +
                    '<div class="modal-footer">\n' +
                    '    <button class="btn btn-primary" type="button" ng-click="pc.ok()">OK</button>\n' +
                    '</div>',
                controller: 'ModalInstanceCtrl',
                controllerAs: 'pc',
                size: 'customImageSize',
                resolve: {
                    data: () => pc.data
                }
            });
            modalInstance.result.then(function () {
            }, () => modalInstance.close());
        }, (response) => console.log(response.data))
    };
});

const admin_reference_type = {
    get_users: 'get_users',
    get_acl: 'get_acl',
    get_users_acl: 'get_users_acl',
    save_users_acl: 'save_users_acl',
    get_role: 'get_role',
    get_distributor: 'get_distributor',
    get_where_invoice: 'get_where_invoice',
    get_where_requisites: 'get_where_requisites'
};