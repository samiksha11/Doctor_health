<?php
include("config.php");

if($_SESSION['email'] !== '')
{
	session_regenerate_id(true);
//header("Location:index.php");
}

error_reporting(0);



$rs_doctors_detail = getAllRecordFromTableWithJoin
        ('doctors',array('department'=>'doctors.department_id=department.department_id')
        ,array('doctors.Doctors_id'=>$_SESSION['Doctors_id']),
        'doctors.*,department.department_name');

$doctors_details = $rs_doctors_detail[0];

 $rs_insurance = getAllRecordFromTableWithJoin
        ('insurance_acceptance',array('insurance'=>'insurance_acceptance.Insurance_id=insurance.Insurance_id')
        ,array('insurance_acceptance.Doctors_id'=>$_SESSION['Doctors_id']),
        'insurance_acceptance.*,insurance.Company_name');
 
 $get_insurance_id = $rs_insurance[0];

 
 if(isset($_POST['submit']) && $_POST['submit'] == 'Submit')
{
	extract($_POST);
	
		$sql = "update `health_care_db`.`doctors` set 
				Doctors_name='".trim($Doctors_name)."', 
                                Department_id='".$department_id."',    
				Address='".trim($Address)."', 
                                Phone_no='".trim($Phone_no)."'
				where Doctors_id = '".$_SESSION['Doctors_id']."'";
			//echo $sql; die;	
	$qry = mysql_query($sql);
        if($qry){
            mysql_query("delete from insurance_acceptance where Doctors_id = '".$_SESSION['Doctors_id']."'") ;
             for($i=0; $i<count($_POST['Insurance_id']);$i++)
             {
             $query1 = "INSERT INTO health_care_db.insurance_acceptance(Doctors_id,Insurance_id) 
                VALUES ('".$_SESSION['Doctors_id']."','".$_POST['Insurance_id'][$i]."')";
             mysql_query($query1);
            }
            header("Location:doctor_profile.php");
        }
	
}
if(isset($_POST['submit']) && $_POST['submit'] == 'Add Patient')
{
   //var_dump($_POST);
   //die();
    NewPaitents();
}
  


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- Keep the following line of code here for IE9 compatibility with gradients -->
<!--[if gte IE 9]> <style type="text/css"> .gradient { filter: none; } </style> <![endif]-->
<?php 
            $sql_patients = mysql_query("SELECT Patient_name,Patient_id FROM `patient` WHERE  find_in_set('".$_SESSION['Doctors_id']."',`Doctor_id`)");
            //echo "SELECT Patient_name,Patient_id FROM `patient` WHERE  find_in_set('".$_SESSION['Doctors_id']."',`Doctor_id`)";
           // $sql_patients = mysql_query("SELECT * FROM `patient` WHERE  find_in_set('".$_SESSION['Doctors_id']."',`Doctor_id`)");
            
            
            //var_dump($sql_patients);
            ?>
<?php
     include_once ('Includes/header.php');
     ?>
<div id="column-middle">
  <div id="story-box" class="white-background">
    <div id="title-box" class="title-box-background-orange title-medium">Profile </div>
    <table cellpadding="10">
      <tr>
        <td>Name:</td>
        <td><?php echo $doctors_details['Doctors_name'];?></td>
      </tr>
      <tr>
        <td>Contact No:</td>
        <td><?php echo $doctors_details['Phone_no'];?></td>
      </tr>
      <tr>
        <td>Address:</td>
        <td><?php echo $doctors_details['Address'];?></td>
      </tr>
      <tr>
        <td>Department:</td>
        <td><?php echo $doctors_details['department_name'];?></td>
      </tr>
      <tr>
        <td>Insurance:</td>
        <td><?php  foreach ($rs_insurance as $key => $value) {
                            echo $value['Company_name'].',&nbsp;';
    		};?></td>
      </tr>
      <tr>
        <td>Email:</td>
        <td><?php echo $doctors_details['email'];?></td>
      </tr>
        </tr>
      
    </table>
    <button type="button" id="Edit_details">Edit </button>
  </div>
