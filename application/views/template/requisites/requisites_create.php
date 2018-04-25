<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main" ng-app="RequisitesForm" ng-controller="RequisitesFormData">
    <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере    ?>
        <div class="alert alert-danger">
            <h3 align="center"><strong>!!!Произошла ошибка!!!</strong></h3> 
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    <form ng-submit="Upload()">
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
                            <td><input type="text" class="form-control" readonly="" required="" ng-model="Data.common.inn" ng-init="Data.common.inn = '<?php echo $invoice_data->inn; ?>'">
                                <input type="text" hidden="" ng-model="invoice_id" ng-init="invoice_id = '<?php echo $invoice_id; ?>'">
                                <input type="text" hidden="" ng-model="invoice_serial_number" ng-init="invoice_serial_number = '<?php echo $invoice_data->invoice_serial_number; ?>'">
                            </td>
                        </tr>
                        <tr>
                            <td>ОКПО</td>
                            <td><input type="text" class="form-control" placeholder="8 цифр" minlength="6" maxlength="8" required="" numbers-only 
                                       ng-model="Data.common.okpo" 
                                       ng-init="Data.common.okpo = '<?php echo (isset($requisites_json->common->okpo)) ? $requisites_json->common->okpo : NULL; ?>'">
                            </td>
                        </tr>
                        <tr>
                            <td>Рег. номер Социального Фонда</td>
                            <td><input type="text" class="form-control" placeholder="7-10 цифр" minlength="7" maxlength="10" required="" numbers-only 
                                       ng-model="Data.common.rnsf" 
                                       ng-init="Data.common.rnsf = '<?php echo (isset($requisites_json->common->rnsf)) ? $requisites_json->common->rnsf : NULL; ?>'">
                            </td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td>Рег. номер Министерства Юстиции</td>
                            <td><input type="text" class="form-control" placeholder="XXXXXX-YYYY-ZZZ" required="" maxlength="15" 
                                       ng-model="Data.common.rnmj" 
                                       ng-init="Data.common.rnmj = '<?php echo (isset($requisites_json->common->rnmj)) ? $requisites_json->common->rnmj : NULL; ?>'" 
                                       ng-disabled="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            </td>
                        </tr>
                        <tr>
                            <td>Наименование организации</td>
                            <td><textarea maxlength="255" class="form-control noresize" style="resize: vertical" placeholder="Наименование юридического лица" required="" 
                                          ng-model="Data.common.name" 
                                          ng-init="Data.common.name = '<?php echo htmlspecialchars($requisites_json->common->name); ?>'"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Полное наименование организации</td>
                            <td><textarea maxlength="255" class="form-control noresize" style="resize: vertical"  placeholder="Полное наименование юридического лица с ОПФ" required="" 
                                          ng-model="Data.common.fullName" 
                                          ng-init="Data.common.fullName = '<?php echo htmlspecialchars($requisites_json->common->fullName); ?>'"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>ГКЭД</td>
                            <td><input type="text" class="form-control"  placeholder="XX.YY.ZZ" maxlength="9" required="" 
                                       ng-model="Data.common.mainActivity.gked" 
                                       ng-init="Data.common.mainActivity.gked = '<?php echo (isset($requisites_json->common->mainActivity->gked)) ? $requisites_json->common->mainActivity->gked : NULL; ?>'" 
                                       ng-change="CheckGked()" gked-mask></td>
                        </tr>
                        <tr>
                            <td>Вид деятельности</td>
                            <td><textarea maxlength="255" class="form-control noresize" style="resize: vertical"  placeholder="Введите ГКЕД ячейкой выше" required="" 
                                          ng-model="Data.common.mainActivity.name" 
                                          ng-init="Data.common.mainActivity.name = '<?php echo (isset($requisites_json->common->mainActivity->name)) ? $requisites_json->common->mainActivity->name : NULL; ?>'" 
                                          ng-disabled="!Data.common.mainActivity.gked"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Форма собственности</td>
                            <td><select required class="form-control" 
                                        ng-model="Data.common.legalForm.ownershipForm" 
                                        ng-options="option.name disable when option.id === null for option in OwnershipForms track by option.id" 
                                        ng-change="loadLegalForm()"></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Организационно-правовая форма</td>
                            <td><select required class="form-control" 
                                        ng-model="Data.common.legalForm" 
                                        ng-options="option.name disable when option.id === null for option in LegalForms track by option.id" 
                                        ng-change="loadCivilLegalStatuses()"></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Гражданско-правовой статус</td>
                            <td><select required class="form-control" 
                                        ng-model="Data.common.civilLegalStatus" 
                                        ng-options="option.name disable when option.id === null for option in CivilLegalStatuses track by option.id"></select>
                            </td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td>Форма участия в капитале</td>
                            <td><select required class="form-control" 
                                        ng-model="Data.common.capitalForm" 
                                        ng-options="option.name disable when option.id === null for option in CapitalForms track by option.id" 
                                        ng-disabled="Data.common.civilLegalStatus.name === 'Физическое лицо'"></select>
                            </td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td>Форма управления</td>
                            <td><select required class="form-control" 
                                        ng-model="Data.common.managementForm" 
                                        ng-options="option.name disable when option.id === null for option in ManagementForms track by option.id" 
                                        ng-disabled="Data.common.civilLegalStatus.name === 'Физическое лицо'"></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Электронная почта</td>
                            <td><input type="email" class="form-control"  placeholder="E-mail" maxlength="30" required="" 
                                       ng-model="Data.common.eMail" 
                                       ng-init="Data.common.eMail = '<?php echo (isset($requisites_json->common->eMail)) ? $requisites_json->common->eMail : NULL; ?>'">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-euro"></span> Банковские реквизиты</h3></div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td colspan="2" align="center">
                                <label class="btn btn-danger"><input type="checkbox" ng-model="Bank_else" ng-init="Bank_else = true"> Присутствуют</label>
                            </td>
                        </tr>
                        <tr ng-hide="!Bank_else">
                            <td style="width: 266px">БИК</td>
                            <td><input type="text" class="form-control"  placeholder="6 цифр" maxlength="6" required="" numbers-only 
                                       ng-model="Data.common.bank.id" 
                                       ng-change="loadBankName()" 
                                       ng-init="Data.common.bank.id = '<?php echo (isset($requisites_json->common->bank->id)) ? $requisites_json->common->bank->id : null; ?>'" 
                                       ng-disabled="!Bank_else">
                            </td>
                        </tr>
                        <tr ng-hide="!Bank_else">
                            <td>Наименование банка</td>
                            <td><input type="text" class="form-control"  placeholder="Введите БИК ячейкой выше" required="" 
                                       ng-model="Data.common.bank.name" 
                                       ng-disabled="!Data.common.bank.id || !Bank_else" 
                                       ng-init="Data.common.bank.name = '<?php echo (isset($requisites_json->common->bank->name)) ? $requisites_json->common->bank->name : null; ?>'">
                            </td>
                        </tr>
                        <tr ng-hide="!Bank_else">
                            <td>Расчетный счет</td>
                            <td><input type="text" class="form-control"  placeholder="16 цифр" minlength="16" maxlength="16" required="" numbers-only 
                                       ng-model="Data.common.bankAccount" 
                                       ng-disabled="(!Data.common.bank || !Data.common.bank.name) || !Bank_else" 
                                       ng-init="Data.common.bankAccount = '<?php echo (isset($requisites_json->common->bankAccount)) ? $requisites_json->common->bankAccount : null; ?>'">
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
                            <td><input type="text" class="form-control"  placeholder="6 цифр" minlength="6" maxlength="6" required="" numbers-only 
                                       ng-model="Data.common.juristicAddress.postCode"
                                       ng-init="Data.common.juristicAddress.postCode = '<?php echo (isset($requisites_json->common->juristicAddress->postCode)) ? $requisites_json->common->juristicAddress->postCode : null; ?>'">
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
                            <td><input type="text" class="form-control"  placeholder="Улица / Микрорайон" maxlength="50" required="" 
                                       ng-model="Data.common.juristicAddress.street"
                                       ng-init="Data.common.juristicAddress.street = '<?php echo (isset($requisites_json->common->juristicAddress->street)) ? $requisites_json->common->juristicAddress->street : null; ?>'">
                            </td>
                        </tr>
                        <tr>
                            <td>Дом / Строение</td>
                            <td><input type="text" class="form-control"  placeholder="Дом / Строение" required="" maxlength="4" 
                                       ng-model="Data.common.juristicAddress.building"
                                       ng-init="Data.common.juristicAddress.building = '<?php echo (isset($requisites_json->common->juristicAddress->building)) ? $requisites_json->common->juristicAddress->building : null; ?>'">
                            </td>
                        </tr>
                        <tr>
                            <td>Квартира</td>
                            <td><input type="text" class="form-control"  placeholder="Квартира" maxlength="4" required=""
                                       ng-model="Data.common.juristicAddress.apartment" 
                                       ng-init="Data.common.juristicAddress.apartment = '<?php echo (isset($requisites_json->common->juristicAddress->apartment)) ? $requisites_json->common->juristicAddress->apartment : null; ?>'">
                            </td>
                        </tr>
                        <tr class="danger" align="center">
                            <td colspan="2">Физический адрес</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><label class="btn btn-danger">
                                    <input type="checkbox" ng-model="SameAddress" ng-init="SameAddress = true"> совпадает с юридическим</label>
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
                <?php if (!isset($requisites_json->common->representatives)): //если новая завка то отображам руководителя?>
                    <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-user"></span> Данные руководителя компании</h3></div>
                    <table class="table">
                        <tbody>
                            <tr class="danger">
                                <td colspan="2" align="center">Паспортные данные</td>
                            </tr>
                            <tr>
                                <td style="width: 266px">Серия паспорта</td>
                                <td><input type="text" class="form-control"  placeholder="2 символа" minlength="2" maxlength="2" required="" upper-case  
                                           ng-model="Data.chief.person.passport.series" >
                                </td>
                            </tr>
                            <tr >
                                <td>Номер паспорта</td>
                                <td><input type="text" class="form-control"  placeholder="до 15 символов" maxlength="15" required="" numbers-only  
                                           ng-model="Data.chief.person.passport.number">
                                </td>
                            </tr>
                            <tr >
                                <td>Орган выдавший паспорт</td>
                                <td><input type="text" class="form-control"  placeholder="до 20 символов" maxlength="20" required=""  
                                           ng-model="Data.chief.person.passport.issuingAuthority">
                                </td>
                            </tr>
                            <tr >
                                <td>Дата выдачи</td>
                                <td><input type="text" class="form-control"  placeholder="ДД.ММ.ГГГГ" maxlength="10" required=""  
                                           ng-model="Data.chief.person.passport.issuingDate" gked-mask>
                                </td>
                            </tr>
                            <tr class="danger" >
                                <td colspan="2" align="center">Персональные данные</td>
                            </tr>
                            <tr >
                                <td>Фамилия</td>
                                <td><input type="text" class="form-control"  placeholder="" maxlength="25" required=""  
                                           ng-model="Data.chief.person.surname">
                                </td>
                            </tr>
                            <tr >
                                <td>Имя</td>
                                <td><input type="text" class="form-control"  placeholder="" maxlength="20" required=""  
                                           ng-model="Data.chief.person.name">
                                </td>
                            </tr>
                            <tr >
                                <td>Отчество</td>
                                <td><input type="text" class="form-control"  placeholder="" maxlength="25"  
                                           ng-model="Data.chief.person.middleName">
                                </td>
                            </tr>
                            <tr >
                                <td>Должность</td>
                                <td><select  class="form-control" required  
                                             ng-model="chief_position" 
                                             ng-options="option.name disable when option.id === null for option in Positions track by option.id"></select>
                                </td>
                            </tr>
                            <tr>
                                <td>Основание на занимаемой должности</td>
                                <td><select  class="form-control" style="width: 825px;" required
                                             ng-model="Data.common.chiefBasis"
                                             ng-options="option.name disable when option.id === null for option in ChiefBasises track by option.id"></select>
                                </td>
                            </tr>
                            <tr >
                                <td>Рабочий телефон</td>
                                <td><input type="text" class="form-control"  placeholder="до 20 символов" maxlength="20" required="" numbers-only  
                                           ng-model="Data.chief.phone">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
                <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-picture"></span> Сканированные изображения юридического лица</h3></div>
                <table class="table">
                    <tbody>
                        <tr class="danger" ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td colspan="2" align="center">Свидетельство о государственной регистрации Министерсва Юстиции</td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td style="width: 266px">Кыргызская сторона</td>
                            <td><input type="file" class="form-control" required="" ngf-select ng-model="mu_file_kg" ngf-pattern="'image/*'"
                                       ngf-accept="'.jpg'" ngf-max-size="5MB" ngf-min-height="100" ng-disabled="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                                <img class="thumbnail" ng-hide="!mu_file_kg" ngf-src="mu_file_kg" width="50%" >
                            </td>
                        </tr>
                        <tr ng-hide="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                            <td>Русская сторона</td>
                            <td><input type="file" class="form-control" required="" ngf-select  ng-model="mu_file_ru" ngf-pattern="'image/*'"
                                       ngf-accept="'.jpg'" ngf-max-size="5MB" ngf-min-height="100" ng-disabled="Data.common.civilLegalStatus.name === 'Физическое лицо'">
                                <img class="thumbnail" ng-hide="!mu_file_ru" ngf-src="mu_file_ru" width="50%" >
                            </td>
                        </tr>
                        <tr class="danger">
                            <td colspan="2" align="center">Форма М2А</td>
                        </tr>
                        <tr>
                            <td>Выписка (не обязательно)</td>
                            <td><input type="file"  class="form-control" ngf-select ng-model="m2a" ngf-pattern="'image/*'"
                                       ngf-accept="'.jpg'" ngf-max-size="5MB" ngf-min-height="100">
                                <img class="thumbnail" ng-hide="!m2a" ngf-src="m2a" width="50%" >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php //for ($i = 1; $invoice_data->eds_count >= $i; $i++): ?>
        <div ng-repeat="key in range(0, count)">        
