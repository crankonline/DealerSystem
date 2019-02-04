<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($statistics_reiting)
?>
<div class="container theme-showcase" role="main">
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <strong>Oh snap! </strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>    

        <?php $this->load->view('template/statistics/boss/statistics_menu'); //меню оператора?>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-search"></span> ПОИСК ОПЛАТЫ</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <form action="<?php echo base_url() . "index.php/statistics/statistics_view_boss_cash_history/" ?>" method="post">
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="Введите ключевое слово поиска" autofocus="" name="search_field">
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Поиск</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="well">
            <h3><span class="glyphicon glyphicon-usd"></span> История оплат</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>№ счета на оплату</th>
                        <th>Наименование компании</th>
                        <th>Сумма оплаты</th>
                        <th style="width: 136px;">Дата оплаты</th>
                        <th>Платежный сервис</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1 + $this->uri->segment(3);
                    foreach ($pay_history as $val):
                        ?>
                        <tr onclick="window.location.href = '<?php echo base_url() . "index.php/invoice/invoice_show_view/" . $val->Account ?>'" style="cursor: pointer;">
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $val->Account; ?></td>
                            <td><?php echo $val->company_name; ?></td>
                            <td><?php echo number_format($val->Sum, 2, '.', ' '); ?></td>
                            <td><?php echo $val->pay_date_time; ?></td>
                            <td><?php echo $val->Name; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <ul class="pagination">
            <?php echo (isset($pagination)) ? $pagination : NULL; ?>
        </ul>
    </div>
<?php endif; ?>