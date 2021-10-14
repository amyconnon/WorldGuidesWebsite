<?php
// Headers
header('Access-Control-Allow-Origin: *'); // completely public api line
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Site.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate site object
$site = new Site($db);

// Site query
$result = $site->read();

// Get row count
$num = $result->rowCount();

//check if any sites
if($num > 0) {

    // Site array
    $sites_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $site_item = array(
            'ID' => $ID,
            'UniqueNumber' => $UniqueNumber,
            'SiteName' => $SiteName,
            'SiteDescription' => $SiteDescription,
            'Longitude' => $Longitude,
            'Latitude' => $Latitude,
            'Area' => $Area,
            'CategoryType' => $CategoryType,
            'CategoryID' => $CategoryID,
            'StateName' => $StateName,
            'StateID' => $StateID,
            'RegionName' => $RegionName,
            'RegionID' => $RegionID,
            'YearInscribed' => $YearInscribed,
            'YearID' => $YearID,
            'DangerStatus' => $DangerStatus,
            'DangerID' => $DangerID,
            'IsoCode' => $IsoCode,
            'IsoID' => $IsoID

        );
        array_push($sites_arr,$site_item);

    }

    // Turn to JSON & output
    echo json_encode($sites_arr);
} else {
    // No sites
    echo json_encode(
        array('message' => 'No Sites Found')
    );



}


?>