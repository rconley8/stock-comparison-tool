<?php
//Checks to see if session is still valid
include 'functions.php';
session_start();
if(!$_SESSION['myusername']){
    header("location:compare.html");
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

    <title>Stock Comparison Tool</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="js/themes/blue/style.css" type="text/css" id="" media="print, projection, screen" />


    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <link href="css/style.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Ubuntu:bold" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet" type="text/css">
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https:/oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript" src="js/jquery-latest.js"></script> 
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
    <style>
        .body_container{
            font-family: 'Vollkorn', Georgia, Times, serif;
            background: #F0F0F0;
            border: 1px solid rgba(18, 83, 88, 1);
            border-radius: 15px;
        }
    </style>
</head>
  <body>
<div class="header">
  
  </div>
	<!-- Static navbar -->
	<div id="custom-bootstrap-menu" class="navbar navbar-static-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="index.html"><img src="IALogo.png" class="logo grow" alt="Investing Assistant"></a>
				<a class="navbar-brand" href="index.html">Investing Assistant</a>
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
						  <li class="divider"></li>
						  <li class="dropdown-header">Nav header</li>
						  <li><a href="#">Separated link</a></li>
						  <li><a href="#">One more separated link</a></li>
						</ul>
					</li>
					<li><a href="search.php">Search Stocks</a></li>
				  <li class="active"><a href="compare.php">Compare Stocks</a></li>
				  <li><a href="contact.php">Contact</a></li>
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
      		<div id="body_container">
			<div class="search_stocks">
				<form id="stock_form">
					<label for="ticker_symbols">Input symbols here:</label><input type="search" name="ticker_symbols" />
					<button type="button" id="data_container_generate">Generate Info</button>
					<div id='PleaseWait' style='display: none;'><img src='res/loader.gif'/></div>
					</br>
					<p style="font-size:12px;color:rgba(62, 92, 95, 1);">Example: (GOOG, AAPL, YHOO...)</p>
				</form>
                                <div class="data_container">
                                    
                                </div>
			</div>
		</div>
    </div> <!-- /container -->
    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <link rel="stylesheet" href="js/plugins/jquery-ui-1.11.4.custom/jquery-ui.css">
  	<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="js/plugins/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript" src="js/jquery-latest.js"></script> 
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
    <script src="js/main.js"></script>
    <script src="js/compare.js"></script>
    <script type="text/javascript">
      var sym = gup('ticker_symbols');
      if (sym != null) {
	getSymbolData(sym);
      }
    </script>
</html>