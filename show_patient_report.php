<?php
include("config.php");
print_r ($_SESSION);

print_r ($_POST);die;
if($_SESSION['email'] == '')
{
	//header("Location:index.php");
}


error_reporting(0);


$reportList=false;
if(isset($_GET['report_id']) && $_GET['report_id']>0)
{
    
	
	$reportId=(int)$_GET['report_id'];
	
	$patientReportListResult = query_fatchdata("SELECT pr.report_information, r.report_type, pr.status FROM patient_report AS pr LEFT JOIN reports AS r ON pr.report_type_id=r.reports_id WHERE pr.patient_id='".$_SESSION['Patient_id']."' AND pr.report_type_id='".$reportId."'");
	
	if(!empty($patientReportListResult)){
		$reportList=true;
	}
	
	
	
}else{
	$patientReportResult = query_fatchdata("SELECT DISTINCT(r.report_type) AS name, r.reports_id AS id FROM `reports` AS r, patient_report AS pr  WHERE pr.patient_id='".$_SESSION['Patient_id']."' AND pr.report_type_id=r.reports_id");
}


/*$patient_report_sql = getAllRecordFromTableWithJoin('patient_report',array('`reports`'=>'`patient_report`.`report_type_id` = `reports`.`reports_id`'), array('`patient_report`.`patient_id`'=>$_SESSION['Patient_id']),'GROUP_CONCAT(patient_report.report_information) as GrpList,reports.report_type','','','`patient_report`.`report_type_id`');*/
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
    <br>
    <?php if($reportList){?>
    <ul style="margin-top:10px;" id="gallery">
      <?php $i = 1;
	   if(!empty($patientReportListResult)){?>
              <ul style="margin-top:10px;" id="gallery">
                  <li style="list-style:none;"><p class="reportUl"><?php echo $patientReportListResult[0]['report_type'];?> Reports</p>
                     <ul>
                     <?php foreach($patientReportListResult as $list){?>
                  <li style="list-style:none;"><div style="width:180px;float:left;padding:20px;" class="thumbnail">
                  <a href="<?php echo $siteUrl.'upload/patient_report/'.$list['report_information']?>">
                                            <img src="<?php echo $siteUrl.'upload/patient_report/'.$list['report_information']?>" style="width:100% !important;height:150px;"/>
                                                    </a></div></li>
                  <?php }?>
                  </ul>
                  </li>
                 <div style="clear:both;"></div>
                </ul>
      <?php
	  }else{
		  echo 'No List Available';
	  }?>
    </ul>
    <?php }else{?>
    <ul style="margin-top:10px;" id="">
      <?php $i = 1;
	   if(!empty($patientReportResult)){
			foreach($patientReportResult as $list){	  ?>
              <li style="list-style:none;">
                <p class="reportUl"><a href="<?php echo $siteUrl.'show_patient_report.php?report_id='.$list['id']?>"><?php echo $list['name'];?> Reports</a></p>
              </li>
              <div style="clear:both;"></div>
      <?php }
	  }else{
		  echo 'No Reports Available';
	  }?>
    </ul>
    <?php }?>
  </div>
</div>
</body>
</html>
