<?php

    function getPrice($stock){
        $keystats = simplexml_load_file("http://query.yahooapis.com/v1/public/yql?q=use%20%22https://raw.githubusercontent.com/rconley8/stock-comparison-tool/master/yahoo.finance.quotes.xml%22%20as%20keystatistics%3B%20SELECT%20*%20FROM%20keystatistics%20WHERE%20symbol%3D%27". $stock ."%27");
        $closeprice = doubleval($keystats->results->stats->CurrentPrice);
        return $closeprice;
    }
    
    function getCurrentDay(){
        return date("D");
    }
    
    function getTotalMarketValue($userid, $connf){
        $totalMarketValue = 0.00;
        $sql = "SELECT * FROM portfolio Where userid='$userid'";
        $result = $connf->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $stocksymbol = $row["stocksymbol"];
                $closeprice = getPrice($stocksymbol);
                $marketValue = $closeprice * $row["numberofshares"];
                $totalMarketValue += $marketValue;
            }
            return $totalMarketValue;
        }
    }
    
    function getUserID($conn){
        $myusername = $_SESSION['myusername'];
        $useridsql = "SELECT id FROM Members WHERE username = '$myusername' ";
        $result = $conn->query($useridsql);
        
        if ($result->num_rows > 0) {
            // output data of each row
              $row = $result->fetch_assoc(); 
              $userid = $row["id"];
              return $userid;
        }
    }
    
    function getAvailableFunds(){
        $host="localhost"; // Host name 
        $username=""; // Mysql username 
        $password=""; // Mysql password 
        $db_name="test"; // Database name 
        
        // Create connection
        $conn = new mysqli($host, $username, $password, $db_name);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $userid = getUserID($conn);
        $sql = "SELECT * FROM portfolio_margin WHERE userid = '$userid'";
        $result = $conn->query($sql);
        
        if($result -> num_rows > 0) {
            $row = $result->fetch_assoc();
            $funds = $row['available_cash'];
            return $funds;
        }
    }
?>
