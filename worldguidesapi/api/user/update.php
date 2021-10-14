<?php
// Headers
header('Access-Control-Allow-Origin: *'); // completely public api line
header('Content-Type: application/json');
// more headers needed for a post request
header('Access-Control-Allow-Methods: PUT');
// X-Requested-With helps with cross site scripting attacks
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog post object
$user = new User($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to be updated - we need an id as this is an update
$user->ID = $data->ID;

$user->Username = $data-> Username;
$user->Password = $data-> Password;
$user->AdminStatus = $data-> AdminStatus;

// Update post
if($user->update()) {
    echo json_encode(
        array('message' => 'Post Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Updated')
    );
}

?>