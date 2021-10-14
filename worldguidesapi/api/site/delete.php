<?php
// Headers
header('Access-Control-Allow-Origin: *'); // completely public api line
header('Content-Type: application/json');
// more headers needed for a post request
header('Access-Control-Allow-Methods: DELETE');
// X-Requested-With helps with cross site scripting attacks
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Site.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog site object
$site = new Site($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to be updated 
$site->ID = $data->ID;


// Delete site
if($site->delete()) {
    echo json_encode(
        array('message' => 'Post Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Deleted')
    );
}
