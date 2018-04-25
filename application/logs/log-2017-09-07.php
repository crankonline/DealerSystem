<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-09-07 09:34:15 --> Severity: Error --> Call to a member function format() on a non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 48
ERROR - 2017-09-07 09:34:42 --> Severity: Error --> Call to a member function format() on a non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 48
ERROR - 2017-09-07 09:34:45 --> Severity: Error --> Call to a member function format() on a non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 48
ERROR - 2017-09-07 09:35:31 --> Severity: Error --> Call to a member function format() on a non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 48
ERROR - 2017-09-07 09:43:38 --> Severity: Notice --> A non well formed numeric value encountered /var/www/demo-ds.token.kg/application/controllers/Statistics.php 52
ERROR - 2017-09-07 09:43:38 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  значение поля типа date/time вне диапазона: &quot;2017-09-31 23:59&quot;
LINE 6: AND &quot;requisites_creating_date_time&quot; &lt;= '2017-09-31 23:59'
                                               ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-09-07 09:43:38 --> Query error: ОШИБКА:  значение поля типа date/time вне диапазона: "2017-09-31 23:59"
LINE 6: AND "requisites_creating_date_time" <= '2017-09-31 23:59'
                                               ^ - Invalid query: SELECT "inn"
FROM "Dealer_data"."requisites"
JOIN "Dealer_data"."invoice" ON "requisites"."requisites_invoice_id" = "invoice"."id_invoice"
JOIN "Dealer_data"."users" ON "invoice"."users_id" = "users"."id_users"
WHERE "requisites_creating_date_time" >= '2017-09-01 00:00'
AND "requisites_creating_date_time" <= '2017-09-31 23:59'
AND "id_users" = '1'
ERROR - 2017-09-07 09:44:08 --> Severity: Notice --> A non well formed numeric value encountered /var/www/demo-ds.token.kg/application/controllers/Statistics.php 52
ERROR - 2017-09-07 09:44:08 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  оператор не существует: timestamp without time zone &lt;= integer
LINE 6: AND &quot;requisites_creating_date_time&quot; &lt;= 1506880740
                                            ^
HINT:  Оператор с данными именем и типами аргументов не найден. Возможно, вам следует добавить явные приведения типов. /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-09-07 09:44:08 --> Query error: ОШИБКА:  оператор не существует: timestamp without time zone <= integer
LINE 6: AND "requisites_creating_date_time" <= 1506880740
                                            ^
HINT:  Оператор с данными именем и типами аргументов не найден. Возможно, вам следует добавить явные приведения типов. - Invalid query: SELECT "inn"
FROM "Dealer_data"."requisites"
JOIN "Dealer_data"."invoice" ON "requisites"."requisites_invoice_id" = "invoice"."id_invoice"
JOIN "Dealer_data"."users" ON "invoice"."users_id" = "users"."id_users"
WHERE "requisites_creating_date_time" >= '2017-09-01 00:00'
AND "requisites_creating_date_time" <= 1506880740
AND "id_users" = '1'
ERROR - 2017-09-07 15:25:13 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2017-09-07 15:36:01 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:36:01 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:36:02 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:36:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:36:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:36:06 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:36:06 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:36:07 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:36:08 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:36:09 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:37:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:37:04 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:37:05 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:37:05 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:37:06 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:37:08 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:37:09 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:37:10 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:37:10 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:37:11 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-07 15:42:38 --> Severity: Error --> Call to undefined function is_nul() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
