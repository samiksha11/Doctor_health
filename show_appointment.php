<?php
include("config.php");

if($_SESSION['email'] !='')
{
	session_regenerate_id(true);
//header("Location:index.php");
}

error_reporting(0);
//
    //$rs_history_all= $rs_history_all1[0];
//var_dump($rs_history_all1);
    //die;
$rs_appointmented_patient = getAllRecordFromTableWithJoin('appointment',array('patient'=>'appointment.Patient_id=patient.Patient_id'),array('appointment.Doctors_id'=>$_SESSION['Doctors_id']),'appointment.*,patient.Patient_name');

$appointmented_patient = $rs_appointmented_patient[0];
//var_dump($rs_appointmented_patient);
//die;

 $rs_doctors_appointment_details = getAllDataFromTable('appointment',array('Doctors_id'=>$_SESSION['Doctors_id']),'','Patient_id');
 $doctors_appointment_details = $rs_doctors_appointment_details[0];
 if(isset($_POST['book']) && $_POST['book'] == 'book'){  extract($_POST);
      
	  fix_Appointment();
      //var_dump($_POST);
      //die();
  
    
  
 }
?>
<?php
     include_once ('Includes/header.php');
	  $total_appointments=mysql_query("SELECT Patient_id, COUNT(*) as total FROM appointment where Doctors_id = '{$_SESSION['Doctors_id']}' group by send_date;");
              $data=mysql_fetch_assoc($total_appointments);
               ?>
<script>
      $(document).ready(function() {
            $('#faq-list h2').click(function() {
                
                $(this).next('.answer').slideToggle(500);
                $(this).toggleClass('close');
                
            });
        }); 
        function get_member_info(id){
			var dataString = 'member_id='+ id;
			//alert(dataString);
			 $.ajax({
			  type: "POST",
			  url: "member_popup.php",
			  data: dataString,
			  cache: false,
			  success: function(result){
					  $('#customoverlay').html(result);
					  $('#customoverlay').show();
					  }
			  });
		}
		function close_member_pop(){
			$('.customoverlay').hide();
		}
     </script>
<style>
/* =The style for the lab
-------------------------------------------------------------- */

hr {
	height: 1px;
	border: none;
	background-color: rgb(220,220,220)
}
.answer {
	display: none;
	margin-left:20px;
}
h2 {
	line-height: 24px;
	font-size: 18px;
	font-weight: 700;
	color: rgb(100,150,200);
	padding-left: 24px;
	cursor: pointer;
	background-image: url('images/open.png');
	background-position: left;
	background-repeat: no-repeat;
	margin-top:15px;
}
h2.close {
	background-image: url('images/close.png');
}
.close{
	color: #000000;
    float: none !important;
    font-size: 20px;
    font-weight: bold;
    line-height: 20px;
    opacity: 0.2;
    text-shadow: 0 1px 0 #ffffff;
}
</style>

<div id="prescription-column-middle">
<div id="appointment-story-box" class="patient-background">
<div id="title-box2" class="title-box-background-orange title-medium" style="display:block ">
<form method="post" name="appointment" action="" enctype="multipart/form-data" onsubmit="return validation();">
<fieldset style="width:100%">
<table cellspacing="30">
  <tr>
    <th> <div id="total1"  style="cursor:pointer;font-size:14px;">Total Appointments( <?php echo $data['total']; ?> ) </div></th>
    <th>|</th>
    <th style="cursor:pointer;font-size:14px;">Pending Appointments</th>
    <th>|</th>
    <th style="cursor:pointer;font-size:14px;"> Booked Appointments </th>
</table>
</div>
<div id="appoint" style="display:block">
<?php
    //echo $appointmented_patient['Patient_name']; ?>
<?php
            while($get_appointmented_patient = mysql_fetch_array($rs_appointmented_patient))
                { 
                ?>
<div style="height: 80px"><a href="#" style="display: block"> <a href ="javascript:void(0);" onclick=""<?php echo  $rs_get_appointmented_patient['Patient_id'];?><?php echo  $rs_get_appointmented_patient['Patient_name']; 
            echo "</br>";
            
           ?></a>
  <?php }
            ?>
  <div style="height: 80px"><a href="#" style="display: block;background-color:blue"> <?php echo  $rs_get_appointed_patient_name['Patient_id'];?>" <?php echo  $rs_get_appointed_patient_name['Patient_name']; 
            echo "</br>";
            
           ?></a>
    <?php //echo $appointmented_patient['appointment_date_time']; ?>
    
    <!-- <td> appointment date</td>
        <td><input type="text" data-field="datetime" readonly class="input" name="datetime" id="datetime">
          <div id="DateTimePicker"></div></td>
      </tr>
    <tr>
  <td>&nbsp;</td>
        <td><input type="submit" name="book" value="book" id="book"></td>
      </tr>
      
      </table>
    </form>
  </fieldset>--> 
  </div>

  <?php $doctors_appointment_details = getAllRecordFromTableWithJoin('appointment',array('patient'=>'patient.Patient_id=appointment.Patient_id','doctors'=>'doctors.Doctors_id=appointment.Doctors_id'),array('appointment.Doctors_id'=>$_SESSION['Doctors_id']),'appointment.*,patient.Patient_name,doctors.Doctors_name'); ?>
<ul>
    <?php  foreach($doctors_appointment_details as $rs_doctors_appointment_details){ ?>
    <li><div>
            <h2><a href="#" onclick="get_member_info('<?php echo $rs_doctors_appointment_details['appointment_id'];?>');"><?php echo $rs_doctors_appointment_details['Patient_name']; ?></a></h2>
    </div></li>
    <?php } ?>
</ul>
 </div>
<script>
$(document).ready(function(){$("#DateTimePicker").DateTimePicker();})
</script>

</div><div class="customoverlay" id="customoverlay">
  
</div>
</body>
</html>