<?php
session_start();
if (!$_SESSION['employeeID']) {
	header('Location:../LoginPage/login.php');
	exit();
}
?>