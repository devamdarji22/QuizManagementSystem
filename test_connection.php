<?php
// Initialize the session
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require('database_connection.php');
$testcode = $_GET['test_code'];
$email = $_SESSION['email'];
$query = "UPDATE attendance_details
            SET attendance = 1
            WHERE test_code = '$testcode' and user_email = '$email'";


if (mysqli_query($connection, $query)) {
    header("location: user_test.php?test_code=".$testcode."&total=".$total."&current=2");
    //header('Location: test_view.php?test_code='.$testcode.'');
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
}

$query = "SELECT * from question_detail WHERE code = '$testcode'";

$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);
header("location: user_test.php?test_code=".$testcode."&total=".$count."&current=1");

?>