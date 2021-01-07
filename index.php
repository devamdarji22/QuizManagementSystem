<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Welcome to Quiz Manager</title>
<style type="text/css">
.button { /* Green */
  border: none;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  background-color: #4CAF50; 
  color: white; 
  border-radius: 8px;
}
#form {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  width:30%;
  margin:auto;
  position:fixed;
  top: 50%;
  left: 50%;
  width:30em;
    height:10em;
    margin-top: -5em; /*set to a negative number 1/2 of your height*/
    margin-left: -15em;
}
h2 {
   font-family: "Trebuchet MS", sans-serif;
   font-size: 2em;
   letter-spacing: -2px;
   border-bottom: 2px solid black;
   text-transform: uppercase;
 }
</style>
</head>
<body>
<center>
	<div id="form">
	<h2>Quiz Manager</h2>
	<a href = "login_host.php"><input type = "submit" name = "Host" value = "Host" class="button"></a>
	<a href = "login_user.php"><input type = "submit" name = "Participant" value = "User" class="button"></a>
	
	</div>
	</center>
</body>

</html>