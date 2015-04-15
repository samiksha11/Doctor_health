<?php

include("config.php");
if($_SESSION['email'] == '')
{
	//header("Location:index.php");
}

error_reporting(0);
if(isset($_POST['submit']) && $_POST['submit'] == 'REPLY'){ 
	// var_dump($_POST); die;
        fix_Appointment();
               
}
?>
<?php include_once ('Includes/header.php'); ?>
<div id="column-middle">
  <div id="p-story-box" class="white-background">
    <div id="p-title-box" class="title-box-background-orange title-medium">Appointment Reply </div>
    <form method="POST" action="" enctype="multipart/form-data" >
      <table cellpadding="10">
        <tr>
          <td><strong>Message</strong> </td>
          <td><textarea id="tooltip-1" title="please provide your reply for appointment"name="message"></textarea></td>
            </td>
        </tr>
        <tr>
        
          <td><b> Upload NDA </b></td>
          <td><input type="file" name="nda_form" id="fileToUpload"></td>
        </tr>
        <?php $patientID = substr($_REQUEST['pid'], 10, -10);
                $appointmentID = substr($_REQUEST['aid'], 10, -10);?>
        <tr>
          <td>
          <input type="hidden" name="patientID" value="<?php echo $patientID;?>" />
          <input type="hidden" name="appointID" value="<?php echo $appointmentID;?>" />
          <input id="button" type="submit" name="submit" value="REPLY" /></td>
          </tr>
      </table>
    </form>
    </fieldset>
  </div>
</div>

</body>
</html>