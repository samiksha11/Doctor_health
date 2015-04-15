<?php
date_default_timezone_set("UTC");
error_reporting(0);
session_start();
ini_set("session.gc_maxlifetime",10);
//session_regenerate_id(true);
//$old_sessionid = session_id();

session_regenerate_id(true);

$new_sessionid = session_id();
/*$timeStamp=time();
if($noRedirect){
}else{
	if(!(isset($_SESSION['email']) && !empty($_SESSION['email']))){ 
		header('Location:index.php');
	}else{
		$diff = abs($timeStamp - $_SESSION['timestamp']);
		$my_t=getdate($diff);
		if($my_t['seconds']>60){
			session_destroy();
			header('Location:index.php');
		}
	}
}

 $_SESSION['timestamp']=$timeStamp;
//echo "Old Session: $old_sessionid<br />";
//echo "New Session: $new_sessionid<br />";*/

//print_r($_SESSION);
if ($_SERVER['HTTP_HOST']=='localhost')
{
	$host = "localhost";
	$db = "health_care_db";
	$user = "root";
	$pass = "";
	$siteUrl = "http://localhost/Health_care_system/Doctor_health/";
	$sitefolder = "";
	
}
else
{
	$host = "health.local";
	$db = "health_care_db";
	$user = "root";
	$pass = "";
	$siteUrl = "http://health.local/";
	$sitefolder = "";
}


//include_once("Includes/common.php"); 
//include_once("Includes/sql_lib.php"); 
//require_once("PHPMailer/PHPMailerAutoload.php");


include_once("Includes/common.php"); 
include_once("Includes/sql_lib.php"); 
require_once("PHPMailer/PHPMailerAutoload.php");

?>