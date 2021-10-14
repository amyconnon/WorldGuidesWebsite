<?php
// Headers
header('Access-Control-Allow-Origin: *'); // completely public api line
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate site object
$user = new User($db);

// Site query
$result = $user->read();

// Get row count
$num = $result->rowCount();

//check if any sites
if($num > 0) {

    // Site array
    $user_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $user_item = array(
            'ID' => $ID,
            'Username' => $Username,
            'Password' => $Password,
            'AdminStatus' => $AdminStatus,

        );
        array_push($user_arr,$user_item);

    }

    // Turn to JSON & output
    echo json_encode($user_arr);
} else {
    // No sites
    echo json_encode(
        array('message' => 'No Sites Found')
    );



}


?>