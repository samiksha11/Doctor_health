<?php 

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function NewDoctor(){ 
	//var_dump($_POST); 
	$active_date = date('Y-m-d H:i:s') ;    
	$activate = generateRandomString('10').time() ; 
	extract($_POST);
	//echo "SELECT email FROM health_care_db.doctors  WHERE email = '$email1'"; die;
	$dupemail = mysql_query("SELECT email FROM health_care_db.doctors  WHERE email = '$email1'"); 
    if (mysql_num_rows($dupemail)){ 
        
		$_SESSION['errMsgnr'] = "<p>Your email is already in our database.</p>";
		
     }else{
       	
		$Emailmsg = '<div style="font-size:20px;text-align:center;">Welcome To HealthCare</div></p><br><br><br><br><p><b>To Activate Your Account <a href="http://localhost/Health_care_system/Doctor_health/activate_user.php?err='.$activate.'&chk=doctor">Click Here</a></p><br><br><p>Thank You<br>Healthcare Team</p>';
		
         $query = "INSERT INTO health_care_db.doctors(Doctors_name,Phone_no,Address,Department_id,email,password,Online_status,activate_code,Added_on,Last_seen) 
         VALUES ('$fullname','$Phone_no','$Address','$department_id','$email1',md5('$password'),'Inactive','$activate','$active_date','$active_date')";
     //  echo $query; die;
	     $data = mysql_query ($query)or die(mysql_error());
         $last_id = mysql_insert_id();
         if($data) { 
             for($i=0; $i<count($_POST['Insurance_id']);$i++)
             {
             	$query1 = "INSERT INTO health_care_db.insurance_acceptance(Doctors_id,Insurance_id) VALUES ('$last_id','".$_POST['Insurance_id'][$i]."')";
           		mysql_query($query1);
    		 }
			mailingNew($email1, $Emailmsg);
    		header("Location:index.php");      
     	} 
	 } 
}


function NewPaitents() {
   //echo '<pre>'; var_dump($_POST); die;
    $active_date = date('Y-m-d H:i:s') ;    
	
	$activate = generateRandomString('10').time() ; 
        extract($_POST);
    $dob = date('Y-m-d',strtotime($datepicker));    
       // echo '<pre>'; var_dump($_POST); die;
       $arrdoctors = implode(",",$arrdoctors);
	$dupemail = mysql_query("SELECT email FROM health_care_db.patient WHERE email = '$email1'"); 
    if (mysql_num_rows($dupemail)){ 
        
		$_SESSION['errMsgnr'] = "<p>Your email is already in our database.</p>";
		
	}else{
		
		$Emailmsg = '<body bgcolor="F4F4F4"><div style="font-size:20px;text-align:center;background-color:#1E599C;color:#ffffff;">Welcome To HealthCare</div></p><br><br><br><br><p><b>To Activate Your Account <a href="http://localhost/Health_care_system/Doctor_health/activate_user.php?err='.$activate.'&chk=patient">Click Here</a></p><br><br><p>Thank You<br>Healthcare Team</p></body>';
		
	$query = "INSERT INTO health_care_db.patient(patient_name, email, password, patient_DOB, patient_BloodGroup, Phone_No, carrier, Address, city, zip_code_no, Doctor_id, report_password,Online_status,activate_code) VALUES ('$fullname', '$email1', md5('$password'), '$dob', '$patient_BloodGroup', '$Phone_no','$carrier', '$Address','$city', '$zip_code', '$arrdoctors', md5('$report_password'),'Inactive','$activate')";
	//echo $query; die;
	$data = mysql_query ($query)or die(mysql_error());
	$last_id = mysql_insert_id();
	if($data) { 
		for($i=0; $i<count($_POST['Insurance_id']);$i++)
                {
			$query1 = "INSERT INTO health_care_db.patient_insurance_acceptance(patient_id,Insurance_id) VALUES ('$last_id','".$_POST['Insurance_id'][$i]."')";
                        //echo $query1;
			mysql_query($query1);
			//echo "YOUR REGISTRATION IS COMPLETED..."; 
		} //die();
            
            mailingNew($email1, $Emailmsg);
    		header("Location:index.php");
}
	}
                }



