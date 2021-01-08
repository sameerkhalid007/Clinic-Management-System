<?php 
session_start();
if((isset($_SESSION["email"]) && isset($_SESSION["password"]))){
	$myemail = $_SESSION['email'];
}else {
	header("location:login.php");
}
?>