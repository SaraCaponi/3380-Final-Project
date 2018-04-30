<?php

   session_start();
require('db_credentials.php');
		$mysqli = new mysqli($servername, $username, $password, $dbname);
	
		if ($mysqli->connect_error) {
			$message = $mysqli->connect_error;
		} 
   $_SESSION['error']=0;
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $myusername = mysqli_real_escape_string($mysqli,$_POST['username']);
      $mypassword = mysqli_real_escape_string($mysqli,$_POST['password']); 
      
      $sql = "SELECT id FROM users WHERE username = '$myusername'";
      $result = mysqli_query($mysqli,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   
      
      $count = mysqli_num_rows($result);	
      if($count == 0) {
	  		$_SESSION['login_user'] = $myusername;
			$sql2="INSERT INTO users (username,password,loggedIn) VALUES('$myusername','$mypassword','Y')";
			mysqli_query($mysqli,$sql2);
		  
		  	$sql = "SELECT id FROM users WHERE username = '$myusername'";
	   		$result = mysqli_query($mysqli,$sql);
	   		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	   		$id = $row['id'];
	   		$_SESSION['userid']=$id;
		  	$_SESSION['error']=0;

			  
         header("location: fallSemester.php");
      }else {
		  $_SESSION['error']=1;
		  header("location: FinalProject.php");
	   
      }
   }
?>
