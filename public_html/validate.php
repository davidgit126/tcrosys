<?php
include("include/connection.php");
include("admin/functions.php");

if ($_GET) {extract ($_GET );}
if ($_SESSION) {extract ($_SESSION );}
if ($_POST) {extract ($_POST );}
if ($_SERVER) {extract ($_SERVER );}
 
$year = date("Y");
$month = date("m");
$day = date("d");

$julian = "$year$month$day";
$today = date("Y-m-d");
$ip=$_SERVER["REMOTE_ADDR"];


$nowday = date("d");
$nowmonthword = date("M");
$nowmonth = date("m");
$nowyear = date("Y");

$hour = date("h");
$min = date("i");
$sec = date("s");
$ampm = date("a");

$tstamp = "$hour:$min:$sec$ampm";
$recordid=$_GET["id"];
$whattype=$_GET["w"];
$m=$_GET["m"];
$typeemail=$_GET["t"];
$emailid=$_GET["eid"];

$secret_code = 'htdiisawesome';


$query = "SELECT companyid, companyname, companycontact, companyemail, companyreply, companyaddress, companycity, companystate, companyzip, companyphone, companyfax, companywebsite, autoscheduler, reseller, htdiwebsite, adminsinglepayment1, adminsinglepayment2, admincouplepayment1, admincouplepayment2, single, couple, creditcard, paypal2, ach, singlefull, singledownpay1, singlepayment, couplefull, coupledownpay1, couplepayment, threeinone, paypal, months, perdelete, livehuman, dbname, dropdowncreditors, dropdownbegin, dropdowntails, autoresponder, bautoresponder, cautoresponder, helpdesk, companyheader, timezone, roundrobinfeature FROM companyinfo WHERE companyid='1'";
    $result = mysql_query($query, $conn2) or die("error:" . mysql_error());
    $col_count = mysql_num_fields($result);
    while($row=mysql_fetch_row($result))
    {
        $companyid = $row[0];
        $companyname = $row[1];
        $companycontact = $row[2];
        $companyemail = $row[3];
        $companyreply = $row[4];
        $companyaddress = $row[5];
        $companycity = $row[6];
        $companystate = $row[7];
        $companyzip = $row[8];                        
        $companyphone = $row[9];         
        $companyfax = $row[10];         
        $companywebsite = $row[11];              
        $autoscheduler = $row[12];          
        $reseller = $row[13];           
        $htdiwebsite = $row[14];           
        $adminsinglepayment1 = $row[15];
        $adminsinglepayment2 = $row[16];
        $admincouplepayment1 = $row[17];
        $admincouplepayment2 = $row[18];                                
        $single = $row[19];                                
        $couple = $row[20];                                
        $creditcard = $row[21];                 
        $paypal2 = $row[22];                 
        $ach = $row[23];                 
        $singlefull = $row[24];          
        $singledownpay1 = $row[25];          
        $singlepayment = $row[26];          
        $couplefull = $row[27];          
        $coupledownpay1 = $row[28];          
        $couplepayment = $row[29];          
        $threeinone = $row[30];          
        $paypal = $row[31];          
        $months = $row[32];          
        $perdelete = $row[33];          
        $livehuman = $row[34];          
        $dbname = $row[35];          
        $dropdowncreditors = $row[36];    
        $dropdownbegin = $row[37];    
        $dropdowntails = $row[38];                            
        $autoresponder = $row[39];                            
        $bautoresponder = $row[40];                            
        $cautoresponder = $row[41];                            
        $helpdesk = $row[42];                            
        $companyheader = $row[43];                            
        $timezone = $row[44];                            
        $roundrobinfeature = $row[45];                            
    }

    if($companyheader !=""){
$insertheader = "<p align=center><img border=0 src=$companyheader></p>";
}else{
$insertheader = "";
}

