<?php
include("assets/header.php");
include("functions/fileexists.php");

$userid = 0;
if(isset($_SESSION["login"])) {
  $userid = $_SESSION["login"];
  $adddestination = "Added to your list!"; 
  $logedin = 1;
} else {
  $adddestination = "Sign in to add to list";
  $logedin = 0;
}


if(isset($_GET['ID'])) {
  $site  = $_GET['ID'];
  $endpoint1 = "http://aconnon01.lampt.eeecs.qub.ac.uk/worldguidesapi/api/site/readsingle.php?ID=$site";
  $result = file_get_contents($endpoint1);

  $data = json_decode($result, true);

  $sitename = $data['StateName'];
}


$endpoint2 = "http://aconnon01.lampt.eeecs.qub.ac.uk/worldguidesapi/api/lists/read.php?all";
$result2 = file_get_contents($endpoint2);
$data2 = json_decode($result2, true);


foreach($data2 as $row){
  $dbuserid = $row['UserID'];
  if($userid === $dbuserid){
    $listnameID = $row['ID'];
  }
}

$endpoint3 = "http://aconnon01.lampt.eeecs.qub.ac.uk/worldguidesapi/api/user/read.php?all";
$result3 = file_get_contents($endpoint3);
$data3 = json_decode($result3, true);


$adminstatus = "0";
foreach($data3 as $row){
  $userdbID = $row['ID'];

  if($userdbID === $userid){
    $adminstatus = $row['AdminStatus'];
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sites</title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/maincss.css">
  
  
  </head>
<body>


<div class="container-fluid">

<?php

$endpoint2 = "https://en.wikipedia.org/w/api.php?action=query&titles={$sitename}&prop=pageimages&pithumbsize=400&format=json&formatversion=2&pilicense=any";

get_http_response($endpoint2);

if(get_http_response($endpoint2) == 200) {
  $json = file_get_contents($endpoint2);
  
  // Convert to php array
  $img = json_decode($json, true);
} 

if(!empty($img["query"]["pages"][0]["thumbnail"]["source"])){
  $imgpath = $img["query"]["pages"][0]["thumbnail"]["source"];
} else {
  $imgpath = "https://via.placeholder.com/400.png/09f/fff";
}

echo "<img class='img-fluid' src='{$imgpath}' alt='destination'>";

?>




<!-- main start-->
<main>
<div id="attractioninfo">
  <section>
  <h1 style="font-size:6vw;" id="attractionname"><?php echo($data['SiteName']) ?></h1>
    <h3 style="font-size:2.5vw;">Description:</h3>
    <p><?php echo($data['SiteDescription']) ?></p></section>
  </section>

  <section>
    <h3 style="font-size:2.5vw;">Details:</h3>

  <p><strong>Name: </strong><?php echo($data['SiteName']) ?></p>
  <p><strong>State: </strong><?php echo($data['StateName']) ?></p>
  <p><strong>Region: </strong><?php echo($data['RegionName']) ?></p>
  <p><strong>Category: </strong><?php echo($data['CategoryType']) ?></p>
  <p><strong>Danger level: </strong><?php echo($data['DangerStatus']) ?></p>
  <p><strong>Area: </strong><?php echo($data['Area']) ?> hectares</p>
  <p><strong>Date inscribed: </strong><?php echo($data['YearInscribed']) ?></p>
  <p><strong>WH ID number: </strong><?php echo($data['UniqueNumber']) ?></p>
  
  </section>


  <section>
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle float-right" Type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="sendToDatabase()">
        Add
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item"><?php echo $adddestination?></a>
      </div>
    </div>
  </section>
</div> 

<?php
if($adminstatus === "1") {
  echo '
  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle float-right" Type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Delete
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <a class="dropdown-item">Deleted</a>
  </div>
</div>
</section>';
echo '
<div class="dropdown">
<button class="btn btn-secondary dropdown-toggle float-right" Type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Update
</button>
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
<a class="dropdown-item">Updated</a>
</div>
</div>
</section>';
} 
  ?>

<script>
function sendToDatabase() {

    if(<?php echo $logedin?> === 1) {
    fetch('http://aconnon01.lampt.eeecs.qub.ac.uk/worldguidesapi/api/listitems/create.php',{
        method: 'POST',
        headers:{
            'Content-Type': 'application/json',
        },
        body:JSON.stringify({
            ListNameID:"<?php echo $listnameID ?>",
            SiteID:"<?php echo $site?>"
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

};

</script>

</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</html>
