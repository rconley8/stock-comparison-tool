<?php

    function getPrice($stock){
        $homepage = file_get_contents("http://www.google.com/finance/getprices?i=10&p=1m&f=d,o,h,l,c,v&df=cpct&q=" . $stock . "");
        $testing = substr($homepage, 143);
        $arr = explode(",",$testing);
        if (time() < strtotime("16:00") && time() > strtotime("9:30")){
            if(getCurrentDay() == 'Sat' || getCurrentDay() == 'Sun'){
                return $arr[6];
            }else{
                return $arr[1];
            }
        } else {
            return $arr[6];
        }
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
                $closeprice = number_format(getPrice(strtoupper($stocksymbol)),2);
                $marketValue = $closeprice * $row["numberofshares"];
                $totalMarketValue += $marketValue;
            }
            return $totalMarketValue;
        }
    }
?>
