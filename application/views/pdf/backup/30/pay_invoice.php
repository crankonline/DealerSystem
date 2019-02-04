<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
	<html>
		<head>
			<title></title>
			<meta charset="utf-8">
			<style type="text/css">
				.bordered { border: 1px solid #000; }
.bold { font-weight: bold; }
				.italic { font-style: italic; }
				.center { text-align: center; }
				* { font-family: Arial; }
				.right { text-align: right; }
				td { font-size: 10px; }
				html, body { padding: 0px; margin: 0px; }


				table.tabledata {
    border-collapse: collapse;
					width: 100%;
				}

				table.tabledata tr td,
				table.tabledata tr th {
    border: 1px solid black;
				}

				table.tabledata tr th {
    font-size: 9px;
				}

			</style>
		</head>
		<body>
			<h3 class = "left">Счет-фактура</h3>
			<table style="width: 100%; border-collapse: collapse;">
				<tr>
					<td></td>
					<td style = "width: 30px;" class="bordered center">104</td>
					<td style = "width: 40px;" class="bold italic center">Номер</td>
					<td style = "width: 50px;" class="bold italic center"><?php echo $Data['id']; ?></td>
<td class = "center" style = "width: 52px;"></td>
<td class = "center bordered" style = "width: 30px;">103</td>
<td class = "center bold italic" style = "width: 50px;">ДАТА</td>
<td class = "center" style = "width: 40px;"></td>
<td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{0}; ?></td>
<td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{1}; ?></td>
<td class = "center" style = "width: 12px;"></td>
<td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{2}; ?></td>
<td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{3}; ?></td>
<td class = "center" style = "width: 12px;"></td>
<td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{4}; ?></td>
<td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{5}; ?></td>
<td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{6}; ?></td>
<td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{7}; ?></td>
</tr>
</table>
<br/>
<table style="border-collapse: collapse;">
    <tr>
        <td class="bordered" colspan="3">Поставщик</td>
        <td class="bordered" colspan="4">201 &nbsp; ИНН</td>
        <td class="center bordered" style="width: 20px;">0</td>
        <td class="center bordered" style="width: 20px;">1</td>
        <td class="center bordered" style="width: 20px;">2</td>
        <td class="center bordered" style="width: 20px;">1</td>
        <td class="center bordered" style="width: 20px;">2</td>
        <td class="center bordered" style="width: 20px;">2</td>
        <td class="center bordered" style="width: 20px;">0</td>
        <td class="center bordered" style="width: 20px;">1</td>
        <td class="center bordered" style="width: 20px;">4</td>
        <td class="center bordered" style="width: 20px;">1</td>
        <td class="center bordered" style="width: 20px;">0</td>
        <td class="center bordered" style="width: 20px;">1</td>
        <td class="center bordered" style="width: 20px;">8</td>
        <td class="center bordered" style="width: 20px;">4</td>
        <!-- -->
        <td class="bordered" colspan="3">Покупатель</td>
        <td class="bordered" colspan="4">301 &nbsp; ИНН</td>
        <?php $length = strlen($INN); ?>
        <?php for($i = 0; $i < $length; $i++): ?>
            <td class="center bordered" style="width: 20px;"><?php echo $INN{$i}; ?></td>
        <?php endfor; ?>
    </tr>
    <tr>
        <td class="bordered center" style="width: 30px;">202</td>
        <td class="bordered" colspan="20">ОсОО "Юниверсал Бизнес Репорт"</td>
        <td class="bordered center" style="width: 30px;">302</td>
        <td class="bordered" colspan="20"><?php echo $Data['json']['main']['name']; ?></td>
    </tr>
    <tr>
        <td class="bordered center">203</td>
        <td class="bordered" colspan="20">г.Бишкек ул.Турусбекова 109/1</td>
        <td class="bordered center">303</td>
        <td class="bordered" colspan="20"><?php echo implode(
                ', ', [
                $Data['json']['contacts']['juristic_address']['region'],
                $Data['json']['contacts']['juristic_address']['district'],
                $Data['json']['contacts']['juristic_address']['settlement'],
                $Data['json']['contacts']['juristic_address']['street'],
                $Data['json']['contacts']['juristic_address']['building'],
                $Data['json']['contacts']['juristic_address']['apartment']
            ]); ?></td>
    </tr>
    <tr>
        <td class="bordered center">204</td>
        <td class="bordered"></td>
        <td class="bordered"></td>
        <td class="bordered"></td>
        <td class="bordered"></td>
        <td class="bordered" colspan="16">ГНИ Ленинского района</td>
        <!-- -->
        <td class="bordered center">304</td>
        <td class="bordered"></td>
        <td class="bordered"></td>
        <td class="bordered"></td>
        <td class="bordered"></td>
        <td class="bordered" colspan="16"><?php echo $Region; ?></td>
    </tr>
    <tr>
        <td class="bordered center" style="width: 30px;">205</td>
        <td class="bordered center" style="width: 20px;">1</td>
        <td class="bordered center" style="width: 20px;">2</td>
        <td class="bordered center" style="width: 20px;">4</td>
        <td class="bordered center" style="width: 20px;">0</td>
        <td class="bordered center" style="width: 20px;">0</td>
        <td class="bordered center" style="width: 20px;">1</td>
        <td class="bordered center" style="width: 20px;"></td>
        <td class="bordered center" style="width: 20px;"></td>
        <td class="bordered center" style="width: 20px;"></td>
        <td class="bordered" colspan="11">ОАО "Банк Бакай"</td>
        <!-- -->

        <td class="bordered center">305</td>
        <?php $Bank = $Data['json']['bank']; ?>
        <?php $biclength = strlen($Bank['bic']); ?>
        <?php for($i = 0; $i < $biclength; $i++): ?>
            <td class="bordered center" style="width: 20px;"><?php echo $Bank['bic']{$i}; ?></td>
        <?php endfor; ?>
        <td class="bordered center" style="width: 20px;"></td>
        <td class="bordered center" style="width: 20px;"></td>
        <td class="bordered center" style="width: 20px;"></td>
        <td class="bordered" colspan="11"><?php echo $Bank['bankname']; ?></td>
    </tr>
    <tr>
        <td class="bordered center">206</td>
        <td class="bordered center">1</td>
        <td class="bordered center">2</td>
        <td class="bordered center">4</td>
        <td class="bordered center">2</td>
        <td class="bordered center">0</td>
        <td class="bordered center">0</td>
        <td class="bordered center">0</td>
        <td class="bordered center">2</td>
        <td class="bordered center">0</td>
        <td class="bordered center">0</td>
        <td class="bordered center">0</td>
        <td class="bordered center">1</td>
        <td class="bordered center">5</td>
        <td class="bordered center">4</td>
        <td class="bordered center">5</td>
        <td class="bordered center">3</td>
        <td class="bordered center"></td>
        <td class="bordered center"></td>
        <td class="bordered center"></td>
        <td class="bordered center"></td>
        <!-- -->
        <td class="bordered center">306</td>
        <?php $balength = strlen($Bank['account']); ?>
        <?php for($i = 0; $i < $balength; $i++): ?>
            <td class="bordered center" style="width: 20px;"><?php echo $Bank['account']{$i}; ?></td>
        <?php endfor; ?>
        <td class="bordered center"></td>
        <td class="bordered center"></td>
        <td class="bordered center"></td>
        <td class="bordered center"></td>
    </tr>
</table>

<table style="border-collapse: collapse;">
    <tr>
        <td class="bordered" style="width: 78px;">Дата и</td>
        <td class="bordered center" style="width: 30px;">401</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">1</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">1</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">1</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">1</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">2</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">0</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">1</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">5</td>
        <td class="bordered center" style="width: 7px;" rowspan="2"></td>
        <td class="bordered center" style="width: 30px;">402</td>
        <td class="bordered" style="width: 155px;">002</td>
        <!-- -->
        <td class="bordered" style="width: 121px;" >Способ платежа</td>
        <td class="bordered center" style="width: 30px;" >403</td>
        <td class="bordered" style="width: 325px;" rowspan="2">перечислением</td>
    </tr>
    <tr>
        <td class="bordered" colspan="2">тип поставки</td>
        <td class="bordered"></td>
        <td class="bordered" >Необязательное</td>
        <!-- -->
        <td class="bordered" colspan="2"></td>
    </tr>
</table>
<table style="border-collapse: collapse; margin-top: -1px;">
    <tr>
        <td class="bordered center" style="width: 24px;">404</td>
        <td class="bordered" style="width: 438px;"></td>
        <td class="bordered center" style="width: 24px;">405</td>
        <td class="bordered" style="width: 438px;"></td>
    </tr>
</table>
<br/>

<table class="tabledata" style="width: 100%; border-collapse: collapse;">

    <tr>
        <th rowspan="2">Код<br/>группы</th>
        <th rowspan="2">Наименование товаров<br/>(работ, услуг)</th>
        <th rowspan="2">Ед.изм.</th>
        <th rowspan="2">Количество<br/>(объем)</th>
        <th rowspan="2">Цена<br/>сом</th>
        <th rowspan="2">Стоимость<br/>без НДС</th>
        <th colspan="2">НДС</th>
        <th rowspan="2">Всего стоимость</th>
    </tr>
    <tr>
        <th>Ставка, %</th>
        <th>Сумма (сом)</th>
    </tr>
    <?php
    $Invoice2 = [
        'Name' => 'ЭЦП',
        'Count' => 0,
        'Price' => 0,
        'Sum' => 0
    ];
    ?>
    <?php
    foreach($Invoice as $Record) {
        if($Record['Name'] != 'Рутокен ЭЦП') { continue; }
        $Invoice2['Sum'] += $Record['Sum'];
        $Invoice2['Price'] = $Record['Price'];
        $Invoice2['Count'] += $Record['Count'];
    }
    ?>
    <?php $Sum = 0; ?>
    <tr>
        <td></td>
        <td><?php echo $Invoice2['Name']; ?></td>
        <td>шт.</td>
        <td><?php echo $Invoice2['Count']; ?></td>
        <td><?php echo $Invoice2['Price']; ?></td>
        <td><?php echo $Invoice2['Sum']; ?></td>
        <td>0,00</td>
        <td>0,00</td>
        <td><?php echo $Invoice2['Sum']; ?></td>
    </tr>
    <?php $Sum += $Invoice2['Sum']; ?>
    <tr>
        <td></td>
        <td class="right bold">Итого:</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo number_format($Sum, 2, '.', ''); ?></td>
    </tr>
</table>
<div style="width: 100%;text-align:right;font-size:9pt;"><b><i>Всего: <?php echo static::mb_ucfirst(\Classes\Num2Str::num2str($Sum), 'UTF-8'); ?></i></b></div>
<br/>
<table style="width: 100%;">
    <tr>
        <td style="width: 20%; vertical-align: top;" class="center bold">ПОСТАВЩИК<br>М.П.</td>
        <td style="width: 40%; vertical-align: top;" class="bold">Руководитель:<br><br><br>Гл.бухгалтер</td>
        <td></td>
        <td style="width: 30%; vertical-align: top;" class="bold">Покупатель:</td>
    </tr>
</table>

<br/><br/>
<br/><br/>
<br/><br/>
<h3 class = "left">Счет-фактура</h3>
<table style="width: 100%; border-collapse: collapse;">
    <tr>
        <td></td>
        <td style = "width: 30px;" class="bordered center">104</td>
        <td style = "width: 40px;" class="bold italic center">Номер</td>
        <td style = "width: 50px;" class="bold italic center"><?php echo $Data['id']; ?>/1</td>
        <td class = "center" style = "width: 52px;"></td>
        <td class = "center bordered" style = "width: 30px;">103</td>
        <td class = "center bold italic" style = "width: 50px;">ДАТА</td>
        <td class = "center" style = "width: 40px;"></td>
        <td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{0}; ?></td>
        <td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{1}; ?></td>
        <td class = "center" style = "width: 12px;"></td>
        <td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{2}; ?></td>
        <td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{3}; ?></td>
        <td class = "center" style = "width: 12px;"></td>
        <td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{4}; ?></td>
        <td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{5}; ?></td>
        <td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{6}; ?></td>
        <td class = "center bordered" style = "width: 20px;"><?php echo $InvoiceDate{7}; ?></td>
    </tr>
</table>
<br/>
<table style="border-collapse: collapse;">
    <tr>
        <td class="bordered" colspan="3">Поставщик</td>
        <td class="bordered" colspan="4">201 &nbsp; ИНН</td>
        <td class="center bordered" style="width: 20px;">0</td>
        <td class="center bordered" style="width: 20px;">1</td>
        <td class="center bordered" style="width: 20px;">2</td>
        <td class="center bordered" style="width: 20px;">1</td>
        <td class="center bordered" style="width: 20px;">2</td>
        <td class="center bordered" style="width: 20px;">2</td>
        <td class="center bordered" style="width: 20px;">0</td>
        <td class="center bordered" style="width: 20px;">1</td>
        <td class="center bordered" style="width: 20px;">4</td>
        <td class="center bordered" style="width: 20px;">1</td>
        <td class="center bordered" style="width: 20px;">0</td>
        <td class="center bordered" style="width: 20px;">1</td>
        <td class="center bordered" style="width: 20px;">8</td>
        <td class="center bordered" style="width: 20px;">4</td>
        <!-- -->
        <td class="bordered" colspan="3">Покупатель</td>
        <td class="bordered" colspan="4">301 &nbsp; ИНН</td>
        <?php $length = strlen($INN); ?>
        <?php for($i = 0; $i < $length; $i++): ?>
            <td class="center bordered" style="width: 20px;"><?php echo $INN{$i}; ?></td>
        <?php endfor; ?>
    </tr>
    <tr>
        <td class="bordered center" style="width: 30px;">202</td>
        <td class="bordered" colspan="20">ОсОО "Юниверсал Бизнес Репорт"</td>
        <td class="bordered center" style="width: 30px;">302</td>
        <td class="bordered" colspan="20"><?php echo $Data['json']['main']['name']; ?></td>
    </tr>
    <tr>
        <td class="bordered center">203</td>
        <td class="bordered" colspan="20">г.Бишкек ул.Турусбекова 109/1</td>
        <td class="bordered center">303</td>
        <td class="bordered" colspan="20"><?php echo implode(
                ', ', [
                $Data['json']['contacts']['juristic_address']['region'],
                $Data['json']['contacts']['juristic_address']['district'],
                $Data['json']['contacts']['juristic_address']['settlement'],
                $Data['json']['contacts']['juristic_address']['street'],
                $Data['json']['contacts']['juristic_address']['building'],
                $Data['json']['contacts']['juristic_address']['apartment']
            ]); ?></td>
    </tr>
    <tr>
        <td class="bordered center">204</td>
        <td class="bordered"></td>
        <td class="bordered"></td>
        <td class="bordered"></td>
        <td class="bordered"></td>
        <td class="bordered" colspan="16">ГНИ Ленинского района</td>
        <!-- -->
        <td class="bordered center">304</td>
        <td class="bordered"></td>
        <td class="bordered"></td>
        <td class="bordered"></td>
        <td class="bordered"></td>
        <td class="bordered" colspan="16"><?php echo $Region; ?></td>
    </tr>
    <tr>
        <td class="bordered center" style="width: 30px;">205</td>
        <td class="bordered center" style="width: 20px;">1</td>
        <td class="bordered center" style="width: 20px;">2</td>
        <td class="bordered center" style="width: 20px;">4</td>
        <td class="bordered center" style="width: 20px;">0</td>
        <td class="bordered center" style="width: 20px;">0</td>
        <td class="bordered center" style="width: 20px;">1</td>
        <td class="bordered center" style="width: 20px;"></td>
        <td class="bordered center" style="width: 20px;"></td>
        <td class="bordered center" style="width: 20px;"></td>
        <td class="bordered" colspan="11">ОАО "Банк Бакай"</td>
        <!-- -->

        <td class="bordered center">305</td>
        <?php $Bank = $Data['json']['bank']; ?>
        <?php $biclength = strlen($Bank['bic']); ?>
        <?php for($i = 0; $i < $biclength; $i++): ?>
            <td class="bordered center" style="width: 20px;"><?php echo $Bank['bic']{$i}; ?></td>
        <?php endfor; ?>
        <td class="bordered center" style="width: 20px;"></td>
        <td class="bordered center" style="width: 20px;"></td>
        <td class="bordered center" style="width: 20px;"></td>
        <td class="bordered" colspan="11"><?php echo $Bank['bankname']; ?></td>
    </tr>
    <tr>
        <td class="bordered center">206</td>
        <td class="bordered center">1</td>
        <td class="bordered center">2</td>
        <td class="bordered center">4</td>
        <td class="bordered center">2</td>
        <td class="bordered center">0</td>
        <td class="bordered center">0</td>
        <td class="bordered center">0</td>
        <td class="bordered center">2</td>
        <td class="bordered center">0</td>
        <td class="bordered center">0</td>
        <td class="bordered center">0</td>
        <td class="bordered center">1</td>
        <td class="bordered center">5</td>
        <td class="bordered center">4</td>
        <td class="bordered center">5</td>
        <td class="bordered center">3</td>
        <td class="bordered center"></td>
        <td class="bordered center"></td>
        <td class="bordered center"></td>
        <td class="bordered center"></td>
        <!-- -->
        <td class="bordered center">306</td>
        <?php $balength = strlen($Bank['account']); ?>
        <?php for($i = 0; $i < $balength; $i++): ?>
            <td class="bordered center" style="width: 20px;"><?php echo $Bank['account']{$i}; ?></td>
        <?php endfor; ?>
        <td class="bordered center"></td>
        <td class="bordered center"></td>
        <td class="bordered center"></td>
        <td class="bordered center"></td>
    </tr>
</table>

<table style="border-collapse: collapse;">
    <tr>
        <td class="bordered" style="width: 78px;">Дата и</td>
        <td class="bordered center" style="width: 30px;">401</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">1</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">1</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">1</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">1</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">2</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">0</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">1</td>
        <td class="bordered center" style="width: 22px;" rowspan="2">5</td>
        <td class="bordered center" style="width: 7px;" rowspan="2"></td>
        <td class="bordered center" style="width: 30px;">402</td>
        <td class="bordered" style="width: 155px;">002</td>
        <!-- -->
        <td class="bordered" style="width: 121px;" >Способ платежа</td>
        <td class="bordered center" style="width: 30px;" >403</td>
        <td class="bordered" style="width: 325px;" rowspan="2">перечислением</td>
    </tr>
    <tr>
        <td class="bordered" colspan="2">тип поставки</td>
        <td class="bordered"></td>
        <td class="bordered" >Необязательное</td>
        <!-- -->
        <td class="bordered" colspan="2"></td>
    </tr>
</table>
<table style="border-collapse: collapse; margin-top: -1px;">
    <tr>
        <td class="bordered center" style="width: 24px;">404</td>
        <td class="bordered" style="width: 438px;"></td>
        <td class="bordered center" style="width: 24px;">405</td>
        <td class="bordered" style="width: 438px;"></td>
    </tr>
</table>
<br/>

<table class="tabledata" style="width: 100%; border-collapse: collapse;">

    <tr>
        <th rowspan="2">Код<br/>группы</th>
        <th rowspan="2">Наименование товаров<br/>(работ, услуг)</th>
        <th rowspan="2">Ед.изм.</th>
        <th rowspan="2">Количество<br/>(объем)</th>
        <th rowspan="2">Цена<br/>сом</th>
        <th rowspan="2">Стоимость<br/>без НДС</th>
        <th colspan="2">НДС</th>
        <th rowspan="2">Всего стоимость</th>
    </tr>
    <tr>
        <th>Ставка, %</th>
        <th>Сумма (сом)</th>
    </tr>
    <?php
    $Invoice2 = [
        'Name' => 'ЭЦП',
        'Count' => 0,
        'Price' => 0,
        'Sum' => 0
    ];
    ?>
    <?php
    foreach($Invoice as $Record) {
        if($Record['Name'] == 'Рутокен ЭЦП') { continue; }
        $Invoice2['Sum'] += $Record['Sum'];
        $Invoice2['Price'] = $Record['Price'];
        $Invoice2['Count'] += $Record['Count'];
    }
    ?>
    <?php $Sum = 0; ?>
    <tr>
        <td></td>
        <td><?php echo $Invoice2['Name']; ?></td>
        <td>шт.</td>
        <td><?php echo $Invoice2['Count']; ?></td>
        <td><?php echo $Invoice2['Price']; ?></td>
        <td><?php echo $Invoice2['Sum']; ?></td>
        <td>0,00</td>
        <td>0,00</td>
        <td><?php echo $Invoice2['Sum']; ?></td>
    </tr>
    <?php $Sum += $Invoice2['Sum']; ?>
    <tr>
        <td></td>
        <td class="right bold">Итого:</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo number_format($Sum, 2, '.', ''); ?></td>
    </tr>
</table>
<div style="width: 100%;text-align:right;font-size:9pt;"><b><i>Всего: <?php echo static::mb_ucfirst(\Classes\Num2Str::num2str($Sum), 'UTF-8'); ?></i></b></div>
<br/>
<table style="width: 100%;">
    <tr>
        <td style="width: 20%; vertical-align: top;" class="center bold">ПОСТАВЩИК<br>М.П.</td>
        <td style="width: 40%; vertical-align: top;" class="bold">Руководитель:<br><br><br>Гл.бухгалтер</td>
        <td></td>
        <td style="width: 30%; vertical-align: top;" class="bold">Покупатель:</td>
    </tr>
</table>
</body>
</html>