<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main" ng-app="RequisitesForm" ng-controller="RequisitesFormData">
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
                    <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span> Реквизиты юридического лица</h3>
                </div>
                <div class="panel-body">
                    <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-star"></span> Основные сведения</h3></div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td  style="width: 266px">ИНН организации</td>
                                <td><input type="text" 
                                           class="form-control" 
                                           readonly="" 
                                           required="" 
                                           ng-model="Data.common.inn">
                                    <input type="text" hidden="" ng-model="invoice_id" ng-init="invoice_id = '<?php echo $invoice_id; ?>'">
                                    <input type="text" hidden="" ng-model="invoice_serial_number" ng-init="invoice_serial_number = '<?php echo $invoice_data->invoice_serial_number; ?>'">
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
                                <td><input type="text" class="form-control" placeholder="XXXXXX-YYYY-ZZZ" required="" maxlength="15" 
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

                    <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-euro"></span> Банковские реквизиты</h3></div>
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

                    <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-globe"></span> Адресные данные</h3></div>
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
                                <td><div style="display: block">
                                        <select class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" required 
                                                ng-model="currentjuristicregion" 
                                                ng-options="option.name disable when option.id === null for option in JuristicRegions track by option.id" 
                                                ng-change="loadJuristicDistricts()"></select>
                                    </div>
                                    <div style="display: none" ng-style="(currentjuristicregion.id == 'none' || currentjuristicregion.id == '') && { display: 'none' }">
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
                                <td><input type="text" class="form-control"  placeholder="6 цифр" minlength="6" maxlength="6" required="" numbers-only 
                                           ng-model="Data.common.physicalAddress.postCode" ng-disabled="SameAddress">
                                </td>
                            </tr>
                            <tr ng-hide="SameAddress">
                                <td>Населенный пункт</td>
                                <td><div style="display: block"><select class="form-control" required ng-model="currentphysicalregion" ng-disabled="SameAddress" ng-options="option.name disable when option.id === null for option in PhysicalRegions track by option.id" ng-change="loadPhysicalDistricts()" ng-disabled="SameAddress">    
                                        </select></div>
                                    <div style="display: none" ng-style="(currentphysicalregion.id == 'none' || currentphysicalregion.id == '') && { display: 'none' }">
                                        <select class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" required ng-model="currentphysicaldistrict" ng-options="option.name disable when option.id === null for option in PhysicalDistricts track by option.id" ng-change="loadPhysicalSettlements()">
                                        </select></div>
                                    <div style="display: none" ng-style="(currentphysicalregion.id == 'none' || (currentphysicaldistrict.id != null && currentphysicaldistrict.id != '')) && { display: 'block' }"> 
                                        <select class="form-control ng-pristine ng-untouched ng-valid ng-empty" required ng-model="Data.common.physicalAddress.settlement" ng-options="option.name disable when option.id === null for option in PhysicalSettlements track by option.id">
                                        </select></div>
                                </td>
                            </tr>
                            <tr ng-hide="SameAddress">
                                <td>Улица / Микрорайон</td>
                                <td>
                                    <input type="text" class="form-control"  placeholder="Улица / Микрорайон" maxlength="50" required="" ng-model="Data.common.physicalAddress.street" ng-disabled="SameAddress"></td>
                            </tr>
                            <tr ng-hide="SameAddress">
                                <td>Дом / Строение</td>
                                <td><input type="text" class="form-control"  placeholder="Дом / Строение" maxlength="4" required="" ng-model="Data.common.physicalAddress.building" ng-disabled="SameAddress"></td>
                            <tr ng-hide="SameAddress">
                                <td>Квартира</td>
                                <td><input type="text" class="form-control"  placeholder="Квартира" maxlength="4" ng-model="Data.common.physicalAddress.apartment" ng-disabled="SameAddress" ng-init="Data.common.physicalAddress.apartmen = null" required=""></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-edit"></span> Данные об отчетности</h3></div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td style="width: 266px">Тариф СФ</td>
                                <td><select  class="form-control" required 
                                             ng-model="Data.sf.tariff" 
                                             ng-options="option.name disable when option.id === null for option in SFTariffs track by option.id"></select>
                                </td>
                            </tr>
                            <tr>
                                <td>Район СФ</td>
                                <td><select  class="form-control" required ng-model="Data.sf.region" ng-options="option.name disable when option.id === null for option in SFRegions track by option.id">
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Район ГНС</td>
                                <td><select  class="form-control" required ng-model="Data.sti.regionDefault" ng-options="option.name disable when option.id === null for option in STIRegions track by option.id">
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Район предоставления ГНС</td>
                                <td><select  class="form-control" required ng-model="Data.sti.regionReceive" ng-options="option.name disable when option.id === null for option in STIRegions track by option.id">
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
                            <span class="glyphicon glyphicon-picture"></span> Сканированные изображения юридического лица
                        </h3>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr class="danger" ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                                <td colspan="2" align="center">Свидетельство о государственной регистрации Министерсва Юстиции</td>
                            </tr>
                            <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                                <td style="width: 266px">Кыргызская сторона</td>
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
                                           ng-disabled="(Data.common.civilLegalStatus.name === 'Физическое лицо') || (jur_file_ch)"
                                           ng-show="!Data.common.files.kg || !jur_file_ch">
                                    <img class="thumbnail" 
                                         ng-show="mu_file_kg" 
                                         ngf-src="mu_file_kg" 
                                         width="50%">

                                    <img class="thumbnail" 
                                         ng-show="Data.common.files.kg && jur_file_ch"
                                         ng-src="{{Data.common.files.kg.data}}" 
                                         width="400">
                                    <div align="center"
                                         ng-show="!Data.common.files.kg && jur_file_ch">
                                        Документ отсутсвует
                                    </div>
                                </td>
                            </tr>
                            <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                                <td>Русская сторона</td>
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
                                           ng-disabled="(Data.common.civilLegalStatus.name === 'Физическое лицо') || (jur_file_ch)"
                                           ng-show="!Data.common.files || !jur_file_ch">
                                    <img class="thumbnail" 
                                         ng-hide="!mu_file_ru" 
                                         ngf-src="mu_file_ru" 
                                         width="50%" >

                                    <img class="thumbnail" 
                                         ng-show="Data.common.files.ru && jur_file_ch"
                                         ng-src="{{Data.common.files.ru.data}}" 
                                         width="400">
                                    <div align="center"
                                         ng-show="!Data.common.files.ru && jur_file_ch">
                                        Документ отсутсвует
                                    </div>
                                </td>
                            </tr>
                            <tr class="danger">
                                <td colspan="2" align="center">Форма М2А</td>
                            </tr>
                            <tr>
                                <td>Выписка (не обязательно)</td>
                                <td>
                                    <input type="file"  
                                           class="form-control" 
                                           ngf-select 
                                           ng-model="m2a" 
                                           ngf-pattern="'image/*'"
                                           ngf-accept="'.jpg'" 
                                           ngf-max-size="5MB" 
                                           ngf-min-height="100"
                                           ng-show="!Data.common.files || !jur_file_ch">
                                    <img class="thumbnail" 
                                         ng-hide="!m2a" 
                                         ngf-src="m2a" 
                                         width="50%">

                                    <img class="thumbnail" 
                                         ng-show="Data.common.files.m2a && jur_file_ch"
                                         ng-src="{{Data.common.files.m2a.data}}" 
                                         width="400">
                                    <div align="center"
                                         ng-show="!Data.common.files.m2a && jur_file_ch">
                                        Документ отсутсвует
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <label ng-show="Data.common.files">Использовать изображения из архива 
                                        <input class="form-"
                                               type="checkbox" 
                                               ng-model="jur_file_ch" 
                                               ng-init="jur_file_ch = (Data.common.files.kg) ? true : false" />
                                    </label>
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
                            <span class="left glyphicon glyphicon-certificate"></span> №{{key + 1}} Реквизиты сотрудника компании - {{Data.common.representatives[key].position.name}}
                            <button type="button" class="right btn btn-danger" ng-click="RemoveRepresentative(key)"><span class="glyphicon glyphicon-minus"></span> Удалить</button>
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
                                        <input type="text" class="form-control"  placeholder="до 20 символов" maxlength="20" required="" 
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
                                <tr class="success">
                                    <td colspan="2" align="center">Персональные данные</td>
                                </tr>
                                <tr>
                                    <td>Фамилия</td>
                                    <td><input type="text" class="form-control"  placeholder="" maxlength="25" required="" 
                                               ng-model="Data.common.representatives[key].person.surname"></td>
                                </tr>
                                <tr>
                                    <td>Имя</td>
                                    <td><input type="text" class="form-control"  placeholder="" maxlength="20" required="" 
                                               ng-model="Data.common.representatives[key].person.name"></td>
                                </tr>
                                <tr>
                                    <td>Отчество</td>
                                    <td><input type="text" class="form-control"  placeholder="" maxlength="25" 
                                               ng-model="Data.common.representatives[key].person.middleName"></td>
                                </tr>
                                <tr>
                                    <td>Должность</td>
                                    <td>
                                        <select  class="form-control" 
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
                                                ng-options = "option.name disable when option.id === null for option in ChiefBasises track by option.id">
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Рабочий телефон</td>
                                    <td><input type="text" class="form-control"  placeholder="до 20 символов" maxlength="20" required="" numbers-only 
                                               ng-model="Data.common.representatives[key].phone"></td>
                                </tr>
                                <tr ng-hide = "Data.common.representatives[key].roles.length == 1 && Data.common.representatives[key].roles[0].id == 3">
                                    <td>Носитель ЭП</td>
                                    <td>
                                        <p data-ng-repeat="edsUsageModel in edsUsageModels">
                                            <input type="radio" 
                                                   ng-model="Data.common.representatives[key].edsUsageModel" 
                                                   ng-value="edsUsageModel"                                                   
                                                   ng-disabled = "Data.common.representatives[key].roles.length == 1 && Data.common.representatives[key].roles[0].id == 3"
                                                   ng-checked="{{edsUsageModel.id == Data.common.representatives[key].edsUsageModel.id}}">
                                            {{edsUsageModel.name}}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Серийный номер РуТокен (<a href=""ng-click="getSerialNumber(key, 0)">Прочитать<a>)
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
                                                           ng-disabled = "Data.common.representatives[key].edsUsageModel.id == 2 || (Data.common.representatives[key].roles.length == 1 && Data.common.representatives[key].roles[0].id == 3)">

                                                </td>
                                                </tr>
                                                </tbody>
                                                </table>

                                                <div class="page-header">
                                                    <h3 align="center"><span class="glyphicon glyphicon-picture"></span> Сканированные изображения паспорта</h3>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr class="success">
                                                            <td colspan="2" align="center">Паспорт физического лица</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 266px">Cторона 1</td>
                                                            <td>
                                                                <input type="file"  
                                                                       class="form-control" 
                                                                       required="" 
                                                                       ngf-select 
                                                                       ng-model="passport_side_1[key]" 
                                                                       ngf-pattern="'image/*'" ngf-accept="'.jpg'" 
                                                                       ngf-max-size="5MB" 
                                                                       ngf-min-height="100"
                                                                       ng-disabled="rep_file_ch[key]"
                                                                       ng-show="!Data.common.representatives[key].files || !rep_file_ch[key]">
                                                                <img class="thumbnail" 
                                                                     ng-hide="!passport_side_1[key]" 
                                                                     ngf-src="passport_side_1[key]" 
                                                                     width="50%" >

                                                                <img class="thumbnail"
                                                                     ng-show="Data.common.representatives[key].files.front && rep_file_ch[key]"
                                                                     ng-src="{{Data.common.representatives[key].files.front.data}}" 
                                                                     width="400">
                                                                <div align="center"
                                                                     ng-show="!Data.common.representatives[key].files.front && rep_file_ch[key]">
                                                                    Документ отсутсвует
                                                                </div>
                                                            </td>  
                                                        </tr>
                                                        <tr>
                                                            <td>Cторона 2</td>
                                                            <td>
                                                                <input type="file" 
                                                                       class="form-control"  
                                                                       ngf-select 
                                                                       ng-model="passport_side_2[key]" 
                                                                       ngf-pattern="'image/*'" ngf-accept="'.jpg'" 
                                                                       ngf-max-size="5MB" ngf-min-height="100"
                                                                       ng-show="!Data.common.representatives[key].files || !rep_file_ch[key]">
                                                                <img class="thumbnail" 
                                                                     ng-hide="!passport_side_2[key]" 
                                                                     ngf-src="passport_side_2[key]" 
                                                                     width="50%">

                                                                <img class="thumbnail" 
                                                                     ng-show="Data.common.representatives[key].files.back && rep_file_ch[key]"
                                                                     ng-src="{{Data.common.representatives[key].files.back.data}}" 
                                                                     width="400">
                                                                <div align="center"
                                                                     ng-show="!Data.common.representatives[key].files.back && rep_file_ch[key]">
                                                                    Документ отсутсвует
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="success">
                                                            <td colspan="2" align="center">Нотариально заверенная копия паспорта переведенной на официальный язык КР</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Нотариально заверенная копия</td>
                                                            <td>
                                                                <input type="file" 
                                                                       class="form-control" 
                                                                       ngf-select 
                                                                       ng-model="passport_copy[key]" 
                                                                       ngf-pattern="'image/*'" 
                                                                       ngf-accept="'.jpg'" 
                                                                       ngf-max-size="5MB" 
                                                                       ngf-min-height="100"
                                                                       ng-show="!Data.common.representatives[key].files || !rep_file_ch[key]">
                                                                <img class="thumbnail" 
                                                                     ng-hide="!passport_copy[key]" 
                                                                     ngf-src="passport_copy[key]" 
                                                                     width="50%">

                                                                <img class="thumbnail" 
                                                                     ng-show="Data.common.representatives[key].files.copy && rep_file_ch[key]"
                                                                     ng-src="{{Data.common.representatives[key].files.copy.data}}" 
                                                                     width="400">
                                                                <div align="center"
                                                                     ng-show="!Data.common.representatives[key].files.copy && rep_file_ch[key]">
                                                                    Документ отсутсвует
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" align="center">
                                                                <label ng-show="Data.common.files">Использовать изображения из архива 
                                                                    <input class="form-"
                                                                           type="checkbox" 
                                                                           ng-model="rep_file_ch[key]" 
                                                                           ng-init="rep_file_ch[key] = (Data.common.representatives[key].files.front) ? true : false" />
                                                                </label>
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
                                                    <p ng-bind-html ="ResUpload"></p>
                                                </div>
                                                <div class="alert alert-danger" ng-hide="!errorMsg">
                                        <!--            <strong>Oh snap! </strong> {{errorMsg}}-->
                                                    <p ng-bind-html ="ErrorMessage"></p>
                                                </div>
                                                <div ng-hide="!progressjur || progressjur === 100" >
                                                    <div>Загрузка изображения юридического лица</div>
                                                    <div class="progress progress-striped active">                                            
                                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{progressjur}}%">                                                    
                                                            <span class="sr-only">{{progressjur}}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div ng-hide="!progressphy || progressphy === 100">
                                                    <div>Загрузка изображения физических лиц</div>
                                                    <div class="progress progress-striped active"> 
                                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{progressphy}}%">                                                        
                                                            <span class="sr-only">{{progressphy}}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            </div>
                                            <script src="<?php echo base_url("resources/js/ng-file-upload.min.js"); ?>"></script>
                                            <script src="<?php echo base_url("resources/js/check-list-model.js"); ?>"></script>
                                            <script src="<?php echo base_url("resources/js/rutoken/dependencies.js"); ?>"></script>
                                            <script src="<?php echo base_url("resources/js/rutoken//PluginManager.js"); ?>"></script>
                                            <script type="text/javascript">
                                                            var RequisitesForm = angular.module('RequisitesForm', ['ngFileUpload', 'checklist-model']);
                                                            RequisitesForm
                                                                    .factory('mObjNode', [function () {
                                                                            return function (node, scope) {
                                                                                var Nodes = node.split('.');
                                                                                var Current = scope;
                                                                                for (var i = 0; i < Nodes.length; i++) {
                                                                                    if (!Current[Nodes[i]]) {
                                                                                        Current[Nodes[i]] = {};
                                                                                    }
                                                                                    Current = Current[Nodes[i]];
                                                                                }
                                                                            };
                                                                        }])
                                                                    .controller('RequisitesFormData', ['$scope', '$http', 'mObjNode', 'Upload', '$timeout', '$sce', '$window', function ($scope, $http, mObjNode, Upload, $timeout, $sce, $window) {
                                                                            window.scope = $scope;
                                                                            /*Load default reference*/
                                                                            $scope.requisites_json = <?php echo json_encode(isset($requisites_json) ? $requisites_json : "''"); ?>;
                                                                            $scope.count = isNaN($scope.requisites_json.common.representatives.length) ? 0 : $scope.requisites_json.common.representatives.length;
                                                                            $scope.passport_side_1 = [];
                                                                            $scope.passport_side_2 = [];
                                                                            $scope.passport_copy = [];
                                                                            $scope.Data = $scope.requisites_json;
                                                                            $scope.pluginManager = new PluginManager();

                                                                            $scope.toggle = true;
                                                                            $http.post('<?php echo base_url("index.php/requisites/reference_load"); ?>', {reference: 'getCommonCapitalForms', id: ''}).
                                                                                    then(function (response) {
                                                                                        $scope.CapitalForms = [{id: '', name: 'Выберите значение'}].concat(response.data);
                                                                                        mObjNode('Data.common.capitalForm', $scope);
                                                                                        var defaultId = angular.equals($scope.Data.common.capitalForm, {}) ? '' : $scope.Data.common.capitalForm.id;
<?php //echo (isset($requisites_json->common->capitalForm->id)) ? $requisites_json->common->capitalForm->id : "''";                                             ?>;
                                                                                        //console.log($scope.CapitalForms.findIndex(x => x.id === defaultId));
                                                                                        $scope.Data.common.capitalForm = $scope.CapitalForms[$scope.CapitalForms.findIndex(x => x.id === defaultId)];
                                                                                    });
                                                                            $http.post('<?php echo base_url("index.php/requisites/reference_load"); ?>', {reference: 'getCommonManagementForms', id: ''}).
                                                                                    then(function (response) {
                                                                                        $scope.ManagementForms = [{id: '', name: 'Выберите значение'}].concat(response.data);
                                                                                        mObjNode('Data.common.managementForm', $scope);
                                                                                        var defaultId = angular.equals($scope.Data.common.managementForm, {}) ? '' : $scope.Data.common.managementForm.id;
<?php //echo (isset($requisites_json->common->managementForm->id)) ? $requisites_json->common->managementForm->id : "''";                                             ?>;
                                                                                        $scope.Data.common.managementForm = $scope.ManagementForms[$scope.ManagementForms.findIndex(x => x.id === defaultId)];
                                                                                    });
                                                                            $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonOwnershipForms', id: ''}).//загрузка спр. ФОРМА СОБСТВЕННОСТИ
                                                                                    then(function (response) {
                                                                                        $scope.OwnershipForms = [{id: '', name: 'Выберите значение'}].concat(response.data);
                                                                                        //console.log($scope.OwnershipForms);
                                                                                        mObjNode('Data.common.legalForm.ownershipForm', $scope);
                                                                                        $scope.CivilLegalStatuses = [{id: '', name: 'Cначала выберите организационно-правововую форму'}];
                                                                                        $scope.Data.common.civilLegalStatus = $scope.CivilLegalStatuses[0];
                                                                                        $scope.LegalForms = [{id: '', name: 'Cначала выберите форму собственности'}];
                                                                                        $scope.Data.common.legalForm = $scope.LegalForms[0];
                                                                                        //console.log(angular.isUndefined($scope.Data.common.legalForm.ownershipForm));
                                                                                        var defaultId = <?php echo (isset($requisites_json->common->legalForm->ownershipForm->id)) ? $requisites_json->common->legalForm->ownershipForm->id : "''"; ?>;
                                                                                        $scope.Data.common.legalForm.ownershipForm = $scope.OwnershipForms[$scope.OwnershipForms.findIndex(x => x.id === defaultId)]; //знач. по умолчанию
                                                                                        if (defaultId !== '') {//прогружаем соотвественную Организационно-правоваю форму
                                                                                            $scope.loadLegalForm();
                                                                                        }
                                                                                    });
                                                                            $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonRegions', id: ''}).
                                                                                    then(function (response) {
                                                                                        $scope.JuristicRegions = [
                                                                                            {id: '', name: 'Выберите область'},
                                                                                            {id: 'none', name: 'Республиканского подчинения'}].concat(response.data);
                                                                                        var defualtId = <?php echo (isset($requisites_json->common->juristicAddress)) ? (isset($requisites_json->common->juristicAddress->settlement->region) ? $requisites_json->common->juristicAddress->settlement->region->id : "'none'") : "''"; ?>;
                                                                                        //console.log(defualtId);
                                                                                        $scope.currentjuristicregion = $scope.JuristicRegions[$scope.JuristicRegions.findIndex(x => x.id == defualtId)];
                                                                                        $scope.PhysicalRegions = $scope.JuristicRegions;
                                                                                        $scope.currentPhysicalregion = $scope.PhysicalRegions[0];
                                                                                        if (defualtId !== '') {
                                                                                            $scope.loadJuristicDistricts();
                                                                                        }
                                                                                        ;
                                                                                    });
                                                                            $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonChiefBasises', id: ''}).
                                                                                    then(function (response) {
                                                                                        $scope.ChiefBasises = [{id: '', name: 'Выберите значение'}].concat(response.data);
                                                                                        mObjNode('Data.sf', $scope);
                                                                                        var defaultId = <?php echo (isset($requisites_json->common->chiefBasis->id)) ? $requisites_json->common->chiefBasis->id : "''"; ?>;
                                                                                        $scope.Data.common.chiefBasis = $scope.ChiefBasises[$scope.ChiefBasises.findIndex(x => x.id === defaultId)];
                                                                                    });
                                                                            $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getSfTariffs', id: ''}).
                                                                                    then(function (response) {
                                                                                        $scope.SFTariffs = [{id: '', name: 'Выберите значение'}].concat(response.data);
                                                                                        mObjNode('Data.sf', $scope);
                                                                                        var defaultId = <?php echo (isset($requisites_json->sf->tariff->id)) ? $requisites_json->sf->tariff->id : "''"; ?>;
                                                                                        $scope.Data.sf.tariff = $scope.SFTariffs[$scope.SFTariffs.findIndex(x => x.id === defaultId)];
                                                                                    });
                                                                            $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getSfRegions', id: ''}).
                                                                                    then(function (response) {
                                                                                        $scope.SFRegions = [{id: '', name: 'Выберите значение'}].concat(response.data);
                                                                                        mObjNode('Data.sf', $scope);
                                                                                        var defaultId = <?php echo (isset($requisites_json->sf->region->id)) ? $requisites_json->sf->region->id : "''"; ?>;
                                                                                        //console.log(defaultId);
                                                                                        $scope.Data.sf.region = $scope.SFRegions[$scope.SFRegions.findIndex(x => x.id == defaultId)]; //без условное сравнение
                                                                                    });
                                                                            $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getSTIRegions', id: ''}).
                                                                                    then(function (response) {
                                                                                        $scope.STIRegions = [{id: '', name: 'Выберите значение'}].concat(response.data);
                                                                                        mObjNode('Data.sti', $scope);
                                                                                        var defaultIddef = <?php echo (isset($requisites_json->sti->regionDefault->id)) ? $requisites_json->sti->regionDefault->id : "''"; ?>;
                                                                                        var defaultIdrec = <?php echo (isset($requisites_json->sti->regionReceive->id)) ? $requisites_json->sti->regionReceive->id : "''"; ?>;
                                                                                        $scope.Data.sti.regionDefault = $scope.STIRegions[$scope.STIRegions.findIndex(x => x.id == defaultIddef)]; //без условное сравнение
                                                                                        $scope.Data.sti.regionReceive = $scope.STIRegions[$scope.STIRegions.findIndex(x => x.id == defaultIdrec)]; //без условное сравнение
                                                                                    });
                                                                            $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonRepresentativePositions', id: ''}).
                                                                                    then(function (response) {
                                                                                        $scope.Positions = [{id: '', name: 'Выберите значение'}].concat(response.data);
                                                                                        //$scope.chief_position = $scope.Positions[0]; //справочник должности руководителя
                                                                                        //for (var i = 0; i < $scope.count; i++) {
                                                                                        //$scope.Data.common.representatives[i].position = $scope.Positions[0];
                                                                                        //}
                                                                                    });
                                                                            $scope.Roles = [
                                                                                {id: 1, name: 'Руководитель'},
                                                                                {id: 2, name: 'Бухгалтер'},
                                                                                {id: 3, name: "Лицо ответственное за получение ЭЦП"},
                                                                                {id: 4, name: "Лицо ответственное за использование ЭЦП"},
                                                                                {id: 6, name: "Сотрудник корневой консалтинговой структуры"}
                                                                            ];
                                                                            $scope.edsUsageModels = [
                                                                                {id: 2, name: "Использование ЭЦП из облачного хранилища"},
                                                                                {id: 1, name: "Использование ЭЦП на РУТОКЕН"}
                                                                            ];
                                                                            //$scope.role_1 = true; $scope.role_2 = true; $scope.role_3 = true;
                                                                            /*End load default reference*/

                                                                            $scope.loadLegalForm = function () { //загрузка спр. Организационно-правовая форма
                                                                                var tmp = $scope.Data.common.legalForm.ownershipForm;
                                                                                //console.log(tmp);
                                                                                $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonLegalForms', id: $scope.Data.common.legalForm.ownershipForm.id}).
                                                                                        then(function (response) {
                                                                                            $scope.LegalForms = [{id: '', name: 'Выберите значение'}].concat(response.data);
                                                                                            mObjNode('Data.common.legalForm', $scope);
                                                                                            var defaultId = <?php echo (isset($requisites_json->common->legalForm->id)) ? $requisites_json->common->legalForm->id : "''"; ?>;
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
                                                                                    //console.log({id: id});
                                                                                }
                                                                                for (var i = 0; i < $scope.OwnershipForms.length; i++) {
                                                                                    //console.log($scope.OwnershipForms[i],id);
                                                                                    if ($scope.OwnershipForms[i].id === id)
                                                                                        return $scope.OwnershipForms[i];
                                                                                }
                                                                                return {id: id};
                                                                            };

                                                                            $scope.loadCivilLegalStatuses = function () {
                                                                                var tmp = $scope.Data.common.legalForm.ownershipForm;
                                                                                if ($scope.Data.common.legalForm.id === '') { //loadLegalForm меняет  $scope.Data.common.legalForm и срабатывает ng-change="loadCivilLegalStatuses()" (((
                                                                                    return;
                                                                                }
                                                                                //console.log($scope.OwnershipForms);
                                                                                $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonCivilLegalStatuses', id: $scope.Data.common.legalForm.id}).
                                                                                        then(function (response) {
                                                                                            $scope.CivilLegalStatuses = [{id: '', name: 'Выберите значение'}].concat(response.data);
                                                                                            mObjNode('Data.common.civilLegalStatus', $scope);
                                                                                            var defaultId = <?php echo (isset($requisites_json->common->civilLegalStatus->id)) ? $requisites_json->common->civilLegalStatus->id : 0; ?>;
                                                                                            $scope.Data.common.civilLegalStatus = $scope.CivilLegalStatuses[defaultId];
                                                                                            $scope.Data.common.legalForm.ownershipForm = $scope.getOwnershimFormById(tmp);
                                                                                        });
                                                                            };
                                                                            $scope.CheckGked = function () {
                                                                                if ($scope.Data.common.mainActivity.gked.length >= 7) {
                                                                                    $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonActivityByGked', id: $scope.Data.common.mainActivity.gked}).
                                                                                            then(function (response) {
                                                                                                $scope.Data.common.mainActivity.name = response.data.name;
                                                                                                $scope.Data.common.mainActivity.id = response.data.id;
                                                                                                $scope.Data.common.mainActivity.activity = response.data.activity;
                                                                                                $scope.Data.common.mainActivity.isFinal = response.data.isFinal;
                                                                                            }, function (response) {
                                                                                                $scope.Data.common.mainActivity.name = response.data;
                                                                                            });
                                                                                }
                                                                            };
                                                                            $scope.loadBankName = function () {
                                                                                if ($scope.Data.common.bank.id.length > 5) {
                                                                                    $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonBankById', id: $scope.Data.common.bank.id}).
                                                                                            then(function (response) {
                                                                                                mObjNode('Data.common.bank', $scope);
                                                                                                $scope.Data.common.bank.name = response.data.name;
                                                                                            }, function (response) {
                                                                                                $scope.Data.common.bank.name = response.data;
                                                                                            });
                                                                                }
                                                                            };
                                                                            $scope.loadPhysicalDistricts = function () {
                                                                                if ($scope.currentphysicalregion.id === 'none') {
                                                                                    $scope.currentphysicaldistrict = null;
                                                                                    $scope.loadPhysicalSettlements($scope.currentphysicalregion.id, $scope.currentphysicaldistrict);
                                                                                    return;
                                                                                }
                                                                                $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonDistricts', id: $scope.currentphysicalregion.id}).
                                                                                        then(function (response) {
                                                                                            $scope.PhysicalDistricts = [
                                                                                                {id: '', name: 'Выберите район'},
                                                                                                {id: 'none', name: 'Областного подчинения'}].concat(response.data);
                                                                                            $scope.currentphysicaldistrict = $scope.PhysicalDistricts[0];
                                                                                        });
                                                                            };
                                                                            $scope.loadPhysicalSettlements = function (region, district) {
                                                                                region = $scope.currentphysicalregion.id;
                                                                                district = $scope.currentphysicaldistrict;
                                                                                //console.log(district);
                                                                                var districtid = $scope.currentphysicaldistrict ? (district.id || null) : null;
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
                                                                                //console.log(region + ' ' + districtid);
                                                                                $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonSettlements', id_region: region, id_district: districtid}).
                                                                                        then(function (response) {
                                                                                            $scope.PhysicalSettlements = [{id: '', name: 'Выберите населенный пункт'}].concat(response.data);
                                                                                            //console.log(response.data);
                                                                                            mObjNode('Data.common.physicalAddress.settlement', $scope);
                                                                                            $scope.Data.common.physicalAddress.settlement = $scope.PhysicalSettlements[0];
                                                                                        });
                                                                            }; ///////

                                                                            $scope.loadJuristicDistricts = function () {
                                                                                if ($scope.currentjuristicregion.id === 'none') {
                                                                                    $scope.currentjuristicdistrict = null;
                                                                                    $scope.loadJuristicSettlements($scope.currentjuristicregion.id, $scope.currentjuristicdistrict);
                                                                                    return;
                                                                                }
                                                                                $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonDistricts', id: $scope.currentjuristicregion.id}).
                                                                                        then(function (response) {
                                                                                            $scope.JuristicDistricts = [
                                                                                                {id: '', name: 'Выберите район'},
                                                                                                {id: 'none', name: 'Областного подчинения'}].concat(response.data);
                                                                                            //if ($scope.currentjuristicregion.id !== '') {
                                                                                            //var defaultId = <?php //echo (isset($requisites_json->common->juristicAddress->settlement->district)) ? $requisites_json->common->juristicAddress->settlement->district : "''";                                                             ?>;
                                                                                            //$scope.currentjuristicdistrict = $scope.JuristicDistricts[$scope.JuristicDistricts.findIndex(x => x.id === defaultId)];
                                                                                            //  $scope.loadJuristicSettlements($scope.currentjuristicregion.id, $scope.currentjuristicdistrict.id);
                                                                                            //} else
                                                                                            //{
                                                                                            $scope.currentjuristicdistrict = $scope.JuristicDistricts[0];
                                                                                            //}
                                                                                            //console.log($scope.currentjuristicdistrict);
                                                                                        });
                                                                            };
                                                                            $scope.loadJuristicSettlements = function (region, district) {
                                                                                //console.log($scope.currentjuristicdistrict);
                                                                                if ($scope.currentjuristicdistrict === '') {
                                                                                    return;
                                                                                }
                                                                                region = $scope.currentjuristicregion.id;
                                                                                district = $scope.currentjuristicdistrict;
                                                                                //console.log(district);
                                                                                var districtid = $scope.currentjuristicdistrict ? (district.id || null) : null;
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
                                                                                //console.log(region + ' ' + districtid);
                                                                                $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonSettlements', id_region: region, id_district: districtid}).
                                                                                        then(function (response) {
                                                                                            $scope.JuristicSettlements = [{id: '', name: 'Выберите населенный пункт'}].concat(response.data);
                                                                                            //console.log(response.data);
                                                                                            mObjNode('Data.common.juristicAddress.settlement', $scope);
                                                                                            var defaultId = <?php echo (isset($requisites_json->common->juristicAddress->settlement->id)) ? $requisites_json->common->juristicAddress->settlement->id : "''"; ?>;
                                                                                            //console.log(defaultId);
                                                                                            //console.log($scope.JuristicSettlements.findIndex(x => x.id == defaultId));//без условное сравнение
                                                                                            $scope.Data.common.juristicAddress.settlement = $scope.JuristicSettlements[$scope.JuristicSettlements.findIndex(x => x.id == defaultId)];
                                                                                        });
                                                                            };
                                                                            $scope.addNewRepresentative = function () {
                                                                                $scope.count++;
                                                                                $scope.Data.common.representatives.push({position: $scope.Positions[0]});
                                                                            };
                                                                            $scope.RemoveRepresentative = function (key) {
                                                                                $scope.Data.common.representatives.splice(key, 1);
                                                                                $scope.count--;
                                                                            };

                                                                            $scope.Checked_role = function (role = false) {
                                                                                if (role === false) {
                                                                                    //default params for roles
                                                                                    $scope.role_1 = true;
                                                                                    $scope.role_2 = true;
                                                                                    $scope.role_3 = true;
                                                                                    $scope.role_6 = true;
                                                                                    for (var i = 0; i < $scope.Data.common.representatives.length; i++) {
                                                                                        for (var ii = 0; ii < $scope.Data.common.representatives[i].roles.length; ii++) {
                                                                                            ($scope.Data.common.representatives[i].roles[ii].id == 1) ? $scope.role_1 = false : null;
                                                                                            ($scope.Data.common.representatives[i].roles[ii].id == 2) ? $scope.role_2 = false : null;
                                                                                            ($scope.Data.common.representatives[i].roles[ii].id == 3) ? $scope.role_3 = false : null;
                                                                                            ($scope.Data.common.representatives[i].roles[ii].id == 6) ? $scope.role_6 = false : null;
                                                                                        }
                                                                                    }
                                                                                    //console.log('Default: ruk = '+ $scope.role_1+' buk = '+ $scope.role_2 + ' rep = '+$scope.role_3); 
                                                                                } else {
                                                                                    //user changes
                                                                                    if (role.id == 1) {
                                                                                        $scope.role_1 = ($scope.role_1 === false) ? true : false;
                                                                                        //console.log('ruk = ' + $scope.role_1);
                                                                                    }
                                                                                    if (role.id == 2) {
                                                                                        $scope.role_2 = ($scope.role_2 === false) ? true : false;
                                                                                        //console.log('buh = ' + $scope.role_2);
                                                                                    }
                                                                                    if (role.id == 3) {
                                                                                        $scope.role_3 = ($scope.role_3 === false) ? true : false;
                                                                                        //console.log('rep = ' + $scope.role_3);
                                                                                    }
                                                                                    if (role.id == 6) {
                                                                                        $scope.role_6 = ($scope.role_6 === false) ? true : false;
                                                                                        console.log('rep = ' + $scope.role_6);
                                                                                    }
                                                                                    //console.log(role.id + ' User: ruk = '+ $scope.role_1+' buk = '+ $scope.role_2 + ' rep = '+$scope.role_3); 
                                                                            }
                                                                            };
                                                                            $scope.Checked_role();

                                                                            $scope.Get_person = function (Series, Number, Key) {
                                                                                if ((Series && Series.length > 1) && (Number && Number.length > 5)) {
                                                                                    $http.post('<?php echo base_url(); ?>index.php/requisites/get_person_by_passport_reference', {series: Series, number: Number}).
                                                                                            then(function (response) {
                                                                                                $scope.Data.common.representatives[Key].person.passport.issuingAuthority = response.data.passport.issuingAuthority;
                                                                                                $scope.Data.common.representatives[Key].person.passport.issuingDate = response.data.passport.issuingDate;
                                                                                                $scope.Data.common.representatives[Key].person.surname = response.data.surname;
                                                                                                $scope.Data.common.representatives[Key].person.name = response.data.name;
                                                                                                $scope.Data.common.representatives[Key].person.middleName = response.data.middleName;
                                                                                            }, function (response) {

                                                                                            });
                                                                                }
                                                                            };

                                                                            $scope.getSerialNumber = function (key, tokenIndex) {
                                                                                //$scope.Data.common.representatives[key].deviceSerial = $scope.pluginManager.getDeviceInfo(tokenIndex, $scope.pluginManager.TOKEN_INFO_SERIAL);
                                                                                //$scope.Data.common.representatives[key].deviceSerial = 
                                                                                var result = $scope.pluginManager.getDeviceSerial(tokenIndex);
                                                                                console.log(result);
                                                                            }

                                                                            $scope.Upload = function () {
                                                                                $scope.errorMsg = null;
                                                                                $scope.resultupload = null;
                                                                                $scope.toggle = false;

                                                                                /* checks before upload */
                                                                                if ((!$scope.Data.common.rnmj || !/^\d+\-\d+\-.+$/.test($scope.Data.common.rnmj)) && ($scope.Data.common.civilLegalStatus.name !== 'Физическое лицо')) {
                                                                                    alert('Рег. номер Министерства Юстиции не соответствует маске XXXXXX-YYYY-ZZZ');
                                                                                    $scope.toggle = true;
                                                                                    return;
                                                                                }
                                                                                if (!$scope.Data.common.mainActivity.gked || !/^\d{2,2}\.\d{2,2}\.\d+$/.test($scope.Data.common.mainActivity.gked)) {
                                                                                    alert('Номер ГКЕД не соответствует маске XX.YY.ZZ');
                                                                                    $scope.toggle = true;
                                                                                    return;
                                                                                }
                                                                                if ($scope.Data.common.civilLegalStatus.name === 'Физическое лицо') {
                                                                                    $scope.Data.common.capitalForm = null;
                                                                                    $scope.Data.common.managementForm = null;
                                                                                    $scope.Data.common.rnmj = null;
                                                                                }
                                                                                for (var i = 0; i < $scope.Data.common.representatives.length; i++) {
                                                                                    if ($scope.Data.common.representatives[i].roles.length == 1 && $scope.Data.common.representatives[i].roles[0].id == 3) { //если указано лицо только на получение
                                                                                        $scope.Data.common.representatives[i].deviceSerial = null;
                                                                                        $scope.Data.common.representatives[i].edsUsageModel = null;
                                                                                    }
                                                                                    ;
                                                                                    if ($scope.Data.common.representatives[i].edsUsageModel != null) {
                                                                                        if ($scope.Data.common.representatives[i].edsUsageModel.id == 2) {
                                                                                            $scope.Data.common.representatives[i].deviceSerial = null;
                                                                                        }
                                                                                    }
                                                                                    ;
                                                                                }
                                                                                /* end checks */

                                                                                var id_requisites = null;
                                                                                var check_jur = false; //for redirect
                                                                                var count_of_count = 0; //for redirect
                                                                                if ($scope.SameAddress) {
                                                                                    $scope.Data.common.physicalAddress = $scope.Data.common.juristicAddress;
                                                                                }

                                                                                $http.post('<?php echo base_url(); ?>index.php/requisites/requisites_create', {
                                                                                    invoice_id: $scope.invoice_id,
                                                                                    invoice_serial_number: $scope.invoice_serial_number,
                                                                                    json: $scope.Data
                                                                                            //json_original: $scope.json_original
                                                                                }).
                                                                                        then(function (responce) {
                                                                                            //console.log(responce);
                                                                                            $scope.resultupload = responce.data.data;
                                                                                            $scope.ResUpload = $sce.trustAsHtml($scope.resultupload);
                                                                                            id_requisites = responce.data.id_requisites;
                                                                                            //console.log(responce);

                                                                                            if ($scope.mu_file_kg) {
                                                                                                Upload.upload({
                                                                                                    url: '<?php echo base_url(); ?>index.php/requisites/requisites_file_upload/' + id_requisites + '/'
                                                                                                            + $scope.Data.common.inn + '/' + '1',
                                                                                                    data: {
                                                                                                        mu_file_kg: $scope.mu_file_kg,
                                                                                                        mu_file_ru: $scope.mu_file_ru,
                                                                                                        m2a: $scope.m2a
                                                                                                    }
                                                                                                }).then(function (responsejur) {
                                                                                                    $scope.resultupload = $scope.resultupload + responsejur.data;
                                                                                                    $scope.ResUpload = $sce.trustAsHtml($scope.resultupload);
                                                                                                    check_jur = true;
                                                                                                    //console.log($sce.trustAsHtml($scope.resultupload));
                                                                                                }, function (responsejur) {
                                                                                                    if (responsejur.status > 0) {
                                                                                                        $scope.errorMsg = $sce.trustAsHtml('Ошибка при сохранении изображений юридического лица, код ошибки: ' + responsejur.status + '. <br> Сообщение: ' + responsejur.data);
                                                                                                        $scope.ErrorMessage = $scope.errorMsg;
                                                                                                        $scope.toggle = true;
                                                                                                    }
                                                                                                }, function (evt) {
                                                                                                    $scope.progressjur = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
                                                                                                    //console.log($scope.progressjur);
                                                                                                });
                                                                                            } else {//если выбрали и зображение из архива   
                                                                                                var keys = Object.keys(scope.Data.common.files);
                                                                                                console.log(keys);
                                                                                                for (var i = 0; i < keys.length; i++) {
                                                                                                    console.log('Go JUR - ' + $scope.Data.common.files[keys[i]].file_ident);
                                                                                                    $http.post('<?php echo base_url(); ?>index.php/requisites/requisites_file_upload_skip', {
                                                                                                        id_requisites: id_requisites,
                                                                                                        filetype_id: $scope.Data.common.files[keys[i]].filetype_id,
                                                                                                        file_ident: $scope.Data.common.files[keys[i]].file_ident,
                                                                                                        rep_ident: null
                                                                                                    }).
                                                                                                            then(function (responsejur) {
                                                                                                                $scope.resultupload = responsejur.data.data;
                                                                                                                $scope.ResUpload += $sce.trustAsHtml($scope.resultupload);

                                                                                                            }, function (responsejur) {
                                                                                                                if (responsejur.status > 0) {
                                                                                                                    $scope.errorMsg = $sce.trustAsHtml('Ошибка при сохранении ID изображений юридического лица, код ошибки: ' + responsejur.status + '. <br> Сообщение: ' + responsejur.data);
                                                                                                                    $scope.ErrorMessage = $scope.errorMsg;
                                                                                                                    $scope.toggle = true;
                                                                                                                }
                                                                                                            });
                                                                                                }
                                                                                                check_jur = true;
                                                                                            }

                                                                                            for (var i = 0; i < $scope.count; i++) {
                                                                                                if ($scope.passport_side_1[i]) {
                                                                                                    Upload.upload({
                                                                                                        url: '<?php echo base_url(); ?>index.php/requisites/requisites_file_upload/' + id_requisites + '/'
                                                                                                                + $scope.Data.common.representatives[i].person.passport.number
                                                                                                                + '/' + 2,
                                                                                                        data: {
                                                                                                            passport_side_1: $scope.passport_side_1[i],
                                                                                                            passport_side_2: $scope.passport_side_2[i],
                                                                                                            passport_copy: $scope.passport_copy[i]
                                                                                                        }
                                                                                                    }).then(function (responsephy) {
                                                                                                        $scope.resultupload = $scope.resultupload + responsephy.data.data;
                                                                                                        $scope.ResUpload += $sce.trustAsHtml($scope.resultupload);
                                                                                                        count_of_count++;
                                                                                                    }, function (responsephy) {
                                                                                                        if (responsephy.status > 0)
                                                                                                        {
                                                                                                            $scope.errorMsg = $sce.trustAsHtml('Ошибка при сохранении изображений ответственных лиц, код ошибки: ' + responsephy.status + '. <br> Сообщение: ' + responsephy.data);
                                                                                                            $scope.ErrorMessage = $scope.errorMsg;
                                                                                                            $scope.toggle = true;
                                                                                                        }
                                                                                                    }, function (evt) {
                                                                                                        $scope.progressphy = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
                                                                                                    });
                                                                                                } else {
                                                                                                    var keys = Object.keys(scope.Data.common.representatives[i].files);
                                                                                                    console.log(keys);
                                                                                                    for (var ii = 0; ii < keys.length; ii++) {
                                                                                                        console.log('Go JUR - ' + $scope.Data.common.representatives[i].files[keys[ii]].file_ident);
                                                                                                        $http.post('<?php echo base_url(); ?>index.php/requisites/requisites_file_upload_skip', {
                                                                                                            id_requisites: id_requisites,
                                                                                                            filetype_id: $scope.Data.common.representatives[i].files[keys[ii]].filetype_id,
                                                                                                            file_ident: $scope.Data.common.representatives[i].files[keys[ii]].file_ident,
                                                                                                            rep_ident: $scope.Data.common.representatives[i].person.passport.number
                                                                                                        }).
                                                                                                                then(function (responsephy) {
                                                                                                                    $scope.resultupload += responsephy.data;
                                                                                                                    $scope.ResUpload += $sce.trustAsHtml($scope.resultupload);
                                                                                                                }, function (responsephy) {
                                                                                                                    if (responsephy.status > 0) {
                                                                                                                        $scope.errorMsg = $sce.trustAsHtml('Ошибка при сохранении ID изображений ответственных лиц, код ошибки: ' + responsephy.status + '. <br> Сообщение: ' + responsephy.data);
                                                                                                                        $scope.ErrorMessage = $scope.errorMsg;
                                                                                                                        $scope.toggle = true;
                                                                                                                    }
                                                                                                                });
                                                                                                    }
                                                                                                    count_of_count++;
                                                                                                }
                                                                                            }
                                                                                        }, function (response) {
                                                                                            $scope.errorMsg = $sce.trustAsHtml('Ошибка при сохранении реквизитов, код ошибки: ' + response.status + '. <br> Сообщение: ' + response.data);
                                                                                            $scope.ErrorMessage = $scope.errorMsg;
                                                                                            $scope.toggle = true;
                                                                                        });

                                                                                setInterval(function () {
                                                                                    if (check_jur === true && $scope.count === count_of_count) {
                                                                                        $window.location.href = '<?php echo base_url() ?>index.php/requisites/requisites_show_view/' + id_requisites; //redirect
                                                                                    }
                                                                                }, 5000);
                                                                            };

                                                                            $scope.range = function (min, max, step) {
                                                                                step = step || 1;
                                                                                var input = [];
                                                                                for (var i = min; i < max; i += step) {
                                                                                    input.push(i);
                                                                                }
                                                                                return input;
                                                                            };
                                                                        }]);

                                                            RequisitesForm.directive('gkedMask', function () {
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
                                                            RequisitesForm.directive('numbersOnly', function () {
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
                                                            RequisitesForm.directive('upperCase', function () {
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
                                            </script>