function SignUp() 
{ if(!empty($_POST['user'])) ;
}
function create_session($email,$Username,$id,$Pid,$Insurance,$email1)
{
                 $_SESSION['email'] = $email;
                $_SESSION['Username'] = $Username;
               $_SESSION['Doctors_id'] = $id;
               $_SESSION['Patient_id'] = $Pid;
               
               //$_SESSION['patient_insurance_acceptance_id'] = $Insurance;
               
               
}
function get_record()
{
$get_record = getAllRecordFromTableWithJoin
        ('doctors',array('department'=>'doctors.department_id=department.department_id')
        ,array('doctors.Doctors_id'=>$_SESSION['Doctors_id']),
        'doctors.*,department.department_name');
}


function send_email($filename,$path,$email,$msg){

$to = "$email";
$subject = "New User";

 $file = $path.$filename;
	    $file_size = filesize($file);
	    $handle = fopen($file, "r");
	    $content = fread($handle, $file_size);
	    fclose($handle);
	    $content = chunk_split(base64_encode($content));
	    
	    $uid = md5(uniqid(time()));



$message = "
<html><head></head>
<body>".$msg."</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From:'.$_SESSION['email']. "\r\n";
//$headers .= 'From:.[samiksha.solanki11@gmail.com]'. "\r\n";
mail($to,$subject,$message,$headers);
}
/*  function to send the text messages  
 * *
 */
$carrier_mail=$patient_details['Phone_No'].$patient_details['carrier'];
function send_text($carrier_mail,$msg){

$to = "$carrier_mail";
$subject = "New User";

$message = "
<html><head></head>
<body>".$msg."</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From:'.$_SESSION['email']. "\r\n";

mail($to,$subject,$message,$headers);
}
function Appointment() 
{
    extract($_POST);
    $active_date = date('Y-m-d H:i:s') ;
    $personal='personal';
   
   $Post_data = array(
       'Patient_id'=> $_SESSION['Patient_id'],
       'Doctors_id'=>$Doctors_name,
       'appointment_date_time'=>$datetime,
       'send_date'=> $active_date,
       'Prefered_Address'=>$Prefered_Address,
       'Prefered_Contact'=>$Prefered_Contact,
        'appointment_relation'=>$personal,
       'appointment_reason'=>$appointment_reason
           
        );
   $rs_appointment_detail = insert_table('appointment', $Post_data);
   
   
   $rs_patient_detail = getAllDataFromTable('patient',array('patient`.`Patient_id'=>$_SESSION['Patient_id']),'', 'Patient_name,patient_DOB,Phone_NO,patient_BloodGroup,email');

      $patient_details = $rs_patient_detail[0];
     // var_dump($patient_details);
      
      $rs_insurance = getAllRecordFromTableWithJoin
        ('patient_insurance_acceptance',array('insurance'=>'patient_insurance_acceptance.Insurance_id=insurance.Insurance_id')
        ,array('patient_insurance_acceptance.Patient_id'=>$_SESSION['Patient_id']),
        'patient_insurance_acceptance.*,insurance.Company_name');
      foreach($rs_insurance as $val)
      { 
          $getinsu[] = $val['Company_name'];
          
          $insuranceLi = implode(",", $getinsu);
          //($getinsu);
      
  
      }
     /*------check doctor in patient list during appointment*/ 
     /*   $sql5 = mysql_query("SELECT * FROM `patient` WHERE  find_in_set('Doctors_name',`Doctor_id`)");
        //var_dump($sql5);
        //die();
        $result = query($sql5);
var_dump($result);
   if ($result->num_rows > 0)
   {
     $edit_patients_doctors = implode(',',$Doctors_id);
        //echo $allCatName;
       // die();
		$sql = "update `health_care_db`.`patient` set  
			 Doctor_id='".$arrdoctors."'
				where patient_id = '".$_SESSION['Patient_id']."'";
			echo $sql; 
                        die();	
	$qry = mysql_query($sql);
   }
  // else echo 'hello';*/
    /*------------------------------------------------------------------------------*/    
         $rs_doctor_detail = getAllDataFromTable('doctors',array('doctors`.`Doctors_id'=>$Doctors_name),'','email');
          $get_doctor_detail = $rs_doctor_detail[0];
         // var_dump($get_doctor_detail);
          //die();
   
   $msg = '<div><div style="font-size:20px;background-color:#1E589B;padding:5px;text-align:center;color:#ffffff;">Welcome To HealthCare</div></p>
           <br>
		   <p style="font-size:18px;text-align:center;"><strong>'.$patient_details['Patient_name'].'</strong> request you for appointment on <strong>'.date("F j, Y, g:i a", strtotime($datetime)).'</strong></p><br><br>
		   
		   <p style="background-color:#1E589B;padding:5px;text-align:center;color:#ffffff;">Appointment Detail</p><br>
		   <table width="100%" border="1" cellspacing="0" cellpadding="10">
			  <tr>
				<th scope="col"><strong>Patient name</strong></th>
				<th scope="col">'.$patient_details['Patient_name'].'</th>
			  </tr>
			  <tr>
				<th scope="col"><strong>Email</strong></th>
				<td>'.$patient_details['email'].'</td>
			  </tr>
			  <tr>
				<th scope="col"><strong>Contact No</strong></th>
				<td>'.$patient_details['Phone_NO'].'</td>
			  </tr>
			  <tr>
				<th scope="col"><strong>Date of Birth</strong></th>
				<td>'.date("F j, Y", strtotime($patient_details['patient_DOB'])).'</td>
			  </tr>
			  <tr>
				<th scope="col"><strong>Insurance Accepted</strong></th>
				<td>'.$insuranceLi.'</td>
			  </tr>
			  <tr>
				<th scope="col"><strong>Requested Appointment Date</strong></th>
				<td>'.date("F j, Y, g:i a", strtotime($datetime)).'</td>
			  </tr>
			</table>
			<br><br><p>Thank You<br>'.$patient_details["Patient_name"].'</p></div>';
   
   // echo '<pre>';
   //echo $msg;
   //
   //die();
               // mailingNew($email,$msg);
              mailingNew($get_doctor_detail['email'],$msg);
              header("location:patient_profile.php");
}

