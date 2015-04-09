<?php

    function getPrice($stock){
        $keystats = simplexml_load_file("http://query.yahooapis.com/v1/public/yql?q=use%20%22https://raw.githubusercontent.com/rconley8/stock-comparison-tool/master/yahoo.finance.quotes.xml%22%20as%20keystatistics%3B%20SELECT%20*%20FROM%20keystatistics%20WHERE%20symbol%3D%27". $stock ."%27");
        $closeprice = $keystats->results->stats->CurrentPrice;
        return $closeprice;
    }
    
    function getCurrentDay(){
        return date("D");
    }
    
    function getTotalMarketValue($userid, $connf){
        $totalMarketValue = 0;
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
?>
