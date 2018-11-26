<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--<style type="text/css">
    .spoiler >  input + .box {
        display: none;
    }
    .spoiler >  input:checked + .box {
        display: block;
    }
</style>-->

<div class="container theme-showcase" role="main">
    <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере  ?>
        <div class="alert alert-danger">
            <strong>Oh snap!</strong> <?php echo $error_message; ?>
        </div>
    <?php else: ?>

        <?php if (isset($messages)): ?>
            <div class="page-header"><h2><span class="glyphicon glyphicon-tags"></span> Новости</h2></div>
            <?php foreach ($messages as $message): ?>
                <div class="well">
                    <h3 align="center"> <?php echo $message->CaptionRu; ?></h3>
                    <p align="center"> 
                        <img src="<?php echo $message->Illustration; ?>" style = "width: 50%; height:50%">
                    </p>
                    <?php echo $message->ContentRu; ?>
                    <p align="right"><?php echo $message->Date; ?></p>
                </div>
            <?php endforeach; ?>
            <ul class="pagination">
                <?php echo $pagination_message; ?>
            </ul>
        <?php endif; ?>

    <?php endif; ?>
</div>