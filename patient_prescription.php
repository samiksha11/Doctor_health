<?php
include("config.php");
include("ckeditor/ckeditor.php");

error_reporting(0);
$Patient_id = $_REQUEST['pid'];

$doctors_patient_details = getAllDataFromTable('patient',array('Patient_id'=>$Patient_id),'','*');
//var_dump($doctors_patient_details);
$rs_doctors_patient_details = $doctors_patient_details[0];
?>
<?php
if(isset($_POST['send']) && $_POST['send'] == 'send')
    
    {  extract($_POST);
     //var_dump($_POST);
       //die();
       prescription();
     
       
    }
 
 


 ?>
<?php

     include_once ('Includes/header.php');
     ?>
<!-- Patients Prescription -->
<div id="prescription-column-middle">
 <form method="post" name="prescription" action="" enctype="multipart/form-data">
<div id="title-box2" class="title-box-background-orange title-medium">
   
    <ul>
        <li>prescription for <?php echo $rs_doctors_patient_details['Patient_name'];?>
        </li> 
        <li><?php echo $rs_doctors_patient_details['email'];?> </li>
        <li><input type="hidden" name="pid" id="pid" value="<?php echo $_REQUEST['pid'];?>">
            <td><input id="send" type="submit" name="send" value="send" ></td>
            </li>
    </ul>
       
    
</div>
<table border="0" id="prescription" style="display: block;">
 
     <thead>
         <tr>
           <th>Medicine</th>
           <th>Time</th>
           <th> Schedule </th>
           <th> &nbsp; </th>
         </tr>
      </thead>
      <tbody id="addprec">
          
         <tr id='presc'>
            
           <td><input type="text" name="fullname[][]"></td>
           <td>
              <select name="timing[]" id="patient_BloodGroup">
            <option value="once a day">once a day</option>
            <option value="twice a day">twice a day</option>
            <option value="thrice a day">thrice a day</option>
            <option value="once a week">once a week</option>
            <option value="twice a week">twice a week</option>
            <option value="thrice a week">thrice a week</option>
            <option value="once a month">once a month</option>
            <option value="once in 6 month">once in 6 month</option>
          </select> </td>
          <td> <select name="time[]">
            <option value="before food">before food</option>
            <option value="after food">after food</option>
              </select></td>
          <td style ="width:200px;"><a href="javascript:void(o);" id="addnewaddress" name="addnewaddress" onClick="addDiv('addprec');"><img src="Images/plus.png" title="Add More Prescrption"></a></td>

          </tr>
      <tr>
        <td>&nbsp;</td>
        <td><br>
          <tr id="newaddDIV_<?php echo $i;?>"></tr></td>
          
          </tbody>
        
        <tr id ="patient_prescription">
            
          
            <td colspan="3"><?php $oFCKeditor = new CKEditor();

      $oFCKeditor->basePath = 'ckeditor/';
      
      $value = $content;
     
      //$oFCKeditor->config['width']  = '135%' ;
      $oFCKeditor->config['width']  = '135%' ;
       $oFCKeditor->config['height'] = '200' ;
     // $oFCKeditor->config['height'] = '600' ;
     $oFCKeditor->config ['margin-bottom']= '20px';
     
      $oFCKeditor->editor('content',$value);

      ?></td>
        </tr>
       
          </tbody>
        
    
      </table>
   </form> 
    </fieldset>
 <script>
   
function addDiv(divID){
 html = '';
 html += '<tr><td><input type="text" name="fullname[]"></td><td><select name="timing[]" id="patient_BloodGroup"><option value="once a day">once a day</option><option value="twice a day">twice a day</option><option value="thrice a day">thrice a day</option><option value="once a week">once a week</option><option value="twice a week">twice a week</option><option value="thrice a week">thrice a week</option><option value="once a month">once a month</option><option value="once in 6 month">once in 6 month</option></select> </td><td> <select name="time[]"><option value="before food">before food</option><option value="after food">after food</option></td><td><a href="javascript:void(o)" onclick="$(this).parent().parent().remove();" ><img src="images/cross.png"></a></td><tr>';
        

$('#'+divID).append(html);

}
</script>
</body>
</html>
