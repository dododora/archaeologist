<?php
	session_start();
	$_SESSION['testname'] = $_POST['Rtestname'];
	header ('Location: review.php');
?>