function fix_Appointment() 
{
    extract($_POST);
   // var_dump($_FILES);
    if($_FILES['nda_form']['name'] !='')
    {
   $filename=$_FILES['nda_form']['name'];
   $source = $_FILES['nda_form'];
   $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
   $image1 = '_nda_form_p'.$patientID.'_a'.$appointID.$ext;      
   move_uploaded_file($source["tmp_name"],"../upload/nda_form/".$image1);
    }
    else
    {
    $image1='';
    }

    //$personal='personal';
   $date = date("Y-m-d");
   $Post_data = array(
       'patient_id'=> $patientID,
       'doctor_id'=>$_SESSION['Doctors_id'],
       'message'=>$message,
       'appointment_id' =>$appointID,
       'nda_form'=> $image1,
       'date_form'=> $date,
       'status'=> 'unread'
        );
   $rs_fix_appointment_detail = insert_table('patient_message', $Post_data);
   $rs_doctor_detail = getAllDataFromTable('doctors',array('doctors`.`Doctors_id'=>$_SESSION['Doctors_id']),'',
                                              'Doctors_name,email');

      $doctor_detail = $rs_doctor_detail[0];
      var_dump($doctor_detail);
      
      $patient_reply_details = getAllDataFromTable('patient',array('patient`.`Patient_id'=>$patientID),'','patient.email'); 
      $rs_patient_details = $patient_reply_details[0];
       var_dump($rs_patient_details);
          //die;
         
   
   $msg = '<div><div style="font-size:20px;background-color:#1E589B;padding:5px;text-align:center;color:#ffffff;">Welcome To HealthCare</div></p>
           <br>
           <table width="100%" border="1" cellspacing="0" cellpadding="10">
          <tr> <p style="background-color:#1E589B;padding:5px;text-align:center;color:#ffffff;">Appointment Detail</p><br>
           <p style="font-size:18px;text-align:center;"><strong>'.$message.'</strong> your appointment Details from <strong>'.$doctor_detail['Doctors_name'].'</strong></p><br><br>
            </tr>
          <tr><br><p><b>To Download your NON DISCLOUSER FORM Please <a href="http://localhost/Health_care_system/Doctor_health" target="_blank"> click here</a></b></p>
			  </tr>
			 <br><p>Thank You<br>Healthcare Team</p>';
   
    //echo '<pre>';
   //echo $msg;
   //
   //die();
                 //mailingNew($email,$msg);
                 mailingNew($rs_patient_details['email'],$msg);
               // send_email($email,$msg);
              header("location:show_appointment.php");
              
              
             
}
   
