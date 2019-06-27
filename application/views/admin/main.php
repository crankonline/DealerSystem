<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container theme-showcase" role="main">
    <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере  ?>
        <div class="alert alert-danger">
            <strong>Oh snap!</strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <?php if (isset($message)): //сообщение ою изменениях не работает, удалить??>
            <div class="alert alert-info">
                <strong>Cообщение:</strong> <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($messages)): ?>
            <div class="page-header"><h2><span class="glyphicon glyphicon-comment"></span> Cообщения</h2></div>
            <?php foreach ($messages as $message): ?>
                <div class="well">
                    <?php echo $message->message; ?>
                    <p align="right"><?php echo $message->surname . " " . $message->name . " от " . $message->creating_datetime; ?></p>
                </div>
            <?php endforeach; ?>
            <ul class="pagination">
                <?php echo $pagination_message; ?>
            </ul>
        <?php endif; ?>
        <div class="well">
            
        </div>
    <?php endif; ?>
</div>