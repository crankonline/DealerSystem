app.controller('InvoiceShowController', ['$scope', '$http', '$cookies', 'shareData', function ($scope, $http, $cookies, shareData) {
    window.scope = $scope;
    window.cookies = $cookies;

    $scope.filteredChoices = [];
    $scope.isVisible = [];

    $http.post('/index.php/invoice/invoice_reference', {
        reference: 'count_eds',
        id: id_invoice
    }).then(function (response) {
        $scope.count_eds = parseInt(response.data.eds_count);
        $scope.isVisible = [...new Array($scope.count_eds)].map(v=>({suggestions: false}));
    });

    $scope.enteredFio = [];
    $scope.enteredPin = [];

    $scope.choices = [];
    $scope.items = [];

    $scope.text = '';
    $scope.minlength = 5;
    $scope.selected = {};

    $scope.pinSearch = function (pin) {
        if (pin.length >= 5) {
            $http.post('/index.php/invoice/invoice_reference', {
                reference: 'search_rep_by_pin',
                id: pin
            }).then(function (response) {
                $scope.choices = response.data;
                $scope.items = $scope.choices;
            });
        }
    };

    $scope.range = function (min, max, step) {
        step = step || 1;
        let input = [];
        for (let i = min; i < max; i += step) {
            input.push(i);
        }
        return input;
    };

    $scope.filterItems = function (key) {
        if ($scope.minlength <= $scope.enteredPin[key].length) {
            $scope.filteredChoices = querySearch($scope.enteredPin[key]);
            $scope.isVisible[key].suggestions = $scope.filteredChoices.length > 0 ? true : false;
        } else {
            $scope.isVisible[key].suggestions = false;
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
        $scope.pinSearch(query);
        if (scope.choices == "null") {
            return [];
        } else {
            return query ? $scope.choices.filter(createFilterFor(query)) : [];
        }
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
        /* делаем из массивов объект, конено можно было сделать в момент формирования, но код уже написан, рефакториг */
        if ($scope.enteredPin && $scope.enteredPin.length > 0) {
            let objects_pin = {
                id_invoice: id_invoice,
                pins: []
            };
            for (let i = 0; i < $scope.enteredPin.length; i++) {
                objects_pin.pins.push({
                    pin: $scope.enteredPin[i],
                    fio: $scope.enteredFio[i]
                });
            }
            $http.post('/index.php/invoice/invoice_reference', {
                reference: 'insert_session_data',
                id: objects_pin
            }).then(function (response) {
                //console.log(response.data);
                window.location.href = '/index.php/requisites/requisites_create_view/' + id_invoice;
            });
            //$cookies.putObject('objects_pin', objects_pin);
            //shareData.setData(objects_pin);
        } else {
            window.location.href = '/index.php/requisites/requisites_create_view/' + id_invoice;
        }
    }
}]);