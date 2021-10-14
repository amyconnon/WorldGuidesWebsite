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
$listitems = new ListItems($db);

// Get ID
$listitems->ID = isset($_GET['ID']) ? $_GET['ID'] : die();

// Get site
$listitems->read_single();

// Create array
$list_arr = array(

    'ID' => $listitems->ID,
    'ListNameID' => $listitems->ListNameID,
    'SiteID' => $listitems->SiteID,
    'SiteName' => $listitems->SiteName

);

// Make JSON
print_r(json_encode($list_arr));

?>