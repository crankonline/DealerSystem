<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main">
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <strong>Oh snap! </strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <?php $this->load->view('template/statistics/operator/statistics_menu'); //меню оператора?>
        <div class="well">
            <h3><span class="glyphicon glyphicon-tower"></span> Рейтинг операторов по регистрации за текущий месяц</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Место</th>
                        <th>ФИО</th>
                        <th style="width: 600px">Шкала</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($statistics_reiting as $value): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $value->username; ?> </td>
                            <td><div class="progress">
                                    <div class="progress-bar progress-bar-<?php
                                    if ($value->count <= 15) {
                                        echo 'danger';
                                    }if ($value->count > 16 && $value->count <= 50) {
                                        echo 'warning';
                                    }if ($value->count >= 51) {
                                        echo 'success';
                                    }
                                    ?>" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value->count . "%" ?>">
                                        <span class="sr-only"><?php echo $value->count . "%" ?></span>
                                    </div>
                                </div></td>
                            <td><?php echo number_format($value->count, 1, '.', ' ') . " %" ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="well">
            <h3><span class="glyphicon glyphicon-tower"></span> Рейтинг операторов по ошибкам за текущий месяц</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Место</th>
                        <th>ФИО</th>
                        <th style="width: 600px">Шкала</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($reiting['statistics_reiting_eds_error'] as $key=> $value): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $value['name']; ?> </td>
                            <td><div class="progress">
                                    <div class="progress-bar progress-bar-<?php
                                    if ($value['count'] <= 20) {
                                        echo 'info';
                                    }if ($value['count'] > 21 && $value['count'] <= 50) {
                                        echo 'warning';
                                    }if ($value['count'] >=51) {
                                        echo 'danger';
                                    }
                                    ?>" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value['count'] . "%" ?>">
                                        <span class="sr-only"><?php echo $value['count'] . "%" ?></span>
                                    </div>
                                </div></td>
                            <td><?php echo number_format($value['count'], 1, '.', ' ') . " %" ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>