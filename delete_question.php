<?php
// Initialize the session
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require('database_connection.php');
$testcode = $_GET['test_code'];
$question_number = $_GET['question_number'];
$sql = "DELETE FROM question_detail WHERE code='$testcode' and question_number='$question_number'";
if(mysqli_query($connection, $sql)){
    echo "Records were deleted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}
// Redirect to login page
header("location: test_view.php?test_code=".$testcode."");
exit;
?>