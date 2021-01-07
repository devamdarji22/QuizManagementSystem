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
<script>
function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;
    csvFile = new Blob([csv], {type: "text/csv"});
    downloadLink = document.createElement("a");
    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
}
function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 0; j < cols.length-1; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    downloadCSV(csv.join("\n"), filename);
}
      </script>
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
</style>
</head>
<body>
	<div class = "topnav">
		<h5><a href = "signout.php">Sign Out</a></h5>
		<h5><a href = "test_view.php<?php 
		      $testcode = $_GET['test_code'];
		      echo "?test_code=".$testcode."";
		?>">Back</a></h5>
		<h5><a href = "add_student.php<?php 
		      $testcode = $_GET['test_code'];
		      echo "?test_code=".$testcode."";
		?>">Add Student</a></h5>
		
		<h5><a href = "javascript:exportTableToCSV('
		<?php 
		require('database_connection.php');
		$testcode = $_GET['test_code'];
		
		$sql = "SELECT * FROM test_detail WHERE test_code = '$testcode'";
		$result = mysqli_query($connection, $sql);
		
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		        echo "" . $row["test_title"]. " " . $row["test_date"]. ".csv";
		    }
		}
		?>
		')">Download Attendance</a></h5>
		<h5><a href = "host_test_list.php">All Test</a></h5>
	</div>
	<br/>
<?php
require('database_connection.php');
$testcode = $_GET['test_code'];

$sql = "SELECT * FROM attendance_details WHERE test_code = '$testcode'";
if($result = mysqli_query($connection, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='c'>";
            echo "<tr>";
                echo "<th>Student Email</th>";
                echo "<th>Attendance</th>";
                echo "<th>View Answer</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td ><a href='student_profile_view.php?test_code=".$testcode."&email=" . $row['user_email'] . "'>" . $row['user_email'] . "</a></td>";
                echo "<td>" . $row['attendance'] . "</td>";
                if($row['attendance']==1){
                    echo "<td ><a href='host_answer_view_list.php?test_code=".$testcode."&email=" . $row['user_email'] . "'>Click Here</a></td>";
                }
                else {
                    echo "<td>Absent</td>";
                }
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