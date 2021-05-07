<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main" ng-app="DealerSystem" ng-controller="RequisitesRegisterController">
    <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере    ?>
        <div class="alert alert-danger">
            <h3 align="center"><strong>Произошла ошибка!<br>Регистрация невозможна!</strong></h3>
            <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <form ng-submit="UploadForm()" ng-show="toggle" name="ReqCreateForm">
            <?php if (isset($message)): ?>
                <div class="alert alert-warning" align="center">
                    <h3><strong>Внимание: </strong><?php echo $message; ?></h3>
                </div>
            <?php endif; ?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span> Реквизиты юридического лица
                    </h3>
                </div>
                <div class="panel-body">
                    <h4 align="center"><span class="glyphicon glyphicon-star"></span> Основные
                        сведения</h4>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td style="width: 266px">ИНН организации</td>
                            <td><input type="text"
                                       class="form-control"
                                       readonly=""
                                       required=""
                                       ng-model="Data.common.inn">
                                <input type="text" hidden="" ng-model="invoice_id"
                                       ng-init="invoice_id = '<?php echo $invoice_id; ?>'">
                                <input type="text" hidden="" ng-model="invoice_serial_number"
                                       ng-init="invoice_serial_number = '<?php echo $invoice_data->invoice_serial_number; ?>'">
                            </td>
                        </tr>
                        <tr>
                            <td>ОКПО</td>
                            <td><input type="text"
                                       name="data_common_okpo"
                                       class="form-control"
                                       placeholder="8 цифр"
                                       minlength="6" maxlength="8"
                                       required=""
                                       numbers-only
                                       ng-model="Data.common.okpo"
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_okpo.$valid}">
                            </td>
                        </tr>
                        <tr>
                            <td>Рег. номер Социального Фонда</td>
                            <td><input type="text"
                                       name="data_common_rnsf"
                                       class="form-control"
                                       placeholder="12 цифр"
                                       minlength="12" maxlength="12"
                                       name="data_common_rnsf"
                                       required=""
                                       numbers-only
                                       ng-model="Data.common.rnsf"
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_rnsf.$valid}">
                            </td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td>Рег. номер Министерства Юстиции</td>
                            <td><input type="text" class="form-control" placeholder="XXXXXX-YYYY-ZZZ" required=""
                                       maxlength="15"
                                       trim-validator
                                       name="data_common_rnmj"
                                       ng-model="Data.common.rnmj"
                                       ng-disabled="Data.common.civilLegalStatus.name === 'Физическое лицо'"
                                       ng-required="Data.common.civilLegalStatus.name !== 'Физическое лицо'"
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_rnmj.$valid}">
                            </td>
                        </tr>
                        <tr>
                            <td>Наименование организации (сокращенное, 64 символа)</td>
                            <td><input type="text"
                                       class="form-control"
                                       placeholder="Наименование юридического лица"
                                       maxlength="64"
                                       required
                                       trim-validator
                                       name="data_common_name"
                                       ng-model="Data.common.name"
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_name.$valid}">
                                <p></p>
                                <div class="alert alert-danger"
                                     ng-show="ReqCreateForm.data_common_name.$error.maxlength">
                                    {{Errors.Juristic.name.maxlength}} -
                                    {{ReqCreateForm.data_common_name.$viewValue.length}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Полное наименование организации</td>
                            <td><textarea maxlength="255"
                                          class="form-control noresize"
                                          style="resize: vertical"
                                          name="data_common_fullName"
                                          placeholder="Полное наименование юридического лица с ОПФ"
                                          required=""
                                          ng-model="Data.common.fullName"
                                          ng-class="{'alert-danger': !ReqCreateForm.data_common_fullName.$valid}"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>ГКЭД</td>
                            <td><input type="text"
                                       name="data_common_gked"
                                       class="form-control"
                                       placeholder="XX.YY.ZZ"
                                       maxlength="9"
                                       minlength="5"
                                       required=""
                                       ng-model="Data.common.mainActivity.gked"
                                       ng-change="CheckGked()"
                                       gked-mask
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_mainActivity_name.$valid}">
                                <p></p>
                                <div class="alert alert-danger"
                                     ng-show="Data.common.mainActivity.name == null">
                                    {{errorgked}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Вид деятельности</td>
                            <td><textarea maxlength="255"
                                          name="data_common_mainActivity_name"
                                          class="form-control noresize"
                                          style="resize: vertical"
                                          placeholder="Введите ГКЕД ячейкой выше"
                                          required=""
                                          readonly=""
                                          ng-model="Data.common.mainActivity.name"
                                          ng-disabled="!Data.common.mainActivity.gked"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Форма собственности</td>
                            <td><select required
                                        class="form-control"
                                        name="data_common_legalForm_ownershipForm"
                                        ng-model="Data.common.legalForm.ownershipForm"
                                        ng-options="option.name disable when option.id === null for option in OwnershipForms track by option.id"
                                        ng-change="loadLegalForm()"
                                        ng-class="{'alert-danger': Data.common.legalForm.ownershipForm.id==''}"></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Организационно-правовая форма</td>
                            <td><select required
                                        class="form-control"
                                        ng-model="Data.common.legalForm"
                                        ng-options="option.name disable when option.id === null for option in LegalForms track by option.id"
                                        ng-change="loadCivilLegalStatuses()"
                                        ng-class="{'alert-danger': Data.common.legalForm.id==''}"></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Гражданско-правовой статус</td>
                            <td><select required
                                        class="form-control"
                                        ng-model="Data.common.civilLegalStatus"
                                        ng-options="option.name disable when option.id === null for option in CivilLegalStatuses track by option.id"
                                        ng-class="{'alert-danger': Data.common.civilLegalStatus.id==''}"></select>
                            </td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td>Форма участия в капитале</td>
                            <td><select class="form-control"
                                        name="data_common_capitalForm"
                                        ng-model="Data.common.capitalForm"
                                        ng-options="option.name disable when option.id === null for option in CapitalForms track by option.id"
                                        ng-disabled="Data.common.civilLegalStatus.name === 'Физическое лицо'"
                                        ng-required="Data.common.civilLegalStatus.name !== 'Физическое лицо'"
                                        ng-class="{'alert-danger': Data.common.capitalForm.id==''}"></select>
                            </td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td>Форма управления</td>
                            <td><select class="form-control"
                                        name="data_common_managementForm"
                                        ng-model="Data.common.managementForm"
                                        ng-options="option.name disable when option.id === null for option in ManagementForms track by option.id"
                                        ng-disabled="Data.common.civilLegalStatus.name === 'Физическое лицо'"
                                        ng-required="Data.common.civilLegalStatus.name !== 'Физическое лицо'"
                                        ng-class="{'alert-danger': Data.common.managementForm.id==''}"></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Электронная почта</td>
                            <td><input type="email"
                                       name="data_common_email"
                                       class="form-control"
                                       placeholder="E-mail"
                                       maxlength="50"
                                       required=""
                                       ng-model="Data.common.eMail"
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_email.$valid}">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <h4 align="center"><span class="glyphicon glyphicon-euro"></span>
                        Банковские реквизиты</h4>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="2" align="center">
                                <label class="btn btn-warning">
                                    <input type="checkbox"
                                           ng-model="Bank_else"
                                           ng-init="Bank_else = true"> Присутствуют
                                </label>
                            </td>
                        </tr>
                        <tr ng-hide="!Bank_else">
                            <td style="width: 266px">БИК</td>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       placeholder="6 цифр"
                                       ng-minlength="6"
                                       ng-maxlength="6"
                                       numbers-only
                                       name="data_common_bank_id"
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_bank_name.$valid}"
                                       ng-model="Data.common.bank.id"
                                       ng-change="loadBankName()"
                                       ng-disabled="!Bank_else"
                                       ng-required="Bank_else">
                                <p></p>
                                <div class="alert alert-danger" ng-show="Data.common.bank.name == null">
                                    {{errorbik}}
                                </div>
                            </td>
                        </tr>
                        <tr ng-hide="!Bank_else">
                            <td>Наименование банка</td>
                            <td><input type="text"
                                       class="form-control"
                                       placeholder="Введите БИК ячейкой выше"
                                       trim-validator
                                       name="data_common_bank_name"
                                       ng-model="Data.common.bank.name"
                                       ng-disabled="!Bank_else"
                                       ng-readonly="true"
                                       ng-required="Bank_else">
                            </td>
                        </tr>
                        <tr ng-hide="!Bank_else">
                            <td>Расчетный счет</td>
                            <td><input type="text"
                                       class="form-control"
                                       placeholder="16 цифр"
                                       minlength="16"
                                       maxlength="16"
                                       numbers-only
                                       name="data_common_bankAccount"
                                       ng-model="Data.common.bankAccount"
                                       ng-disabled="(!Data.common.bank || !Data.common.bank.name) || !Bank_else"
                                       ng-required="Bank_else"
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_bankAccount.$valid}">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <h4 align="center"><span class="glyphicon glyphicon-globe"></span> Адресные
                        данные</h4>
                    <table class="table">
                        <tbody>
                        <tr class="warning" align="center">
                            <td colspan="2">Юридический адрес</td>
                        </tr>
                        <tr>
                            <td style="width: 266px">Почтовый Индекс</td>
                            <td><input type="text"
                                       name="data_common_juristicAddress_postCode"
                                       class="form-control"
                                       placeholder="6 цифр"
                                       minlength="6"
                                       maxlength="6"
                                       required=""
                                       numbers-only
                                       ng-model="Data.common.juristicAddress.postCode"
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_juristicAddress_postCode.$valid}">
                            </td>
                        </tr>
                        <tr>
                            <td>Населенный пункт</td>
                            <td>
                                <div style="display: block">
                                    <select class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
                                            required
                                            ng-model="currentjuristicregion"
                                            ng-options="option.name disable when option.id === null for option in JuristicRegions track by option.id"
                                            ng-change="loadJuristicDistricts()"
                                            ng-class="{'alert-danger': currentjuristicregion.id==''}"></select>
                                </div>
                                <p></p>
                                <div ng-hide="(currentjuristicregion.id == 'none' || currentjuristicregion.id == '')">
                                    <select class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" required
                                            name="currentjuristicdistrict"
                                            ng-model="currentjuristicdistrict"
                                            ng-options="option.name disable when option.id === null for option in JuristicDistricts track by option.id"
                                            ng-change="loadJuristicSettlements()"
                                            ng-required="!(currentjuristicregion.id == 'none' || currentjuristicregion.id == '')"
                                            ng-class="{'alert-danger': currentjuristicdistrict.id==''}"></select>
                                </div>
                                <p></p>
                                <div ng-hide="(currentjuristicregion.id == '' && (currentjuristicdistrict.id == '' || currentjuristicdistrict.id == null))">
                                    <select class="form-control ng-pristine ng-untouched ng-valid ng-empty" required
                                            name="data_common_juristicAddress_settlement"
                                            ng-model="Data.common.juristicAddress.settlement"
                                            ng-options="option.name disable when option.id === null for option in JuristicSettlements track by option.id"
                                            ng-class="{'alert-danger': Data.common.juristicAddress.settlement.id==''}"></select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Улица / Микрорайон</td>
                            <td><input type="text"
                                       name="data_common_juristicAddress_street"
                                       class="form-control"
                                       placeholder="Улица / Микрорайон"
                                       maxlength="50"
                                       required=""
                                       trim-validator
                                       ng-model="Data.common.juristicAddress.street"
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_juristicAddress_street.$valid}">
                            </td>
                        </tr>
                        <tr>
                            <td>Дом / Строение</td>
                            <td><input type="text"
                                       name="data_common_juristicAddress_building"
                                       class="form-control"
                                       placeholder="Дом / Строение"
                                       required=""
                                       maxlength="4"
                                       trim-validator
                                       ng-model="Data.common.juristicAddress.building"
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_juristicAddress_building.$valid}">
                            </td>
                        </tr>
                        <tr>
                            <td>Квартира</td>
                            <td><input type="text"
                                       class="form-control"
                                       placeholder="Квартира"
                                       maxlength="4"
                                       trim-validator
                                       ng-model="Data.common.juristicAddress.apartment">
                            </td>
                        </tr>
                        <tr class="warning" align="center">
                            <td colspan="2">Физический адрес</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><label class="btn btn-warning">
                                    <input type="checkbox"
                                           ng-model="SameAddress"
                                           ng-init="SameAddress = true"> совпадает с юридическим</label>
                            </td>
                        </tr>
                        <tr ng-hide="SameAddress">
                            <td style="width: 266px">Почтовый Индекс</td>
                            <td><input type="text"
                                       name="data_common_physicalAddress_postCode"
                                       class="form-control"
                                       placeholder="6 цифр"
                                       minlength="6"
                                       maxlength="6"
                                       ng-disabled="SameAddress"
                                       ng-required="!SameAddress"
                                       required=""
                                       numbers-only
                                       ng-model="Data.common.physicalAddress.postCode" ng-disabled="SameAddress"
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_physicalAddress_postCode.$valid}">
                            </td>
                        </tr>
                        <tr ng-hide="SameAddress">
                            <td>Населенный пункт</td>
                            <td>
                                <div style="display: block">
                                    <select class="form-control"
                                            ng-model="currentphysicalregion"
                                            ng-options="option.name disable when option.id === null for option in PhysicalRegions track by option.id"
                                            ng-change="loadPhysicalDistricts()"
                                            ng-disabled="SameAddress"
                                            ng-required="!SameAddress"
                                            ng-class="{'alert-danger': currentphysicalregion.id==''}">
                                    </select>
                                </div>
                                <p></p>
                                <div ng-hide="(currentphysicalregion.id == 'none' || currentphysicalregion.id == '')">
                                    <select class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" required
                                            ng-model="currentphysicaldistrict"
                                            ng-options="option.name disable when option.id === null for option in PhysicalDistricts track by option.id"
                                            ng-change="loadPhysicalSettlements()"
                                            ng-required="!(currentphysicalregion.id == 'none' || currentphysicalregion.id == '')"
                                            ng-class="{'alert-danger': currentphysicaldistrict.id==''}">
                                    </select>
                                </div>
                                <p></p>
                                <div ng-hide="(currentphysicalregion.id == '' && (currentphysicaldistrict.id == '' || currentphysicaldistrict.id == null))">
                                    <select class="form-control ng-pristine ng-untouched ng-valid ng-empty"
                                            ng-model="Data.common.physicalAddress.settlement"
                                            ng-options="option.name disable when option.id === null for option in PhysicalSettlements track by option.id"
                                            ng-required="!SameAddress"
                                            ng-class="{'alert-danger': Data.common.physicalAddress.settlement.id==''}">
                                    </select></div>
                            </td>
                        </tr>
                        <tr ng-hide="SameAddress">
                            <td>Улица / Микрорайон</td>
                            <td>
                                <input type="text" class="form-control" placeholder="Улица / Микрорайон" maxlength="50"
                                       name="data_common_physicalAddress_street"
                                       ng-required="!SameAddress"
                                       trim-validator
                                       ng-model="Data.common.physicalAddress.street"
                                       ng-disabled="SameAddress"
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_physicalAddress_street.$valid}">
                            </td>
                        </tr>
                        <tr ng-hide="SameAddress">
                            <td>Дом / Строение</td>
                            <td><input type="text" class="form-control" placeholder="Дом / Строение" maxlength="4"
                                       name="data_common_physicalAddress_building"
                                       ng-required="!SameAddress"
                                       trim-validator
                                       ng-model="Data.common.physicalAddress.building"
                                       ng-disabled="SameAddress"
                                       ng-class="{'alert-danger': !ReqCreateForm.data_common_physicalAddress_building.$valid}">
                            </td>
                        <tr ng-hide="SameAddress">
                            <td>Квартира</td>
                            <td><input type="text"
                                       class="form-control"
                                       placeholder="Квартира"
                                       maxlength="4"
                                       ng-model="Data.common.physicalAddress.apartment"
                                       ng-disabled="SameAddress"
                                       trim-validator>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <h4 align="center"><span class="glyphicon glyphicon-edit"></span> Данные об
                        отчетности</h4>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td style="width: 266px">Тариф СФ</td>
                            <td><select class="form-control" required
                                        ng-model="Data.sf.tariff"
                                        ng-options="option.name disable when option.id === null for option in SFTariffs track by option.id"
                                        ng-class="{'alert-danger': Data.sf.tariff.id==''}"></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Район СФ</td>
                            <td><select class="form-control" required ng-model="Data.sf.region"
                                        ng-options="option.name disable when option.id === null for option in SFRegions track by option.id"
                                        ng-class="{'alert-danger': Data.sf.region.id==''}">
                                </select></td>
                        </tr>
                        <tr>
                            <td>Район ГНС</td>
                            <td><select class="form-control" required ng-model="Data.sti.regionDefault"
                                        ng-options="option.name disable when option.id === null for option in STIRegions track by option.id"
                                        ng-class="{'alert-danger': Data.sti.regionDefault.id==''}">
                                </select></td>
                        </tr>
                        <tr>
                            <td>Район предоставления ГНС</td>
                            <td><select class="form-control" required ng-model="Data.sti.regionReceive"
                                        ng-options="option.name disable when option.id === null for option in STIRegions track by option.id"
                                        ng-class="{'alert-danger': Data.sti.regionReceive.id==''}">
                                </select></td>
                        </tr>
                        </tbody>
                    </table>

                    <h4 align="center">
                        <span class="glyphicon glyphicon-picture"></span> Сканированные изображения юридического
                        лица
                    </h4>
                    <table class="table">
                        <tbody>
                        <tr class="warning" ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td colspan="2" align="center">Свидетельство о государственной регистрации Министерсва
                                Юстиции
                            </td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td style="width: 276px">Кыргызская сторона
                                <label ng-show="Data.common.files.mu_file_kg">Изображение из архива
                                    <input type="checkbox"
                                           ng-model="jur_file_ch_kg"
                                           ng-init="jur_file_ch_kg = (Data.common.files.mu_file_kg) ? true : false"/>
                                </label>
                            </td>
                            <td>
                                <input type="file"
                                       class="form-control"
                                       name="mu_file_kg"
                                       ngf-select
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'.jpg'"
                                       ngf-max-size="5MB"
                                       ngf-model-invalid="errorFile"
                                       ng-model="mu_file_kg"
                                       ng-disabled="(Data.common.civilLegalStatus.name === 'Физическое лицо') || (jur_file_ch_kg)"
                                       ng-show="!Data.common.files.mu_file_kg || !jur_file_ch_kg"
                                       ng-required="Data.common.civilLegalStatus.name !== 'Физическое лицо' &&
                                                    !jur_file_ch_kg"
                                       ng-class="{'alert-danger': !ReqCreateForm.mu_file_kg.$valid}">
                                <p></p>
                                <div class="alert alert-danger" ng-show="ReqCreateForm.mu_file_kg.$error.maxSize">
                                    {{Errors.Files.maxSize}} {{errorFile.size / 1000000 | number:1}}MB.
                                </div>
                                <img class="thumbnail"
                                     ng-show="mu_file_kg"
                                     ngf-src="mu_file_kg"
                                     width="50%">

                                <img class="thumbnail"
                                     ng-show="Data.common.files.mu_file_kg && jur_file_ch_kg"
                                     ng-src="{{JUR_File_kg}}">
                                <div align="center"
                                     ng-show="!Data.common.files.mu_file_kg && jur_file_ch_kg">
                                    Документ отсутсвует
                                </div>
                            </td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td>Русская сторона
                                <label ng-show="Data.common.files.mu_file_ru">Изображение из архива
                                    <input type="checkbox"
                                           ng-model="jur_file_ch_ru"
                                           ng-init="jur_file_ch_ru = (Data.common.files.mu_file_ru) ? true : false"/>
                                </label>
                            </td>
                            <td>
                                <input type="file"
                                       name="mu_file_ru"
                                       class="form-control"
                                       ngf-select
                                       ng-model="mu_file_ru"
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'.jpg'"
                                       ngf-max-size="5MB"
                                       ngf-model-invalid="mu_file_ru_errorFile"
                                       ng-disabled="(Data.common.civilLegalStatus.name === 'Физическое лицо') || (jur_file_ch_ru)"
                                       ng-show="!Data.common.files.mu_file_ru || !jur_file_ch_ru"
                                       ng-required="Data.common.civilLegalStatus.name !== 'Физическое лицо' &&
                                                    !jur_file_ch_ru"
                                       ng-class="{'alert-danger': !ReqCreateForm.mu_file_ru.$valid}">
                                <p></p>
                                <div class="alert alert-danger" ng-show="ReqCreateForm.mu_file_ru.$error.maxSize">
                                    {{Errors.Files.maxSize}} {{mu_file_ru_errorFile.size / 1000000 | number:1}}MB.
                                </div>
                                <img class="thumbnail"
                                     ng-hide="!mu_file_ru"
                                     ngf-src="mu_file_ru"
                                     width="50%">

                                <img class="thumbnail"
                                     ng-show="Data.common.files.mu_file_ru && jur_file_ch_ru"
                                     ng-src="{{JUR_File_ru}}">
                                <div align="center"
                                     ng-show="!Data.common.files.mu_file_ru && jur_file_ch_ru">
                                    Документ отсутсвует
                                </div>
                            </td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name !== 'Физическое лицо'">
                            <td>
                                Свидетельство ИП
                                <label ng-show="Data.common.files.ie_file">Изображение из архива
                                    <input type="checkbox"
                                           ng-model="ie_file_ch"
                                           ng-init="ie_file_ch = (Data.common.files.ie_file) ? true : false"/>
                                </label>
                            </td>
                            <td>
                                <input type="file"
                                       name="ie_file"
                                       class="form-control"
                                       ngf-select
                                       ng-model="ie_file"
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'.jpg'"
                                       ngf-max-size="4MB"
                                       ngf-min-height="100"
                                       ngf-model-invalid="ie_file_errorFile"
                                       ng-required="Data.common.civilLegalStatus.name === 'Физическое лицо' &&
                                                    !ie_file"
                                       ng-disabled="(Data.common.civilLegalStatus.name !== 'Физическое лицо') || (ie_file_ch)"
                                       ng-show="!Data.common.files.ie_file || !ie_file_ch"
                                       ng-class="{'alert-danger': !ReqCreateForm.ie_file.$valid}">
                                <p></p>
                                <div class="alert alert-danger" ng-show="ReqCreateForm.ie_file.$error.maxSize">
                                    {{Errors.Files.maxSize}} {{ie_file_errorFile.size / 1000000 | number:1}}MB.
                                </div>
                                <img class="thumbnail"
                                     ng-hide="!ie_file"
                                     ngf-src="ie_file"
                                     width="50%">
                                <img class="thumbnail"
                                     ng-show="Data.common.files.ie_file && ie_file_ch"
                                     ng-src="{{IE_File_load}}">
                                <div align="center"
                                     ng-show="!Data.common.files.ie_file && ie_file_ch">
                                    Документ отсутсвует
                                </div>
                            </td>
                        </tr>
                        <tr class="warning">
                            <td colspan="2" align="center">Форма М2А</td>
                        </tr>
                        <tr>
                            <td>Выписка (не обязательно)
                                <label ng-show="Data.common.files.mu_file_m2a">Изображение из архива
                                    <input type="checkbox"
                                           ng-model="jur_file_ch_m2a"
                                           ng-init="jur_file_ch_m2a = (Data.common.files.mu_file_m2a) ? true : false"/>
                                </label>
                            </td>
                            <td>
                                <input type="file"
                                       name="mu_file_m2a"
                                       class="form-control"
                                       ngf-select
                                       ng-model="mu_file_m2a"
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'.jpg'"
                                       ngf-max-size="5MB"
                                       ngf-min-height="100"
                                       ngf-model-invalid="mu_file_m2a_errorFile"
                                       ng-show="!Data.common.files.mu_file_m2a || !jur_file_ch_m2a">
                                <p></p>
                                <div class="alert alert-danger" ng-show="ReqCreateForm.mu_file_m2a.$error.maxSize">
                                    {{Errors.Files.maxSize}} {{mu_file_m2a_errorFile.size / 1000000 | number:1}}MB.
                                </div>
                                <img class="thumbnail"
                                     ng-hide="!mu_file_m2a"
                                     ngf-src="mu_file_m2a"
                                     width="50%">

                                <img class="thumbnail"
                                     ng-show="Data.common.files.mu_file_m2a && jur_file_ch_m2a"
                                     ng-src="{{JUR_File_m2a}}"
                                     width="400">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div ng-repeat="key in range(0, count)">
                <!--            <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-certificate"></span> ЭЦП - {{count}} шт.</h3></div>-->
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="left glyphicon glyphicon-certificate"></span> №{{key + 1}} Реквизиты сотрудника
                            компании - {{Data.common.representatives[key].position.name}}
                            <button type="button" class="right btn btn-danger" ng-click="RemoveRepresentative(key)">
                                <span class="glyphicon glyphicon-minus"></span> Удалить
                            </button>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                            <tr class="success">
                                <td colspan="2" align="center">Паспортные данные</td>
                            </tr>
                            <tr>
                                <td style="width: 266px">Серия паспорта</td>
                                <td>
                                    <input type="text"
                                           name="data_common_representatives{{key}}_person_passport_series"
                                           class="form-control"
                                           placeholder="до 4 символов"
                                           minlength="2"
                                           maxlength="4"
                                           required=""
                                           upper-case
                                           passport-only
                                           ng-model="Data.common.representatives[key].person.passport.series"
                                           ng-change="Get_person(Data.common.representatives[key].person.passport.series, Data.common.representatives[key].person.passport.number, key)"
                                           ng-class="{'alert-danger': !ReqCreateForm.data_common_representatives{{key}}_person_passport_series.$valid}">
                                </td>
                            </tr>
                            <tr>
                                <td>Номер паспорта</td>
                                <td><input type="text"
                                           name="data_common_representatives{{key}}_person_passport_number"
                                           class="form-control"
                                           placeholder="до 15 символов"
                                           maxlength="15"
                                           required=""
                                           numbers-only
                                           ng-model="Data.common.representatives[key].person.passport.number"
                                           ng-change="Get_person(Data.common.representatives[key].person.passport.series, Data.common.representatives[key].person.passport.number, key)"
                                           ng-class="{'alert-danger': !ReqCreateForm.data_common_representatives{{key}}_person_passport_number.$valid}">
                                </td>
                            </tr>
                            <tr>
                                <td>Орган выдавший паспорт</td>
                                <td>
                                    <input type="text" class="form-control" placeholder="до 20 символов" maxlength="20"
                                           name="data_common_representatives{{key}}_person_passport_issuingAuthority"
                                           required=""
                                           trim-validator
                                           ng-model="Data.common.representatives[key].person.passport.issuingAuthority"
                                           ng-class="{'alert-danger': !ReqCreateForm.data_common_representatives{{key}}_person_passport_issuingAuthority.$valid}">
                                </td>
                            </tr>
                            <tr>
                                <td>Дата выдачи</td>
                                <td><input type="text"
                                           name="data_common_representatives{{key}}_person_passport_issuingDate"
                                           class="form-control"
                                           placeholder="ДД.ММ.ГГГГ"
                                           maxlength="10"
                                           minlength="10"
                                           required=""
                                           date-mask
                                           ng-keyup="CheckIssuingDate(key)"
                                           ng-model="Data.common.representatives[key].person.passport.issuingDate"
                                           ng-class="{'alert-danger': !ReqCreateForm.data_common_representatives{{key}}_person_passport_issuingDate.$valid}">
                                    <p></p>
                                    <div class=" alert alert-danger"
                                         ng-show="errorissuingdate">
                                        {{errorissuingdate}}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>ПИН</td>
                                <td><input type="text"
                                           name="data_common_representatives{{key}}_person_pin"
                                           class="form-control"
                                           placeholder="Персональный идентификационный номер"
                                           minlength="14"
                                           maxlength="14"
                                           required
                                           numbers-only
                                           ng-model="Data.common.representatives[key].person.pin"
                                           ng-class="{'alert-danger': !ReqCreateForm.data_common_representatives{{key}}_person_pin.$valid}">
                                </td>
                            </tr>
                            <tr class="success">
                                <td colspan="2" align="center">Персональные данные</td>
                            </tr>
                            <tr>
                                <td>Фамилия</td>
                                <td><input type="text" class="form-control" placeholder="" maxlength="25" required=""
                                           name="data_common_representatives{{key}}_person_surname"
                                           fio-mask
                                           ng-model="Data.common.representatives[key].person.surname"
                                           ng-class="{'alert-danger': !ReqCreateForm.data_common_representatives{{key}}_person_surname.$valid}">
                                </td>
                            </tr>
                            <tr>
                                <td>Имя</td>
                                <td><input type="text" class="form-control" placeholder="" maxlength="20" required
                                           fio-mask
                                           name="data_common_representatives{{key}}_person_name"
                                           ng-model="Data.common.representatives[key].person.name"
                                           ng-class="{'alert-danger': !ReqCreateForm.data_common_representatives{{key}}_person_name.$valid}">
                                </td>
                            </tr>
                            <tr>
                                <td>Отчество</td>
                                <td><input type="text" class="form-control" placeholder="" maxlength="25"
                                           fio-mask
                                           name="middleName"
                                           ng-model="Data.common.representatives[key].person.middleName"></td>
                            </tr>
                            <tr>
                                <td>Должность</td>
                                <td>
                                    <select class="form-control"
                                            required
                                            ng-model="Data.common.representatives[key].position"
                                            ng-options="option.name disable when option.id === null for option in Positions track by option.id"
                                            ng-class="{'alert-danger': Data.common.representatives[key].position.id==''}">
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Роль в системе</td>
                                <td>
                                    <p ng-repeat="role in Roles">
                                        <input type="checkbox"
                                               name="data_common_representatives{{key}}_role{{role.id}}"
                                               data-checklist-model="Data.common.representatives[key].roles"
                                               data-checklist-value="role"
                                               ng-disabled="(role.id == 1 && !role_1 && !checked) ||
                                               (role.id == 2 && !role_2 && !checked) ||
                                               (role.id == 3 && !role_3 && !checked) ||
                                               (role.id == 6 && !role_6 && !checked)"
                                               ng-required="!Check_role(role)"
                                               ng-click="Checked_role(role)">
                                        {{role.name}}
                                    </p>
                                    <p></p>
                                    <div class=" alert alert-danger"
                                         ng-show="errorroles">
                                        {{errorroles}}
                                    </div>
                                </td>
                            </tr>
                            <tr ng-hide="Check_chief(key)">
                                <td>Основание занимаемой должности</td>
                                <td>
                                    <select class="form-control"
                                            ng-disabled="Check_chief(key)"
                                            required=""
                                            ng-model="Data.common.chiefBasis"
                                            ng-options="option.name disable when option.id === null for option in ChiefBasises track by option.id"
                                            ng-class="{'alert-danger': Data.common.chiefBasis.id==''}">
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Рабочий телефон</td>
                                <td><input type="text" class="form-control" placeholder="до 20 символов" maxlength="20"
                                           name="data_common_representatives{{key}}_phone"
                                           required=""
                                           telephone-cell
                                           ng-model="Data.common.representatives[key].phone"
                                           ng-class="{'alert-danger': !ReqCreateForm.data_common_representatives{{key}}_phone.$valid}">
                                </td>
                            </tr>
                            <tr ng-hide="Data.common.representatives[key].roles === undefined || Data.common.representatives[key].roles.length == 0 ||
                                         (Data.common.representatives[key].roles != undefined && Data.common.representatives[key].roles.length == 1 &&
                                           Data.common.representatives[key].roles[0].id == 3)">
                                <td>Носитель ЭП</td>
                                <td>
                                    <p data-ng-repeat="edsUsageModel in edsUsageModels track by edsUsageModel.id">
                                        <input type="radio"
                                               ng-model="Data.common.representatives[key].edsUsageModel"
                                               ng-value="edsUsageModel"
                                               ng-disabled="Data.common.representatives[key].roles.length == 1 &&
                                               Data.common.representatives[key].roles[0].id == 3"
                                        >
                                        {{edsUsageModel.name}}
                                    </p>
                                </td>
                            </tr>
                            <tr ng-hide="Data.common.representatives[key].roles === undefined || Data.common.representatives[key].roles.length == 0 ||
                                         (Data.common.representatives[key].roles != undefined && Data.common.representatives[key].roles.length == 1 &&
                                           Data.common.representatives[key].roles[0].id == 3)">
                                <td>
                                    Серийный номер РуТокен
                                    <!--(<a href="" ng-click="getSerialNumber(key, 0)">Прочитать<a>)-->
                                </td>
                                <td>
                                    <input type="text"
                                           name="data_common_representatives{{key}}_deviceSerial"
                                           class="form-control"
                                           placeholder="Номер токена"
                                           minlength="10"
                                           maxlength="10"
                                           numbers-only
                                           ng-required="!(Data.common.representatives[key].edsUsageModel.id == 2 ||
                                           (Data.common.representatives[key].roles.length == 1 && Data.common.representatives[key].roles[0].id == 3))"
                                           ng-model="Data.common.representatives[key].deviceSerial"
                                           ng-disabled="Data.common.representatives[key].edsUsageModel.id == 2 ||
                                           (Data.common.representatives[key].roles.length == 1 && Data.common.representatives[key].roles[0].id == 3)"
                                           ng-class="{'alert-danger': !ReqCreateForm.data_common_representatives{{key}}_deviceSerial.$valid}">
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="page-header">
                            <h3 align="center"><span class="glyphicon glyphicon-picture"></span> Сканированные
                                изображения паспорта</h3>
                        </div>
                        <table class="table">
                            <tbody>
                            <tr class="success">
                                <td colspan="2" align="center">Паспорт физического лица</td>
                            </tr>
                            <tr>
                                <td style="width: 266px">Cторона 1
                                    <label ng-show="Data.common.representatives[key].files.passport_side_1">Изображение
                                        из архива
                                        <input type="checkbox"
                                               ng-model="rep_file_ch_passport_side_1[key]"
                                               ng-init="rep_file_ch_passport_side_1[key] =
                                               (Data.common.representatives[key].files.passport_side_1) ? true : false"/>
                                    </label>
                                </td>
                                <td>
                                    <input type="file"
                                           name="passport_side_1_{{key}}"
                                           class="form-control"
                                           ng-required="get_require_pin(Data.common.representatives[key].person.pin) &&
                                                        !rep_file_ch_passport_side_1[key]"
                                           ngf-select
                                           ng-model="passport_side_1[key]"
                                           ngf-pattern="'image/*'" ngf-accept="'.jpg'"
                                           ngf-max-size="5MB"
                                           ngf-min-height="100"
                                           ngf-model-invalid="passport_side_1errorFile[key]"
                                           ng-disabled="rep_file_ch_passport_side_1[key]"
                                           ng-show="!Data.common.representatives[key].files.passport_side_1 || !rep_file_ch_passport_side_1[key]"
                                           ng-class="{'alert-danger': !ReqCreateForm.passport_side_1_{{key}}.$valid}">
                                    <p></p>
                                    <div class=" alert alert-danger"
                                         ng-show="ReqCreateForm.passport_side_1_{{key}}.$error.maxSize">
                                        {{Errors.Files.maxSize}}
                                        {{passport_side_1errorFile[key].size / 1000000 | number:1}}MB.
                                    </div>
                                    <img class="thumbnail"
                                         ng-hide="!passport_side_1[key]"
                                         ngf-src="passport_side_1[key]"
                                         width="50%">

                                    <img class="thumbnail"
                                         ng-show="Data.common.representatives[key].files.passport_side_1 && rep_file_ch_passport_side_1[key]"
                                         ng-src="{{REP_File_front[key]}}">
                                </td>
                            </tr>
                            <tr>
                                <td>Cторона 2
                                    <label ng-show="Data.common.representatives[key].files.passport_side_2">Изображение
                                        из архива
                                        <input type="checkbox"
                                               ng-model="rep_file_ch_passport_side_2[key]"
                                               ng-init="rep_file_ch_passport_side_2[key] = (Data.common.representatives[key].files.passport_side_2) ? true : false"/>
                                    </label>
                                </td>
                                <td>
                                    <input type="file"
                                           name="passport_side_2_{{key}}"
                                           class="form-control"
                                           ngf-select
                                           ng-model="passport_side_2[key]"
                                           ngf-pattern="'image/*'" ngf-accept="'.jpg'"
                                           ngf-max-size="5MB"
                                           ngf-min-height="100"
                                           ngf-model-invalid="passport_side_2errorFile[key]"
                                           ng-show="!Data.common.representatives[key].files.passport_side_2 || !rep_file_ch_passport_side_2[key]"
                                           ng-class="{'alert-danger': !ReqCreateForm.passport_side_2_{{key}}.$valid}">
                                    <p></p>
                                    <div class="alert alert-danger"
                                         ng-show="ReqCreateForm.passport_side_2_{{key}}.$error.maxSize">
                                        {{Errors.Files.maxSize}}
                                        {{passport_side_2errorFile[key].size / 1000000 | number:1}}MB.
                                    </div>
                                    <img class="thumbnail"
                                         ng-hide="!passport_side_2[key]"
                                         ngf-src="passport_side_2[key]"
                                         width="50%">

                                    <img class="thumbnail"
                                         ng-show="Data.common.representatives[key].files.passport_side_2 && rep_file_ch_passport_side_2[key]"
                                         ng-src="{{REP_File_back[key]}}">
                                </td>
                            </tr>
                            <tr class="success">
                                <td colspan="2" align="center">Нотариально заверенная копия паспорта переведенной на
                                    официальный язык КР
                                </td>
                            </tr>
                            <tr>
                                <td>Нотариально заверенная копия
                                    <label ng-show="Data.common.representatives[key].files.passport_copy">Изображение из
                                        архива
                                        <input type="checkbox"
                                               ng-model="rep_file_ch_passport_copy[key]"
                                               ng-init="rep_file_ch_passport_copy[key] = (Data.common.representatives[key].files.passport_copy) ? true : false"/>
                                    </label>
                                </td>
                                <td>
                                    <input type="file"
                                           name="passport_copy_{{key}}"
                                           class="form-control"
                                           ngf-select
                                           ng-model="passport_copy[key]"
                                           ngf-pattern="'image/*'"
                                           ngf-accept="'.jpg'"
                                           ngf-max-size="5MB"
                                           ngf-min-height="100"
                                           ngf-model-invalid="passport_copy_errorFile[key]"
                                           ng-show="!Data.common.representatives[key].files.passport_copy || !rep_file_ch_passport_copy[key]"
                                           ng-class="{'alert-danger': !ReqCreateForm.passport_copy_{{key}}.$valid}">
                                    <p></p>
                                    <div class="alert alert-danger"
                                         ng-show="ReqCreateForm.passport_copy_{{key}}.$error.maxSize">
                                        {{Errors.Files.maxSize}}
                                        {{passport_copy_errorFile[key].size / 1000000 | number:1}}MB.
                                    </div>
                                    <img class="thumbnail"
                                         ng-hide="!passport_copy[key]"
                                         ngf-src="passport_copy[key]"
                                         width="50%">

                                    <img class="thumbnail"
                                         ng-show="Data.common.representatives[key].files.passport_copy && rep_file_ch_passport_copy[key]"
                                         ng-src="{{REP_File_copy[key]}}">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div ng-show="toggle">
                <button type="button" class="btn btn-warning" ng-click="addNewRepresentative()">
                    <span class="glyphicon glyphicon-plus"></span> Добавить сотрудника
                </button>
            </div>
            <div align="center" ng-show="toggle && ReqCreateForm.$valid">
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-save"></span> Создать заявку
                </button>
            </div>
            <p></p>
            <div class="alert alert-danger" ng-hide="ReqCreateForm.$valid">
                Форма содержит ошибки или не заполненые поля.
            </div>
        </form>

        <div class="alert alert-success" ng-hide="!resultupload">
            <p ng-bind-html="ResUpload"></p>
        </div>
        <div class="alert alert-danger" ng-hide="!errorMsg">
            <p ng-bind-html="ErrorMessages"></p>
        </div>
        <div ng-hide="!progressjur || progressjur === 100">
            <div>Загрузка изображения юридического лица</div>
            <div class="progress progress-striped active">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                     aria-valuemax="100" style="width: {{progressjur}}%">
                    <span class="sr-only">{{progressjur}}%</span>
                </div>
            </div>
        </div>
        <div ng-hide="!progressphy || progressphy === 100">
            <div>Загрузка изображения физических лиц</div>
            <div class="progress progress-striped active">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                     aria-valuemax="100" style="width: {{progressphy}}%">
                    <span class="sr-only">{{progressphy}}%</span>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="<?php echo base_url("resources/js/ng-file-upload.min.js"); ?>"></script>
