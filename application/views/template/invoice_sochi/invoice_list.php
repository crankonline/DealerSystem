<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main">
    <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере   ?>
        <div class="alert alert-danger">
            <strong>Oh snap!</strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <?php //if (isset($message)): //сообщение ою изменениях?>
        <!--            <div class="alert alert-info">
                        <strong>Cообщение:</strong> <?php //echo $message;   ?>
                    </div>-->
        <?php //endif; ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span> СЧЕТА НА ОПЛАТУ БАЛАНСА СОЧИ</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-1">
<!--                        <div class="dropdown">-->
<!--                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Все-->
<!--                                <span class="caret"></span></button>-->
<!--                            <ul class="dropdown-menu" style="width: 200px;">-->
<!--                                <li><a href="--><?php ////echo base_url(); ?><!--index.php/invoice/invoice_list_view/pay"><span class="glyphicon glyphicon-list"></span> Оплаченные</a></li>-->
<!--                                <li><a href="--><?php ////echo base_url(); ?><!--index.php/invoice/invoice_list_view/nonpay"><span class="glyphicon glyphicon-list"></span><span class="badge pull-right">--><?php //echo $this->invoice_model->menu_invoice_nonpay_count(); ?><!--</span>  Не опплаченные</a></li>-->
<!--                                <li><a href="--><?php ////echo base_url(); ?><!--index.php/invoice/invoice_list_view/wait"><span class="glyphicon glyphicon-list"></span> <span class="badge pull-right">--><?php //echo $this->invoice_model->menu_invoice_pay_count(); ?><!--</span>Ожидающие</a></li>-->
<!--                                <li><a href="--><?php ////echo base_url(); ?><!--index.php/invoice/invoice_list_view/"><span class="glyphicon glyphicon-th-list"></span> Все</a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
                    </div>
                    <form action="<?php echo base_url(); ?>index.php/invoice_sochi/invoice_list_view/" method="post">
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="Введите ключевое слово поиска" autofocus="" name="search_field">
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Найти</button>
                        </div>
                    </form>
                    <div class="col-lg-1">
                        <?php if ($this->session->userdata['logged_in']['Create_Invoice'] == TRUE): ?>
                            <form action="<?php echo base_url(); ?>index.php/invoice_sochi/invoice_create_view/">
                                <button type="submit" class="btn btn-success" ><span class="glyphicon glyphicon-file"></span> Создать счет на оплату</button> 
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 146px;">№ счета на оплату</th>
                    <th style="width: 116px;">ИНН</th>
                    <th>Наименование компании</th>
                    <th style="width: 126px;">Дата создания</th>
<!--                    <th>Токены</th>
                    <th>Сертификаты</th>-->
                    <th style="width: 126px;">Сумма к оплате</th>
                    <?php if ($this->session->userdata['logged_in']['Show_Operator'] == TRUE): ?>
                        <th style="width: 126px;">Оператор </th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1 + ((isset($pagination)) ? $this->uri->segment(3) : 0);
                foreach ($invoice_sochi_data as $invoice_item):
                    ?>
                    <tr onclick="window.open('<?php echo base_url() .
                        "index.php/pdfcreate/invoice_sochi/" . $invoice_item->invoice_sochi_serial_number ?>')" style="cursor: pointer;">
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $invoice_item->invoice_sochi_serial_number ?></td>
                        <td><?php echo $invoice_item->inn ?></td>
                        <td><?php echo $invoice_item->company_name ?></td>
                        <td><?php echo $invoice_item->creatingdatetime ?></td>
<!--                        <td><?php //echo $invoice_item->tokencount ?></td>
                        <td><?php //echo $invoice_item->edscount ?></td>-->
                        <td><?php echo $invoice_item->total_sum ?></td>
                        <?php if ($this->session->userdata['logged_in']['Show_Operator'] == TRUE): ?>
                            <td><?php echo $invoice_item->username ?> </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <ul class="pagination">
        <?php echo (isset($pagination)) ? $pagination : NULL; ?>
    </ul>
</div>