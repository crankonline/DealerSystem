<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($pay_log);
?>
<div class="container theme-showcase" role="main" ng-app="InvoiceShow">
    <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере  ?>
        <div class="alert alert-danger">
            <strong>Oh snap!</strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <?php if (isset($message)): //сообщение ою изменениях?>
            <div class="alert alert-info">
                <strong>Cообщение:</strong> <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Просмотр счета на оплату</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-3">
                        <button type="button" class="btn btn-info" 
                                onclick="window.open('<?php echo base_url() . "index.php/pdfcreate/invoice/" . $invoice_data[0]->invoice_serial_number . "/terminal/" ?>', '_blank')">
                            <span class="glyphicon glyphicon-print"></span> Бланк оплаты через терминал
                        </button>
                    </div>
                    <div class="col-lg-3">
                        <button type="button" class="btn btn-info" 
                                onclick="window.open('<?php echo base_url() . "index.php/pdfcreate/invoice/" . $invoice_data[0]->invoice_serial_number . "/bank/" ?>', '_blank')">
                            <span class="glyphicon glyphicon-print"></span> Бланк оплаты через банк
                        </button>
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <?php if ($this->session->userdata['logged_in']['Create_Invoice'] == TRUE && $invoice_data[0]->pay_sum >= $invoice_data[0]->total_sum && $invoice_data[0]->requisites_invoice_id == NULL): //проверка доступа пользователя И оплаты для регистрации формы заявки И проверка на существование записи заявки для отображения кнопки регистрации  ?>
                            <button onclick="window.location.href = '<?php echo base_url() . "index.php/requisites/requisites_create_view/" . $invoice_data[0]->id_invoice ?>'" type="button" class="btn btn-success"><span
                                    class="glyphicon glyphicon-pencil"></span> Перейти к регистрации
                            </button>
                        <?php endif; ?>
                        <?php if ($invoice_data[0]->requisites_invoice_id != NULL): //проверка на существование записи заявки для отображения кнопки ппросмотра связанной заявки (взаимоисключаемое условие с пред`идущим)?>
                            <button onclick="window.location.href = '<?php echo base_url() . "index.php/requisites/requisites_show_view/" . $invoice_data[0]->id_requisites ?>'" type="button" class="btn btn-info"><span
                                    class="glyphicon glyphicon-eye-open"></span> Просмотр формы заявки
                            </button>
                        <?php endif; ?>
                        <?php if ($invoice_data[0]->pay_date_time == NULL): //проверка на существование оплат, если оплаты нет можно удалять (взаимоисключаемое условие с пред`идущим)?> 
                            <button onclick="window.location.href = '<?php echo base_url() . "index.php/invoice/invoice_delete/" . $invoice_data[0]->invoice_serial_number ?>'" type="button" class="btn btn-danger"><span
                                    class = "glyphicon glyphicon-trash"></span> Удалить счет на оплату
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
                <p></p>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><h4>Номер счета на оплату</h4></td>
                            <td><h4><?php echo $invoice_data[0]->invoice_serial_number; ?></h4></td>
                            <td></td>
                        </tr>
                        <?php if ($this->session->userdata['logged_in']['Change_Invoice'] == TRUE && $invoice_data[0]->requisites_invoice_id == NULL): ?>
                            <tr>
                                <td><h4>ИНН</h4></td>
                                <td>
                                    <form action="<?php echo base_url() . "index.php/invoice/invoice_update/inn" ?>" method="post">
                                        <input name="inn" 
                                               type="text" 
                                               class="form-control" 
                                               value="<?php echo $invoice_data[0]->inn; ?>" 
                                               required="" 
                                               minlength="14" 
                                               maxlength="14" 
                                               ng-model="val" 
                                               numbers-only>
                                        <input name="invoice_serial_number" type="text" hidden="" value="<?php echo $invoice_data[0]->invoice_serial_number; ?>">
                                        </td>
                                        <td><button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Изменить</button></td> 
                                    </form>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td>
                                    <h4>ИНН</h4>
                                </td>
                                <td>
                                    <h4><?php echo $invoice_data[0]->inn; ?></h4>
                                </td>
                                <td></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($this->session->userdata['logged_in']['Change_Invoice'] == TRUE && $invoice_data[0]->requisites_invoice_id == NULL): ?>
                            <tr>
                                <td>
                                    <h4>Наименование компании</h4>
                                </td>
                                <td>
                                    <form action="<?php echo base_url() . "index.php/invoice/invoice_update/company_name" ?>" method="post">
                                        <input name="company_name" 
                                               type="text"
                                               class="form-control"
                                               minlength="5"
                                               maxlength="100"
                                               value='<?php echo $invoice_data[0]->company_name; ?>'
                                               required="">
                                        <input name="invoice_serial_number" type="text" hidden="" value="<?php echo $invoice_data[0]->invoice_serial_number; ?>">
                                        </td>
                                        <td><button id="CM" type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Изменить</button></td>
                                    </form>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td>
                                    <h4>Наименование компании</h4>
                                </td>
                                <td>
                                    <h4><?php echo $invoice_data[0]->company_name; ?></h4>
                                </td>
                                <td></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td><h4>Дата создания</h4></td>
                            <td><h4><?php echo date_format(date_create($invoice_data[0]->creating_date_time), 'd.m.Y H:i:s'); ?></h4></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><h4>Сумма к оплате</h4></td>
                            <td><h4><?php echo $invoice_data[0]->total_sum; ?></h4></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><h4>Внесенная оплата</h4></td>
                            <?php if ($invoice_data[0]->pay_sum < $invoice_data[0]->total_sum): ?>
                                <td class="text-danger"> 
                                <?php else: ?>
                                <td class="text-success">
                                <?php endif; ?>
                                <h4><strong><?php echo $invoice_data[0]->pay_sum; ?></strong></h4>
                            </td>
                            <td></td>
                        </tr>
                        <?php if ($invoice_data[0]->pay_sum != 0): //вывод строки даты оплаты если оплата произведена  ?>
                            <tr>
                                <td><h4>Дата оплаты</h4></td>
                                <td><h4><?php echo date_format(date_create($invoice_data[0]->pay_date_time), 'd.m.Y H:i:s'); ?></h4></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <h3 align="center"><strong>Состав счета на оплату</strong></h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Наименование ТМЦ</th>
                            <th>Количество</th>
                            <th>Стоимость за единицу</th>
                            <th>Сумма</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($invoice_data as $invoice_item):
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $invoice_item->inventory_name; ?></td>
                                <td><?php echo $invoice_item->count; ?></td>
        <!--                                <td><?php //echo $invoice_item->price;     ?></td>Переписать  модель-->
                                <td><?php echo number_format($invoice_item->price_count / $invoice_item->count, 2, '.', ''); ?></td>
                                <td><?php echo $invoice_item->price_count; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-success" >
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-usd"></span> История оплаты</h3>
            </div>
            <div class="panel-body">
                <?php if (!empty($pay_log)): ?>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><b>#</b></td>
                                <td><b>Наименование сервиса</b></td>
                                <td><b>Сумма</b></td>
                                <td><b>Дата время</b></td>
                            </tr>
                            <?php $i = 1;
                            foreach ($pay_log as $pay_item) : ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $pay_item->Name; ?></td>
                                    <td><?php echo number_format($pay_item->Sum, 2, '.', ' '); ?></td>
                                    <td><?php echo date_format(date_create($pay_item->DateTime), 'd.m.Y H:i:s'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h4>Оплаты не было</h4>
                <?php endif; ?>
            </div>
        </div>
    <?php if (($this->session->userdata['logged_in']['Payer_Invoce'] == TRUE) && ($invoice_data[0]->requisites_invoice_id == NULL)): //вывод панели оплаты счета на оплату если у пользователя есть доступ  ?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-usd"></span> Оплата счета на оплату</h3>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tbody></tbody>
        <?php //if ($invoice_data[0]->pay_sum != 0): //если счет оплачен вывод строки со свойством сервиса оплаты      ?>
        <!--                                <tr>
                                    <td><h4>Наименование сервиса через которого прошла оплата</h4></td>
                                    <td><h4>Сервис платежей временно не доступен!</h4></td>
                                    <td></td>
                                </tr>-->
                        <?php //endif; ?>
        <?php //if ($invoice_data[0]->pay_sum < $invoice_data[0]->total_sum): //если счет не оплачен даем возможность заплатить    ?>      
                        <tr>
                            <td><h4>Изменить сумму оплаты согласно платежному поручению</h4></td>
                        <form action="<?php echo base_url() . "index.php/invoice/invoice_update/pay_sum" ?>" method="post">
                            <td>
                                <input name="pay_sum" 
                                       type="text" 
                                       class="form-control" 
                                       placeholder="<?php echo 'Сумма к оплате - ' . ($invoice_data[0]->total_sum - $invoice_data[0]->pay_sum); ?>" 
                                       required="" maxlength="9" 
                                       ng-model="val2" 
                                       numbers-only>
                                <input name="invoice_serial_number" type="text" hidden="" value="<?php echo $invoice_data[0]->invoice_serial_number; ?>">
                            </td>
                            <td><button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Изменить</button></td>
                        </form>
                        </tr>
        <?php //endif;  ?>
                    </table>
                </div>
            </div>
        <?php endif; ?>

    <?php if ($this->session->userdata['logged_in']['Reassing_Invoice'] == TRUE): //вывод панели свойств счета на оплату если у пользователя есть доступ ?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Переназначение счета на оплату</h3>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td><h4>Пользователь создавший счет на оплату</h4></td>
                            <td><h4><?php echo $invoice_data[0]->surname . " " . $invoice_data[0]->name . " " . $invoice_data[0]->patronymic_name; ?></h4></td>
                            <td></td>
                        </tr>
        <?php if ($invoice_data[0]->id_requisites == 0): //если нет связаного реквизита даем возможность переназначить оператора  ?>
                            <tr>
                                <td><h4>Переназначить счет на оплату на оператора</h4></td>
                            <form action="<?php echo base_url() . "index.php/invoice/invoice_update/user" ?>" method="post">
                                <td>
                                    <select name="user" class="form-control" required="">
                                        <option value="" selected="selected">Выберите оператора</option>
                                        <?php $users_data = $this->invoice_model->enum_operators(); //переписать на angular?>
                                            <?php foreach ($users_data as $user_data_item): ?>
                                            <option value="<?php echo $user_data_item->id_users ?>">
                                            <?php echo $user_data_item->surname . " " . $user_data_item->name . " " . $user_data_item->patronymic_name; ?>
                                            </option>
            <?php endforeach; ?>
                                    </select>
                                    <input name="invoice_serial_number" type="text" hidden="" value="<?php echo $invoice_data[0]->invoice_serial_number; ?>">
                                </td>
                                <td><button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Изменить</button></td>
                                </tr>
                            </form>
                    <?php endif; ?>
                    </table>
        <?php //if ($invoice_data[0]->pay_sum == 0): //если присутствует хоть какая то оплата то нам сохранять нечего      ?>
                    <!--                        <div align="center">
                                                <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-save"></span>
                                                    Сохранить
                                                </button>
                                            </div>-->
        <?php //endif;  ?>
                </div>
            </div>
        <?php endif; ?>
<?php endif; ?>
</div>

<script type="text/javascript">

    var app = angular.module('InvoiceShow', []);

    app.directive('numbersOnly', function () {
        return {
            require: 'ngModel',
            link: function (scope, element, attr, ngModelCtrl) {
                scope.val = '<?php echo $invoice_data[0]->inn; ?>';
                function fromUser(text) {
                    if (text) {
                        var transformedInput = text.replace(/[^0-9.,-]/g, '');

                        if (transformedInput !== text) {
                            ngModelCtrl.$setViewValue(transformedInput);
                            ngModelCtrl.$render();
                        }
                        return transformedInput;
                    }
                    return undefined;
                }
                ngModelCtrl.$parsers.push(fromUser);
            }
        };
    });
</script>