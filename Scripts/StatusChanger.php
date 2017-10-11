<?php
include('session.php'); // Include our session. This is not required for this project but we are taking it anyway. We want to keep our session for future cases.

// Get id and status data. We could use POST too, but, we don't need it for this project
$idToSet    = $_GET['id'];
$statusData = $_GET['status'];

// This will be our actual Status variable.Default is zero means its not Done yet.
$stat = 0;
// Check our raw status data, if its TRUE, then set our actual status variable to the 1.
if ($statusData == "true") { $stat = 1;}

// Simple SQL query. Update the table if its id is okay.
$sql = "UPDATE user_data SET STATUS = '$stat' WHERE id = '$idToSet';";
$res = mysqli_query($db,$sql);


// That's all.. Nothing to return.
?>