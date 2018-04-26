<?php
session_start();
$servername = "sql207.epizy.com";
$username = "epiz_21498761";
$password = "kViPIdVw5uif";
$dbname = "epiz_21498761_MizzouCalendar";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<p>Connection failed: " . $conn->connect_error . "</p>");
}

$sql = "SELECT * FROM fall";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

	$events = array();
	while($row = $result->fetch_assoc()) {
        array_push($events, $row);
    }
    
    if ($_GET["responseType"] == "json") {
    	print json_encode($events);
    } else {  // html page
    	print generatePageHTML("Events", generateEventTableHTML($events));

    }
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_id=$_SESSION['userid'];
		 $sql2="UPDATE users SET loggedIn='N' WHERE id='$user_id'";
		  mysqli_query($conn,$sql2);
	echo $user_id;
//		 header("location: fallSemester.php");
	
	
}

function generateEventTableHTML($events) {
	$html = "<table>\n";
	$html .= "<tr id=rows><th>Organization</th><th>Event</th><th>Description</th><th>Location</th><th>Time</th></tr>\n";
	
	foreach ($events as $event) {
		$html .= "<tr id=info><td>{$event['organization']}</td><td>{$event['event']}</td><td>{$event['description']}</td><td>{$event['location']}</td><td>{$event['whatTime']}</td></tr>\n";
	}
	
		$html .= "<table>\n";
		$html .= "<tr><th>actions</th><th>Organization</th><th>Event</th><th>Description</th><th>Location</th><th>Time</th></tr>\n";
	
		foreach ($events as $event) {
			$id = $event['id'];
			$org = $event['organization'];
			$EventTitle = $event['event'];
			$description = ($event['description']) ? $event['description'] : '';
			$location = $event['location'];
			$whatTime=$event['whatTime'];
			
			$html .= "<tr><td><form action='fallSemester.php' method='post'><input type='hidden' name='action' value='delete' /><input type='submit' value='Delete'>
			<input type='hidden' name='action' value='update' /><input type='submit' value='Update'></form></td><td>$org</td><td>$EventTitle</td><td>$description</td><td>$location</td><td>$whatTime</td></tr>\n";
		}
		$html .= "</table>\n";
	
		return $html;
}

function generatePageHTML($title, $body) {
	$html = <<<EOT
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="calender.php">
<link href="https://fonts.googleapis.com/css?family=Crimson+Text|Oxygen|Quicksand" rel="stylesheet">
<title>$title</title>
</head>
<body>
<button onclick="location.href='EventForm.php'"> Add Event</button>
<form action = '' method = 'post''><button type="submit"> Log Out </button>

<div class='banner'>
<img class='banner-image' src="mizzou.jpg" alt="mizzou" style="width:100%; height:50%;">
<h1>Fall Events</h1>
</div>
$body
</body>
</html>
EOT;

	return $html;
}


?>