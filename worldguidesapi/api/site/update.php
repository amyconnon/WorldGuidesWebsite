<?php
// Headers
header('Access-Control-Allow-Origin: *'); // completely public api line
header('Content-Type: application/json');
// more headers needed for a post request
header('Access-Control-Allow-Methods: PUT');
// X-Requested-With helps with cross site scripting attacks
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Site.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog post object
$site = new Site($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to be updated - we need an id as this is an update
$site->ID = $data->ID;

$site->UniqueNumber = $data-> UniqueNumber;
$site->SiteName = $data-> SiteName;
$site->SiteDescription = $data-> SiteDescription;
$site->Longitude = $data-> Longitude;
$site->Latitude = $data-> Latitude;
$site->Area = $data-> Area;
$site->CategoryID = $data-> CategoryID;
$site->StateID = $data-> StateID;
$site->RegionID = $data-> RegionID;
$site->YearID = $data-> YearID;
$site->DangerID = $data-> DangerID;
$site->IsoID = $data-> IsoID;

// Update site
if($site->update()) {
    echo json_encode(
        array('message' => 'Post Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Updated')
    );
}

?>