<?php 
include('session.php');// Include our session. This is not required for this project but we are taking it anyway. We want to keep our session for future cases.

// Get ID of the element that we will delete.
$OBJ_ID    = $_GET['id'];

// Simple SQL statement to delete given data from our DB.
$sql = "DELETE FROM user_data WHERE id = '$OBJ_ID';";
$res = mysqli_query($db,$sql);

// Thats all for this. No need to return anything.
?>