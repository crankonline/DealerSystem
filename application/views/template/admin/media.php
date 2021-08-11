<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main" ng-app="DealerSystem">
    <div ng-controller="AdminMediaController">
        <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере  ?>
            <div class="alert alert-danger">
                <strong>Oh snap!</strong> <?php echo $error_message; ?>
            </div>
        <?php else: ?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-search"></span>
                        Поиск заявки
                    </h3>
                </div>
                <div class="panel-body">
                    <strong>Поиск по номеру счета на оплату.</strong>
                    <input type="text"
                           class="form-control"
                           ng-model="searchInvoiceNumber">

                </div>
                <p align="center" ng-hide="searchInvoiceNumber.length != 16">
                    <button type="submit"
                            class="btn btn-success"
                            ng-click="searchMediaData(searchInvoiceNumber)">
                        <span class="glyphicon glyphicon-search"></span>
                        Найти
                    </button>
                </p>
            </div>
            <div class="panel panel-warning" ng-show="Invoice.Requisites">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-picture"></span>
                        Загрузка изображений.
                    </h3>
                </div>
                <div class="panel-body">
                    <div>
                        <strong>ИНН: </strong> {{Invoice.Requisites.json.common.inn}}
                    </div>
                    <div>
                        <strong>НАИМЕНОВАНИЕ: </strong> {{Invoice.Requisites.json.common.fullName}}
                    </div>
                    <hr/>
                    <select class="form-control"
                            ng-model="dataFilesOwnerSelected"
                            ng-options="option.name for option in dataFilesOwner track by option.id_file_owner">
                    </select>
                    <div ng-show="dataFilesOwnerSelected.name === 'Representatives'">
                        <br/>
                        <select class="form-control"
                                ng-model="dataRepresentativesSelected"
                                ng-options="option.person.passport.series + option.person.passport.number + ' '
                            + option.person.surname + ' ' + option.person.name + ' ' + option.person.middleName
                             for option in dataRepresentatives">
                            <option value="">Выберите владельца изображения</option>
                        </select>
                    </div>
                    <div ng-show="dataFilesOwnerSelected.name === 'Juridical' ||
                    (dataRepresentativesSelected != null && dataFilesOwnerSelected.name === 'Representatives')">
                        <br/>
                        <select class="form-control"
                                ng-hide=""
                                ng-model="dataFilesTypeSelected"
                                ng-options="option.name for option in
                            dataFilesType | filter:{file_owner_id:dataFilesOwnerSelected.id_file_owner}
                            track by option.id_file_type">
                            <option value="">Выберите тип изображения</option>
                        </select>
                    </div>
                    <div ng-show="dataFilesTypeSelected != null">
                        <br/>
                        <input type="file" class="form-control"
                               ng-model="dataFileSelected"
                               ngf-select
                               ngf-pattern="'image/*'"
                               ngf-accept="'.jpg'"
                               ngf-max-size="4MB"
                               ngf-min-height="100">
                    </div>
                    <hr/>
                    <p align="center" ng-show="dataFileSelected!=null">
                        <button type="submit"
                                class="btn btn-success"
                                ng-click="searchMediaData(uploadFile())">
                            <span class="glyphicon glyphicon-upload"></span>
                            Загрузить
                        </button>
                    </p>
                    <!--                    <div ng-hide="">-->
                    <!--                        <div ng-repeat="file in Files_type | filter: 'Juridical' as results track by file.id_file_type">-->
                    <!--                            <strong>{{file.id_file_type}} - {{file.name}}</strong>-->
                    <!--                            <input type="file" class="form-control" ng-model="files">-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                    <hr/>-->
                    <!--                    <div ng-hide="" ng-repeat="rep in Invoice.Requisites.json.common.representatives">-->
                    <!--                        <div>-->
                    <!--                            <strong>Паспорт</strong> {{rep.person.passport.series + rep.person.passport.number}}-->
                    <!--                        </div>-->
                    <!--                        <div>-->
                    <!--                            <strong>ФИО</strong> {{rep.person.surname}} {{rep.person.name}} {{rep.person.middleName}}-->
                    <!--                        </div>-->
                    <!--                        <div ng-repeat="file in Files_type | filter: 'Representatives' as results track by file.id_file_type">-->
                    <!--                            <strong>{{file.id_file_type}} - {{file.name}}</strong>-->
                    <!--                        </div>-->
                    <!--                        <p></p>-->
                    <!--                    </div>-->
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="<?php echo base_url("resources/js/DealerSystem/AdminServices.js"); ?>"></script>
<script src="<?php echo base_url("resources/js/DealerSystem/AdminMediaController.js"); ?>"></script>
