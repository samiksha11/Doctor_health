<?php
include_once("config.php");
if(isset($_POST['submit']) && $_POST['submit'] == 'Login')
{
   extract($_POST);
   $password = md5($password);
   $sql = mysql_query("select * from doctors where email='$email' AND password='$password'");
   $getRecord = mysql_fetch_array($sql);
   if(mysql_num_rows($sql) >0) 
       { 
   	     	$_SESSION['email'] = $email;
	  		//header("Location:dashboard.php"); 
   } else 
       {
	  echo "<script type='text/javascript'>
	  alert('Please Enter Correct Login Information');
	  window.location.href='Doctor_index.php';
	  </script>";   
   }
}

if(isset($_POST['submit']) && $_POST['submit'] == 'Login')
{
    NewDoctor();
}
    
	?>

<!DOCTYPE HTML>
<html>
<head>
<title>Doctor-Login</title>
</head>
<body id="body-color">
<div id="Doctor-Sign-Up">
  <fieldset style="width:50%">
    <Reg>Login</Reg>
    <table border="0">
        <tr>
      
      <form method="POST" action="">
        <td>Email</td>
        <td><input type="text" name="email"></td>
          </tr>
        
        <tr>
          <td>Password</td>
          <td><input type="text" name="password"></td>
        </tr>
        <tr>
          <td><input id="button" type="submit" name="submit" value="Login"></td>
        </tr>
      </form>
    </table>
  </fieldset>
</div>
</body>
</html>
