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
          <td>Name</td>
          <td><input type="text" name="fullname"></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input type="text" name="email"></td>
        </tr>
        <tr>
          <td>Phone_No</td>
          <td><input type="number" name="Phone_no"></td>
        </tr>
         
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
        
          <td><input id="button" type="submit" name="submit" value="Sign-Up"></td>
        </tr>
      </table>
    </fieldset>
  </form>
</div>
</div>
</body>
</html>