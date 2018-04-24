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

$sql = "SELECT * FROM spring";
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

function generatePageHTML($title, $body) {
	$html = <<<EOT
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="calender.css">
<title>$title</title>
</head>
<body>
$body
</body>
</html>
EOT;

	return $html;
}
?>