<script src="<?php echo base_url("resources/js/check-list-model.js"); ?>"></script>
<script src="<?php echo base_url("resources/js/angular-cookies.min.js"); ?>"></script>
<script src="<?php echo base_url("resources/js/rutoken/dependencies.js"); ?>"></script>
<script src="<?php echo base_url("resources/js/rutoken//PluginManager.js"); ?>"></script>
<script src="<?php echo base_url("resources/js/DealerSystem//app_init.js"); ?>"></script>
<script src="<?php echo base_url("resources/js/DealerSystem/RequisitesRegisterErrors.js"); ?>"></script>
<script src="<?php echo base_url("resources/js/DealerSystem/RequisitesRegisterController.js"); ?>"></script>

<script type="text/javascript">
    /* Инициализация переменных для справочников и дефаулт значений для RequisitesRegisterForm контроллера */
    let requisites_json = <?php echo json_encode(isset($requisites_json) ? $requisites_json : "''");//json с предыдущей регистрацией ?>;
    let ownershipForm_id = <?php echo (isset($requisites_json->common->legalForm->ownershipForm->id)) ?
        $requisites_json->common->legalForm->ownershipForm->id : "''"; ?>;
    let juristicAddress = <?php
        echo isset($requisites_json->common->juristicAddress->settlement) ?
            (isset($requisites_json->common->juristicAddress->settlement->region) ?
                $requisites_json->common->juristicAddress->settlement->region->id :
                (isset($requisites_json->common->juristicAddress->settlement->district) ?
                    $requisites_json->common->juristicAddress->settlement->district->region->id : "'none'")
            ) : "''";
        ?>;
    let physicalAddress = <?php
        echo isset($requisites_json->common->physicalAddress->settlement) ?
            (isset($requisites_json->common->physicalAddress->settlement->region) ?
                $requisites_json->common->physicalAddress->settlement->region->id :
                (isset($requisites_json->common->physicalAddress->settlement->district) ?
                    $requisites_json->common->physicalAddress->settlement->district->region->id : "'none'")
            ) : "''";
        ?>;
    let chiefBasis_id = <?php echo (isset($requisites_json->common->chiefBasis->id)) ?
        $requisites_json->common->chiefBasis->id : "''"; ?>;
    let tariff_id = <?php echo (isset($requisites_json->sf->tariff->id)) ?
        $requisites_json->sf->tariff->id : "''"; ?>;
    let region_id = <?php echo (isset($requisites_json->sf->region->id)) ?
        $requisites_json->sf->region->id : "''"; ?>;
    let regionDefault_id = <?php echo (isset($requisites_json->sti->regionDefault->id)) ?
        $requisites_json->sti->regionDefault->id : "''"; ?>;
    let regionReceive_id = <?php echo (isset($requisites_json->sti->regionReceive->id)) ?
        $requisites_json->sti->regionReceive->id : "''"; ?>;
    let legalForm_id = <?php echo (isset($requisites_json->common->legalForm->id)) ?
        $requisites_json->common->legalForm->id : "''"; ?>;
    let civilLegalStatus_id = <?php echo (isset($requisites_json->common->civilLegalStatus->id)) ?
        $requisites_json->common->civilLegalStatus->id : "''"; ?>;
    let settlement_id = <?php echo (isset($requisites_json->common->juristicAddress->settlement->id)) ?
        $requisites_json->common->juristicAddress->settlement->id : "''"; ?>;
    let settlement_phy_id = <?php echo (isset($requisites_json->common->physicalAddress->settlement->id)) ?
        $requisites_json->common->physicalAddress->settlement->id : "''"; ?>;
    let object_pins = <?php  echo json_encode(isset($object_pins) ? $object_pins : "''"); ?>;
    let eds_count = <?php echo(isset($invoice_data) ? $invoice_data->eds_count : 0)?>
</script>
