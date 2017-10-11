<?php
include('Scripts/session.php');
include('Scripts/functions.php');
?>

<html lang="en">
<head>
  <title>Zeo To-Do List Manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="CSS/bootstrap_dark.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="JS/jquery.min.js"></script>
  <script src="JS/bootstrap.min.js"></script>
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="CSS/page_style.css">
</head>

<body>

  <!--  Loading Modal. This will be shown when some process going on. For this project, its not that required. -->
  <div class="load" id="loading_modal"> <img style="width: 15%;"  src="img/loading_gif.gif"> </div>

  <!-- Navbar -->
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><img src="img/seozeo.png" style="width: 15%;"/>Zeo To-Do List</a>
      </div>
    </div>
  </nav>

  <!-- Operation field -->
  <div class="container-fluid bg-info text-center" style="padding-left: 100px; padding-right: 100px">
    <div class="form-group">
      <div class="row">
        <div class="col-md-8">
          <label for="aTitle">Title:</label>
          <input type="text" class="form-control" id="aTitle">
        </div>
        <div class="col-md-4">
         <label for="aDate">Deadline:</label>
         <input type="text" class="form-control" id="aDate">
       </div>
     </div>
     <label for="aData">Description:</label>
     <textarea class="form-control" rows="5" id="aData"></textarea>
   </div>
   <button onclick="addNewAssignment()" class="btn btn-default btn-lg">
    <span class="glyphicons glyphicons-chat" ></span> Add New Assignment</button>
  </div>

  <!-- Table Field -->
  <div class="container-fluid bg-to-do ">
    <h3 class="text-center">Your To-Do List</h3>
    <div class="container-fluid">
      <ul class="list-group" id="list">
        <?php getUserToDo($db) ?>
      </ul>
    </div>
  </div>

  <!-- Footer -->
  <footer class="container-fluid bg-2 text-center" style="height: 10px">
    <p>© 2017</p>
  </footer>
</body>


<!-- Yes, I know. I put that to somewhere else and then minimize it but I didn't want to change this "whole" looking structure for the sake of brevity. -->
<script type="text/javascript">
  // Add new assignment to the database and show it to the user
  function addNewAssignment() {
    // Get Loading Modal. Show it to the user. We will close that when we are done with DB
    var loading_image = document.getElementById("loading_modal");
    loading_image.style.display = "inline";

    // Since we already know that our data will come from, we can just look to that element with known id.
    var assignmentdata = document.getElementById("aData").value;
    var assignmentDate = document.getElementById("aDate").value;
    var assignmentTitle= document.getElementById("aTitle").value;

    // AJAX GET. Send data to AddNew.php. Once you are done with adding it to the DB. Add new element without reloading.
    $.ajax({
      type: "GET",
      url: "Scripts/AddNew.php" ,
      data: { "data": assignmentdata, "date": assignmentDate , "title": assignmentTitle },
      success : function(data) { 
        loading_image.style.display = "none";
        var listOfGroups = document.getElementById("list");
        listOfGroups.innerHTML += "<li class='list-group-item' id='listid"+data+"'><div class='row'><div class='col-md-2'>"+assignmentTitle+"</div><div class='col-md-2'>"+assignmentDate+"</div><div class='col-md-5'>"+assignmentdata+"</div><div class='col-md-3'><span class='pull-right fixer'>  <label><input type='checkbox' value='' onchange='thisIsDone(this)'  '>DONE</label><a href='javascript:void(0);' onclick='deleteThis(this)'><i class='fa fa-trash-o' aria-hidden='true'></i></a></span></div></div></li> ";
      }
    });

  }

  // Get clicked checkbox. Change the Status of corresponding object in DB.
  function thisIsDone(objectDone) {
    // Get Loading Modal. Show it to the user. We will close that when we are done with DB
   var loading_image = document.getElementById("loading_modal");
   loading_image.style.display = "inline";

   // Get it's parent's parent's parent's parent's parent :P Why? Because we need actual element while we are getting ID.
   var realObj = objectDone.parentElement.parentElement.parentElement.parentElement.parentElement;

   // Get id attribute. Parse number at the end. Which is the id.
   var idToSetDone = realObj.getAttribute('id');
   var ourId = idToSetDone.match(/\d+$/)[0];

   // Get real status.
   var statusData = false;
   if (objectDone.checked) { statusData = true;}

   // AJAX GET
   $.ajax({
    type: "GET",
    url: "Scripts/StatusChanger.php" ,
    data: { "id": ourId, "status": statusData },
    success : function(returned) { 
      loading_image.style.display = "none";
    }
  });
 }

 function deleteThis(deleteMe) {
  // Get Loading Modal. Show it to the user. We will close that when we are done with DB
  var loading_image = document.getElementById("loading_modal");
   loading_image.style.display = "inline";

   // Get object to delete.
   var realObj = deleteMe.parentElement.parentElement.parentElement.parentElement;

   // Get id.
   var idToSetDone = realObj.getAttribute('id');
   var ourId = idToSetDone.match(/\d+$/)[0];

   // Call PHP, manipulate DB to delete it. Once we are done, remove the element.
   $.ajax({
    type: "GET",
    url: "Scripts/TaskRemover.php" ,
    data: { "id": ourId },
    success : function(returned) { 
      loading_image.style.display = "none";
      realObj.remove();
    }
  });
 }
</script>

</html>


