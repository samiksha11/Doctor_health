<?php
include("config.php");
if($_SESSION['email'] == '')
{
	//header("Location:index.php");
}

error_reporting(0);
$rs_history_all= getAllRecordFromTableWithJoin('patient_history',array('`disease`'=>'`disease`.`disease_id`=`patient_history`.`disease_id`'),array('`patient_history`.`patient_id`'=>$_SESSION['Patient_id']),'`patient_history`.*,`disease`.`disease_name`');

//var_dump($rs_history_all);

$rs_disease_detail = getAllDataFromTable('disease',array('disease`.`disease_id'=>$disease_id),'', '*');
$disease_detail = $rs_disease_detail[0];

$rs_medicine_detail = getAllDataFromTable('medicine',array('medicine`.`medicine_id'=>$medicine_name),'','medicine_name'); 
$get_medicine_detail = $rs_medicine_detail[0];

if(isset($_POST['submit']) && $_POST['submit'] == 'Save History'){ 
	 //var_dump($_POST); die;
       patient_history();
}
?>
<?php include_once ('Includes/header.php'); ?>
<script type="text/javascript" src="jscolor/jscolor.js"></script>
<div id="column-middle">
<div id="p-story-box" class="white-background">
    <div id="p-title-box" class="title-box-background-orange title-medium">My History </div>
        <table cellpadding="10"> 
       
        <td style="border-bottom:2px solid #CCC;width:10%">Sr No</td>
        <td style="border-bottom:2px solid #CCC;width:10%"> Disease</td>
        <td style="border-bottom:2px solid #CCC;width:10%">Medicine Name</td>
        <td style="border-bottom:2px solid #CCC;width:10%">Medicine Color</td>
        <td style="border-bottom:2px solid #CCC;width:10%">Allergy</td>
       
      <?php $i = 1; foreach($rs_history_all as $historyList){?>
     <tr style="border-bottom:1px solid #CCC;">
     <td><?php echo $i;?></td>
          <td><?php echo $historyList['disease_name'];?></td>
          <td><?php echo $historyList['medicine'];?></td>
          <td><div style="height:20px; background:<?php echo '#'.$historyList['medcine_color'];?>;"></div></td>
          <td><?php echo $historyList['alleregy'];?></td>
        </tr>

     
      
           <?php $i++; }?> </table>
              </fieldset>
  </div>
  </div>
  <div id="column-middle">
  <div id="p-story-box" class="white-background">
    <div id="p-title-box" class="title-box-background-orange title-medium">Add History </div>
    <form method="POST" action="" enctype="multipart/form-data" >
      <table cellpadding="10">
        <tr>
          <td><strong>Disease</strong> </td>
          <td><select name="disease_id" id="catname">
              <option value="0">Select Category</option>
              <?php $listing1 = mysql_query("select * from health_care_db.disease");
                    while($listing_fetch1 = mysql_fetch_object($listing1))  { ?>
             			 <option value="<?php echo $listing_fetch1->disease_id;?>" <?php echo ($listing_fetch1->disease_id==$disease_details['disease_id'])?> > <?php echo $listing_fetch1->disease_name;?></option>
              <?php 
                      
                } ?>
            </select></td>
        </tr>
        <tr>
          <td  style="width:300px;"> <strong>Medicine Name</strong> </td>
          <td><input type="text" name="medicine_name" required></td>
        </tr>
        <tr>
          <td  style="width:300px;"> <strong>Medicine Color</strong> </td>
          <td> <input class="color" value="ED4940" name="medicine_color"> </td>
        </tr>
        <tr id ="allergy">
          <td> <strong>Allergy</strong> </td>
          <td><input type="text" name="allergy" required></td>
        </tr>
        <tr>
          <td><b> Upload prescription </b></td>
          <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
        </tr>
        <?php $patientID = substr($_REQUEST['pid'], 10, -10);?>
        <tr>
          <td>
          <input type="hidden" name="patientID" value="<?php echo $patientID;?>" />
          <input id="button" type="submit" name="submit" value="Save History" /></td>
          </tr>
      </table>
    </form>
    </fieldset>
  </div>
</div>

</body>
</html>