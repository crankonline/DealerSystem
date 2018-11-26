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
            <h2>Написать сообщение</h2>
            <form action="<?php echo base_url(); ?>index.php/dash/post_message/" method="post">
                <textarea id="summernote" name="message"></textarea>
                <br/>
                <div align="center"><button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span>  Отправить сообщение</button></div>
            </form>
        </div>
    <?php endif; ?>
</div>

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.6/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.6/summernote.js"></script>
<!--<link href="<?php //echo base_url()       ?>resources/libs/summernote0.8.6/summernote.css" rel="stylesheet">
<script src="<?php //echo base_url()       ?>resources/libs/summernote0.8.6/summernote.js">-->
<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            lang: 'ru-RU' // default: 'en-US'
        });
    });
</script>