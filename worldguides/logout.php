<?php

include("assets/header.php");

if(!isset($_SESSION["login"])) {
  header('Location: http://aconnon01.lampt.eeecs.qub.ac.uk/worldguides/signup.php');
  die();
} else if (isset($_SESSION["login"])){

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
      <h1>Log out:</h1>
    </tr>
    </thead>
    <tbody>
    <form action='loggedout.php'>
    <tr></tr>
    <tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><input type='submit' value='Log out'></td>
    </tr>
    </form>
    </tbody>
</table>


  </div>

  </body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>
