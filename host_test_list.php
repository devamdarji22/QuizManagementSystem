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
a {
  text-decoration:none;
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
		<h5><a href = "add_test.php">Add test</a></h5>
	</div>
	<br/>
<?php
require('database_connection.php');
$email = $_SESSION["email"];
$sql = "SELECT * FROM test_detail WHERE test_host_email = '$email'";
if($result = mysqli_query($connection, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='customers'>";
            echo "<tr>";
                echo "<th>Test Code</th>";
                echo "<th>Test Title</th>";
                echo "<th>Test Date</th>";
                echo "<th>Publish Test</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo '<td ><a href="test_view.php?test_code='.$row['test_code'].'">'.$row['test_code'].'</a></td>';
                echo "<td>" . $row['test_title'] . "</td>";
                echo "<td>" . $row['test_date'] . "</td>";
                echo "<td>" . $row['start'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No test created.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}

?>
	
</body>

</html>