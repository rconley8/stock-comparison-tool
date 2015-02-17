<?php
$host="localhost"; // Host name 
$username=""; // Mysql username 
$password=""; // Mysql password 
$db_name="test"; // Database name 
$tbl_name="members"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

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