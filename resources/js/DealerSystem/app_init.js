let app = angular.module('DealerSystem', ['ngFileUpload', 'checklist-model', 'ngCookies']);

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

app.directive('passportOnly', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    let transformedInput = text.replace(/[^A-Z0-9]/g, '');
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
                return undefined;
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