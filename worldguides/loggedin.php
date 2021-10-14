<?php

include("assets/header.php");
$username = $_POST['postedusername'];
$password = $_POST['postedpassword'];

$endpoint = "http://aconnon01.lampt.eeecs.qub.ac.uk/worldguidesapi/api/user/read.php?all";
$result = file_get_contents($endpoint);
$data = json_decode($result, true);

$user_arr = array();
foreach($data as $row){
  $user = $row['Username'];
  array_push($user_arr,$user);

  if($row['Username'] === $username){
    $userpassword = $row['Password'];
    $adminstatus = $row['AdminStatus'];
    $_SESSION["login"] = $row['ID'];
    $sessionid = $_SESSION["login"];
  }
}

if(!in_array($username,$user_arr) || $password !== $userpassword){
    header('Location: http://aconnon01.lampt.eeecs.qub.ac.uk/worldguides/login.php');
} 

if($adminstatus === "1") {
  $buttonmessage = "Update sites";
} else {
  $buttonmessage = "Explore sites";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/maincss.css">
  </head>
  <body>
    <div class="container-fluid">
    
    <table class="table">
    <thead>
    <tr>
      <h1>You are logged in <?php echo $username?>!</h1>
    </tr>
    </thead>
    <tbody>
    <form action='sites.php'>
    <tr>
        <td><input type='submit' value='<?php echo $buttonmessage?>'></td>
    </tr>
    </form>
    </tbody>
</table>


  </div>

  </div>

  </body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>
