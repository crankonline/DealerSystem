<!-- счет на оплату -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
//echo "<pre>";
////var_dump($this->_ci_cached_vars);
//print_r( $data );
//echo "</pre>";
////die();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style type="text/css">

        * {
            font-family: Times, "Times New Roman"; /*Calibri, Tahoma, Sans;*/
        }

        .date{
            width: 100%;
            text-align: center;
            border-collapse: collapse;
            border: 0px;
        }
        .date td{
            border: 0px;
        }

        .date .inline{
            border: 0px;
            border-bottom: solid 1px black;
            text-align: left;
            font-size: 21px;
            font-weight: bold;
        }
        .table_border{
            width: 100%;
            border-collapse: collapse;
            text-indent: 8px;
            margin: 0px;
            text-align: center;
        }
        .table_border td{
            border: solid 1px black;
        }
        .details td{
            padding: 5px 0px;
        }
        table td{
            font-size: 12px;
            font-family: Times, "Times New Roman"; /*Calibri, Tahoma, Sans;*/
        }
        .down{
            vertical-align: bottom;
        }
        .bold{
            font-weight: bold;
            text-align: left;
        }
        .right{
            text-align: right;
        }
        .left{
            text-align: left;
        }
    </style>
</head>
<body>
<htmlpagefooter name="myFooter" style="display:none">
    <div align="center" style="padding: 20px;">Страница {PAGENO}</div>
</htmlpagefooter>

<sethtmlpagefooter name="myFooter" />
<table class="date">
    <tr>
        <td width="673" class="inline">Счет на оплату № <?php echo $data['0']->invoice_serial_number; ?> от <?php echo $data['0']->creating_date_time; ?></td>
        <td width="393" class="barcode"><!--barcode--></td>
    </tr>
</table>
<table class="details" style="width: 100%; margin-top: 10px;">
    <tr>
        <td width="20%" class="down">Поставщик</td>
        <td width="50%"><b><?php echo $data['0']->bank; ?></b></td>
    </tr>
    <tr>
        <td class="down">Покупатель</td>
        <td><b>ИНН <?php echo $data[0]->inn.", ".$data['0']->company_name; ?></b></td>
    </tr>
    <tr>
        <td>Комментарий </td>
        <td><b><i>В НАЗНАЧЕНИИ ПЛАТЕЖА УКАЖИТЕ ИНН ВАШЕЙ КОМПАНИИ</i></b></td>
    </tr>
</table>
<table class="table_border">
    <tr>
        <td class="bold" width="5%">№ п/п</td>
        <td class="bold" width="25%">Наименование</td>
        <td class="bold" width="10%">Количество</td>
        <td class="bold" width="15%">Цена</td>
        <td class="bold" width="15%">Сумма</td>
    </tr>
    <?php $all = 0; $count = 1;?>
    <?php foreach ($data as $invoice) : ?>
        <tr>
            <td height="18"><?php echo $count++ ; ?></td>
            <td><?php echo $invoice->inventory_name; ?></td>
            <td><?php echo $invoice->count; ?></td>
            <td><?php echo number_format($invoice->price, 2, '.', ' '); ?></td>
            <td><?php echo number_format($invoice->price_count, 2, '.', ' '); $all += $invoice->price_count; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<table style="width: 100%; margin-top: 5px;">
    <tr>
        <td width="50%" style="font-size: 9px;">* Действителен в течении 7 банковских дней!</td>
        <td width="14%" class="right"><b>Итого:</b></td>
        <td width="16%" class="right"><b><?php echo number_format($all, 2, '.', ' '); ?></b></td>
    </tr>
    <?php $SumWithout = $all / 1.14; ?>
    <?php /*
					<tr>
						<td></td>
						<td class="right"><b>в том числе НДС:</b></td>
						<td class="right"><b><?php echo number_format($SumWithout * 0.12, 2, '.', ' '); ?></b></td>
					</tr>
					<tr>
						<td></td>
						<td class="right"><b>в том числе НСП:</b></td>
						<td class="right"><b><?php echo number_format($SumWithout * 0.02, 2, '.', ' '); ?></b></td>
					</tr> */ ?>
</table>

<table class="details" style="margin-top: 5px;">
    <tr>
        <td width="30px"></td>
        <td class="left">Всего наименований <?php $count--; echo $count; ?>, на сумму <?php echo number_format($all, 2, '.', ''); ?> сом</td>
    </tr>
    <tr>
        <td></td>
        <td class="left"><b><?php echo mb_convert_case(PdfCreate::num2str($all),MB_CASE_TITLE, "UTF-8"); ?></b></td>
    </tr>
</table>
<div style="position: absolute;; width: 700px;">
    <table class="details" style="margin-top: 5px;">
        <tr>
            <td width="30px"></td>
            <td class="bold" style="padding-bottom: 25px">Оператор </td>
            <td width="180" height="80" style="padding: 5px"><?php /* <img src="resources/img/invoice/signature.png"  width="130" height="60" alt=""> */ ?></td>
            <td style="padding-bottom: 25px">М.П.</td>
        </tr>
    </table>
</div>
<div style="position: relative; width: 700px;">
    <?php /* <img style="padding: 45px 0px 0px 240px;" src="resources/img/invoice/stamp.png"  width="130" height="130" alt=""> */ ?>

</div>
</body>
</html>