
<?php
    
    //從資料庫取得圖片
    require("conn_mysql.php");
	$sql_query="SELECT * FROM question";
	$result=mysqli_query($db_link, $sql_query);
	
	echo "<table border=1 width=500 >";
	echo " <tr>
		<td> testnum </td>
		<td> num </td>
		<td> pic </td>
		<td> ans </td>
		</tr>";
	//echo "<img src=s >";

	while ($row=mysqli_fetch_assoc($result)){
		$link = "<img src='/archaeologist/".$row["testname"]."/".$row["piclink"].".jpg'>";
		 echo " <tr>
			<td> ".$row["testname"]." </td>
			<td> ".$row["piclink"]." </td>
			<td> ".$link." </td>
			<td> ".$row["ans"]." </td>
			</tr>";
	}


?>


