<?php

include("assets/header.php");

if(!isset($_SESSION["login"])) {
    header('Location: http://aconnon01.lampt.eeecs.qub.ac.uk/worldguides/signup.php');
    die();
  } else if (isset($_SESSION["login"])){
    $sessionlogin = $_SESSION["login"];
  }

$listname = $_POST['postedlistname'];


  if(empty($listname )) {
    header('Location: http://aconnon01.lampt.eeecs.qub.ac.uk/worldguides/createlist.php');
    $_SESSION["emptylistname"] = 1;
  }

  $endpoint = "http://aconnon01.lampt.eeecs.qub.ac.uk/worldguidesapi/api/lists/read.php?all";
  $result = file_get_contents($endpoint);
  $data = json_decode($result, true);

  // check if list already exists
  $userid_arr = array();
 foreach($data as $row){
   $userid = $row['UserID'];
  array_push($userid_arr,$userid);
 }

 if(in_array($sessionlogin, $userid_arr)) {
  $listexists = 0;
  header('Location: http://aconnon01.lampt.eeecs.qub.ac.uk/worldguides/createlist.php');
  $_SESSION["listexists"] = $row['UserID'];
 } else {
  $listexists = 1;
 }

?>

<script>
if (<?php echo $listexists?> === 1){
    fetch('http://aconnon01.lampt.eeecs.qub.ac.uk/worldguidesapi/api/lists/create.php',{
        method: 'POST',
        headers:{
            'Content-Type': 'application/json',
        },
        body:JSON.stringify({
            ListName:"<?php echo $listname?>",
            UserID:"<?php echo $sessionlogin?>"
        })
    })
    .then((response) => response.json())
    .then((data) => {
        console.log(data);
    })
    .catch((error) => {
        console.log(error);
    }
    );
}
</script>

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

<section>
  <div class ="listbacker">
  <h1 id="listtitle">My Lists</h1>
</div>
</section>



<div class="container-fluid">
    
    <table class="table">
    <thead>
    <tr>
      <h1>You created a list!</h1>
      <h1>View:</h1>
    </tr>
    </thead>
    <tbody>
    <form action='list.php'>
    <tr>
        <td><input type='submit' value='Lists'></td>
    </tr>
    </form>
    </tbody>
</table>
  </div>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</html>