<!--            <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-certificate"></span> ЭЦП - {{count}} шт.</h3></div>-->
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-certificate"></span> Реквизиты сотрудника компании (на которого выдается ЭЦП) - №{{key + 1}}
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
                                <td><input type="text" class="form-control"  placeholder="2 символа" minlength="2" maxlength="2" required="" upper-case 
                                           ng-model="Data.common.representatives[key].person.passport.series" 
                                           ng-init="Data.common.representatives[key].person.passport.series = ''"></td>
                            </tr>
                            <tr>
                                <td>Номер паспорта</td>
                                <td><input type="text" class="form-control"  placeholder="до 15 символов" maxlength="15" required="" numbers-only 
                                           ng-model="Data.common.representatives[key].person.passport.number" 
                                           ng-init="Data.common.representatives[key].person.passport.number = ''"></td>
                            </tr>
                            <tr>
                                <td>Орган выдавший паспорт</td>
                                <td><input type="text" class="form-control"  placeholder="до 20 символов" maxlength="20" required="" 
                                           ng-model="Data.common.representatives[key].person.passport.issuingAuthority" 
                                           ng-init="Data.common.representatives[key].person.passport.issuingAuthority = ''"></td>
                            </tr>
                            <tr>
                                <td>Дата выдачи</td>
                                <td><input type="text" class="form-control"  placeholder="ДД.ММ.ГГГГ" maxlength="10" required="" gked-mask
                                           ng-model="Data.common.representatives[key].person.passport.issuingDate" 
                                           ng-init="Data.common.representatives[key].person.passport.issuingDate = ''"></td>
                            </tr>
                            <tr class="success">
                                <td colspan="2" align="center">Персональные данные</td>
                            </tr>
                            <tr>
                                <td>Фамилия</td>
                                <td><input type="text" class="form-control"  placeholder="" maxlength="25" required="" 
                                           ng-model="Data.common.representatives[key].person.surname" 
                                           ng-init="Data.common.representatives[key].person.surname = ''"></td>
                            </tr>
                            <tr>
                                <td>Имя</td>
                                <td><input type="text" class="form-control"  placeholder="" maxlength="20" required="" 
                                           ng-model="Data.common.representatives[key].person.name" ng-init="Data.common.representatives[key].person.name = ''"></td>
                            </tr>
                            <tr>
                                <td>Отчество</td>
                                <td><input type="text" class="form-control"  placeholder="" maxlength="25" 
                                           ng-model="Data.common.representatives[key].person.middleName" 
                                           ng-init="Data.common.representatives[key].person.middleName = ''"></td>
                            </tr>
                            <tr>
                                <td>Должность</td>
                                <td><select  class="form-control" required 
                                             ng-model="Data.common.representatives[key].position" 
                                             ng-options="option.name disable when option.id === null for option in Positions track by option.id">
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Роль в системе</td>
                                <td><select  class="form-control" required 
                                             ng-model="Data.common.representatives[key].roles" 
                                             ng-options="option.name disable when option.id === null for option in Roles track by option.id">
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Рабочий телефон</td>
                                <td><input type="text" class="form-control"  placeholder="до 20 символов" maxlength="20" required="" numbers-only 
                                           ng-model="Data.common.representatives[key].phone" 
                                           ng-init="Data.common.representatives[key].phone = ''"></td>
                            </tr>
                            <tr>
                                <td>Серийный номер носителя ЭЦП</td>
                                <td><input type="text" class="form-control"  placeholder="Номер токена" minlength="10" maxlength="10" required="" numbers-only 
                                           ng-model="Data.common.representatives[key].deviceSerial" 
                                           ng-init="Data.common.representatives[key].deviceSerial = ''"></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="page-header"><h3 align="center"><span class="glyphicon glyphicon-picture"></span> Сканированные изображения паспорта</h3></div>
                    <table class="table">
                        <tbody>
                            <tr class="success">
                                <td colspan="2" align="center">Паспорт физического лица</td>
                            </tr>
                            <tr>
                                <td style="width: 266px">Cторона 1</td>
                                <td><input type="file"  class="form-control" required="" ngf-select ng-model="passport_side_1[key]" ngf-pattern="'image/*'" ngf-accept="'.jpg'" ngf-max-size="5MB" ngf-min-height="100">
                                    <img class="thumbnail" ng-hide="!passport_side_1[key]" ngf-src="passport_side_1[key]" width="50%" >
                                </td>  
                            </tr>
                            <tr>
                                <td>Cторона 2</td>
                                <td><input type="file" class="form-control"  ngf-select ng-model="passport_side_2[key]" ngf-pattern="'image/*'" ngf-accept="'.jpg'" ngf-max-size="5MB" ngf-min-height="100">
                                    <img class="thumbnail" ng-hide="!passport_side_2[key]" ngf-src="passport_side_2[key]" width="50%" >
                                </td>
                            </tr>
                            <tr class="success">
                                <td colspan="2" align="center">Нотариально заверенная копия паспорта переведенной на официальный язык</td>
                            </tr>
                            <tr>
                                <td>Нотариально заверенная копия</td>
                                <td><input type="file" class="form-control" ngf-select ng-model="passport_copy[key]" ngf-pattern="'image/*'" ngf-accept="'.jpg'" ngf-max-size="5MB" ngf-min-height="100">
                                    <img class="thumbnail" ng-hide="!passport_copy[key]" ngf-src="passport_copy[key]" width="50%" >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php //endfor; ?>
        </div>
        <div class="alert alert-danger" ng-hide="!errorMsg">
