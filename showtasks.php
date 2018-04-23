<?php

// http://php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc
// http://php.net/manual/en/control-structures.foreach.php
// http://php.net/manual/en/language.operators.string.php
// https://www.w3schools.com/php/php_arrays.asp
// http://php.net/manual/en/language.types.array.php
// http://php.net/manual/en/function.array-push.php
// http://kb.ifastnet.com/index.php?/article/AA-00207/34/Free-Hosting/Page-errors-Misc/blank-white-page-500-error.html
// https://www.w3schools.com/html/html_tables.asp

// 1. connect to DBMS
$servername = "sql109.epizy.com";
$username = "epiz_20658894";
$password = "54wktcu1jq";
$dbname = "epiz_20658894_taskdemo"; //'taskdemo' = name of database to allow access

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection for connect error
if ($conn->connect_error) {
    die("<p>Connection failed: " . $conn->connect_error . "</p>");
} // . = concatened

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
//row from fetch_assoc gets assigned to $row
	$tasks = array();
	while($row = $result->fetch_assoc()) {
        array_push($tasks, $row);
    }
    //tasks is an array, inside that array are rows. each of the rows is an array but an associative array instead
    $taskTableHTML = generateTaskTableHTML($tasks);
    print generatePageHTML($taskTableHTML);
}

function generateTaskTableHTML($tasks) {
	$html = "<table>\n";
	$html .= "<tr><th>ID</th><th>Title</th><th>Description</th></tr>\n";
	
	foreach ($tasks as $task) {
		$html .= "<tr><td>{$task['id']}</td><td>{$task['title']}</td><td>{$task['description']}</td></tr>\n";
	}
	$html .= "</table>\n";
	
	return $html;
}

function generatePageHTML($body) {
	$html = <<<EOT
<!DOCTYPE html>
<html>
<head>
<title>Tasks</title>
</head>
<body>
$body
</body>
</html>
EOT;

	return $html;
}

?>
