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

$sql = "SELECT * FROM Events";
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
	$user_id=$_SESSION['userid'];
	$event_id=$_GET['id'];
	$sql="INSERT INTO rsvpEvent (userID, eventID) VALUES('$user_id','$event_id')";
	mysqli_query($conn,$sql);
	echo $user_id;
	echo $event_id;
}
function generateEventTableHTML($events) {
		$html="<h1>Upcoming Events!</h1>";
		$html .= "<table>\n";
		$html .= "<tr><th>Organization</th><th>Event</th><th>Description</th><th>Location</th><th>Time</th><th>actions</th></tr>\n";
	
		foreach ($events as $event) {
			$id = $event['id'];
			$org = $event['organization'];
			$EventTitle = $event['event'];
			$description = ($event['description']) ? $event['description'] : '';
			$location = $event['location'];
			$whatTime=$event['whatTime'];
			
			$html .= "<tr><td>$org</td><td>$EventTitle</td><td>$description</td><td>$location</td><td>$whatTime</td><td><form action='fallSemester.php' method='get'><button type='submit' name='id' value='$id'> Add to my Events </button>
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
<button onclick="location.href='myEvents.php'">View My Events</button>
<form action = '' method = 'post''><button type="submit"> Log Out </button></form>

<div class='banner'>
<img class='banner-image' src="mizzou.jpg" alt="mizzou" style="width:100%; height:50%;">
</div>
$body
</body>
</html>
EOT;

	return $html;
}


?>
