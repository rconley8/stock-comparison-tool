<?php
//Checks to see if session is still valid
include 'functions.php';
session_start();
if(!$_SESSION['myusername']){
    header("location:signin.html");
}

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

$stock = $_POST['symbol'];
$numberofshares = $_POST['quantity'];
$price = $_POST['price'];
$cost = $_POST['cost'];

$myusername = $_SESSION['myusername'];
$useridsql = "SELECT id FROM Members WHERE username = '$myusername' ";
$result = $conn->query($useridsql);

if ($result->num_rows > 0) {
    // output data of each row
      $row = $result->fetch_assoc(); 
      $userid = $row["id"];
} else {
    echo "0 results";
}

echo "USER ID:" . $userid;

$portfoliosql = "SELECT * FROM portfolio_margin WHERE userid = '$userid'";
$result = $conn->query($portfoliosql);
if ($result->num_rows > 0) {
    // output data of each row
      $row = $result->fetch_assoc(); 
      $amountInvested = $row["amount_invested"];
      $availableCash = $row["available_cash"];
} else {
    echo "0 results";
}

$totalAmountInvested = $amountInvested + $cost;
$totalAvailableCash = $availableCash - $cost;

$updateportfolio = "UPDATE portfolio_margin SET available_cash = '$totalAvailableCash', amount_invested = '$totalAmountInvested' WHERE userid = '$userid'";
$result = $conn->query($updateportfolio);

$grabportfolio = "SELECT * FROM portfolio WHERE userid = '$userid' and stocksymbol='$stock'";
$result = $conn->query($grabportfolio);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $currentprice = $row['stockprice'];
    $currentnumberofshares = $row['numberofshares'];
    $total = ($currentprice * $currentnumberofshares) + ($price * $numberofshares);
    $totalnumberofshares = $currentnumberofshares + $numberofshares;
    $newprice = number_format(($total/$totalnumberofshares), 2);
    $addtoportfolio = "UPDATE portfolio SET stockprice = '$newprice', numberofshares = '$totalnumberofshares' WHERE userid = '$userid' and stocksymbol = '$stock'";
    $resultadd = $conn->query($addtoportfolio);
}else{
    $addtoportfolio = "INSERT INTO portfolio (userid, stocksymbol, stockprice, numberofshares) VALUES ('$userid', '$stock', '$price', '$numberofshares')";
    $resultadd = $conn->query($addtoportfolio);
}

header("location:portfoliosuccess.php?s=$stock&q=$numberofshares&p=$price");

?>