<?php 
include("config.php");
if($_REQUEST['did'] !=''){
$rs_doc_dep_detail = getAllDataFromTable('doctors',array('doctors`.`Department_id'=>$_REQUEST['did']),'','*');
foreach ($rs_doc_dep_detail as $value) {
    echo $result= "<option value ='".$value['Doctors_id']."'>".$value['Doctors_name']."</option>";    
    
     }
}else if($_REQUEST['disId']!=''){
     $rs_patient_ins_doc = getAllRecordFromTableWithJoin
        ('patient_insurance_acceptance',array('patient'=>'patient_insurance_acceptance.patient_id=patient.Patient_id')
        ,array('patient_insurance_acceptance.Insurance_id'=>$_REQUEST['disId']),
        'patient_insurance_acceptance.*,patient.Patient_name');
      foreach($rs_patient_ins_doc as $val)
      { 
          $arr[] = "<option value ='".$val['Patient_id']."'>".$val['Patient_name']."</option>";
          $result['patients'] = $arr;
      }
      
      $rs_patient_ins_doc1 = getAllRecordFromTableWithJoin
        ('insurance_acceptance',array('doctors'=>'insurance_acceptance.Doctors_id=doctors.Doctors_id')
        ,array('insurance_acceptance.Insurance_id'=>$_REQUEST['disId']),
        'insurance_acceptance.*,doctors.Doctors_name');
      foreach($rs_patient_ins_doc1 as $val1)
      { 
          $arr1[] = "<option value ='".$val1['Doctors_id']."'>".$val1['Doctors_name']."</option>";
          $result['doctors'] = $arr1;
      }
     echo json_encode($result);
      
}
?>