<!--            <strong>Oh snap! </strong> {{errorMsg}}-->
            <p ng-bind-html ="ErrorMessage"></p>
        </div>
        <div class="alert alert-success" ng-hide="!resultupload">
<!--            <strong>Well done! </strong> {{resultupload}}-->
            <p ng-bind-html ="ResUpload"></p>
        </div>
        <div class="progress progress-striped active" ng-hide="!progressjur || progressjur === 100" >
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{progressjur}}%">
                <span class="sr-only">{{progressjur}}%</span>
            </div>
        </div>
        <div class="progress progress-striped active" ng-hide="!progressphy || progressphy === 100" >
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{progressphy}}%">
                <span class="sr-only">{{progressphy}}%</span>
            </div>
        </div>
        <div align="center"><button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Создать заявку</button></div>
    </form>
</div>

<script type="text/javascript">
    var RequisitesForm = angular.module('RequisitesForm', ['ngFileUpload']);
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
                    $scope.count = <?php echo $invoice_data->eds_count; ?>;
                    $scope.passport_side_1 = [];
                    $scope.passport_side_2 = [];
                    $scope.passport_copy = [];
                    $scope.json_original = <?php echo (isset($json_original) ? "'" . $json_original . "'" : "''"); ?>;
                    //console.log('количесвтво эцп:' + $scope.count);
                    $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonCapitalForms', id: ''}).
                            then(function (response) {
                                $scope.CapitalForms = [{id: '', name: 'Выберите значение'}].concat(response.data);
                                mObjNode('Data.common.capitalForm', $scope);
                                var defaultId = <?php echo (isset($requisites_json->common->capitalForm->id)) ? $requisites_json->common->capitalForm->id : "''"; ?>;
                                //console.log($scope.CapitalForms.findIndex(x => x.id === defaultId));
                                $scope.Data.common.capitalForm = $scope.CapitalForms[$scope.CapitalForms.findIndex(x => x.id === defaultId)];
                            });
                    $http.post('<?php echo base_url(); ?>index.php/requisites/reference_load', {reference: 'getCommonManagementForms', id: ''}).
                            then(function (response) {
                                $scope.ManagementForms = [{id: '', name: 'Выберите значение'}].concat(response.data);
                                mObjNode('Data.common.managementForm', $scope);
                                var defaultId = <?php echo (isset($requisites_json->common->managementForm->id)) ? $requisites_json->common->managementForm->id : "''"; ?>;
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
                                $scope.chief_position = $scope.Positions[0]; //справочник должности руководителя
                                for (var i = 0; i < $scope.count; i++) {
                                    $scope.Data.common.representatives[i].position = $scope.Positions[0];
                                }

                                $scope.Roles = [
                                    {id: '', name: 'Выберите значение'},
                                    {id: '1', name: 'Руководитель'},
                                    {id: '2', name: 'Бухгалтер'},
                                    {id: '4', name: 'ЭЦП в не отчетности'},
                                ];
                                for (var i = 0; i < $scope.count; i++) {
                                    $scope.Data.common.representatives[i].roles = $scope.Roles[0];
                                };
                            });


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
                    }

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
                                    //var defaultId = <?php //echo (isset($requisites_json->common->juristicAddress->settlement->district)) ? $requisites_json->common->juristicAddress->settlement->district : "''";    ?>;
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
                    $scope.Upload = function () {
                    console.log($scope.Data.common.capitalForm);
                        if ((!$scope.Data.common.rnmj || !/^\d+\-\d+\-.+$/.test($scope.Data.common.rnmj)) && ($scope.Data.common.civilLegalStatus.name !== 'Физическое лицо')) {
                            alert('Рег. номер Министерства Юстиции не соответствует маске XXXXXX-YYYY-ZZZ');
                            return;
                        }
                        if (!$scope.Data.common.mainActivity.gked || !/^\d{2,2}\.\d{2,2}\.\d+$/.test($scope.Data.common.mainActivity.gked)) {
                            alert('Номер ГКЕД не соответствует маске XX.YY.ZZ');
                            return;
                        }
                        if ($scope.Data.common.civilLegalStatus === 'Физическое лицо'){
                            $scope.Data.common.capitalForm = null ;
                            $scope.Data.common.managementForm = null ;
                            $scope.Data.common.rnmj = null;
                            console.log($scope.Data.common.capitalForm);
                        }
                        
                        var id_requisites = null;
                        var check_jur = false; //for redirect
                        var count_of_count = 0; //for redirect
                        if ($scope.SameAddress) {
                            $scope.Data.common.physicalAddress = $scope.Data.common.juristicAddress;
                        }

                        $http.post('<?php echo base_url(); ?>index.php/requisites/requisites_create', {
                            invoice_id: $scope.invoice_id,
                            invoice_serial_number: $scope.invoice_serial_number,
                            json: $scope.Data,
                            json_original: $scope.json_original
                        }).
                                then(function (responce) {
                                    //console.log(responce);
                                    $scope.resultupload = responce.data.data;
                                    $scope.ResUpload = $sce.trustAsHtml($scope.resultupload);
                                    id_requisites = responce.data.id_requisites;
                                    //console.log(responce);

                                    Upload.upload({
                                        url: '<?php echo base_url(); ?>index.php/requisites/requisites_juridical_file_upload/' + $scope.invoice_serial_number,
                                        data: {
                                            mu_file_kg: $scope.mu_file_kg,
                                            mu_file_ru: $scope.mu_file_ru,
                                            m2a: $scope.m2a
                                        }
                                    }).then(function (responsejur) {
                                        $scope.resultupload = $scope.resultupload + responsejur.data;
                                        $scope.ResUpload = $sce.trustAsHtml($scope.resultupload);
                                        check_jur = true;
                                    }, function (responsejur) {
                                        if (responsejur.status > 0) {
                                            $scope.errorMsg = $sce.trustAsHtml('Ошибка при сохранении, код ошибки: ' + responsejur.status + '. <br> Сообщение: ' + responsejur.data);
                                            $scope.ErrorMessage = $scope.errorMsg;
                                        }
                                    }, function (evt) {
                                        $scope.progressjur = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
                                        //console.log($scope.progressjur);
                                    });
                                    for (var i = 0; i < $scope.count; i++) {
                                        Upload.upload({
                                            url: '<?php echo base_url(); ?>index.php/requisites/requisites_representatives_file_upload/' + $scope.invoice_serial_number + '/' + $scope.Data.common.representatives[i].deviceSerial,
                                            data: {
                                                passport_side_1: $scope.passport_side_1[i],
                                                passport_side_2: $scope.passport_side_2[i],
                                                passport_copy: $scope.passport_copy[i]
                                            }
                                        }).then(function (responsephy) {
                                            $scope.resultupload = $scope.resultupload + responsephy.data;
                                            $scope.ResUpload = $sce.trustAsHtml($scope.resultupload);
                                            count_of_count++;
                                        }, function (responsephy) {
                                            if (responsephy.status > 0)
                                            {
                                                $scope.errorMsg = $sce.trustAsHtml('Ошибка при сохранении, код ошибки: ' + responsephy.status + '. <br> Сообщение: ' + responsephy.data);
                                                $scope.ErrorMessage = $scope.errorMsg;
                                            }
                                        }, function (evt) {
                                            $scope.progressphy = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
                                        });
                                    }

                                }, function (response) {
                                    $scope.errorMsg = $sce.trustAsHtml('Ошибка при сохранении, код ошибки: ' + response.status + '. <br> Сообщение: ' + response.data);
                                    $scope.ErrorMessage = $scope.errorMsg;
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
