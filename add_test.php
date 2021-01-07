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
<title>Add Test</title>
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
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
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
		<h5><a href = "host_test_list.php">Back</a></h5>
	</div><br/>
	<div id = "form">
	<h2 align="center">Test Detail</h2>
	<form action="" method="post">
	Test Code: <?php 
$n=10; 
function getName($n) { 
    require('database_connection.php');
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
    $query = "SELECT test_code FROM test_detail WHERE test_code = '$randomString'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    
    if ($count > 0) {
        getName($n);
    }
    return $randomString; 
} 
  
$testcode = getName($n); 
$_SESSION['testcode'] = $testcode;
echo $testcode."<br/>"
?>
	<input type="text" name="name" placeholder="Test Name" required><br>
	Test Date: <input type="date" id="test_date" name="test_date" value="<?php 
	date_default_timezone_set("Asia/Kolkata");
	echo date("Y-m-d");?>" required><br>
	<input type="submit">
	</form>
	</div>
</body>
<?php
	require('database_connection.php');
	
	
	
	if (isset($_SESSION['testcode']) and isset($_POST['name'])){
	    $email = $_SESSION['email'];
	    $name = $_POST['name'];
	    $test_date = $_POST['test_date'];
	    $testcode = $_SESSION['testcode'];
	    $query = "INSERT INTO test_detail (test_code, test_host_email, test_title, start,test_date)
            VALUES ('$testcode', '$email', '$name',FALSE,'$test_date')";
	    
	    
	    if (mysqli_query($connection, $query)) {
	        header('Location: host_test_list.php');
	    } else {
	        echo "Error: " . $query . "<br>" . mysqli_error($connection);
	    }
	    
	    
	}
?>
</html>