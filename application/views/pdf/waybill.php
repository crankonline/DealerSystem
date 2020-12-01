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
                width: 700px;
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
            table.concept tr.border td{
                border-bottom: solid;
                border-width: thin;
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
            .title {
                font-size: 20px;
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

                <tr class="border">
                    <td colspan="15" class="title" style="border-bottom: solid; border-width: thin;">
                        <b>Расходная накладная от</b>
                    </td>
                    <td colspan="12" class="title">
                        <b><?php echo (new \DateTime($data->requisites_creating_date_time))->format('d.m.Y'); ?></b>
                    </td>
                    <td colspan="15"></td>
                </tr>
                <tr>
                    <td height="10" colspan="40"></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="large">
                    <td colspan="10">Поставщик:</td>
                    <td colspan="30"><b>ОсОО "DOS TEK GROUP"</b> (ОсОО "Дос Тэк Групп")
                        <br>со Основной склад</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="40" height="10"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="large">
                    <td colspan="10">Покупатель:</td>
                    <td colspan="29"><b><?= $json->common->name; ?></b></td>
                    <td></td>
                </tr>
                <tr>
                    <td height="10" colspan="40"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="large">
                    <td colspan="10">Комментарий:</td>
                    <td colspan="29">Оплата за Token</td>
                    <td></td>
                </tr>
                <tr>
                    <td height="12"></td>
                    <td></td>
                    <td></td>
                </tr>
                <!-- Табличная часть -->
                <tr class="large td-bordered td-center">
                    <td colspan="2"><b>№ п/п</b></td>
                    <td colspan="5"><b>Код</b></td>
                    <td colspan="13"><b>Товар</b></td>
                    <td colspan="9"><b>Количесвто</b></td>
                    <td colspan="8"><b>Цена</b></td>
                    <td colspan="5"><b>Сумма</b></td>                   
                </tr>
                 <?php $Sum = 0; ?>
                <?php foreach ($data_invoice as $key => $Record) : ?>
                    <?php if (in_array($Record->id_inventory, [2,7])): //если токен?>
                        <tr class="large td-bordered">
                            <td class="center" colspan="2">1</td>
                            <td class="center" colspan="5">00000056</td>
                            <td class="center" colspan="13">Рутокен ЭЦП64КБ</td>
                            <td class="right" colspan="9"><?= number_format($Record->count, 2, ',', '') ?></td>
                            <td class="right" colspan="8"><?= number_format($Record->price_count / $Record->count, 2, ',', ''); ?></td>
                            <td class="right" colspan="5"><?= number_format($Record->price_count, 2, ',', ''); ?></td>
                        </tr>
                        <?php $Sum = $Record->price_count; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <tr>
                    <td height="10"></td>
                </tr>
                <!-- Подвал -->
                <tr class="large">
                    <td colspan="27"></td>
                    <td colspan="10" align="right"><b>Итого:</b></td>
                    <td colspan="5" align="right"><?= number_format($Sum, 2, ',', ''); ?></td>
                </tr>
                <tr class="large">
                    <td colspan="27"></td> 
                    <td colspan="10" align="right"><b>В том числе НДС:</b></td>
                    <td colspan="5" align="right"><?= number_format(($Sum * 12 / 112), 2, ',', ''); ?></td>
                </tr>
                <tr>
                    <td height="12" colspan="42"></td>
                </tr>
                <tr class="large">
                    <td colspan="42">Всего наименований 1, на сумму <?= number_format($Sum, 2, ',', ''); ?></td>
                </tr>
<!--                <tr class="large">
                    <td colspan="42"><b>Одна тысяча девятьсот тридцать пять сом 00 тыйын</b></td>
                </tr>-->
                <tr>
                    <td height="15" colspan="42"></td>
                </tr>
                <tr class="large">
                    <td colspan="26"><b>Руководитель</b></td>
                    <td colspan="16"><b>Бухгалтер/менеджер</b></td>
                </tr>
                <tr>
                    <td height="45" colspan="42"></td>
                </tr>
                <tr class="large">
                    <td colspan="26"><b>Отпустил _________________________________</b></td>
                    <td colspan="16"><b>Получил _________________________________</b></td>                    
                </tr>

            </tbody>
        </table>

    </body>
</html>