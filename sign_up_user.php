<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<link href="home.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Welcome to Quiz Manager</title>
</head>
<body>
	<div id="header">
    	<a href="index.php"><h1 class="title">Quiz Management System</h1></a>
    </div>
    
    <div id="page">
    	<a href="login_user.php" class="else">
        <div id="login" class="other">
        	<h1 class="login">User Login</h1>
        </div>
        </a>
        <a href="sign_up_user.php" class="select">
        <div id="signup" class="selected">
        	<h1 class="signup">User SignUp</h1>
        </div>
        </a>
        <div id="main" align="center">
        <form action="" method="post">
        	<input type="email" class="input" placeholder="Email" align="center" name="email" required/>
        	<input type="text" class="input" placeholder="Name" align="center" name="name" required/>
        	<input type="text" class="input" placeholder="USN" align="center" name="usn" required/>
            <input type="password" class="input" placeholder="Password" name="password" pattern=".{4,}"   required title="4 characters minimum"/><br />
            <input type="submit" class="button" value="Log In" />
        </form>
        </div>
    	
    </div>
<!-- 	<h2>User Sign Up</h2> -->
<!-- 	<form action="" method="post"> -->
<!-- 	E-mail: <input type="text" name="email"><br> -->
<!-- 	Name: <input type="text" name="name"><br> -->
<!-- 	USN: <input type="text" name="usn"><br> -->
<!-- 	Password: <input type="password" name="password"><br> -->
<!-- 	<input type="submit"> -->
<!-- 	</form> -->
	
</body>
<?php
	require('database_connection.php');
	
	
	
	
	if (isset($_POST['email']) and isset($_POST['password']) and isset($_POST['name']) and isset($_POST['usn'])){
	    $email = $_POST['email'];
	    $password = $_POST['password'];
	    $name = $_POST['name'];
	    $usn = $_POST["usn"];
	    $query = "INSERT INTO user (email, name, password, usn)
            VALUES ('$email', '$name', '$password', '$usn')";
	    
	    
	    if (mysqli_query($connection, $query)) {
	        echo "New record created successfully";
	    } else {
	        echo "Error: " . $query . "<br>" . mysqli_error($connection);
	    }
	    
	    
	}
?>
</html>