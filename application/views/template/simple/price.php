<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main">
    <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере  ?>
        <div class="alert alert-danger">
            <strong>Oh snap!</strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Наименование товара</th>
                    <th>Цена</th>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($price_data as $price_item): ?>
                    <tr> 
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $price_item->inventory_name; ?></td>
                        <td><?php echo $price_item->price; ?></td>
                    </tr>
    <?php endforeach; ?>
            </tbody>
        </table>
<?php endif; ?>
</div>