</div>
</div>
<div id="column-right" style="display:none;" >
  <div id="story-box" class="white-background">
    <div id="title-box" class="title-box-background-orange title-medium">Edit Profile &nbsp;&nbsp;<img src="Images/close.png" width="15" height="15" alt="Close" onClick="hide('column-right')" style="float:right;margin-right: 15px;"/> </div>
    <form method="post" name="editnewdoctor" action="" enctype="multipart/form-data" onsubmit="return validation();">
      <table cellpadding="10">
        <tbody>
          <tr>
            <td style="width:300px;">Doctor Name</td>
            <td><input type="text" name="Doctors_name" id="Doctors_name" value="<?php echo $doctors_details['Doctors_name'];?>"/></td>
          </tr>
          <tr>
            <td style="width:300px;">Insurance Accepted</td>
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
          <tr>
            <td>Department </td>
            <td><select name="department_id" id="catname" >
                <option value="0">Select Category</option>
                <?php $listing1 = mysql_query("select * from health_care_db.department");
         while($listing_fetch1 = mysql_fetch_object($listing1)){?>
                <option value="<?php echo $listing_fetch1->Department_id;?>" <?php echo ($listing_fetch1->Department_id==$doctors_details['Department_id'])?'selected':'';?> > <?php echo $listing_fetch1->Department_Name;?> </option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td style="width:100px;"> Address </td>
            <td><input type="text" name="Address" id="ios_url" value="<?php echo $doctors_details['Address'];?>" /></td>
          </tr>
          <tr>
            <td style="width:100px;"> Contact_No </td>
            <td><input type="number" name="Phone_no" id="ios_url" value="<?php echo $doctors_details['Phone_no'];?>" /></td>
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
<div id="column-patient" style="display: none">
<div id="Patient-story-box" class="patient-background">
  <div id="title-box" class="title-box-background-orange title-medium">Patient Name </div>
  <?php $i=1;while($getList = mysql_fetch_array($sql_patients)){
		if($i%2 == 0){
			$preclass = 'style="background-color:#ecf0f1;padding: 6px 10px;font-size: 15px;"';
		}else {
			$preclass = 'style="background-color:#e4e6e8;padding: 6px 10px;font-size: 15px;"';
		}
   ?>
  <div <?php echo $preclass;?>><img src="images/dot_blue.png" style="width:15px;"><a href ="doctor_patient.php?pid=<?php echo  $getList['Patient_id'];?>"> <?php echo  $getList['Patient_name']; echo "</br>";?></a></div>
  <?php $i++;}?>
  <?php $i=1;foreach($rs_get_appointed_patient_name as $book_patient){
		if($i%2 == 0){
			$preclass = 'style="background-color:#ecf0f1;padding: 6px 10px;font-size: 15px;"';
		}else {
			$preclass = 'style="background-color:#e4e6e8;padding: 6px 10px;font-size: 15px;"';
		}
   ?>
  <div <?php echo $preclass;?>><img src="images/dot_blue.png" style="width:15px;"><a href ="doctor_patient.php?pid=<?php echo  $book_patient['Patient_id'];?>"> <?php echo  $book_patient['Patient_name']; echo "</br>";?></a></div>
  <?php $i++;}?>
  
  <p><a href ="doctor_patient.php?pid=<?php echo  $rs_get_appointed_patient_name['Patient_id'];?>"> <?php echo  $rs_get_appointed_patient_name['Patient_name'];echo "</br>";?></a> </p>
  <!--<button type="button" id="Add_patient">Add patients</button>--> 
  <button type="button" id="Add_patient" <a href="javascript:void(0);" onclick="Add_patient();">Add_patient</a>
  </button>
</div>
<div id="column-Add-patient" style="display: none">
<div id="Patient-story-box" class="patient-background">
  <div id="title-box" class="title-box-background-orange title-medium">New patient </div>
  <div id="Doctor-Sign-Up">
    <form  id="register-form" novalidate="novalidate" method="POST" action="" onsubmit="vsubmit();">
      <fieldset style="width:50%">
        <table border="0" id="regis_form" style="display: block;" cellpadding="10">
          <tr>
            <td>Name</td>
            <td><input type="text" name="fullname"></td>
          </tr>
          <tr >
            <td>Email</td>
            <td><input type="email" name="email1" id ="email1" class ="required email"></td>
          </tr>
          <tr>
            <td>Phone_No</td>
            <td><input type="number" name="Phone_no"></td>
          </tr>
          <tr>
            <td>Address</td>
            <td><input type="text" name="Address"></td>
          </tr>
          <tr id ="city">
            <td>city</td>
            <td><input type="text" name="city"></td>
          </tr>
          <tr id ="zip">
            <td>Zip</td>
            <td><input type="text" name="zip_code"></td>
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
                      
                } ?></select></td></tr>
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
            <td><input type="datepicker" id="datepicker" name="datepicker" size="20"></td>
          <tr id="doctors">
            <td style="width:300px;">Doctors</td>
            <td><?php $a = explode(',',$Patient_detail['Doctor_id']);?>
              <select name="arrdoctors[]" id="catname[]" >
                <option value="0">Select Doctors</option>
                <?php $listing1 = mysql_query("select * from health_care_db.doctors where Doctors_id ='".$_SESSION['Doctors_id']."'");
                       		while($listing_fetch1 = mysql_fetch_object($listing1)) {
				//$selected='';
				foreach($a as $key=>$val){
                                    if($val==$listing_fetch1->Doctors_id)
                                        {
                                        //$selected='selected';
                                    }
				}
					?>
                <option <?php echo $selected;?> value="<?php echo $listing_fetch1->Doctors_id;?>" ><?php echo $listing_fetch1->Doctors_name;?></option>
                <?php 
                        
                                        } ?>
              </select></td>
          </tr>
            </tr>
          
          
            <td><input id="button" type="submit" name="submit" value="Add Patient"></td>
          </tr>
        </table>
      </fieldset>
    </form>
  </div>
</div>
</body>
</html>

<!--SELECT * FROM `patient` WHERE  find_in_set('2',`Doctor_id`) ; -->
<?php

  ?>
