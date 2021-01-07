<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Welcome Host</title>

<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
#c {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 95%;
  margin-left: auto;
  margin-right: auto;
}

#c td, #c th {
  border: 1px solid #ddd;
  padding: 8px;
}

#c tr:nth-child(even){background-color: #f2f2f2;}

#c tr:hover {background-color: #ddd;}

#c th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
#form {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  width:30%;
  margin:auto;
}
</style>
</head>
<body>
	<div class = "topnav">
		<h5><a href = "signout.php">Sign Out</a></h5>
		<h5><a href = "student_attendance_test_detail.php<?php 
		      $testcode = $_GET['test_code'];
		      echo "?test_code=".$testcode."";
		?>">Back</a></h5>
		
		<h5><a href = "host_test_list.php">Home</a></h5>
	</div>
	<br/>
<?php
require('database_connection.php');
$testcode = $_GET['test_code'];
$email = $_GET['email'];
$sql = "SELECT q.* , a.*
FROM question_detail AS q JOIN answer_detail AS a ON q.code = a.code AND q.question_number = a.question_number 
WHERE a.user_email = '$email' AND q.question_type = 'mcq' AND a.code = '$testcode'";

if($result = mysqli_query($connection, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<h2><center>MCQ Questions</center></h2></br>";
        echo "<table id='c'>";
        echo "<tr>";
        echo "<th>Question Number</th>";
        echo "<th>Question Marks</th>";
        echo "<th>Question</th>";
        echo "<th>Option 1</th>";
        echo "<th>Option 2</th>";
        echo "<th>Option 3</th>";
        echo "<th>Option 4</th>";
        echo "<th>Correct Answer</th>";
        echo "<th>Answer</th>";
        echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td >" . $row['question_number'] . "</td>";
            echo "<td>" . $row['question_marks'] . "</td>";
            echo "<td>" . $row['question'] . "</td>";
            echo "<td>" . $row['option1'] . "</td>";
            echo "<td>" . $row['option2'] . "</td>";
            echo "<td>" . $row['option3'] . "</td>";
            echo "<td>" . $row['option4'] . "</td>";
            echo "<td>" . $row['correct_answer'] . "</td>";
            echo "<td>" . $row['answer'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "You have not added any question.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}

$query = "SELECT * FROM attendance_details WHERE user_email = '$email' AND test_code = '$testcode'";
if($result = mysqli_query($connection, $query)){
    if(mysqli_num_rows($result) > 0){
        echo "<br/><table id = 'c'>";
        echo "<tr><th><center>MCQ Marks</center></th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            
            echo "<tr><td><center>".$row['test_marks']."</center></td></tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "You have not added any question.";
    }
} else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($connection);
}

$sql = "SELECT q.* , a.*
FROM question_detail AS q JOIN answer_detail AS a ON q.code = a.code AND q.question_number = a.question_number
WHERE a.user_email = '$email' AND q.question_type = 'subjective' AND q.code = '$testcode'";

if($result = mysqli_query($connection, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<br/><h2><center>Subjective Questions</center></h2></br>";
        echo "<table id='c'>";
        echo "<tr>";
        echo "<th>Question Number</th>";
        echo "<th>Question Marks</th>";
        echo "<th>Question</th>";
        echo "<th>Answer</th>";
        echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td >" . $row['question_number'] . "</td>";
            echo "<td>" . $row['question_marks'] . "</td>";
            echo "<td>" . $row['question'] . "</td>";
            echo "<td>" . $row['answer'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "You have not added any question.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}
echo "<br/><h2><center>PDF Uploaded</center></h2></br>";
?>
<div id="form">
<?php

$sql = "SELECT * FROM attendance_details WHERE test_code='$testcode' AND user_email='$email'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
    if ($row = mysqli_fetch_assoc($result)) {
        ?>
                <center><a href="uploads/<?php echo $row['test_document_name']; ?>" target="_blank" ><?php echo $row['test_document_name']; ?></a></center>
                <?php
                    }
                }
                
                ?>
            </div>


</body>

</html>