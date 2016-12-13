<?
/* make the database connection to setclient */
$conn  = mysql_connect("localhost", "people1_portal", "portal00%");

/* connect to a particular database */
mysql_select_db("people1_portal", $conn) or die ("could not connect");

?>