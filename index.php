<?php 
include("config.php");
//print_r($_SESSION);

if(isset($_POST['submit']) && $_POST['submit'] == 'Login')
{
   extract($_POST);
   $password = md5($password);
   //print_r($_SESSION);
   //echo "select * from doctors where email='$email' AND password='$password'"; 
   
   if ($_POST ['Register']== 'Doctor')
   {
     $sql = mysql_query("select * from doctors where email='$email' AND password='$password'");  
   }
   elseif($_POST ['Register']== 'Patient')
   {
     $sql = mysql_query("select * from patient where email='$email' AND password='$password'");  
   }
   
   $getRecord = mysql_fetch_array($sql);
   //var_dump($getRecord);
   if(mysql_num_rows($sql) >0) 
       { 
       if ($_POST ['Register']== 'Doctor')
           {
           create_session($email,$getRecord['Doctors_name'],$getRecord['Doctors_id'],'');
           header("Location:doctor_profile.php");
            }
           elseif ($_POST ['Register']== 'Patient')
          {
           create_session($email,$getRecord['Patient_name'],'',$getRecord['Patient_id']);
           header("Location:patient_profile.php");
           }
   	     	
               
	  		 
   } else 
       {
	  echo "<script type='text/javascript'>
	  alert('Please Enter Correct Login Information');
	  window.location.href='index.php';
	  </script>";   
   }
}

?>
<?php include_once ('Includes/header.php');?>
<script type="text/javascript">
function check_login()
{
   var email = document.getElementById('email').value;
   var password = document.getElementById('password').value;
   
   if(email =='' || password =='') {   
		alert('Please Enter email & Password');
		document.login_form.login.focus();
		return false;
   } else {   
      return true;
   }
}
</script>
<div class="container" role="main">
   <div id="prescription-column-middle"> 
       <div id="title-box2" class="title-box-background-orange title-medium"> Health care system </div>
<div id="story-box-login" class="white-background" style="background-image: url(images/health.jpg) ;">
    
  <section class="container" role="main">
            <div class="login-logo">
            	
          	  <h4> <font color="white">Welcome To Your Health Care System </font></h4>
            </div>
  <form name="login_form" action="" method="post" onsubmit="return check_login();">
      <div class="control-group">
                    
    <input type="radio" name="Register" id="Register1" value="Doctor">
    <font color="white"> <b> YOU ARE DOCTOR </b> </font>  <br>
    <input type="radio" name="Register" id="Register2" value="Patient">
    <font color="white"> <b> YOU ARE PATIENT </b> </font> 
    <div class="control-group">
      <div class="form-controls">
        <div class="input-prepend"> <span class="add-on"><span class="icon-user"></span></span>
          <input id="username" type="text" placeholder="Enter email" 
                            name="email">
        </div>
      </div>
    </div>
    <div class="control-group">
      <div class="form-controls">
        <div class="input-prepend"> <span class="add-on"><span class="icon-key"></span></span>
          <input id="password" type="password" placeholder="Enter Password" 
                            name="password">
        </div>
      </div>
    </div>
    <div class="form-controls">
                        <div class="input-prepend"> 
    <button class="btn btn-alt btn-primary btn-large btn-block" href="<?php  
                
                  echo("doctor_profile.php")?> "type="submit" name="submit" value="Login">Login</button>
    <a href="javascript:void(0);" id="forgotPassword"> Forget_password</a>
  </form>
</section>

        </div>
    </div>
</body>
</html>
