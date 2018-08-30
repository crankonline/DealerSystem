<div class="jumbotron">
    <button type="button" <?php echo (is_null($this->uri->segment(2))) ? 'class="btn btn-lg btn-default active"' : 'class="btn btn-lg btn-default"'; ?>
            onclick="window.location.href = '<?php echo base_url() . "index.php/statistics/" ?>'">
        <span class="glyphicon glyphicon-stats"></span> Регистрации за месяц
    </button>
    <button type="button" <?php echo (strripos($_SERVER['REQUEST_URI'], 'statistics_view_operator_error_eds')) ? 'class="btn btn-lg btn-default active"' : 'class="btn btn-lg btn-default"'; ?> 
            onclick="window.location.href = '<?php echo base_url() . "index.php/statistics/statistics_view_operator_error_eds/" ?>'">
        <span class="glyphicon glyphicon-certificate"></span> Выданные ЭП
    </button>
    <button type="button" <?php echo (strripos($_SERVER['REQUEST_URI'], 'statistics_view_operator_period')) ? 'class="btn btn-lg btn-default active"' : 'class="btn btn-lg btn-default"'; ?> 
            onclick="window.location.href = '<?php echo base_url() . "index.php/statistics/statistics_view_operator_period/" ?>'">
        <span class="glyphicon glyphicon-user"></span> Регистрации за период
    </button>
    <button type="button" <?php echo (strripos($_SERVER['REQUEST_URI'], 'statistics_view_operator_reiting')) ? 'class="btn btn-lg btn-default active"' : 'class="btn btn-lg btn-default"'; ?>
            onclick="window.location.href = '<?php echo base_url() . "index.php/statistics/statistics_view_operator_reiting/" ?>'">
        <span class="glyphicon glyphicon-tower"></span> Рейтинги операторов
    </button>
</div>