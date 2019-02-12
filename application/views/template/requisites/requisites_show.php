<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main" ng-app="RequisitesForm" ng-controller="RequisitesFormData">
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <strong>Oh snap! </strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> СВОЙСТВА ЗАЯВКИ</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-2">
                        <button onclick="window.open('<?php echo base_url() . "index.php/pdfcreate/payInvoice/" . $requisites_data->id_requisites; ?>');" type="button" class="btn btn-info"><span class="glyphicon glyphicon-print"></span> Бланк
                            счет-фактуры
                        </button>
                    </div>
                    <div class="col-lg-3">
                        <button onclick="window.location.href = '<?php echo base_url() . "index.php/invoice/invoice_show_view/" . $requisites_data->invoice_serial_number ?>'" type="button" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span> Просмотр
                            счета на оплату
                        </button>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Дистрибьютор</th>
                            <th>Оператор заполневший заявку</th>
                            <th>№ Cчет-фактуры</th>
                            <th>Дата создания</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $requisites_data->full_name ?></td>
                            <td><?php echo $requisites_data->user_name ?></td>
                            <td><?php echo $requisites_data->pay_invoice_serial_number ?></td>
                            <td><?php echo $requisites_data->requisites_creating_date_time ?></td>
                        </tr>
                    </tbody>
                </table>
                <h3 align="center">Cведения о выданных сертификатах</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <!--<th>Серийный номер сертификата</th>-->
                            <th>ФИО владельца</th>
                            <th>Паспортные данные</th>
                            <th>Должность</th>
                            <th>Дата выдачи</th>
                            <th>Статус сертификата</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($certificates as $cert): ?>
                            <?php if ($cert->SystemIsAccessible == TRUE): ?>
                                <tr class="success">
                                <?php else: ?>
                                <tr class="danger">
                                <?php endif; ?>
        <!--<td><?php //echo $cert->CertNumber;         ?></td>-->
                                <td style="width: 250px"><?php echo $cert->Owner; ?></td>
                                <td style="width: 160px"><?php echo $cert->Passport->Series . " " . $cert->Passport->Number; ?></td>
                                <td><?php echo $cert->Title; ?></td>
                                <td style="width: 155px"><?php echo $cert->DateStart; ?></td>
                                <td><?php echo $cert->StatusMessage; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span> Реквизиты юридического лица</h3>
            </div>
            <div class="panel-body">
                <h3 align="center">Основные сведения</h3>
                <table class="table">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>ИНН организации</strong></td>
                            <td><?php echo $requisites_data->json->main->inn; ?></td>
                        </tr><tr>
                            <td><strong>Наименование организации</strong></td>
                            <td><?php echo $requisites_data->json->main->name; ?></td>
                        </tr><tr>
                            <td><strong>ОКПО</strong></td>
                            <td><?php echo $requisites_data->json->main->okpo; ?></td>
                        </tr><tr>
                            <td><strong>Рег. номер Министерства Юстиции</strong></td>
                            <td><?php echo $requisites_data->json->main->minjust; ?></td>
                        </tr><tr>
                            <td><strong>Рег. номер Социального Фонда</strong></td>
                            <td><?php echo $requisites_data->json->main->sf; ?></td>
                        </tr><tr>
                            <td><strong>ГКЭД</strong></td>
                            <td><?php echo $requisites_data->json->main->gked->id; ?></td>
                        </tr><tr>
                            <td><strong>Вид деятельности</strong></td>
                            <td><?php echo $requisites_data->json->main->gked->name; ?></td>
                        </tr><tr>
                            <td><strong>Форма собственности</strong></td>
                            <td><?php echo $requisites_data->json->main->ownerform; ?></td>
                        </tr><tr>
                            <td><strong>Организационно-правовая форма</strong></td>
                            <td><?php echo $requisites_data->json->main->legalform; ?></td>
                        </tr><tr>
                            <td><strong>Гражданско-правовой статус</strong></td>
                            <td><?php echo $requisites_data->json->main->civilstatus; ?></td>
                        </tr><tr>
                            <td><strong>Форма участия в капитале</strong></td>
                            <td><?php echo $requisites_data->json->main->capitalform; ?></td>
                        </tr><tr>
                            <td><strong>Форма управления</strong></td>
                            <td><?php echo $requisites_data->json->main->manageform; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Электронная почта</strong></td>
                            <td><?php echo $requisites_data->json->contacts->email; ?></td>
                        </tr>
                    </tbody>
                </table>
                <h3 align="center">Адрес</h3>
                <table class="table">
                    <thead></thead>
                    <tbody>
                        <tr class="success" align="center">
                            <td colspan="2"><h4>Юридический адрес</h4></td>
                        </tr>
                        <tr>
                            <td><strong>Почтовый Индекс</strong></td>
                            <td><?php echo $requisites_data->json->contacts->juristic_address->post_index; ?></td>
                        </tr>
                        <!--<tr>
                            <td>СОАТЭ</td>
                            <td><?php //echo $requisites_data->json->contacts->juristic_address->settlement;   ?></td>
                        </tr>-->
                        <tr>
                            <td><strong>Населенный пункт</strong></td>
                            <td><?php
                                echo $requisites_data->json->contacts->juristic_address->settlement['region'] . ", " .
                                $requisites_data->json->contacts->juristic_address->settlement['district'] . ", " .
                                $requisites_data->json->contacts->juristic_address->settlement['settlement'];
                                ?></td>
                        </tr>
                        <tr>
                            <td><strong>Улица/Микрорайон</strong></td>
                            <td><?php echo $requisites_data->json->contacts->juristic_address->street; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Дом</strong></td>
                            <td><?php echo $requisites_data->json->contacts->juristic_address->building; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Кв./Строение</strong></td>
                            <td><?php echo (isset($requisites_data->json->contacts->juristic_address->apartment))?$requisites_data->json->contacts->juristic_address->apartment:NULL; ?></td>
                        </tr>
                        <tr class="success" align="center">
                            <td colspan="2"><h4>Физический адрес</h4></td>
                        </tr>
                        <tr>
                            <td><strong>Почтовый Индекс</strong></td>
                            <td><?php echo $requisites_data->json->contacts->real_address->post_index; ?></td>
                        </tr>
                        <!--<tr>
                            <td>СОАТЭ</td>
                            <td><?php //echo $requisites_data->json->contacts->real_address->settlement; ?></td>
                        </tr>-->
                        <tr>
                            <td><strong>Населенный пункт</strong></td>
                            <td><?php
                                echo $requisites_data->json->contacts->real_address->settlement['region'] . ", " .
                                $requisites_data->json->contacts->real_address->settlement['district'] . ", " .
                                $requisites_data->json->contacts->real_address->settlement['settlement'];
                                ?></td>
                        </tr>
                        <tr>
                            <td><strong>Улица/Микрорайон</strong></td>
                            <td><?php echo $requisites_data->json->contacts->real_address->street; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Дом</strong></td>
                            <td><?php echo $requisites_data->json->contacts->real_address->building; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Кв./Строение</strong></td>
                            <td><?php echo $requisites_data->json->contacts->real_address->apartment; ?></td>
                        </tr>
                    </tbody>
                </table>
                <h3 align="center">Банковские реквизиты</h3>
                <table class="table">
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td><strong>БИК</strong></td>
                            <td><?php echo $requisites_data->json->bank->bic; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Наименование банка</strong></td>
                            <td><?php echo $requisites_data->json->bank->bankname; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Расчетный счет</strong></td>
                            <td><?php echo $requisites_data->json->bank->account; ?></td>
                        </tr>
                    </tbody>
                </table>
                <h3 align="center">Данные об отчетности</h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>Район СФ</strong></td>
                            <td><?php echo $requisites_data->json->reporting->sfregion; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Тариф СФ</strong></td>
                            <td><?php echo $requisites_data->json->reporting->sftariff; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Район ГНС</strong></td>
                            <td><?php echo $requisites_data->json->reporting->stiregion; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Район принимающей ГНС</strong></td>
                            <td><?php echo $requisites_data->json->reporting->stiapplyingregion; ?></td>
                        </tr>
