<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-08-10 10:05:55 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/models/Invoice_model.php 182
ERROR - 2017-08-10 10:05:55 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/models/Invoice_model.php 182
ERROR - 2017-08-10 11:15:13 --> Severity: Warning --> SoapClient::SoapClient(http://pay.ubr.kg/api-soap.php?service=Payment&amp;wsdl): failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
 /var/www/demo-ds.token.kg/application/models/Invoice_model.php 37
ERROR - 2017-08-10 11:15:13 --> Severity: Warning --> SoapClient::SoapClient(): I/O warning : failed to load external entity &quot;http://pay.ubr.kg/api-soap.php?service=Payment&amp;wsdl&quot; /var/www/demo-ds.token.kg/application/models/Invoice_model.php 37
ERROR - 2017-08-10 11:15:13 --> Severity: Error --> SOAP-ERROR: Parsing WSDL: Couldn't load from 'http://pay.ubr.kg/api-soap.php?service=Payment&wsdl' : failed to load external entity "http://pay.ubr.kg/api-soap.php?service=Payment&wsdl"
 /var/www/demo-ds.token.kg/application/models/Invoice_model.php 37
ERROR - 2017-08-10 13:12:05 --> Severity: Notice --> Undefined variable: data /var/www/demo-ds.token.kg/application/controllers/Statistics.php 143
ERROR - 2017-08-10 13:12:05 --> Severity: Notice --> Undefined variable: statistics_reiting /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 55
ERROR - 2017-08-10 13:12:05 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 55
ERROR - 2017-08-10 13:12:05 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 96
ERROR - 2017-08-10 13:12:05 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 96
ERROR - 2017-08-10 13:12:05 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 126
ERROR - 2017-08-10 13:12:05 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 126
ERROR - 2017-08-10 13:25:22 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;.&quot;)
LINE 3: INNER JOIN &quot;Dealer_data&quot;.&quot;invoice&quot; ON .&quot;invoice&quot;.&quot;invoice_se...
                                              ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 13:25:22 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ".")
LINE 3: INNER JOIN "Dealer_data"."invoice" ON ."invoice"."invoice_se...
                                              ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", "Dealer_data"."invoice"."pay_date_time", "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON ."invoice"."invoice_serial_number" = "Dealer_payments"."PayLog"."Account"
INNER JOIN "Dealer_data"."requisites" ON ."requisites"."pay_invoice_id" = "Dealer_data"."invoice"."id_invoice"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "Dealer_payments"."PaymentSystem"."IDPaymentSystem" = "Dealer_payments"."PayLog"."PaymentSystemID"
ORDER BY "Dealer_data"."invoice"."pay_date_time" DESC
ERROR - 2017-08-10 13:27:00 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;.&quot;)
LINE 4: INNER JOIN &quot;Dealer_data&quot;.&quot;requisites&quot; ON .&quot;requisites&quot;.&quot;pay_...
                                                 ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 13:27:00 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ".")
LINE 4: INNER JOIN "Dealer_data"."requisites" ON ."requisites"."pay_...
                                                 ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", "Dealer_data"."invoice"."pay_date_time", "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_data"."requisites" ON ."requisites"."pay_invoice_id" = "Dealer_data"."invoice"."id_invoice"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "Dealer_payments"."PaymentSystem"."IDPaymentSystem" = "Dealer_payments"."PayLog"."PaymentSystemID"
