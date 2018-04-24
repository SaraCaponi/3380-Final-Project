<?php

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
    	print generatePageHTML("Events", generateTaskTableHTML($events));
    }
}

function generateTaskTableHTML($events) {
	$html = "<table>\n";
	$html .= "<tr><th>Organization</th><th>Event</th><th>Description</th><th>Location</th><th>Time</th></tr>\n";
	
	foreach ($events as $event) {
		$html .= "<tr><td>{$event['organization']}</td><td>{$event['event']}</td><td>{$event['description']}</td><td>{$event['location']}</td><td>{$event['whatTime']}</td></tr>\n";
	}
	$html .= "</table>\n";
	
	return $html;
}
function presentEventForm() {
		$html = <<<EOT
<!DOCTYPE html>
<html>
<head>
<title>Mizzou Calendar</title>
<link rel="stylesheet" type="text/css" href="calendar.css">
</head>
<body>
<h1>Events</h1>
<form action="fallSemester.php" method="post">
  <input type="hidden" name="action" value="add" />
  
  <p>Organization<br />
  <input type="text" name="org" value="" placeholder="Enter the organization that is hosting the event" maxlength="255" size="80">
  </p>

  <p>Event Title<br />
  <input type="text" name="title" value="" placeholder="Event Title" maxlength="255" size="80"></p>

  <p>Description<br />
  <textarea name="description" rows="6" cols="80" placeholder="description"></textarea></p>
  
  <p>Location<br />
  <input type="text" name="location" value="" placeholder="Location" maxlength="255" size="80"></p>
  
  <p>Date and Time<br />
  <input type="text" name="when" value="" placeholder="Date and Time" maxlength="255" size="80"></p>
  
  
  <input type="submit" value="Submit">
</form>
</body>
</html>
EOT;

		print $html;
	}
function generatePageHTML($title, $body) {
	$html = <<<EOT
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="calender.css">
<title>$title</title>
</head>
<body>
<button onclick="location.href='FinalProject.html'"> Home </button>
<h1>Fall Events</h1>
$body
</body>
</html>
EOT;

	return $html;
}
?>