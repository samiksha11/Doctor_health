<?php 
include_once("config.php");



if(isset($_POST['submit']) && $_POST['submit'] == 'Sign-Up')
    
{  extract($_POST);

    if($Register=='Doctor')
    {
	
       NewDoctor();
       
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

    
	?>
<?php        
include_once ('Includes/header.php');?>
<div id="Doctor-Sign-Up"  style="background-image: url(images/1.jpg); background-size: 100% 100%;background-repeat: no-repeat ; "> <br>
  <?php if($_SESSION['errMsgnr'] != ''){?>
  <h4 class="errMsg"> <font color="WHITE"><?php echo $_SESSION['errMsgnr'].'<br>'; $_SESSION['errMsgnr']='';?></font></h4>
  <?php }?>
  <form method="POST" action="">
    <fieldset style="width:50%">
      <input type="radio" name="Register" id="Register1" value="Doctor">
      Register as Doctor &nbsp;&nbsp;&nbsp;
      <input type="radio" name="Register" id="Register2" value="Patient">
      Register as Patient<br>
      <br>
      <table border="0" id="regis_form" style="display: none;">
        <tr>
          <td>Name</td>
          <td><input type="text" name="fullname"></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input type="text" name="email1"></td>
        </tr>
        <tr>
          <td>Phone_No</td>
          <td><input type="number" name="Phone_no"></td>
        </tr>
        <tr id="bg">
          <td> carrier </td>
          <td><select name="carrier"id="patient_BloodGroup" >
              <option value="@txt.att.net">att</option>
              <option value="@vtext.com">verizon</option>
              <option value="@tmomail.net">tmobile</option>
              <option value="@messaging.sprintpcs.com">sprint</option>
              <option value="@messaging.nextel.com">nextel</option>
              <option value="@airtelchennai.com"> chennai Airtel</option>
              <option value="@airtelmail.com">Delhi Aritel</option>
            </select></td>
        </tr>
        <tr>
          <td>Address</td>
          <td><input type="text" name="Address"></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="password"></td>
        </tr>
        <tr>
          <td style="width:300px;">Insurance Accepted</td>
            <td>
          <select name="Insurance_id[]" id="Insurance_id" multiple="multiple">
            <option value="0">Select Category</option>
            <?php $listing = mysql_query("select * from health_care_db.insurance");
                                    while($listing_fetch = mysql_fetch_object($listing))
                            
                {?>
            <option value="<?php echo $listing_fetch->Insurance_id;?>" > <?php echo $listing_fetch->Company_name;?></option>
            <?php 
                      
                } ?>
              <tr id="bg">
              <td>
              
              
              
              Blood Group
              
              
              
              </td>
              <td>
              <select name="patient_BloodGroup" id="patient_BloodGroup">
            <option value="AB">AB+</option>
            <option value="A">A+</option>
            <option value="A">A-</option>
            <option value="B">B+</option>
            <option value="A">B-</option>
            <option value="B">O+</option>
            <option value="B">O-</option>
            <option value="B">RH factor</option>
          </select>
            </td>
        </tr>
        <tr id="DOB">
          <td>DOB</td>
          <td><input type="datepicker" id="datepicker" name="datepicker" size="20" ></td>
        </tr>
        <tr id ="department">
          <td>Department </td>
          <td><select name="department_id" id="catname" >
              <option value="0">Select Category</option>
              <?php $listing1 = mysql_query("select * from health_care_db.department");
                                    while($listing_fetch1 = mysql_fetch_object($listing1))
                                       
                            
                {
                                        ?>
              <option value="<?php echo $listing_fetch1->Department_id;?>" > <?php echo $listing_fetch1->Department_Name;?></option>
              <?php 
                      
                } ?>
            </select>
        </tr>
          </tr>
        
        <tr id="doctors">
          <td style="width:300px;">Doctors</td>
          <td><?php  $listing1 = mysql_query("select * from health_care_db.doctors");?>
            <select name="arrdoctors[]" id="arrdoctors" multiple="multiple" >
              <option value="0">Select Doctors</option>
              <?php while($listing_fetch1 = mysql_fetch_object($listing1)) { ?>
              <option value="<?php echo $listing_fetch1->Doctors_id;?>" ><?php echo $listing_fetch1->Doctors_name;?></option>
              <?php } ?>
            </select></td>
        </tr>
        <tr id ="city">
          <td>city</td>
          <td><input type="text" name="city"></td>
        </tr>
        <tr id ="zip">
          <td>Zip</td>
          <td><input type="text" name="zip_code"></td>
        </tr>
        <!--<div id="activation" style diaplay="block">
          <tr id ="activation1">
            <td>activation code</td>
            <td><input type="text" name="activation code"></td>
          </tr>
        </div>-->
        
        
          <td><input id="button" type="submit" name="submit" value="Sign-Up"></td>
        </tr>
      </table>
    </fieldset>
  </form>
</div>
</body>
</html>
