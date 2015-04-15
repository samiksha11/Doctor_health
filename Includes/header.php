<?php $page_name = basename($_SERVER['PHP_SELF']);
$page = basename($_SERVER['SCRIPT_FILENAME'] ,".php"); 
//print_r($_SESSION);
include("config.php");

if(($page_name == 'dashboard.php')){
	$dashboard = ' class = " active " ';
}else if(($page_name == 'Doctors.php') || ($page_name == 'doctors_add.php') || ($page_name == 'doctors_edit.php') || ($page_name == 'patients.php')
                                     || ($page_name == 'patients_add.php')|| ($page_name == 'patients_edit.php'))
    {
	$projects = ' class = " active " ';
}else if(($page_name == 'change_password.php')){
	$change_password = ' class = " active " ';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Health care Application</title>

<link rel="stylesheet" type="text/css" href="css/doctor_profile.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel='stylesheet' type='text/css' href='css/sangoma-green.css'>
<link rel="stylesheet" href="css/jquery.ui.datepicker.css">
<script type="text/javascript" src ="js/jquery-1.11.2.js"></script>
<script type="text/javascript" src ="js/jquery-ui.js"></script>
<script type="text/javascript" src ="js/custom.js"></script>
<link rel="stylesheet" type="text/css" href="css/DateTimePicker.css" />
<script src="js/DateTimePicker.js" type="text/javascript"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<!-------------chat jquery links------------------------------------------------>
<link type="text/css" href="css/jquery.ui.chatbox.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.ui.chatbox.js"></script>
<script src='spectrum.js'></script>
<link rel='stylesheet' href='spectrum.css' />
<!------------------------spectrum-------------------------------->
<script type="text/javascript" src='js/spectrum.js'></script>
<link rel='stylesheet'type="text/css" href="css/spectrum.css.css" />
<!------check report password---------------------------------->
<?php 
 include("config.php");
if(isset($_POST['submit1']) && $_POST['submit1'] == 'Login1')
{
   extract($_POST); 
   $report_password = md5($report_password);
   $_SESSION['email'] = $email;
                
   //$sql = mysql_query("select * from patient where report_password='$report_password'");
   $sql1 = mysql_query("select * from doctors where email='$email' AND report_password='$report_password'"); 
   $getRecord = mysql_fetch_array($sql1);
   //extract($_POST);die;
   //var_dump($sql);die;
   //var_dump($_REQUEST);
   //$getRecord = mysql_fetch_array($sql);
   if(mysql_num_rows($sql1) >0) 
   
       { 
   	     //	$_SESSION['email'] = $email;
                
                 //echo "<script type='text/javascript'>
	  		//window.location.href='show_patient_report.php';
                           // </script>";
       create_session($email,$getRecord['Patient_name'],$getRecord['Patient_id'],'');
            header("Location: show_patient_report.php");
            

                
   } else 
       {
       header("Location: patient_profile.php");
	 // echo "<script type='text/javascript'>
	 // alert('Please Enter Correct Login Information');
	  //window.location.href='patient_profile.php';
	 // </script>";   
   }
}
?>
<!---------------------------------------------------------------------------->
</head>

<body>
<div id="column-left">
  <div id="story-box" class="gray-background">
    <div id="current-date"> 
      <!-- Replace this with a routine for displaying the local date (according to locale) --> 
      As on <?php echo date("F j, Y"); ?> </div>
    <div id="title-box" class="title-box-background-blue title-large"> 
      <!-- Replace this with a routine to pull in the user's first name from ANDI --> 
      Welcome <?php echo $_SESSION['Username'];?> </div>
    <?php if(($_SESSION['Patient_id'])!= '')
           
           {?>
    <p> <a href= "patient_profile.php"> profile</a> </p>
    <!------------report list password----------------------------->
    <p><a href="#dialog">List Reports</a>
    <div id="dialog" title="Basic dialog" style="display:none">
      <form name="login_form" action="<?php echo $site_url.'show_patient_report.php';?>" method="post">
        <div class="input-prepend"> <span class="add-on"><span class="icon-key"></span></span>
          <input id="password" required type="password" placeholder="Enter Password"  name="report_password">
        </div>
        <button class="btn btn-alt btn-primary btn-large btn-block" type="submit" name="submit1" value="Login1">Go</button>
      </form>
    </div>
    </p>
    <!-------------------------> 
    <!-- <p> <a href="javascript:void(0);" onclick ="appointment();">Appointment</a></p>-->
    <p> <a href="appoint_mail.php">Appointment</a></p>
    <!--<button type="button" id="reports" ><a href="patient_report_list.php?pid=<?php echo generateRandomString(10).$_SESSION['Patient_id'].generateRandomString(10);?>">Reports</a>
  </button>-->
    <?php
    $total_messages=mysql_query("SELECT  COUNT(*) as total FROM patient_message where patient_id = '{$_SESSION['Patient_id']}' and status = 'unread';");
              $data=mysql_fetch_assoc($total_messages);?>
    
    
    <p><a href="discussion_view.php?pid=<?php echo generateRandomString(10).$_SESSION['Patient_id'].generateRandomString(10);?>">Discussion </a></p>
    <p><a href ="patient_history.php?pid=<?php echo generateRandomString(10).$_SESSION['Patient_id'].generateRandomString(10);?>">MY History</a></p>
    <p><a href ="patient_message.php?pid=<?php echo generateRandomString(10).$_SESSION['Patient_id'].generateRandomString(10);?>">MY Messages &nbsp; (<?php echo $data['total'];?>)</a></p>
    <p><a href="prescription_view.php?pid=<?php echo generateRandomString(10).$_SESSION['Patient_id'].generateRandomString(10);?>">MY Prescriptions </a></p>
    <p><a href="logout.php">Logout</a> </p>
    
    <?php } else if(($_SESSION['Doctors_id'])!= '')
            
           {?>
    <p> <a href= "doctor_profile.php"> profile</a> </p>
    <p> <a href="javascript:void(0);" onclick="patient();">Patients</a> </p>
    <!--<p> <a href="javascript:void(0);" onclick ="appointment();">Appointment</a></p>-->
    <p> <a href="show_appointment.php?pid=<?php  echo generateRandomString(10).$_SESSION['Doctors_id'].generateRandomString(10);?>">Appointment</a></p>
    <p><a href="discussion_view.php?pid=<?php echo generateRandomString(10).$_SESSION['Doctors_id'].generateRandomString(10);?>">Discussion </a></p>
    <p><a href="logout.php">Logout</a> </p>
    <?php }
            else {?>
    <p> <a href="Registration.php">sign-up</a></p>
    <p> <a href="index.php">Login</a></p>
    <?php  }?>
    
    
    <div class="separator"></div>
    
    <!--<p class="story-title black bold"><a href="#">  Profile </a></p>--> 
    
    <!--<p><a href="#">The bLink app is now available for patients...</a></p>--> 
    
  </div>
</div>
<script> 
  
  $(function() {
      $( 'a[href=\\#dialog]' ).on( 'click', function( e ) {
            e.preventDefault();
            $( "#dialog" ).dialog();
      });
});
  </script> 
<script type="text/javascript">
function check_login()
{
   var email = document.getElementById('email').value;
   var report_password = document.getElementById('report_password').value;
   
   if(report_password =='') {   
		alert('Please Enter Password');
		document.login_form.login.focus();
		return false;
   } else {   
      return true;
   }
}
</script>