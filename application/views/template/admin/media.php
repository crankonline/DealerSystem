<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="container theme-showcase" role="main" ng-app="DealerSystem">
    <div ng-controller="AdminMediaController">
        <?php if (isset($error_message)): // вывод ошибки если счет не на оплату найденхотя можно и show_error в контороллере  ?>
            <div class="alert alert-danger">
                <strong>Oh snap!</strong> <?php echo $error_message; ?>
            </div>
        <?php else: ?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-picture"></span>
                        Загрузка изображений.
                    </h3>
                </div>
                <div class="panel-body">
                    <strong>Поиск по номеру счета на оплату.</strong>
                    <input type="text"
                           class="form-control"
                           ng-model="searchInvoiceNumber">

                </div>
                <div align="center" ng-hide="searchInvoiceNumber.length != 16">
                    <p>
                        <button type="submit"
                                class="btn btn-success"
                                ng-click="searchMediaData(searchInvoiceNumber)">
                            <span class="glyphicon glyphicon-search"></span>
                            Найти
                        </button>
                    </p>
                </div>
            </div>

            <div class="panel panel-warning" ng-hide="">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-picture"></span>
                        Загрузка изображений.
                    </h3>
                </div>
                <div class="panel-body">
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="<?php echo base_url("resources/js/DealerSystem/AdminServices.js"); ?>"></script>
<script src="<?php echo base_url("resources/js/DealerSystem/AdminMediaController.js"); ?>"></script>
