<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container theme-showcase" role="main">
    <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере   ?>
        <div class="alert alert-danger">
            <strong>Oh snap!</strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <?php
        if ($this->session->userdata['logged_in']['UserRoleID'] == 3) {
            $this->load->view('template/statistics/operator/statistics_menu'); //меню оператора
        }
        ?>
    <div class="alert alert-warning">
        <h4><span class="glyphicon glyphicon-info-sign"></span> Как правильно читать эту таблицу:</h4>
        <p> <b class="alert-info"><span class="glyphicon glyphicon-certificate"></span> ЭЛЕКТРОННАЯ ПОДПИСЬ</b> - Блок таблицы ЭП</p>
        <p> <b class="alert-success"><span class="glyphicon glyphicon-book"></span> ЗАПОЛНЕНАЯ ЗАЯВКА</b> - Блок таблицы заполненой заявки</p>
        <p> <b class="alert-danger"><span class="glyphicon glyphicon-question-sign"></span> нет ЭП</b> - У данной заявки отсутствет факт выдачи Электронной Подписи </p>
        <p> <b class="alert-danger"><span class="glyphicon glyphicon-question-sign"></span> нет заявки</b> - У выданной Электроннной Подписи отсутсвует оплата и заполенная заявка</p>
    </div>
        <div class="well">
            <h3><span class="glyphicon glyphicon-list"></span> Список регистраций и выдачи ЭП за <?php echo $period_start; ?></h3>
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="6" class="info"><span class="glyphicon glyphicon-certificate"></span> ЭЛЕКТРОННАЯ ПОДПИСЬ</th>
                        <th colspan="4" class="success"><span class="glyphicon glyphicon-book"></span> ЗАПОЛНЕНАЯ ЗАЯВКА</th>
                    </tr>
                    <tr>
                        <th class="info">#</th>
                        <th class="info">ИНН</th>
                        <th class="info">Наименование компании</th>
                        <th class="info">ФИО</th>
                        <th class="info">Должность</th>
                        <th class="info">Дата выдачи ЭП</th>
                        <th class="success">№ счета <br> на оплату</th>
                        <th class="success">ЭП по заявке</th>
                        <th class="success">Дата заполнения <br> заявки</th>
                        <th class="success">Оператор</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($eds_pki_ext as $requisites_item):
                        ?>
                        <tr 
                        <?php if (!isset($requisites_item->invoice_serial_number) || !isset($requisites_item->DateStart)): ?>
                                class="danger"
                            <?php else: ?>
                                onclick="window.open('<?php echo base_url() . "index.php/invoice/invoice_show_view/" . $requisites_item->invoice_serial_number ?>', '_blank')" style="cursor: pointer;"
                            <?php endif; ?>
                            >
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $requisites_item->inn ?></td>
                            <td><?php echo isset($requisites_item->OrgName) ? $requisites_item->OrgName : "<span class=\"glyphicon glyphicon-question-sign\"></span> нет ЭП" ?></td>
                            <td><?php echo isset($requisites_item->Owner) ? $requisites_item->Owner : "<span class=\"glyphicon glyphicon-question-sign\"></span>" ?></td>
                            <td><?php echo isset($requisites_item->Title) ? $requisites_item->Title : "<span class=\"glyphicon glyphicon-question-sign\"></span>" ?></td>
                            <td><?php echo isset($requisites_item->DateStart) ? $requisites_item->DateStart : "<span class=\"glyphicon glyphicon-question-sign\"></span>" ?></td>
                            <td><?php echo isset($requisites_item->invoice_serial_number) ? $requisites_item->invoice_serial_number : "<span class=\"glyphicon glyphicon-question-sign\"></span> нет заявки"; ?></td>
                            <td><?php echo isset($requisites_item->edscount) ? $requisites_item->edscount : "<span class=\"glyphicon glyphicon-question-sign\"></span>"; ?></td>
                            <td><?php echo isset($requisites_item->creatingdatetime) ? $requisites_item->creatingdatetime : "<span class=\"glyphicon glyphicon-question-sign\"></span>"; ?></td>
                            <td><?php echo isset($requisites_item->username) ? $requisites_item->username : "<span class=\"glyphicon glyphicon-question-sign\"></span>"; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>