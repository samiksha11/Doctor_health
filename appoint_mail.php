<?php
include("config.php");
if($_SESSION['email'] == '')
{
	//header("Location:index.php");
}
error_reporting(0);
$rs_patient_detail = getAllDataFromTable('patient',array('patient`.`Patient_id'=>$_SESSION['Patient_id']),'','*');

$patient_details = $rs_patient_detail[0];
$rs_insurance = getAllRecordFromTableWithJoin
        ('patient_insurance_acceptance',array('insurance'=>'patient_insurance_acceptance.Insurance_id=insurance.Insurance_id')
        ,array('patient_insurance_acceptance.Patient_id'=>$_SESSION['Patient_id']),
        'patient_insurance_acceptance.*,insurance.Company_name');
 
 $get_insurance_id = $rs_insurance[0];

if(isset($_POST['book']) && $_POST['book'] == 'book')
    
    {  extract($_POST);
    if($appointment=='personal')
    {
       Appointment();
      //var_dump($_POST);
       //die();
       
    }
    elseif($appointment=='relative')
    {
    	rel_Appointment();
    }
    else
    {
     echo "Please select any";   
    }
    
}
//{
   //var_dump($_POST);
   //die();
    //Appointment();
//}  ?>
<?php include_once ('Includes/header.php');  ?>
<div id="column-middle">
  <div id="p-story-box" class="white-background">
    <div id="p-title-box" class="title-box-background-orange title-medium">Profile </div>
    <form method="post" name="appointment" action="" enctype="multipart/form-data" onsubmit="return validation();">
      <fieldset style="width:50%">
      <input type="radio" name="appointment" id="appointment1" value="personal">
      Self appointment <br>
      <input type="radio" name="appointment" id="appointment2" value="relative">
      Relative appointment
      <table border="0" id="regis_form" style="display: block;" cellpadding="10" cellspacing="10">
        <tr>
          <td>Name:</td>
          <td><?php echo $patient_details['Patient_name'];?></td>
        </tr>
        <tr id="Relative" style =" display:none">
          <td>Relative name</td>
          <td><input type="text" name="Relative"></td>
        </tr>
        <tr id="Relative_email" style =" display:none">
          <td>Relative Email </td>
          <td><input type="text" name="Relative_email"></td>
        </tr>
        <tr id="Relative_Insurance" style =" display:none">
          <td style="width:300px;">Relative Insurance</td>
          <td><?php $listing = mysql_query("select * from health_care_db.insurance");?>
            <select name="arrinsurance[]" id="arrinsurance" multiple="multiple" >
              <option value="0">Select Category</option>
              <?php while($listing_fetch = mysql_fetch_object($listing)){?>
              <option value="<?php echo $listing_fetch->Insurance_id;?>" > <?php echo $listing_fetch->Company_name;?></option>
              <?php } ?>
            </select></td>
        </tr>
        <tr>
          <td>Contact No:</td>
          <td><?php echo $patient_details['Phone_NO'];?></td>
        </tr>
        <tr id="Prefered_Contact"style="display:none">
          <td> Prefered_Contact: </td>
          <td><input id="tooltip-1" title="Enter your contact number where you would like to share your details"name="Prefered_Contact"></td>
        </tr>
        <tr id="Prefered_Address"style="display:none">
          <td> Prefered Address: </td>
          <td><input id="tooltip-2" title="Enter your address where you would like to share your details" name="Prefered_Address"></td>
        </tr>
        <tr>
          <td> Address: </td>
          <td><?php echo $patient_details['Address'],$patient_details['city'],$patient_details['zip_code_no'];?></td>
        </tr>
        <tr id="login_bg">
          <td > Blood Group </td>
          <td><?php echo $patient_details['patient_BloodGroup'];?></td>
        </tr>
        <tr id="patient_insurance"  style="display:none">
          <td> Insurance: </td>
          <td><?php  foreach ($rs_insurance as $key => $value) 
                            {
                            echo $value['Company_name'].',&nbsp;';
    
                            };?></td>
        </tr>
        <tr>
          <td> Email: </td>
          <td><?php echo $patient_details['email'];?></td>
        </tr>
        <tr id ="relation" style =" display:none">
          <td> Relation </td>
          <td><select name="relation_id" id="relation" >
              <option value="0">Select Category</option>
              <?php $listing3 = mysql_query("select * from health_care_db.relation");
                                    while($listing_fetch3 = mysql_fetch_object($listing3))
                                       
                            
                {
                                        ?>
              <option value="<?php echo $listing_fetch3->relation_id;?>" > <?php echo $listing_fetch3->relation;?></option>
              <?php 
                      
                } ?>
            </select>
        </tr>
        <tr>
          <td>Department </td>
          <td><?php $listing1 = mysql_query("select * from health_care_db.department");?>
            <select name="department_id" id="catname" onchange="getDoctors(this.value);" >
              <option value="0">Select Category</option>
              <?php while($listing_fetch1 = mysql_fetch_object($listing1)){?>
              <option value="<?php echo $listing_fetch1->Department_id;?>"<?php echo ($listing_fetch1->Department_id==$doctors_details['Department_id'])?'selected':'';?> > <?php echo $listing_fetch1->Department_Name;?></option>
              <?php } ?>
            </select></td>
        </tr>
        <tr>
          <td style="width:300px;"> Doctor Name </td>
          <td><select name ="Doctors_name" id="docname">
            </select></td>
        </tr>
          </tr>
          <tr id="Description">
          <td> Description: </td>
          <td><textarea id="tooltip-1" title="please provide your reason for appointment"name="appointment_reason"></textarea></td>
        </tr>
        
        <tr>
          <td> appointment date</td>
          <td><input type="text" data-field="datetime" readonly class="input" name="datetime" id="datetime">
            <div id="DateTimePicker"></div></td>
        </tr>
        
        
          <td>&nbsp;</td>
          <td><input type="submit" name="book" value="book" id="book"></td>
        </tr>
          </tbody>
        
      </table>
    </form>
  </div>
</div>

<script>
$(document).ready(function(){
   $("#DateTimePicker").DateTimePicker();
   $("#tooltip-1").tooltip();
   $("#tooltip-2").tooltip();
});
 
</script>
</body>
</html>
