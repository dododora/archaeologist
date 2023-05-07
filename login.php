<?PHP
session_start();
header("Content-Type: text/html; charset=utf8");
if(!isset($_POST["submit"])){
exit("錯誤執行");
}//檢測是否有submit操作 
include('connect.php');//連結資料庫
$name = $_POST['name'];//post獲得使用者名稱錶單值
$passowrd = $_POST['password'];//post獲得使用者密碼單值
if ($name && $passowrd){//如果使用者名稱和密碼都不為空
	$sql = "select * from user where username = '$name' and password='$passowrd'";
	//檢測資料庫是否有對應的username和password的sql
	$result = mysqli_query($con,$sql);//執行sql
	$rows=mysqli_num_rows($result);//返回一個數值
	if($rows){//0 false 1 true
		$_SESSION['username'] = $_POST['name'];
		//echo "$_SESSION['username']";
		header("refresh:0;url=welcome.html");//如果成功跳轉至welcome.html頁面
		exit;
	}else{
		echo "使用者名稱或密碼錯誤";
		echo "
		<script>
		setTimeout(function(){window.location.href='index.html';},1000);
		</script>
		";//如果錯誤使用js 1秒後跳轉到登入頁面重試;
	}
}else{//如果使用者名稱或密碼有空
	echo "表單填寫不完整";
	echo "
	<script>
	setTimeout(function(){window.location.href='index.html';},1000);
	</script>";
	//如果錯誤使用js 1秒後跳轉到登入頁面重試;
}
mysqli_close($con);//關閉資料庫

?>


