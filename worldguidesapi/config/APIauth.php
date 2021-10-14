<?php

if(isset($_GET['akey'])){
    
    $apikey = $_GET['akey'];

    $checkapi = "SELECT * FROM WG_apiauth WHERE APIkey = '$apikey' ";

    $result = $conn->query($checkapi);

    if(!$result){
        echo $conn->error;
    }

    $numofrows = $result->num_rows;

    if($numofrows > 0) {
   
    } else {
        echo 'query parameter has key but not valid key';
    }

} else {
    echo 'invalid request query parameter needed';
}

?>