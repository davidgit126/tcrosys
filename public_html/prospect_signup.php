<?php
extract ($_GET);
extract ($_POST);
?>
<?php

    session_start();

$ip=$_SERVER["REMOTE_ADDR"];



if($ip !="200.63.42.81"){
//if($ip !="207.225.187.242"){

    include("include/connection.php");
   
 $fontday = date("D");

        $query = "SELECT font FROM fonttypes WHERE fontday ='$fontday'"; 
        $result = mysql_query($query, $conn2) or die("error:" . mysql_error());
        $col_count = mysql_num_fields($result);
        while($row=mysql_fetch_row($result))
        {
          $fonttype = $row[0];

        } 

$query = "SELECT companyid, companyname, companycontact, companyemail, companyreply, companyaddress, companycity, companystate, companyzip, companyphone, companyfax, companywebsite, reseller, single, companyskin, roundrobinfeature FROM companyinfo WHERE companyid='1'";
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
        $reseller = $row[12];              
        $single = $row[13];              
        $companyskin = $row[14];  
		$roundrobinfeature= $row[15];
    }

//////////START ROUND ROBIN
 if($roundrobinfeature =="ON"){

$query = "SELECT salesid, affid, id FROM roundrobin WHERE (affid= '$affiliate_id' or affid ='$tier2aff' or affid='$tier3aff') && affid !='' limit 1";
    $result = @mysql_query($query, $conn2) or die("error:" . mysql_error());
    $col_count = mysql_num_fields($result);
    while($row=mysql_fetch_row($result)) 
{
		    $roundrobinid = $row[0]; 
			$roundrobinaffid= $row[1]; 
			$roundrobincheck = $row[1]; 
			}
//AFFILIATE CHECK

$query = "SELECT salesid, affid FROM roundrobin WHERE status= 'IN' ORDER BY Rand() limit 1";
    $result = @mysql_query($query, $conn2) or die("error:" . mysql_error());
    $col_count = mysql_num_fields($result);
    while($row=mysql_fetch_row($result)) 
{
		    $roundrobinid = $row[0]; 
			$roundrobinaffid = $row[1]; 

}
$sql = "UPDATE roundrobin
              SET
status = \"OUT\"
WHERE salesid = \"$roundrobinid\"";
$result = @mysql_query($sql,$conn2);

if ($roundrobinid =="") {
$sql = "UPDATE roundrobin
              SET
status = \"IN\"
WHERE status = \"OUT\"";
$result = @mysql_query($sql,$conn2);
	

$query = "SELECT salesid, affid FROM roundrobin WHERE status= 'IN' ORDER BY Rand() limit 1";
    $result = @mysql_query($query, $conn2) or die("error:" . mysql_error());
    $col_count = mysql_num_fields($result);
    while($row=mysql_fetch_row($result)) 
{
		    $roundrobinid = $row[0]; 
		    $roundrobinaffid = $row[1]; 
}
$sql = "UPDATE roundrobin
              SET
status = \"OUT\"
WHERE salesid = \"$roundrobinid\"";
$result = @mysql_query($sql,$conn2);


}//END AFFILIATE CHECK
}//////////END ROUND ROBIN


$first = $fname;
$last = $lname;
$createdate = date("Y-m-d");
        $query = "INSERT INTO clients(name, state, address, city, zip, email, phone, altphone, createdate, fonttype, username, password, comments, prospectclient, broker_id, dealer_id, affiliate_id, leadassigned, reseller_id)
                VALUES(
                '$first $last', 
                '" . mysql_real_escape_string($_POST['state']) . "',
                '" . mysql_real_escape_string($_POST['address']) . "',
                '" . mysql_real_escape_string($_POST['city']) . "',
                '" . mysql_real_escape_string($_POST['zip']) . "',
                '" . mysql_real_escape_string($_POST['email']) . "',
                '" . mysql_real_escape_string($_POST['phone']) . "',
                '" . mysql_real_escape_string($_POST['altphone']) . "',
                '$createdate',
                '$fonttype',
                '***********',
                '***********', 
                '" . mysql_real_escape_string($_POST['message']) . "',
                'Prospect',
                '" . mysql_real_escape_string($_POST['broker_id']) . "',
                '" . mysql_real_escape_string($_POST['dealer_id']) . "',
                '" . mysql_real_escape_string($_POST['affiliate_id']) . "',
                '$roundrobinid',
                '" . mysql_real_escape_string($_POST['reseller_id']) . "')";
        $result = mysql_query($query, $conn2) or die("error:" . mysql_error());





 $query = "SELECT companyid, companyname, companycontact, companyemail, companyreply, companyaddress, companycity, companystate, companyzip, companyphone, companyfax, companywebsite FROM companyinfo WHERE companyid='1'";
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

    }



