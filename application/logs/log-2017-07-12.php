<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-07-12 09:22:46 --> Severity: Notice --> Undefined variable: UserShortName /var/www/demo-ds.token.kg/application/views/template/menu.php 8
ERROR - 2017-07-12 09:23:07 --> Severity: Notice --> Undefined variable: UserShortName /var/www/demo-ds.token.kg/application/views/template/menu.php 8
ERROR - 2017-07-12 09:27:20 --> Severity: Notice --> Undefined variable: UserShortName /var/www/demo-ds.token.kg/application/views/template/menu.php 8
ERROR - 2017-07-12 09:27:23 --> Severity: Notice --> Undefined variable: UserShortName /var/www/demo-ds.token.kg/application/views/template/menu.php 8
ERROR - 2017-07-12 09:27:28 --> Severity: Notice --> Undefined variable: UserShortName /var/www/demo-ds.token.kg/application/views/template/menu.php 8
ERROR - 2017-07-12 09:27:30 --> Severity: Notice --> Undefined variable: UserShortName /var/www/demo-ds.token.kg/application/views/template/menu.php 8
ERROR - 2017-07-12 09:27:33 --> Severity: Notice --> Undefined variable: UserShortName /var/www/demo-ds.token.kg/application/views/template/menu.php 8
ERROR - 2017-07-12 15:43:36 --> Severity: Notice --> Undefined variable: name /var/www/demo-ds.token.kg/application/views/template/simple/account.php 22
ERROR - 2017-07-12 16:01:21 --> Severity: Notice --> Undefined property: CI_DB_postgre_driver::$account_model /var/www/demo-ds.token.kg/application/controllers/Account.php 19
ERROR - 2017-07-12 16:01:21 --> Severity: Error --> Call to a member function get_user_data() on a non-object /var/www/demo-ds.token.kg/application/controllers/Account.php 19
ERROR - 2017-07-12 16:01:45 --> Severity: Notice --> Undefined property: CI_DB_postgre_driver::$account_model /var/www/demo-ds.token.kg/application/controllers/Account.php 19
ERROR - 2017-07-12 16:01:45 --> Severity: Error --> Call to a member function get_user_data() on a non-object /var/www/demo-ds.token.kg/application/controllers/Account.php 19
ERROR - 2017-07-12 16:02:27 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  отношение &quot;Dealer_system.users&quot; не существует
LINE 2: FROM &quot;Dealer_system&quot;.&quot;users&quot;
             ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 16:02:27 --> Query error: ОШИБКА:  отношение "Dealer_system.users" не существует
LINE 2: FROM "Dealer_system"."users"
             ^ - Invalid query: SELECT "users"."cert_number", "users"."token_number", "distributor"."full_name"
FROM "Dealer_system"."users"
JOIN "Dealer_system"."role" ON "role"."id_role"="users"."role_id"
JOIN "Dealer_system"."distributor" ON "distributor"."id_distributor"="users"."distributor_id"
WHERE "user"."id_user" = '1'
ERROR - 2017-07-12 16:03:14 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  таблица &quot;user&quot; отсутствует в предложении FROM
LINE 5: WHERE &quot;user&quot;.&quot;id_user&quot; = '1'
              ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 16:03:14 --> Query error: ОШИБКА:  таблица "user" отсутствует в предложении FROM
LINE 5: WHERE "user"."id_user" = '1'
              ^ - Invalid query: SELECT "users"."cert_number", "users"."token_number", "distributor"."full_name"
FROM "Dealer_data"."users"
JOIN "Dealer_data"."role" ON "role"."id_role"="users"."role_id"
JOIN "Dealer_data"."distributor" ON "distributor"."id_distributor"="users"."distributor_id"
WHERE "user"."id_user" = '1'
ERROR - 2017-07-12 16:03:42 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  колонка users.id_user не существует
LINE 5: WHERE &quot;users&quot;.&quot;id_user&quot; = '1'
              ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 16:03:42 --> Query error: ОШИБКА:  колонка users.id_user не существует
