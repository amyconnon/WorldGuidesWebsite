<?php

include("assets/header.php");

if(!isset($_SESSION["login"])) {
  header('Location: http://aconnon01.lampt.eeecs.qub.ac.uk/worldguides/signup.php');
  die();
} else if (isset($_SESSION["login"])){
  $usersessionid = $_SESSION["login"];
}

$endpoint1 = "http://aconnon01.lampt.eeecs.qub.ac.uk/worldguidesapi/api/lists/read.php?all";
$result1 = file_get_contents($endpoint1);
$data1 = json_decode($result1, true);

$endpoint2 = "http://aconnon01.lampt.eeecs.qub.ac.uk/worldguidesapi/api/listitems/read.php?all";
$result2 = file_get_contents($endpoint2);
$data2 = json_decode($result2, true);

$listmade = false;

foreach($data1 as $row){
    $searchuserID = $row['UserID'];

    if($searchuserID === $usersessionid) {
      $listID = $row['ID'];
      $listname = $row['ListName'];

      // if no list, display no lists - go to create list
      if (empty($listID)) {
        echo "no list made";
      }  else {
        $listmade = true;
      }
    }
}

if ($listmade === true) {
echo '
    <ul class="list-group">
      <li class="list-group-item d-flex justify-content-between align-items-center">' . $listname . '<button type="button" class="btn">Edit</button>
     ';
  foreach($data2 as $row){
    if($listID === $row['ListNameID']){
        $listname = $row['ID'];
        $sitename = $row['SiteName'];
        echo '<li class="list-group-item disabled d-flex justify-content-between align-items-center">' . $sitename . '</li>';
    }
  }
  
  echo '<li class="list-group-item d-flex justify-content-end align-items-center">
  <button type="button" class="btn btn-danger">Share</button>
  </li>';

  } else {
    echo '<h1>No lists, create one!</h1>';
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lists</title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/maincss.css">
</head>
<body id="listbody">


</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</html>
