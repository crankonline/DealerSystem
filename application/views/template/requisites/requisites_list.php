<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main">
    <!--    <div class="alert alert-info">
            <strong>Эта страница является макетом!</strong> Идет процесс разработки
        </div>-->

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span> ФОРМЫ ЗАЯВОК</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-3">
                    <!--                    <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Все
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?php //echo base_url();  ?>index.php/requisites/requisites_list_view/done"><span class="glyphicon glyphicon-list"></span> Заполненные</a></li>
                                                <li><a href="#">Оплаченные</a></li>
                                                <li><a href="#">Заполненные</a></li>
                                                <li><a href="#">Ожидаемые</a></li>
                                            </ul>
                                        </div>-->

                </div>
                <form action="<?php echo base_url(); ?>index.php/requisites/requisites_list_view/" method="post">
                    <div class="col-lg-4">
                        <input type="text" class="form-control" placeholder="Введите ключевое слово поиска" autofocus="" name="search_field">
                    </div>
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Найти</button>
                    </div>
                </form>
                <div class="col-lg-1">

                </div>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th style="width: 116px;">ИНН</th>
                <th>Наименование компании</th>
                <th style="width: 136px;">Дата заполнения</th>
                <th style="width: 136px;">№ Счет-фактуры</th>
                <?php if ($this->session->userdata['logged_in']['Show_Operator'] == TRUE): ?>
                    <th  style="width: 126px;" >Оператор </th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 + $this->uri->segment(3);
            foreach ($requisites_data as $requisites_item):
                ?>
                <tr onclick="window.location.href = '<?php echo base_url() . "index.php/requisites/requisites_show_view/" . $requisites_item->id_requisites ?>'" style="cursor: pointer;" class="info">
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $requisites_item->inn; ?></td>
                    <td><?php echo $requisites_item->company_name; ?></td>
                    <td><?php echo $requisites_item->creatingdatetime; ?></td>
                    <td><?php echo $requisites_item->serial . " " . $requisites_item->number; ?></td>
                    <?php if ($this->session->userdata['logged_in']['Show_Operator'] == TRUE): ?>
                        <td><?php echo $requisites_item->username ?></td>
                <?php endif; ?>
                </tr>
<?php endforeach; ?>
        </tbody>
    </table>
     <ul class="pagination">
        <?php echo (isset($pagination)) ? $pagination : NULL; ?>
    </ul>
</div>