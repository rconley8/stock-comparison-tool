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
    <!--<link rel="icon" href="../../favicon.ico">-->

    <title>Stock Comparison Tool</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

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
    <style>
      .pt{
          padding:.5em;
          border:1px solid black;
          background:#328aa4;
          color:#fff;
        }
      .pd{
          padding:.5em;
          border:1px solid black;
          background:#e5f1f4;
        }
      .dp{
        padding:.1em;
      }
      
      .body_container{
        padding-left: 25px;
        padding-top: 25px;
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
				  <li><a href="contact.php">Contact</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				  <li class="active"><a href="portfolio.php">Welcome, <?php echo $_SESSION['myusername'] ?> </a></li>  
				  <li><a href="Logout.php">Logout <span class="sr-only">(current)</span></a></li>
				</ul>
			</div>
		</div>
	</div>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="container">
        <div class="body_container">
        <p>PORTFOLIO:
            <?php
              $host="localhost"; // Host name 
              $username=""; // Mysql username 
              $password=""; // Mysql password 
              $db_name="test"; // Database name 
              $tbl_name="members"; // Table name 
              
              // Create connection
              $conn = new mysqli($host, $username, $password, $db_name);
              // Check connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }
              
              $myusername = $_SESSION['myusername'];
              echo $myusername. "<br>";
              $useridsql = "SELECT id FROM Members WHERE username = '$myusername' ";
              $result = $conn->query($useridsql);
              
              if ($result->num_rows > 0) {
                  // output data of each row
                    $row = $result->fetch_assoc(); 
                    $userid = $row["id"];
              } else {
                  echo "0 results";
              }
              
              $portfoliomarginsql = "SELECT * FROM portfolio_margin WHERE userid='$userid'";
              $portfoliomarginresult = $conn->query($portfoliomarginsql);
              
              if ($portfoliomarginresult->num_rows > 0){
                $marginrow = $portfoliomarginresult->fetch_assoc();
                $cash = $marginrow["available_cash"];
                $startingcash = 100000;
                $totalMarketValue = getTotalMarketValue($userid, $conn);
                $amountinvested = $marginrow["amount_invested"];
                $total = $cash + $totalMarketValue;
                $totalpercent = number_format((($total-$startingcash)/$startingcash)*100,2);
                $equitypercent = number_format((($totalMarketValue-$amountinvested)/$amountinvested)*100,2) ;
                echo "<table>";
                echo "<tr><td class=\"dp\">Total:</td><td class=\"dp\" align=\"right\"> $". number_format($total,2) . "</td>";
                if ($totalpercent > 0){
                  echo "<td class=\"dp\" align=\"right\" style=\"color:green\">+". $totalpercent . "%</td></tr>";
                } else {
                  echo "<td class=\"dp\" align=\"right\" style=\"color:red\">". $totalpercent . "%</td></tr>";
                }
                echo "<tr><td class=\"dp\">Cash:</td><td class=\"dp\" align=\"right\"> $" . number_format($cash,2) . "</td></tr>";
                echo "<tr><td class=\"dp\">Equities:</td><td class=\"dp\" align=\"right\"> $". number_format($totalMarketValue,2) . "</td>";
                if ($equitypercent > 0){
                  echo "<td class=\"dp\" align=\"right\" style=\"color:green\">+". $equitypercent . "%</td></tr>";
                } else {
                  echo "<td class=\"dp\" align=\"right\" style=\"color:red\">". $equitypercent . "%</td></tr>";
                }
                echo "</table><br>";
              }
              
              // Grabs all portfolio entries for current user
              $portfoliosql = "SELECT * FROM portfolio Where userid='$userid' ORDER BY stocksymbol";
              $result = $conn->query($portfoliosql);
              if ($result->num_rows > 0) {
                // output data of each row
              
                // Creates table for portfolio
                echo "<table><tr><th class=\"pt\">Stock</th><th class=\"pt\"># of Shares</th>
                      <th class=\"pt\">Current Price</th><th class=\"pt\">Market Value</th>
                      <th class=\"pt\">Day Change</th><th class=\"pt\">Percent Change</th></tr>";
                      
                // Loops over each returned row for current users portfolio
                while($row = $result->fetch_assoc()) {
                    $stocksymbol = $row["stocksymbol"];
                    
                    //Grabs previous days close price for current stock symbol
                    $keystats = simplexml_load_file("http://query.yahooapis.com/v1/public/yql?q=use%20%22https://raw.githubusercontent.com/rconley8/stock-comparison-tool/master/yahoo.finance.quotes.xml%22%20as%20keystatistics%3B%20SELECT%20*%20FROM%20keystatistics%20WHERE%20symbol%3D%27". $stocksymbol ."%27");
                    $prevclose = doubleval($keystats->results->stats->PrevClose);
                    $closeprice = number_format(doubleval($keystats->results->stats->CurrentPrice), 2);
                    $marketValue = $closeprice * $row["numberofshares"];
                    $costBasis = $row["stockprice"] * $row["numberofshares"];
                    $daypricechange = number_format($closeprice - $prevclose, 2);
                    $daypercentchange = number_format(($daypricechange/$prevclose) * 100, 2) . "%";
                    $gainloss = $marketValue - $costBasis;
                    $percentChange = number_format(($gainloss/$costBasis) * 100, 2) . "%";
                    echo "<tr><td class=\"pd\" align=\"center\"><a href=search.php?ticker_symbols=$stocksymbol>" .strtoupper($row["stocksymbol"]). "</a>
                    </td><td class=\"pd\" align=\"right\">" . $row["numberofshares"]. "</td>
                    <td class=\"pd\" align=\"right\">" . $closeprice . "</td><td class=\"pd\" align=\"right\">$" . number_format($marketValue, 2) . "</td>";
                    if ( $daypricechange > 0){
                      echo "<td class=\"pd\" align=\"right\" style=\"color:green\">+" . $daypricechange . "(+" . $daypercentchange . ")" . "</td>";
                    } else {
                      echo "<td class=\"pd\" align=\"right\" style=\"color:red\">" . $daypricechange . "(" . $daypercentchange . ")" . "</td>";
                    } 
                    if ( $percentChange > 0){
                      echo "<td class=\"pd\" align=\"right\" style=\"color:green\">+" . $percentChange . "</td></tr>";
                    } else {
                      echo "<td class=\"pd\" align=\"right\" style=\"color:red\">" . $percentChange . "</td></tr>";
                    } 
                  
                }
                echo "</table>";
              } else {
                echo "<p> You have not added anything to your portfolio yet. To do so please look up a stock and click the add to portfolio button.</p>";
              }
              $conn->close();
            ?>
        </p>
        <p>
          *Market Data could be delayed by up to 15 minutes.
        </p>
        <p>
          <a class="btn btn-lg btn-primary" href="search.html" role="button">Start Comparing Stocks! &raquo;</a>
        </p>
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
