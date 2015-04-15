<?php 
include_once('config.php');
include_once('includes/function.php');
$html = '';
if($_REQUEST['member_id'] <>''){
    

 $rs_patient_prescription_details = getAllRecordFromTableWithJoin('prescription',array('patient'=>'patient.Patient_id=prescription.Patient_id','doctors'=>'doctors.Doctors_id=Prescription.Doctors_id'),array('prescription.Prescription_id'=>$_REQUEST['member_id']),'prescription.*,patient.Patient_name,doctors.Doctors_name');
 $patient_prescription_details=$rs_patient_prescription_details[0];
 //var_dump($patient_prescription_details);
 //die;
 
$html .='<div class="popupcontenter">';
   $html .= '<div class="popup_heder">';
    $html .= ' <h4>Your Prescription Details<a href="javascript:void(0);" onclick="close_member_pop();" class="custompopupclose crx_mng"><img src="images/cross_1.png"></a></h4>';
   $html .= '</div>';
   
   $html .='  <table cellpadding="10"><td style="border-bottom:2px solid #CCC;width:10%">By Dr.</td>';
   $html .= '<td style="border-bottom:2px solid #CCC;width:10%"> Your Medcine</td>';
   $html .= '<td style="border-bottom:2px solid #CCC;width:10%">Your Schedule</td>';
   $html .= '<td style="border-bottom:2px solid #CCC;width:10%">Medicine Timing</td>';
   $html .='<tr style="border-bottom:1px solid #CCC;">';
    $html .= '<td>'.$patient_prescription_details['Doctors_name'].'</td>';
    $html .= '<td>'.$patient_prescription_details['medicine'].'</td>';
    $html .= '<td>'.$patient_prescription_details['medicine_schedule'].'</td>';
    $html .= '<td>'.$patient_prescription_details['medicine_time'].'</td>';
    $html .= '</tr>';
    $html.='</table>';
  
 
echo $html;
}

?>