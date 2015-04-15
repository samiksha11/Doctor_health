<?php 
include("config.php");
unset($_SESSION['email']);
session_destroy();
header("Location:index.php");

  