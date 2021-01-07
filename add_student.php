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
<title>Add Student</title>

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
}input[type=text], select {
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
		<h5><a href = "student_attendance_test_detail.php<?php 
		      $testcode = $_GET['test_code'];
		      echo "?test_code=".$testcode."";
		?>">Back</a></h5>
	</div>
	<br/>
	<div id = "form">
	<h2>Add Student Detail</h2>
	<form action="" method="post">
	<input type="text" name="email" placeholder="Email" required><br>
	<br/>
	
	
	<input type="submit">
	</form>
	</div>
</body>
<?php
	require('database_connection.php');
	$testcode = $_GET['test_code'];
	
	
	if (isset($testcode) and isset($_POST['email'])){
	    $email = $_POST['email'];
	    
	    $sql = "SELECT * FROM attendance_details WHERE user_email='$email' and test_code='$testcode'";
	    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	    $count = mysqli_num_rows($result);
	    
	    if ($count == 1){
	        echo "<script type='text/javascript'>alert('Student already exist.')</script>";
	        //echo "Login Credentials verified";
	        //echo "<script type='text/javascript'>alert('Login Credentials verified')</script>";
	        
	    }else{
	        $sql = "SELECT * FROM user WHERE email='$email'";
	        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	        $count = mysqli_num_rows($result);
	        
	        if ($count == 0){
	            echo "<script type='text/javascript'>alert('Student account not exist.')</script>";
	            //echo "Login Credentials verified";
	            //echo "<script type='text/javascript'>alert('Login Credentials verified')</script>";
	            
	        }else{
	            $query = "INSERT INTO attendance_details (test_code, user_email)
            VALUES ('$testcode', '$email')";
	            
	            
	            if (mysqli_query($connection, $query)) {
	                header('Location: student_attendance_test_detail.php?test_code='.$testcode.'');
	            } else {
	                echo "Error: " . $query . "<br>" . mysqli_error($connection);
	            }
	            //echo "Invalid Login Credentials";
	        }
	        
	        //echo "Invalid Login Credentials";
	    }
	    
	    
	    
	    
	}
?>
</html>