// Put this code in first line of web page. 
<?php 
session_start();
session_destroy();
header("location:signin.html?l=loggedOut");
?>