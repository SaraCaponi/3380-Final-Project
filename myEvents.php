<?php

session_start();
require('db_credentials.php');
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("<p>Connection failed: " . $conn->connect_error . "</p>");
}
$user_id=$_SESSION['userid'];

$sql = "SELECT Events.id as EID, organization, event, description, location, whatTime
FROM Events JOIN rsvpEvent ON Events.id = eventID
JOIN users ON userID = users.id
WHERE users.id ='$user_id'";
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
if($_SERVER["REQUEST_METHOD"] == "GET") {
	$event_id=$_GET['id'];
	$sql="DELETE FROM rsvpEvent WHERE eventID='$event_id'";
	$result2 = $conn->query($sql);
	if (($result->num_rows)== 0) {
		$html="<h4> You dont have any upcoming events</h4>";
		print generatePageHTML("Events", $html);
	}
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_id=$_SESSION['userid'];
		 $sql2="UPDATE users SET loggedIn='N' WHERE id='$user_id'";
		  mysqli_query($conn,$sql2);
$URL="http://saracaponi.epizy.com/FinalProject.php";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';		
	}

function generateEventTableHTML($events) {

		$html = "<table>\n";
		$html .= "<tr><th>Organization</th><th>Event</th><th>Description</th><th>Location</th><th>Time</th><th>actions</th>";
		if (count($events) < 1) {
			$html .= "<p>No events to display!</p>\n";
			return $html;
		}
		foreach ($events as $event) {
			$id = $event['EID'];
			$org = $event['organization'];
			$EventTitle = $event['event'];
			$description = ($event['description']) ? $event['description'] : '';
			$location = $event['location'];
			$whatTime=$event['whatTime'];
			
			$html .= "<tr><td>$org</td><td>$EventTitle</td><td>$description</td><td>$location</td><td>$whatTime</td><td><form action='myEvents.php' method='GET'><button class='button' type='submit' name='id' value='$id'> Delete from my Events </button>
			</form></td></tr>\n";
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
<div class="nav">
<button class="button" onclick="location.href='fallSemester.php'">View Events</button>
<form action = '' method = 'post''><button class="button" type="submit"> Log Out </button></form>
</div>
 <img src="http://mediad.publicbroadcasting.net/p/kcur/files/styles/x_large/public/201407/Mizzou_Jesse.jpg" width:"941.333px" height:"746.665px">

$body
</body>
</html>
EOT;

return $html; 
}


  ?>