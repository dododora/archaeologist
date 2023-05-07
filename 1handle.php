<?php 
session_start();

	if(!isset($_SESSION['username']) || ($_SESSION['username']=="")){
		echo "尚未登入";
		header('refresh:3; url=login.html');
	}
?>





<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Archaeologist</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
		
    </head>
	<style>
	body {
			
			background: url(../assets/img/1.jpg) no-repeat center center;
			background-size: cover;
			background-color: #BC8F8F;
		}
	</style>
    <body>
	
				
        <!-- Navigation--->
        <nav class="navbar navbar-light bg-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="welcome">Archaeologist.com</a><p> </p>
				<?PHP 
					echo substr( $_SESSION['testname'] ,2 ,3 );
					$sub = substr( $_SESSION['testname'] ,0 , 1 );
					if ($sub == 1) echo "國文";
					else if ($sub == 2) echo "英文";
					else if ($sub == 3) echo "數學";
					else if ($sub == 4) echo "自然";
					else if ($sub == 5) echo "社會";
												
					
		?><p> </p><p> </p><p> </p>
		<?php
		echo " Hello, ".$_SESSION['username'];
		?>
                <a class="btn btn-primary" href="logout.php">logout</a>
            </div>
        </nav>
		
        <!-- Masthead-->
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="text-center text-white">
                            <!-- Page heading-->
								<h1 class="mb-5">  <h1>
							<?php	
require("conn_mysql.php");
$sql_query="SELECT * FROM question where testname = '".$_SESSION['testname']."' ORDER BY piclink";

//echo $sql_query;
$result1=mysqli_query($db_link, $sql_query);

$score = 0;
echo "<div >";
echo "<table class = 'table' >";
	echo " <tr>
		<td> 題號 </td>
		<td > 得分 </td>
		<td> 您的答案 </td>
		<td> 正確答案 </td>
		</tr>";
while ($row=mysqli_fetch_assoc($result1)){
	//echo $row["piclink"].$_POST[$row["piclink"]];
	if ($_POST[$row["piclink"]] != 'null'){
		//單選 填充
		if ($row["type"] != 2 && $row["type"] !=5){
			$link = $row["piclink"];
			//$name = "3-110";
			//對答案
			$point = 0;
			if($row["ans"]==$_POST[$link]) {
				$a=0;
				$point = $row["score"];
				$score += $row["score"];
			}
			else $a=1;
			$result = $_POST[$link];
		}
		//多選
		else if ($row["type"] == 2){		
			$result = "";
			$answer = [];
			$answer =array(1=>0,2=>0,3=>0,4=>0,5=>0);
			
			//把傳過來的值變成陣列
			foreach( $_POST[$row["piclink"]] as $i)
			{
				
				$result .= $i;
				$answer[$i] = 1;
			}
			if($row["ans"]==$result) 	$a=0;				
			else $a=1;
			//看錯幾個選項
			$false = 0;
			for ( $j=1 ; $j<=5 ; $j++ ){
				if ($row[$j] != $answer[$j]) $false++;
			}
			//得分
			$point = $row["score"]*((5-2*$false)/5);
			if ($point <0) $point=0;
			$score += $point;
		}
		else if ($row["type"] == 5){		
			$result = "";
			$answer = [];
			$answer =array(1=>0,2=>0,3=>0,4=>0,5=>0);
			
			//把傳過來的值變成陣列
			foreach( $_POST[$row["piclink"]] as $i)
			{
				if ($i=='A') $r='1';
				if ($i=='B') $r='2';
				if ($i=='C') $r='3';
				if ($i=='D') $r='4';
				if ($i=='E') $r='5';
				$result .= $i;
				
				$answer[$r] = 1;
			}
		//是否全隊
			if($row["ans"]==$result) 	$a=0;				
			else $a=1;
			//看錯幾個選向
			$false = 0;
			for ( $j=1 ; $j<=5 ; $j++ ){
				if ($row[$j] != $answer[$j]) $false++;
			}
			//得分
			$point = $row["score"]*((5-2*$false)/5);
			if ($point <0) $point=0;
			$score += $point;
		}
	}
	else { //$_POST[$row["piclink"]] != 'null'
		$result = "";
		$a = 1;
		$point = 0;
	}
	
	require("conn_mysql.php");
	$sql3 = "SELECT * FROM answer where username= '".$_SESSION['username']."'
				and  testname = '".$_SESSION['testname']."' and piclink = '".$row['piclink']."'";
	$result3 = mysqli_query($db_link,$sql3) or die ("新增失敗");
	$nums=mysqli_num_rows($result3);
	//之前有寫過
    if($nums != 0) {
		require("conn_mysql.php");
		$sql5 = "UPDATE answer SET ans = '".$result."' , correct=".$a.",  score=".$point.", reason = NULL, note=NULL
				WHERE username= '".$_SESSION['username']."' and testname = '".$_SESSION['testname']."' and piclink = '".$row['piclink']."' ";
		$result4 = mysqli_query($db_link,$sql5) or die ("新增失敗");
	}
	//還沒寫過
	else {
		require("conn_mysql.php");
		$sql = "INSERT INTO answer (username,testname, piclink,ans,correct,score) 
				VALUES ('".$_SESSION['username']."','".$_SESSION['testname']."','".$row['piclink']."','".$result."',".$a.",".$point.") ";
		$result2 = mysqli_query($db_link,$sql) or die ("新增失敗");
	}
	
	echo " <tr>
			<td> ".$row["piclink"]." </td>
			<td> ".$point." </td>
			<td> ".$result." </td>
			<td> ".$row["ans"]." </td>
			</tr>";
}
echo "</div>";
?>
							
							<?php
								require("conn_mysql.php");
								$sql2 = "INSERT INTO score (username,testname, score) 
										VALUES ('".$_SESSION['username']."','".$_SESSION['testname']."','$score') ";
								echo "<h1 class='mb-5'> 分數:".$score." </h1>";
								
								$result3 = mysqli_query($db_link,$sql2) or die ("新增失敗");//執行sql
							?>
							<a href="reason.php" style = 'padding: 0.25rem 1rem;' class='btn btn-outline-dark '>訂正</a>
							<br>
							<h1 class="mb-5"> 題目列表 </h1>
                            
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>

