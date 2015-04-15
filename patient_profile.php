<?php
include("config.php");
if($_SESSION['email'] == '')
{
	//header("Location:index.php");
}

error_reporting(0);

$rs_patient_detail = getAllDataFromTable('patient',array('patient`.`Patient_id'=>$_SESSION['Patient_id']),'','*');

$patient_details = $rs_patient_detail[0];
//echo $patient_details;
//die();

 $rs_insurance = getAllRecordFromTableWithJoin
        ('patient_insurance_acceptance',array('insurance'=>'patient_insurance_acceptance.Insurance_id=insurance.Insurance_id')
        ,array('patient_insurance_acceptance.Patient_id'=>$_SESSION['Patient_id']),
        'patient_insurance_acceptance.*,insurance.Company_name');
 
 $get_insurance_id = $rs_insurance[0];

 
 if(isset($_POST['submit']) && $_POST['submit'] == 'Submit'){
	// echo '<pre>';var_dump($_POST); die;
	extract($_POST);
		$doc_st = implode(',', $arrdoctors);
		$sql = "update `health_care_db`.`patient` set 
				Patient_name='".trim($Patient_name)."', 
     			patient_DOB='".trim($datepicker)."',
                patient_BloodGroup='".$patient_BloodGroup."',    
				Address='".trim($address)."',
				city='".trim($city)."',
				zip_code_no='".trim($zip_code_no)."',
				Doctor_id = '".$doc_st."',
                Phone_NO='".trim($Phone_NO)."'
				where Patient_id = '".$_SESSION['Patient_id']."'";
			//echo $sql; die;	
	$qry = mysql_query($sql);
        if($qry){
            mysql_query("delete from patient_insurance_acceptance where Patient_id = '".$_SESSION['Patient_id']."'") ;
             for($i=0; $i<count($_POST['Insurance_id']);$i++)
             {
             $query1 = "INSERT INTO health_care_db.patient_insurance_acceptance(Patient_id,Insurance_id) 
                VALUES ('".$_SESSION['Patient_id']."','".$_POST['Insurance_id'][$i]."')";
             mysql_query($query1);
            }
            header("Location:patient_profile.php");
        }
	
}
/*if(isset($_POST['submit']) && $_POST['submit'] == 'Add Patient')
{
   var_dump($_POST);
   //die();
    NewPaitents();
 * 
}*/
   if(isset($_POST['book']) && $_POST['book'] == 'book')
{
   //var_dump($_POST);
   //die();
    Appointment();
}   


?>
<?php
if(isset($_POST['reports_1']) && $_POST['reports_1'] == 'upload')
    {
    var_dump($_POST);
   //die();
       
    patient_report();
    
    
    var_dump($_FILES);
    }
    if(isset($_POST['reports_2']) && $_POST['reports_2'] == 'upload')
    {
    var_dump($_POST);
  // die();
   
       
    patient_report();
    
    
    var_dump($_FILES);
    }
    
    if(isset($_POST['reports_3']) && $_POST['reports_3'] == 'upload')
    {
    var_dump($_POST);
   //die();
   
       
    patient_report();
    
    
    var_dump($_FILES);
    }
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- Keep the following line of code here for IE9 compatibility with gradients -->
<!--[if gte IE 9]> <style type="text/css"> .gradient { filter: none; } </style> <![endif]-->
<?php 
           // $sql_patients = mysql_query("SELECT Patient_name,Patient_id FROM `patient` WHERE  find_in_set('".$_SESSION['Doctors_id']."',`Doctor_id`)");
            //echo "SELECT Patient_name,Patient_id FROM `patient` WHERE  find_in_set('".$_SESSION['Doctors_id']."',`Doctor_id`)";
           // $sql_patients = mysql_query("SELECT * FROM `patient` WHERE  find_in_set('".$_SESSION['Doctors_id']."',`Doctor_id`)");
            
            
            //var_dump($sql_patients);
            ?>
<?php
     include_once ('Includes/header.php');
     ?>
<!-- patient profile-->
<div id="column-middle">
  <div id="p-story-box" class="white-background">
    <div id="p-title-box" class="title-box-background-orange title-medium">Profile </div>
    <table cellpadding="10" cellspacing="20">
      <tr>
        <td style="color:#1E5A9d;font-weight:bold;">Name:</td>
        <td><?php echo $patient_details['Patient_name'];?></td>
      </tr>
       <tr>
        <td style="color:#1E5A9d;font-weight:bold;">Email:</td>
        <td><?php echo $patient_details['email'];?></td>
      </tr>
      <tr>
        <td style="color:#1E5A9d;font-weight:bold;">Contact No:</td>
        <td><?php echo $patient_details['Phone_NO'];?></td>
      </tr>
      <tr>
        <td style="color:#1E5A9d;font-weight:bold;">Address:</td>
        <td><?php echo $patient_details['Address'].', '.$patient_details['city'].', '.$patient_details['zip_code_no'];?></td>
      </tr>
      
        <td style="color:#1E5A9d;font-weight:bold;">Blood Group:</td>
        <td><?php echo $patient_details['patient_BloodGroup'];?></td>
      <tr>
        <td style="color:#1E5A9d;font-weight:bold;">Insurance:</td>
        <td><?php  foreach ($rs_insurance as $key => $value){
                   		echo $value['Company_name'].',&nbsp;';
					};?></td>
      </tr>
     
       
      
    </table>
    <button type="button" id="Edit_Patientdetails">Edit </button>
    
  </div>
