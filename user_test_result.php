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
<title>Welcome User</title>
<script type="text/javascript"> 
        function preventBack() { 
            window.history.forward();  
        } 
          
        setTimeout("preventBack()", 0); 
          
        window.onunload = function () { null }; 
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
  background-color: #B80F0A;
  color: white;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 15%;
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
body {font-family: Arial;}
</style>
</head>
<body>
	<div class = "topnav">
		<h5><a href = "user_test_list.php">Home</a></h5>
	</div>
	<br/>
<?php
require('database_connection.php');
$email = $_SESSION["email"];
$testcode = $_GET["test_code"];
$sql = "SELECT * FROM attendance_details WHERE test_code='$testcode' AND user_email = '$email'";

if($result = mysqli_query($connection, $sql)){
    
    
    
    if(mysqli_num_rows($result) > 0){
        echo "<table id = 'customers'>";
        echo "<tr><th><center>Marks</center></th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            
            echo "<tr><td><center>".$row['test_marks']."</center></td></tr>";
        }
        echo "</table>";
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