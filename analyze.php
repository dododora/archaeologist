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
		<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          <?php session_start();
		  for ($i = 1; $i<=4;$i++){
					require("conn_mysql.php");
					$sql="SELECT * FROM answer where
					testname = '".$_SESSION['testname']."' and username = '".$_SESSION['username']."' 
					and reason = ".$i."";
					$result=mysqli_query($db_link,$sql);
					$num=mysqli_num_rows($result); //計數
					if ($i ==1) $rea = "計算錯誤";
					else if ($i ==2) $rea = "時間不夠";
					else if ($i ==3) $rea = "觀念不熟";
					else if ($i ==4) $rea = "狀態不佳";
                    echo "['".$rea."',".$num."],";
                }
				?>
        ]);

        // Set chart options
        var options = {'title':'',
                       'width':600,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-light bg-light sticky-top">
            <div class="container">
                  <a class="navbar-brand" href="welcome">Archaeologist.com</a>
               <p> </p><p> </p><?PHP 
					
		echo substr( $_SESSION['testname'] ,2 ,3 );
		$sub = substr( $_SESSION['testname'] ,0 , 1 );
		if ($sub == 1) echo "國文";
		else if ($sub == 2) echo "英文";
		else if ($sub == 3) echo "數學";
		else if ($sub == 4) echo "自然";
		else if ($sub == 5) echo "社會";
						
		
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
        
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <!-- Page heading-->
							<h1 class="mb-5"> </h1> <h1 class="mb-5"> </h1>
							<h1> </h1>
                            <h1 class="mb-5">錯誤原因比例</h1>
							
                            <!--Div that will hold the pie chart-->
							<div id="chart_div"></div>
							<h1 class="mb-5"> </h1>
                            <a class="btn btn-outline-dark" href="welcome">回首頁</a>
                        </div>
                    </div>
                </div>
            </div>
        
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
