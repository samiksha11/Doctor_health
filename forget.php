<?php 
include("config.php");
 include_once ('Includes/header.php');
  //$Emailmsg = '';
 if(isset($_POST['submit']) && $_POST['submit'] == 'Reset Password'){
     $Reset_password = generateRandomString('10').time() ;
    if($_REQUEST['err']=='Doctor'){
       
       $check_email = mysql_query("SELECT Doctors_id from doctors WHERE email = '".$_REQUEST['Email']."'");
       $Emailmsg = '<div style="font-size:20px;text-align:center;">Welcome To HealthCare</div></p><br><br><br><p>Thank You for requesting us for ur forgot password</p><br><p><a href="reset_password.php?rset=$Reset_password&chk=doctor">Click Here</a></p><br><br><p>Thank You<br>Healthcare Team</p>';
        if (mysql_num_rows($check_email) > 0) 
            {
         send_email($_REQUEST['Email'], $Emailmsg);
         $Updatepass = "UPDATE Doctors SET reset_pass='$Reset_password' WHERE email='".$_REQUEST['Email']."'";
         
         
         
       }    
     }else if($_REQUEST['err']=='Patient'){
         
       $check_email = mysql_query("SELECT Patient_id from patient WHERE email = '".$_REQUEST['Email']."'"); 
       $Emailmsg = '<div style="font-size:20px;text-align:center;">Welcome To HealthCare</div></p><br><br><br><p>Thank You for requesting us for ur forgot password</p><br><p><a href="reset_password.php?rset=$Reset_password&chk=doctor">Click Here</a></p><br><br><p>Thank You<br>Healthcare Team</p>';
        if (mysql_num_rows($check_email) > 0) {
             send_email($_REQUEST['Email'], $Emailmsg);
             $Updatepass = "UPDATE patient SET reset_pass='$Reset_password' WHERE email='".$_REQUEST['Email']."'";

           }
       }
     
  
   }
 ?>

<div id="column-middle">
  <div id="story-box" class="white-background">
    <div id="title-box" class="title-box-background-orange title-medium">Reset password </div>
    <form method="post" name="forgetpassword" action="" enctype="multipart/form-data">
      <table>
        <tbody>
          <tr>
            <td style="width:300px;">Email</td>
            <td><input type="text" name="Email" id="Email" value=""/></td>
          </tr>
        </tbody>
        <tr>
          <td><input id="button" type="submit" name="submit" value="Reset Password"></td>
        </tr>
      </table>
    </form>
  </div>
</div>
</div>
