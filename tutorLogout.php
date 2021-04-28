<?php
session_start();
session_destroy();
unset($_SESSION['TID']);
unset($_SESSION['TUTORNAME']);
unset($_SESSION['ROLE']);
header("location: studentLogin.php");
?>

