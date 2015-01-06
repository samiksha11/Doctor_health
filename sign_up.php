<?php 
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'health_care_db'); 
define('DB_USER','root'); 
define('DB_PASSWORD',''); 
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) 
        or die("Failed to connect to MySQL: " . mysql_error()); 
$db=mysql_select_db(DB_NAME,$con) 
        or 
        die("Failed to connect to MySQL: " . mysql_error());
function NewUser() 
{ $fullname = $_POST['name']; 
$email = $_POST['email'];
$password = $_POST['pass'];
$insurance_name = $_POST['insurance_name'];
$department_name = $_POST['department_id'];
$query = "INSERT INTO health_care_db.doctors(Doctors_name,Department_id,email,password) 
   VALUES ('$fullname','$department_name','$email','$password')";
//echo $query;
//die();
$data = mysql_query ($query)or die(mysql_error());
$last_id = mysql_insert_id();
if($data) { 
    for($i=0; $i<count($insurance_name);$i++)
    {
    $query1 = "INSERT INTO health_care_db.insurance_acceptance(Doctors_id,Insurance_id) 
   VALUES ('$last_id','$insurance_name')";
    mysql_query($query1);
    //echo $query1;
    
    }
    //die();
    
    echo "YOUR REGISTRATION IS COMPLETED..."; 

} 

} 
function SignUp() 
{ if(!empty($_POST['user'])) ;
}
?>
