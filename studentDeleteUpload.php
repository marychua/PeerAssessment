<?php

session_start();

if (empty($_SESSION['UID'])) 
{
    header('location: studentLogin.php');
}
require 'Database/dbConnect.php';
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or
die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, DB_NAME) or die(mysqli_error($db));

if (empty($_GET['id'])) 
{
    header('location: studentHomepage.php');
}

$id = $_GET['id'];
$searchfile = "SELECT * FROM upload WHERE UPLOADID = ('$id')";
$query = mysqli_query($db, $searchfile);
if($query->num_rows>0)
{
    $row        =   $query->fetch_assoc();
    $scname     =   $row['FILENAME'];
    $file = "upload/".$scname;	
    if($query)
    {
        unlink($file);
        $sql = "DELETE FROM upload WHERE UPLOADID = ('$id')";
        		if($db -> query($sql) === true) {
		echo "<script src='js/sweetalert.min.js'></script>";
        echo "<script>setTimeout(function(){ swal({title: 'Content has been deleted!', icon: 'success'}).then(function() {window.location = 'SUpload.php';}); }, 1);</script>";
		}
		else {
		echo "<script src='js/sweetalert.min.js'></script>";
        echo "<script>setTimeout(function(){ swal({title: 'Delete process failed! Please try again.', icon: 'error'}).then(function() {window.location = 'SUpload.php';}); }, 1);</script>";
		}
    }
}
?>