///////CHECK FOR PROSPECTS
if ($whattype=="p"){
    $query = "SELECT name, address, city, state, zip, email, fax, phone, ssnum, DATE_FORMAT(birthdate, \"%m-%d-%Y\") as bdate, country, username, password, broker_id, dealer_id, affiliate_id, comments, reseller_id, status, plan, DATE_FORMAT(dateresults, \"%m-%d-%Y\") as dateresults, singlecouple, showstatus, budgetday, avssnurl, logins, DATE_FORMAT(lastlogin, \"%m-%d-%Y\") as lastlogin, altphone, dateresults, fonttype, jointwith, prospectclient, sendtohtdi, pp, altphone2, altphone3, altphone4, DATE_FORMAT(canceldate, \"%m-%d-%Y\") as canceldate  FROM clients WHERE id='$recordid' ";
    $result = mysql_query($query, $conn2) or die("error:" . mysql_error());
    $col_count = mysql_num_fields($result);
    while($row=mysql_fetch_row($result))
    {
        $name = $row[0];
        $address = $row[1];
        $city = $row[2];
        $state = $row[3];
        $zip = $row[4];
        $email = $row[5];
        $fax = $row[6];
        $phone = $row[7];
        $ssnum = $row[8];
        $birthdate = $row[9];
        $country = $row[10];
        $usernameu = $row[11];
        $pwdu = $row[12];
        $broker_id = $row[13];
	  $dealer_id = $row[14];
	  $affiliate_id = $row[15];
	  $comments = $row[16];
	  $reseller_id = $row[17];
	  $status = $row[18];
	  $plan = $row[19];
	  $dateresults = $row[20];
	  $singlecouple = $row[21];
	  $showstatus = $row[22];	  
	  $budgetday = $row[23];	  	  
	  $avssnurl = $row[24];	  	  	  
  	  $logins = $row[25];	  	 
	  $lastlogin = $row[26];	  	   	  
	  $altphone = $row[27];	  	   	  
	  $dateresults2 = $row[28];	  
	  $fonttype = $row[29];	  	  
	  $jointwith = $row[30];	  	 	  
	  $prospectclient = $row[31];		  
	  $sendtohtdi = $row[32];		  
  	  $pp = $row[33];	  
  	  $altphone2 = $row[34];	  
  	  $altphone3 = $row[35];	  
  	  $altphone4 = $row[36];	 
  	  $canceldate = $row[37];	 
    }
    
$formatted_email = preg_replace("/(-|\@|\.)/", "", $email);
$hashed = md5("$secret_code $formatted_email");

//////DOES EMAIL VALIDATE
if($hashed == $m) {
      print("$insertheader Thank you for validating $email.");

 $query = "UPDATE clients SET
                optMD5hash='$m',
                doubleopt='Yes',
                optdate='$today',
                opttstamp='$tstamp',
                optipaddress='$ip'
WHERE id = \"$recordid\"";
        $result = mysql_query($query, $conn2) or die("error:" . mysql_error());


////////CHECK FOR PROSPECT WELCOME
if ($typeemail=="wc"){
$query = "SELECT id, name, subject, message, type, activated, description FROM systememails WHERE name='Prospect_Welcome'";
          $result = mysql_query($query, $conn2) or die("error:" . mysql_error());
          $cnt=0;
          while($row=mysql_fetch_row($result))
          {
              $emailid           = $row[0];
              $emailname   = $row[1];
              $subject   = $row[2];
              $message   = $row[3];
              $type = $row[4];
              $activated = $row[5];              
              $description = $row[6];    
}

if($activated =="Yes"){

   
    include_once("companystrip.php");
    include_once("clientstrip.php");

$message2 = str_replace("{A_FNAME}", "$afffname", $message2);
$subject2 = str_replace("{A_FNAME}", "$afffname", $subject2);
$message2 = str_replace("{A_LNAME}", "$afflname", $message2);
$subject2 = str_replace("{A_LNAME}", "$afflname", $subject2);
$message2 = str_replace("{AFFEMAIL}", "$affemail", $message2);
$subject2 = str_replace("{AFFEMAIL}", "$affemail", $subject2);


$EMAIL_Message = "$companyskin$message2";
$EMAIL_Subject = "$subject2";
$EMAIL_From_Name = "$companyname";
$EMAIL_From = "$companyreply";
$HEADERS  = "MIME-Version: 1.0\r\n";
			$HEADERS .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$HEADERS .= "From: $EMAIL_From_Name <$EMAIL_From>\r\n";
                $formsent = mail($email, $EMAIL_Subject, removeAllSlashes($EMAIL_Message), $HEADERS, "-f $companyreply");  
}
}/////////END PROSPECT WELCOME EMAIL
////////CHECK FOR PROSPECT AUTORESPONDER EMAIL
if ($typeemail=="ar"){
    $query2 = "SELECT id, subject, message, type, days FROM autoresponders WHERE type='prospect' and id='$emailid'";
          $result2 = mysql_query($query2, $conn2) or die("error:" . mysql_error());
          $cnt=0;
          while($row2=mysql_fetch_row($result2))
          {
              $autoid           = $row2[0];
              $subject   = $row2[1];
              $message   = $row2[2];
              $type = $row2[3];
              $days = $row2[4];              
}  

if($message != "" && $email !=""){

   
    include_once("companystrip.php");
    include_once("clientstrip.php");

$message2 = str_replace("{A_FNAME}", "$afffname", $message2);
$subject2 = str_replace("{A_FNAME}", "$afffname", $subject2);
$message2 = str_replace("{A_LNAME}", "$afflname", $message2);
$subject2 = str_replace("{A_LNAME}", "$afflname", $subject2);
$message2 = str_replace("{AFFEMAIL}", "$affemail", $message2);
$subject2 = str_replace("{AFFEMAIL}", "$affemail", $subject2);


$EMAIL_Message = "$companyskin$message2";
$EMAIL_Subject = "$subject2";
$EMAIL_From_Name = "$companyname";
$EMAIL_From = "$companyreply";
$HEADERS  = "MIME-Version: 1.0\r\n";
			$HEADERS .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$HEADERS .= "From: $EMAIL_From_Name <$EMAIL_From>\r\n";
                $formsent = mail($email, $EMAIL_Subject, removeAllSlashes($EMAIL_Message), $HEADERS, "-f $companyreply");  
}
}/////////END PROSPECT AUTORESPONDER EMAIL









	
	
	exit;
    } else {
      print("$insertheader Sorry, this email does not validate");
	}


}
//////////END CHECK FOR PROSPECTS




////////////START CHECK FOR CLIENTS
?>
