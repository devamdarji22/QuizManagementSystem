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
<script type="text/javascript">

function yesnoCheck() {
    if (document.getElementById("abc").checked) {
        document.getElementById("forMcq").style.display = 'block';
    } else {
        document.getElementById("forMcq").style.display = 'none';
    }
}
function check(type) {
    if (type == "mcq") {
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
<!-- 		<h5><a href = "delete_question.php 
		<?php 
// // 		      $testcode = $_GET['test_code'];
// // 		      $question_number = $_GET['question_number'];
// // 		      echo "?test_code=".$testcode."&question_number=".$question_number."";
// 		?>
		">Delete Question</a></h5> -->
	</div>
	<?php 
	
	
	
	require('database_connection.php');
	$testcode = $_GET['test_code'];
	$question_number = $_GET['question_number'];
	$sql = "SELECT * FROM question_detail WHERE question_number='$question_number' and code='$testcode'";
	$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        echo "<br/><div id = 'form'>";
	        echo "<h2>Update Question Detail</h2>";
	        echo "<form action='' method='post'>";
	        echo "<input type='text' name='question_marks' value = '" . $row["question_number"]. "' readonly required><br>";
	        echo "<input type='text' name='question_marks' value = '" . $row["question_marks"]. "' placeholder='Question Marks' required><br>";
	        echo "<textarea name='question' rows='4' cols='60' placeholder='Question' required>" . $row["question"]. "</textarea><br/>";
	        echo "<div id='radio_btn'>";
	        echo "Question Type: <input id='abc' type='radio' name='type' value='mcq' onclick='javascript:yesnoCheck();' ";
	        if($row["question_type"] == "mcq"){
	            echo "checked='checked'";
	        }
            echo " > Mcq";
	        echo "<input type='radio' name='type' value='subjective' onclick='javascript:yesnoCheck();' ";
            if($row["question_type"] == "subjective"){
	            echo "checked='checked'";
	        }
            echo "> Subjective<br> ";
            echo "</div>";
            echo "<div id='forMcq' style='display:";
            if($row["question_type"] == "mcq"){
                echo "block";
            }else {
                echo "none";
            }
            echo "'>";
            echo "<input type='text' name='option1' value ='" . $row["option1"]. "' placeholder='Option 1(only if mcq is selected)' required><br>";
            echo "<input type='text' name='option2' value ='" . $row["option2"]. "' placeholder='Option 2(only if mcq is selected)' required><br>";
            echo "<input type='text' name='option3' value ='" . $row["option3"]. "' placeholder='Option 3(only if mcq is selected)' required><br>";
            echo "<input type='text' name='option4' value ='" . $row["option4"]. "' placeholder='Option 4(only if mcq is selected)' required><br>";
            echo "<input type='text' name='correct_answer' value ='" . $row["correct_answer"]. "' placeholder='Correct Answer' required><br>";
            echo "</div>";
            
            
	        echo "<input type='submit'>";
	        echo "</form>";
	        echo "</div>";
	        
	    }
	} else {
	    echo "0 results";
	}
	
	
	
	?>
	</body>
<?php
	require('database_connection.php');
	$testcode = $_GET['test_code'];
	
	
	if (isset($testcode) and isset($_GET['question_number']) and isset($_POST['question']) and isset($_POST['type']) and isset($_POST['option1']) and isset($_POST['option2'])
	    and isset($_POST['option3']) and isset($_POST['option4']) and isset($_POST['question_marks']) and isset($_POST['correct_answer'])){
	    $question_number = $_GET['question_number'];
	    $question_marks = $_POST['question_marks'];
	    $question = $_POST['question'];
	    $type = $_POST['type'];
	    $option1 = $_POST['option1'];
	    $option2 = $_POST['option2'];
	    $option3 = $_POST['option3'];
	    $option4 = $_POST['option4'];
	    $correct_answer = $_POST['correct_answer'];
	    if($type == "subjective"){
	        $option1 = $option2 = $option3 = $option4 = $correct_answer = "";
	    }
	    if($correct_answer == 1 || $correct_answer == 2 ||$correct_answer == 3 ||$correct_answer == 4 ||$correct_answer == ""){
	       $sql = "UPDATE question_detail SET question='$question' , question_type='$type', question_marks='$question_marks'
                , option1='$option1', option2='$option2',option3='$option3',option4='$option4',correct_answer = '$correct_answer'  WHERE question_number='$question_number' and code='$testcode'";
	       if (mysqli_query($connection, $sql)) {
	           header('Location: test_view.php?test_code='.$testcode.'');
	       } else {
	           echo "Error updating record: " . mysqli_error($connection);
	       }
	    }
	    else {
	        echo "<script type='text/javascript'>alert('Enter proper option for correct answer.')</script>";
	    }
	}
?>
</html>