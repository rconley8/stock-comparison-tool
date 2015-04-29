<?php
$host="localhost"; // Host name 
$username=""; // Mysql username 
$password=""; // Mysql password 
$db_name="test"; // Database name 
$tbl_name="members"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// username and password sent from form
$email = $_POST['email'];
$myusername = $_POST['username']; 
$mypassword = $_POST['password'];
$repassword = $_POST['repassword'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];



//Encrypting of password
$encrypt_password = md5($mypassword);

$sql = mysql_query("SELECT * FROM members WHERE email='$email'") or die(mysql_error());
$query = mysql_query("SELECT * FROM members WHERE username='$myusername'") or die(mysql_error());
if(mysql_num_rows($sql) == 0) {
    if(mysql_num_rows($query) == 0) {
        if($mypassword == $repassword){
        $query1 = "INSERT INTO members (email,username, password, firstname, lastname) VALUES ('$email','$myusername','$encrypt_password','$firstname','$lastname')";
        $data = mysql_query ($query1)or die(mysql_error());
        if($data) {
            $useridsql = "SELECT id FROM Members WHERE username = '$myusername' ";
            $result = $conn->query($useridsql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                  $row = $result->fetch_assoc(); 
                  $userid = $row["id"];
            } else {
                echo "0 results";
            }
            
            $createportfolio = "INSERT INTO portfolio_margin (userid, available_cash, amount_invested) VALUES ('$userid','100000', '0')";
            $portfolio = $conn->query($createportfolio);
            echo "YOUR REGISTRATION IS COMPLETED...";
            header("location:signin.html?r=s");
        }
        }else{
            echo "Passwords are not the same.....";
            header("location:signup.html?r=failedP");
        }
    } else {
        echo "SORRY...USERNAME HAS ALREADY BEEN REGISTERED...";
        header("location:signup.html?r=failedU");
    }
}else{
    echo "This Email address has already been registered...";
    header("location:signup.html?r=failedE");
}




?>