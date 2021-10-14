<?php
// Headers
header('Access-Control-Allow-Origin: *'); // completely public api line
header('Content-Type: application/json');
// more headers needed for a post request
header('Access-Control-Allow-Methods: DELETE');
// X-Requested-With helps with cross site scripting attacks
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog user object
$user = new User($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to be updated 
$user->ID = $data->ID;


// Delete user
if($user->delete()) {
    echo json_encode(
        array('message' => 'User Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'User Not Deleted')
    );
}
