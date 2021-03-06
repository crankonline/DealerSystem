app.factory('mObjNode', [function () {
    return function (node, scope) {
        let Nodes = node.split('.');
        let Current = scope;
        for (let i = 0; i < Nodes.length; i++) {
            if (!Current[Nodes[i]]) {
                Current[Nodes[i]] = {};
            }
            Current = Current[Nodes[i]];
        }
    };
}])
    .controller('RequisitesRegisterController', ['$scope', '$http', '$cookies', 'mObjNode', 'Upload', '$interval',
        '$sce', '$window', 'shareData', 'RequisitesRegisterErrors', 'ModalImageService',
        function ($scope, $http, $cookies, mObjNode, Upload, $interval, $sce, $window, shareData,
                  RequisitesRegisterErrors, ModalImageService) {
            window.scope = $scope;
            window.cookies = $cookies;

            /*Load default reference*/
            $scope.Errors = RequisitesRegisterErrors.get();
            $scope.errorgked = $scope.Errors.Juristic.gked.require;
            $scope.errorbik = $scope.Errors.Juristic.bik.require;
            $scope.requisites_json = requisites_json;
            $scope.count = isNaN($scope.requisites_json.common.representatives.length) ? 0 : $scope.requisites_json.common.representatives.length;
            $scope.eds_count = eds_count;
            $scope.passport_side_1 = [];
            $scope.passport_side_2 = [];
            $scope.passport_copy = [];
            $scope.rep_file_ch_passport_copy = [];
            $scope.rep_file_ch_passport_side_2 = []; //не рекваиред
            $scope.rep_file_ch_passport_side_1 = [];
            $scope.passport_side_1errorFile = [];
            $scope.passport_side_2errorFile = [];
            $scope.passport_copy_errorFile = [];
            $scope.REP_File_front = [];
            $scope.REP_File_back = [];
            $scope.REP_File_copy = [];
            $scope.Data = $scope.requisites_json;
            //$scope.pluginManager = new PluginManager();
            let representativeRoles = {
                chief: 1,
                accountant: 2,
                reciver: 3,
                usege: 4,
                consalting: 6
            };

            $scope.EM = '';
            $scope.SM = '';
            $scope.toggle = true;

            $scope.object_pins = object_pins;

            $http.post('/index.php/requisites/reference_load', {
                reference: 'getCommonCapitalForms',
                id: ''
            }).then(function (response) {
                $scope.CapitalForms = [{id: '', name: 'Выберите значение'}].concat(response.data);
                mObjNode('Data.common.capitalForm', $scope);
                let defaultId = angular.equals($scope.Data.common.capitalForm, {}) ? '' : $scope.Data.common.capitalForm.id;
                $scope.Data.common.capitalForm = $scope.CapitalForms[$scope.CapitalForms.findIndex(x => x.id === defaultId)];
            });

            $http.post('/index.php/requisites/reference_load', {
                reference: 'getCommonManagementForms',
                id: ''
            }).then(function (response) {
                $scope.ManagementForms = [{id: '', name: 'Выберите значение'}].concat(response.data);
                mObjNode('Data.common.managementForm', $scope);
                let defaultId = angular.equals($scope.Data.common.managementForm, {}) ? '' : $scope.Data.common.managementForm.id;
                $scope.Data.common.managementForm = $scope.ManagementForms[$scope.ManagementForms.findIndex(x => x.id === defaultId)];
            });

            $http.post('/index.php/requisites/reference_load', {
                reference: 'getCommonOwnershipForms',
                id: ''
            }).//загрузка спр. ФОРМА СОБСТВЕННОСТИ
                then(function (response) {
                    $scope.OwnershipForms = [{id: '', name: 'Выберите значение'}].concat(response.data);
                    mObjNode('Data.common.legalForm.ownershipForm', $scope);
                    $scope.CivilLegalStatuses = [{
                        id: '',
                        name: 'Cначала выберите организационно-правововую форму'
                    }];
                    $scope.Data.common.civilLegalStatus = $scope.CivilLegalStatuses[0];
                    $scope.LegalForms = [{id: '', name: 'Cначала выберите форму собственности'}];
                    $scope.Data.common.legalForm = $scope.LegalForms[0];
                    //console.log(angular.isUndefined($scope.Data.common.legalForm.ownershipForm));
                    let defaultId = ownershipForm_id;
                    $scope.Data.common.legalForm.ownershipForm = $scope.OwnershipForms[$scope.OwnershipForms.findIndex(x => x.id === defaultId)]; //знач. по умолчанию
                    if (defaultId !== '') {//прогружаем соотвественную Организационно-правоваю форму
                        $scope.loadLegalForm();
                    }
                });

            $http.post('/index.php/requisites/reference_load', {
                reference: 'getCommonRegions',
                id: ''
            }).then(function (response) {
                $scope.JuristicRegions = [
                    {id: '', name: 'Выберите область'},
                    {id: 'none', name: 'Республиканского подчинения'}].concat(response.data);
                $scope.PhysicalRegions = $scope.JuristicRegions;
                let defualtId = juristicAddress;
                let defaultphyid = physicalAddress;
                $scope.currentjuristicregion = $scope.JuristicRegions[$scope.JuristicRegions.findIndex(x => x.id == defualtId)];
                $scope.currentphysicalregion = $scope.PhysicalRegions[$scope.PhysicalRegions.findIndex(x => x.id == defaultphyid)];
                if (defualtId !== '') {
                    $scope.loadJuristicDistricts();
                    $scope.loadPhysicalDistricts();
                }
            });
            $http.post('/index.php/requisites/reference_load', {
                reference: 'getCommonChiefBasises',
                id: ''
            }).then(function (response) {
                $scope.ChiefBasises = [{id: '', name: 'Выберите значение'}].concat(response.data);
                mObjNode('Data.sf', $scope);
                let defaultId = chiefBasis_id;
                $scope.Data.common.chiefBasis = $scope.ChiefBasises[$scope.ChiefBasises.findIndex(x => x.id === defaultId)];
            });
            $http.post('/index.php/requisites/reference_load', {
                reference: 'getSfTariffs',
                id: ''
            }).then(function (response) {
                $scope.SFTariffs = [{id: '', name: 'Выберите значение'}].concat(response.data);
                mObjNode('Data.sf', $scope);
                let defaultId = tariff_id;
                $scope.Data.sf.tariff = $scope.SFTariffs[$scope.SFTariffs.findIndex(x => x.id === defaultId)];
            });
            $http.post('/index.php/requisites/reference_load', {
                reference: 'getSfRegions',
                id: ''
            }).then(function (response) {
                $scope.SFRegions = [{id: '', name: 'Выберите значение'}].concat(response.data);
                mObjNode('Data.sf', $scope);
                let defaultId = region_id;
                $scope.Data.sf.region = $scope.SFRegions[$scope.SFRegions.findIndex(x => x.id == defaultId)]; //без условное сравнение
            });
            $http.post('/index.php/requisites/reference_load', {
                reference: 'getSTIRegions',
                id: ''
            }).then(function (response) {
                $scope.STIRegions = [{id: '', name: 'Выберите значение'}].concat(response.data);
                mObjNode('Data.sti', $scope);
                let defaultIddef = regionDefault_id;
                let defaultIdrec = regionReceive_id;
                $scope.Data.sti.regionDefault = $scope.STIRegions[$scope.STIRegions.findIndex(x => x.id == defaultIddef)]; //без условное сравнение
                $scope.Data.sti.regionReceive = $scope.STIRegions[$scope.STIRegions.findIndex(x => x.id == defaultIdrec)]; //без условное сравнение
            });
            $http.post('/index.php/requisites/reference_load', {
                reference: 'getCommonRepresentativePositions',
                id: ''
            }).then(function (response) {
                $scope.Positions = [{id: '', name: 'Выберите значение'}].concat(response.data);
            });
            $scope.Roles = [
                {id: 1, name: 'Руководитель'},
                {id: 2, name: 'Бухгалтер'},
                {id: 3, name: "Лицо ответственное за получение ЭЦП"},
                {id: 4, name: "Лицо ответственное за использование ЭЦП"},
                {id: 6, name: "Сотрудник корневой консалтинговой структуры"}
            ];

            $scope.edsUsageModels = [
                {id: 1, name: "Использование ЭЦП на РУТОКЕН"},
                {id: 2, name: "Использование ЭЦП из облачного хранилища"}
            ];
            for (let i = 0; i < $scope.Data.common.representatives.length; i++) {
                if ($scope.Data.common.representatives[i].edsUsageModel != null) {
                    $scope.Data.common.representatives[i].edsUsageModel =
                        $scope.edsUsageModels[$scope.edsUsageModels.findIndex(x => x.id == $scope.Data.common.representatives[i].edsUsageModel.id)]
                }
            }

            angular.forEach($scope.Data.common.files, function (item) { //грузим сканы юрлица
                //console.log(item);
                $http.post('/index.php/requisites/get_image_reference', {
                    file_ident: item.file_ident
                }).then(function (response) {
                    item.filetype_id == 1 ? $scope.JUR_File_kg = response.data : null;
                    item.filetype_id == 2 ? $scope.JUR_File_ru = response.data : null;
                    item.filetype_id == 3 ? $scope.JUR_File_m2a = response.data : null;
                    item.filetype_id == 7 ? $scope.IE_File_load = response.data : null;
                }, function (response) {
                    console.log(response.data);
                });
            });

            for (let i = 0; i < $scope.Data.common.representatives.length; i++) {
                angular.forEach($scope.Data.common.representatives[i].files, function (item) {
                    $http.post('/index.php/requisites/get_image_reference', {
                        file_ident: item.file_ident
                    }).then(function (response) {
                        item.filetype_id == 4 ? $scope.REP_File_front[i] = response.data : null;
                        item.filetype_id == 5 ? $scope.REP_File_back[i] = response.data : null;
                        item.filetype_id == 6 ? $scope.REP_File_copy[i] = response.data : null;
                    }, function (response) {
                        console.log('Error: ' + response.data);
                    });
                });
            }
            /*End load default reference*/

            $scope.loadLegalForm = function () { //загрузка спр. Организационно-правовая форма
                let tmp = $scope.Data.common.legalForm.ownershipForm;
                //console.log(tmp);
                $http.post('/index.php/requisites/reference_load', {
                    reference: 'getCommonLegalForms',
                    id: $scope.Data.common.legalForm.ownershipForm.id
                }).then(function (response) {
                    $scope.LegalForms = [{id: '', name: 'Выберите значение'}].concat(response.data);
                    mObjNode('Data.common.legalForm', $scope);
                    let defaultId = legalForm_id;
                    $scope.Data.common.legalForm = $scope.LegalForms[$scope.LegalForms.findIndex(x => x.id === defaultId)];
                    $scope.Data.common.legalForm.ownershipForm = tmp;
                    if (defaultId !== 0) { //прошружам сооствествующий гражданскопровавой статус
                        $scope.loadCivilLegalStatuses();
                    }
                });
            };

            $scope.getOwnershimFormById = function (id) {
                if (typeof id === 'object') {
                    id = id.id;
                }
                for (let i = 0; i < $scope.OwnershipForms.length; i++) {
                    if ($scope.OwnershipForms[i].id === id)
                        return $scope.OwnershipForms[i];
                }
                return {id: id};
            };

            $scope.loadCivilLegalStatuses = function () {
                let tmp = $scope.Data.common.legalForm.ownershipForm;
                if ($scope.Data.common.legalForm.id === '') { //loadLegalForm меняет  $scope.Data.common.legalForm и срабатывает ng-change="loadCivilLegalStatuses()" (((
                    return;
                }
                $http.post('/index.php/requisites/reference_load', {
                    reference: 'getCommonCivilLegalStatuses',
                    id: $scope.Data.common.legalForm.id
                }).then(function (response) {
                    $scope.CivilLegalStatuses = [{id: '', name: 'Выберите значение'}].concat(response.data);
                    mObjNode('Data.common.civilLegalStatus', $scope);
                    let defaultId = civilLegalStatus_id;
                    $scope.Data.common.civilLegalStatus = $scope.CivilLegalStatuses[$scope.CivilLegalStatuses.findIndex(x => x.id == defaultId)];
                    $scope.Data.common.legalForm.ownershipForm = $scope.getOwnershimFormById(tmp);
                });
            };

            $scope.CheckGked = function () {
                if (angular.isUndefined($scope.Data.common.mainActivity.gked)) {
                    $scope.errorgked = $scope.Errors.Juristic.gked.require;
                    $scope.Data.common.mainActivity.name = null;
                } else {
                    if ($scope.Data.common.mainActivity.gked.length >= 7) {
                        $http.post('/index.php/requisites/reference_load', {
                            reference: 'getCommonActivityByGked',
                            id: $scope.Data.common.mainActivity.gked
                        }).then(function (response) {
                            $scope.Data.common.mainActivity.name = response.data.name;
                            $scope.Data.common.mainActivity.id = response.data.id;
                            $scope.Data.common.mainActivity.activity = response.data.activity;
                            $scope.Data.common.mainActivity.isFinal = response.data.isFinal;
                        }, function (response) {
                            $scope.errorgked = $scope.Errors.Juristic.gked.notFound;
                            $scope.Data.common.mainActivity.name = null;
                        });
                    }
                }
            };

            $scope.loadBankName = function () {
                if (angular.isUndefined($scope.Data.common.bank.id)) {
                    $scope.Data.common.bank.name = null;
                    $scope.errorbik = $scope.Errors.Juristic.bik.require;
                } else {
                    if ($scope.Data.common.bank.id.length > 5) {
                        $http.post('/index.php/requisites/reference_load', {
                            reference: 'getCommonBankById',
                            id: $scope.Data.common.bank.id
                        }).then(function (response) {
                            mObjNode('Data.common.bank', $scope);
                            $scope.Data.common.bank.name = response.data.name;
                        }, function (response) {
                            $scope.errorbik = $scope.Errors.Juristic.bik.notFound;
                            $scope.Data.common.bank.name = null;
                        });
                    }
                }
            };

            $scope.loadPhysicalDistricts = function () {
                if ($scope.currentphysicalregion.id === 'none' || $scope.currentphysicalregion.id === '') {
                    $scope.currentphysicaldistrict = null;
                    $scope.loadPhysicalSettlements($scope.currentphysicalregion.id, $scope.currentphysicaldistrict);
                    return;
                }
                $http.post('/index.php/requisites/reference_load', {
                    reference: 'getCommonDistricts',
                    id: $scope.currentphysicalregion.id
                }).then(function (response) {
                    $scope.PhysicalDistricts = [
                        {id: '', name: 'Выберите район'},
                        {id: 'none', name: 'Областного подчинения'}].concat(response.data);

                    if (Object.keys($scope.requisites_json.common.physicalAddress).length == 0) {
                        $scope.requisites_json.common.physicalAddress.settlement = {
                            settlement: {
                                district: null
                            }
                        }
                    }

                    if ($scope.requisites_json.common.physicalAddress.settlement.district != null) {
                        let defualtId = $scope.requisites_json.common.physicalAddress.settlement.district.id;
                        $scope.currentphysicaldistrict =
                            angular.isUndefined($scope.PhysicalDistricts[$scope.PhysicalDistricts.findIndex(x => x.id == defualtId)]) ?
                                {id: '', name: 'Выберите район'} :
                                $scope.PhysicalDistricts[$scope.PhysicalDistricts.findIndex(x => x.id == defualtId)];
                    } else if ($scope.requisites_json.common.physicalAddress.settlement.region != null) {
                        $scope.currentphysicaldistrict = $scope.PhysicalDistricts[1];
                    } else {
                        $scope.currentphysicaldistrict = $scope.PhysicalDistricts[0];
                    }
                    $scope.loadPhysicalSettlements($scope.currentphysicalregion.id, $scope.currentphysicaldistrict);
                }, function (response) {
                    $scope.currentphysicaldistrict = {id: '', name: 'Выберите район'};
                });
            };
            $scope.loadPhysicalSettlements = function (region, district) {
                if ($scope.currentphysicaldistrict === '' || $scope.currentphysicalregion.id === '') {
                    return;
                }

                region = $scope.currentphysicalregion.id;
                district = $scope.currentphysicaldistrict;
                let districtid = $scope.currentphysicaldistrict ? (district.id || null) : null;
                if (region === 'none' && !district) {
                    region = null;
                    districtid = null;
                }
                if (districtid === 'none') {
                    districtid = null;
                }
                if (districtid !== null) {
                    region = null;
                }

                $http.post('/index.php/requisites/reference_load', {
                    reference: 'getCommonSettlements',
                    id_region: region,
                    id_district: districtid
                }).then(function (response) {
                    $scope.PhysicalSettlements = [{
                        id: '',
                        name: 'Выберите населенный пункт'
                    }].concat(response.data);
                    mObjNode('Data.common.physicalAddress.settlement', $scope);
                    let defaultId = settlement_phy_id;
                    $scope.Data.common.physicalAddress.settlement =
                        angular.isUndefined($scope.PhysicalSettlements[$scope.PhysicalSettlements.findIndex(x => x.id == defaultId)]) ?
                            {id: '', name: 'Выберите населенный пункт'} :
                            $scope.PhysicalSettlements[$scope.PhysicalSettlements.findIndex(x => x.id == defaultId)];
                }, function (response) {
                    $scope.currentphysicaldistrict = {id: '', name: 'Выберите район'}
                });
            };

            $scope.loadJuristicDistricts = function () {
                if ($scope.currentjuristicregion.id === 'none' || $scope.currentjuristicregion.id === '') {
                    $scope.currentjuristicdistrict = null;
                    $scope.loadJuristicSettlements($scope.currentjuristicregion.id, $scope.currentjuristicdistrict);
                    return;
                }

                $http.post('/index.php/requisites/reference_load', {
                    reference: 'getCommonDistricts',
                    id: $scope.currentjuristicregion.id
                }).then(function (response) {
                    $scope.JuristicDistricts = [
                        {id: '', name: 'Выберите район'},
                        {id: 'none', name: 'Областного подчинения'}].concat(response.data);

                    if (Object.keys($scope.requisites_json.common.juristicAddress).length == 0) {
                        $scope.requisites_json.common.juristicAddress = {
                            settlement: {
                                district: null
                            }
                        }
                    }
                    if ($scope.requisites_json.common.juristicAddress.settlement.district != null) {
                        let defualtId = $scope.requisites_json.common.juristicAddress.settlement.district.id;
                        $scope.currentjuristicdistrict =
                            angular.isUndefined($scope.JuristicDistricts[$scope.JuristicDistricts.findIndex(x => x.id == defualtId)]) ?
                                {id: '', name: 'Выберите район'} :
                                $scope.JuristicDistricts[$scope.JuristicDistricts.findIndex(x => x.id == defualtId)];
                    } else if ($scope.requisites_json.common.juristicAddress.settlement.region != null) {
                        $scope.currentjuristicdistrict = $scope.JuristicDistricts[1];
                    } else {
                        $scope.currentjuristicdistrict = $scope.JuristicDistricts[0];
                    }
                    $scope.loadJuristicSettlements($scope.currentjuristicregion.id, $scope.currentjuristicdistrict);
                }, function (response) {
                    $scope.currentjuristicdistrict = {id: '', name: 'Выберите район'};
                });
            };
            $scope.loadJuristicSettlements = function (region, district) {
                if ($scope.currentjuristicdistrict === '' || $scope.currentjuristicregion.id === '') {
                    return;
                }
                region = $scope.currentjuristicregion.id;
                district = $scope.currentjuristicdistrict;
                let districtid = $scope.currentjuristicdistrict ? (district.id || null) : null;
                if (region === 'none' && !district) {
                    region = null;
                    districtid = null;
                }
                if (districtid === 'none') {
                    districtid = null;
                }
                if (districtid !== null) {
                    region = null;
                }
                $http.post('/index.php/requisites/reference_load', {
                    reference: 'getCommonSettlements',
                    id_region: region,
                    id_district: districtid
                }).then(function (response) {
                    $scope.JuristicSettlements = [{
                        id: '',
                        name: 'Выберите населенный пункт'
                    }].concat(response.data);
                    mObjNode('Data.common.juristicAddress.settlement', $scope);
                    let defaultId = settlement_id;
                    $scope.Data.common.juristicAddress.settlement =
                        angular.isUndefined($scope.JuristicSettlements[$scope.JuristicSettlements.findIndex(x => x.id == defaultId)]) ?
                            {id: '', name: 'Выберите населенный пункт'} :
                            $scope.JuristicSettlements[$scope.JuristicSettlements.findIndex(x => x.id == defaultId)];
                }, function (response) {
                    $scope.currentjuristicdistrict = {id: '', name: 'Выберите район'};
                });
            };
            $scope.addNewRepresentative = function () {
                $scope.count++;
                $scope.Data.common.representatives.push({
                    position: $scope.Positions[0],
                    edsUsageModel: $scope.edsUsageModels[0]
                });
            };

            $scope.RemoveRepresentative = function (key) {
                angular.forEach($scope.Data.common.representatives[key].roles, function (role) {
                    if (role.id === 1) {
                        $scope.role_1 = ($scope.role_1 === true) ? false : true;
                    }
                    if (role.id === 2) {
                        $scope.role_2 = ($scope.role_2 === true) ? false : true;
                    }
                    if (role.id === 3) {
                        $scope.role_3 = ($scope.role_3 === true) ? false : true;
                    }
                    if (role.id === 6) {
                        $scope.role_6 = ($scope.role_6 === true) ? false : true;
                    }
                });

                $scope.rep_file_ch_passport_side_1.splice(key, 1);
                $scope.rep_file_ch_passport_side_2.splice(key, 1);
                $scope.rep_file_ch_passport_copy.splice(key, 1);
                $scope.passport_side_1errorFile.splice(key, 1);
                $scope.passport_side_2errorFile.splice(key, 1);
                $scope.passport_copy_errorFile.splice(key, 1);
                $scope.passport_side_1.splice(key, 1);
                $scope.passport_side_2.splice(key, 1);
                $scope.passport_copy.splice(key, 1);
                $scope.REP_File_front.splice(key, 1);
                $scope.REP_File_back.splice(key, 1);
                $scope.REP_File_copy.splice(key, 1);

                $scope.Data.common.representatives.splice(key, 1);
                $scope.count--;
            };

            $scope.Check_chief = function (key) {
                if (angular.isUndefined($scope.Data.common.representatives[key].roles)) {
                    return true;
                } else {
                    let result = $scope.Data.common.representatives[key].roles[
                        $scope.Data.common.representatives[key].roles.findIndex(x => x.id == representativeRoles.chief)];
                    angular.isUndefined(result) ? result = true : result = false;
                    return result;
                }
            }

            $scope.Checked_role = function (role = false) {
                if (role === false) {
                    //default params for roles
                    $scope.role_1 = true;
                    $scope.role_2 = true;
                    $scope.role_3 = true;
                    $scope.role_6 = true;
                    for (let i = 0; i < $scope.Data.common.representatives.length; i++) {
                        for (let ii = 0; ii < $scope.Data.common.representatives[i].roles.length; ii++) {
                            ($scope.Data.common.representatives[i].roles[ii].id === representativeRoles.chief) ? $scope.role_1 = false : null;
                            ($scope.Data.common.representatives[i].roles[ii].id === representativeRoles.accountant) ? $scope.role_2 = false : null;
                            ($scope.Data.common.representatives[i].roles[ii].id === representativeRoles.reciver) ? $scope.role_3 = false : null;
                            ($scope.Data.common.representatives[i].roles[ii].id === representativeRoles.usege) ? $scope.role_6 = false : null;
                        }
                    }
                } else {
                    //user changes
                    if (role.id == 1) {
                        $scope.role_1 = ($scope.role_1 === false) ? true : false;
                    }
                    if (role.id == 2) {
                        $scope.role_2 = ($scope.role_2 === false) ? true : false;
                    }
                    if (role.id == 3) {
                        $scope.role_3 = ($scope.role_3 === false) ? true : false;
                    }
                    if (role.id == 6) {
                        $scope.role_6 = ($scope.role_6 === false) ? true : false;
                    }
                }
            };
            $scope.Checked_role();

            $scope.Check_role = (role) => {
                if (role.id === representativeRoles.consalting || role.id === representativeRoles.accountant) {
                    return true;
                }
                let roles = [];
                for (let i = 0; i < $scope.Data.common.representatives.length; i++) {
                    if (!angular.isUndefined(scope.Data.common.representatives[i].roles)) {
                        for (let ii = 0; ii < $scope.Data.common.representatives[i].roles.length; ii++) {
                            roles.push($scope.Data.common.representatives[i].roles[ii].id);
                        }
                    }
                }
                if (roles.length > 0) {
                    if (roles.indexOf(representativeRoles.chief) === -1) {
                        $scope.errorroles = $scope.Errors.Representatives.role.role_chief;
                    } else if (roles.indexOf(representativeRoles.usege) === -1) {
                        $scope.errorroles = $scope.Errors.Representatives.role.role_usage;
                    } else if (roles.indexOf(representativeRoles.reciver) === -1) {
                        $scope.errorroles = $scope.Errors.Representatives.role.role_resive;
                    } else {
                        $scope.errorroles = null;
                    }
                    return roles.indexOf(role.id) !== -1;
                } else {
                    $scope.errorroles = $scope.Errors.Representatives.role.require;
                    return false;
                }
            }

            $scope.Get_person = function (Series, Number, Key) {
                if ((Series && Series.length > 1) && (Number && Number.length > 5)) {
                    $http.post('/index.php/requisites/get_person_by_passport_reference', {
                        series: Series,
                        number: Number
                    }).then(function (response) {
                        $scope.Data.common.representatives[Key].person.passport.issuingAuthority = response.data.passport.issuingAuthority;
                        $scope.Data.common.representatives[Key].person.passport.issuingDate = response.data.passport.issuingDate;
                        $scope.Data.common.representatives[Key].person.surname = response.data.surname;
                        $scope.Data.common.representatives[Key].person.name = response.data.name;
                        $scope.Data.common.representatives[Key].person.middleName = response.data.middleName;
                        $scope.Data.common.representatives[Key].person.pin = response.data.pin;
                        $scope.Check_Persons_Copy('passport');//проверяем на наличие повторяющихся представителей по ПИН
                    }, function (response) {

                    });
                }
            };

            $scope.Check_Persons_Copy = function (check) {
                let counter = {};
                let pointer = false;
                let message = '';
                let rep = $scope.Data.common.representatives;
                for (let i = 0; i < rep.length; i++) {
                    let passport = rep[i].person.passport.series + rep[i].person.passport.number;
                    let pin = rep[i].person.pin;
                    let fio = rep[i].person.surname + ' ' + rep[i].person.name;
                    fio += (rep[i].person.middleName != undefined) ? ' ' + rep[i].person.middleName : '';
                    let val = (check === 'passport') ? passport : pin;
                    message = (check === 'passport') ? $scope.Errors.Representatives.copy.error.passport :
                        $scope.Errors.Representatives.copy.error.pin;
                    if (!counter[val]) {
                        counter[val] = 1;
                    } else {
                        message += passport + ' ' + fio + '\n';
                        pointer = true;
                        break;
                    }
                }
                if (pointer) {
                    alert(message);
                    return false;
                } else {
                    return true;
                }
            }

            $scope.getSerialNumber = function (key, tokenIndex) {
                //$scope.Data.common.representatives[key].deviceSerial = $scope.pluginManager.getDeviceInfo(tokenIndex, $scope.pluginManager.TOKEN_INFO_SERIAL);
                //$scope.Data.common.representatives[key].deviceSerial =
                //let result = $scope.pluginManager.getDeviceSerial(tokenIndex);
                //console.log(result);
            }

            $scope.get_require_pin = function (pin) {
                if ($scope.eds_count == 0) {
                    return false;
                } else if ($scope.object_pins != "''") {
                    let result = $scope.object_pins.pins[$scope.object_pins.pins.findIndex(x => x.pin == pin)];
                    if (angular.isUndefined(result)) {
                        return false;
                    } else {
                        return (result.pin == pin) ? true : false;
                    }
                } else {
                    return true;
                }
            }

            $scope.CheckIssuingDate = function (key) {
                if ($scope.Data.common.representatives?.[key]?.person?.passport?.issuingDate?.length === 10) {
                    let date =
                        new Date(scope.Data.common.representatives[key].person.passport.issuingDate.split('.').reverse().join('-'));
                    let currentdate = Date.now();
                    if (isNaN(date.getDate())) {
                        $scope.errorissuingdate = $scope.Errors.Representatives.passport.issuingDate.error_format;
                        return false;
                    } else if (new Date(date) < new Date(new Date(currentdate).setFullYear(new Date(currentdate).getFullYear() - 25))) {
                        $scope.errorissuingdate = $scope.Errors.Representatives.passport.issuingDate.error_year_min;
                        return false;
                    } else if (new Date(date) > new Date()) {
                        $scope.errorissuingdate = $scope.Errors.Representatives.passport.issuingDate.error_year_max;
                        return false;
                    } else {
                        $scope.errorissuingdate = null;
                        return true;
                    }
                } else {
                    $scope.errorissuingdate = null;
                    return false;
                }
            }

            $scope.showImage = function (file_ident) {
                ModalImageService.ShowModalImage(file_ident);
            }


            $scope.SuccessFunc = function (message) {
                $scope.resultupload = $sce.trustAsHtml(message);
                $scope.SM += $scope.resultupload;
                $scope.ResUpload = $sce.trustAsHtml($scope.SM);
            }

            $scope.ErrorFunc = function (message) {
                $scope.errorMsg = $sce.trustAsHtml(message);
                $scope.EM += $scope.errorMsg
                $scope.ErrorMessages = $sce.trustAsHtml($scope.EM);
                $scope.toggle = true;
            }

            $scope.UploadForm = function () {
                $scope.errorMsg = null;
                $scope.resultupload = null;
                $scope.toggle = false;
                $scope.EM = '';
                $scope.SM = '';

                /* checks before upload */
                if ($scope.Data.common.representatives.length === 0) {
                    alert('В данном наборе реквизитов отсутсвуют представители');
                    $scope.toggle = true;
                    return;
                }

                if ((!$scope.Data.common.rnmj || !/^\d+\-\d+\-.+$/.test($scope.Data.common.rnmj)) && ($scope.Data.common.civilLegalStatus.name !== 'Физическое лицо')) {
                    alert('Рег. номер Министерства Юстиции не соответствует маске XXXXXX-YYYY-ZZZ');
                    $scope.toggle = true;
                    return;
                }
                if (!$scope.Data.common.mainActivity.gked || !/^\d{2,2}\.\d{2,2}\.\d+$/.test($scope.Data.common.mainActivity.gked)) {
                    alert('Номер ГКЭД не соответствует маске XX.YY.ZZ');
                    $scope.toggle = true;
                    return;
                }
                if ($scope.Data.common.civilLegalStatus.name === 'Физическое лицо') {
                    $scope.Data.common.capitalForm = null;
                    $scope.Data.common.managementForm = null;
                    $scope.Data.common.rnmj = null;
                }
                let object_pins = $scope.object_pins.pins;
                for (let i = 0; i < $scope.Data.common.representatives.length; i++) {
                    if ($scope.Data.common.representatives[i].roles.length === 1 && $scope.Data.common.representatives[i].roles[0].id === 3) { //если указано лицо только на получение
                        $scope.Data.common.representatives[i].deviceSerial = null;
                        $scope.Data.common.representatives[i].edsUsageModel = null;
                    }
                    if ($scope.Data.common.representatives[i].edsUsageModel != null) {
                        if ($scope.Data.common.representatives[i].edsUsageModel.id === 2) {
                            $scope.Data.common.representatives[i].deviceSerial = null;
                        }
                    }
                    angular.forEach($scope.object_pins.pins, function (item_pin) { //поиск отсутвующих лиц в регистрации
                        if ($scope.Data.common.representatives[i].person.pin === item_pin.pin) {
                            let index = object_pins.indexOf(item_pin);
                            object_pins.splice(index, 1);
                        }
                    });

                    $scope.Data.common.representatives[i].roles = $scope.Data.common.representatives[i].roles.filter(
                        (item, index) => {
                            return scope.Data.common.representatives[i].roles.findIndex(x => x.id == item.id) === index
                        }); // удаление дубликатов ролей
                    if (angular.isUndefined($scope.Data.common.representatives[i].roles)) {
                        alert("Не выставлены роли у представителя - №" + i + 1);
                        $scope.toggle = true;
                        return;
                    }

                    if ($scope.CheckIssuingDate(i) == false) {
                        alert("Введена некорректная дата выдачи паспорта у представителя - №" + (i + 1));
                        $scope.toggle = true;
                        return;
                    }
                }
                if (!angular.isUndefined(object_pins)) {
                    if (object_pins.length != 0) {
                        let message = "<p>Необходима регистация указанных лиц:</p>";
                        angular.forEach(object_pins, function (item) {
                            message += "<p>ФИО - " + item.fio + " ПИН - " + item.pin + "</p>";
                        });
                        $scope.ErrorFunc(message);
                        return;
                    }
                }
                if (!$scope.Check_Persons_Copy('passport') || !$scope.Check_Persons_Copy('pin')) {
                    $scope.toggle = true;
                    return;
                }
                /* end checks */
                let id_requisites = null;
                let check_jur = false; //for redirect
                let count_of_count = 0; //for redirect
                let check_jur_files = false,
                    check_jur_ident = false;
                let check_rep_files = false,
                    check_rep_ident = false;

                if ($scope.SameAddress) {
                    $scope.Data.common.physicalAddress = $scope.Data.common.juristicAddress;
                }

                $http.post('/index.php/requisites/requisites_create', {
                    invoice_id: $scope.invoice_id,
                    invoice_serial_number: $scope.invoice_serial_number,
                    json: $scope.Data
                }).then(function (responce) {
                    id_requisites = responce.data.id_requisites;
                    if (!id_requisites) {//if null form server
                        $scope.ErrorFunc('<p>Ошибка при сохранении изображений. ID реквизита не определен</p>');
                        return;
                    }

                    $scope.SuccessFunc(responce.data.data);

                    let dataToSend = {};
                    if (!angular.isUndefined($scope.mu_file_kg)) {
                        dataToSend.mu_file_kg = $scope.mu_file_kg;
                    }
                    if (!angular.isUndefined($scope.mu_file_ru)) {
                        dataToSend.mu_file_ru = $scope.mu_file_ru;
                    }
                    if (!angular.isUndefined($scope.ie_file)) {
                        dataToSend.ie_file = $scope.ie_file;
                    }
                    if (!angular.isUndefined($scope.mu_file_m2a)) {
                        dataToSend.mu_file_m2a = $scope.mu_file_m2a;
                    }
                    if (Object.keys(dataToSend).length !== 0) {//если есть что отправлять
                        Upload.upload({
                            url: '/index.php/requisites/requisites_file_upload/' + id_requisites + '/'
                                + $scope.Data.common.inn + '/' + '1',
                            data: dataToSend
                        }).then(function (responsejur) {
                            $scope.SuccessFunc(responsejur.data);
                            check_jur_files = true;
                        }, function (responsejur) {
                            if (responsejur.status > 0) {
                                $scope.ErrorFunc('<p>Ошибка при сохранении изображений юридического лица, код ошибки: '
                                    + responsejur.status + '.</p><p> Сообщение: ' + responsejur.data + '</p>');
                            }
                        }, function (evt) {
                            $scope.progressjur = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
                        });
                    } else { //если отправлять нечего нефиг проверять
                        check_jur_files = true;
                    }

                    if (!angular.isUndefined(scope.Data.common.files)) { //если есть архивные файлы
                        //теперь надо удалить из объекта то что есть в массиве фалов на загрузку
                        angular.forEach(dataToSend, function (value, key) {
                            delete scope.Data.common.files[key];
                        });
                        if (!$scope.jur_file_ch_m2a) {
                            delete scope.Data.common.files['mu_file_m2a'];
                        }
                        if (Object.keys(scope.Data.common.files).length == 0) {
                            check_jur_ident = true;
                        } else {
                            let keys = Object.keys(scope.Data.common.files);
                            for (let i = 0; i < keys.length; i++) {
                                $http.post('/index.php/requisites/requisites_file_upload_skip', {
                                    id_requisites: id_requisites,
                                    filetype_id: $scope.Data.common.files[keys[i]].filetype_id,
                                    file_ident: $scope.Data.common.files[keys[i]].file_ident,
                                    rep_ident: null
                                }).then(function (responsejur) {
                                    $scope.SuccessFunc(responsejur.data.data);
                                    check_jur_ident = true;
                                }, function (responsejur) {
                                    if (responsejur.status > 0) {
                                        $scope.ErrorFunc('<p>Ошибка при сохранении ID изображений юридического лица, код ошибки: '
                                            + responsejur.status + '</p><p> Сообщение: ' + responsejur.data + '</p>');
                                    }
                                });
                            }
                        }
                    } else { //если нет архиных фалов то нефиг их проверять
                        check_jur_ident = true;
                    }

                    for (let i = 0; i < $scope.count; i++) {
                        let dataToSendRep = {};
                        if (!angular.isUndefined($scope.passport_side_1[i])) {
                            dataToSendRep.passport_side_1 = $scope.passport_side_1[i];
                        }
                        if (!angular.isUndefined($scope.passport_side_2[i])) {
                            dataToSendRep.passport_side_2 = $scope.passport_side_2[i];
                        }
                        if (!angular.isUndefined($scope.passport_copy[i])) {
                            dataToSendRep.passport_copy = $scope.passport_copy[i];
                        }

                        if (Object.keys(dataToSendRep).length !== 0) { //если нечего отпрвлять
                            Upload.upload({
                                url: '/index.php/requisites/requisites_file_upload/' + id_requisites + '/'
                                    + $scope.Data.common.representatives[i].person.passport.number
                                    + '/' + 2,
                                data: dataToSendRep
                            }).then(function (responsephy) {
                                $scope.SuccessFunc(responsephy.data);
                                check_rep_files = true;
                            }, function (responsephy) {
                                if (responsephy.status > 0) {
                                    $scope.ErrorFunc('<p>Ошибка при сохранении изображений ответственных лиц, код ошибки: '
                                        + responsephy.status + '.</p><p> Сообщение: ' + responsephy.data + '</p>');
                                }
                            }, function (evt) {
                                $scope.progressphy = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
                            });
                        } else { //если файлов нет то и шаг пропускаем
                            check_rep_files = true;
                        }

                        if (!angular.isUndefined(scope.Data.common.representatives[i].files)) {//если есть архив
                            angular.forEach(dataToSendRep, function (value, key) {
                                delete scope.Data.common.representatives[i].files[key];
                            });
                            if (!$scope.rep_file_ch_passport_copy[i]) {//кастыль
                                delete scope.Data.common.representatives[i].files['passport_copy'];
                            }
                            if (!$scope.rep_file_ch_passport_side_2[i]) {//кастыль
                                delete scope.Data.common.representatives[i].files['passport_side_2'];
                            }
                            if (Object.keys(scope.Data.common.representatives[i].files).length == 0) {
                                check_rep_ident = true;
                            } else {
                                let keys = Object.keys(scope.Data.common.representatives[i].files);
                                for (let ii = 0; ii < keys.length; ii++) {
                                    //console.log('Go JUR - ' + $scope.Data.common.representatives[i].files[keys[ii]].file_ident);
                                    $http.post('/index.php/requisites/requisites_file_upload_skip', {
                                        id_requisites: id_requisites,
                                        filetype_id: $scope.Data.common.representatives[i].files[keys[ii]].filetype_id,
                                        file_ident: $scope.Data.common.representatives[i].files[keys[ii]].file_ident,
                                        rep_ident: $scope.Data.common.representatives[i].person.passport.number
                                    }).then(function (responsephy) {
                                        $scope.SuccessFunc(responsephy.data.data);
                                        check_rep_ident = true;
                                    }, function (responsephy) {
                                        if (responsephy.status > 0) {
                                            $scope.ErrorFunc('<p>Ошибка при сохранении ID изображений ответственных лиц, код ошибки: ' + responsephy.status + '.</p><p> Сообщение: ' + responsephy.data + '</p>');
                                        }
                                    });
                                }
                            }
                        } else { //если нет архива
                            check_rep_ident = true;
                        }
                    }
                }, function (response) {
                    $scope.ErrorFunc('<p>Ошибка при сохранении реквизитов, код ошибки: ' + response.status + '.</p><p> Сообщение: ' + response.data + '</p>');
                });

                $interval(function () {
                    if (check_jur_files == true && check_jur_ident == true) {
                        check_jur = true;
                    }
                    if (check_rep_files == true && check_rep_ident == true) {
                        count_of_count++;
                    }
                    if (check_jur === true && $scope.count === count_of_count) {
                        $window.location.href = '/index.php/requisites/requisites_show_view/' + id_requisites; //redirect
                    }
                }, 5000);
            };

            $scope.range = function (min, max, step) {
                step = step || 1;
                let input = [];
                for (let i = min; i < max; i += step) {
                    input.push(i);
                }
                return input;
            };
        }])
;