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
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_id=$_SESSION['userid'];
		 $sql2="UPDATE users SET loggedIn='N' WHERE id='$user_id'";
		  mysqli_query($conn,$sql2);
$URL="http://saracaponi.epizy.com/FinalProject.php";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';		
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
	
		$html .= "<table>\n";
		$html .= "<tr class='rows'><th>Organization</th><th>Event</th><th>Description</th><th>Location</th><th>Time</th><th>actions</th></tr>\n";
	
		foreach ($events as $event) {
			$id = $event['id'];
			$org = $event['organization'];
			$EventTitle = $event['event'];
			$description = ($event['description']) ? $event['description'] : '';
			$location = $event['location'];
			$whatTime=$event['whatTime'];
			
			$html .= "<tr class='info'><td>$org</td><td>$EventTitle</td><td>$description</td><td>$location</td><td>$whatTime</td><td><form action='fallSemester.php' method='get'><button class='button' type='submit' name='id' value='$id'> Add to my Events </button>
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
    <button class="button" onclick="location.href='myEvents.php'">View My Events</button>
    <form action = '' method = 'post''><button class="button" type="submit"> Log Out </button>
</div>    

    <img src="http://mediad.publicbroadcasting.net/p/kcur/files/styles/x_large/public/201407/Mizzou_Jesse.jpg" width:"941.333px" height:"746.665px">
    <h1>Upcoming Events!</h1>

$body
</body>
</html>
EOT;
	return $html;
}
?>