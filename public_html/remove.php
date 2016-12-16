<?php
include("include/connection.php");


extract ($_GET );
@extract ($_SESSION );
extract ($_POST );
extract ($_SERVER );

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

 $query = "UPDATE clients SET
                email='',
                optMD5hash='',
                doubleopt='',
                optdate='',
                opttstamp='',
                optipaddress='$ip'
WHERE id = \"$recordid\"";
        $result = mysql_query($query, $conn2) or die("error:" . mysql_error());

$addtonote="Self removal of $email from record by prospect from $ip";
$sql_note = "INSERT INTO salesnotes
(clientid,action,counselor,repairdate,filelocation)
               VALUES
(\"$recordid\",
\"$addtonote\",
\"Prospect\",
\"$today\",
\"$tstamp\")";
$result_note = @mysql_query($sql_note,$conn2);
	
      print("$insertheader Your email address has been removed from your record.");

exit;
    } else {
      print("$insertheader Sorry, this link did not work.  Please contact us at $companyphone.");
	}//////END IF REMOVE CONFIRM

}
//////////END CHECK FOR PROSPECTS


?>