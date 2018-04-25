<div class="jumbotron">
    <button type="button" <?php echo (is_null($this->uri->segment(2))) ? 'class="btn btn-lg btn-default active"' : 'class="btn btn-lg btn-default"'; ?>
            onclick="window.location.href = '<?php echo base_url() . "index.php/statistics/" ?>'">
        <span class="glyphicon glyphicon-user"></span> Статистика продаж
    </button>
    <button type="button" <?php echo (strripos($_SERVER['REQUEST_URI'], 'statistics_view_boss_error_eds')) ? 'class="btn btn-lg btn-default active"' : 'class="btn btn-lg btn-default"'; ?> 
            onclick="window.location.href = '<?php echo base_url() . "index.php/statistics/statistics_view_boss_error_eds/" ?>'">
        <span class="glyphicon glyphicon-certificate"></span> Ошибки ЭЦП
    </button>
    <button type="button" <?php echo (strripos($_SERVER['REQUEST_URI'], 'statistics_view_boss_cash_history')) ? 'class="btn btn-lg btn-default active"' : 'class="btn btn-lg btn-default"'; ?> 
            onclick="window.location.href = '<?php echo base_url() . "index.php/statistics/statistics_view_boss_cash_history/" ?>'">
        <span class="glyphicon glyphicon-usd"></span> Итория по оплат</button>
     <!--   <button type="button" class="btn btn-lg btn-default" onclick="window.location.href = '<?php //echo base_url() . "index.php/statistics/statistics_view_operator_period/" ?>'"><span class="glyphicon glyphicon-user"></span> Статистика за период</button>-->
</div>