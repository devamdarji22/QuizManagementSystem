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
<script type="text/javascript">

function yesnoCheck() {
    if (document.getElementById("abc").checked) {
        document.getElementById("forMcq").style.display = 'block';
    } else {
        document.getElementById("forMcq").style.display = 'none';
    }
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
</style>
</head>
<body>
	<div class = "topnav">
		<h5><a href = "test_view.php<?php 
		      $testcode = $_GET['test_code'];
		      echo "?test_code=".$testcode."";
		?>">Back</a></h5>
	</div><br/>
	<div id = "form">
	<h2>Add Question Detail</h2>
	<form action="" method="post">
	<input type="text" name="question_marks" placeholder="Question Marks" required><br>
	<textarea name="question" rows="4" cols="60" placeholder="Question" required></textarea><br/>
	<div id="radio_btn">Question Type: <input id="abc" type="radio" name="type" value="mcq" onclick="javascript:yesnoCheck();"  checked="checked"> Mcq
  	<input type="radio" name="type" value="subjective" onclick="javascript:yesnoCheck();"> Subjective<br> </div>
	<div id="forMcq">
	<input type="text" name="option1" placeholder="Option 1(only if mcq is selected)" required><br>
	<input type="text" name="option2" placeholder="Option 2(only if mcq is selected)" required><br>
	<input type="text" name="option3" placeholder="Option 3(only if mcq is selected)" required><br>
	<input type="text" name="option4" placeholder="Option 4(only if mcq is selected)" required><br>
	 <input type="text" name="correct_answer" placeholder="Correct Answer" required><br>
	</div>
	<input type="submit">
	</form>
	</div>
	
</body>
<?php
	require('database_connection.php');
	$testcode = $_GET['test_code'];
	
	
	if (isset($testcode) and isset($_POST['question']) and isset($_POST['type']) and isset($_POST['option1']) and isset($_POST['option2'])
	    and isset($_POST['option3']) and isset($_POST['option4']) and isset($_POST['question_marks']) and isset($_POST['correct_answer'])){
	    $question_marks = $_POST['question_marks'];
	    $question = $_POST['question'];
	    $type = $_POST['type'];
	    $option1 = $_POST['option1'];
	    $option2 = $_POST['option2'];
	    $option3 = $_POST['option3'];
	    $option4 = $_POST['option4'];
	    $correct_answer = $_POST['correct_answer'];
	    
	    $sql = "SELECT * FROM question_detail WHERE code='$testcode'";
	    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	    $count = mysqli_num_rows($result);
	    $question_number = $count + 1;
	    
	        
	        if($correct_answer == 1 || $correct_answer == 2 ||$correct_answer == 3 ||$correct_answer == 4 ||$correct_answer == ""){
	            $query = "INSERT INTO question_detail (code, question_number, question_type, question, question_marks, option1, option2, option3, option4,correct_answer)
            VALUES ('$testcode', '$question_number', '$type', '$question', '$question_marks','$option1','$option2','$option3','$option4','$correct_answer')";
	            
	            
	            if (mysqli_query($connection, $query)) {
	                header('Location: test_view.php?test_code='.$testcode.'');
	            } else {
	                echo "Error: " . $query . "<br>" . mysqli_error($connection);
	            }
	        }
	        else {
	            echo "<script type='text/javascript'>alert('Enter proper option for correct answer.')</script>";
	        }
	        
	    
	    
	    
	    
	    
	}
?>
</html>