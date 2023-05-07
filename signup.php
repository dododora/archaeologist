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
        <!-- Navigation-->
        <nav class="navbar navbar-light bg-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="index">Archaeologist.com</a>
              
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <!-- Page heading-->
                            <h1 class="mb-5" > 註冊帳號 </h1>
                            
                            <?php 
								header("Content-Type: text/html; charset=utf8");
								if(!isset($_POST['submit'])){
								exit("錯誤執行");
								}//判斷是否有submit操作
								$name=$_POST['name'];//post獲取表單裡的name

								$password=$_POST['password'];//post獲取表單裡的password
								include('connect.php');//連結資料庫
								$q="insert into user(username,password) values ('$name','$password')";//向資料庫插入表單傳來的值的sql
								$result=mysqli_query($con,$q);//執行sql

								if (!$result){
								die('Error: ' . mysqli_error($con));//如果sql執行失敗輸出錯誤
								}else{
								echo "<h2 class ='text-warning mb-5'> 註冊成功</h2>";//成功輸出註冊成功
								header("refresh:3;url=index.html");
								}
								mysqli_close($con);//關閉資料庫

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


