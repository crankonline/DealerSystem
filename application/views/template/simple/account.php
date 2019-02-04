<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main">
    <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере   ?>
        <div class="alert alert-danger">
            <strong>Oh snap!</strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Данные пользователя</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Дистрибьтор</td>
                            <td><?php echo $user_db_data->full_name; ?></td>
                        </tr>
                        <tr>
                            <td>Роль</td>
                            <td><?php echo $user_db_data->UserRole; ?></td>
                        </tr>
                        <tr>
                            <td>ФИО</td>
                            <td><?php echo $user_db_data->username; ?></td>
                        </tr>
                        <tr>
                            <td>Серийный номер сертификата</td>
                            <td><?php echo (!empty($user_db_data->cert_number)) ? $user_db_data->cert_number : 'У данного аккаунта нет привязанного сертификата'; ?></td>
                        </tr>
                        <tr>
                            <td>Серийный номер устройства</td>
                            <td><?php echo (!empty($user_db_data->token_number)) ? $user_db_data->token_number : 'У данного аккаунта нет привязанного токена'; ?></td>
                        </tr>
                        <tr>
                            <td>Аккаут действителен до</td>
                            <td><?php echo (isset($user_cert_data)) ? $user_cert_data[0]->DateFinish : 'У данного аккаунта нет привязанного сертификата'; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Роли в системе</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Роль</th>
                            <th>Описание</th>
                            <th>Значение</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($Create_Invoice == TRUE): ?>
                            <tr class="success">
                            <?php else: ?>
                            <tr class="danger">
                            <?php endif; ?>
                            <td>Create_Invoice</td>
                            <td>Доступ к созданию счетов на оплату и регистрации заявки (оператор)</td>
                            <td><?php echo ($Create_Invoice == TRUE) ? "Да" : "Нет" ?></td>
                        </tr>
                        <?php if ($Change_Invoice == TRUE): ?>
                            <tr class="success">
                            <?php else: ?>
                            <tr class="danger">
                            <?php endif; ?>
                            <td>Change_Invoice</td>
                            <td>Доступ к измененю ИНН и названия компании в счете на оплату (оператор)</td>
                            <td><?php echo ($Change_Invoice == TRUE) ? "Да" : "Нет" ?></td>
                        </tr>
                        <?php if ($Payer_Invoce == TRUE): ?>
                            <tr class="success">
                            <?php else: ?>
                            <tr class="danger">
                            <?php endif; ?>
                            <td>Payer_Invoce</td>
                            <td>Доступ к активации оплаты (старший оператор, менеджер, руководитель)</td>
                            <td><?php echo ($Payer_Invoce == TRUE) ? "Да" : "Нет" ?></td>
                        </tr>
                         <?php if ($Reassing_Invoice == TRUE): ?>
                            <tr class="success">
                            <?php else: ?>
                            <tr class="danger">
                            <?php endif; ?>
                            <td>Reassing_Invoice</td>
                            <td>Доступ к переназначению счетов на оплату между операторами и активации оплаты (менеджер, старший оператор)</td>
                            <td><?php echo ($Reassing_Invoice == TRUE) ? "Да" : "Нет" ?></td>
                        </tr>
                        <?php if ($Show_Operator == TRUE): ?>
                            <tr class="success">
                            <?php else: ?>
                            <tr class="danger">
                            <?php endif; ?>
                            <td>Show_Operator</td>
                            <td>Доступ к спискам в рамках дистрибьютора (старший оператор, менеджер, руководитель)</td>
                            <td><?php echo ($Show_Operator == TRUE) ? "Да" : "Нет" ?></td>
                        </tr>
                        <?php if ($Show_Statistics == TRUE): ?>
                            <tr class="success">
                            <?php else: ?>
                            <tr class="danger">
                            <?php endif; ?>
                            <td>Show_Statistics</td>
                            <td>Доступ к модулю статистики (оператор, руководитель)</td>
                            <td><?php echo ($Show_Statistics == TRUE) ? "Да" : "Нет" ?></td>
                        </tr>
                        <?php if ($Show_Statistics_Operators == TRUE): ?>
                            <tr class="success">
                            <?php else: ?>
                            <tr class="danger">
                            <?php endif; ?>
                            <td>Show_Statistics_Operators</td>
                            <td>Доступ к модулю статистики по всем операторам (старший оператор)</td>
                            <td><?php echo ($Show_Statistics_Operators == TRUE) ? "Да" : "Нет" ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
 <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title"><span class="glyphicon glyphicon-qrcode"></span> Информация о системе</h4>
            </div>
         <div class="panel-body">
             <table class="table">
                    <thead>
                        <tr>
                            <th>Фреймворк</th>
                            <th><?php echo "CodeIgniter ".CI_VERSION; ?></th>
                        </tr>
                        <tr>
                            <th>Время генерации</th>
                            <th>{elapsed_time}</th>
                        </tr>
                        <tr>
                            <th>Использования памяти сессией</th>
                            <th>{memory_usage}</th>
                        </tr>
                    </thead>
             </table>
         </div>
     </div>
</div>
