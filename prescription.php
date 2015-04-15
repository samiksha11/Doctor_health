<?php

include("config.php");

if($_SESSION['email'] !== '')
{
	session_regenerate_id(true);
//header("Location:index.php");
}

error_reporting(0);

?>
<?php
$msg_id = substr($_REQUEST['pid'] , 10 , -10 );
$fetch_status= query_fatchdata("select * from `prescription` where `prescription`.`Prescription_id` = '".$msg_id."' AND `patient_message`.`status` = 'unread'") ;
//echo count($fetch_status);
if(count($fetch_status) >= 1){
    mysql_query("update  patient_message set  status ='read' where patient_message_id= '".$msg_id."'");
    
}

//var_dump($update_status);die;
$rs_get_patient_message = getAllRecordFromTableWithJoin
        ('patient_message',array('doctors'=>'patient_message.doctor_id=doctors.Doctors_id','patient'=>'patient_message.patient_id=patient.Patient_id')
        ,array('patient_message.patient_message_id'=>$msg_id),'patient_message.*,doctors.Doctors_name,patient.Patient_name');
$rs_get_patient_message1 = $rs_get_patient_message[0];
//var_dump($rs_get_patient_message);
//die;
?>
<?php
include_once ('Includes/header.php');
?>
<div id="prescription-column-middle">
<div id="appointment-story-box" class="patient-background">
    <div id="title-box2" class="title-box-background-orange title-medium" style="display:block "></div>
    <div style="padding:25px;">
  <table style="width:100%;" border="0" cellspacing="15">
      
<tr> 
     <td style="width:30%" float:left > From </td>
     <td><?php echo $rs_get_patient_message1[Doctors_name];?></td>
</tr>
<tr>
<td > To</td> 
    <td ><?php echo $rs_get_patient_message1[Patient_name];?></td>
</tr>
<tr> <td>NDA </td>
    <td><?php echo ($message_list['nda_form'] == '')?'NA':$message_list['nda_form'];?></td>
    
   </tr>
   <tr> <td>Date </td>
    <td><?php echo $rs_get_patient_message1[date_form];?></td>
   </tr>
   
    <tr style="outline:solid"> <td  colspan="2"><?php echo $rs_get_patient_message1['message'];?></td>
      </tr> 
      
</table>
        <button type="button" ><a href="patient_message.php?pid=<?php echo generateRandomString(10).$_SESSION['Patient_id'].generateRandomString(10);?>">Back</a> 
</div>
<div id="appoint" style="display:block">

</div>

</body>
</html>