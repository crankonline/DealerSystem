<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-09-06 15:04:58 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  колонка &quot;creatingdatetime&quot; не существует
LINE 7: AND &quot;creatingdatetime&quot; &gt;= '01.09.2017%2015:05'
            ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-09-06 15:04:58 --> Query error: ОШИБКА:  колонка "creatingdatetime" не существует
LINE 7: AND "creatingdatetime" >= '01.09.2017%2015:05'
            ^ - Invalid query: SELECT "invoice"."invoice_serial_number", "invoice"."inn", "invoice"."company_name", COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND inventory_id =2), '0') AS TokenCount, COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND inventory_id =1), '0') AS EDSCount, to_date(to_char(requisites.requisites_creating_date_time, 'DD.MM.YYYY HH24:MI'), 'DD.MM.YYYY HH24:MI') AS creatingdatetime
FROM "Dealer_data"."requisites"
LEFT JOIN "Dealer_data"."invoice" ON "requisites"."requisites_invoice_id" = "invoice"."id_invoice"
LEFT JOIN "Dealer_data"."pay_invoice" ON "requisites"."pay_invoice_id" = "id_pay_invoice"
LEFT JOIN "Dealer_data"."users" ON "invoice"."users_id" = "users"."id_users"
WHERE "users"."id_users" = '1'
AND "creatingdatetime" >= '01.09.2017%2015:05'
AND "creatingdatetime" <= '06.09.2017%2015:05'
ORDER BY "creatingdatetime" DESC
ERROR - 2017-09-06 15:07:38 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  колонка &quot;creatingdatetime&quot; не существует
LINE 7: AND &quot;creatingdatetime&quot; &gt;= '01.09.2017%252015%3A05'
            ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-09-06 15:07:38 --> Query error: ОШИБКА:  колонка "creatingdatetime" не существует
LINE 7: AND "creatingdatetime" >= '01.09.2017%252015%3A05'
            ^ - Invalid query: SELECT "invoice"."invoice_serial_number", "invoice"."inn", "invoice"."company_name", COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND inventory_id =2), '0') AS TokenCount, COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND inventory_id =1), '0') AS EDSCount, to_date(to_char(requisites.requisites_creating_date_time, 'DD.MM.YYYY HH24:MI'), 'DD.MM.YYYY HH24:MI') AS creatingdatetime
FROM "Dealer_data"."requisites"
LEFT JOIN "Dealer_data"."invoice" ON "requisites"."requisites_invoice_id" = "invoice"."id_invoice"
LEFT JOIN "Dealer_data"."pay_invoice" ON "requisites"."pay_invoice_id" = "id_pay_invoice"
LEFT JOIN "Dealer_data"."users" ON "invoice"."users_id" = "users"."id_users"
WHERE "users"."id_users" = '1'
AND "creatingdatetime" >= '01.09.2017%252015%3A05'
AND "creatingdatetime" <= '06.09.2017%252015%3A05'
ORDER BY "creatingdatetime" DESC
ERROR - 2017-09-06 15:11:41 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  колонка &quot;creatingdatetime&quot; не существует
LINE 7: AND &quot;creatingdatetime&quot; &gt;= '01.09.2017 15:05'
            ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-09-06 15:11:41 --> Query error: ОШИБКА:  колонка "creatingdatetime" не существует
LINE 7: AND "creatingdatetime" >= '01.09.2017 15:05'
            ^ - Invalid query: SELECT "invoice"."invoice_serial_number", "invoice"."inn", "invoice"."company_name", COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND inventory_id =2), '0') AS TokenCount, COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND inventory_id =1), '0') AS EDSCount, to_date(to_char(requisites.requisites_creating_date_time, 'DD.MM.YYYY HH24:MI'), 'DD.MM.YYYY HH24:MI') AS creatingdatetime
FROM "Dealer_data"."requisites"
LEFT JOIN "Dealer_data"."invoice" ON "requisites"."requisites_invoice_id" = "invoice"."id_invoice"
LEFT JOIN "Dealer_data"."pay_invoice" ON "requisites"."pay_invoice_id" = "id_pay_invoice"
LEFT JOIN "Dealer_data"."users" ON "invoice"."users_id" = "users"."id_users"
WHERE "users"."id_users" = '1'
AND "creatingdatetime" >= '01.09.2017 15:05'
AND "creatingdatetime" <= '06.09.2017 15:05'
ORDER BY "creatingdatetime" DESC
ERROR - 2017-09-06 15:13:11 --> Severity: Notice --> Undefined variable: i /var/www/demo-ds.token.kg/application/views/template/statistics/statistics_error_eds_ext.php 35
ERROR - 2017-09-06 15:58:13 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 53
ERROR - 2017-09-06 15:58:36 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 53
ERROR - 2017-09-06 16:00:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 54
ERROR - 2017-09-06 16:00:46 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 54
ERROR - 2017-09-06 16:01:06 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 54
ERROR - 2017-09-06 16:01:44 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 54
ERROR - 2017-09-06 16:02:04 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 55
ERROR - 2017-09-06 16:05:44 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 56
ERROR - 2017-09-06 16:05:44 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 57
ERROR - 2017-09-06 16:05:56 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 57
ERROR - 2017-09-06 16:06:18 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 57
ERROR - 2017-09-06 16:06:34 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 56
ERROR - 2017-09-06 16:06:34 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 57
ERROR - 2017-09-06 16:08:35 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 56
ERROR - 2017-09-06 16:08:51 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 56
ERROR - 2017-09-06 16:09:04 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 56
ERROR - 2017-09-06 16:09:32 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 57
ERROR - 2017-09-06 16:10:48 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 59
ERROR - 2017-09-06 16:11:03 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 58
ERROR - 2017-09-06 16:11:51 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 58
