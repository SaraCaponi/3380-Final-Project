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
function generateEventTableHTML($events) {
		$html="<h1> Your upcoming Events</h1>";
		$html .= "<table>\n";
		$html .= "<tr><th>Organization</th><th>Event</th><th>Description</th><th>Location</th><th>Time</th><th>actions</th></tr>\n <button type='submit' hidden='hidden' action='' method='GET'></button>" ;
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
			
			$html .= "<tr><td>$org</td><td>$EventTitle</td><td>$description</td><td>$location</td><td>$whatTime</td><td><form action='myEvents.php' method='get'><button type='submit' name='id' value='$id'> Delete from my Events </button>
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
<title>$title</title>
</head>
<body>
</div>
$body
</body>
</html>
EOT;

return $html; 
}


  ?>