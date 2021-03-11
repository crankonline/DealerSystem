<?php
defined('BASEPATH') or exit('No direct script access allowed');
//var_dump($this->session->userdata);die;
?>
<div class="container theme-showcase" role="main" ng-app="DealerSystem" ng-controller="RequisitesRegisterForm">
    <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере    ?>
        <div class="alert alert-danger">
            <h3 align="center"><strong>Произошла ошибка!<br>Регистрация невозможна!</strong></h3>
            <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <form ng-submit="Upload()" ng-show="toggle">
            <?php if (isset($message)): ?>
                <div class="alert alert-warning" align="center">
                    <h3><strong>Внимание: </strong><?php echo $message; ?></h3>
                </div>
            <?php endif; ?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span> Реквизиты юридического лица
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-star"></span> Основные
                            сведения</h3></div>
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
                                       class="form-control"
                                       placeholder="8 цифр"
                                       minlength="6" maxlength="8"
                                       required=""
                                       numbers-only
                                       ng-model="Data.common.okpo">
                            </td>
                        </tr>
                        <tr>
                            <td>Рег. номер Социального Фонда</td>
                            <td><input type="text"
                                       class="form-control"
                                       placeholder="12 цифр"
                                       minlength="12" maxlength="12"
                                       required=""
                                       numbers-only
                                       ng-model="Data.common.rnsf">
                            </td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td>Рег. номер Министерства Юстиции</td>
                            <td><input type="text" class="form-control" placeholder="XXXXXX-YYYY-ZZZ" required=""
                                       maxlength="15"
                                       ng-model="Data.common.rnmj"
                                       ng-disabled="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            </td>
                        </tr>
                        <tr>
                            <td>Наименование организации</td>
                            <td><textarea maxlength="255"
                                          class="form-control noresize"
                                          style="resize: vertical"
                                          placeholder="Наименование юридического лица"
                                          required=""
                                          ng-model="Data.common.name"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Полное наименование организации</td>
                            <td><textarea maxlength="255"
                                          class="form-control noresize"
                                          style="resize: vertical"
                                          placeholder="Полное наименование юридического лица с ОПФ"
                                          required=""
                                          ng-model="Data.common.fullName"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>ГКЭД</td>
                            <td><input type="text"
                                       class="form-control"
                                       placeholder="XX.YY.ZZ"
                                       maxlength="9"
                                       required=""
                                       ng-model="Data.common.mainActivity.gked"
                                       ng-change="CheckGked()"
                                       gked-mask></td>
                        </tr>
                        <tr>
                            <td>Вид деятельности</td>
                            <td><textarea maxlength="255"
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
                                        ng-model="Data.common.legalForm.ownershipForm"
                                        ng-options="option.name disable when option.id === null for option in OwnershipForms track by option.id"
                                        ng-change="loadLegalForm()"></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Организационно-правовая форма</td>
                            <td><select required
                                        class="form-control"
                                        ng-model="Data.common.legalForm"
                                        ng-options="option.name disable when option.id === null for option in LegalForms track by option.id"
                                        ng-change="loadCivilLegalStatuses()"></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Гражданско-правовой статус</td>
                            <td><select required
                                        class="form-control"
                                        ng-model="Data.common.civilLegalStatus"
                                        ng-options="option.name disable when option.id === null for option in CivilLegalStatuses track by option.id"></select>
                            </td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td>Форма участия в капитале</td>
                            <td><select required
                                        class="form-control"
                                        ng-model="Data.common.capitalForm"
                                        ng-options="option.name disable when option.id === null for option in CapitalForms track by option.id"
                                        ng-disabled="Data.common.civilLegalStatus.name === 'Физическое лицо'"></select>
                            </td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td>Форма управления</td>
                            <td><select required
                                        class="form-control"
                                        ng-model="Data.common.managementForm"
                                        ng-options="option.name disable when option.id === null for option in ManagementForms track by option.id"
                                        ng-disabled="Data.common.civilLegalStatus.name === 'Физическое лицо'"></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Электронная почта</td>
                            <td><input type="email"
                                       class="form-control"
                                       placeholder="E-mail"
                                       maxlength="30"
                                       required=""
                                       ng-model="Data.common.eMail">
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-euro"></span>
                            Банковские реквизиты</h3></div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="2" align="center">
                                <label class="btn btn-danger">
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
                                       maxlength="6"
                                       required=""
                                       numbers-only
                                       ng-model="Data.common.bank.id"
                                       ng-change="loadBankName()"
                                       ng-disabled="!Bank_else">
                            </td>
                        </tr>
                        <tr ng-hide="!Bank_else">
                            <td>Наименование банка</td>
                            <td><input type="text"
                                       class="form-control"
                                       placeholder="Введите БИК ячейкой выше"
                                       required=""
                                       ng-model="Data.common.bank.name"
                                       ng-disabled="!Data.common.bank.id || !Bank_else">
                            </td>
                        </tr>
                        <tr ng-hide="!Bank_else">
                            <td>Расчетный счет</td>
                            <td><input type="text"
                                       class="form-control"
                                       placeholder="16 цифр"
                                       minlength="16"
                                       maxlength="16"
                                       required=""
                                       numbers-only
                                       ng-model="Data.common.bankAccount"
                                       ng-disabled="(!Data.common.bank || !Data.common.bank.name) || !Bank_else">
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-globe"></span> Адресные
                            данные</h3></div>
                    <table class="table">
                        <tbody>
                        <tr class="danger" align="center">
                            <td colspan="2">Юридический адрес</td>
                        </tr>
                        <tr>
                            <td style="width: 266px">Почтовый Индекс</td>
                            <td><input type="text"
                                       class="form-control"
                                       placeholder="6 цифр"
                                       minlength="6"
                                       maxlength="6"
                                       required=""
                                       numbers-only
                                       ng-model="Data.common.juristicAddress.postCode">
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
                                            ng-change="loadJuristicDistricts()"></select>
                                </div>
                                <div style="display: none"
                                     ng-style="(currentjuristicregion.id == 'none' || currentjuristicregion.id == '') && { display: 'none' }">
                                    <select class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" required
                                            ng-model="currentjuristicdistrict"
                                            ng-options="option.name disable when option.id === null for option in JuristicDistricts track by option.id"
                                            ng-change="loadJuristicSettlements()"></select>
                                </div>
                                <div style="display: none"
                                     ng-style="(currentjuristicregion.id == 'none' || (currentjuristicdistrict.id != null && currentjuristicdistrict.id != '')) && { display: 'block' }">
                                    <select class="form-control ng-pristine ng-untouched ng-valid ng-empty" required
                                            ng-model="Data.common.juristicAddress.settlement"
                                            ng-options="option.name disable when option.id === null for option in JuristicSettlements track by option.id"></select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Улица / Микрорайон</td>
                            <td><input type="text"
                                       class="form-control"
                                       placeholder="Улица / Микрорайон"
                                       maxlength="50"
                                       required=""
                                       ng-model="Data.common.juristicAddress.street">
                            </td>
                        </tr>
                        <tr>
                            <td>Дом / Строение</td>
                            <td><input type="text"
                                       class="form-control"
                                       placeholder="Дом / Строение"
                                       required=""
                                       maxlength="4"
                                       ng-model="Data.common.juristicAddress.building">
                            </td>
                        </tr>
                        <tr>
                            <td>Квартира</td>
                            <td><input type="text"
                                       class="form-control"
                                       placeholder="Квартира"
                                       maxlength="4"
                                       ng-model="Data.common.juristicAddress.apartment">
                            </td>
                        </tr>
                        <tr class="danger" align="center">
                            <td colspan="2">Физический адрес</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><label class="btn btn-danger">
                                    <input type="checkbox"
                                           ng-model="SameAddress"
                                           ng-init="SameAddress = true"> совпадает с юридическим</label>
                            </td>
                        </tr>
                        <tr ng-hide="SameAddress">
                            <td style="width: 266px">Почтовый Индекс</td>
                            <td><input type="text" class="form-control" placeholder="6 цифр" minlength="6" maxlength="6"
                                       required="" numbers-only
                                       ng-model="Data.common.physicalAddress.postCode" ng-disabled="SameAddress">
                            </td>
                        </tr>
                        <tr ng-hide="SameAddress">
                            <td>Населенный пункт</td>
                            <td>
                                <div style="display: block"><select class="form-control" required
                                                                    ng-model="currentphysicalregion"
                                                                    ng-disabled="SameAddress"
                                                                    ng-options="option.name disable when option.id === null for option in PhysicalRegions track by option.id"
                                                                    ng-change="loadPhysicalDistricts()"
                                                                    ng-disabled="SameAddress">
                                    </select></div>
                                <div style="display: none"
                                     ng-style="(currentphysicalregion.id == 'none' || currentphysicalregion.id == '') && { display: 'none' }">
                                    <select class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" required
                                            ng-model="currentphysicaldistrict"
                                            ng-options="option.name disable when option.id === null for option in PhysicalDistricts track by option.id"
                                            ng-change="loadPhysicalSettlements()">
                                    </select></div>
                                <div style="display: none"
                                     ng-style="(currentphysicalregion.id == 'none' || (currentphysicaldistrict.id != null && currentphysicaldistrict.id != '')) && { display: 'block' }">
                                    <select class="form-control ng-pristine ng-untouched ng-valid ng-empty" required
                                            ng-model="Data.common.physicalAddress.settlement"
                                            ng-options="option.name disable when option.id === null for option in PhysicalSettlements track by option.id">
                                    </select></div>
                            </td>
                        </tr>
                        <tr ng-hide="SameAddress">
                            <td>Улица / Микрорайон</td>
                            <td>
                                <input type="text" class="form-control" placeholder="Улица / Микрорайон" maxlength="50"
                                       required="" ng-model="Data.common.physicalAddress.street"
                                       ng-disabled="SameAddress"></td>
                        </tr>
                        <tr ng-hide="SameAddress">
                            <td>Дом / Строение</td>
                            <td><input type="text" class="form-control" placeholder="Дом / Строение" maxlength="4"
                                       required="" ng-model="Data.common.physicalAddress.building"
                                       ng-disabled="SameAddress"></td>
                        <tr ng-hide="SameAddress">
                            <td>Квартира</td>
                            <td><input type="text" class="form-control" placeholder="Квартира" maxlength="4"
                                       ng-model="Data.common.physicalAddress.apartment" ng-disabled="SameAddress"
                                       ng-init="Data.common.physicalAddress.apartmen = null" required=""></td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-edit"></span> Данные об
                            отчетности</h3></div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td style="width: 266px">Тариф СФ</td>
                            <td><select class="form-control" required
                                        ng-model="Data.sf.tariff"
                                        ng-options="option.name disable when option.id === null for option in SFTariffs track by option.id"></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Район СФ</td>
                            <td><select class="form-control" required ng-model="Data.sf.region"
                                        ng-options="option.name disable when option.id === null for option in SFRegions track by option.id">
                                </select></td>
                        </tr>
                        <tr>
                            <td>Район ГНС</td>
                            <td><select class="form-control" required ng-model="Data.sti.regionDefault"
                                        ng-options="option.name disable when option.id === null for option in STIRegions track by option.id">
                                </select></td>
                        </tr>
                        <tr>
                            <td>Район предоставления ГНС</td>
                            <td><select class="form-control" required ng-model="Data.sti.regionReceive"
                                        ng-options="option.name disable when option.id === null for option in STIRegions track by option.id">
                                </select></td>
                        </tr>
                        <!--                        <tr>
                                                    <td>Система отчетности</td>
                                                    <td><select  class="form-control" required="">
                                                            <option value="">Выберите значение</option>
                                                            <option value="1">Cоциальный фонд</option>
                                                            <option value="2">ЕНОТ ЮБР</option>
                                                        </select></td>
                                                </tr>-->
                        </tbody>
                    </table>
                    <div class="page-header">
                        <h3 align="center">
                            <span class="glyphicon glyphicon-picture"></span> Сканированные изображения юридического
                            лица
                        </h3>
                    </div>
                    <table class="table">
                        <tbody>
                        <tr class="danger" ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
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
                                       required=""
                                       ngf-select
                                       ng-model="mu_file_kg"
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'.jpg'"
                                       ngf-max-size="5MB"
                                       ngf-min-height="100"
                                       ng-disabled="(Data.common.civilLegalStatus.name === 'Физическое лицо') || (jur_file_ch_kg)"
                                       ng-show="!Data.common.files.mu_file_kg || !jur_file_ch_kg">
                                <img class="thumbnail"
                                     ng-show="mu_file_kg"
                                     ngf-src="mu_file_kg"
                                     width="50%">

                                <img class="thumbnail"
                                     ng-show="Data.common.files.mu_file_kg && jur_file_ch_kg"
                                     ng-src="{{JUR_File_kg}}"
                                     width="400">
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
                                       class="form-control"
                                       required=""
                                       ngf-select
                                       ng-model="mu_file_ru"
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'.jpg'"
                                       ngf-max-size="5MB"
                                       ngf-min-height="100"
                                       ng-disabled="(Data.common.civilLegalStatus.name === 'Физическое лицо') || (jur_file_ch_ru)"
                                       ng-show="!Data.common.files.mu_file_ru || !jur_file_ch_ru">
                                <img class="thumbnail"
                                     ng-hide="!mu_file_ru"
                                     ngf-src="mu_file_ru"
                                     width="50%">

                                <img class="thumbnail"
                                     ng-show="Data.common.files.mu_file_ru && jur_file_ch_ru"
                                     ng-src="{{JUR_File_ru}}"
                                     width="400">
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
                                       class="form-control"
                                       required=""
                                       ngf-select
                                       ng-model="ie_file"
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'.jpg'"
                                       ngf-max-size="5MB"
                                       ngf-min-height="100"
                                       ng-disabled="(Data.common.civilLegalStatus.name !== 'Физическое лицо') || (ie_file_ch)"
                                       ng-show="!Data.common.files.ie_file || !ie_file_ch">
                                <img class="thumbnail"
                                     ng-hide="!ie_file"
                                     ngf-src="ie_file"
                                     width="50%">
                                <img class="thumbnail"
                                     ng-show="Data.common.files.ie_file && ie_file_ch"
                                     ng-src="{{IE_File_load}}"
                                     width="400">
                                <div align="center"
                                     ng-show="!Data.common.files.ie_file && ie_file_ch">
                                    Документ отсутсвует
                                </div>
                            </td>
                        </tr>
                        <tr class="danger">
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
                                       class="form-control"
                                       ngf-select
                                       ng-model="mu_file_m2a"
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'.jpg'"
                                       ngf-max-size="5MB"
                                       ngf-min-height="100"
                                       ng-show="!Data.common.files.mu_file_m2a || !jur_file_ch_m2a">
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
                                           class="form-control"
                                           placeholder="до 4 символов"
                                           minlength="2"
                                           maxlength="4"
                                           required=""
                                           upper-case
                                           ng-model="Data.common.representatives[key].person.passport.series"
                                           ng-change="Get_person(Data.common.representatives[key].person.passport.series, Data.common.representatives[key].person.passport.number, key)">
                                </td>
                            </tr>
                            <tr>
                                <td>Номер паспорта</td>
                                <td><input type="text"
                                           class="form-control"
                                           placeholder="до 15 символов"
                                           maxlength="15"
                                           required=""
                                           numbers-only
                                           ng-model="Data.common.representatives[key].person.passport.number"
                                           ng-change="Get_person(Data.common.representatives[key].person.passport.series, Data.common.representatives[key].person.passport.number, key)">
                                </td>
                            </tr>
                            <tr>
                                <td>Орган выдавший паспорт</td>
                                <td>
                                    <input type="text" class="form-control" placeholder="до 20 символов" maxlength="20"
                                           required=""
                                           ng-model="Data.common.representatives[key].person.passport.issuingAuthority">
                                </td>
                            </tr>
                            <tr>
                                <td>Дата выдачи</td>
                                <td><input type="text"
                                           class="form-control"
                                           placeholder="ДД.ММ.ГГГГ"
                                           maxlength="10"
                                           required=""
                                           gked-mask
                                           ng-model="Data.common.representatives[key].person.passport.issuingDate"></td>
                            </tr>
                            <tr>
                                <td>ПИН</td>
                                <td><input type="text"
                                           class="form-control"
                                           placeholder="Персональный идентификационный номер"
                                           minlength="14"
                                           maxlength="14"
                                           required
                                           numbers-only
                                           ng-model="Data.common.representatives[key].person.pin"></td>
                            </tr>
                            <tr class="success">
                                <td colspan="2" align="center">Персональные данные</td>
                            </tr>
                            <tr>
                                <td>Фамилия</td>
                                <td><input type="text" class="form-control" placeholder="" maxlength="25" required=""
                                           ng-model="Data.common.representatives[key].person.surname"></td>
                            </tr>
                            <tr>
                                <td>Имя</td>
                                <td><input type="text" class="form-control" placeholder="" maxlength="20" required=""
                                           ng-model="Data.common.representatives[key].person.name"></td>
                            </tr>
                            <tr>
                                <td>Отчество</td>
                                <td><input type="text" class="form-control" placeholder="" maxlength="25"
                                           ng-model="Data.common.representatives[key].person.middleName"></td>
                            </tr>
                            <tr>
                                <td>Должность</td>
                                <td>
                                    <select class="form-control"
                                            required
                                            ng-model="Data.common.representatives[key].position"
                                            ng-options="option.name disable when option.id === null for option in Positions track by option.id">
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Роль в системе</td>
                                <td>
                                    <p ng-repeat="role in Roles">
                                        <input type="checkbox"
                                               data-checklist-model="Data.common.representatives[key].roles"
                                               data-checklist-value="role"
                                               ng-disabled="(role.id == 1 && !role_1 && !checked) || (role.id == 2 && !role_2 && !checked) || (role.id == 3 && !role_3 && !checked) || (role.id == 6 && !role_6 && !checked)"
                                               ng-click="Checked_role(role)">
                                        {{role.name}}
                                    </p>
                                </td>
                            </tr>
                            <tr ng-hide="role_1">
                                <td>Основание занимаемой должности</td>
                                <td>
                                    <select class="form-control"
                                            require
                                            ng-model="Data.common.chiefBasis"
                                            ng-options="option.name disable when option.id === null for option in ChiefBasises track by option.id">
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Рабочий телефон</td>
                                <td><input type="text" class="form-control" placeholder="до 20 символов" maxlength="20"
                                           required="" numbers-only
                                           ng-model="Data.common.representatives[key].phone"></td>
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
                                               ng-disabled="Data.common.representatives[key].roles.length == 1 && Data.common.representatives[key].roles[0].id == 3">
                                        {{edsUsageModel.name }}
                                    </p>
                                </td>
                            </tr>
                            <tr ng-hide="Data.common.representatives[key].roles === undefined || Data.common.representatives[key].roles.length == 0 ||
                                         (Data.common.representatives[key].roles != undefined && Data.common.representatives[key].roles.length == 1 &&
                                           Data.common.representatives[key].roles[0].id == 3)">
                                <td>
                                    Серийный номер РуТокен (<a href="" ng-click="getSerialNumber(key, 0)">Прочитать<a>)
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control"
                                           placeholder="Номер токена"
                                           minlength="10"
                                           maxlength="10"
                                           numbers-only
                                           required=""
                                           ng-model="Data.common.representatives[key].deviceSerial"
                                           ng-disabled="Data.common.representatives[key].edsUsageModel.id == 2 || (Data.common.representatives[key].roles.length == 1 && Data.common.representatives[key].roles[0].id == 3)">

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
                                               ng-init="rep_file_ch_passport_side_1[key] = (Data.common.representatives[key].files.passport_side_1) ? true : false"/>
                                    </label>
                                </td>
                                <td>
                                    <input type="file"
                                           class="form-control"
                                           required=""
                                           ngf-select
                                           ng-model="passport_side_1[key]"
                                           ngf-pattern="'image/*'" ngf-accept="'.jpg'"
                                           ngf-max-size="5MB"
                                           ngf-min-height="100"
                                           ng-disabled="rep_file_ch_passport_side_1[key]"
                                           ng-show="!Data.common.representatives[key].files.passport_side_1 || !rep_file_ch_passport_side_1[key]">
                                    <img class="thumbnail"
                                         ng-hide="!passport_side_1[key]"
                                         ngf-src="passport_side_1[key]"
                                         width="50%">

                                    <img class="thumbnail"
                                         ng-show="Data.common.representatives[key].files.passport_side_1 && rep_file_ch_passport_side_1[key]"
                                         ng-src="{{REP_File_front[key]}}"
                                         width="400">
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
                                           class="form-control"
                                           ngf-select
                                           ng-model="passport_side_2[key]"
                                           ngf-pattern="'image/*'" ngf-accept="'.jpg'"
                                           ngf-max-size="5MB"
                                           ngf-min-height="100"
                                           ng-show="!Data.common.representatives[key].files.passport_side_2 || !rep_file_ch_passport_side_2[key]">
                                    <img class="thumbnail"
                                         ng-hide="!passport_side_2[key]"
                                         ngf-src="passport_side_2[key]"
                                         width="50%">

                                    <img class="thumbnail"
                                         ng-show="Data.common.representatives[key].files.passport_side_2 && rep_file_ch_passport_side_2[key]"
                                         ng-src="{{REP_File_back[key]}}"
                                         width="400">
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
                                           class="form-control"
                                           ngf-select
                                           ng-model="passport_copy[key]"
                                           ngf-pattern="'image/*'"
                                           ngf-accept="'.jpg'"
                                           ngf-max-size="5MB"
                                           ngf-min-height="100"
                                           ng-show="!Data.common.representatives[key].files.passport_copy || !rep_file_ch_passport_copy[key]">
                                    <img class="thumbnail"
                                         ng-hide="!passport_copy[key]"
                                         ngf-src="passport_copy[key]"
                                         width="50%">

                                    <img class="thumbnail"
                                         ng-show="Data.common.representatives[key].files.passport_copy && rep_file_ch_passport_copy[key]"
                                         ng-src="{{REP_File_copy[key]}}"
                                         width="400">
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
            <div align="center" ng-show="toggle">
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-save"></span> Создать заявку
                </button>
            </div>
        </form>

        <div class="alert alert-success" ng-hide="!resultupload">
            <!--            <strong>Well done! </strong> {{resultupload}}-->
            <p ng-bind-html="ResUpload"></p>
        </div>
        <div class="alert alert-danger" ng-hide="!errorMsg">
            <!--            <strong>Oh snap! </strong> {{errorMsg}}-->
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
<script src="<?php echo base_url("resources/js/DealerSystem/RequisitesRegisterForm_controller.js"); ?>"></script>

<script type="text/javascript">
    /* Инициализация переменных для справочников и дефаулт значений для RequisitesRegisterForm контроллера */
    let requisites_json = <?php echo json_encode(isset($requisites_json) ? $requisites_json : "''");//json с предыдущей регистрацией ?>;
    let ownershipForm_id = <?php echo (isset($requisites_json->common->legalForm->ownershipForm->id)) ?
        $requisites_json->common->legalForm->ownershipForm->id : "''"; ?>;
    let juristicAddress = <?php echo (isset($requisites_json->common->juristicAddress)) ?
        (isset($requisites_json->common->juristicAddress->settlement->region) ?
            $requisites_json->common->juristicAddress->settlement->region->id : "'none'") : "''"; ?>;
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
</script>
