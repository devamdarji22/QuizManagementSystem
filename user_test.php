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
  background-color: black;
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
label {
    padding: 5px 10px 10px 10px;    
}
#radio_btn{
    padding: 10px 0px;
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
		<h5><a href = "signout.php">End Test</a></h5>
	</div>
	<br/>
<?php
require('database_connection.php');
$email = $_SESSION["email"];
$testcode = $_GET["test_code"];
$total = $_GET["total"];
$current = $_GET["current"];
$sql = "SELECT * FROM question_detail WHERE code='$testcode' ORDER BY question_number";
if($current > $total){
    header("location: user_document_upload.php?test_code=".$testcode);
    
}
if($result = mysqli_query($connection, $sql)){
    
    
    
    if(mysqli_num_rows($result) > 0){
        echo '<div class="tab">';
        $count = 0;
        foreach($result as $row) {
            $count = $count+1;
            if($count == $current){
                echo "<br/><div id = 'form'>";
                echo '<h3>'.$row['question_number'].'.'.$row['question'].'</h3>';
                echo '<form action="update_answer.php?test_code='.$testcode.'&total='.$total.'&current='.$current.'" method="post">';
                if($row['question_type'] == 'mcq'){
                    echo '<div id="radio_btn">';
                    echo '<input type="radio" id="option1" name="option" class="radio" value="1">';
                    echo '<label for="option1">'.$row['option1'].'</label><br>';
                    echo '<input type="radio" id="option2" name="option" class="radio" value="2">';
                    echo '<label for="option2">'.$row['option2'].'</label><br>';
                    echo '<input type="radio" id="option3" name="option" class="radio" value="3">';
                    echo '<label for="option3">'.$row['option3'].'</label><br>';
                    echo '<input type="radio" id="option4" name="option" class="radio" value="4">';
                    echo '<label for="option4">'.$row['option4'].'</label><br></div>';
                    
                }
                else {
                    echo '<textarea id="answer" name="answer" rows="4" cols="50"></textarea><br>';
                }
                echo '<input type="submit" name = "submit"></form>';
                echo '</div>';
            }
            
        }
        
      //   foreach($result as $row1) {
      //     echo '<div id="'.$row1['question_part'].'" class="tabcontent">';
      //     echo '<h3>'.$row1['question_part'].'</h3>';
      //     echo '<p>London is the capital city of England.</p>';
      //     echo '</div>';
      // }
      mysqli_free_result($result);
    } else{
        echo "No test created.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}


if (isset($testcode) and isset($_POST['option']) and isset($_POST['answer']) ){
    if(isset($_POST['option'])){
        $answer = $_POST['option'];
    }
    else {
        $answer = $_POST['answer'];
    }
    $sql1 = "SELECT * FROM answer_detail WHERE code='$testcode' AND question_number='$question_number' AND user_email ='$email'";
    $result1 = mysqli_query($connection, $sql1);
    
    if (mysqli_num_rows($result1) > 0) {
        // output data of each row
        echo "Question already submitted";
    } else {
        $query = "INSERT INTO answer_detail (code, question_number,user_email,answer)
            VALUES ('$testcode', '$question_number', '$email','$answer')";
        
        
        if (mysqli_query($connection, $query)) {
            header("location: user_test.php?test_code=".$testcode."&total=".$total."&current=2");
            //header('Location: test_view.php?test_code='.$testcode.'');
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($connection);
        }
    }
    
    
    
    //header("location: user_test.php?test_code=".$testcode."&total=".$count."&current=".current+1);
}

?>

</body>

</html>