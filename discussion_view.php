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
if ($_SESSION['Patient_id']!= '')
{
$patID = $_SESSION['Patient_id'];
$rs_get_discussion_list = query_fatchdata("SELECT discussion.*,patient.Patient_name FROM `discussion` JOIN patient ON discussion.patient_id=patient.Patient_id WHERE FIND_IN_SET('".$patID."',discussion.patient_id)");

//var_dump($rs_get_discussion_list);
//die;

}
else if ($_SESSION['Doctors_id']!= '')
    
{
    $docID = $_SESSION['Doctors_id'];
$rs_get_discussion_list = query_fatchdata("SELECT discussion.*,doctors.Doctors_name FROM `discussion` JOIN doctors ON discussion.doctor_id=doctors.Doctors_id WHERE FIND_IN_SET('$docID',discussion.doctor_id)");
   /* $rs_get_discussion_list1 = getAllRecordFromTableWithJoin
        ('discussion',array('doctors'=>'discussion.doctor_id=doctors.Doctors_id')
        ,array('discussion.doctor_id'=>FIND_IN_SET($_SESSION['Doctors_id'],`doctor_id`)),
        'discussion.*,doctors.Doctors_name',array('`discussion`.`date`'=> 'desc'));*/
    //var_dump($rs_get_discussion_list1);
//die;

}

	

?>
<?php
     include_once ('Includes/header.php');
     ?>

<div id="prescription-column-middle">
<div id="appointment-story-box" class="patient-background">
    <div id="title-box2" class="title-box-background-orange title-medium" style="display:block "></div>
 
  <table style="width:100%" border="0">
      <button><p><a href="discussion.php?pid=<?php ;?>">Start New </a></p> </button>
      <thead id="discussion_header">
    <td style="color:whitesmoke">S.NO </td>    
   <td style="color:whitesmoke">Title</td>   
    <td style="color:whitesmoke">Sender</td>
    <td style="color:whitesmoke">Total Post</td>
   <td style="color:whitesmoke" >Date</td>
  <td style="color:whitesmoke">exit group </td></thead>
  <tbody>

  <?php
  
  $i = 1;foreach($rs_get_discussion_list as $discussion_list){
      $total_post = query_fatchdata("select count(*) as total from discussion_message where discussion_id='".$discussion_list['discussion_id']."'" );
      if($discussion_list['sender']=='doctor'){ 
        $mysql = query_fatchdata("select `doctors`.`Doctors_name` as Name from doctors where Doctors_id='".$discussion_list['author']."'");  
      } else if ($discussion_list['sender']=='patient'){
        $mysql= query_fatchdata("select Patient_name as Name from patient where Patient_id='".$discussion_list['author']."'") ;  
      }
      
      ?>
  <tr>
      <td><?php echo $i;?></td>
      <td><a href ="discussion_detail.php?dis=<?php echo $discussion_list['discussion_id']; ?> "/><?php echo substr($discussion_list['subject'],0,50).'....'?>" 
      <td><?php echo $mysql[0]['Name'];?></td>
      <td><?php echo $total_post[0]['total'];?> </td>
      <td><?php echo $discussion_list['date'];?></td>
       
                  <td colspan="2"> <button id="exitgroup" style="float:right;">Exit Group
              </button>
      
  </tr>
  
  <?php $i++; } ?>
  </tbody>
</table>
</div>
<div id="appoint" style="display:block">

</div>

</body>
</html>