function rel_Appointment()
{
    extract($_POST);
    $active_date = date('Y-m-d H:i:s') ;
    $relative='relative';
    $arrinsurance = implode(",",$arrinsurance);
   
   $Post_data = array(
       'Patient_id'=> $_SESSION['Patient_id'],
       'Doctors_id'=>$Doctors_name,
       'appointment_date_time'=>$datetime,
       'send_date'=> $active_date,
        'appointment_relation'=>$relative,
         'other_patient_name'=>$Relative ,
          'Relative_email'=>$Relative_email,
          'relative_insurance'=>$arrinsurance,
           'relation_id'=>$relation_id
        );
   $rs_appointment_detail = insert_table('appointment', $Post_data);
   
   
   
   $rs_patient_detail = getAllDataFromTable('patient',array('patient`.`Patient_id'=>$_SESSION['Patient_id']),'',
                                              'Patient_name,patient_DOB,Phone_NO,patient_BloodGroup,email');

      $patient_details = $rs_patient_detail[0];
      var_dump($patient_details);
      
      $rs_insurance = getAllRecordFromTableWithJoin
        ('patient_insurance_acceptance',array('insurance'=>'patient_insurance_acceptance.Insurance_id=insurance.Insurance_id')
        ,array('patient_insurance_acceptance.Patient_id'=>$_SESSION['Patient_id']),
        'patient_insurance_acceptance.*,insurance.Company_name');
      foreach($rs_insurance as $val)
      { 
          $getinsu[] = $val['Company_name'];
          
          $insuranceLi = implode(",", $getinsu);
          //($getinsu);
      
  
      }
      
      //$relative_insurance = getAllRecordFromTableWithJoin
        //('appointment',array('insurance'=>'appointment.relative_insurance=insurance.Insurance_id')
       // ,array('appointment.relative_insurance'=>$arrinsurance),
       // 'appointment.*,insurance.Company_name');
      $relative_insurance = getAllRecordFromTableWithJoin
        ('appointment',array('insurance'=>'appointment.relative_insurance=insurance.Insurance_id')
        ,array('appointment.relative_insurance'=>$arrinsurance),
        'appointment.*,insurance.Company_name');
      foreach($relative_insurance  as $val)
      { 
          $getrinsu[] = $val['Company_name'];
          
          $insurancerLi = implode(",", $getrinsu);
          //($getinsu);
      
  
      }
      
      
      
        
        
         $rs_doctor_detail = getAllDataFromTable('doctors',array('doctors`.`Doctors_id'=>$Doctors_name),'','email');
          $get_doctor_detail = $rs_doctor_detail[0];
		  
   $msg = '<div><div style="font-size:20px;background-color:#1E589B;padding:5px;text-align:center;color:#ffffff;">Welcome To HealthCare</div></p>
           <br>
		   <p style="font-size:18px;text-align:center;"><strong>'.$patient_details['Patient_name'].'</strong> request you for appointment on <strong>'.date("F j, Y, g:i a", strtotime($datetime)).'</strong></p><br><br>
		   
		   <p style="background-color:#1E589B;padding:5px;text-align:center;color:#ffffff;">Appointment Detail</p><br>
		   <table width="100%" border="1" cellspacing="0" cellpadding="10">
			  <tr>
				<th scope="col"><strong>Name</strong></th>
				<th scope="col">'.$patient_details['Patient_name'].'</th>
			  </tr>
			  <tr>
				<th scope="col"><strong>Email</strong></th>
				<td>'.$patient_details['email'].'</td>
			  </tr>
			  <tr>
				<th scope="col"><strong>Contact No</strong></th>
				<td>'.$patient_details['Phone_NO'].'</td>
			  </tr>
			  <tr>
				<th scope="col"><strong>Insurance Accepted</strong></th>
				<td>'.$insuranceLi.'</td>
			  </tr>
			   <tr>
				<th scope="col"><strong>Relative Name</strong></th>
				<td>'.$Relative.'</td>
			  </tr>
			  <tr>
				<th scope="col"><strong>Relative Email</strong></th>
				<td>'.$Relative_email.'</td>
			  </tr>
			   <tr>
				<th scope="col"><strong>Relative Insurance Accepted</strong></th>
				<td>'.$insurancerLi.'</td>
			  </tr>
			  <tr>
				<th scope="col"><strong>Requested Appointment Date</strong></th>
				<td>'.date("F j, Y, g:i a", strtotime($datetime)).'</td>
			  </tr>
			</table>
			<br><br><p>Thank You<br>'.$patient_details["Patient_name"].'</p></div>';
			
			
   /*$msg2 = '<div style="font-size:20px;text-align:center;">Welcome To HealthCare</div></p>
           <br><br><br><p><b>Email</b>='.$patient_details['email'].'</p>
           <br><p><b>send date</b>='.$active_date.'</p>
           <br><p><b>name</b>='.$patient_details['Patient_name'].'</p>
           <br><p><b>contact</b>='.$patient_details['Phone_NO'].'</p>
           <br><p><b>Insurance</b>='.$insuranceLi.'</p></p>
            <br><p><b>relative_email</b>='.$Relative_email.'</p></p>
           <br><p><b>relative name</b>='.$Relative.'</p>
               <br><p><b>relative insurance</b>='.$insurancerLi.'</p>
           <br><p><b>Requested Appointment</b>='.date("F j, Y, g:i a", strtotime("$datetime")).'</p>
           <br><p>Thank You<br>Healthcare Team</p>';*/
  // $file= reports();
   
   
 
   //echo $file;
   //
   
   
              mailingNew($get_doctor_detail['email'],$msg);
                 //send_email($email,$msg2,$file);
              header("location:patient_profile.php");
}
function reports() 
{
if($_FILES['image']['name'] !='')
     {
      
        
        $filename=$_FILES["image"]["name"];
        $source = $_FILES["image"];
        $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
        $image = '_report'.substr(number_format(time() * rand(),0,'',''),0,10).$ext;      
        
        
         move_uploaded_file($source["tmp_name"],"../upload/patient_report/".$image);
                  
        
       }
}
 function patient_report()
 { 
      
      for($i=0;$i<count($_FILES['reportm']['name']) ; $i++)
      {
          extract($_POST);
     
        $status = ($_SESSION['Doctors_id']!='')?'2':'1';
        $filename=$_FILES["reportm"]["name"][$i];
        $source = $_FILES["reportm"];
        $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
        $image = '_report'.substr(number_format(time() * rand(),0,'',''),0,10).$ext;      
        
         move_uploaded_file($source["tmp_name"][$i],"../upload/patient_report/".$image);
       $Post_data = array(
       'Patient_id'=> $_REQUEST['pid'],
       'report_type_id'=>$report_id,
       'report_information'=>$image, 
       'doctors_id'=>$_REQUEST['doctors_id'],
        'status'=>$status      
        );        
          $rs_patient_report_detail= insert_table('patient_report', $Post_data);
          //var_dump($rs_patient_report_detail);
          //die();
      }
 }
 function patient_report_list()
 { 
      for($i=0;$i<count($_FILES['reportm']['name']) ; $i++)
      {
          extract($_POST);
     
        $status = ($_SESSION['Doctors_id']!='')?'2':'1';
        $filename=$_FILES["reportm"]["name"][$i];
        $source = $_FILES["reportm"];
        $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
        $image = '_report'.substr(number_format(time() * rand(),0,'',''),0,10).$ext;      
        
         move_uploaded_file($source["tmp_name"][$i],"../upload/patient_report/".$image);
       $Post_data = array(
       'Patient_id'=> $patient_id,
       'report_type_id'=>$report_id,
       'report_information'=>$image, 
       
        'status'=>$status      
        );        
          $rs_patient_report_detail= insert_table('patient_report', $Post_data);
          
      }
 }
 function prescription()
 { 
     $active_date = date('Y-m-d H:i:s') ;
     extract($_REQUEST);
     echo'<pre>';
     print_r($_REQUEST);
     $fullname = implode($fullname,',');
    
     
     $timing = implode($timing,',');
     $time = implode($time,',');
     //var_dump($_POST); die;
     $Post_data = array(
       'Patient_id'=> $pid,
       'Doctors_id'=>$_SESSION['Doctors_id'],
       'prescription_dts'=>$active_date,
       'prescription_Info'=>  mysql_real_escape_string($content),
       'medicine'=>$fullname,
       'medicine_schedule'=>$timing,'medicine_time'=>$time
        );
    $rs_patient_prescription_detail= insert_table('prescription', $Post_data);
   
      $rs_patient_detail = getAllDataFromTable('patient',array('Patient_id'=>$pid),'','*');

      $patient_details1 = $rs_patient_detail[0];
      $rs_doctor_detail = getAllDataFromTable('doctors',array('Doctors_id'=>$_SESSION['Doctors_id']),'','*');

      $doctor_details1 = $rs_doctor_detail[0];
     $fullname = explode(',', $fullname);
     
      $timing = explode($timing,',');
      $time = explode($time,',');
  $msg2=   '<div><div style="font-size:20px;background-color:#1E589B;padding:5px;text-align:center;color:#ffffff;">Welcome To HealthCare</div></p>
           <br>
		   <p style="font-size:18px;text-align:center;"><strong>'.ucfirst($patient_details1['Patient_name']).'</strong> YOUR PRESCRIPTION IS HERE FROM DR. <strong>'.$doctor_details1['Doctors_name'].'</strong></p><br><br>
		   
		   <p style="background-color:#1E589B;padding:5px;text-align:center;color:#ffffff;">Prescription Detail</p><br>
		   <table width="100%" border="1" cellspacing="0" cellpadding="10">
			  <tr>
				<th scope="col"><strong>Name</strong></th>
				<td>'.ucfirst($patient_details1['Patient_name']).'</td>
			  </tr>
			  <tr>
				<th scope="col"><strong>Email</strong></th>
				<td>'.$patient_details1['email'].'</td>
			  </tr>
			  <tr>
				<th scope="col"><strong>send date</strong></th>
				<td>'.date("F j, Y, g:i a", strtotime($datetime)).'</td>
			  </tr>
			  <tr>
				<th scope="col"><strong>Note</strong></th>
				<td>'.$content.'</td>
			  </tr>
			   
			   
			</table>
                        <table>
                        <thead>
                          <tr>
                           <th scope="col"><strong>Medicine</th>
                            <th scope="col"><strong>Time</th>
                            <th scope="col"><strong>Schedule </th>
                           <th> &nbsp; </th>
                                </tr>
                                </thead>
                                <tbody><td>';
  //echo '<pre>';print_r($fullname);die;
                                foreach($fullname as $key=>$val){
                                $msg2.=$val;
                               }
                               
                                   // $msg2='</td><td >'.$timing.$time.'</td>';
                                $msg2.='</td></tbody>
                        <br><p>Thank You<br>Healthcare Team</p></div>';
			
			
   
   
   $mag3='<div style="font-size:20px;text-align:center;">Welcome To HealthCare</div></p>
           <br><br><br><p><b>Email</b>='.$patient_details1['Phone_NO'].$patient_details1['carrier'].'</p>
           <br><p><b>your precription has been sent on your email </p>
           
           <br><p>Thank You<br>Healthcare Team</p>';
echo '<pre>';
  echo $msg2; die;
   //echo$msg3; die;
   mailingNew($patient_details1['email'],$msg2);
   //mailingNew($patient_details1['Phone_NO'].$patient_details1['carrier'],$msg3);
   //mailingNew('5597097238@tmomail.net',$msg3);
   //send_text($patient_details1['Phone_NO'].$patient_details1['carrier'],$msg3);
   
  // echo$msg3;   // text message.
   //echo $file;
   //
   //die();
   
 }

 function discuss_patient_report()
 { 
      
      for($i=0;$i<count($_FILES['reportm']['name']) ; $i++)
      {
          extract($_POST);
          $target_path = $_SERVER['DOCUMENT_ROOT'] . "/show_patient_report.php/" . basename($_FILES['uploadedFile']['name']);
     
        $status = ($_SESSION['Doctors_id']!='')?'2':'1';
        $filename=$_FILES["reportm"]["name"][$i];
        $target = "/show_patient_report.php/";
       $target = $target . basename( $_FILES['reportm']['name']); 
        $pic=($_FILES['reportm']['name']); 
        
        $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
        $image = '_report'.substr(number_format(time() * rand(),0,'',''),0,10).$ext;      
        
         move_uploaded_file($source["tmp_name"][$i],"../upload/patient_report/".$image);
       $Post_data = array(
       'Patient_id'=> $_REQUEST['pid'],
       'report_type_id'=>$report_id,
       'report_information'=>$image, 
       'doctors_id'=>$_REQUEST['doctors_id'],
        'status'=>$status      
        );        
          $rs_patient_report_detail= insert_table('patient_report', $Post_data);
          
      }
 }
 
 
 $rs_get_appointed_patient_name = getAllRecordFromTableWithJoin
        ('appointment',array('patient'=>'appointment.Patient_id=patient.Patient_id')
        ,array('appointment.Doctors_id'=>$_SESSION['Doctors_id']),
        'DISTINCT(`appointment`.`Patient_id`),patient.Patient_name');
 //$rs_get_appointed_patient_name = $get_appointed_patient_name;
 
      //foreach($get_appointed_patient_name  as $val)
     // { 
         // $getrinsu[] = $val['Company_name'];
          
         // $insurancerLi = implode(",", $getrinsu);
          //($getinsu);
      
  
     // }
 $activate= generateRandomString(6);
 
 /*
 function send_activation()
 {
     $msg2 = '<div style="font-size:20px;text-align:center;">Welcome To HealthCare</div></p>
           <br><br><br><p><b>Email</b>='.$email.'</p>
           
           <br><p><b>schedule</b>='.$activate.'</p>
           <br><p>Thank You<br>Healthcare Team</p>';
     send_email($email,$msg2);
   
   echo '<pre>';
   echo $msg2;
   
   die();
 
 }*/
