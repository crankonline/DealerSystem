<?php
/**
 * Created by PhpStorm.
 * User: dex
 * Date: 03/04/17
 * Time: 12:56
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <style type="text/css">
        div.table table tr td:nth-child(2) {
            font-weight: bold;
        }

        div.table table tr td {
            padding: 5px;
        }

        div.list span {
            font-weight: bold;
        }

        div.list {
            line-height: 25px;
        }
    </style>
</head>
<body style="padding: 30px;">
<div align = "center" style="width: 100%; font-size: 19pt;">Сертификат № <span style = "font-weight: bold;"><?php echo $nubmer; ?></span><br/>на получение ЭЦП</div>
<div class = "list">
    <br/>Фамилия: &nbsp; <span><?php echo $values->Surname; ?></span>
    <br/>Имя: &nbsp; <span><?php echo $values->Name; ?></span>
    <br/>Отчество: &nbsp; <span><?php echo $values->FatherName; ?></span>
    <br/>Гражданство: &nbsp; <span><?php echo $values->Citizen; ?></span>
    <br/>Серия паспорта: &nbsp; <span><?php echo $values->PassportSeries; ?></span>
    <br/>Номер паспорта: &nbsp; <span><?php echo $values->PassportNumber; ?></span>
    <br/>Дата выдачи паспорта: &nbsp; <span><?php echo $values->PassportIssueDate; ?></span>
    <br/>Орган выдавший паспорт: &nbsp; <span><?php echo $values->PassportIssuePlace; ?></span>
    <br/>Дата покупки: &nbsp; <span><?php echo $values->SaleDateTime; ?></span>
    <br/>Серийный номер токена: &nbsp; <span><?php echo $values->SerialNumber; ?></span>
    <br/>ИНН компании: &nbsp; <span><?php echo $values->CompanyINN; ?></span>
    <br/>Название компании: &nbsp; <span><?php echo $values->CompanyName; ?></span>
    <br/>Страна: &nbsp; <span><?php echo $values->Country; ?></span>
    <br/>Город: &nbsp; <span><?php echo $values->Town; ?></span>
    <br/>e-mail: &nbsp; <span><?php echo $values->Email; ?></span>
</div>

<div class = "list">
    <br/>Оператор: &nbsp; <span><?php echo $values->RegistratorFullName; ?></span>
    <br/>Подпись: _______________________
</div>

<div class = "list">
    <br/><span>Сертификат получил, данные в сертификате сверил и подтверждаю:</span>
    <br/><?php echo $values->Surname . ' ' . $values->Name .  ' ' . $values->FatherName; ?>
    <br/>Подпись: _______________________
</div>

<div>
    <br/><br/><barcode code = "<?php echo $nubmer; ?>" size="1" type = "CODABAR" error="M" />
</div>
<br/>

<br/>
</body>
<html>
