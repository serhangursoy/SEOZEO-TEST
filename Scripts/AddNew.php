<?php

include('session.php'); // Include our session. This is not required for this project but we are taking it anyway. We want to keep our session for future cases.

// We need Assignment's Data, Date and Title. Let's get it from the corresponding parameters.
$aDATA  = $_GET['data'];
$aDATE  = $_GET['date'];
$aTITLE = $_GET['title'];

// Simple SQL statement to Insert new data to our DB.
$sql = "INSERT INTO user_data (TITLE,CONTENT,DATE,STATUS) VALUES ('$aTITLE', '$aDATA', '$aDATE', '0')";
$res = mysqli_query($db,$sql);

// We are not done. We need to show our user new row. We need last ID for this.
$sql = "SELECT * FROM user_data WHERE ID = (SELECT MAX(ID) FROM user_data);";
$res = mysqli_query($db,$sql);


// Return the id value if it's exist. If response from the server is a failure, we will return 0 indicating that there was an error occured.
if ($res) {
	 $row   = mysqli_fetch_assoc($res);
	 $count = $row['ID'];

	echo ($count);
}
else {
	echo 0;
}
?>