<?php

   session_start();
require('db_credentials.php');
		$mysqli = new mysqli($servername, $username, $password, $dbname);
	
		if ($mysqli->connect_error) {
			$message = $mysqli->connect_error;
		} 
if($_SESSION['error']!="error"){
	$_SESSION['message'] =" ";
}
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $myusername = mysqli_real_escape_string($mysqli,$_POST['username']);
      $mypassword = mysqli_real_escape_string($mysqli,$_POST['password']); 
      $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($mysqli,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $id = $row['id'];
	   $_SESSION['userid']=$id;
      
      $count = mysqli_num_rows($result);
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
		  $sql2="UPDATE users SET loggedIn='Y' WHERE id='$id'";
		  mysqli_query($mysqli,$sql2);
         header("location: fallSemester.php");
      }else {
         $_SESSION['message'] = "Your Login Name or Password is invalid. Try Again";
      }
   }
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="calender.css">
<!-- http://saracaponi.epizy.com/FinalProject.html?i=1 -->
	<meta charset="utf-8">
	<title>Final Project </title>
	<link rel="stylesheet" type="text/css" href="mainPage.css">
	<script>
	
		function DisplayLogin(){
			
			var item= document.getElementById("blank");
			var string= " <form method = 'post''>User Name: <input type='text' class='form' placeholder='Enter Username' name='username' > <br> Password:  <input type='password' class='form' placeholder='Enter Password' name='password' > <br> <button id='submit' type='submit'>Submit</button></form>";
            item.innerHTML=string;
		}
	
	  function DisplaySignUp(){
            var item= document.getElementById("blank");
		    var string=" <form action='newUser.php' method = 'post''>User Name: <input type='text' class='form' placeholder='Enter Username' name='username' > <br> Password:  <input type='password' class='form' placeholder='Enter Password' name='password' > <br> <button id='submit' type='submit'>Submit</button></form>";
            item.innerHTML=string;
      
        }
	
	
	</script>
	
	</head>
<body>
	
	<h1>Events At Mizzou</h1>

	<div id="wrapper"></div>
	<div id="select"> <h2>Login or sign up to view your upcoming events!</h2>
	<br><div id="message"> <?php echo $_SESSION['message'] ?></div>

	<div id="blank"></div>
		
	<button onclick="DisplayLogin()"> Login </button>
	<button onclick="DisplaySignUp()"> Sign Up</button>
	</div>
	</body>
</html>
