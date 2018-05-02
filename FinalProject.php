<?php

   session_start();
require('db_credentials.php');
		$mysqli = new mysqli($servername, $username, $password, $dbname);
	
		if ($mysqli->connect_error) {
			$message = $mysqli->connect_error;
		} 
$printError="";
	if($_SESSION['error']==1){
		$printError="That username is taken. Please try again.";
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
		  $_SESSION['error']=0;
         header("location: fallSemester.php");
      }else {
		  	$printError="Username and password do not match. Please try again.";
      }
   }
?>


<!DOCTYPE html>
<html>
<head>
<!-- http://saracaponi.epizy.com/FinalProject.html?i=1 -->
	<meta charset="utf-8">
	<title>Final Project </title>
	<link rel="stylesheet" type="text/css" href="mainPage2.css">
	<script>
	
		function DisplayLogin(){
			
			var item= document.getElementById("blank");
			var string= " <form method = 'post''>User Name: <input type='text' class='form' placeholder='Enter Username' name='username' > <br> Password:  <input type='password' class='form' placeholder='Enter Password' name='password' > <br> <button id='submit' type='submit'>Submit</button></form>";
            item.innerHTML=string;
			var item2=document.getElementById("message");
			item2.innerHTML="";
		}
	
	  function DisplaySignUp(){
            var item= document.getElementById("blank");
		    var string=" <form action='newUser.php' method = 'post''>User Name: <input type='text' class='form' placeholder='Enter Username' name='username' > <br> Password:  <input type='password' class='form' placeholder='Enter Password' name='password' > <br> <button id='submit' type='submit'>Create Account</button></form>";
            item.innerHTML=string;
		    var item2=document.getElementById("message");
			item2.innerHTML="";
      
        }
	
	
	</script>
	
	</head>
<body>
	
	<h1>Events At Mizzou</h1>

	<div id="wrapper"></div>
	<div id="select"> <h2>Login or sign up to view your upcoming events!</h2>
	<br><div id="message"> <?php echo $printError ?></div>

	<div id="blank"></div>
		
	<button onclick="DisplayLogin()"> Login </button>
	<button onclick="DisplaySignUp()"> Sign Up</button>
	</div>
	</body>
</html>
