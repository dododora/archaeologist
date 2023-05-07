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
		echo ",檢討"	;				
		
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
		<?php
			require("conn_mysql.php");
			$sql_query="SELECT * FROM answer 
				where testname = '".$_SESSION['testname']."' and username = '".$_SESSION['username']."' 
				and correct = '1' and reason is NULL ORDER BY piclink";
			$result = mysqli_query($db_link,$sql_query);
			$nums=mysqli_num_rows($result);
			if($nums == 0) header ('Location: analyze.php');
		?>
        
		<section class="showcase">
            <div class="container-fluid p-0">
                <div class="row g-0" style="padding: 2px;">
                    <div class="col-lg-10" style=" overflow: auto; height:560px; background-color:white;">
					
					<?php
					//題本封面	
						$row=mysqli_fetch_assoc($result);
						$link = "/archaeologist/".$_SESSION['testname']."/".$row["piclink"].".jpg";
							 echo "<img class='pic' id ='img' src='".$link."'>";
							echo"</div>";
					
                    echo"<div class='col-lg-2 '>";
					echo"<div>";					
					echo "<div class='boxx rounded align-middle ' >";
					//題號
			 		echo $row["piclink"]."<br>";
					echo "錯誤答案".$row['ans']."<br>";
					//正確答案
					require("conn_mysql.php");
					$sql="SELECT * FROM question 
							where testname = '".$_SESSION['testname']."' and piclink = '".$row["piclink"]."'";
					if ($result1 = mysqli_query($db_link,$sql)){
						$ro=mysqli_fetch_assoc($result1);						
						echo "正確答案".$ro['ans']."<br>";	}	
					//reason
					echo " <form method='POST' action='reasonhandle.php'>";
					echo "<p> <br>原因： <br>
						 <input type='radio' name='reason' value ='1' required> 計算錯誤 <br>
						 <input type='radio' name='reason' value ='2'> 時間不夠 <br>
						 <input type='radio' name='reason' value ='3'> 觀念不熟 <br>
						 <input type='radio' name='reason' value ='4'> 狀態不佳 <br>
						 </p> ";
					echo "筆記<br>";	echo "<textarea name='note' rows= '5' cols='20' value='' required> </textarea>";					
					echo "<button name='num' class='btn btn-outline-danger' type='submit' value='".$row['piclink']."'/>下一題</button> </form>";				
						echo "</div>";						
					?>
					</div>
					
					</div>
					
					
					
                </div>
                
            </div>
        </section>
		
		
        
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>


