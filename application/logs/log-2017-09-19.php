<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-09-19 10:09:57 --> Unable to write cache file: /var/www/demo-ds.token.kg/application/cache/
ERROR - 2017-09-19 11:06:37 --> Severity: Error --> Call to undefined method Statistics_model::get_inn_list_by_date() /var/www/demo-ds.token.kg/application/controllers/Statistics.php 209
ERROR - 2017-09-19 11:07:29 --> Severity: Warning --> mysqli::real_connect(): (HY000/2003): Can't connect to MySQL server on 'db.dostek.kg' (4) /var/www/demo-ds.token.kg/system/database/drivers/mysqli/mysqli_driver.php 202
ERROR - 2017-09-19 11:07:29 --> Unable to connect to the database
ERROR - 2017-09-19 11:08:18 --> Severity: Warning --> mysqli::real_connect(): (HY000/2003): Can't connect to MySQL server on '172.16.1.15' (4) /var/www/demo-ds.token.kg/system/database/drivers/mysqli/mysqli_driver.php 202
ERROR - 2017-09-19 11:08:18 --> Unable to connect to the database
ERROR - 2017-09-19 11:13:25 --> Severity: Error --> Call to undefined function result() /var/www/demo-ds.token.kg/application/models/Statistics_model.php 164
ERROR - 2017-09-19 11:38:21 --> Severity: Warning --> Missing argument 1 for Statistics_model::get_statistics_pki(), called in /var/www/demo-ds.token.kg/application/controllers/Statistics.php on line 210 and defined /var/www/demo-ds.token.kg/application/models/Statistics_model.php 160
ERROR - 2017-09-19 11:38:21 --> Severity: Warning --> Missing argument 2 for Statistics_model::get_statistics_pki(), called in /var/www/demo-ds.token.kg/application/controllers/Statistics.php on line 210 and defined /var/www/demo-ds.token.kg/application/models/Statistics_model.php 160
ERROR - 2017-09-19 11:38:21 --> Severity: Warning --> Missing argument 3 for Statistics_model::get_statistics_pki(), called in /var/www/demo-ds.token.kg/application/controllers/Statistics.php on line 210 and defined /var/www/demo-ds.token.kg/application/models/Statistics_model.php 160
ERROR - 2017-09-19 11:38:21 --> Severity: Notice --> Undefined variable: inn /var/www/demo-ds.token.kg/application/models/Statistics_model.php 167
ERROR - 2017-09-19 11:38:21 --> Severity: Notice --> Undefined variable: period_start /var/www/demo-ds.token.kg/application/models/Statistics_model.php 168
ERROR - 2017-09-19 11:38:21 --> Severity: Notice --> Undefined variable: period_end /var/www/demo-ds.token.kg/application/models/Statistics_model.php 169
ERROR - 2017-09-19 11:38:21 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`NULL`
AND `DateStart` < `IS` `NULL`' at line 6 - Invalid query: SELECT `DateStart`, `inn`
FROM `Cert`
JOIN `Owner` ON `Cert`.`OwnerID` = `Owner`.`id`
JOIN `Org` ON `Owner`.`OrgID` = `Org`.`id`
WHERE `inn` IS NULL
AND `DateStart` > `IS` `NULL`
AND `DateStart` < `IS` `NULL`
ERROR - 2017-09-19 11:38:21 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/demo-ds.token.kg/system/core/Exceptions.php:272) /var/www/demo-ds.token.kg/system/core/Common.php 573
ERROR - 2017-09-19 11:40:38 --> Severity: Warning --> Missing argument 1 for Statistics_model::get_statistics_pki(), called in /var/www/demo-ds.token.kg/application/controllers/Statistics.php on line 210 and defined /var/www/demo-ds.token.kg/application/models/Statistics_model.php 160
ERROR - 2017-09-19 11:40:38 --> Severity: Warning --> Missing argument 2 for Statistics_model::get_statistics_pki(), called in /var/www/demo-ds.token.kg/application/controllers/Statistics.php on line 210 and defined /var/www/demo-ds.token.kg/application/models/Statistics_model.php 160
ERROR - 2017-09-19 11:40:38 --> Severity: Notice --> Undefined variable: period_start /var/www/demo-ds.token.kg/application/models/Statistics_model.php 168
ERROR - 2017-09-19 11:40:38 --> Severity: Notice --> Undefined variable: period_end /var/www/demo-ds.token.kg/application/models/Statistics_model.php 169
ERROR - 2017-09-19 11:40:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`NULL`
AND `DateStart` < `IS` `NULL`' at line 6 - Invalid query: SELECT `DateStart`, `inn`
FROM `Cert`
JOIN `Owner` ON `Cert`.`OwnerID` = `Owner`.`id`
JOIN `Org` ON `Owner`.`OrgID` = `Org`.`id`
WHERE `inn` IS NULL
AND `DateStart` > `IS` `NULL`
AND `DateStart` < `IS` `NULL`
ERROR - 2017-09-19 11:41:42 --> Severity: Warning --> Missing argument 1 for Statistics_model::get_statistics_pki(), called in /var/www/demo-ds.token.kg/application/controllers/Statistics.php on line 210 and defined /var/www/demo-ds.token.kg/application/models/Statistics_model.php 160
ERROR - 2017-09-19 11:41:42 --> Severity: Warning --> Missing argument 2 for Statistics_model::get_statistics_pki(), called in /var/www/demo-ds.token.kg/application/controllers/Statistics.php on line 210 and defined /var/www/demo-ds.token.kg/application/models/Statistics_model.php 160
ERROR - 2017-09-19 11:41:42 --> Severity: Warning --> Missing argument 3 for Statistics_model::get_statistics_pki(), called in /var/www/demo-ds.token.kg/application/controllers/Statistics.php on line 210 and defined /var/www/demo-ds.token.kg/application/models/Statistics_model.php 160
ERROR - 2017-09-19 11:41:42 --> Severity: Notice --> Undefined variable: inn /var/www/demo-ds.token.kg/application/models/Statistics_model.php 167
ERROR - 2017-09-19 11:41:42 --> Severity: Notice --> Undefined variable: period_start /var/www/demo-ds.token.kg/application/models/Statistics_model.php 168
ERROR - 2017-09-19 11:41:42 --> Severity: Notice --> Undefined variable: period_end /var/www/demo-ds.token.kg/application/models/Statistics_model.php 169
ERROR - 2017-09-19 11:41:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`NULL`
AND `DateStart` < `IS` `NULL`' at line 6 - Invalid query: SELECT `DateStart`, `inn`
FROM `Cert`
JOIN `Owner` ON `Cert`.`OwnerID` = `Owner`.`id`
JOIN `Org` ON `Owner`.`OrgID` = `Org`.`id`
WHERE `inn` IS NULL
AND `DateStart` > `IS` `NULL`
AND `DateStart` < `IS` `NULL`
ERROR - 2017-09-19 11:41:42 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/demo-ds.token.kg/system/core/Exceptions.php:272) /var/www/demo-ds.token.kg/system/core/Common.php 573
ERROR - 2017-09-19 15:43:03 --> Severity: Notice --> Undefined variable: period_start /var/www/demo-ds.token.kg/application/controllers/Statistics.php 190
ERROR - 2017-09-19 15:43:03 --> Severity: Notice --> Undefined variable: period_end /var/www/demo-ds.token.kg/application/controllers/Statistics.php 191
ERROR - 2017-09-19 15:43:03 --> Severity: Notice --> Undefined variable: period_start /var/www/demo-ds.token.kg/application/controllers/Statistics.php 193
ERROR - 2017-09-19 15:43:03 --> Severity: Notice --> Undefined variable: period_end /var/www/demo-ds.token.kg/application/controllers/Statistics.php 193
ERROR - 2017-09-19 15:43:03 --> Severity: Notice --> Undefined variable: period_start /var/www/demo-ds.token.kg/application/controllers/Statistics.php 203
ERROR - 2017-09-19 15:43:03 --> Severity: Notice --> Undefined variable: period_end /var/www/demo-ds.token.kg/application/controllers/Statistics.php 203
ERROR - 2017-09-19 15:43:03 --> Severity: Notice --> Undefined variable: period_start /var/www/demo-ds.token.kg/application/controllers/Statistics.php 203
ERROR - 2017-09-19 15:43:03 --> Severity: Notice --> Undefined variable: period_end /var/www/demo-ds.token.kg/application/controllers/Statistics.php 203
ERROR - 2017-09-19 15:43:03 --> Severity: Notice --> Undefined variable: period_start /var/www/demo-ds.token.kg/application/controllers/Statistics.php 209
ERROR - 2017-09-19 15:43:03 --> Severity: Notice --> Undefined variable: period_end /var/www/demo-ds.token.kg/application/controllers/Statistics.php 209
ERROR - 2017-09-19 16:19:21 --> Severity: Notice --> Undefined index: count /var/www/demo-ds.token.kg/application/controllers/Statistics.php 255
ERROR - 2017-09-19 16:19:21 --> Severity: Notice --> Object of class stdClass could not be converted to int /var/www/demo-ds.token.kg/application/controllers/Statistics.php 255
ERROR - 2017-09-19 16:20:36 --> Severity: Notice --> Object of class stdClass could not be converted to int /var/www/demo-ds.token.kg/application/controllers/Statistics.php 256
ERROR - 2017-09-19 16:21:17 --> Severity: Notice --> Object of class stdClass could not be converted to int /var/www/demo-ds.token.kg/application/controllers/Statistics.php 256
ERROR - 2017-09-19 16:21:41 --> Severity: Notice --> Object of class stdClass could not be converted to int /var/www/demo-ds.token.kg/application/controllers/Statistics.php 256
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 68
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 71
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 73
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 75
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 78
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 79
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 82
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 68
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 71
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 73
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 75
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 78
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 79
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 82
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 68
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 71
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 73
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 75
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 78
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 79
ERROR - 2017-09-19 17:33:53 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 82
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 68
ERROR - 2017-09-19 17:35:08 --> Severity: 4096 --> Object of class stdClass could not be converted to string /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 68
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 71
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 73
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 75
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 78
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 79
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 82
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 68
ERROR - 2017-09-19 17:35:08 --> Severity: 4096 --> Object of class stdClass could not be converted to string /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 68
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 71
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 73
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 75
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 78
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 79
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 82
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 68
ERROR - 2017-09-19 17:35:08 --> Severity: 4096 --> Object of class stdClass could not be converted to string /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 68
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 71
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 73
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 75
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 78
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 79
ERROR - 2017-09-19 17:35:08 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 82
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 71
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 73
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 75
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 78
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 79
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 82
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 71
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 73
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 75
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 78
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 79
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 82
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 71
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 73
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 75
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 78
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 79
ERROR - 2017-09-19 17:36:43 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 82
ERROR - 2017-09-19 17:37:38 --> Severity: Error --> Unsupported operand types /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 75
ERROR - 2017-09-19 17:37:57 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 82
ERROR - 2017-09-19 17:37:57 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 82
ERROR - 2017-09-19 17:37:57 --> Severity: Notice --> Trying to get property of non-object /var/www/demo-ds.token.kg/application/views/template/statistics/boss/statistics_error_eds.php 82
