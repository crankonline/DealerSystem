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
            font-size: 9px;
        }

        table.concept {
            border-collapse: collapse;
            width: 800px;
        }

        table.concept td {
            min-width: 2.5%;  width: 2.5%;  max-width:  2.5%;
            padding-left: 0px;
            padding-right: 0px;
            padding-bottom: 0px;
            padding-top: 0px;
            margin: 1px;
        }

        table.concept tr.large td {
            font-size: 13px;
            padding-left: 0px;
            padding-right: 0px;
            padding-bottom: 0px;
            padding-top: 0px;
            margin: 1px;
        }

        table.concept td[colspan="1"]  { min-width: 2.5%;   width: 2.5%;  max-width: 2.5%;  }
        table.concept td[colspan="2"]  { min-width: 5%;     width: 5%;    max-width: 5%;    }
        table.concept td[colspan="3"]  { min-width: 7.5%;   width: 7.5%;  max-width: 7.5%;  }
        table.concept td[colspan="4"]  { min-width: 10%;    width: 10%;   max-width: 10%;   }
        table.concept td[colspan="5"]  { min-width: 12.5%;  width: 12.5%; max-width: 12.5%; }
        table.concept td[colspan="6"]  { min-width: 15%;    width: 15%;   max-width: 15%;   }
        table.concept td[colspan="7"]  { min-width: 17.5%;  width: 17.5%; max-width: 17.5%; }
        table.concept td[colspan="8"]  { min-width: 20%;    width: 20%;   max-width: 20%;   }
        table.concept td[colspan="9"]  { min-width: 22.5%;  width: 22.5%; max-width: 22.5%; }
        table.concept td[colspan="10"] { min-width: 25%;    width: 25%;   max-width: 25%;   }
        table.concept td[colspan="11"] { min-width: 27.5%;  width: 27.5%; max-width: 27.5%; }
        table.concept td[colspan="12"] { min-width: 30%;    width: 30%;   max-width: 30%;   }
        table.concept td[colspan="13"] { min-width: 32.5%;  width: 32.5%; max-width: 32.5%; }
        table.concept td[colspan="14"] { min-width: 35%;    width: 35%;   max-width: 35%;   }
        table.concept td[colspan="15"] { min-width: 37.5%;  width: 37.5%; max-width: 37.5%; }
        table.concept td[colspan="16"] { min-width: 40%;    width: 40%;   max-width: 40%;   }
        table.concept td[colspan="17"] { min-width: 42.5%;  width: 42.5%; max-width: 42.5%; }
        table.concept td[colspan="18"] { min-width: 45%;    width: 45%;   max-width: 45%;   }
        table.concept td[colspan="19"] { min-width: 47.5%;  width: 47.5%; max-width: 47.5%; }
        table.concept td[colspan="20"] { min-width: 50%;    width: 50%;   max-width: 50%;   }
        table.concept td[colspan="21"] { min-width: 52.5%;  width: 52.5%; max-width: 52.5%; }
        table.concept td[colspan="40"] { min-width: 100%;   width: 100%;  max-width: 100%;  }


        .small {
            font-size: 9px;
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
            <td colspan="9">
                <b>BLANK STI - 004</b><br/>
                Кыргызская Республика
            </td>
            <td colspan="21" class="center">
                <b>СЧЕТ-ФАКТУРА НДС</b><br/>
                (электрическая связь)
            </td>
            <td colspan="10" class="center">
                Приложение 5<br/>
                Утверждено<br/>
                постановлением Правительства<br/>
                Кыргызской Республики<br/>
                от ________________ № _______
            </td>
        </tr>
        <tr>
            <td colspan="40" class="border-bottom">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="40"></td>
        </tr>

        <tr class="large">
            <td colspan="4" class="bordered center">101</td>
            <td colspan="11"><b>СЕРИЯ: <?php echo $data->serial; ?></b></td>
            <td colspan="2" class="bordered center">102</td>
            <td colspan="11"><b>НОМЕР: <?php echo $data->number; ?></b></td>
            <td colspan="2" class="bordered center">103</td>
            <td colspan="12"><b>ДАТА: <?php echo date("Y.m.d H:i:s", strtotime($data->requisites_creating_date_time)); ?></b></td>
        </tr>
        <tr>
            <td colspan="20"><b>Номер клиента: </b></td>
            <td colspan="20"><b>Номер вышестоящего клиента: </b></td>
        </tr>
        <tr class="small">
            <td colspan="1" class="bordered small center">201</td>
            <td colspan="19" class="border-top" >ПОСТАВЩИК</td>
            <td colspan="1" class="bordered small center">301</td>
            <td colspan="19" class="border-top border-right" >ПОКУПАТЕЛЬ</td>
        </tr>



        <tr>
            <td colspan="1" class="border-left border-bottom" ></td>
            <td colspan="19" class="border-bottom" >ИНН <?php echo $data->inn; ?></td>
            <td colspan="1" class="border-left border-bottom" ></td>
            <td colspan="19" class="border-bottom border-right" >ИНН <?php echo $json->main->inn; ?></td>
        </tr>

        <tr class="small">
            <td colspan="1" class="bordered small center">202</td>
            <td colspan="19" class="small border-right">Наименование</td>
            <td colspan="1" class="bordered small center">302</td>
            <td colspan="19" class="small border-right">Наименование</td>
        </tr>
        <tr>
            <td colspan="1" class="border-left border-bottom"></td>
            <td colspan="19" class="border-right border-bottom"><?php echo $data->full_name; ?></td>
            <td colspan="1" class="border-bottom"></td>
            <td colspan="19" class="border-right border-bottom"><?php echo $json->main->name; ?></td>
        </tr>
        <tr class="small">
            <td colspan="1" class="bordered small center">203</td>
            <td colspan="19" class="border-right small">Адрес</td>
            <td colspan="1" class="bordered small center">303</td>
            <td colspan="19" class="border-right small">Адрес</td>
        </tr>
        <tr>
            <td colspan="1" class="border-left border-bottom"></td>
            <td colspan="19" class="border-right border-bottom"><?php echo $data->address; ?></td>
            <td colspan="1" class="border-bottom"></td>
            <td colspan="19" class="border-right border-bottom"><?php

                //            echo PdfCreate::get_reference_byid();


                //            $Data['json']['contacts']['juristic_address']['region'] = $Address->region;
                //            $Data['json']['contacts']['juristic_address']['district'] = $Address->district;
                //            $Data['json']['contacts']['juristic_address']['settlement'] = $Address->settlement;

                //            echo implode(
                //                ', ', [
                //                $json->contacts->juristic_address->region,
                //                $json->contacts->juristic_address->district,
                //                $json->contacts->juristic_address->settlement,
                //                $json->contacts->juristic_address->street,
                //                $json->contacts->juristic_address->building,
                //                $json->contacts->juristic_address->apartment
                //            ]);

                ?></td>
        </tr>
        <tr>
            <td colspan="1" class="small bordered">204</td>
            <td colspan="2" rowspan="2" class="small border-bottom">Код налогового органа</td>
            <td colspan="1" rowspan="2" class="center bordered"><?php echo $data->sti_code{0};?></td>
            <td colspan="1" rowspan="2" class="center bordered"><?php echo $data->sti_code{1};?></td>
            <td colspan="1" rowspan="2" class="center bordered"><?php echo $data->sti_code{2};?></td>
            <td colspan="14" class="small">Наименование налогового органа</td>

            <td colspan="1" class="small bordered">304</td>
            <td colspan="2" rowspan="2" class="small border-bottom">Код налогового органа</td>
            <td colspan="1" rowspan="2" class="center bordered"><?php echo $json->reporting->sfregion{0}; ?></td>
            <td colspan="1" rowspan="2" class="center bordered"><?php echo $json->reporting->sfregion{1}; ?></td>
            <td colspan="1" rowspan="2" class="center bordered"><?php echo $json->reporting->sfregion{2}; ?></td>
            <td colspan="14" class="small border-right">Наименование налогового органа</td>
        </tr>
        <tr>
            <td colspan="6" class="border-left border-bottom"></td>
            <td colspan="14" class="border-left border-bottom" >ГНИ Ленинского района</td>
            <td colspan="6" class="border-left border-bottom"></td>
            <td colspan="14" class="border-left border-bottom border-right" ><?php //echo $Region->name; ?></td>
        </tr>
        <tr>
            <td colspan="1" class="bordered small center">205</td>
            <td colspan="10" class="small">Код (БИК) и наименование банка</td>
            <?php $biclengthdist = strlen($data->bank_bik); /* 6 */?>
            <?php for($i = 0; $i < $biclengthdist; $i++): ?>
                <td class = "center bordered" rowspan="2" colspan="1"><?php echo $data->bank_bik{$i}; ?></td>
            <?php endfor; ?>
            <td class = "center bordered" rowspan="2" colspan="1"></td>
            <td class = "center bordered" rowspan="2" colspan="1"></td>
            <td class = "center bordered" rowspan="2" colspan="1"></td>

            <td colspan="1" class="bordered small center">305</td>
            <td colspan="10" class="small">Код (БИК) и наименование банка</td>
            <?php $biclength = strlen($json->bank->bic); /* 6 */ ?>
            <?php for($i = 0; $i < $biclength; $i++): ?>
                <td class = "center bordered" rowspan="2" colspan="1"><?php echo $json->bank->bic{$i}; ?></td>
            <?php endfor; ?>
            <td class = "center bordered" rowspan="2" colspan="1"></td>
            <td class = "center bordered" rowspan="2" colspan="1"></td>
            <td class = "center bordered" rowspan="2" colspan="1"></td>
        </tr>


        <tr>
            <td class="border-left border-bottom"></td>
            <td colspan="10" class="border-bottom" ><?php echo $data->bank_name; ?></td>
            <td class="border-left border-bottom"></td>
            <td colspan="10" class="border-bottom" ><?php echo $json->bank->bankname; ?></td>
        </tr>

        <tr>
            <td colspan="1" class="bordered small">206</td>
            <td colspan="3" rowspan="2" class="small border-bottom">Расчетный счет</td>

            <?php $obalength = strlen($data->bank_account); //echo "<td>".$obalength."</td>"; /* 16 */?>
            <?php for($i = 0; $i < $obalength; $i++): ?>
                <td class="center bordered" rowspan = "2" colspan="1"><?php echo $data->bank_account{$i}; ?></td>
            <?php endfor; ?>

            <td colspan="1" class="bordered small">306</td>
            <td colspan="3" rowspan="2" class="small border-bottom">Расчетный счет</td>


            <?php $balength = strlen($json->bank->account); //echo "<td>".$balength."</td>";/* 16 */ ?>
            <?php for($i = 0; $i < $balength; $i++): ?>
                <td class="center bordered" rowspan = "2" colspan="1"><?php echo $json->bank->account{$i}; ?></td>
            <?php endfor; ?>
        </tr>


        <tr class="border-bottom">
            <td class="border-left border-bottom">&nbsp;</td>
            <td class="border-left border-bottom">&nbsp;</td>
        </tr>
    </tbody>
</table>
<table class="concept">
    <tbody>
        <tr>
            <td colspan="1" class="bordered small">401</td>
            <td colspan="12">Дата (период) поставки</td>
            <td colspan="1" class="bordered small">402</td>
            <td colspan="9">Вид поставки</td>
            <td colspan="1" class="bordered small">403</td>
            <td colspan="16" class="border-right">Форма оплаты</td>
        </tr>

        <tr class="border-bottom">
            <td colspan="1"  class="border-left border-bottom">&nbsp;</td>
            <td colspan="12" class=" border-bottom"><?php echo $data->requisites_creating_date_time; ?></td>
            <td colspan="1"  class="border-left border-bottom">&nbsp;</td>
            <td colspan="9"  class=" border-bottom">&nbsp;</td>
            <td colspan="1"  class="border-left border-bottom">&nbsp;</td>
            <td colspan="16" class="border-right border-bottom">перечислением</td>
        </tr>


        <tr>
            <td class="bordered small" colspan="1">404</td>
            <td colspan="19">Корректировка к счету-фактуре</td>
            <td class="bordered small" colspan="1">405</td>
            <td colspan="19" class="border-right">Причины корректировки</td>
        </tr>

        <tr class="border-bottom">
            <td class="border-left border-bottom">&nbsp;</td>
            <td colspan="19" class="border-right border-bottom">&nbsp;</td>
            <td class=" border-bottom"></td>
            <td colspan="19" class="border-right border-bottom">&nbsp;</td>
        </tr>

    </tbody>
</table>
<table class="concept">
    <tbody>
        <tr class="td-bordered td-center">
            <th class = "small" colspan="3" rowspan="2">Код группы товаров</th>
            <th class = "small" colspan="7" rowspan="2">Наименование услуг и товаров</th>
            <th class = "small" colspan="3" rowspan="2">Единица изме-ия</th>
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
        <?php $addcount = count($data_invoice); ?>
        <?php foreach($data_invoice as $Record) : ?>

        <tr class="td-bordered">
            <td colspan="3" class="center">&nbsp; </td>
            <td colspan="7"><?php echo $Record->inventory_name; ?></td>
            <td colspan="3" class="center">шт.</td>
            <td colspan="3" class="center"><?php echo $Record->count; ?></td>
            <td colspan="3" class="center"><?php echo number_format(($Record->price_count / $Record->count) / 1.12, 2, '.', ''); ?></td>
            <td colspan="4" class="center"><?php echo number_format($Record->price_count / 1.12, 2, '.', ''); ?></td>
            <td colspan="2" class="center">12</td>
            <td colspan="4" class="center"><?php echo number_format($Record->pay_sum * 12 / 112, 2, '.', ''); ?></td>
            <td colspan="2" class="center">0</td>
            <td colspan="4" class="center">0</td>
            <td colspan="5" class="center"><?php echo number_format($Record->price_count, 2, '.', ''); ?></td>
        </tr>


        <?php $Sum += $Record->price_count; ?>
        <?php endforeach; ?>

        <tr class="td-bordered">
            <td colspan="19" class="right"><b>ИТОГО &nbsp; &nbsp;</b></td>
            <td colspan="4" class="center"><?php echo number_format($Sum / 1.12, 2, '.', ''); ?></td>
            <td colspan="2" class="center">X</td>
            <td colspan="4" class="center"><?php echo number_format($Sum * 12 / 112, 2, '.', ''); ?></td>
            <td colspan="2" class="center">X</td>
            <td colspan="4" class="center">0</td>
            <td colspan="5" class="center"><?php echo number_format($Sum, 2, '.', ''); ?></td>
        </tr>
        <tr>
            <td colspan="6"><br/><b>&nbsp; &nbsp;М.П.</b><br/><br/><br/></td>
            <td colspan="16"><br/><b>РУКОВОДИТЕЛЬ:</b><br/><br/><br/></td>
            <td colspan="18"><br/><b>ГЛАВНЫЙ БУХГАЛТЕР:</b><br/><br/><br/></td>
        </tr>
        <tr>
            <td colspan="40" class="bordered">
                <br/>
                <b>Примечание:</b><br/>
                1) Счет-фактура НДС (BLANK STI – 004) оформляется облагаемым субъектом при оказании услуг электрической связи, а также при поставке товаров, которые являются частью таких услуг согласно статье 232 НК КР.
                <br/>
                2) В графе «Наименование услуг и товаров» поставщиком указываются те виды услуг и товаров, являющихся частью таких услуг, которые фактически им оказаны.
                <br/>
                3) Облагаемый субъект может указывать любые дополнительные сведения справочного или информационного характера.
                <br/>
                4) Не заполненные строки счет-фактуры НДС (BLANK STI – 004) обозначаются знаком «Х».
                <br/>
                5) Счет-фактура НДС (BLANK STI – 004) без печати, подписи руководителя и главного бухгалтера облагаемого субъекта, а также не содержащий все обязательные реквизиты, недействителен.
                <br/>
                6) Счет-фактура НДС (BLANK STI – 004) должен быть оформлен в 2-х экземплярах на 1-ом листе и содержать идентичную информацию: 1 экземпляр хранится у покупателя, 2- у поставщика.
                <br/>
                7) Лица за изготовление или сбыт поддельных счет-фактур, а также за замену, изменения, переделку и подделку счет-фактур НДС несут ответственность в соответствии со статьей 203	Уголовного кодекса Кыргызской Республики и статьей 310 Кодекса Кыргызской Республики об административной ответственности.
                <br/>
            </td>
        </tr>


    </tbody>
</table>

</body>
</html>


