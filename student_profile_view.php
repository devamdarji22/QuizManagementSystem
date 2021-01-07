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
		<h5><a href = "host_test_list.php">Home</a></h5>
		<h5><a href = "student_attendance_test_detail.php<?php 
		      $testcode = $_GET['test_code'];
		      echo "?test_code=".$testcode."";
		?>">Back</a></h5>
		<h5><a href = "delete_student.php<?php 
		      $testcode = $_GET['test_code'];
		      $email = $_GET['email'];
		      echo "?test_code=".$testcode."&email=".$email."";
		?>">Delete Student</a></h5>
		
	</div>
	<br/>
<?php
require('database_connection.php');
$testcode = $_GET['test_code'];

$sql = "SELECT * FROM user WHERE email = '$email' ";
if($result = mysqli_query($connection, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='customers'>";
            echo "<tr>";
                echo "<th>Student Email</th>";
                echo "<th>Name</th>";
                echo "<th>USN</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td >" . $row['email'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['usn'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "You have not added any student.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}

?>
</body>

</html>