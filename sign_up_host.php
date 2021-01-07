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
    	<a href="login_host.php" class="else">
        <div id="login" class="other">
        	<h1 class="login">Host Login</h1>
        </div>
        </a>
        <a href="sign_up_host.php" class="select">
        <div id="signup" class="selected">
        	<h1 class="signup">Host SignUp</h1>
        </div>
        </a>
        <div id="main" align="center">
        <form action="new_host_adding.php" method="post">
        	<input type="email" class="input" placeholder="Email" align="center" name="email" required/>
        	<input type="text" class="input" placeholder="Name" align="center" name="name" required/>
            <input type="password" class="input" placeholder="Password" name="password" pattern=".{4,}"   required title="4 characters minimum"/><br />
            <input type="submit" class="button" value="Log In" />
        </form>
        </div>
    	
    </div>

<!-- 	<h2>Host Sign Up</h2> -->
<!-- 	<form action="new_host_adding.php" method="post"> -->
<!-- 	E-mail: <input type="text" name="email"><br> -->
<!-- 	Name: <input type="text" name="name"><br> -->
<!-- 	Password: <input type="password" name="password"><br> -->
<!-- 	<input type="submit"> -->
<!-- 	</form> -->
	
</body>

</html>