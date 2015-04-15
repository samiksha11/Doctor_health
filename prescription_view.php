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

$rs_get_patient_prescription = getAllRecordFromTableWithJoin
        ('prescription',array('doctors'=>'prescription.Doctors_id=doctors.Doctors_id')
        ,array('prescription.Patient_id'=>$_SESSION['Patient_id']),
        'prescription.*,doctors.Doctors_name',array('`prescription`.`prescription_dts`'=> 'desc'));
//var_dump($rs_get_patient_message);
//die;
echo $rs_get_patient_prescription['Doctors_name'];
?>


<?php
     include_once ('Includes/header.php');
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
			  url: "prescription_popup.php",
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
    <div id="title-box2" class="title-box-background-orange title-medium" style="display:block "></div>
 
  <table style="width:100%" border="0">
      <thead>	
   <td>Sr No</td>   
    <td>Doctors</td>
    <td>Prescription</td>
    <td >Date</td></thead>
  <tbody>
  <?php $i = 1;foreach($rs_get_patient_prescription as $prescription_list){?>
  <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $prescription_list['Doctors_name'];?></td>
      <td><?php echo substr($prescription_list['prescription_info'],0,10).'..'?>
       <li><div>   
       <a href="#" onclick="get_member_info('<?php echo $prescription_list['Prescription_id'];?>');">Read me </a>
      </div></li>
      <td><?php echo $prescription_list['prescription_dts'];?></td>
  </tr>
  <li><div>
            <h2><a href="#" onclick="get_member_info('<?php echo $prescription_list['Prescription_id'];?>');"><?php echo $rs_doctors_appointment_details['Patient_name']; ?></a></h2>
    </div></li>
  <?php $i++; } ?>
  </tbody>
</table>
</div>
<div id="appoint" style="display:block">

</div><div class="customoverlay" id="customoverlay"></div>

</body>
</html>