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