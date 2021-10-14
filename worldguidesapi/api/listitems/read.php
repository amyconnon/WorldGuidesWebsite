<?php
// Headers
header('Access-Control-Allow-Origin: *'); // completely public api line
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/ListItems.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate site object
$lists = new ListItems($db);

// list query
$result = $lists->read();

// Get row count
$num = $result->rowCount();

//check if any lists
if($num > 0) {

    // Site array
    $list_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $list_item = array(
            'ID' => $ID,
            'ListNameID' => $ListNameID,
            'SiteID' => $SiteID,
            'SiteName' => $SiteName

        );
        array_push($list_arr,$list_item);

    }

    // Turn to JSON & output
    echo json_encode($list_arr);
} else {
    // No lists
    echo json_encode(
        array('message' => 'No Sites Found')
    );



}


?>