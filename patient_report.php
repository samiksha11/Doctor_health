<?php
include("config.php");
include("ckeditor/ckeditor.php");

error_reporting(0);
?>
<?php

if(isset($_POST['reports_1']) && $_POST['reports_1'] == 'upload')
    {
    var_dump($_POST);
   //die();
       
    patient_report();
    
    
    var_dump($_FILES);
    }
    if(isset($_POST['reports_2']) && $_POST['reports_2'] == 'upload')
    {
    var_dump($_POST);
  // die();
   
       
    patient_report();
    
    
    var_dump($_FILES);
    }
    
    if(isset($_POST['reports_3']) && $_POST['reports_3'] == 'upload')
    {
    var_dump($_POST);
   //die();
   
       
    patient_report();
    
    
    var_dump($_FILES);
    }
    ?>

<!-- Reports-->
<?php

     include_once ('Includes/header.php');
     ?>
<div id="column-right" style="display:block;">
  <div id="story-box" class="white-background">
    <div id="title-box" class="title-box-background-orange title-medium">Add reports </div>
    <?php  $listing4 = mysql_query("select * from health_care_db.reports where report_type_status = '1'");?>
    <?php $i=1; while($listing_fetch4 = mysql_fetch_object($listing4)) 
        { ?>
    <form method="POST" action="" enctype="multipart/form-data" name="report_frm_<?php echo $i;?>">
      <tr id="report_id">
        <td style="width:300px;"></td>
        <td><!--<select name="arrreport[]" id="arrreport" multiple="multiple" >-->
        <td id="blood" name="blood" style="width:250px;"><option value="<?php echo $listing_fetch4->reports_id;?>" ><?php echo $listing_fetch4->report;?></option>
          <option value="<?php echo $listing_fetch4->reports_id;?>" style="background-color:#99F;padding:10px;font-size:18px;"><?php echo $listing_fetch4->report_type;?></option>
          
          <!-- </select>--></td>
      </tr>
      <tr id="reportmn">
        <td style ="width:200px;"><input type="file" name="reportm[]" id="reportm[]" required/>
          <a href="javascript:void(o);" id="addnewaddress" name="addnewaddress" onClick="addDiv('newaddDIV_<?php echo $i;?>');"><img src="Images/plus.png" title="Add More Reports"></a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><br>
          <div id="newaddDIV_<?php echo $i;?>"></div></td>
      </tr>
      <input type="hidden" name="report_id" value="<?php echo $listing_fetch4->reports_id; ?>"/>
      <input type="hidden" name="doctors_id" value="<?php echo ($_SESSION['Doctors_id']!= '')?$_SESSION['Doctors_id']:''; ?>"/>
      <input type="hidden" name="patient_id" value="<?php echo ($_SESSION['patient_id']!= '')?$_SESSION['patient_id']:$_REQUEST['pid']; ?>"/>
      <tr>
        <td><input id="button_<?php echo $i;?>" type="submit" name="reports_<?php echo $i;?>" value="upload"></td>
      </tr>
    </form>
    <?php $i++;} ?>
    </table>
    </fieldset>
  </div>
</div>
<script>
   
function addDiv(divID){
 html = '';
 html += '<div><input type="file" name="reportm[]" id="reportm[]" required/><a href="javascript:void(o)" onclick="$(this).parent().remove();" ><img src="images/cross.png"></a><br></div>';

$('#'+divID).append(html);

}
</script>
</body>
</html>