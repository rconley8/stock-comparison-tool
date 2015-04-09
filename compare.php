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
    <link rel="stylesheet" href="js/themes/blue/style.css" type="text/css" id="" media="print, projection, screen" />


    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <link href="css/style.css" rel="stylesheet">

    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https:/oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript" src="js/jquery-latest.js"></script> 
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <div id="custom-bootstrap-menu" class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="index.html">Stock Comparison Tool</a>
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                        </button>
                </div>
                <div class="collapse navbar-collapse navbar-menubuilder">
                        <ul class="nav navbar-nav navbar-left">
                                <li><a href="index.html">Home</a></li>
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
                                <li><a href="stocksearch.php">Search Stocks</a></li>
                          <li class="active"><a href="portfolio.php">My Portfolio</a></li>
                          <li><a href="contact.html">Contact</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                          <li><a href="account.php">Welcome, <?php echo $_SESSION['myusername'] ?> </a></li>  
                          <li><a href="Logout.php">Logout <span class="sr-only">(current)</span></a></li>
                        </ul>
                </div>
        </div>
</div>

      <!-- Main component for a primary marketing message or call to action -->
      <div>
        <table id="myTable" class="tablesorter"> 
            <thead> 
                <tr> 
                    <th>Stock</th> 
                    <th>Price</th>
                    <th>Beta</th>
                    <th>P/E Ratio</th>
                    <th>PEG Ratio</th>
                    <th>50 Day MA</th>
                    <th>200 Day MA</th>
                    <th>Mean Recommendation</th>
                </tr> 
            </thead> 
            <tbody> 
               <?php
                    $stocks = "GOOG,AAPL,YHOO,AMZN,MSFT";
                    $arr = explode(",",$stocks);
                    foreach ($arr as $symbol){
                        $xml = simplexml_load_file("http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22" . $symbol . "%22)&env=store://datatables.org/alltableswithkeys")
                        or die("Error: Cannot create object");
                        $keystats = simplexml_load_file("http://query.yahooapis.com/v1/public/yql?q=use%20%22https://raw.githubusercontent.com/rconley8/stock-comparison-tool/master/yahoo.finance.quotes.xml%22%20as%20keystatistics%3B%20SELECT%20*%20FROM%20keystatistics%20WHERE%20symbol%3D%27". $symbol ."%27");
                        $closeprice = $keystats->results->stats->CurrentPrice;
                        $peratio = $xml->results->quote->PERatio;
                        $pegratio = $xml->results->quote->PEGRatio;
                        $fiftyma = $xml->results->quote->FiftydayMovingAverage;
                        $twohundredma = $xml->results->quote->TwoHundreddayMovingAverage;
                        $beta = $keystats->results->stats->Beta;
                        $recommendation = $keystats->results->stats->MeanRecommendation;
                        echo "<tr><td><a href=search.html?ticker_symbols=$symbol>". strtoupper($symbol) . "</a></td><td>" . $closeprice . "</td><td>" . $beta . "</td><td>". $peratio . "</td>";
                        echo "<td>". $pegratio . "</td><td>". $fiftyma ."</td><td>". $twohundredma ."</td><td>". $recommendation ."</td></tr>";
                    }
               ?>
            </tbody> 
        </table> 
            
        <p>
          <a class="btn btn-lg btn-primary" href="search.html" role="button">Start Comparing Stocks! &raquo;</a>
        </p>
      </div>

    </div> <!-- /container -->
    
    <script type="text/javascript" id="js">
        function sort() { 
                $("#myTable").tablesorter({sortList: [[4,0]]}); 
            }
        sort();
    </script>

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