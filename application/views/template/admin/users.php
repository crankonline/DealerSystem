<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container theme-showcase" role="main">
    <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере  ?>
        <div class="alert alert-danger">
            <strong>Oh snap!</strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            <p>Это административная панель. Здесь можно управлять параметрами дилерской системы.
                Будьте внимательны, любые изменения не подлежат отмене.</p>
        </div>
        <div class="alert alert-info">
            Выберете нужный пункт меню и приступайте к работе.
        </div>
    <?php endif; ?>
</div>