LINE 5: WHERE "users"."id_user" = '1'
              ^ - Invalid query: SELECT "users"."cert_number", "users"."token_number", "distributor"."full_name"
FROM "Dealer_data"."users"
JOIN "Dealer_data"."role" ON "role"."id_role" = "users"."role_id"
JOIN "Dealer_data"."distributor" ON "distributor"."id_distributor" = "users"."distributor_id"
WHERE "users"."id_user" = '1'
ERROR - 2017-07-12 16:03:52 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 56
ERROR - 2017-07-12 16:05:04 --> Severity: Notice --> Undefined variable: fullname /var/www/demo-ds.token.kg/application/views/template/simple/account.php 14
ERROR - 2017-07-12 16:05:22 --> Severity: Notice --> Undefined property: stdClass::$fullname /var/www/demo-ds.token.kg/application/views/template/simple/account.php 14
ERROR - 2017-07-12 16:05:48 --> Severity: Notice --> Undefined property: stdClass::$fullname /var/www/demo-ds.token.kg/application/views/template/simple/account.php 14
ERROR - 2017-07-12 16:10:29 --> Severity: Notice --> Undefined property: stdClass::$userrole /var/www/demo-ds.token.kg/application/views/template/simple/account.php 18
ERROR - 2017-07-12 16:10:42 --> Severity: Notice --> Undefined property: stdClass::$userrole /var/www/demo-ds.token.kg/application/views/template/simple/account.php 18
ERROR - 2017-07-12 16:11:07 --> Severity: Notice --> Undefined property: stdClass::$userrole /var/www/demo-ds.token.kg/application/views/template/simple/account.php 18
ERROR - 2017-07-12 16:22:56 --> Severity: Error --> Cannot use object of type stdClass as array /var/www/demo-ds.token.kg/application/controllers/Account.php 20
ERROR - 2017-07-12 16:23:25 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:23:57 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:24:06 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:26:50 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Account.php 21
ERROR - 2017-07-12 16:26:50 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/controllers/Account.php 21
ERROR - 2017-07-12 16:26:50 --> Severity: error --> Exception: SEARCH: Length of request mast be more 3 chars /var/www/demo-ds.token.kg/application/models/Requisites_model.php 352
ERROR - 2017-07-12 16:28:04 --> Severity: Error --> Cannot use object of type stdClass as array /var/www/demo-ds.token.kg/application/controllers/Account.php 21
ERROR - 2017-07-12 16:28:34 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:29:13 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:29:28 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:33:37 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:33:41 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:34:14 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:34:33 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:35:03 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:35:37 --> Severity: Notice --> Undefined variable: DateFinish /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:35:52 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:37:03 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 34
ERROR - 2017-07-12 16:40:47 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  таблица &quot;rol&quot; отсутствует в предложении FROM
LINE 1: ...users&quot;.&quot;token_number&quot;, &quot;distributor&quot;.&quot;full_name&quot;, &quot;rol&quot;.&quot;nam...
                                                             ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 16:40:47 --> Query error: ОШИБКА:  таблица "rol" отсутствует в предложении FROM
LINE 1: ...users"."token_number", "distributor"."full_name", "rol"."nam...
                                                             ^ - Invalid query: SELECT CONCAT (users.surname, ' ', "users"."name", ' ', users.patronymic_name) AS UserName, "users"."cert_number", "users"."token_number", "distributor"."full_name", "rol"."name" AS "UserRole"
