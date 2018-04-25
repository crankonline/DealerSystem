<?php
/**
 * Created by PhpStorm.
 * User: dex
 * Date: 03/04/17
 * Time: 12:57
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style type="text/css">

        body {

        }

        table.content tr td, table.content tr th {
            border: 1px solid #000;
            padding: 1px;
        }

        table {
            border-collapse: collapse;
        }

        table.content tr td, table.content tr th { width: calc(100%/128); }

        <?php for($i = 2; $i < 129; $i++) : ?>
        table.content tr td.colspan<?php echo $i; ?>, table.content tr th.colspan<?php echo $i; ?> { width: calc(100%/128*<?php echo $i; ?>); max-width: calc(100%/128*<?php echo $i; ?>); min-width: calc(100%/128*<?php echo $i; ?>); }
        <?php endfor; ?>

    </style>
</head>
<body>
<table style="width: 100%;" class="content">
    <tr>
        <td colspan="19"></td>
        <td colspan="4" class="colspan4">102</td>
        <td colspan="12" class="colspan12">НОМЕР:</td>
        <td colspan="16" class="colspan16">0000000002</td>
        <td colspan="20" class="colspan20"></td>
        <td colspan="4" class="colspan4">108</td>
        <td colspan="7" class="colspan7">ДАТА</td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="6" class="colspan6">День</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3">3</td>
        <td></td>
        <td colspan="7" class="colspan7">Месяц</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">2</td>
        <td></td>
        <td colspan="4" class="colspan4">Год</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3">6</td>
    </tr>
    <tr><td colspan="128">&nbsp;</td></tr>
    <tr>
        <td colspan="10" class="colspan10">Поставщик</td>
        <td colspan="4" class="colspan4"></td>
        <td colspan="8" class="colspan8">ИНН</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3">4</td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3">8</td>
        <td colspan="3" class="colspan3">4</td>
        <td colspan="10" class="colspan10">Покупатель</td>
        <td colspan="4" class="colspan4"></td>
        <td colspan="8" class="colspan8">ИНН</td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
    </tr>
    <tr>
        <td colspan="4" class="colspan4"></td>
        <td colspan="60" class="colspan60">ОсОО "Юниверсал Бизнес Репорт"</td>
        <td colspan="4" class="colspan4"></td>
        <td colspan="60" class="colspan60"></td>
    </tr>
    <tr>
        <td colspan="4" class="colspan4"></td>
        <td colspan="60" class="colspan60">г.Бишкек, ул.Турусбекова 109/1</td>
        <td colspan="4" class="colspan4"></td>
        <td colspan="60" class="colspan60">г.Бишкек, ул.Турусбекова 109/1</td>
    </tr>
    <tr>
        <td colspan="4" class="colspan4"></td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="48" class="colspan48">Ленинский</td>
        <td colspan="4" class="colspan4"></td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="48" class="colspan48">Ленинский</td>
    </tr>
    <tr>
        <td colspan="4" class="colspan4"></td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3">4</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="33" class="colspan33">Бакай банк</td>
        <td colspan="4" class="colspan4"></td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3">4</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="33" class="colspan33">Бакайбанк</td>
    </tr>
    <tr>
        <td colspan="4" class="colspan4"></td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3">4</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3">5</td>
        <td colspan="3" class="colspan3">4</td>
        <td colspan="3" class="colspan3">5</td>
        <td colspan="3" class="colspan3">3</td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <!-- -->
        <td colspan="4" class="colspan4"></td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3">4</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">2</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">0</td>
        <td colspan="3" class="colspan3">1</td>
        <td colspan="3" class="colspan3">5</td>
        <td colspan="3" class="colspan3">4</td>
        <td colspan="3" class="colspan3">5</td>
        <td colspan="3" class="colspan3">3</td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
        <td colspan="3" class="colspan3"></td>
    </tr>
    <tr>
        <td class="colspan10" colspan="10">Дата и</td>
        <td class="colspan4" colspan="4">401</td>
        <td class="colspan3" colspan="3" rowspan="2"></td>
        <td class="colspan3" colspan="3" rowspan="2"></td>
        <td class="colspan3" colspan="3" rowspan="2"></td>
        <td class="colspan3" colspan="3" rowspan="2"></td>
        <td class="colspan3" colspan="3" rowspan="2"></td>
        <td class="colspan3" colspan="3" rowspan="2"></td>
        <td class="colspan3" colspan="3" rowspan="2"></td>
        <td class="colspan3" colspan="3" rowspan="2"></td>
        <td rowspan="2"></td>
        <td class="colspan4" colspan="4"></td>
        <td class="colspan21" colspan="21"></td>
        <td class="colspan18" colspan="18">Способ платежа</td>
        <td class="colspan4" colspan="4">403</td>
        <td class="colspan42" colspan="42" rowspan="2">Перечислением</td>
    </tr>
    <tr>
        <td class="colspan14" colspan="14">тип поставки</td>
        <td class="colspan4" colspan="4"></td>
        <td class="colspan21" colspan="21">непонятные</td>
        <td class="colspan22" colspan="22"></td>
    </tr>
    <tr>
        <td class="colspan4" colspan="4">404</td>
        <td class="colspan60" colspan="60">Корреспон __</td>
        <td class="colspan4" colspan="4">404</td>
        <td class="colspan59" colspan="59">Причины корреспон __</td>
    </tr>
    <tr>
        <td colspan="128" style="width:100%;">&nbsp;</td>
    </tr>
    <tr>
        <th rowspan="2" colspan="9" class="colspan9">Код<br/>группы</th>
        <th rowspan="2" colspan="33" class="colspan33">Наименование товаров<br/>(работ, услуг)</th>
        <th rowspan="2" colspan="6" class="colspan6">Ед.изм.</th>
        <th rowspan="2" colspan="11" class="colspan11">Количество<br/>(объем)</th>
        <th rowspan="2" colspan="15" class="colspan15">Цена<br/>сом</th>
        <th rowspan="2" colspan="15" class="colspan15">Стоимость<br/>без НДС</th>
        <th colspan="23" class="colspan23">НДС</th>
        <th rowspan="2" colspan="16" class="colspan16">Всего стоимость</th>
    </tr>
    <tr>
        <th colspan="8" class="colspan8">Ставка, %</th>
        <th colspan="15" class="colspan15">Сумма (сом)</th>
    </tr>
    <tr>
        <td colspan="9" class="colspan9"></td>
        <td colspan="33" class="colspan33">Услуга ЭЦП</td>
        <td colspan="6" class="colspan6">шт.</td>
        <td colspan="11" class="colspan11"></td>
        <td colspan="15" class="colspan15"></td>
        <td colspan="15" class="colspan15">0,00</td>
        <td colspan="8" class="colspan8">0</td>
        <td colspan="15" class="colspan15">0,00</td>
        <td colspan="16" class="colspan16">0,00</td>
    </tr>
    <tr>
        <td colspan="9" class="colspan9"></td>
        <td colspan="33" class="colspan33">Итого:</td>
        <td colspan="6" class="colspan6"></td>
        <td colspan="11" class="colspan11"></td>
        <td colspan="15" class="colspan15"></td>
        <td colspan="15" class="colspan15"></td>
        <td colspan="8" class="colspan8"></td>
        <td colspan="15" class="colspan15"></td>
        <td colspan="16" class="colspan16">0,00</td>
    </tr>
</table>
</body>
</html>