/* sending mail function*/ 
 
 /*---------------------------------patient history------------------------------*/
  function patient_history()
 { 
     
     
     $Post_data = array(
       //'patient_id'=> $_Session['Patient_id'],
       'medicine'=>$medcine_name,
        //'disease_id'=>$disease_id,
         'medcine_color'=>$color,
          'alleregy'=>$allergy,
        );
    $rs_patient_history_detail= insert_table('patient_history', $Post_data);
    $rs_patient_history_detail1 =$rs_patient_history_detail[0]; 
   echo $rs_patient_history_detail1;
  //var_dump($_POST); die;
   //die;
      
   
 }
/****************************************************************************************/
 /**********************************Discussion*******************************************/
 

function discussion(){ 
    extract($_POST);
    $sender = ($_SESSION['Doctors_id']!='')?'doctor':'patient';
    $author = ($_SESSION['Doctors_id']!='')?$_SESSION['Doctors_id']:$_SESSION['Patient_id'];
    $patient_id = implode($patient_name,',');
    $doctors_id = implode($doctors_name,',');
    $active_date = date('Y-m-d H:i:s') ;

   $Post_data = array(
       'topic_type'=>$topic,
       'subject'=>$subject,
       'disease_id'=>$disease_id,
       'patient_id'=>$patient_id,
       'doctor_id'=>$doctors_id,
      'insurance_id'=>$Insurance_id,
       'department_id'=>$department_id,
      'date'=>$active_date,
       'author' =>$author,
       'sender'=>$sender,
        );

   $rs_discussion= insert_table('discussion', $Post_data);
    $lastID = mysql_insert_id();

       $Post_data1 = array(
       'discussion_id'=>$lastID,
       'reply_by'=>$author,
       'message'=>$content,
       'message_date'=>$active_date,
        );

    $rs_discussion= insert_table('discussion_message', $Post_data1);
 }
 

 
 
 
 
 
 
 /*****************************************************************************************/
 
