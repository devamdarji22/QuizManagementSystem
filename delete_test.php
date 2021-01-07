<?php
// Initialize the session
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require('database_connection.php');
$testcode = $_GET['test_code'];
$sql = "DELETE FROM test_detail WHERE test_code='$testcode'";
if(mysqli_query($connection, $sql)){
    echo "Records were deleted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}
// Redirect to login page
header("location: host_test_list.php");
exit;
?>