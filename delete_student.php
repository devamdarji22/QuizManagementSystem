<?php
// Initialize the session
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require('database_connection.php');
$testcode = $_GET['test_code'];
$email = $_GET['email'];
$sql = "DELETE FROM attendance_details WHERE test_code='$testcode' and user_email='$email'";
if(mysqli_query($connection, $sql)){
    echo "Records were deleted successfully.";
    header("location: student_attendance_test_detail.php?test_code=$testcode");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}
// Redirect to login page

exit;
?>