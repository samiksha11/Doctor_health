<?php 
error_reporting(0);	
include("sign_up.php"); 

if(isset($_POST['submit']) && $_POST['submit'] == 'Sign-Up')
{
    NewUser();
}
    
	?>

<!DOCTYPE HTML> <html>
    <head> 
        <title> Doctor-Sign-Up</title>
    </head> 
    <body id="body-color"> 
        <div id="Doctor-Sign-Up"> 
            <fieldset style="width:50%">
                <Reg>Registration Form</Reg> 
                <table border="0"> <tr>
                    <form method="POST" action="">
                        <td>Name</td>
                        <td> <input type="text" name="name"></td> 
                    </tr> 
                    <tr> 
                        <td>Email</td>
                        <td> <input type="text" name="email">
                        </td>
                    </tr> 
                    
                    <tr> 
                        <td>Password</td>
                        <td> <input type="password" name="pass"></td> 
                    </tr> 
                    <tr> 
                        <td>Confirm Password </td>
                        <td><input type="password" name="cpass"></td> 
                    </tr> 
                    <tr> 
                        <td>Insurance Acceptance </td>
                  <td>
                      <select name="insurance_name" id="catname" multiple="multiple">
                      <option value="0">Select Category</option>
                      <?php $listing = mysql_query("select * from health_care_db.insurance");
                                    while($listing_fetch = mysql_fetch_object($listing))
                            
                {?>
                      <option value="<?php echo $listing_fetch->Insurance_id;?>" >
                          <?php echo $listing_fetch->Company_name;?></option>
                      <?php 
                      
                } ?>
                      </select>
                    </tr>
                    <tr> 
                        <td>Department </td>
                  <td>
                      <select name="department_id" id="catname" >
                      <option value="0">Select Category</option>
                      <?php $listing1 = mysql_query("select * from health_care_db.department");
                                    while($listing_fetch1 = mysql_fetch_object($listing1))
                                       
                            
                {?>
                      <option value="<?php echo $listing_fetch1->Department_id;?>" >
                          <?php echo $listing_fetch1->Department_Name;?></option>
                      <?php 
                      
                } ?>
                      </select>
                    </tr>
                    
                    <tr> 
                        <td>
                            <input id="button" type="submit" name="submit" value="Sign-Up"></td>
                    </tr> 
                    
                    </form>
                </table> 
            </fieldset>
        </div>
    </body>
</html>
