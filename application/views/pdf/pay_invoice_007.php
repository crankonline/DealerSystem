<?php
//var_dump($data_invoice);die;
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
            <b>BLANK STI - 007</b><br/>
            Кыргызская Республика
        </td>
        <td colspan="21" align="center">
            <b class="center large">СЧЕТ-ФАКТУРА НДС</b>
            <p class="small">в виде электронного документа по товарам</p>
        </td>
        <td colspan="10" class="center small">
            Приложение 3
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="16"></td>
        <td colspan="21" align="right">ВСЕГО ЛИСТОВ</td>
        <td colspan="3" class="bordered center">1</td>

    </tr>
    <tr>
        <td colspan="40" class="">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="40"></td>
    </tr>

    <tr>
        <td colspan="2" class="bordered center">101</td>
        <td colspan="4">&nbsp;&nbsp; СТАТУС:</td>
        <td colspan="5" class="bordered center"></td>
        <td colspan="2" ></td>
        <td colspan="2" class="bordered center">102</td>
        <td colspan="6">&nbsp;&nbsp; НОМЕР: <?php echo $data->number; ?></td>
        <td colspan="2" class="bordered center">103</td>
        <td colspan="7">&nbsp;&nbsp; ДАТА ОФОРМЛЕНИЯ</td>
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
    <tr class="bordered small">
        <td colspan="40" class="center">Раздел 1. Реквизиты поставщика и покупателя</td>
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
        <td colspan="5" rowspan="2" class="center border-top border-bottom">Филиал поставщика ИНН</td>
        <?php for ($i = 0; $i < 14; $i++): ?>
            <td class="center bordered" rowspan="2" colspan="1"></td>
        <?php endfor; ?>
        <td colspan="1" class="bordered center">303</td>
        <td colspan="5" rowspan="2" class="center border-top border-bottom border-right" >Филиал покупателя ИНН</td>
        <?php for ($i = 0; $i < 14; $i++): ?>
            <td class="center bordered" rowspan = "2" colspan="1"></td>
        <?php endfor; ?>
    </tr>
    <tr class="border-bottom">
        <td class="border-left border-bottom">&nbsp;</td>
        <td class="border-left border-bottom">&nbsp;</td>
    </tr>

    <tr class="small">
        <td colspan="1" class="bordered center">204</td>
        <td colspan="19" class="border-right center">Наименование филиала</td>
        <td colspan="1" class="bordered center">304</td>
        <td colspan="19" class="border-right center">Наименование филиала</td>
    </tr>
    <tr>
        <td colspan="1" class="border-left border-bottom"></td>
        <td colspan="19" class="border-right border-bottom center">&nbsp;&nbsp;</td>
        <td colspan="1" class="border-bottom"></td>
        <td colspan="19" class="border-right border-bottom center"></td>
    </tr>

    <tr class="small">
        <td colspan="1" class="bordered center">205</td>
        <td colspan="19" class="border-right center">Адрес (юридический и/или фактический)</td>
        <td colspan="1" class="bordered center">305</td>
        <td colspan="19" class="border-right center">Адрес (юридический и/или фактический</td>
    </tr>
    <tr>
        <td colspan="1" class="border-left border-bottom"></td>
        <td colspan="19" class="border-right border-bottom"><?php echo $data->address; ?></td>
        <td colspan="1" class="border-bottom"></td>
        <td colspan="19" class="border-right border-bottom"><?php
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
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="1" class="small bordered">206</td>
        <td colspan="2" rowspan="2" class="small border-bottom">Код налогового органа</td>
        <td colspan="1" rowspan="2" class="small center bordered"><?php echo $data->sti_code{0}; ?></td>
        <td colspan="1" rowspan="2" class="small center bordered"><?php echo $data->sti_code{1}; ?></td>
        <td colspan="1" rowspan="2" class="small center bordered"><?php echo $data->sti_code{2}; ?></td>
        <td colspan="14" class="small center">Наименование налогового органа</td>

        <td colspan="1" class="small bordered">306</td>
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
        <td colspan="1" class="bordered small center">207</td>
        <td colspan="10" class="small center">Наименование банка и код (БИК)</td>
        <?php $biclengthdist = strlen($data->bank_bik); /* 6 */ ?>
        <?php for ($i = 0; $i < $biclengthdist; $i++): ?>
            <td class = "small center bordered" rowspan="2" colspan="1"><?php echo $data->bank_bik{$i}; ?></td>
        <?php endfor; ?>
        <td class = "center bordered" rowspan="2" colspan="1"></td>
        <td class = "center bordered" rowspan="2" colspan="1"></td>
        <td class = "center bordered" rowspan="2" colspan="1"></td>

        <td colspan="1" class="bordered small center">307</td>
        <td colspan="10" class="small center">Наименование банка и код (БИК)</td>
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
        <td colspan="1" class="bordered small">208</td>
        <td colspan="3" rowspan="2" class="small border-bottom">Расчетный счет</td>

        <?php $obalength = strlen($data->bank_account); //echo "<td>".$obalength."</td>"; /* 16 */ ?>
        <?php for ($i = 0; $i < $obalength; $i++): ?>
            <td class="small center bordered" rowspan = "2" colspan="1"><?php echo $data->bank_account{$i}; ?></td>
        <?php endfor; ?>

        <td colspan="1" class="bordered small">308</td>
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

    <tr class="bordered small">
        <td colspan="40" class="center">Раздел 2. Информация о товаре</td>
    </tr>


    <tr>
        <td colspan="1" class="bordered small">401</td>
        <td colspan="9" class="small center">Дата (период) поставки</td>
        <td colspan="1" class="bordered small">402</td>
        <td colspan="9" class="small center">Вид поставки</td>
        <td colspan="1" class="bordered small">403</td>
        <td colspan="9" class="border-right small center">Форма оплаты</td>
        <td colspan="1" class="bordered small">404</td>
        <td colspan="9" class="border-right small center">Примечание</td>
    </tr>
    <tr class="border-bottom">
        <td colspan="1"  class="border-left border-bottom">&nbsp;</td>
        <td colspan="9" class="border-bottom"><?php echo date_format(new DateTime($data->requisites_creating_date_time), 'd.m.Y'); ?></td>
        <td colspan="1"  class="border-left border-bottom">&nbsp;</td>
        <td colspan="9"  class="border-bottom">Облагаемая 12%</td>
        <td colspan="1"  class="border-left border-bottom">&nbsp;</td>
        <td colspan="9" class="border-right border-bottom">Безналичный</td>
        <td colspan="1"  class="border-left border-bottom">&nbsp;</td>
        <td colspan="9" class="border-right border-bottom"></td>
    </tr>

    <tr>
        <td colspan="1" class="bordered small">405</td>
        <td colspan="13" class="small center">Договор (контракт) реализацию (поставку) работ и услуг</td>
        <td colspan="1" class="bordered small">406</td>
        <td colspan="13" class="small center">Корректировка к счету-фактуре</td>
        <td colspan="1" class="bordered small">407</td>
        <td colspan="11" class="border-right small center">Причина корректировки</td>
    </tr>
    <tr>
        <td colspan="1" class="border-left"></td>
        <td colspan="13">№____________________________</td>
        <td colspan="1" class="border-left"></td>
        <td colspan="13">№____________________________</td>
        <td colspan="1" class="border-left"></td>
        <td colspan="11" class="border-right"></td>
    </tr>
    <tr>
        <td colspan="1" class="border-left border-bottom"></td>
        <td colspan="13" class="border-bottom">Дата:</td>
        <td colspan="1" class="border-left border-bottom"></td>
        <td colspan="13" class="border-bottom">Дата:</td>
        <td colspan="1" class="border-left border-bottom"></td>
        <td colspan="11" class="border-bottom border-right"></td>
    </tr>

    <tr class="bordered small">
        <td colspan="40" class="center">Раздел 3. Информация о товаре</td>
    </tr>

    <tr>
        <td colspan="40" class="border-left border-right">&nbsp;</td>
    </tr>
    <tr class="small">
        <td colspan="14" class="border-left">
        <td colspan="5" class="center border-bottom">417</td>
        <td colspan="1"></td>
        <td colspan="1"></td>
        <td colspan="5" class="center border-bottom">1,000</td>
        <td colspan="3"></td>
        <td colspan="1" class="bordered"></td>
        <td colspan="10" class="border-right">&nbsp;Товар, подлежащий &nbsp;прослежеваемости</td>
    </tr>
    <tr class="small">
        <td colspan="14" class="border-left">
        <td colspan="5" class="center">Код валюты</td>
        <td colspan="1"></td>
        <td colspan="1"></td>
        <td colspan="5" class="center">Курс валюты</td>
        <td colspan="14" class="border-right"></td>
    </tr>

    <tr class="td-bordered td-center">
        <th colspan="1" class="small" rowspan="2">№ п/п</th>
        <th class = "small" colspan="3" rowspan="2">Код товара (ТН ВЭД)</th>
        <th class = "small" colspan="6" rowspan="2">Наименование товара</th>
        <th class="small" colspan="3" rowspan="2">Единица измерения</th>
        <th class="small" colspan="3" rowspan="2">Цена за единицу</th>
        <th class="small" colspan="3" rowspan="2">Количество (объем)</th>
        <th class = "small" colspan="5" rowspan="2">Стоимость товара без НДС и НсП</th>
        <th class = "small" colspan="4">НДС</th>
        <th class = "small" colspan="4">НсП</th>
        <th class = "small" colspan="3" rowspan="2">Общая стоимость товара</th>
        <th class="small" colspan="6" rowspan="2">Реквизиты таможенной декларации или заявления о ввозе товаров и уплате косвенных налогов (FORM STI-136) или ЭСФ</th>
    </tr>
    <tr class="td-bordered td-center">
        <th class="small" colspan="2">Ставка</th>
        <th class="small" colspan="2">Сумма</th>
        <th class="small" colspan="2">Ставка</th>
        <th class="small" colspan="2">Сумма</th>
    </tr>

    <?php $Sum = 0; $price_count = 0;?>
    <?php $addcount = 7 - count($data_invoice); ?>
    <?php foreach ($data_invoice as $key => $Record) : ?>
        <?php if ($Record->id_inventory == 2): //если токен?>
            <tr class="td-bordered">
                <td colspan="1"><?= $key+1 ?></td>
                <td colspan="3" class="center"></td>
                <td colspan="6"><?php echo $Record->inventory_name; ?></td>
                <td colspan="3" class="right">Штука</td>
                <td colspan="3" class="right"><?= number_format($Record->price_count / $Record->count, 2,',','' ) ?></td>
                <td colspan="3" class="right"><?= number_format($Record->count, 2, ',','') ?></td>
                <td colspan="5" class="right"><?php echo number_format($Record->price_count / 1.12, 2, ',', ''); ?></td>
                <td colspan="2" class="right">12,00</td>
                <td colspan="2" class="right"><?php echo number_format($Record->price_count * 12 / 112, 2, ',', ''); ?></td>
                <td colspan="2" class="right">0,00</td>
                <td colspan="2" class="right">0,00</td>
                <td colspan="3" class="right"><?php echo number_format($Record->price_count, 2, ',', ''); ?></td>
                <td colspan="6"></td>
            </tr>
            <?php $Sum += $Record->price_count; $price_count = $Record->price_count;?>
        <?php endif;?>
    <?php endforeach; ?>

    <tr class="td-bordered">
        <td colspan="14" class="right">ИТОГО ПО СЧЕТУ-ФАКТУРЕ:&nbsp; &nbsp;</td>
        <td colspan="10" class="right"><?php echo number_format($Sum / 1.12, 2, ',', ''); ?></td>
        <td colspan="2" class="center">X</td>
        <td colspan="2" class="right"><?php echo number_format($price_count * 12 / 112, 2, ',', ''); ?></td>
        <td colspan="2" class="center">X</td>
        <td colspan="2" class="right">0,00</td>
        <td colspan="3" class="right"><?php echo number_format($Sum, 2, ',', ''); ?></td>
        <td colspan="6" class="center">X</td>
    </tr>

    <tr>
        <td colspan="5" class = "bordered" rowspan="4"><br/><b>&nbsp; &nbsp;М.П.</b><br/><br/><br/></td>
        <td colspan="1" class="bordered center small">450</td>
        <td colspan="34" class="border-right"></td>
    </tr>
    <tr>
        <td colspan="1" class="border-bottom"></td>
        <td colspan="10" class="border-bottom large">Ф.И.О руководителя организации или индивидуального предпринимателя</td>
        <td colspan="24" class="border-bottom border-right"></td>
    </tr>
    <tr>
        <td colspan="1" class="bordered center small">451</td>
        <td colspan="34" class="border-right"></td>
    </tr>
    <tr>
        <td colspan="1" class="border-bottom"></td>
        <td colspan="10" class="border-bottom large">Ф.И.О бухгалтера</td>
        <td colspan="24" class="border-bottom border-right"></td>
    </tr>
    </tbody>
</table>

</body>
</html>