<?php

include("assets/header.php");
$search = $_POST['postedsearch'];

$endpoint = "http://aconnon01.lampt.eeecs.qub.ac.uk/worldguidesapi/api/site/read.php?all";

$result = file_get_contents($endpoint);

$data = json_decode($result, true);

if(empty($search)) {
  header('Location: http://aconnon01.lampt.eeecs.qub.ac.uk/worldguides/index.php');
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
      <h1>Search complete!</h1>
      <h1>Please see results for <?php echo $search?>:</h1>
    </tr>
    </thead>
    <?php

    $searchedresults = array();
    foreach($data as $row){
        $searchdes = $row['SiteDescription'];
        $searchname = $row['SiteName'];
        $searchIDs = $row['ID'];

        if(strpos($searchdes, $search) !== false || strpos($searchname, $search) !== false) {
            array_push($searchedresults,$searchIDs);
        }
    }

          $arr_length = count($searchedresults);
    
    ?>

<table class="table striped">
    <?php

    if($arr_length > 0) {
        echo "
        <thead>
        <tr>
            <th>Site name:</th>
            <th>Site description:</th>
            <th>Info:</th>
            <th></th>
        </tr>
        </thead>
        <tbody>";
        foreach($data as $row){
            $searchid = $row['ID'];
            for($loop = 0;$loop < $arr_length; $loop++) {
                if($searchid === $searchedresults[$loop]){
                    echo "<tr>
                    <td>{$row['SiteName']}</td>
                    <td>{$row['SiteDescription']}</td>
                    <td><a href='destination.php?ID={$row["ID"]}' class='button'>Details</a></td>
                </tr>";
                }
            }
        }
    } else {
        echo "No results found";
    }
    
    ?>

 </tbody>
</table>


 </tbody>
</table>
    
</table>


  </div>
<?php
//echo $result;
?>

  </div>

  </body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>
