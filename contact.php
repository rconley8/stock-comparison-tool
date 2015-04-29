<?php
//Checks to see if session is still valid
include 'functions.php';
session_start();
if(!$_SESSION['myusername']){
    header("location:signin.html");
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
    
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png"/>
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png"/>
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png"/>
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png"/>
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png"/>
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png"/>
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png"/>
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png"/>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png"/>
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32"/>
	<link rel="icon" type="image/png" href="/favicon-194x194.png" sizes="194x194"/>
	<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96"/>
	<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192"/>
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16"/>
	<link rel="manifest" href="/manifest.json"/>
	<meta name="msapplication-TileColor" content="#ffc40d"/>
	<meta name="msapplication-TileImage" content="/mstile-144x144.png"/>
	<meta name="theme-color" content="#ffffff"/>

    <title>Investing Assistant</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    
    <link href="css/style.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Ubuntu:bold" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet" type="text/css">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <div class="header">
  
  </div>
	<!-- Static navbar -->
	<div id="custom-bootstrap-menu" class="navbar navbar-static-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="index.php"><img src="IALogo.png" class="logo grow" alt="Investing Assistant"></a>
				<a class="navbar-brand" href="index.php">Investing Assistant</a>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse navbar-menubuilder">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="index.php">Home</a></li>
					<li class="dropdown">
					<a href="about.php" class="dropdown-toggle" aria-expanded="false">About <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
						  <li><a href="help.php">How to...</a></li>
						  <li><a href="terms.php">Financial Terms</a></li>
						</ul>
					</li>
					<li><a href="search.php">Search Stocks</a></li>
				  <li><a href="compare.php">Compare Stocks</a></li>
				  <li class="active"><a href="contact.php">Contact</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				  <li><a href="portfolio.php">Welcome, <?php echo $_SESSION['myusername'] ?> </a></li>  
				  <li><a href="Logout.php">Logout <span class="sr-only">(current)</span></a></li>
				</ul>
			</div>
		</div>
	</div>

      <!-- Main component for a primary marketing message or call to action -->
	<div class="container">
	  <div class="body_container">
		<h2 class="center">Investing Assistant developed by:</h2>
		<div class="mailto center">
			<p>Richard Conley</p>
			<a href="mailto:richard.conley@otterbein.edu?Subject=Investing%20Assistant">richard.conley@otterbein.edu</a>
			<p>Tim McClain</p>
			<a href="mailto:timothy.mcclain@otterbein.edu?Subject=Investing%20Assistant">timothy.mcclain@otterbein.edu</a>
			<p>Jake Harper</p>
			<a href="mailto:jacob.harper@otterbein.edu?Subject=Investing%20Assistant">jacob.harper@otterbein.edu</a>
		</div>
	  </div>
	</div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>
