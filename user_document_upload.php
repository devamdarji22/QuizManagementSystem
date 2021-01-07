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
input[type=text], select , textarea {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
#radio_btn{
    padding: 20px 0px;
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
body {font-family: Arial;}
</style>
</head>
<body>
	<div class = "topnav">
		<h5><a href = "user_test_result.php?test_code=<?php 
		$testcode = $_GET['test_code'];
		echo $testcode;
		?>">Skip</a></h5>
	</div>
	<br/>
	<div id = "form">
	<center><h2>Upload Your Document Here</h2>
	<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="file" id="file" accept=".pdf"><br>
	<br/>
	<input type="submit" name="submit" value="submit">
	</form>
	</center>
	</div>
<?php
require('database_connection.php');
$email = $_SESSION["email"];
$testcode = $_GET["test_code"];


if (isset($_POST['submit'])){
    
      
    $location = "uploads/";
    $file_new_name = date("dmy") . time() . $_FILES["file"]["name"]; // New and unique name of uploaded file
    $file_name = $_FILES["file"]["name"]; // Get uploaded file name
    $file_temp = $_FILES["file"]["tmp_name"]; // Get uploaded file temp
    $file_size = $_FILES["file"]["size"];
    
    if ($file_size > 10485760) { // Check file size 10mb or not
        echo "<script>alert('Woops! File is too big. Maximum file size allowed for upload 10 MB.')</script>";
    } else {
        $sql = "UPDATE attendance_details 
				SET test_document_name = '$file_new_name'
                WHERE test_code = '$testcode' and user_email='$email'";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            move_uploaded_file($file_temp, $location . $file_new_name);
            echo "<script>alert('Wow! File uploaded successfully.')</script>";
            // Select id from database
            header("location: user_test_result.php?test_code=".$testcode);
            
        } else {
            echo "<script>alert('Woops! Something wong went.')</script>";
        }
    }
    
    
//     $documentname = mysqli_real_escape_string($connection,$_FILES['document']['name']);
//     $documentdata = mysqli_real_escape_string($connection,file_get_contents($_FILES['document']['tmp_name']));
//     $documenttype = mysqli_real_escape_string($connection,$_FILES['document']['type']);
    
//     //echo $documentname;
    
//     $sql = "UPDATE attendance_details SET test_document = $documentdata, test_document_name = $documentname WHERE test_code = $testcode AND user_email = $email";
//     $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
//     if($result){
//         echo "DONE";
//     }
//     else {
//         echo "NOT DONE";
//     }
//     if(substr($documenttype, 0,3) == "pdf"){
        
//     }
//     else {
//         echo "Only .pdf are allowed";
//     }
    
    
    
    
}


?>

</body>

</html>