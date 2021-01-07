<!DOCTYPE html >
<html>
<head>
<title>Welcome to Quiz Manager</title>
<link href="home.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
</head>
<body>
	<div id="header">
    	<a href="index.php"><h1 class="title">Quiz Management System</h1></a>
    </div>
    
    <div id="page">
    	<a href="login_user.php" class="select">
        <div id="login" class="selected">
        	<h1 class="login">User Login</h1>
        </div>
        </a>
        <a href="sign_up_user.php" class="else">
        <div id="signup" class="other">
        	<h1 class="signup">User SignUp</h1>
        </div>
        </a>
        <div id="main" align="center">
        <form action="" method="post">
        	<input type="email" class="input" placeholder="Email" align="center" name="email" required/>
            <input type="password" class="input" placeholder="Password" name="password" pattern=".{4,}"   required title="4 characters minimum"/><br />
            <input type="submit" class="button" value="Log In"  name="submit"/>
        </form>
        </div>
    	
    </div>
</body>
<?php  
 require('database_connection.php');

if (isset($_POST['email']) and isset($_POST['password'])){
$email = $_POST['email'];
$password = $_POST['password'];
$query = "SELECT * FROM user WHERE email='$email' and password='$password'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);

if ($count == 1){
    session_start();
    $_SESSION["loggedin"] = true;
    $_SESSION["email"] = $email;
    header('Location: user_test_list.php');
//echo "Login Credentials verified";
//echo "<script type='text/javascript'>alert('Login Credentials verified')</script>";

}else{
echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";
//echo "Invalid Login Credentials";
}
}
?>
</html>