FROM "Dealer_data"."users"
JOIN "Dealer_data"."role" ON "role"."id_role" = "users"."role_id"
JOIN "Dealer_data"."distributor" ON "distributor"."id_distributor" = "users"."distributor_id"
WHERE "users"."id_users" = '1'
ERROR - 2017-07-12 16:41:41 --> Severity: Warning --> SoapClient::SoapClient(): php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:41:41 --> Severity: Warning --> SoapClient::SoapClient(http://pkiserviced.ubr.kg/pkiservice.php?wsdl): failed to open stream: php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:41:41 --> Severity: Warning --> SoapClient::SoapClient(): I/O warning : failed to load external entity &quot;http://pkiserviced.ubr.kg/pkiservice.php?wsdl&quot; /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:41:41 --> Severity: Notice --> Undefined variable: user_cert_data /var/www/demo-ds.token.kg/application/views/template/simple/account.php 39
ERROR - 2017-07-12 16:41:41 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 39
ERROR - 2017-07-12 16:41:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/demo-ds.token.kg/system/core/Output.php:528) /var/www/demo-ds.token.kg/system/core/Common.php 573
ERROR - 2017-07-12 16:41:41 --> Severity: Error --> SOAP-ERROR: Parsing WSDL: Couldn't load from 'http://pkiserviced.ubr.kg/pkiservice.php?wsdl' : failed to load external entity "http://pkiserviced.ubr.kg/pkiservice.php?wsdl"
 /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:42:02 --> Severity: Warning --> SoapClient::SoapClient(): php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:42:02 --> Severity: Warning --> SoapClient::SoapClient(http://pkiserviced.ubr.kg/pkiservice.php?wsdl): failed to open stream: php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:42:02 --> Severity: Warning --> SoapClient::SoapClient(): I/O warning : failed to load external entity &quot;http://pkiserviced.ubr.kg/pkiservice.php?wsdl&quot; /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:42:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/demo-ds.token.kg/system/core/Output.php:528) /var/www/demo-ds.token.kg/system/core/Common.php 573
ERROR - 2017-07-12 16:42:02 --> Severity: Error --> SOAP-ERROR: Parsing WSDL: Couldn't load from 'http://pkiserviced.ubr.kg/pkiservice.php?wsdl' : failed to load external entity "http://pkiserviced.ubr.kg/pkiservice.php?wsdl"
 /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:42:38 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  таблица &quot;rol&quot; отсутствует в предложении FROM
LINE 1: ...users&quot;.&quot;token_number&quot;, &quot;distributor&quot;.&quot;full_name&quot;, &quot;rol&quot;.&quot;nam...
                                                             ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 16:42:38 --> Query error: ОШИБКА:  таблица "rol" отсутствует в предложении FROM
LINE 1: ...users"."token_number", "distributor"."full_name", "rol"."nam...
                                                             ^ - Invalid query: SELECT CONCAT (users.surname, ' ', "users"."name", ' ', users.patronymic_name) AS UserName, "users"."cert_number", "users"."token_number", "distributor"."full_name", "rol"."name" AS "UserRole"
FROM "Dealer_data"."users"
JOIN "Dealer_data"."role" ON "role"."id_role" = "users"."role_id"
JOIN "Dealer_data"."distributor" ON "distributor"."id_distributor" = "users"."distributor_id"
WHERE "users"."id_users" = '1'
ERROR - 2017-07-12 16:42:38 --> Severity: Error --> Call to a member function row() on a non-object /var/www/demo-ds.token.kg/application/models/Account_model.php 17
ERROR - 2017-07-12 16:43:36 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  таблица &quot;rol&quot; отсутствует в предложении FROM
LINE 1: ...users&quot;.&quot;token_number&quot;, &quot;distributor&quot;.&quot;full_name&quot;, &quot;rol&quot;.&quot;nam...
                                                             ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 16:43:36 --> Query error: ОШИБКА:  таблица "rol" отсутствует в предложении FROM
LINE 1: ...users"."token_number", "distributor"."full_name", "rol"."nam...
                                                             ^ - Invalid query: SELECT CONCAT (users.surname, ' ', "users"."name", ' ', users.patronymic_name) AS UserName, "users"."cert_number", "users"."token_number", "distributor"."full_name", "rol"."name" AS "UserRole"
FROM "Dealer_data"."users"
JOIN "Dealer_data"."role" ON "role"."id_role" = "users"."role_id"
JOIN "Dealer_data"."distributor" ON "distributor"."id_distributor" = "users"."distributor_id"
WHERE "users"."id_users" = '1'
ERROR - 2017-07-12 16:43:36 --> Severity: Error --> Call to a member function row() on a non-object /var/www/demo-ds.token.kg/application/models/Account_model.php 17
ERROR - 2017-07-12 16:43:51 --> Severity: Warning --> SoapClient::SoapClient(): php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:43:51 --> Severity: Warning --> SoapClient::SoapClient(http://pkiserviced.ubr.kg/pkiservice.php?wsdl): failed to open stream: php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:43:51 --> Severity: Warning --> SoapClient::SoapClient(): I/O warning : failed to load external entity &quot;http://pkiserviced.ubr.kg/pkiservice.php?wsdl&quot; /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:43:51 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/demo-ds.token.kg/system/core/Output.php:528) /var/www/demo-ds.token.kg/system/core/Common.php 573
ERROR - 2017-07-12 16:43:51 --> Severity: Error --> SOAP-ERROR: Parsing WSDL: Couldn't load from 'http://pkiserviced.ubr.kg/pkiservice.php?wsdl' : failed to load external entity "http://pkiserviced.ubr.kg/pkiservice.php?wsdl"
 /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:44:27 --> Severity: Warning --> SoapClient::SoapClient(): php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:44:27 --> Severity: Warning --> SoapClient::SoapClient(http://pkiserviced.ubr.kg/pkiservice.php?wsdl): failed to open stream: php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:44:27 --> Severity: Warning --> SoapClient::SoapClient(): I/O warning : failed to load external entity &quot;http://pkiserviced.ubr.kg/pkiservice.php?wsdl&quot; /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:44:27 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/demo-ds.token.kg/system/core/Output.php:528) /var/www/demo-ds.token.kg/system/core/Common.php 573
ERROR - 2017-07-12 16:44:27 --> Severity: Error --> SOAP-ERROR: Parsing WSDL: Couldn't load from 'http://pkiserviced.ubr.kg/pkiservice.php?wsdl' : failed to load external entity "http://pkiserviced.ubr.kg/pkiservice.php?wsdl"
 /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:44:52 --> Severity: Warning --> SoapClient::SoapClient(): php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:44:52 --> Severity: Warning --> SoapClient::SoapClient(http://pkiserviced.ubr.kg/pkiservice.php?wsdl): failed to open stream: php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:44:52 --> Severity: Warning --> SoapClient::SoapClient(): I/O warning : failed to load external entity &quot;http://pkiserviced.ubr.kg/pkiservice.php?wsdl&quot; /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:44:52 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/demo-ds.token.kg/system/core/Output.php:528) /var/www/demo-ds.token.kg/system/core/Common.php 573
ERROR - 2017-07-12 16:44:52 --> Severity: Error --> SOAP-ERROR: Parsing WSDL: Couldn't load from 'http://pkiserviced.ubr.kg/pkiservice.php?wsdl' : failed to load external entity "http://pkiserviced.ubr.kg/pkiservice.php?wsdl"
 /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:45:30 --> Severity: Warning --> SoapClient::SoapClient(): php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:45:30 --> Severity: Warning --> SoapClient::SoapClient(http://pkiserviced.ubr.kg/pkiservice.php?wsdl): failed to open stream: php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:45:30 --> Severity: Warning --> SoapClient::SoapClient(): I/O warning : failed to load external entity &quot;http://pkiserviced.ubr.kg/pkiservice.php?wsdl&quot; /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:45:30 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/demo-ds.token.kg/system/core/Output.php:528) /var/www/demo-ds.token.kg/system/core/Common.php 573
ERROR - 2017-07-12 16:45:30 --> Severity: Error --> SOAP-ERROR: Parsing WSDL: Couldn't load from 'http://pkiserviced.ubr.kg/pkiservice.php?wsdl' : failed to load external entity "http://pkiserviced.ubr.kg/pkiservice.php?wsdl"
 /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:46:12 --> Severity: Warning --> SoapClient::SoapClient(): php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:46:12 --> Severity: Warning --> SoapClient::SoapClient(http://pkiserviced.ubr.kg/pkiservice.php?wsdl): failed to open stream: php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:46:12 --> Severity: Warning --> SoapClient::SoapClient(): I/O warning : failed to load external entity &quot;http://pkiserviced.ubr.kg/pkiservice.php?wsdl&quot; /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:46:12 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/demo-ds.token.kg/system/core/Output.php:528) /var/www/demo-ds.token.kg/system/core/Common.php 573
ERROR - 2017-07-12 16:46:12 --> Severity: Error --> SOAP-ERROR: Parsing WSDL: Couldn't load from 'http://pkiserviced.ubr.kg/pkiservice.php?wsdl' : failed to load external entity "http://pkiserviced.ubr.kg/pkiservice.php?wsdl"
 /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:46:20 --> Severity: Warning --> SoapClient::SoapClient(): php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:46:20 --> Severity: Warning --> SoapClient::SoapClient(http://pkiserviced.ubr.kg/pkiservice.php?wsdl): failed to open stream: php_network_getaddresses: getaddrinfo failed: Name or service not known /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:46:20 --> Severity: Warning --> SoapClient::SoapClient(): I/O warning : failed to load external entity &quot;http://pkiserviced.ubr.kg/pkiservice.php?wsdl&quot; /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:46:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/demo-ds.token.kg/system/core/Output.php:528) /var/www/demo-ds.token.kg/system/core/Common.php 573
ERROR - 2017-07-12 16:46:20 --> Severity: Error --> SOAP-ERROR: Parsing WSDL: Couldn't load from 'http://pkiserviced.ubr.kg/pkiservice.php?wsdl' : failed to load external entity "http://pkiserviced.ubr.kg/pkiservice.php?wsdl"
 /var/www/demo-ds.token.kg/application/models/Requisites_model.php 45
ERROR - 2017-07-12 16:46:43 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  таблица &quot;rol&quot; отсутствует в предложении FROM
LINE 1: ...users&quot;.&quot;token_number&quot;, &quot;distributor&quot;.&quot;full_name&quot;, &quot;rol&quot;.&quot;nam...
                                                             ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 16:46:43 --> Query error: ОШИБКА:  таблица "rol" отсутствует в предложении FROM
LINE 1: ...users"."token_number", "distributor"."full_name", "rol"."nam...
                                                             ^ - Invalid query: SELECT CONCAT (users.surname, ' ', "users"."name", ' ', users.patronymic_name) AS UserName, "users"."cert_number", "users"."token_number", "distributor"."full_name", "rol"."name" AS "UserRole"
FROM "Dealer_data"."users"
JOIN "Dealer_data"."role" ON "role"."id_role" = "users"."role_id"
JOIN "Dealer_data"."distributor" ON "distributor"."id_distributor" = "users"."distributor_id"
WHERE "users"."id_users" = '1'
ERROR - 2017-07-12 16:46:43 --> Severity: Error --> Call to a member function row() on a non-object /var/www/demo-ds.token.kg/application/models/Account_model.php 17
ERROR - 2017-07-12 16:47:11 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  таблица &quot;rol&quot; отсутствует в предложении FROM
LINE 1: ...users&quot;.&quot;token_number&quot;, &quot;distributor&quot;.&quot;full_name&quot;, &quot;rol&quot;.&quot;nam...
                                                             ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 16:47:11 --> Query error: ОШИБКА:  таблица "rol" отсутствует в предложении FROM
LINE 1: ...users"."token_number", "distributor"."full_name", "rol"."nam...
                                                             ^ - Invalid query: SELECT CONCAT (users.surname, ' ', "users"."name", ' ', users.patronymic_name) AS UserName, "users"."cert_number", "users"."token_number", "distributor"."full_name", "rol"."name" AS "UserRole"
FROM "Dealer_data"."users"
JOIN "Dealer_data"."role" ON "role"."id_role" = "users"."role_id"
JOIN "Dealer_data"."distributor" ON "distributor"."id_distributor" = "users"."distributor_id"
WHERE "users"."id_users" = '1'
ERROR - 2017-07-12 16:47:35 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  таблица &quot;rol&quot; отсутствует в предложении FROM
LINE 1: ...users&quot;.&quot;token_number&quot;, &quot;distributor&quot;.&quot;full_name&quot;, &quot;rol&quot;.&quot;nam...
                                                             ^ /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 16:47:35 --> Query error: ОШИБКА:  таблица "rol" отсутствует в предложении FROM
LINE 1: ...users"."token_number", "distributor"."full_name", "rol"."nam...
                                                             ^ - Invalid query: SELECT CONCAT (users.surname, ' ', "users"."name", ' ', users.patronymic_name) AS UserName, "users"."cert_number", "users"."token_number", "distributor"."full_name", "rol"."name" AS "UserRole"
FROM "Dealer_data"."users"
JOIN "Dealer_data"."role" ON "role"."id_role" = "users"."role_id"
JOIN "Dealer_data"."distributor" ON "distributor"."id_distributor" = "users"."distributor_id"
WHERE "users"."id_users" = '1'
ERROR - 2017-07-12 21:20:36 --> 404 Page Not Found: Dash/sd
ERROR - 2017-07-12 21:20:39 --> 404 Page Not Found: Dash/sd
ERROR - 2017-07-12 21:21:01 --> 404 Page Not Found: Dash/main_view
ERROR - 2017-07-12 21:21:09 --> 404 Page Not Found: Dash/main_view
ERROR - 2017-07-12 21:21:14 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:21:20 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:21:33 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:21:52 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:22:50 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:22:50 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:22:50 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:22:51 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:22:51 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:22:51 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:23:09 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:24:49 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:26:40 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:26:48 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:27:09 --> 404 Page Not Found: Dash/5
ERROR - 2017-07-12 21:30:33 --> Severity: Notice --> Undefined variable: config /var/www/demo-ds.token.kg/application/controllers/Dash.php 41
ERROR - 2017-07-12 21:34:44 --> Severity: Parsing Error --> syntax error, unexpected '$message' (T_VARIABLE) /var/www/demo-ds.token.kg/application/controllers/Dash.php 56
ERROR - 2017-07-12 22:40:37 --> Severity: Warning --> Missing argument 1 for Messages_model::record_count(), called in /var/www/demo-ds.token.kg/application/controllers/Dash.php on line 22 and defined /var/www/demo-ds.token.kg/application/models/Messages_model.php 29
ERROR - 2017-07-12 22:40:37 --> Severity: Notice --> Undefined variable: status /var/www/demo-ds.token.kg/application/models/Messages_model.php 30
ERROR - 2017-07-12 22:41:55 --> Severity: Error --> Call to undefined method Dash::pagination_gen() /var/www/demo-ds.token.kg/application/controllers/Dash.php 42
ERROR - 2017-07-12 22:42:55 --> Severity: Notice --> Undefined variable: pagination /var/www/demo-ds.token.kg/application/views/template/simple/main.php 37
ERROR - 2017-07-12 22:44:22 --> Severity: Warning --> Missing argument 2 for Messages_model::create_message(), called in /var/www/demo-ds.token.kg/application/controllers/Dash.php on line 56 and defined /var/www/demo-ds.token.kg/application/models/Messages_model.php 21
ERROR - 2017-07-12 22:44:22 --> Severity: Notice --> Undefined variable: status /var/www/demo-ds.token.kg/application/models/Messages_model.php 23
ERROR - 2017-07-12 22:44:22 --> Severity: Notice --> Use of undefined constant users_id - assumed 'users_id' /var/www/demo-ds.token.kg/application/models/Messages_model.php 24
ERROR - 2017-07-12 22:44:26 --> Severity: Warning --> Missing argument 2 for Messages_model::create_message(), called in /var/www/demo-ds.token.kg/application/controllers/Dash.php on line 56 and defined /var/www/demo-ds.token.kg/application/models/Messages_model.php 21
ERROR - 2017-07-12 22:44:26 --> Severity: Notice --> Undefined variable: status /var/www/demo-ds.token.kg/application/models/Messages_model.php 23
ERROR - 2017-07-12 22:44:26 --> Severity: Notice --> Use of undefined constant users_id - assumed 'users_id' /var/www/demo-ds.token.kg/application/models/Messages_model.php 24
ERROR - 2017-07-12 22:53:24 --> Severity: Notice --> Undefined property: Dash::$per_page /var/www/demo-ds.token.kg/application/controllers/Dash.php 46
ERROR - 2017-07-12 22:53:24 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  оператор не существует: character = integer
LINE 4: WHERE &quot;messages&quot;.&quot;status&quot; = 2
                                  ^
HINT:  Оператор с данными именем и типами аргументов не найден. Возможно, вам следует добавить явные приведения типов. /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 22:53:24 --> Query error: ОШИБКА:  оператор не существует: character = integer
LINE 4: WHERE "messages"."status" = 2
                                  ^
HINT:  Оператор с данными именем и типами аргументов не найден. Возможно, вам следует добавить явные приведения типов. - Invalid query: SELECT "messages"."message", to_char(messages.creating_datetime, 'DD.MM.YYYY HH24:MI') AS creating_datetime, "users"."surname", "users"."name"
FROM "Dealer_data"."messages"
JOIN "Dealer_data"."users" ON "users"."id_users"="messages"."users_id"
WHERE "messages"."status" = 2
ORDER BY "creating_datetime" DESC
ERROR - 2017-07-12 22:53:53 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  оператор не существует: character = integer
LINE 4: WHERE &quot;messages&quot;.&quot;status&quot; = 2
                                  ^
HINT:  Оператор с данными именем и типами аргументов не найден. Возможно, вам следует добавить явные приведения типов. /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 22:53:53 --> Query error: ОШИБКА:  оператор не существует: character = integer
LINE 4: WHERE "messages"."status" = 2
                                  ^
HINT:  Оператор с данными именем и типами аргументов не найден. Возможно, вам следует добавить явные приведения типов. - Invalid query: SELECT "messages"."message", to_char(messages.creating_datetime, 'DD.MM.YYYY HH24:MI') AS creating_datetime, "users"."surname", "users"."name"
FROM "Dealer_data"."messages"
JOIN "Dealer_data"."users" ON "users"."id_users"="messages"."users_id"
WHERE "messages"."status" = 2
ORDER BY "creating_datetime" DESC
 LIMIT 5
ERROR - 2017-07-12 23:01:18 --> Severity: Warning --> Missing argument 2 for Messages_model::create_message(), called in /var/www/demo-ds.token.kg/application/controllers/Dash.php on line 62 and defined /var/www/demo-ds.token.kg/application/models/Messages_model.php 21
ERROR - 2017-07-12 23:01:18 --> Severity: Notice --> Undefined variable: status /var/www/demo-ds.token.kg/application/models/Messages_model.php 23
ERROR - 2017-07-12 23:01:18 --> Severity: Notice --> Use of undefined constant users_id - assumed 'users_id' /var/www/demo-ds.token.kg/application/models/Messages_model.php 24
ERROR - 2017-07-12 23:01:18 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  нулевое значение в колонке &quot;status&quot; нарушает ограничение NOT NULL
DETAIL:  Ошибочная строка содержит (30, null, null, qwe, 2017-07-12 23:01:18.349387, 5). /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 23:01:18 --> Query error: ОШИБКА:  нулевое значение в колонке "status" нарушает ограничение NOT NULL
DETAIL:  Ошибочная строка содержит (30, null, null, qwe, 2017-07-12 23:01:18.349387, 5). - Invalid query: INSERT INTO "Dealer_data"."messages" ("message", "status", "users_id") VALUES ('qwe', NULL, '5')
ERROR - 2017-07-12 23:01:50 --> Severity: Warning --> Missing argument 2 for Messages_model::create_message(), called in /var/www/demo-ds.token.kg/application/controllers/Dash.php on line 62 and defined /var/www/demo-ds.token.kg/application/models/Messages_model.php 21
ERROR - 2017-07-12 23:01:50 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  нулевое значение в колонке &quot;status&quot; нарушает ограничение NOT NULL
DETAIL:  Ошибочная строка содержит (31, null, null, qwe, 2017-07-12 23:01:50.122831, 5). /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 23:01:50 --> Query error: ОШИБКА:  нулевое значение в колонке "status" нарушает ограничение NOT NULL
DETAIL:  Ошибочная строка содержит (31, null, null, qwe, 2017-07-12 23:01:50.122831, 5). - Invalid query: INSERT INTO "Dealer_data"."messages" ("message", "status", "users_id") VALUES ('qwe', NULL, '5')
ERROR - 2017-07-12 23:01:54 --> Severity: Warning --> Missing argument 2 for Messages_model::create_message(), called in /var/www/demo-ds.token.kg/application/controllers/Dash.php on line 62 and defined /var/www/demo-ds.token.kg/application/models/Messages_model.php 21
ERROR - 2017-07-12 23:01:54 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  нулевое значение в колонке &quot;status&quot; нарушает ограничение NOT NULL
DETAIL:  Ошибочная строка содержит (32, null, null, sdf, 2017-07-12 23:01:54.750227, 5). /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 23:01:54 --> Query error: ОШИБКА:  нулевое значение в колонке "status" нарушает ограничение NOT NULL
DETAIL:  Ошибочная строка содержит (32, null, null, sdf, 2017-07-12 23:01:54.750227, 5). - Invalid query: INSERT INTO "Dealer_data"."messages" ("message", "status", "users_id") VALUES ('sdf', NULL, '5')
ERROR - 2017-07-12 23:03:49 --> Severity: Warning --> Missing argument 2 for Messages_model::create_message(), called in /var/www/demo-ds.token.kg/application/controllers/Dash.php on line 62 and defined /var/www/demo-ds.token.kg/application/models/Messages_model.php 21
ERROR - 2017-07-12 23:03:49 --> Severity: Warning --> pg_query(): Query failed: ОШИБКА:  нулевое значение в колонке &quot;status&quot; нарушает ограничение NOT NULL
DETAIL:  Ошибочная строка содержит (33, null, null, sdfsdfsdf, 2017-07-12 23:03:49.315717, 5). /var/www/demo-ds.token.kg/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2017-07-12 23:03:49 --> Query error: ОШИБКА:  нулевое значение в колонке "status" нарушает ограничение NOT NULL
DETAIL:  Ошибочная строка содержит (33, null, null, sdfsdfsdf, 2017-07-12 23:03:49.315717, 5). - Invalid query: INSERT INTO "Dealer_data"."messages" ("message", "status", "users_id") VALUES ('sdfsdfsdf', NULL, '5')
ERROR - 2017-07-12 23:16:22 --> Severity: Parsing Error --> syntax error, unexpected 'return' (T_RETURN) /var/www/demo-ds.token.kg/application/controllers/Dash.php 37
ERROR - 2017-07-12 23:21:51 --> Severity: Error --> Call to undefined method CI_DB_postgre_driver::count_result_all() /var/www/demo-ds.token.kg/application/models/Messages_model.php 32
ERROR - 2017-07-12 23:30:03 --> Severity: Notice --> Use of undefined constant users_id - assumed 'users_id' /var/www/demo-ds.token.kg/application/models/Messages_model.php 23
ERROR - 2017-07-12 23:30:16 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/simple/account.php 39
ERROR - 2017-07-12 23:32:08 --> Severity: Notice --> Undefined variable: status /var/www/demo-ds.token.kg/application/controllers/Dash.php 26
ERROR - 2017-07-12 23:41:53 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/demo-ds.token.kg/application/views/template/simple/pki.php 55
ERROR - 2017-07-12 23:52:11 --> Severity: Notice --> Use of undefined constant users_id - assumed 'users_id' /var/www/demo-ds.token.kg/application/models/Messages_model.php 23
