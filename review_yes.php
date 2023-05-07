<?php 
session_start();

	if(!isset($_SESSION['username']) || ($_SESSION['username']=="")){
		echo "尚未登入";
		//echo $_SESSION['username'];
		header('refresh:3; url=login.html');
	}
	else {
		echo $_SESSION['username'];
	}
	
	require("conn_mysql.php");
	$sql = "UPDATE answer SET correct = 0 WHERE username = '".$_SESSION['username']."' 
			and testname = '".$_SESSION['testname']."' and piclink = '".$_POST['num']."' ";
	//echo $sql;
	$result = mysqli_query($db_link,$sql);//執行sql
	header ('Location: review.php');

?>