<?php
include("include/connection.php");


extract( $_GET );
extract( $_POST );

$pagename = $_GET['page'];

$todaysdate =  date("F d, Y");
$year =   date("Y");

if ($page==""){
$endquery = " WHERE pagename='home'";
}else{
$endquery = " WHERE pagename='".mysql_real_escape_string($pagename)."' and type='website'";
}
  $query = "SELECT id, pagename, active, pageorder, onheader, onfooter, pagecontent, pagetitle, pagemetas FROM webcms $endquery";
          $result = mysql_query($query, $conn2) or die("error:" . mysql_error());
          $cnt=0;
          while($row=mysql_fetch_row($result))
          {
              $id           = $row[0];
              $pagename  = $row[1];
              $active   = $row[2];
              $pageorder   = $row[3];
              $onheader = $row[4];
              $onfooter = $row[5];              
              $pagecontent = $row[6];                
              $pagetitle = $row[7];     
              $pagemetas = $row[8];                
           
}
  $query = "SELECT pagecontent FROM webcms WHERE type='webcss'";
          $result = mysql_query($query, $conn2) or die("error:" . mysql_error());
          $cnt=0;
          while($row=mysql_fetch_row($result))
          {
              $stylesheet           = $row[0];
          }

$query = "SELECT companyid, companyname, companycontact, companyemail, companyreply, companyaddress, companycity, companystate, companyzip, companyphone, companyfax, companywebsite, autoscheduler, reseller, htdiwebsite, adminsinglepayment1, adminsinglepayment2, admincouplepayment1, admincouplepayment2, single, couple, creditcard, paypal2, ach, singlefull, singledownpay1, singlepayment, couplefull, coupledownpay1, couplepayment, threeinone, paypal, months, perdelete, livehuman, dbname, dropdowncreditors, dropdownbegin, dropdowntails, autoresponder, bautoresponder, cautoresponder, helpdesk, companyheader, timezone FROM companyinfo WHERE companyid='1'";
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
    }

$query = "SELECT pagename FROM webcms WHERE active='Yes' and onheader='Yes' and type='website' and pageorder > 0 order by pageorder";
    $result = mysql_query($query, $conn2) or die("error:" . mysql_error());
    $col_count = mysql_num_fields($result);
    while($row=mysql_fetch_row($result))
    {
        $pagenamelink = $row[0];
$headerlinks .="<a href=\"index.php?page=$pagenamelink\">$pagenamelink</a>&nbsp;&nbsp;&nbsp;";
$headerlinks2 .="<li><a href=\"index.php?page=$pagenamelink\"><span>$pagenamelink</span></a></li>";
    }

$headerpre = "<div class=\"header_links\">";
$headersuffix = "</div>";
$header = "$headerpre $headerlinks $headersuffix";

$headerpre2 = "<div id=\"tabs10\"><ul>";
$headersuffix2 = "</ul></div>";
$header2 = "$headerpre2 $headerlinks2 $headersuffix2";


$query = "SELECT pagename FROM webcms WHERE active='Yes' and onfooter ='Yes' and type='website' and pageorder > 0 order by pageorder";
    $result = mysql_query($query, $conn2) or die("error:" . mysql_error());
    $col_count = mysql_num_fields($result);
    while($row=mysql_fetch_row($result))
    {
        $footerpagenamelink = $row[0];
$footerlinks .="<a href=\"index.php?page=$footerpagenamelink\">$footerpagenamelink</a> | ";
$footerlinks2 .="<a class=\"bottom\" href=\"index.php?page=$footerpagenamelink\">$footerpagenamelink</a> | ";
    }

$footerpre = "<br><br>";
$footersuffix = "</div>";
$footer = "$footerpre $footerlinks $footersuffix";

$footerpre2 = "<p class=\"copyright\" align=\"center\">";
$footersuffix2 = "</p>";
$footer2 = "$footerpre2 $footerlinks2 $footersuffix2";

$pagecontent = str_replace("{THREEINONE}", "$threeinone", $pagecontent);
$pagecontent = str_replace("{COMPANY}", "$companyname", $pagecontent);
$pagecontent = str_replace("{COMPANYADDR}", "$companyaddress", $pagecontent);
$pagecontent = str_replace("{COMPANYCITY}", "$companycity", $pagecontent);
$pagecontent = str_replace("{COMPANYSTATE}", "$companystate", $pagecontent);
$pagecontent = str_replace("{COMPANYZIP}", "$companyzip", $pagecontent);
$pagecontent = str_replace("{COMPANYPHONE}", "$companyphone", $pagecontent);
$pagecontent = str_replace("{COMPANYFAX}", "$companyfax", $pagecontent);
$pagecontent = str_replace("{SITE}", "$companywebsite", $pagecontent);
$pagecontent = str_replace("{COMPANYEMAIL}", "$companyemail", $pagecontent);

$pagecontent = str_replace("{HEADER}", "$header", $pagecontent);
$pagecontent = str_replace("{HEADER2}", "$header2", $pagecontent);
$pagecontent = str_replace("{FOOTER}", "$footer", $pagecontent);
$pagecontent = str_replace("{FOOTER2}", "$footer2", $pagecontent);
$pagecontent = str_replace("{TODAYDATE}", "$todaysdate", $pagecontent );
$pagecontent = str_replace("{YEAR}", "$year", $pagecontent );

