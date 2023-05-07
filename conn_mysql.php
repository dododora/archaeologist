<?php
	$db_link=mysqli_connect("localhost", "root", "root", "archeologist");
	if (!$db_link){
		die("資料庫連線失敗<br>");
	}
	else{
		mysqli_query($db_link, "SET NAMES 'utf8'");
	}
	
?>