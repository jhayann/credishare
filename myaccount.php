<?php
include_once('core/function.php');
if(isLogin() == true) {
    $message = "WELCOME BACK";
    
    if($_SESSION['approved']==0)
    {
        $class="";
        $notifier = "YOUR ACCOUNT IS NOT YET ACTIVATED AND WAITING FOR  APPROVAL";
    } else {
        $class = 'd-none';
        $notifier="";
    }
} else {
    header('location: index.php');
}

if(isset($_GET['logout'])) 
{
    include_once('core/logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
     <link rel="icon" href="assets/images/pacman.ico">
      <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
    <title><?php echo $_SESSION['username']?></title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <style type="text/css">
        body {
            padding-top: 5rem;
            margin:0;
            font-family: helvitica;
        }
        a
        {
            text-decoration: none;
            color: white;
        }
        a:hover
        {
            color: white;
            text-decoration: none;
            display:block;
        }
        
        @media(min-width:750px){
          .ml-auto
            {
                margin-right: 50px !important;
            }
        }
        
    </style>
</head>    
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Credishare - <?php echo $_SESSION['username'] ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="#">Notifications</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin/dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Update Profile</a>
              <a class="dropdown-item" href="#">Settings</a>
              <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?logout=ref"  class="dropdown-item" href="#">Logout</a>
            </div>
          </li>
        </ul>
        
      </div>
    </nav>
<div class="container">
<div id="notifier" class="alert alert-danger <?php echo $class?>"><?php echo $notifier ?></div>
    <div class="jumbotron jumbotron-fluid">
        <div class="container" id="main_container">
           <div id="main_">
               <img style="margin-left:40%;" src="assets/images/Pacman-1s-96px.svg">
           </div>
            <p class="lead">This is your current credits. You  can see your transaction below.</p>
        </div>
    </div>
    <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-chart-area"></i>
              Topup history</div>
            <div class="card-body">
              <div id="chartnoti" class="alert alert-info">Plese wait. We're working on your topup history chart</div>
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
    <div id="history">
        <div class="alert alert-info">Plese wait. We're working on your records</div>
    </div>
</div>
<!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script>
            function getmyHistory(e){var t=e;$.ajax({type:"post",url:"core/mycredits.php",data:{action:"gethistory",user:t},success:function(e){$("#history").html(e)},error:function(){$("#notifier").removeClass("d-none")}})}$(document).ready(function(){var e="<?php echo $_SESSION['username']?>";$.ajax({type:"post",url:"core/mycredits.php",data:{action:"getcredits",user:e},success:function(t){$("#main_").html(t),getmyHistory(e)},error:function(){$("#notifier").removeClass("d-none")}}),Chart.defaults.global.defaultFontFamily='-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif',Chart.defaults.global.defaultFontColor="#292b2c",$.ajax({url:"core/chart.php",method:"POST",data:{action:"mychart",username:"<?php echo  $_SESSION['username']?>"},success:function(e){for(var t=[],o=[],a=$.parseJSON(e),r=0;r<a.length;r++)console.log(a[r].username),t.push(a[r].date),o.push(a[r].amount);var s=document.getElementById("myAreaChart");new Chart(s,{type:"line",data:{labels:t,datasets:[{label:"Amount",lineTension:.3,backgroundColor:"rgba(2,117,216,0.2)",borderColor:"rgba(2,117,216,1)",pointRadius:5,pointBackgroundColor:"rgba(2,117,216,1)",pointBorderColor:"rgba(255,255,255,0.8)",pointHoverRadius:5,pointHoverBackgroundColor:"rgba(2,117,216,1)",pointHitRadius:50,pointBorderWidth:2,data:o}]},options:{scales:{xAxes:[{time:{unit:"date"},gridLines:{display:!1},ticks:{maxTicksLimit:10}}],yAxes:[{ticks:{min:0,max:100,maxTicksLimit:10},gridLines:{color:"rgba(0, 0, 0, .125)"}}]},legend:{display:!1}}});$("#chartnoti").fadeOut("slow")}})});
    </script>
</body>
</html>