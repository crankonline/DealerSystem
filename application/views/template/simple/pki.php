<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container theme-showcase" role="main">
    <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере  ?>
        <div class="alert alert-danger">
          <h3 align="center"><strong>!!!Произошла ошибка!!!</strong></h3> 
                <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-search"></span> Поиск по сертификатам</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-3">

                </div>
                <form action="<?php echo base_url(); ?>index.php/pki/pki_search_view/" method="post">
                    <div class="col-lg-4">
                        <input type="text" class="form-control" placeholder="Введите ключевое слово поиска" autofocus="" name="search_field">
                    </div>
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Найти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php if (isset($certificates)): ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-certificate"></span> Результат поиска по ключевому слову - <?php echo $searchWord?></h3>
        </div>
        <div class="panel-body">
        </div>
        <h3 align="center">Cведения о выданных сертификатах</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ИНН</th>
                    <th>Н-е компании</th>
                    <th>ФИО</th>
                    <th>Паспорт</th>
                    <th>Должность</th>
                    <th>Дата выдачи</th>
                    <th>Дата окончания</th>
                    <th>Статус сертификата</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($certificates as $key => $cert): ?>
                    <?php if ($cert->SystemIsAccessible == TRUE): ?>
                        <tr class="success">
                        <?php else: ?>
                        <tr class="danger">
                        <?php endif; ?>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $cert->Inn; ?></td>
                        <td style="width: 250px"><?php echo $cert->OrgName; ?></td>
                        <td><?php echo $cert->Owner; ?></td>
                        <td style="width: 110px"><?php echo $cert->Passport->Series . " " . $cert->Passport->Number; ?></td>
                        <td><?php echo $cert->Title; ?></td>
                        <td style="width: 155px"><?php echo $cert->DateStart; ?></td>
                        <td style="width: 155px"><?php echo $cert->DateFinish; ?></td>
                        <td style="width: 316px;"><?php echo $cert->StatusMessage; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
</div>