</div>
<!-- Edit patient profile-->
<div id="column-right" style="display:none;">
  <div id="story-box" class="white-background">
    <div id="title-box" class="title-box-background-orange title-medium">Edit Profile &nbsp;&nbsp;<img src="Images/close.png" width="15" height="15" alt="Close" onClick="hide('column-right')" style="float:right;margin-right: 15px;"/> </div>
    <form method="post" name="editnewdoctor" action="" enctype="multipart/form-data" onsubmit="return validation();">
      <table cellpadding="10" cellspacing="20">
        <tbody>
          <tr>
          <tr>
            <td style="width:200px;color:#1E5A9d;font-weight:bold;"> Name</td>
            <td><input type="text" name="Patient_name" id="Patient_name" value="<?php echo $patient_details['Patient_name'];?>" /></td>
          </tr>
          <tr>
            <td style="width:200px;color:#1E5A9d;font-weight:bold;"> Contact No:</td>
            <td><input type="text" name="Phone_NO" id="Phone_NO" value="<?php echo $patient_details['Phone_NO'];?>" /></td>
          </tr>
          <tr>
            <td style="width:200px;color:#1E5A9d;font-weight:bold;"> Address</td>
            <td><input type="text" name="address" id="address" value="<?php echo $patient_details['Address'];?>" /></td>
          </tr>
           <tr>
            <td style="width:200px;color:#1E5A9d;font-weight:bold;"> City</td>
            <td><input type="text" name="city" id="city" value="<?php echo $patient_details['city'];?>" /></td>
          </tr>
           <tr>
            <td style="width:200px;color:#1E5A9d;font-weight:bold;"> Zip-Code</td>
            <td><input type="text" name="zip_code_no" id="zip_code_no" value="<?php echo $patient_details['zip_code_no'];?>" /></td>
          </tr>
           <tr>
            <td style="width:200px;color:#1E5A9d;font-weight:bold;">DOB</td>
            <td><input type="text" id="datepicker" name="datepicker"  value="<?php echo $patient_details['patient_DOB'];?>" /></td>
              </td>
          </tr>
          <tr>
            <td style="width:200px;color:#1E5A9d;font-weight:bold;">Blood Group</td>
            <td><select name="patient_BloodGroup" id="patient_BloodGroup">
                <option value="0">Select</option>
                <option value="AB+" <?php echo ($patient_details['patient_BloodGroup'] == 'AB+')?'selected':'';?> >AB+</option>
                </option>
                <option value="A+" <?php echo ($patient_details['patient_BloodGroup'] == 'A+')?'selected':'';?> >A+</option>
                <option value="A-" <?php echo ($patient_details['patient_BloodGroup'] == 'A-')?'selected':'';?> >A-</option>
                <option value="B+" <?php echo ($patient_details['patient_BloodGroup'] == 'B+')?'selected':'';?> >B+</option>
                <option value="B-" <?php echo ($patient_details['patient_BloodGroup'] == 'B-')?'selected':'';?> >B-</option>
                <option value="O+" <?php echo ($patient_details['patient_BloodGroup'] == 'O+')?'selected':'';?> >O+</option>
                <option value="O-" <?php echo ($patient_details['pateint_BloodGroup'] == 'O-')?'selected':'';?> >O-</option>
                <option value="RH factor"<?php echo ($patient_details['pateint_BloodGroup'] == 'RH factor')?'selected':'';?> > RH factor</option>
                </option>
              </select></td>
          </tr>
          <tr>
            <td style="width:200px;color:#1E5A9d;font-weight:bold;">Insurance Accepted</td>
            <td><select name="Insurance_id[]" id="catname" multiple="multiple">
                <option value="0">Select Category</option>
                <?php $listing = mysql_query("select * from health_care_db.insurance");
                       	while($listing_fetch = mysql_fetch_object($listing)){
                            $select ='';
                            foreach($rs_insurance as $val){
                                if(  $listing_fetch->Insurance_id ==$val['Insurance_id']){
                                    $select = 'selected';
                                }
                            }
                            ?>
                <option value="<?php echo $listing_fetch->Insurance_id;?>" 
                        <?php echo $select;?> > <?php echo $listing_fetch->Company_name;?> </option>
                <!---fetching company name of the insurance-->
                <?php } 
                        ?>
              </select></td>
          </tr>
          
         
          <tr id="doctors">
            <td style="width:200px;color:#1E5A9d;font-weight:bold;">Doctors</td>
            <td><?php $a = explode(',',$patient_details['Doctor_id']); ?>
			<?php $doc_listing_qry = mysql_query("select * from health_care_db.doctors where Online_status = 'Active'");?>
              <select name="arrdoctors[]" id="catname[]" multiple>
                <option value="0">Select Doctors</option>
                <?php while($doc_listing_fetch = mysql_fetch_object($doc_listing_qry)) {
				$selected = '';foreach($a as $key=>$val){
					
					if($doc_listing_fetch->Doctors_id == $val){
                    	$selected = 'selected="selected"';
                 	}
				}?>
                <option  value="<?php echo $doc_listing_fetch->Doctors_id;?>" <?php echo $selected;?>><?php echo $doc_listing_fetch->Doctors_name;?></option>
                <?php 
                        
                                        } ?>
              </select></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="Submit" id="submit"></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>
</div>


</body>
</html>

<!--SELECT * FROM `patient` WHERE  find_in_set('2',`Doctor_id`) ; -->
<script>
   
function addDiv(divID){
 html = '';
 html += '<div><input type="file" name="reportm[]" id="reportm[]" required/><a href="javascript:void(o)" onclick="$(this).parent().remove();" class="btn">DELETE</a><br></div>';

$('#'+divID).append(html);

}
</script>