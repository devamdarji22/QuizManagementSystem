<?php
	require('database_connection.php');
	$name = $_POST["name"];
	$email = $_POST["email"];
    $passwd = $_POST["password"];
	$sql = "INSERT INTO host (Email, Name, Password)
            VALUES ('$email', '$name', '$passwd')";
	
	
	
	
	if (isset($_POST['email']) and isset($_POST['password']) and isset($_POST['name'])){
	    $username = $_POST['email'];
	    $password = $_POST['password'];
	    $name = $_POST['name'];
	    $query = "INSERT INTO host (Email, Name, Password)
            VALUES ('$email', '$name', '$passwd')";
	    
	    
	    if (mysqli_query($connection, $query)) {
	        echo "New record created successfully";
	    } else {
	        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    }
	    
	    
	}
	?>
	