<?php
// Initialize the session
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require('database_connection.php');
$testcode = $_GET['test_code'];

$query = "SELECT start from test_detail WHERE test_code = '$testcode' and start = TRUE";
if($result = mysqli_query($connection, $query)){
    if(mysqli_num_rows($result) > 0){
        $sql = "UPDATE test_detail SET start=FALSE WHERE test_code='$testcode'";
        if (mysqli_query($connection, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($connection);
        }
        mysqli_free_result($result);
    } else {
        $sql = "UPDATE test_detail SET start=TRUE WHERE test_code='$testcode'";
        if (mysqli_query($connection, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($connection);
        }
    }
    header("location: host_test_list.php");
}
else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($connection);
}

exit;
?>