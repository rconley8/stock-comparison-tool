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
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword'];

//encrypting password
$encrypt_password=md5($mypassword);
//echo $encrypt_password;

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$encrypt_password = stripslashes($encrypt_password);
$myusername = mysql_real_escape_string($myusername);
$encrypt_password = mysql_real_escape_string($encrypt_password);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$encrypt_password'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
session_start();
// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION['myusername'] = $myusername;
$_SESSION['mypassword'] = $encrypt_password;
header("location:portfolio.php");
}
else {
header("location:signin.html?l=failed");
}
?>
