<?php
include("config.php");
include("ckeditor/ckeditor.php");

error_reporting();
$Patient_id = $_REQUEST['pid'];

$doctors_patient_details = getAllDataFromTable('patient',array('Patient_id'=>$Patient_id),'','*');
//var_dump($doctors_patient_details);
$rs_doctors_patient_details = $doctors_patient_details[0];
?>

<?php
if(isset($_POST['send']) && $_POST['send'] == 'send'){  
    //extract($_POST);
    //var_dump($_POST);
    //die();
       discussion();
       $Post_data = array('message'=>$content);
       $rs_discussion_message= insert_table('discussion_message',$Post_data);
        $rs_discussion_message1 =$rs_discussion_message[0]; 
} ?>



<?php

     include_once ('Includes/header.php');
     ?>

    
    
<!-- Patients discussion -->
<div id="prescription-column-middle">

<div id="title-box2" class="title-box-background-orange title-medium">
 
    <form method="post" name="prescription" action="" enctype="multipart/form-data" >
        <fieldset style="width:50%">
        <div id="subject" style ="display: block"background-color:red padding:20px>
            <table>
                <tr id="subject">
                    <td> subject</td>
                    <td><input type="text" id="tooltip-1" title="please provide your subject"name="subject"></td>
                </tr>
                <tr id="topic"> 
                    <td>Topic</td>
                    <td><input type="radio" name="topic" id="disease" value="disease">Disease &nbsp;&nbsp;<input type="radio" name="topic" id="insurance" value="insurance">Insurance</td>
                </tr>
            <tr id="disease_selection">
              <td style="width:300px;">Disease</td>
              <td>
                <select name="disease_id" id="disease_selection" >
                  <option value="0">Select Category</option>
                  <?php $listing = mysql_query("select * from health_care_db.disease");
                        while($listing_fetch = mysql_fetch_object($listing)){?>
                  <option value="<?php echo $listing_fetch->disease_id;?>" > <?php echo $listing_fetch->disease_name;?></option>
                  <?php }?>
                </select>
              </td>
            </tr> 
            <tr id="patient_selection"  style="display:none ">
              <td style="width:300px;">Patient</td>
                <td>
              <select name="Patient_id[]" id="patient_id" multiple="multiple">
                <option value="0">Select Category</option>
                <?php $listing = mysql_query("select * from health_care_db.patient");
                                        while($listing_fetch = mysql_fetch_object($listing))

                    {?>
                <option value="<?php echo $listing_fetch->Patient_id;?>" > <?php echo $listing_fetch->Patient_name;?></option>
                <?php 

                    } ?>
                </td>
              </tr>
            <tr id="department" style="display:none">
              <td>Department </td>
              <td><?php $listing1 = mysql_query("select * from health_care_db.department");?>
                <select name="department_id" id="catname" onchange="getDoctors(this.value);" >
                  <option value="0">Select Category</option>
                  <?php while($listing_fetch1 = mysql_fetch_object($listing1)){?>
                  <option value="<?php echo $listing_fetch1->Department_id;?>"<?php echo ($listing_fetch1->Department_id==$doctors_details['Department_id'])?'selected':'';?> > <?php echo $listing_fetch1->Department_Name;?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr id="doctor" style="display:none">
              <td style="width:300px;"> Doctor Name </td>
              <td><select name ="Doctors_name[]" id="docname" multiple="multiple">
                </select></td>
            </tr>


            <tr id="insurance_selection" style="display:none">
              <td style="width:300px;">Insurance</td>
                <td>
                    <select name="Insurance_id" id="Insurance_id" onchange="return getInsuranceDoctorPatients(this.value);">
                <option value="0">Select Category</option>
                <?php $listing = mysql_query("select * from health_care_db.insurance");
                                        while($listing_fetch = mysql_fetch_object($listing))

                    {?>
                <option value="<?php echo $listing_fetch->Insurance_id;?>" > <?php echo $listing_fetch->Company_name;?></option>
                <?php 

                    } ?>
                </select>
               </td>  
            </tr>
            <tr id="patientsInsPatients" style="display:none">
              <td style="width:300px;"> Patients Name </td>
              <td><select name ="patient_name[]" id="insPatientsName" multiple="multiple">
                </select></td>
            </tr>
             <tr id="doctorsInsPatients" style="display:none">
              <td style="width:300px;"> Doctors Name </td>
              <td><select name ="doctors_name[]" id="insDoctorsName" multiple="multiple">
                </select></td>
            </tr>
            <tr id ="patient_prescription">


              <td><?php $oFCKeditor = new CKEditor();

          $oFCKeditor->basePath = 'ckeditor/';

          $value = $content;

          //$oFCKeditor->config['width']  = '135%' ;
          $oFCKeditor->config['width']  = '300%' ;
           $oFCKeditor->config['height'] = '300' ;
         // $oFCKeditor->config['height'] = '600' ;
         $oFCKeditor->config ['margin-bottom']= '20px';

          $oFCKeditor->editor('content',$value);

          ?></td>
            </tr>
           <tr> <td><input type="submit" name="send" value="send" id="send"></td> </tr>

    </table>        
           </div>
        </fieldset>
    </form>
	</body>
</html>
 
</body>
</html>