<!--                        <tr>
                            <td>Система отчетности</td>
                            <td><?php //echo 'В josn не нет такого'; ?></td>
                        </tr>-->
                    <tbody>    
                </table>
                <h3 align="center">Сканированные документы - <button type="submit" class="btn btn-info" ng-click="juridical_scan = !juridical_scan">Показать / Скрыть</button></h3>
                <table class="table" ng-show="juridical_scan">
                    <thead></thead>
                    <tbody>
                        <tr class="success" align="center">
                            <td><h4>Свидетельство о государственной регистрации Министерсва Юстиции (Кыргызская стороная)</h4></td>
                        </tr>
                        <tr>
                            <td align="center"> <img class="thumbnail" src="<?php echo base_url(); ?>uploads/<?php echo $requisites_data->invoice_serial_number ?>/Juridical/mu_file_kg.jpg" width="500" ></td>
                        </tr>
                        <tr class="success" align="center">
                            <td><h4>Свидетельство о государственной регистрации Министерсва Юстиции (Русская стороная)</h4></td>
                        </tr>
                        <tr>
                            <td align="center"> <img class="thumbnail" src="<?php echo base_url(); ?>uploads/<?php echo $requisites_data->invoice_serial_number ?>/Juridical/mu_file_ru.jpg" width="500" ></td>
                        </tr>
                        <tr class="success" align="center">
                            <td><h4>Форма М2А</h4></td>
                        </tr>
                        <tr>
                            <td align="center"> <img class="thumbnail" src="<?php echo base_url(); ?>uploads/<?php echo $requisites_data->invoice_serial_number ?>/Juridical/m2a.jpg" width="500" ></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php foreach ($requisites_data->json->person as $person): ?>
            <div class = "panel panel-primary">
                <div class = "panel-heading">
                    <h3 class = "panel-title"><span class="glyphicon glyphicon-user"></span> Реквизиты сотрудника компании (на которого выдалось ЭЦП) </h3>
                </div>
                <div class = "panel-body">
                    <h3 align="center">Основные сведения</h3>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Серийный номер токена</strong></td>
                                <td><?php echo $person->token; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Должность</strong></td>
                                <td><?php echo 'тут по идее должность'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>ФИО</strong></td>
                                <td><?php echo $person->surname." ".$person->name." ".$person->fathername; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Контактный телефон</strong></td>
                                <td><?php echo $person->phone; ?></td>
                            </tr>
                            <tr class="success" align="center">
                                <td colspan="2"><h4>Паспортные данные</h4></td>
                            </tr>
                            <tr>
                                <td><strong>Серия</strong></td>
                                <td><?php echo $person->passport_data->series; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Номер</strong></td>
                                <td><?php echo $person->passport_data->number; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Орган выдавший паспорт</strong></td>
                                <td><?php echo $person->passport_data->issue_place; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Дата выдачи</strong></td>
                                <td><?php echo $person->passport_data->issue_date; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <h3 align="center">Сканированные документы - <button type="submit" class="btn btn-info" ng-click="person_scan = !person_scan">Показать / Скрыть</button></h3>
                        <table class="table" ng-show="person_scan">
                            <thead></thead>
                            <tbody>
                                <tr class="success" align="center">
                                    <td><h4>Паспорт физического лица (Cторона 1)</h4></td>
                                </tr>
                                <tr>
                                    <td align="center"> <img class="thumbnail" src="<?php echo base_url(); ?>uploads/<?php echo $requisites_data->invoice_serial_number ?>/Representatives/<?php echo $person->token; ?>/passport_side_1.jpg" width="500" ></td>
                                </tr>
                                <tr class="success" align="center">
                                    <td><h4>Паспорт физического лица (Cторона 2)</h4></td>
                                </tr>
                                <tr>
                                    <td align="center"> <img class="thumbnail" src="<?php echo base_url(); ?>uploads/<?php echo $requisites_data->invoice_serial_number ?>/Representatives/<?php echo $person->token; ?>/passport_side_2.jpg" width="500" ></td>
                                </tr>
                                <tr class="success" align="center">
                                    <td><h4>Нотариально заверенная копия</h4></td>
                                </tr>
                                <tr>
                                    <td align="center"> <img class="thumbnail" src="<?php echo base_url(); ?>uploads/<?php echo $requisites_data->invoice_serial_number ?>/Representatives/<?php echo $person->token; ?>/passport_copy.jpg" width="500" ></td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<script type="text/javascript">
    var RequisitesForm = angular.module('RequisitesForm', []);
    RequisitesForm.controller('RequisitesFormData', ['$scope', function ($scope) {
            $scope.person_scan=false;
            $scope.juridical_scan=false;
        }
    ]);
</script>