ORDER BY "Dealer_data"."invoice"."pay_date_time" DESC
ERROR - 2017-08-10 13:27:24 --> Severity: Notice --> Undefined variable: data /var/www/demo-ds.token.kg/application/controllers/Statistics.php 143
ERROR - 2017-08-10 13:27:24 --> Severity: Notice --> Undefined variable: statistics_reiting /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 57
ERROR - 2017-08-10 13:27:24 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 57
ERROR - 2017-08-10 13:27:24 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 85
ERROR - 2017-08-10 13:27:24 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 85
ERROR - 2017-08-10 13:27:24 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 115
ERROR - 2017-08-10 13:27:24 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 115
ERROR - 2017-08-10 13:28:01 --> Severity: Notice --> Undefined variable: data /var/www/demo-ds.token.kg/application/controllers/Statistics.php 143
ERROR - 2017-08-10 13:28:01 --> Severity: Notice --> Undefined variable: statistics_reiting /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 57
ERROR - 2017-08-10 13:28:01 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 57
ERROR - 2017-08-10 13:28:01 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 85
ERROR - 2017-08-10 13:28:01 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 85
ERROR - 2017-08-10 13:28:01 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 115
ERROR - 2017-08-10 13:28:01 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 115
ERROR - 2017-08-10 13:31:58 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:31:58 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:31:58 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:31:58 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:18 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:18 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:18 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:18 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:20 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:20 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:20 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:20 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:21 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:21 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:21 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:21 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:21 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:21 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:21 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:21 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:21 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:21 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:21 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:21 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:21 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:21 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:21 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:21 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:21 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:22 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:22 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:22 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:53 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:53 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:53 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:53 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:54 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:54 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:54 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:54 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:54 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:54 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:54 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:54 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:54 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:54 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:54 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:54 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:55 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:55 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:55 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:55 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:55 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:55 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:36:55 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:36:55 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 61
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 62
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 63
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: val /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 65
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:44:12 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:44:12 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:44:12 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:44:52 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:44:52 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:44:52 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:44:52 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Undefined variable: invoice_item /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Undefined variable: invoice_item /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Undefined variable: invoice_item /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Undefined variable: invoice_item /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Undefined variable: invoice_item /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Undefined variable: invoice_item /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Undefined variable: invoice_item /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Undefined variable: invoice_item /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 59
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:46:07 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:46:07 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:46:07 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:46:33 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:46:33 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:46:33 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:46:33 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:48:19 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:48:19 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 13:48:19 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 13:48:19 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:02:56 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:02:56 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:02:56 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:02:56 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:03:16 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:03:16 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:03:16 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:03:16 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:07:00 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;.&quot;)
LINE 1: ...M-YYYY HH24:MI'), 'DD-MM-YYYY HH24:MI') AS invoice.pay_date_...
                                                             ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 14:07:00 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ".")
