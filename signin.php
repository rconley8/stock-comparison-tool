<?php
//Checks to see if session is still valid
session_start();
if(!$_SESSION['myusername']){
    header("location:signin.html");
} else {
    header("location:portfolio.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="../../favicon.ico">-->

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <script src="js/ie-emulation-modes-warning.js"></script>
    <script src="js/main.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      
<!-- Static navbar -->
<!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Stock Comparison Tool</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index.html">Home</a></li>
              <li class="dropdown">
                <a href="about.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">About <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="help.html">How to...</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
              <li><a href="search.html">Search Stocks</a></li>
              <li><a href="portfolio.html">My Portfolio</a></li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="signin.html">Login<span class="sr-only">(current)</span></a></li>
              <li><a href="signup.html">Sign up</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
      <p align="center" id="failedLogOn" style="color:red"></p>
      <form align="center" class="form-signin" action="check_login.php" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <div align="center" class="form-group">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="myusername" style="width: 30%" type="text" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="mypassword" style="width: 30%" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label >
            <input type="checkbox" value="remember-me"> Remember me
          </label>
          <a href="signup.html">Create account here!</a>
        </div>
        <button style="width: 30%" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </div>
      </form>
      
      <script type="text/javascript">
        var log = gup('l');
        if (log == 'failed') {
          document.getElementById("failedLogOn").innerHTML = "Username or Password is incorrect";
        }else if (log == 'loggedOut') {
          document.getElementById("failedLogOn").innerHTML = "You have been succesfully Logged Out!"
        }
        var reg = gup('r');
        if (reg == 's') {
          document.getElementById("failedLogOn").innerHTML = "User Account has been created successfully. Please login below.";
        }
      </script>

    </div> <!-- /container -->

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
