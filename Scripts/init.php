<?php

// Define our DB, USERNAME, PASSWORD AND DATABASE NAME.
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'ZeoTest');

 // Connect. After succesfully connected to the DB we will use this variable as our DB indicator.  
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
