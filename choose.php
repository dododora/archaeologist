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
    <body>
	
				
        <!-- Navigation--->
        <nav class="navbar navbar-light bg-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="welcome">Archaeologist.com</a>
				<p> </p><p> </p><p> </p><p> </p><p> </p><p> </p>
				<?PHP 
					session_start();

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
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <!-- Page heading-->
							
							
							<h1 class="mb-5"> 選擇考卷 <h1>
							<?php				
								
								
								//考卷list
								require("conn_mysql.php");
								$sql_query="SELECT * FROM testname ORDER BY subject, year";
								$result=mysqli_query($db_link, $sql_query);
								
  
								echo "<form method='POST' action='exam1.php'>
										<select name='testname' class='form-select form-select-sm' aria-label='.form-select-sm example'>";
								while ($row=mysqli_fetch_assoc($result)){
									$testname = $row["subject"]."-".$row["year"];
									if ($row["subject"] == 1) $sub = "國文";
									else if ($row["subject"] == 2) $sub = "英文";
									else if ($row["subject"] == 3) $sub = "數學";
									else if ($row["subject"] == 4) $sub = "自然";
									else if ($row["subject"] == 5) $sub = "社會";
									$name = $sub."-".$row["year"];
									echo "<option value='$testname'>$name</option>";
								}
								echo "</select>
										<input style = 'padding: 0.25rem 1rem;' class='btn btn-outline-warning ' type='submit' value='開始' />
										</form> ";
								
							?>

                            
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>

