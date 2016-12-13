<?php
/*************
 * Config settings you need to change.
 ************/
$site_email_address = 'none@none.com';   // put your email address inside the quotes.

$db_settings = array();
$db_settings['host']        = 'localhost';
$db_settings['user']        = 'root';
$db_settings['password']    = '';
$db_settings['dbname']      = 'tcro_demo';



/*************
 * You should be able to leave the following code as is.
 ************/
error_reporting(E_ALL - E_NOTICE);

if (get_magic_quotes_gpc()) {
   function stripslashes_deep($value)
   {
       $value = is_array($value) ?
                   array_map('stripslashes_deep', $value) :
                   stripslashes($value);

       return $value;
   }

   $_POST = array_map('stripslashes_deep', $_POST);
   $_GET = array_map('stripslashes_deep', $_GET);
   $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
}

if(!strlen($site_email_address))
    die("Please edit /include/common.inc.php and supply your email address.");
?>
