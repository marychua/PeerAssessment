<?php
session_start();
session_destroy();
unset($_SESSION['UID']);
unset($_SESSION['USEREMAIL']);
unset($_SESSION['ROLE']);
unset($_SESSION['GID']);
unset($_SESSION['FNAME']);
unset($_SESSION['LNAME']);
header("location: studentLogin.php");
?>

