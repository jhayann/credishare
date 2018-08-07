<?php
$display='d-none';
$notice="";
include_once('core/function.php');
if(isLogin()==true){
    header('location:myaccount.php');
} 
    if(isset($_GET['notice']) && $_GET['notice'] == "signup_success")
    {
        $notice = "You have successfully register.";
        $display ='d-block';
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta property="og:title" content="CrediShare" />
    <meta property="og:description" content="Join CrediShare now"/>
         <link rel="icon" href="assets/images/pacman.ico">
    <title>CrediShare 1.0</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/Footer-with-logo-button.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
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
            .loginform
            {
                margin:auto;
                width: 40% !important;
            }
            .ml-auto
            {
                margin-right: 50px !important;
            }
        }
        .text-muted
        {
            color:white !important;
        }
         .loginform
         {
         padding-bottom:100px;
         }
        .btn{
        margin-top:6px;
        }
          div.trust{
         max-height:80px;
        }
        .social-networks
        {
        pointer-events:none;
        }
        .cont{padding:10lx;}
    </style>
        <script type="text/javascript">
            //<![CDATA[ 
            var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.comodo.com/" : "http://www.trustlogo.com/");
            document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
            //]]>
        </script>
</head>    
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Credishare</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a href="register.php" class="nav-link" href="#">Sign up</a>
          </li>
         <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
        </ul>
        
      </div>
    </nav>

<div class="loginform container">
  <div class="card">
  <div class="card-body">
   <h2> Welcome to CrediShare. Start you  account now. 
 <!-- <script language="JavaScript" type="text/javascript">
        TrustLogo("https://bsit-blog.ezyro.com/comodo_secure_seal_76x26_transp.png", "CL1", "none");
    </script> -->
</h2>
  </div>
</div>
   <div class="alert alert-success <?php echo $display?>"><?php echo $notice ?></div>
<form method="POST" id ="auth" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
       <div id="result_auth"></div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address or Username</label>
            <input type="text" class="form-control" id="username" aria-describedby="emailHelp" value="<?php echo $val=(isset($_GET['user']))?$_GET['user']:''?>" placeholder="Username">
            <small id="emailHelp" class="form-text text-muted" style="color:#dee0e2 !important;">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Login</button>
</form>
<a href="register.php">
        <button class="btn btn-primary btn-block">Register</button></a>
    
</div>

   <footer id="myFooter">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-auto">
                    <h2 class="logo"><a href="#"> LOGO </a></h2>
                </div>
                <div class="col-md-auto">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Sign up</a></li>
                        <li><a href="#">Downloads</a></li>
                    </ul>
                </div>
                <div class="col-md-auto">
                    <h5>About us</h5>
                    <ul>
                        <li><a href="#">Company Information</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">Reviews</a></li>
                    </ul>
                </div>
                <div class="col-md-auto">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Help desk</a></li>
                        <li><a href="#">Forums</a></li>
                    </ul>
                </div>
                <div class="col-md-auto">
                    <div class="social-networks">
                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
                    </div>
                    <button type="button" class="btn btn-default">Contact us</button>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>© 2018 CrediShare System</p>
        </div>
    </footer>
<!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/index.js"></script>
</body>
</html>			