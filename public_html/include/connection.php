<?php
include_once('common.inc.php');

$conn2 = mysql_connect($db_settings['host'],$db_settings['user'],$db_settings['password']);
mysql_select_db($db_settings['dbname'],$conn2) or die("error:" . mysql_error());


?>