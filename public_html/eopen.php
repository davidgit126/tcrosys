<?php
if (empty($emailHistoryTable)) {
    $emailHistoryTable = "emailhistory";
}
extract ($_GET);
extract ($_POST);

include("include/connection.php");

$user=$_SERVER["PHP_AUTH_USER"];
$ip=$_SERVER["REMOTE_ADDR"];
$year = date("Y");
$month = date("m");
$day = date("d");
$julian = "$year$month$day";
$hour = date("h");
$min = date("i");
$sec = date("s");
$ampm = date("a");
$tstamp = "$hour:$min:$sec$ampm";


$emailid=$_GET["id"];

$query = "SELECT numopens FROM ".mysql_real_escape_string($emailHistoryTable)." WHERE id='".mysql_real_escape_string($emailid)."' LIMIT 1";
$result = mysql_query($query, $conn2) or die("error:" . mysql_error());
if($row=mysql_fetch_assoc($result))
{
    $numopens = $row['numopens'];

    $moreopens = $numopens+1;
}

if (!$numopens) {$moreopens=1;}

$sql = "UPDATE ".mysql_real_escape_string($emailHistoryTable)." SET
lastopen = \"$julian\",
numopens = \"$moreopens\"
WHERE id = \"$emailid\"";

$result = @mysql_query($sql,$conn2);