LINE 1: ...M-YYYY HH24:MI'), 'DD-MM-YYYY HH24:MI') AS invoice.pay_date_...
                                                             ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_date(to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI'), 'DD-MM-YYYY HH24:MI') AS invoice.pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
ORDER BY "Dealer_data"."invoice"."pay_date_time" DESC
ERROR - 2017-08-10 14:08:18 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:08:18 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:08:18 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:08:18 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:09:27 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  функция to_time(text, unknown) не существует
LINE 1: ...&quot;company_name&quot;, &quot;Dealer_payments&quot;.&quot;PayLog&quot;.&quot;Sum&quot;, to_time(to...
                                                             ^
HINT:  Функция с данными именем и типами аргументов не найдена. Возможно, вам следует добавить явные приведения типов. /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 14:09:27 --> Query error: ОШИБКА:  функция to_time(text, unknown) не существует
LINE 1: ..."company_name", "Dealer_payments"."PayLog"."Sum", to_time(to...
                                                             ^
HINT:  Функция с данными именем и типами аргументов не найдена. Возможно, вам следует добавить явные приведения типов. - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_time(to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI'), 'DD-MM-YYYY HH24:MI') AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
ORDER BY "Dealer_data"."invoice"."pay_date_time" DESC
ERROR - 2017-08-10 14:10:16 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:10:16 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:10:16 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:10:16 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:12:13 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:12:13 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:12:13 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:12:13 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:13:07 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  в элементе предложения FROM неверная ссылка на таблицу &quot;PayLog&quot;
LINE 5: ORDER BY &quot;Dealer_data&quot;.&quot;PayLog&quot;.&quot;IDPayLog&quot; DESC
                 ^
HINT:  Таблица &quot;PayLog&quot; присутствует в запросе, но сослаться на неё из этой части запроса нельзя. /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 14:13:07 --> Query error: ОШИБКА:  в элементе предложения FROM неверная ссылка на таблицу "PayLog"
LINE 5: ORDER BY "Dealer_data"."PayLog"."IDPayLog" DESC
                 ^
HINT:  Таблица "PayLog" присутствует в запросе, но сослаться на неё из этой части запроса нельзя. - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI')AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
ORDER BY "Dealer_data"."PayLog"."IDPayLog" DESC
ERROR - 2017-08-10 14:13:45 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:13:45 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:13:45 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:13:45 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:18:09 --> Severity: Notice --> Undefined variable: statistics_daily_all /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:18:09 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 90
ERROR - 2017-08-10 14:18:09 --> Severity: Notice --> Undefined variable: statistics_daily_operators /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:18:09 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 120
ERROR - 2017-08-10 14:37:13 --> Severity: Notice --> Undefined variable: sumcount /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 14:37:37 --> Severity: Notice --> Undefined variable: sumcount /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_cash.php 64
ERROR - 2017-08-10 14:42:18 --> Severity: Notice --> Undefined variable:  /var/www/demo-ds.token.kg/application/controllers/Statistics.php 148
ERROR - 2017-08-10 15:22:13 --> 404 Page Not Found: Statistics/statistics_view_boss_cash
ERROR - 2017-08-10 15:22:17 --> 404 Page Not Found: S/index
ERROR - 2017-08-10 15:55:23 --> Severity: Warning --> Missing argument 1 for Statistics::statistics_view_boss_cash_history() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 136
ERROR - 2017-08-10 15:55:23 --> Severity: Error --> Call to undefined method Statistics_model::get_statistics_boss_cash() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 138
ERROR - 2017-08-10 15:55:42 --> Severity: Warning --> Missing argument 1 for Statistics::statistics_view_boss_cash_history() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 136
ERROR - 2017-08-10 15:55:42 --> Severity: Notice --> Undefined variable: period_start /var/www/demo-ds.token.kg/application/models/Statistics_model.php 119
ERROR - 2017-08-10 15:55:42 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;)&quot;)
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 15:55:42 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ")")
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI')AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
WHERE "PayLog"."Account" LIKE '%%' ESCAPE '!'
OR  lower(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  upper(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  invoice.inn) LIKE '%%' ESCAPE '!'
ORDER BY "PayLog"."IDPayLog" DESC
ERROR - 2017-08-10 15:56:01 --> Severity: Warning --> Missing argument 1 for Statistics::statistics_view_boss_cash_history() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 136
ERROR - 2017-08-10 15:56:01 --> Severity: Notice --> Undefined variable: period_start /var/www/demo-ds.token.kg/application/models/Statistics_model.php 119
ERROR - 2017-08-10 15:56:01 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;)&quot;)
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 15:56:01 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ")")
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI')AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
WHERE "PayLog"."Account" LIKE '%%' ESCAPE '!'
OR  lower(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  upper(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  invoice.inn) LIKE '%%' ESCAPE '!'
ORDER BY "PayLog"."IDPayLog" DESC
ERROR - 2017-08-10 15:56:20 --> Severity: Warning --> Missing argument 1 for Statistics::statistics_view_boss_cash_history() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 136
ERROR - 2017-08-10 15:56:20 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;)&quot;)
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 15:56:20 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ")")
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI')AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
WHERE "PayLog"."Account" LIKE '%%' ESCAPE '!'
OR  lower(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  upper(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  invoice.inn) LIKE '%%' ESCAPE '!'
ORDER BY "PayLog"."IDPayLog" DESC
ERROR - 2017-08-10 15:56:49 --> Severity: Warning --> Missing argument 1 for Statistics::statistics_view_boss_cash_history() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 136
ERROR - 2017-08-10 15:56:49 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;)&quot;)
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 15:56:49 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ")")
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI')AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
WHERE "PayLog"."Account" LIKE '%%' ESCAPE '!'
OR  lower(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  upper(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  invoice.inn) LIKE '%%' ESCAPE '!'
ORDER BY "PayLog"."IDPayLog" DESC
ERROR - 2017-08-10 15:56:50 --> Severity: Warning --> Missing argument 1 for Statistics::statistics_view_boss_cash_history() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 136
ERROR - 2017-08-10 15:56:50 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;)&quot;)
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 15:56:50 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ")")
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI')AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
WHERE "PayLog"."Account" LIKE '%%' ESCAPE '!'
OR  lower(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  upper(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  invoice.inn) LIKE '%%' ESCAPE '!'
ORDER BY "PayLog"."IDPayLog" DESC
ERROR - 2017-08-10 15:56:50 --> Severity: Warning --> Missing argument 1 for Statistics::statistics_view_boss_cash_history() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 136
ERROR - 2017-08-10 15:56:50 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;)&quot;)
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 15:56:50 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ")")
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI')AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
WHERE "PayLog"."Account" LIKE '%%' ESCAPE '!'
OR  lower(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  upper(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  invoice.inn) LIKE '%%' ESCAPE '!'
ORDER BY "PayLog"."IDPayLog" DESC
ERROR - 2017-08-10 15:56:50 --> Severity: Warning --> Missing argument 1 for Statistics::statistics_view_boss_cash_history() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 136
ERROR - 2017-08-10 15:56:50 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;)&quot;)
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 15:56:50 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ")")
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI')AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
WHERE "PayLog"."Account" LIKE '%%' ESCAPE '!'
OR  lower(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  upper(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  invoice.inn) LIKE '%%' ESCAPE '!'
ORDER BY "PayLog"."IDPayLog" DESC
ERROR - 2017-08-10 15:58:10 --> Severity: Error --> Call to undefined method Statistics_model::get_statistics_boss_cash() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 138
ERROR - 2017-08-10 15:58:25 --> Severity: Error --> Call to undefined method Statistics_model::get_statistics_boss_cash_history() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 138
ERROR - 2017-08-10 15:58:45 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;)&quot;)
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 15:58:45 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ")")
LINE 8: OR  invoice.inn) LIKE '%%' ESCAPE '!'
                       ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI')AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
