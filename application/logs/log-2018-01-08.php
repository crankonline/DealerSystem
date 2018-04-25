<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-01-08 10:56:21 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2018-01-08 12:04:16 --> Severity: Notice --> Undefined variable: period_start /var/www/demo-ds.token.kg/application/controllers/Statistics.php 76
ERROR - 2018-01-08 12:04:16 --> Severity: Notice --> Undefined variable: period_end /var/www/demo-ds.token.kg/application/controllers/Statistics.php 76
ERROR - 2018-01-08 12:04:16 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;&quot;NULL&quot;&quot;)
LINE 7: AND &quot;requisites_creating_date_time&quot; &gt; &quot;IS&quot; &quot;NULL&quot;
                                                   ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2018-01-08 12:04:16 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ""NULL"")
LINE 7: AND "requisites_creating_date_time" > "IS" "NULL"
                                                   ^ - Invalid query: SELECT "invoice"."invoice_serial_number", "invoice"."inn", COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND inventory_id =1), '0') AS EDSCount, to_char(requisites.requisites_creating_date_time, 'DD.MM.YYYY HH24:MI') AS creatingdatetime, "users"."name" AS "username", CONCAT (users.surname, ' ', "users"."name", ' ', users.patronymic_name) AS user_full_name
FROM "Dealer_data"."requisites"
LEFT JOIN "Dealer_data"."invoice" ON "requisites"."requisites_invoice_id" = "invoice"."id_invoice"
LEFT JOIN "Dealer_data"."pay_invoice" ON "requisites"."pay_invoice_id" = "id_pay_invoice"
LEFT JOIN "Dealer_data"."users" ON "invoice"."users_id" = "users"."id_users"
WHERE "users"."id_users" = '1'
AND "requisites_creating_date_time" > "IS" "NULL"
AND "requisites_creating_date_time" < "IS" "NULL"
ORDER BY "creatingdatetime"
ERROR - 2018-01-08 12:04:46 --> Severity: Notice --> Use of undefined constant cert_list - assumed 'cert_list' /var/www/demo-ds.token.kg/application/controllers/Statistics.php 79
ERROR - 2018-01-08 12:04:46 --> Severity: Notice --> Undefined variable: data_row /var/www/demo-ds.token.kg/application/controllers/Statistics.php 82
ERROR - 2018-01-08 12:04:46 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 82
ERROR - 2018-01-08 12:04:46 --> Severity: Notice --> Use of undefined constant cert_list - assumed 'cert_list' /var/www/demo-ds.token.kg/application/controllers/Statistics.php 79
ERROR - 2018-01-08 12:04:46 --> Severity: Notice --> Undefined variable: data_row /var/www/demo-ds.token.kg/application/controllers/Statistics.php 82
ERROR - 2018-01-08 12:04:46 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 82
ERROR - 2018-01-08 12:05:06 --> Severity: Notice --> Undefined variable: data_row /var/www/demo-ds.token.kg/application/controllers/Statistics.php 82
ERROR - 2018-01-08 12:05:06 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 82
ERROR - 2018-01-08 12:05:07 --> Severity: Notice --> Undefined variable: data_row /var/www/demo-ds.token.kg/application/controllers/Statistics.php 82
ERROR - 2018-01-08 12:05:07 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 82
ERROR - 2018-01-08 12:34:31 --> Severity: Error --> Call to undefined function prtint_r() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Undefined variable: data_list_row /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Undefined variable: data_list_row /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Undefined variable: data_list_row /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Undefined variable: data_list_row /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Undefined variable: data_list_row /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Undefined variable: data_list_row /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Undefined variable: data_list_row /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Undefined variable: data_list_row /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 99
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 12:45:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 98
ERROR - 2018-01-08 13:30:44 --> Severity: Notice --> Undefined variable: Inn /var/www/demo-ds.token.kg/application/controllers/Statistics.php 88
ERROR - 2018-01-08 13:30:44 --> Severity: Notice --> Undefined variable: Inn /var/www/demo-ds.token.kg/application/controllers/Statistics.php 88
ERROR - 2018-01-08 13:31:55 --> Severity: Notice --> Undefined property: stdClass::$EDS_count_error_pki /var/www/demo-ds.token.kg/application/views/template/statistics/operator/statistics_error_eds.php 215
ERROR - 2018-01-08 13:31:55 --> Severity: Notice --> Undefined property: stdClass::$EDS_count_pki_all /var/www/demo-ds.token.kg/application/views/template/statistics/operator/statistics_error_eds.php 224
ERROR - 2018-01-08 13:31:55 --> Severity: Notice --> Undefined property: stdClass::$EDS_count_pki_all /var/www/demo-ds.token.kg/application/views/template/statistics/operator/statistics_error_eds.php 225
ERROR - 2018-01-08 13:31:55 --> Severity: Notice --> Undefined property: stdClass::$EDS_count_error_pki /var/www/demo-ds.token.kg/application/views/template/statistics/operator/statistics_error_eds.php 228
ERROR - 2018-01-08 13:31:55 --> Severity: Notice --> Undefined property: stdClass::$EDS_count_error_pki /var/www/demo-ds.token.kg/application/views/template/statistics/operator/statistics_error_eds.php 228
ERROR - 2018-01-08 13:31:55 --> Severity: Notice --> Undefined property: stdClass::$EDS_count_error_pki /var/www/demo-ds.token.kg/application/views/template/statistics/operator/statistics_error_eds.php 229
ERROR - 2018-01-08 13:31:55 --> Severity: Notice --> Undefined property: stdClass::$EDS_count_error_pki /var/www/demo-ds.token.kg/application/views/template/statistics/operator/statistics_error_eds.php 229
