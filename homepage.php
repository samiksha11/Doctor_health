<?php 
include_once("config.php");




     $activate = generateRandomString('10').time() ;
     
      $Emailmsg = '<div style="font-size:20px;text-align:center;">Welcome To HealthCare</div></p><br><br><br>
           <br><p><b>activate code</b>='.$activate.'</p>
           <p>Thank You for requesting us for ur forgot password</p><br></p>.$activate.Click Here</a></p><br><br><p>Thank You<br>Healthcare Team</p>';
       
         
         
          echo '<pre>';
   //echo $Emailmsg;
   //
   //die();
         
 mailingNew($email,$$Emailmsg);
         
  

    
    


if(isset($_POST['submit']) && $_POST['submit'] == 'Sign-Up')
    
{  extract($_POST);
    //if($activate==$activate1 )
    {

    if($Register=='Doctor')
    {
       NewDoctor();
       /*---------------------------------------------------------*/
       $Emailmsg = '<div style="font-size:20px;text-align:center;">Welcome To HealthCare</div></p><br><br><br>
           <br><p><b>activate code</b><p>you hav account with us now</p>
           <p>Thank You for registring with us</p><br></p></a></p><br><br><p>Thank You<br>Healthcare Team</p>';
      // echo'<pre>';
       //echo $Emailmsg;
       //<br>;
       //die();
       
       
       mailingNew($email,$Emailmsg);
       
    }
    elseif($Register=='Patient')
    {
    NewPaitents();
    }
    else
    {
     echo "Please select any";   
    }
    
}
}

    
	?>
<?php        
include_once ('Includes/header.php');?>
<body id="body-color">
<div id="Doctor-Sign-Up">
  <form method="POST" action="">
    <fieldset style="width:50%">
      <input type="radio" name="Register" id="Register1" value="Doctor">
      Register as Doctor <br>
      <input type="radio" name="Register" id="Register2" value="Patient">
      Register as Patient
      <table border="0" id="regis_form" style="display: none;">
        
        <tr>
          <td>Email</td>
          <td><input type="text" name="email"></td>
        </tr>
        
        <tr>
         <td><input id="button" type="submit" name="submit" value="Sign-Up" ></td>
        </tr>
      </table>
    </fieldset>
  </form>
    
</div>

</body>
</html>

<div id="dialog" title="Basic dialog" style="display:none">
<form name="login_form" action="" method="post" onsubmit="return check_login();">
    <div class="input-prepend"> <span class="add-on"><span class="icon-key"></span></span>
          <input id="password" type="password" placeholder="Enter Password" 
                            name="report_password">
        </div>
    <button class="btn btn-alt btn-primary btn-large btn-block" href="<?php  
                
     echo("show_patient_report.php")?> "type="submit" name="submit" value="Login">Login</button>
    </form>
</div>