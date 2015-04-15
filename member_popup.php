<?php 
include_once('config.php');
include_once('includes/function.php');
$html = '';
if($_REQUEST['member_id'] <>''){
    
$doctors_appointment_details = getAllRecordFromTableWithJoin('appointment',array('patient'=>'patient.Patient_id=appointment.Patient_id','doctors'=>'doctors.Doctors_id=appointment.Doctors_id'),array('appointment.appointment_id'=>$_REQUEST['member_id']),'appointment.*,patient.Patient_name,doctors.Doctors_name'); 
$rs_doctors_details = $doctors_appointment_details[0];
$rs_history_all= getAllRecordFromTableWithJoin('patient_history',array('`disease`'=>'`disease`.`disease_id`=`patient_history`.`disease_id`'),array('`patient_history`.`patient_id`'=>$rs_doctors_details['Patient_id']),'`patient_history`.*,`disease`.`disease_name`');
//var_dump($rs_history_all); die;
 
$html .='<div class="popupcontenter">';
   $html .= '<div class="popup_heder">';
    $html .= ' <h4>Booking Detail<a href="javascript:void(0);" onclick="close_member_pop();" class="custompopupclose crx_mng"><img src="images/cross_1.png"></a></h4>';
   $html .= '</div>';
   
   $html .='  <table cellpadding="10"><td style="border-bottom:2px solid #CCC;width:10%">appointment date</td>';
   $html .= '<td style="border-bottom:2px solid #CCC;width:10%"> prefered contact</td>';
   $html .= '<td style="border-bottom:2px solid #CCC;width:10%">prefered address</td>';
   $html .= '<td style="border-bottom:2px solid #CCC;width:10%">reason</td>';
   $html .='<tr style="border-bottom:1px solid #CCC;">';
    $html .= '<td>'.$rs_doctors_details[appointment_date_time].'</td>';
    $html .= '<td>'.$rs_doctors_details[Prefered_Contact].'</td>';
    $html .= '<td>'.$rs_doctors_details[Prefered_Address].'</td>';
    $html .= '<td>'.$rs_doctors_details[appointment_reason].'</td>';
    $html .= '</tr>';
    $html.='</table>';
   
   
 $html .='  <table cellpadding="10"><td style="border-bottom:2px solid #CCC;width:10%">Sr No</td>';
 $html .= '<td style="border-bottom:2px solid #CCC;width:10%"> Disease</td>';
 $html .= '<td style="border-bottom:2px solid #CCC;width:10%">Medicine Name</td>';
 $html .= '<td style="border-bottom:2px solid #CCC;width:10%">Medicine Color</td>';
 $html .= '<td style="border-bottom:2px solid #CCC;width:10%">Allergy</td>';
 $i = 1; foreach($rs_history_all as $historyList){
 $html .='<tr style="border-bottom:1px solid #CCC;"><td>'. $i .'</td><td>' . $historyList['disease_name'].'</td>';
 $html .= '<td>'.$historyList['medicine'].'</td>';
 $html .= '<td><div style="height:20px; background:' . '#'.$historyList['medcine_color'].'"></div></td>';
 $html .= '<td>' . $historyList['alleregy'].'</td>';
 $html .= '</tr>';
 $i++; }
 $html.='</table>';
 $html .= '<td> <button type="button"><a href="appoint_reply.php?pid='.generateRandomString(10).$rs_doctors_details['Patient_id'].generateRandomString(10).'&aid='.generateRandomString(10).$rs_doctors_details['appointment_id'].generateRandomString(10).'">reply</a> </td>';
echo $html;
}

?>