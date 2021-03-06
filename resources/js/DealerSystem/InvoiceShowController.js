app.controller('InvoiceShowController', ['$scope', '$http', '$cookies', 'shareData', '$interval',
    function ($scope, $http, $cookies, shareData, $interval) {
        window.scope = $scope;
        window.cookies = $cookies;

        $scope.filteredChoices = [];
        $scope.isVisible = [];

        $scope.count_eds = eds_count;
        $scope.isVisible = [...new Array($scope.count_eds)].map(v => ({suggestions: false}));

        $scope.enteredFio = [];
        $scope.enteredPin = [];

        $scope.choices = [];
        $scope.items = [];

        $scope.text = '';
        $scope.minlength = 5;
        $scope.selected = {};

        $scope.representatives = '';

        $scope.range = function (min, max, step) {
            step = step || 1;
            let input = [];
            for (let i = min; i < max; i += step) {
                input.push(i);
            }
            return input;
        };

        $scope.filterItems = function (key) {
            if ($scope.enteredPin[key] != null) {
                if ($scope.minlength <= $scope.enteredPin[key].length) {
                    let queryPromise = querySearch($scope.enteredPin[key]);
                    queryPromise.then(function (result) {
                        $scope.filteredChoices = result;
                        $scope.isVisible[key].suggestions = $scope.filteredChoices.length > 0 ? true : false;
                    });
                } else {
                    $scope.isVisible[key].suggestions = false;
                }
            }
        };

        /**
         * Takes one based index to save selected choice object
         */
        $scope.selectItem = function (index, key) {
            $scope.selected = $scope.choices [$scope.choices.findIndex(x => x.pin == index)];
            $scope.enteredPin[key] = $scope.selected.pin;
            $scope.enteredFio[key] = $scope.selected.fio;
            $scope.isVisible[key].suggestions = false;
        };

        /**
         * Search for states... use $timeout to simulate
         * remote dataservice call.
         */
        function querySearch(query) {
            //returns list of filtered items
            return $http.post('/index.php/invoice/invoice_reference', {
                reference: 'search_rep_by_pin',
                id: query
            }).then(response => {
                let dataEmpty = [{
                    fio: '???????????? ???? ??????????????',
                    pin: query
                }];
                if (response.data === '' && $scope.representatives !== '') {
                    response.data = $scope.representatives
                }
                if (response.data === '' && $scope.representatives === '') {
                    response.data = dataEmpty;
                }
                $scope.choices = response.data
                $scope.items = response.data;
                let filterResult = $scope.choices.filter(createFilterFor(query));
                if (filterResult.length == 0) {
                    return dataEmpty;
                } else {
                    return filterResult;
                }
            }, response => {
                console.log("Error: " + response.data);
                return [];
            });
        }

        /**
         * Create filter function for a query string
         */
        function createFilterFor(query) {
            let lowercaseQuery = query;//angular.lowercase(query);
            return function filterFn(item) {
                // Check if the given item matches for the given query
                let label = item.pin;//angular.lowercase(item.label);
                return (label.indexOf(lowercaseQuery) === 0);
            };
        }

        $scope.validateForm = function () {
            /* ???????????? ???? ???????????????? ????????????, ???????????? ?????????? ???????? ?????????????? ?? ???????????? ????????????????????????, ???? ?????? ?????? ??????????????, ???????????????????? */
            if ($scope.enteredPin && $scope.enteredPin.length > 0) {
                let objects_pin = {
                    id_invoice: id_invoice,
                    pins: []
                };
                for (let i = 0; i < $scope.enteredPin.length; i++) {
                    if (!angular.isUndefined($scope.enteredPin[i])) {
                        objects_pin.pins.push({
                            pin: $scope.enteredPin[i],
                            fio: $scope.enteredFio[i]
                        });
                    }
                }
                $http.post('/index.php/invoice/invoice_reference', {
                    reference: 'insert_session_data',
                    id: objects_pin
                }).then(function (response) {
                    window.location.href = '/index.php/requisites/requisites_create_view/' + id_invoice;
                });
                //$cookies.putObject('objects_pin', objects_pin);
                //shareData.setData(objects_pin);
            } else {
                window.location.href = '/index.php/requisites/requisites_create_view/' + id_invoice;
            }
        }

        $scope.getRequisites = () => {
            $http.post('/index.php/invoice/invoice_reference', {
                reference: 'get_requisites_by_inn',
                inn: inn
            }).then(response => {
                angular.forEach(response.data.common.representatives, rep => {
                    let middleName = (rep.person.middleName !== null) ? rep.person.middleName : '';
                    $scope.representatives.push({
                        fio: rep.person.surname + ' ' + rep.person.name + ' ' + middleName,
                        pin: rep.person.pin
                    })
                });
            }, response => {
                console.log('Error: ' + response.data);
            });
        }

        $scope.getRequisites();
    }]);