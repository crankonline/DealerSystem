<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-01-19 13:45:57 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2018-01-19 13:47:01 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2018-01-19 13:50:04 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2018-01-19 13:52:23 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2018-01-19 13:56:36 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2018-01-19 13:57:42 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2018-01-19 14:09:51 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2018-01-19 14:10:18 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2018-01-19 14:11:21 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2018-01-19 14:12:36 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2018-01-19 14:17:33 --> Severity: Parsing Error --> syntax error, unexpected 'active' (T_STRING) xdebug://debug-eval 1
ERROR - 2018-01-19 14:40:42 --> Severity: Parsing Error --> syntax error, unexpected '.' xdebug://debug-eval 1
ERROR - 2018-01-19 14:44:12 --> Severity: Parsing Error --> syntax error, unexpected 'uid' (T_STRING) xdebug://debug-eval 1
ERROR - 2018-01-19 14:53:38 --> Severity: Notice --> Undefined property: stdClass::$json_cut /var/www/demo-ds.token.kg/application/controllers/Requisites.php 445
ERROR - 2018-01-19 14:53:39 --> Severity: Notice --> Undefined property: stdClass::$json_cut /var/www/demo-ds.token.kg/application/controllers/Requisites.php 445
ERROR - 2018-01-19 14:53:40 --> Severity: Notice --> Undefined property: stdClass::$json_cut /var/www/demo-ds.token.kg/application/controllers/Requisites.php 445
ERROR - 2018-01-19 14:53:46 --> Severity: Notice --> Undefined property: stdClass::$json_cut /var/www/demo-ds.token.kg/application/controllers/Requisites.php 445
ERROR - 2018-01-19 15:00:24 --> Severity: Parsing Error --> syntax error, unexpected 'invoice_id' (T_STRING) xdebug://debug-eval 1
ERROR - 2018-01-19 15:52:49 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2018-01-19 15:53:53 --> Severity: Notice --> Undefined property: Requisites::$get_invoice_data_by_id /var/www/demo-ds.token.kg/system/core/Model.php 77
ERROR - 2018-01-19 15:54:05 --> Severity: Notice --> Undefined property: Requisites::$get_requisites_by_inn /var/www/demo-ds.token.kg/system/core/Model.php 77
ERROR - 2018-01-19 16:26:07 --> Severity: Notice --> Undefined property: stdClass::$pasport /var/www/demo-ds.token.kg/application/controllers/Requisites.php 668
ERROR - 2018-01-19 16:26:07 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Requisites.php 668
ERROR - 2018-01-19 16:26:07 --> Severity: Notice --> Undefined property: stdClass::$pasport /var/www/demo-ds.token.kg/application/controllers/Requisites.php 669
ERROR - 2018-01-19 16:26:07 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Requisites.php 669
ERROR - 2018-01-19 16:26:07 --> Severity: Notice --> Undefined property: stdClass::$pasport /var/www/demo-ds.token.kg/application/controllers/Requisites.php 670
ERROR - 2018-01-19 16:26:07 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Requisites.php 670
ERROR - 2018-01-19 16:26:07 --> Severity: Notice --> Undefined property: stdClass::$pasport /var/www/demo-ds.token.kg/application/controllers/Requisites.php 671
ERROR - 2018-01-19 16:26:07 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Requisites.php 671
ERROR - 2018-01-19 16:26:15 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  неверное значение для целого числа: &quot;undefined&quot;
LINE 7: WHERE &quot;id_requisites&quot; = 'undefined'
                                ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2018-01-19 16:26:15 --> Query error: ОШИБКА:  неверное значение для целого числа: "undefined"
LINE 7: WHERE "id_requisites" = 'undefined'
                                ^ - Invalid query: SELECT "invoice"."inn", "requisites"."id_requisites", "invoice"."invoice_serial_number", "requisites"."json", to_char(requisites.requisites_creating_date_time, 'DD.MM.YYYY HH24:MI') AS requisites_creating_date_time, CONCAT(pay_invoice.serial, ' ', pay_invoice."number") AS pay_invoice_serial_number, CONCAT (users.surname, ' ', "users"."name", ' ', users.patronymic_name) AS user_name, "distributor"."full_name", "json_version_id"
FROM "Dealer_data"."requisites"
INNER JOIN "Dealer_data"."pay_invoice" ON "requisites"."pay_invoice_id" = "pay_invoice"."id_pay_invoice"
INNER JOIN "Dealer_data"."invoice" ON "requisites"."requisites_invoice_id" = "invoice"."id_invoice"
INNER JOIN "Dealer_data"."users" ON "invoice"."users_id" = "users"."id_users"
INNER JOIN "Dealer_data"."distributor" ON "users"."distributor_id" = "distributor"."id_distributor"
WHERE "id_requisites" = 'undefined'
