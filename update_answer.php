<?php
// Initialize the session
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require('database_connection.php');
$testcode = $_GET['test_code'];
$question_number = $_GET['current'];
$total = $_GET['total'];
$email = $_SESSION["email"];
if (isset($_POST['submit'])){
    if(isset($_POST['option'])){
        $answer = $_POST['option'];
    }
    else {
        $answer = $_POST['answer'];
    }
    
    $sql1 = "SELECT * FROM answer_detail WHERE code='$testcode' AND question_number='$question_number' AND user_email ='$email'";
    $result1 = mysqli_query($connection, $sql1);
    
    if (mysqli_num_rows($result1) > 0) {
        // output data of each row
        echo "<script>alert('Question already submitted')</script>";
        $question_number = $question_number+1;
        header("location: user_test.php?test_code=".$testcode."&total=".$total."&current=".$question_number);
    } else {
        
        $query = "INSERT INTO answer_detail (code, question_number,user_email,answer)
            VALUES ('$testcode', '$question_number', '$email','$answer')";
        
        $question_number = $question_number+1;
        if (mysqli_query($connection, $query)) {
            header("location: user_test.php?test_code=".$testcode."&total=".$total."&current=".$question_number);
            //header('Location: test_view.php?test_code='.$testcode.'');
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($connection);
        }
        
    }
    
    
    //header("location: user_test.php?test_code=".$testcode."&total=".$count."&current=".current+1);
}

?>