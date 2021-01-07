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
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 95%;
  margin-left: auto;
  margin-right: auto;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>
	<div class = "topnav">
		<h5><a href = "signout.php">Sign Out</a></h5>
		<h5><a href = "add_question.php<?php 
		      $testcode = $_GET['test_code'];
		      echo "?test_code=".$testcode."";
		?>">Add Question</a></h5>
		<h5><a href = "host_test_list.php">All Test</a></h5>
		<h5><a href = "start_test.php<?php 
		      $testcode = $_GET['test_code'];
		      echo "?test_code=".$testcode."";
		?>"><?php 
		      require('database_connection.php');
		      $testcode = $_GET['test_code'];
		      $query = "SELECT start from test_detail WHERE test_code = '$testcode' and start = TRUE";
		      if($result = mysqli_query($connection, $query)){
		          if(mysqli_num_rows($result) > 0){
		              echo "End Test for All";
		              mysqli_free_result($result);
		          } else {
		              echo "Publish Test";
		          }
		      }
		      else{
		          echo "ERROR: Could not able to execute $query. " . mysqli_error($connection);
		      }
		?></a></h5>
		<h5><a href = "student_attendance_test_detail.php<?php 
		      $testcode = $_GET['test_code'];
		      echo "?test_code=".$testcode."";
		?>">Student Detail</a></h5>
		<h5><a href = "delete_test.php<?php 
		      $testcode = $_GET['test_code'];
		      echo "?test_code=".$testcode."";
		?>">Delete Test</a></h5>
	</div>
	<br/>
<?php
require('database_connection.php');
$testcode = $_GET['test_code'];

$sql = "SELECT * FROM question_detail WHERE code = '$testcode' ORDER BY question_number";
if($result = mysqli_query($connection, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='customers'>";
            echo "<tr>";
                echo "<th>Question Number</th>";
                echo "<th>Question Type</th>";
                echo "<th>Question Marks</th>";
                echo "<th>Question</th>";
                echo "<th>Option 1</th>";
                echo "<th>Option 2</th>";
                echo "<th>Option 3</th>";
                echo "<th>Option 4</th>";
                echo "<th>Correct Answer</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td ><a href='host_question_view.php?test_code=".$testcode."&question_number=" . $row['question_number'] . "'>" . $row['question_number'] . "</a></td>";
                echo "<td>" . $row['question_type'] . "</td>";
                echo "<td>" . $row['question_marks'] . "</td>";
                echo "<td>" . $row['question'] . "</td>";
                echo "<td>" . $row['option1'] . "</td>";
                echo "<td>" . $row['option2'] . "</td>";
                echo "<td>" . $row['option3'] . "</td>";
                echo "<td>" . $row['option4'] . "</td>";
                echo "<td>" . $row['correct_answer'] . "</td>";
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

?>
	
</body>

</html>