$email2 = $companyemail;

	$HEADERS  = "MIME-Version: 1.0\r\n";
			$HEADERS .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$HEADERS .= "From: $companyname <$companyreply>\r\n";
            
                $subject = "New Lead Submission on $companywebsite ";
                $message = "<B>Date:</B> $createdate <BR><B>Name:</B> $first $last <BR><B>Email:</B> $email <BR><B>Phone:</B> $phone <BR><B>Comments:</B> $comments <BR><BR>Remember, you can log into your account at <a href=$companywebsite/admin>$companywebsite/admin</a> to check details on this lead";
                $formsent = mail($email2, $subject, $message, $HEADERS);  



  $name=$first;
$state=$_POST['state'];
$email=$_POST['email'];
$phone=$_POST['phone'];

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
$message2=$message;
$subject2=$subject;
$message2 = str_replace("{COMPANY}", "$companyname", $message2);
$subject2 = str_replace("{COMPANY}", "$companyname", $subject2);
$message2 = str_replace("{COMPANYADDR}", "$companyaddress", $message2);
$subject2 = str_replace("{COMPANYADDR}", "$companyaddress", $subject2);
$message2 = str_replace("{COMPANYCITY}", "$companycity", $message2);
$subject2 = str_replace("{COMPANYCITY}", "$companycity", $subject2);
$message2 = str_replace("{COMPANYSTATE}", "$companystate", $message2);
$subject2 = str_replace("{COMPANYSTATE}", "$companystate", $subject2);
$message2 = str_replace("{COMPANYZIP}", "$companyzip", $message2);
$subject2 = str_replace("{COMPANYZIP}", "$companyzip", $subject2);
$message2 = str_replace("{COMPANYPHONE}", "$companyphone", $message2);
$subject2 = str_replace("{COMPANYPHONE}", "$companyphone", $subject2);
$message2 = str_replace("{COMPANYFAX}", "$companyfax", $message2);
$subject2 = str_replace("{COMPANYFAX}", "$companyfax", $subject2);
$message2 = str_replace("{SITE}", "$companywebsite", $message2);
$subject2 = str_replace("{SITE}", "$companywebsite", $subject2);  


$message2 = str_replace("{NAME}", "$name", $message2);
$subject2 = str_replace("{NAME}", "$name", $subject2);
$message2 = str_replace("{ADDRESS}", "$address", $message2);
$subject2 = str_replace("{ADDRESS}", "$address", $subject2);
$message2 = str_replace("{CITY}", "$city", $message2);
$subject2 = str_replace("{CITY}", "$city", $subject2);
$message2 = str_replace("{STATE}", "$state", $message2);
$subject2 = str_replace("{STATE}", "$state", $subject2);
$message2 = str_replace("{ZIP}", "$zip", $message2);
$subject2 = str_replace("{ZIP}", "$zip", $subject2);
$message2 = str_replace("{PHONE}", "$phone", $message2);
$subject2 = str_replace("{PHONE}", "$phone", $subject2);
$message2 = str_replace("{FAX}", "$fax", $message2);
$subject2 = str_replace("{FAX}", "$fax", $subject2);
$message2 = str_replace("{EMAIL}", "$email", $message2);
$subject2 = str_replace("{EMAIL}", "$email", $subject2);
$message2 = str_replace("{USERNAME}", "$username", $message2);
$subject2 = str_replace("{USERNAME}", "$username", $subject2);
$message2 = str_replace("{PASSWORD}", "$password", $message2);
$subject2 = str_replace("{PASSWORD}", "$password", $subject2);
$message2 = str_replace("{STATUS}", "$showstatus", $message2);
$subject2 = str_replace("{STATUS}", "$showstatus", $subject2);
$message2 = str_replace("{NUMLOGINS}", "$logins", $message2);
$subject2 = str_replace("{NUMLOGINS}", "$logins", $subject2);
$message2 = str_replace("{LASTLOGIN}", "$lastlogin", $message2);
$subject2 = str_replace("{LASTLOGIN}", "$lastlogin", $subject2);
$message2 = str_replace("{SSN}", "$ssnum", $message2);
$subject2 = str_replace("{SSN}", "$ssnum", $subject2);
$message2 = str_replace("{DOB}", "$birthdate", $message2);
$subject2 = str_replace("{DOB}", "$birthdate", $subject2);

$EMAIL_Message = "$message2";
$EMAIL_Subject = "$subject2";
$EMAIL_From_Name = "$companyname";
$EMAIL_From = "$companyemail";
$HEADERS  = "MIME-Version: 1.0\r\n";
			$HEADERS .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$HEADERS .= "From: $EMAIL_From_Name <$EMAIL_From\r\n";
                $formsent = mail($email, $EMAIL_Subject, $EMAIL_Message, $HEADERS);  
}

       

        mysql_close($conn2);
}
       
        header("Location: index.php?page=thanks");
        exit();
    
?>