function mailingNew($email,$msg){
    
    
    
	
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'samiksha.solanki11@gmail.com';
	$mail->Password = 'Samiksha1191';
        //$mail->Username = 'healthcare818@gmail.com';
	//$mail->Password = 'health818';
	$mail->SMTPSecure = 'tls';
        $mail->Port = 587 ; 
        //$mail->Port = 465 ;
	$mail->From = 'samiksha.solanki11@gmail.com';
        //$mail->From = 'healthcare818@gmail.com';
        //$mail->From = 'samiksha11@mail.fresnostate.edu';
       // $mail->From =$email ;
	$mail->FromName = 'Samiksha Solanki';
        $mail->FromName = 'Health Care';
	$mail->addAddress($email,'demo');
	$mail->addReplyTo('samiksha.solanki11@gmail.com', 'Samiksha');
       // $mail->addReplyTo('healthcare818@gmail.com', 'Health');
	$mail->WordWrap = 50;
	$mail->isHTML(true);
	$mail->Subject = 'Testing Mail';
        //$mail->Subject = 'do-not-reply';
	$mail->Body    = $msg;
	if(!$mail->send()) {
	   echo 'Message could not be sent.';
	   echo 'Mailer Error: ' . $mail->ErrorInfo;
	   exit;
	}
	echo 'Message has been sent';
	
}
?>