$freeconsultform = "<form action=\"/prospectsignup\" method=\"post\" target=\"_top\"><table cellspacing=\"5\" cellpadding=\"5\"><tr><td><p align=\"left\">First Name</p></td>";
$freeconsultform .= "<td ><input size=\"15\" name=\"fname\"></td></tr><tr><td ><p align=\"left\">Last Name </p></td><td ><input size=\"15\" name=\"lname\"></td></tr><tr><td ><p align=\"left\">Phone</p></td>";
$freeconsultform .= "<td ><input size=\"15\" name=\"phone\"></td></tr><tr><td ><p align=\"left\">Email</p></td><td ><input size=\"15\" name=\"email\"></td></tr>";
$freeconsultform .= "<tr><td colspan=\"2\"><p align=\"center\"><input type=\"submit\" value=\"Submit\" name=\"submit\"></p></td></tr></table></form>";
$pagecontent = str_replace("{FREECONSULT}", "$freeconsultform", $pagecontent);
$pagecontent = str_replace("prospectsignup.php5", "prospectsignup", $pagecontent);
$pagecontent = str_replace("prospect_signup.php5", "prospectsignup", $pagecontent);
$pagecontent = str_replace("/admin/s5/customprospectsignup", "/prospectsignup", $pagecontent);

$clientform = "<form action=\"/client/clientlogin.php\" method=\"post\" target=\"_top\">Username: <input style=\"FONT-SIZE: 8pt; WIDTH: 107px; FONT-FAMILY: verdana; HEIGHT: 20px\" name=\"username\"><br />";
$clientform .= "Password: <input style=\"FONT-SIZE: 8pt; WIDTH: 107px; FONT-FAMILY: verdana; HEIGHT: 20px\" type=\"password\" name=\"password\"><input type=\"submit\" value=\"Log In\" name=\"submit\" width=\"27\" height=\"24\"></form>";
$pagecontent = str_replace("{CLIENTLOGIN}", "$clientform", $pagecontent);

//$clientvideo = "<a href=\"cs.mp4\" rel=\"shadowbox;width=540;height=300\"><img border=\"0\" src=\"video.png\" /></a>";
$clientvideo = "<a href=\"cs.mp4\" rel=\"shadowbox;width=840;height=500;player=flv;options={flashVars:{type:'video'}}\"><img border=\"0\" src=\"video.png\" /></a>";

$pagecontent = str_replace("{CLIENTVIDEO}", "$clientvideo", $pagecontent);

if (preg_match('{LOGINSLIDER}',$pagecontent)){
$loginslider = "yes";
}
$pagecontent = str_replace("{LOGINSLIDER}", "", $pagecontent);



$stylesheet = "<style>$stylesheet</style>";
if ($htdiwebsite=="Yes" && $active=="Yes"){

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $pagemetas; ?>
<?php echo $stylesheet; ?>

<?php
if ($loginslider=="yes"){
?>

<!-- stylesheets -->
  	<link rel="stylesheet" href="slide.css" type="text/css" media="screen" />
	

	<!--[if lte IE 6]>
		<script type="text/javascript" src="supersleight-min.js"></script>
	<![endif]-->
	 
    <!-- jQuery - the core -->
	<script src="jquery-1.3.2.min.js" type="text/javascript"></script>
	<!-- Sliding effect -->
	<script src="slide.js" type="text/javascript"></script>
<style>
html, body {border: 0; margin: 0; padding: 0;}

body {
  	font: 85%/0.9 arial, helvetica, sans-serif;
  	line-height: 130%;
  	width: 100%;
  	min-width: 970px;
  	color: black;
}
</style>
<?php
}
?>


<title><?php echo $pagetitle; ?></title>
<?php 
//	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"shadowbox.css\"><script type=\"text/javascript\" src=\"shadowbox.js\"></script><script type=\"text/javascript\">Shadowbox.init();</script>";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"sbox/shadowbox.css\"><script type=\"text/javascript\" src=\"sbox/shadowbox.js\"></script><script type=\"text/javascript\">Shadowbox.init();</script>";
	?>

</head>
<body>
<?php
if ($loginslider=="yes"){
?>

<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="client/clientlogin.php" method="post">
					<h1>Client Login</h1>
					<label class="grey" for="log">Username:</label>
					<input class="field" type="text" name="username" id="log" value="" size="23" />
					<label class="grey" for="pwd">Password:</label>
					<input class="field" type="password" name="password" id="pwd" size="23" />
        		
					<input type="submit" name="submit" value="Login" class="bt_register" />
				</form>
			</div>


			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="brokers/login.php" method="post">
					<h1>Broker Login</h1>
					<label class="grey" for="log">Username:</label>
					<input class="field" type="text" name="username" id="log" value="" size="23" />
					<label class="grey" for="pwd">Password:</label>
					<input class="field" type="password" name="password" id="pwd" size="23" />
	            	
					<input type="submit" name="submit" value="Login" class="bt_register" />
				</form>
			</div>
			<div class="left right">			
				<!-- Register Form -->
				<form class="clearfix" action="affiliate/login.php" method="post">
					<h1>Affiliate Login</h1>
					<label class="grey" for="log">Username:</label>
					<input class="field" type="text" name="username" id="log" value="" size="23" />
					<label class="grey" for="pwd">Password:</label>
					<input class="field" type="password" name="password" id="pwd" size="23" />

					<input type="submit" name="submit" value="Login" class="bt_register" />
				</form>

			</div>
		</div>
</div> <!-- /login -->	

	<!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
			<li class="left">&nbsp;</li>
				<li id="toggle">
				<a id="open" class="open" href="#">Log In</a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
			<li class="right"></li>
		</ul> 
	</div> <!-- / top -->
	
</div><BR><BR> <!--panel -->
<?php
}
?>
<?php echo $pagecontent; ?>


</body>
</html>
<?php
}else{
?>
<META HTTP-EQUIV=Refresh CONTENT="0; URL=/client/"> 
<?php
}
?>
