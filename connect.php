<?php
$server="localhost";//主機
$db_username="root";//你的資料庫使用者名稱
$db_password="root";//你的資料庫密碼
$con = mysqli_connect($server,$db_username,$db_password,"users");//連結資料庫
//$sql_query="SELECT * FROM user"
//$result=mysqli_query($con,$sql_query)
if(!$con){
  die("can't connect".mysqli_error());//如果連結失敗輸出錯誤
}


?>