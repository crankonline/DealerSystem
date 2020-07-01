<?php
/**
 * Created by PhpStorm.
 * User: dex
 * Date: 03/04/17
 * Time: 12:49
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <style type="text/css">

            body {
                font-family: "Times New Roman";
                font-size: 10px;
            }

            table.concept {
                border-collapse: collapse;
                width: 350px;
            }

            table.concept td {
                width: 5%;
            }

            table.concept tr.large td {
                font-size: 13px;
            }
            table.concept tr.small td {
                font-size: 8px;
            }

            table.concept td[colspan="1"] { min-width: 5%; width: 5%; max-width: 5%; }
            table.concept td[colspan="2"] { min-width: 10%; width: 10%; max-width: 10%; }
            table.concept td[colspan="3"] { min-width: 15%; width: 15%; max-width: 15%; }
            table.concept td[colspan="4"] { min-width: 20%; width: 20%; max-width: 20%; }
            table.concept td[colspan="5"] { min-width: 25%; width: 25%; max-width: 25%; }
            table.concept td[colspan="6"] { min-width: 30%; width: 30%; max-width: 30%; }
            table.concept td[colspan="7"] { min-width: 35%; width: 35%; max-width: 35%; }
            table.concept td[colspan="8"] { min-width: 40%; width: 40%; max-width: 40%; }
            table.concept td[colspan="9"] { min-width: 45%; width: 45%; max-width: 45%; }
            table.concept td[colspan="10"] { min-width: 50%; width: 50%; max-width: 50%; }
            table.concept td[colspan="11"] { min-width: 55%; width: 55%; max-width: 55%; }
            table.concept td[colspan="12"] { min-width: 60%; width: 60%; max-width: 60%; }
            table.concept td[colspan="13"] { min-width: 65%; width: 65%; max-width: 65%; }
            table.concept td[colspan="14"] { min-width: 70%; width: 70%; max-width: 70%; }
            table.concept td[colspan="15"] { min-width: 75%; width: 75%; max-width: 75%; }
            table.concept td[colspan="16"] { min-width: 80%; width: 80%; max-width: 80%; }
            table.concept td[colspan="17"] { min-width: 85%; width: 85%; max-width: 85%; }
            table.concept td[colspan="18"] { min-width: 90%; width: 90%; max-width: 90%; }
            table.concept td[colspan="19"] { min-width: 95%; width: 95%; max-width: 95%; }
            table.concept td[colspan="20"] { width: 100%; }

            .small {
                font-size: 8px;
            }
            .large {
                font-size: 13px;
            }

            .center { text-align: center; }
            .right { text-align: right; }

            .bordered {
                border: 1px solid black;
            }

            .border-left { border-left: 1px solid black; }
            .border-bottom { border-bottom: 1px solid black; }
            .border-right { border-right: 1px solid black; }
            .border-top { border-top: 1px solid black; }

            .border-right-none {
                border-right: none;
            }

            tr.td-bordered td, tr.td-bordered th { border: 1px solid black; }
            tr.td-center td, tr.td-center th { text-align: center; }

        </style>
    </head>
    <body>
        <table class="concept">
            <tbody>

                <tr>
                    <td colspan="9" class="small">
                        <b>BLANK STI - 002</b><br/>
                        Кыргызская Республика
                    </td>
                    <td colspan="21" class="center large">
                        <b>СЧЕТ-ФАКТУРА НДС</b>
                    </td>
                    <td colspan="10" class="center small">
                        Приложение 3<br/>
                        к постановлениию Правительства<br/>
                        Кыргызской Республики<br/>
                        от 4 ноября 2016 г. №569
                    </td>
                </tr>
                <tr>
                    <td colspan="40" class="border-bottom">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="40"></td>
                </tr>
                <tr>
                    <td colspan="2" class="bordered center" bgcolor="gray">101</td>
                    <td colspan="11">&nbsp;&nbsp;<b>СЕРИЯ: <?php echo $data->serial; ?></b></td>
                    <td colspan="2" class="bordered center" bgcolor="gray">102</td>
                    <td colspan="10">&nbsp;&nbsp;<b>НОМЕР: <?php echo $data->number; ?></b></td>
                    <td colspan="2" class="bordered center" bgcolor="gray">103</td>
                    <td colspan="3">&nbsp;&nbsp;<b>ДАТА:</b> <?php //echo date("d.m.Y", strtotime($data->requisites_creating_date_time));  ?></b></td>
                    <td colspan="1" class="bordered center"> <?php echo date("d", strtotime($data->requisites_creating_date_time)){0}; ?></td>
                    <td colspan="1" class="bordered center"> <?php echo date("d", strtotime($data->requisites_creating_date_time)){1}; ?></td>
                    <td colspan="1"></td>
                    <td colspan="1" class="bordered center"> <?php echo date("m", strtotime($data->requisites_creating_date_time)){0}; ?></td>
                    <td colspan="1" class="bordered center"> <?php echo date("m", strtotime($data->requisites_creating_date_time)){1}; ?></td>
                    <td colspan="1"></td>
                    <td colspan="1" class="bordered center"> <?php echo date("Y", strtotime($data->requisites_creating_date_time)){0}; ?></td>
                    <td colspan="1" class="bordered center"> <?php echo date("Y", strtotime($data->requisites_creating_date_time)){1}; ?></td>
                    <td colspan="1" class="bordered center"> <?php echo date("Y", strtotime($data->requisites_creating_date_time)){2}; ?></td>
                    <td colspan="1" class="bordered center"> <?php echo date("Y", strtotime($data->requisites_creating_date_time)){3}; ?></td>
                </tr>
                <tr class="small">
                    <td colspan="20">&nbsp;</td>
                    <td colspan="10">&nbsp;</td>
                    <td colspan="2" class="center">день</td>
                    <td colspan="4" class="center">месяц</td>
                    <td colspan="4" class="center">год</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="small">
                    <td colspan="1" class="bordered center">201</td>
                    <td colspan="5" rowspan="2" class="center border-top border-bottom">Поставщик ИНН</td>
                    <?php for ($i = 0; $i < 14; $i++): ?>
                        <td class="center bordered" rowspan="2" colspan="1"><?php echo $data->inn_distributor{$i}; ?></td>
                    <?php endfor; ?>
                    <td colspan="1" class="bordered center">301</td>
                    <td colspan="5" rowspan="2" class="center border-top border-bottom border-right" >Покупатель ИНН</td>
                    <?php for ($i = 0; $i < 14; $i++): ?>
                        <td class="center bordered" rowspan = "2" colspan="1"><?php echo $json->common->inn{$i}; ?></td>
                    <?php endfor; ?>
                </tr>
                <tr class="border-bottom">
                    <td class="border-left border-bottom">&nbsp;</td>
                    <td class="border-left border-bottom">&nbsp;</td>
                </tr>
<!--                <tr>
                    <td colspan="1" class="border-left border-bottom" ></td>
                    <td colspan="19" class="border-bottom" >ИНН </td>
                    <td colspan="1" class="border-left border-bottom" ></td>
                    <td colspan="19" class="border-bottom border-right" >ИНН </td>
                </tr>-->

                <tr class="small">
                    <td colspan="1" class="bordered center">202</td>
                    <td colspan="19" class="border-right center">Ф.И.О. ИП / Наименование организации</td>
                    <td colspan="1" class="bordered center">302</td>
                    <td colspan="19" class="border-right center">Ф.И.О. ИП / Наименование организации</td>
                </tr>
                <tr>
                    <td colspan="1" class="border-left border-bottom"></td>
                    <td colspan="19" class="border-right border-bottom"><?php echo $data->full_name; ?></td>
                    <td colspan="1" class="border-bottom"></td>
                    <td colspan="19" class="border-right border-bottom"><?php echo $json->common->name; ?></td>
                </tr>
                <tr class="small">
                    <td colspan="1" class="bordered center">203</td>
                    <td colspan="19" class="border-right">Адрес</td>
                    <td colspan="1" class="bordered center">303</td>
                    <td colspan="19" class="border-right">Адрес</td>
                </tr>
                <tr>
                    <td colspan="1" class="border-left border-bottom"></td>
                    <td colspan="19" class="border-right border-bottom center"><?php echo $data->address; ?></td>
                    <td colspan="1" class="border-bottom"></td>
                    <td colspan="19" class="border-right border-bottom center"><?php
                        $juristicAddress = [
                            isset($json->common->juristicAddress->settlement->district->region->name) ? $json->common->juristicAddress->settlement->district->region->name : "",
                            isset($json->common->juristicAddress->settlement->district->name) ? $json->common->juristicAddress->settlement->district->name : "",
                            isset($json->common->juristicAddress->settlement->name) ? $json->common->juristicAddress->settlement->name : "",
                            isset($json->common->juristicAddress->street) ? $json->common->juristicAddress->street : "",
                            isset($json->common->juristicAddress->building) ? $json->common->juristicAddress->building : "",
                            isset($json->common->juristicAddress->apartment) ? $json->common->juristicAddress->apartment : ""
                        ];

                        $juristicAddressChecked = [];

                        foreach ($juristicAddress as $item) {
                            if ($item == "") {
                                continue;
                            }
                            $juristicAddressChecked[] = $item;
                        }


                        echo implode(
                                ', ', $juristicAddressChecked);
                        ?></td>
                </tr>
                <tr>
                    <td colspan="1" class="small bordered">204</td>
                    <td colspan="2" rowspan="2" class="small border-bottom">Код налогового органа</td>
                    <td colspan="1" rowspan="2" class="small center bordered"><?php echo $data->sti_code{0}; ?></td>
                    <td colspan="1" rowspan="2" class="small center bordered"><?php echo $data->sti_code{1}; ?></td>
                    <td colspan="1" rowspan="2" class="small center bordered"><?php echo $data->sti_code{2}; ?></td>
                    <td colspan="14" class="small center">Наименование налогового органа</td>

                    <td colspan="1" class="small bordered">304</td>
                    <td colspan="2" rowspan="2" class="small border-bottom">Код налогового органа</td>
                    <td colspan="1" rowspan="2" class="small center bordered"><?php echo $json->sti->regionDefault->id{0}; ?></td>
                    <td colspan="1" rowspan="2" class="small center bordered"><?php echo $json->sti->regionDefault->id{1}; ?></td>
                    <td colspan="1" rowspan="2" class="small center bordered"><?php echo $json->sti->regionDefault->id{2}; ?></td>
                    <td colspan="14" class="small border-right center">Наименование налогового органа</td>
                </tr>
                <tr>
                    <td colspan="6" class="border-left border-bottom"></td>
                    <td colspan="14" class="border-left border-bottom" ><?php echo $data->sti_region; ?></td>
                    <td colspan="6" class="border-left border-bottom"></td>
                    <td colspan="14" class="border-left border-bottom border-right" ><?php echo $json->sti->regionDefault->name; ?></td>
                </tr>
                <tr>
                    <td colspan="1" class="bordered small center">205</td>
                    <td colspan="10" class="small center">Код (БИК) и наименование банка</td>
                    <?php $biclengthdist = strlen($data->bank_bik); /* 6 */ ?>
                    <?php for ($i = 0; $i < $biclengthdist; $i++): ?>
                        <td class = "small center bordered" rowspan="2" colspan="1"><?php echo $data->bank_bik{$i}; ?></td>
                    <?php endfor; ?>
                    <td class = "center bordered" rowspan="2" colspan="1"></td>
                    <td class = "center bordered" rowspan="2" colspan="1"></td>
                    <td class = "center bordered" rowspan="2" colspan="1"></td>

                    <td colspan="1" class="bordered small center">305</td>
                    <td colspan="10" class="small center">Код (БИК) и наименование банка</td>
                    <?php if (isset($json->common->bank->id)) : ?>
                        <?php $biclength = strlen($json->common->bank->id); /* 6 */ ?>
                        <?php for ($i = 0; $i < $biclength; $i++): ?>
                            <td class = "small center bordered" rowspan="2" colspan="1"><?php echo $json->common->bank->id{$i}; ?></td>
                        <?php endfor; ?>
                    <?php else : ?>
                        <?php for ($i = 0; $i < 6; $i++): ?>
                            <td class = "center bordered" rowspan="2" colspan="1">X</td>
                        <?php endfor; ?>
                    <?php endif ?>
                    <td class = "center bordered" rowspan="2" colspan="1"></td>
                    <td class = "center bordered" rowspan="2" colspan="1"></td>
                    <td class = "center bordered" rowspan="2" colspan="1"></td>
                </tr>


                <tr>
                    <td class="border-left border-bottom"></td>
                    <td colspan="10" class="border-bottom" ><?php echo $data->bank_name; ?></td>
                    <td class="border-left border-bottom"></td>
                    <td colspan="10" class="border-bottom" ><?php echo isset($json->common->bank->name) ? $json->common->bank->name : ""; ?></td>
                </tr>

                <tr>
                    <td colspan="1" class="bordered small">206</td>
                    <td colspan="3" rowspan="2" class="small border-bottom">Расчетный счет</td>

                    <?php $obalength = strlen($data->bank_account); //echo "<td>".$obalength."</td>"; /* 16 */ ?>
                    <?php for ($i = 0; $i < $obalength; $i++): ?>
                        <td class="small center bordered" rowspan = "2" colspan="1"><?php echo $data->bank_account{$i}; ?></td>
                    <?php endfor; ?>

                    <td colspan="1" class="bordered small">306</td>
                    <td colspan="3" rowspan="2" class="small border-bottom">Расчетный счет</td>

                    <?php if (isset($json->common->bankAccount)) : ?>
                        <?php $balength = strlen($json->common->bankAccount); //echo "<td>".$balength."</td>";/* 16 */ ?>
                        <?php if ($balength > 16): ?>
                            <?php for ($i = 0; $i < 16; $i++): ?>
                                <td class="small center bordered" rowspan = "2" colspan="1"><?php echo $json->common->bankAccount{$i}; ?></td>
                            <?php endfor; ?>
                        <?php else: ?>
                            <?php for ($i = 0; $i < $balength; $i++): ?>
                                <td class="small center bordered" rowspan = "2" colspan="1"><?php echo $json->common->bankAccount{$i}; ?></td>
                            <?php endfor; ?>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php for ($i = 0; $i < 16; $i++): ?>
                            <td class="center bordered" rowspan = "2" colspan="1">X</td>
                        <?php endfor; ?>
                    <?php endif ?>
                </tr>


                <tr class="border-bottom">
                    <td class="border-left border-bottom">&nbsp;</td>
                    <td class="border-left border-bottom">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="1" class="bordered small">401</td>
                    <td colspan="12" class="small">Дата (период) поставки</td>
                    <td colspan="1" class="bordered small">402</td>
                    <td colspan="9" class="small">Вид поставки</td>
                    <td colspan="1" class="bordered small">403</td>
                    <td colspan="16" class="border-right small">Форма оплаты</td>
                </tr>

                <tr class="border-bottom">
                    <td colspan="1"  class="border-left border-bottom">&nbsp;</td>
                    <td colspan="12" class="center border-bottom"><?php echo date_format(new DateTime($data->requisites_creating_date_time), 'd.m.Y'); ?></td>
                    <td colspan="1"  class="border-left border-bottom">&nbsp;</td>
                    <td colspan="9"  class="center border-bottom">Внутренняя</td>
                    <td colspan="1"  class="border-left border-bottom">&nbsp;</td>
                    <td colspan="16" class="center border-right border-bottom">Безналичный</td>
                </tr>


                <tr class="small">
                    <td class="bordered" colspan="1">404</td>
                    <td colspan="19">Корректировка к счету-фактуре НДС</td>
                    <td class="bordered" colspan="1">405</td>
                    <td colspan="19" class="border-right">Причины корректировки</td>
                </tr>

                <tr class="border-bottom">
                    <td class="border-left border-bottom">&nbsp;</td>
                    <td colspan="19" class="border-right border-bottom">&nbsp;</td>
                    <td class=" border-bottom"></td>
                    <td colspan="19" class="border-right border-bottom">&nbsp;</td>
                </tr>

                <tr class="td-bordered td-center">
                    <th class = "small" colspan="3" rowspan="2">Код группы товаров</th>
                    <th class = "small" colspan="9" rowspan="2">Наименование услуг и товаров</th>
                    <th class = "small" colspan="2" rowspan="2">Ед. изм.</th>
                    <th class = "small" colspan="3" rowspan="2">Колич-во (объем)</th>
                    <th class = "small" colspan="3" rowspan="2">Цена (сом)</th>
                    <th class = "small" colspan="4" rowspan="2">Стоимость услуг и товаров без НДС и НчП</th>
                    <th class = "small" colspan="6">НДС</th>
                    <th class = "small" colspan="6">НсП</th>
                    <th class = "small" colspan="5" rowspan="2">Всего стоимость поставки (сом)</th>
                </tr>
                <tr class="td-bordered td-center">
                    <th class="small" colspan="2">Став-ка</th>
                    <th class="small" colspan="4">Сумма (сом)</th>
                    <th class="small" colspan="2">Став-ка</th>
                    <th class="small" colspan="4">Сумма (сом)</th>
                </tr>

                <?php $Sum = 0; ?>
                <?php $addcount = 7 - count($data_invoice); ?>
                <?php foreach ($data_invoice as $Record) : ?>
                    <tr class="td-bordered">
                        <td colspan="3" class="center">0000</td>
                        <td colspan="9"><?php echo $Record->inventory_name; ?></td>
                        <td colspan="2" class="center">шт.</td>
                        <td colspan="3" class="center"><?php echo $Record->count; ?></td>
                        <td colspan="3" class="center"><?php echo number_format(($Record->price_count / $Record->count) / 1.12, 2, '.', ''); ?></td>
                        <td colspan="4" class="center"><?php echo number_format($Record->price_count / 1.12, 2, '.', ''); ?></td>
                        <td colspan="2" class="center">12</td>
                        <td colspan="4" class="center"><?php echo number_format(($Record->price_count / $Record->count) * 12 / 112, 2, '.', ''); ?></td>
                        <td colspan="2" class="center">0</td>
                        <td colspan="4" class="center">0.00</td>
                        <td colspan="5" class="center"><?php echo number_format($Record->price_count, 2, '.', ''); ?></td>
                    </tr>
                    <?php $Sum += $Record->price_count; ?>
                <?php endforeach; ?>
                <?php for ($i = 0; $i < $addcount; $i++) : ?>
                    <tr class="td-bordered">
                        <td colspan="3"></td>
                        <td colspan="9" class="center">X</td>
                        <td colspan="2" class="center">X</td>
                        <td colspan="3" class="center">X</td>
                        <td colspan="3" class="center">X</td>
                        <td colspan="4" class="center">X</td>
                        <td colspan="2" class="center">X</td>
                        <td colspan="4" class="center">X</td>
                        <td colspan="2" class="center">X</td>
                        <td colspan="4" class="center">X</td>
                        <td colspan="5" class="center">X</td>
                    </tr>
                <?php endfor; ?>

                <tr class="td-bordered">
                    <td colspan="20" class="right"><b>ИТОГО &nbsp; &nbsp;</b></td>
                    <td colspan="4" class="center"><?php echo number_format($Sum / 1.12, 2, '.', ''); ?></td>
                    <td colspan="2" class="center">X</td>
                    <td colspan="4" class="center"><?php echo number_format($Sum * 12 / 112, 2, '.', ''); ?></td>
                    <td colspan="2" class="center">X</td>
                    <td colspan="4" class="center">0.00</td>
                    <td colspan="5" class="center"><?php echo number_format($Sum, 2, '.', ''); ?></td>
                </tr>
                <tr>
                    <td colspan="6"><br/><b>&nbsp; &nbsp;М.П.</b><br/><br/><br/></td>
                    <td colspan="16"><br/><b>РУКОВОДИТЕЛЬ:</b><br/><br/><br/></td>
                    <td colspan="18"><br/><b>ГЛАВНЫЙ БУХГАЛТЕР:</b><br/><br/><br/></td>
                </tr>
                <tr>
                    <td colspan="40" class="bordered small">
                        <br/>
                        <b>Примечание:</b><br/>
                        1) Раздел «Поставка» счета-фактуры НДС (BLANK STI – 002) должен состоять из 7 (семи) строк без учета итоговой строки. Незаполненные строки должны быть обозначены знаком «Х».
                        <br/>
                        2) Счет-фактура НДС (BLANK STI – 002) должен быть оформлен на 1-ом листе, в 2-х экземплярах и содержать идентичную информацию: 1 экземпляр хранится у покупателя, 2- у поставщика.
                        <br/>
                        3) ОСчет-фактура НДС (BLANK STI – 002) без печати, подписи руководителя и главного бухгалтера облагаемого субъекта, а также не содержащий все обязательных реквизитов, недействителен.
                        <br/>
                        4) Облагаемый субъект может указывать любые дополнительные сведения справочного или информационного характера.
                        <br/>
                        5) За изготовление или сбыт поддельных счетов-фактур, а также за замену, изменения, переделку и подделку счетов-фактур НДС предусмотрена ответственность, установленная Уголовным кодексом Кыргызской Республики.                 
                        <br/>
                    </td>
                </tr>


            </tbody>
        </table>

    </body>
</html>


