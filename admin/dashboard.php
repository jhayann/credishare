<?php
include_once('../core/function.php');
if(isLogin() == true && isAdmin($_SESSION['username']) == true) {
    $message = "WELCOME BACK";
} else {
    header('location: ../index.php');
}

if(isset($_GET['logout'])) 
{
    include_once('../core/logout.php');
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

    <title><?php echo $_SESSION['username']?> - Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/app.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <style type="text/css">
        body {
        
            margin: 0;
            font-family: helvitica;
        }
        #wrapper {
            text-decoration: none;
            color: black;
        }

        a:hover {
            color: black;
            text-decoration: none;
            display: block;
        }

        @media(min-width:750px) {
            .ml-auto {
                margin-right: 50px !important;
            }
        }
        #sidebar-container {
        min-height: 95vh !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Credishare</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a href="../myaccount.php" class="nav-link">My Account</a>
                </li>
                <li class="nav-item active">
                  
                    <a data-toggle="sidebar-show" class="nav-link" href="#">Dashboard<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?logout=ref" class="nav-link" href="#">Logout</a>
                </li>
               <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rey Jhon</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#">Update Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </li> -->
            </ul>

        </div>
    </nav>
<div class="row" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
        <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>MAIN MENU</small>
            </li>
            <!-- /END Separator -->
            <!-- Menu with submenu -->
            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-dashboard fa-fw mr-3"></span>
                    <span class="menu-collapsed">Dashboard</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="#records" id="records" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Credit Records</span>
                </a>
                <a href="#" data-toggle="modal" data-target="#addcredit" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Add Credit</span>
                </a>
                <a href="#" id="history" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Transaction History</span>
                </a>
                 <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">User Activity Logs</span>
                </a>
            </div>
            <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user fa-fw mr-3"></span>
                    <span class="menu-collapsed">Profile</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu2' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Settings</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Password</span>
                </a>
            </div>
            <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tasks fa-fw mr-3"></span>
                    <span class="menu-collapsed">Tasks</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <div id='submenu3' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Cash Request</span>
                </a>
                <a href="#users" id="users_approval" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Users Approval</span>
                </a>
            </div>
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>OPTIONS</small>
            </li>
            <!-- /END Separator -->
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-calendar fa-fw mr-3"></span>
                    <span class="menu-collapsed">Calendar</span>
                </div>
            </a>
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-envelope-o fa-fw mr-3"></span>
                    <span class="menu-collapsed">Messages <span class="badge badge-pill badge-primary ml-2">5</span></span>
                </div>
            </a>
            <!-- Separator without title -->
            <li class="list-group-item sidebar-separator menu-collapsed"></li>
            <!-- /END Separator -->
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-question fa-fw mr-3"></span>
                    <span class="menu-collapsed">Help</span>
                </div>
            </a>
            <a href="#" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                    <span id="collapse-text" class="menu-collapsed">Collapse</span>
                </div>
            </a>
            <!-- Logo 
            <li class="list-group-item logo-separator d-flex justify-content-center">
                <img src='https://v4-alpha.getbootstrap.com/assets/brand/bootstrap-solid.svg' width="30" height="30" />
            </li> -->
        </ul>
        <!-- List Group END-->
    </div>
    <!-- sidebar-container END -->

    <!-- MAIN -->
    <div class="col">

        <h1>
            CrediShare
            <small class="text-muted">Version 1.0</small>
        </h1>


<div class="card">
    <h4 class="card-header">Control Panel * Admin -
        <?php echo $_SESSION['username']?>
    </h4>
    <div class="card-body" id="main_panel">
        <div class="notifier"></div>
        <div class="col-lg-11">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-chart-bar"></i>Users with most credits</div>
                <div class="card-body">
                    <canvas id="myBarChart" width="100%" height="50"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>
    </div>
</div>
    </div>
    <!-- Main Col END -->
</div>
<!-- body-row END -->
    <!-- /.container -->
<!-- Modal -->
<div class="modal fade" id="addcredit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">ADD CREDIT:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group row">
                <label for="user" class="col-sm-2 col-form-label">Username: </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="users" placeholder="Enter username of payee" autocomplete="off" required>
                    <div class="list-group" id="userlist">        
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Amout</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="amount" placeholder="Amount" required>
                </div>
            </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="topup" data-dismiss="modal" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/dashboard.controller.js"></script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script>
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';
        $(document).ready(function(){
                $.ajax({
                    url:"../core/chart.php",
                    method:"POST",
                    data:{action:"users_chart"},
                    success: function(data){
                        var users = [];
			             var credit = [];
                        var e = $.parseJSON(data);
                        for(var i = 0; i < e.length; i++) {                   
                            users.push(e[i].username);
                            credit.push(e[i].available_credits);
                        }
                        console.log(users);
                        var ctx = document.getElementById("myBarChart");
                            var myLineChart = new Chart(ctx, {
                                      type: 'bar',
                                      data: {
                                        labels: users,
                                        datasets: [{
                                          label: "Credits",
                                          backgroundColor: "rgba(2,117,216,1)",
                                          borderColor: "rgba(2,117,216,1)",
                                          data: credit,
                                        }],
                                      },
                                      options: {
                                        scales: {
                                          xAxes: [{
                                            ticks: {
                                              maxTicksLimit: 6
                                            }
                                          }],
                                          yAxes: [{
                                            ticks: {
                                              min: 0,
                                              max: 1000,
                                              maxTicksLimit: 5
                                            },
                                            gridLines: {
                                              display: true
                                            }
                                          }],
                                        },
                                        legend: {
                                          display: false
                                        }
                                      }
                                    });
                    }
                });
        });
        
    </script>
</body>

</html>