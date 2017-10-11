<?php

// We will get user's To-Do list and convert it to the proper style.
function getUserToDo ($db) {
	// Dummy variable
	$userAssignments = "";

	// Get all user data. Star indicates all data.
	$sql = "SELECT * FROM user_data";
	$res = mysqli_query($db,$sql);

	// There is still a high possibility that this fails. DB can be empty. So we need to avoid getting any errors.
	if ($res) {
		// Get count.
		$count = mysqli_num_rows($res);

		// Simple for loop with our row count.
		for ($i = 0; $i < $count; $i++){

			// Fetch it every time so we can get our data
			$row = mysqli_fetch_assoc($res);

			// Get title, date, content, status and id.
			$aTitle = $row['TITLE'];
			$aDate  = $row['DATE'];
			$aData  = $row['CONTENT'];
			$aStat  = $row['STATUS'];
			$aID  = $row['ID'];

			// This is a string variable to put inside checkbox. If it was something that checked already, set it accordingly.
			$checkDat = "";
			if($aStat == 1) { $checkDat = "checked"; }

			// Exteremely boring string concatenation with data 
			$userAssignments = $userAssignments."<li class='list-group-item' id='listid".($aID) . "'><div class='row'><div class='col-md-2'>" . $aTitle . "</div><div class='col-md-2'>" . $aDate . "</div><div class='col-md-5'> " . $aData . "</div><div class='col-md-3'><span class='pull-right fixer'>  <label><input type='checkbox' value='' onchange='thisIsDone(this)' ".$checkDat." '>DONE</label><a href='javascript:void(0);' onclick='deleteThis(this)'><i class='fa fa-trash-o' aria-hidden='true'></i></a></span></div></div></li>";
		}
	}

	// Flush obtained data in HTML style.
	echo $userAssignments;
}
?>