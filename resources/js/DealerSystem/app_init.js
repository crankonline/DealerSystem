let app = angular.module('DealerSystem', ['ngFileUpload', 'checklist-model', 'ngCookies']);
app.directive('gkedMask', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    var transformedInput = text.replace(/[^0-9.]/g, '');
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
                    var transformedInput = text.replace(/[^0-9]/g, '');
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
            var upperCaseFunc = function (inputValue) {

                if (typeof inputValue == "undefined") {
                    return;
                }

                var upperCasedString = inputValue.toUpperCase();
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