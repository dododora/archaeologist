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
               <p> </p><p> </p><?PHP 
						echo substr( $_POST['testname'] ,2 ,3 );
						$sub = substr( $_POST['testname'] ,0 , 1 );
						if ($sub == 1) echo "國文";
						else if ($sub == 2) echo "英文";
						else if ($sub == 3) echo "數學";
						else if ($sub == 4) echo "自然";
						else if ($sub == 5) echo "社會";
													
						
						?><p> </p><p> </p><p> </p>
				<?PHP 
					session_start();
					$name = $_POST['testname'];
					$_SESSION['testname'] = $_POST['testname'];
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
		<nav class="navbar navbar-light fixed-bottom" style="">
            <div class="container">
                <?php
						require("conn_mysql.php");
						$sql_query="SELECT * FROM question WHERE testname IN ('$name') ORDER BY piclink";
						$result=mysqli_query($db_link, $sql_query);
						
						while ($row=mysqli_fetch_assoc($result)){
							$link1 = "get_num('/archaeologist/".$row["testname"]."/".$row["piclink"].".jpg')";
							 echo "<button onclick=".$link1." class='btn btn-outline-light btn-sm'>" .$row["piclink"]. "</button>";
						}
					?>
            </div>
        </nav>
        
		<section class="showcase">
            <div class="container-fluid p-0">
                <div class="row g-0" style="padding: 2px;">
                    <div class="col-lg-10" style=" overflow: auto; height:560px; background-color: white;">
					<?php
						//題本封面
						echo "<img class='pic' id ='img' src='/archaeologist/".$name."/00.jpg'>";			
					?>
					</div>
					
                    <div class="col-lg-2 ">
					<p class="fs-1 fw-bold "  style="color:$blue-900;"> 作答區 </p>
					<div >
                    <?php
					echo "<div class='boxx rounded align-middle ' >";
					require("conn_mysql.php");
						$sql_query="SELECT * FROM question WHERE testname IN ('$name') ORDER BY piclink";
						$result=mysqli_query($db_link, $sql_query);
						echo "<form method='POST' action='1handle.php'>";
						while ($row=mysqli_fetch_assoc($result)){			 			 
							 echo $row["piclink"];
							 //單選
							 if ($row["type"] == 1){				
								echo "<p>
								<input type='hidden' name=".$row["piclink"]." value='null' />
								 <input type='radio' name=".$row["piclink"]." value ='1'> 1
								 <input type='radio' name=".$row["piclink"]." value ='2'> 2
								 <input type='radio' name=".$row["piclink"]." value ='3'> 3
								 <input type='radio' name=".$row["piclink"]." value ='4'> 4
								 <input type='radio' name=".$row["piclink"]." value ='5'> 5								 
								 </p>";
							 }
							 //多選 				
							 if ($row["type"] == 2){				
								$link = $row['piclink']."[]";		
								echo "
								<p><input type='hidden' name=".$row["piclink"]." value='null' />
								 <input type='checkbox' name=$link value ='1'> 1
								 <input type='checkbox' name=$link value ='2'> 2
								 <input type='checkbox' name=$link value ='3'> 3
								 <input type='checkbox' name=$link value ='4'> 4
								 <input type='checkbox' name=$link value ='5'> 5
								 </p>";
							 }			 
							 //填充
							 else if ($row["type"] == 3){
								echo "<input type='hidden' name=".$row["piclink"]." value='null' />
									  <input type='text' name=".$row['piclink']." value='' size='10'>
										<br>";
							 }
							 else if ($row["type"] == 4){				
								echo "<p>
								<input type='hidden' name=".$row["piclink"]." value='null' />
								 <input type='radio' name=".$row["piclink"]." value ='A'> A
								 <input type='radio' name=".$row["piclink"]." value ='B'> B
								 <input type='radio' name=".$row["piclink"]." value ='C'> C
								 <input type='radio' name=".$row["piclink"]." value ='D'> D
								 <input type='radio' name=".$row["piclink"]." value ='E'> E								 
								 </p>";
							 }
							 else if ($row["type"] == 5){				
								$link = $row['piclink']."[]";		
								echo "
								<p><input type='hidden' name=".$row["piclink"]." value='null' />
								 <input type='checkbox' name=$link value ='A'> A
								 <input type='checkbox' name=$link value ='B'> B
								 <input type='checkbox' name=$link value ='C'> C
								 <input type='checkbox' name=$link value ='D'> D
								 <input type='checkbox' name=$link value ='E'> E
								 </p>";
							 }			 
						}echo "<input type='submit' class='btn btn-outline-danger' value='提交' /> </form>";
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


