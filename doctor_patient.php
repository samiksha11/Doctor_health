<?php
include("config.php");
include("ckeditor/ckeditor.php");

error_reporting(0);
?>
<?php
 echo$Patient_id = $_REQUEST['pid'];
 session_regenerate_id(true);
$doctors_patient_details = getAllDataFromTable('patient',array('Patient_id'=>$Patient_id),'','*');
//var_dump($doctors_patient_details);
$rs_doctors_patient_details = $doctors_patient_details[0];
$rs_insurance = getAllRecordFromTableWithJoin
        ('patient_insurance_acceptance',array('insurance'=>'patient_insurance_acceptance.Insurance_id=insurance.Insurance_id')
        ,array('patient_insurance_acceptance.Patient_id'=>$Patient_id),
        'patient_insurance_acceptance.*,insurance.Company_name');
 
 $get_insurance_id = $rs_insurance[0];
 
 
 if(isset($_POST['send']) && $_POST['send'] == 'send')
    
    {  extract($_POST);
    
       prescription();
      var_dump($_POST);
       die();
       
    }
 
 


 ?>
<?php

     include_once ('Includes/header.php');
     ?>
<div id="column-middle">
<!-- Patients Details -->
<div id="story-box" class="white-background">
  <div id="title-box" class="title-box-background-orange title-medium"> Patient Details </div>
  <table>
    <tr>
      <td>Name:</td>
      <td><?php echo $rs_doctors_patient_details['Patient_name'];?></td>
    </tr>
    <tr>
      <td>Birth Date:</td>
      <td><?php echo $rs_doctors_patient_details['patient_DOB'];?></td>
    </tr>
    <tr>
      <td>BloodGroup:</td>
      <td><?php echo $rs_doctors_patient_details['patient_BloodGroup'];?></td>
    </tr>
    <tr>
      <td>Contact No:</td>
      <td><?php echo $rs_doctors_patient_details['Phone_No'];?></td>
    </tr>
    <tr>
      <td>Address:</td>
      <td><?php echo $rs_doctors_patient_details['Address'],$rs_doctors_patient_details['city'],$rs_doctors_patient_details['zip_code_no'];?></td>
    </tr>
    <tr>
      <td>Insurance:</td>
      <td><?php  foreach ($rs_insurance as $key => $value) 
                            {
                            echo $value['Company_name'].',&nbsp;';
    
                            };?></td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><?php echo $rs_doctors_patient_details['email'];?></td>
    </tr>
      </tr>
    
  </table>
  <p> <a href="patient_prescription.php?pid=<?php echo $_REQUEST['pid'];?>">
    <button type="button" id="prescription" >Prescription</button>
    </a></p>
  <p><a href="discussion.php?pid=<?php echo $_REQUEST['pid'];?>">
    <button type="button" id="discussion" >Discussion</button>
    </a></p>
  <p><a href="patient_report.php?pid=<?php echo $_REQUEST['pid'];?>">
    <button type="button" id="reports" > Reports </button>
    </a></p>
</div>

<!--SELECT * FROM `patient` WHERE  find_in_set('2',`Doctor_id`) ; --> 
<script>
   
function addDiv(divID){
 html = '';
 html += '<div><input type="file" name="reportm[]" id="reportm[]" required/><a href="javascript:void(o)" onclick="$(this).parent().remove();" class="btn">DELETE</a><br></div>';

$('#'+divID).append(html);

}
</script>
</body>
</html>
