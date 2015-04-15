<?php 
include_once("config.php");

if($_REQUEST['chk'] == 'doctor'){
	$sql = mysql_query("SELECT * FROM `doctors` WHERE `activate_code` = '".$_REQUEST['err']."'");
	$getId = mysql_fetch_object($sql);
	if(mysql_num_rows($sql) > 0){
			$msg = "Your Account Now Activated. <br><br>Please <a href='$siteUrl'> Click Here </a> To Login";
			update_table('doctors',array('activate_code'=>'','Online_status'=>'Active'),array('Doctors_id'=>$getId->Doctors_id));
	}
}else if($_REQUEST['chk'] == 'patient'){
	$sql = mysql_query("SELECT * FROM `patient` WHERE `activate_code` = '".$_REQUEST['err']."'");
	$getId = mysql_fetch_object($sql);
	if(mysql_num_rows($sql) > 0){
            
		$list_pass = generateRandomString('6') ; 
		$Emailmsg = '<body bgcolor="F4F4F4"><div style="font-size:20px;text-align:center;background-color:#1E599C;color:#ffffff;">Welcome To HealthCare</div></p><br><br><p><b> Your Account is Activate Now </p><br><br>
		<p>Your List Reports Password :- '.$list_pass.', Help to see your all reports </p><br><br>
		<p>Thank You<br>Healthcare Team</p></body>';
		
			$msg = "Your Account Now Activated. <br><br>Please <a href='$siteUrl'> Click Here </a> To Login";
			
			mailingNew($getId->email, $Emailmsg);
	
    update_table('patient',array('activate_code'=>'','Online_status'=>'Active'),array('Patient_id'=>$getId->Patient_id));
  //  header("Location:".$siteUrl);
}}else{
	header("Location:".$siteUrl);
}


?>

     
<?php include_once ('Includes/header.php');?>
<div class="container" role="main">
<div id="prescription-column-middle">
  <div id="title-box2" class="title-box-background-orange title-medium"> Health care system </div>
  <div id="story-box-login" class="white-background" style="background-image: url(images/1.jpg); background-size: 100% 100%;background-repeat: no-repeat ;">
    <section class="container" role="main">
      <div class="login-logo">
        <h4 class="errMsg"> <font color="white"><?php echo $msg;?></font></h4>
      </div><br><br>
     </section>
  </div>
</div>
</body>
</html>
