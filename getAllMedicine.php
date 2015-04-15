<?php 
include("config.php");

     
    /* $rs_medicine_detail= getAllDataFromTable('medicine',array('medicine`.`disease_id'=>$_REQUEST['did']),'','*');*/
     $rs_medicine_detail = getAllRecordFromTableWithJoin
        ('medicine',array('disease'=>'medicine.disease_id=disease.disease_id')
        ,array('disease.disease_id'=>$_REQUEST['did']),
        'medicine.*,disease.disease_name');
    // var_dump(rs_medicine_detail); die;
foreach ($rs_medicine_detail as $value) 
    {
    echo $result= "<option value ='".$value['medicine_id']."'>".$value['medcine_name']."</option>";    
    
     }
?>