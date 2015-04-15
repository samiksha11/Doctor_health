<?php
include("config.php");
//print_r ($_SESSION);
if($_SESSION['email'] == '')
{
	//header("Location:index.php");
}

error_reporting(0);
 
$patient_report_sql = getAllRecordFromTableWithJoin('patient_report',array('`reports`'=>'`patient_report`.`report_type_id` = `reports`.`reports_id`'), array('`patient_report`.`patient_id`'=>$_SESSION['Patient_id']),'GROUP_CONCAT(patient_report.report_information) as GrpList,reports.report_type','','','`patient_report`.`report_type_id`');
?>
<?php
     include_once ('Includes/header.php');
     ?>
<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
<script>
 $(function() {
        $('#gallery a').lightBox();
    });
</script>
<!-- patient profile-->
<div id="column-middle" style="width:70% !important;">
  <div id="p-story-box" class="white-background" >
    <div id="p-title-box" class="title-box-background-orange title-medium">Reports Listing </div>
   <br> <ul style="margin-top:10px;" id="gallery">
      <?php $i = 1; foreach($patient_report_sql as $list){ 
	  $report_list_arr = explode(',',$list['GrpList']);?>
      <li style="list-style:none;"><p class="reportUl"><?php echo $list['report_type'];?> Reports</p>
      	 <ul>
		 <?php foreach($report_list_arr as $rprtListing){?>
      <li style="list-style:none;"><div style="width:180px;float:left;padding:20px;" class="thumbnail">
      <a href="../upload/patient_report/<?php echo $rprtListing;?>">
                                <img src="../upload/patient_report/<?php echo $rprtListing;?>" style="width:100% !important;height:150px;"/>
                                        </a></div></li>
      <?php }?>
      </ul>
      </li>
     
     <div style="clear:both;"><br></div>
      <?php }?>
    </ul>
  </div>
</div>
</body>
</html>
