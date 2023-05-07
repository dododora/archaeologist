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
		<script>
		function get_num(num){
			document.getElementById('img').src=num;
		}
		</script>
		<style>
		body {
			
			background: url(../assets/img/1.jpg) no-repeat center center;
			background-size: cover;
			background-color: #FFF0F5;
		}
		.pic {
			width:100%;
			display: block;
			padding:2px
		}
		.boxx {			
			height:475px;
			overflow: auto;
			padding: 2px;
		}
		</style>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-light bg-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="welcome">Archaeologist.com</a>
               <p> </p><p> </p><?PHP session_start();
					
		echo substr( $_SESSION['testname'] ,2 ,3 );
		$sub = substr( $_SESSION['testname'] ,0 , 1 );
		if ($sub == 1) echo "國文";
		else if ($sub == 2) echo "英文";
		else if ($sub == 3) echo "數學";
		else if ($sub == 4) echo "自然";
		else if ($sub == 5) echo "社會";
		echo " - 複習"	;				
		
		?> <p> </p><p> </p><p> </p>
				<?PHP 
					
					if(!isset($_SESSION['username']) || ($_SESSION['username']=="")){
						echo "尚未登入";
						//echo $_SESSION['username'];
						header('refresh:3; url=login.html');
					}
					else {
						echo " Hello, ".$_SESSION['username'];
					}
				?>
                <a class="btn btn-primary" href="logout.php">logout</a>
            </div>
        </nav>
        <!-- Masthead-->
		
        
		<section class="showcase">
            <div class="container-fluid p-0">
					<?php
					
					require("conn_mysql.php");
					$sql_query="SELECT * FROM answer  where username = '".$_SESSION['username']."'
							and testname = '".$_SESSION['testname']."' and correct = '1' ORDER BY piclink";
					$result = mysqli_query($db_link,$sql_query);
					$nums=mysqli_num_rows($result);
					
					while ($row=mysqli_fetch_assoc($result)){
							echo "<div class='row g-0' style='padding: 2px;'>";
								//---題目---//
								echo "<div class='col-lg-10' style=' overflow: auto; height:250px; background-color:white;'>";
								$link = "/archaeologist/".$_SESSION['testname']."/".$row["piclink"].".jpg";
								echo "<img class='pic' id ='img' src='".$link."'>";	
								echo"</div>";
								//---題目---//								
								//---reason---//
								echo"<div class='col-lg-2 '>";						
									echo $row["piclink"]."<br>";
									echo "錯誤答案".$row["ans"]."<br>";
									$sql="SELECT * FROM question 
											where testname = '".$_SESSION['testname']."' and piclink = '".$row["piclink"]."'";
									$result1 = mysqli_query($db_link,$sql);
									$ro=mysqli_fetch_assoc($result1);									
									echo "正確答案".$ro['ans']."<br>";									
									echo "錯誤原因：";
									if ($row["reason"] == 1) echo "計算錯誤";			else if ($row["reason"] == 2) echo "沒時間";
									else if ($row["reason"] == 3) echo "觀念不熟";		else if ($row["reason"] == 4) echo "狀態不佳";
									echo "<br>";									
									echo "筆記：<br>";	echo $row["note"];									
									//我會了按鈕
									echo "<form method='POST' action='review_yes.php'>
											<button class='btn btn-outline-dark ' name='num' type='submit' value='".$row['piclink']."'/>我會了!!</button>
											</form>";										
								echo "</div>";
								//---reason---//
							echo "</div>";
					}
					?>
					<a class="btn btn-danger" href="review_choose.php" style="align-items:center;">看完了</a>
            </div>
        </section>
		        
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>


