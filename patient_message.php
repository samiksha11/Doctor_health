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

$rs_get_patient_message = getAllRecordFromTableWithJoin
        ('patient_message',array('doctors'=>'patient_message.doctor_id=doctors.Doctors_id')
        ,array('patient_message.patient_id'=>$_SESSION['Patient_id']),
        'patient_message.*,doctors.Doctors_name',array('`patient_message`.`date_form`'=> 'desc'));
//var_dump($rs_get_patient_message);
//die;
echo $rs_get_patient_message['Doctors_name']
?>
<?php
     include_once ('Includes/header.php');
     ?>
<div id="prescription-column-middle">
<div id="appointment-story-box" class="patient-background">
    <div id="title-box2" class="title-box-background-orange title-medium" style="display:block "></div>
 
  <table style="width:100%" border="0">
      <thead>	
   <td>Sr No</td>   
    <td >Doctors</td>
    <td>Messages
    </td>
    <td >NDA form</td>
    <td >Date</td></thead>
  <tbody>
  <?php $i = 1;foreach($rs_get_patient_message as $message_list){?>
  <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $message_list['Doctors_name'];?></td>
      <td><?php echo substr($message_list['message'],0,50).'....'?>
     <a href="message.php?pid=<?php echo generateRandomString(10).$message_list['patient_message_id'].generateRandomString(10);?>" style="color:red;">Read me </a>
  </td>
     <td><?php if($message_list['nda_form'] == ''){echo 'NA';}
     else{?><a href="download.php?filename=<?php echo $message_list['nda_form'];?>" class="links"><img src="Images/download.png" style="width: 10%;"></a> Download Form<?php }?></td>
      <td><?php echo $message_list['date_form'];?></td>
      
  </tr>
  
  <?php $i++; } ?>
  </tbody>
</table>
</div>
<div id="appoint" style="display:block">

</div>

</body>
</html>