WHERE "PayLog"."Account" LIKE '%%' ESCAPE '!'
OR  lower(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  upper(invoice.company_name) LIKE '%%' ESCAPE '!'
OR  invoice.inn) LIKE '%%' ESCAPE '!'
ORDER BY "PayLog"."IDPayLog" DESC
ERROR - 2017-08-10 16:07:51 --> Severity: Error --> Call to undefined method CI_DB_postgre_driver::is_null() /var/www/demo-ds.token.kg/application/models/Statistics_model.php 133
ERROR - 2017-08-10 16:09:11 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;)&quot;)
LINE 8: OR  invoice.inn) LIKE '%dsg%' ESCAPE '!'
                       ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 16:09:11 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ")")
LINE 8: OR  invoice.inn) LIKE '%dsg%' ESCAPE '!'
                       ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI')AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
WHERE "PayLog"."Account" LIKE '%dsg%' ESCAPE '!'
OR  lower(invoice.company_name) LIKE '%dsg%' ESCAPE '!'
OR  upper(invoice.company_name) LIKE '%dsg%' ESCAPE '!'
OR  invoice.inn) LIKE '%dsg%' ESCAPE '!'
ORDER BY "PayLog"."IDPayLog" DESC
ERROR - 2017-08-10 16:10:53 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;)&quot;)
LINE 10:  )
          ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 16:10:53 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ")")
LINE 10:  )
          ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI')AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
WHERE   (
"PayLog"."Account" LIKE '%dsg%' ESCAPE '!'
OR  lower(invoice.company_name) LIKE '%dsg%' ESCAPE '!'
OR  upper(invoice.company_name) LIKE '%dsg%' ESCAPE '!'
OR  invoice.inn) LIKE '%dsg%' ESCAPE '!'
 )
ORDER BY "PayLog"."IDPayLog" DESC
ERROR - 2017-08-10 16:14:39 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;)&quot;)
LINE 10:  )
          ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 16:14:39 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ")")
LINE 10:  )
          ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI')AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
WHERE   (
"PayLog"."Account" LIKE '%dsg%' ESCAPE '!'
OR  lower(invoice.company_name) LIKE '%dsg%' ESCAPE '!'
OR  upper(invoice.company_name) LIKE '%dsg%' ESCAPE '!'
OR  invoice.inn) LIKE '%dsg%' ESCAPE '!'
 )
ORDER BY "PayLog"."IDPayLog" DESC
ERROR - 2017-08-10 16:16:05 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  ошибка синтаксиса (примерное положение: &quot;)&quot;)
LINE 8: OR  invoice.inn) LIKE '%dsg%' ESCAPE '!'
                       ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-08-10 16:16:05 --> Query error: ОШИБКА:  ошибка синтаксиса (примерное положение: ")")
LINE 8: OR  invoice.inn) LIKE '%dsg%' ESCAPE '!'
                       ^ - Invalid query: SELECT "Dealer_payments"."PayLog"."Account", "Dealer_data"."invoice"."company_name", "Dealer_payments"."PayLog"."Sum", to_char("Dealer_data".invoice.pay_date_time, 'DD-MM-YYYY HH24:MI')AS pay_date_time, "Dealer_payments"."PaymentSystem"."Name"
FROM "Dealer_payments"."PayLog"
INNER JOIN "Dealer_data"."invoice" ON "invoice"."invoice_serial_number" = "PayLog"."Account"
INNER JOIN "Dealer_payments"."PaymentSystem" ON "PaymentSystem"."IDPaymentSystem" = "PayLog"."PaymentSystemID"
WHERE "PayLog"."Account" LIKE '%dsg%' ESCAPE '!'
OR  lower(invoice.company_name) LIKE '%dsg%' ESCAPE '!'
OR  upper(invoice.company_name) LIKE '%dsg%' ESCAPE '!'
OR  invoice.inn) LIKE '%dsg%' ESCAPE '!'
ORDER BY "PayLog"."IDPayLog" DESC
ERROR - 2017-08-10 17:01:08 --> Severity: Warning --> Wrong parameter count for number_format() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_main.php 44
ERROR - 2017-08-10 17:01:08 --> Severity: Warning --> Wrong parameter count for number_format() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_main.php 44
ERROR - 2017-08-10 17:01:08 --> Severity: Warning --> Wrong parameter count for number_format() /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_main.php 44
ERROR - 2017-08-10 17:22:43 --> Severity: Notice --> Undefined property: Statistics::$pagination /var/www/demo-ds.token.kg/application/controllers/Statistics.php 38
ERROR - 2017-08-10 17:22:43 --> Severity: Error --> Call to a member function initialize() on a non-object /var/www/demo-ds.token.kg/application/controllers/Statistics.php 38
ERROR - 2017-08-10 17:29:07 --> 404 Page Not Found: Statistics/get_statistics_boss_cash_hystory
ERROR - 2017-08-10 17:31:09 --> 404 Page Not Found: Statistics/get_statistics_boss_cash_hystory
