<?php
include('core/account.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Join CrediShare now</title>

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
        
    </style>
</head>    
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Credishare Registration</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="index.php" class="nav-link" href="#">Login</a>
          </li>
          <li class="nav-item active">
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
    <form method="POST" id="registerform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
       <input type="hidden" value="signup" name="action">
         <div id="response"></div>
        <div class="form-group">
            <label for="exampleInputPassword1">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Desire Username" autocomplete="off" require>
            
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Student number:</label>
            <input type="text" class="form-control" name="studentnumber" id="studentnumber" placeholder="Student number" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address or Username</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password1" id="password1" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" class="form-control" name="password2" id="password2" placeholder="Re Enter password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Signup</button>
    </form>

</div>
<!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#username').keyup(function(){    
               
                var userQuery = $('#username').val();
                var u_len = userQuery.length;
                if(userQuery != '' && u_len > 4){
                    $('#username').removeClass('is-invalid');
                    $.ajax({
                    method:"post",
                    url:"core/account.php",
                    data:{action:"check",query:userQuery},
                    success: function(response){
                        $('#response').fadeIn("slow");
                         $('#response').html(response);
                    }
                    });
                } else {
                    $('#response').fadeOut("slow");
                    $('#username').addClass('is-invalid');
                }
            });
            
            $('#registerform').submit(function(){
               var isvalid = $('#isvalid').val();
                var p1 = $('#password1').val();
                 var p2 = $('#password2').val();
                if(isvalid == "valid" && p1==p2){
                  
                    return true;
                } else {
                    $('#response').fadeIn("slow");
                    $('#response').html('<div class="alert alert-danger" role="alert">' +
                                        '<input type="hidden" value="valid" id="isvalid">'+
                                        'Please try again. validate your form.</div>');
                     
                    if(p1!=p2){
                        $('#password1').addClass('is-invalid');
                         $('#password2').addClass('is-invalid');
                    }
                    return false; 
                }
            });
        });
    
        
    </script>
</body>
</html>