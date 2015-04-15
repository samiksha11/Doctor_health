<?php

include("config.php");
include("ckeditor/ckeditor.php");

error_reporting(0);
?>
<?php
if(isset($_POST['send']) && $_POST['send'] == 'send'){  
    //extract($_POST);
    //var_dump($_POST);
    //die();
       discussion_reply();
} ?>
<?php

     include_once ('Includes/header.php');
     ?>
