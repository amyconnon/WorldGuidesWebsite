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

// Get ID
$site->ID = isset($_GET['ID']) ? $_GET['ID'] : die();

// Get site
$site->read_single();

// Create array
$site_arr = array(

    'ID' => $site->ID,
    'UniqueNumber' => $site->UniqueNumber,
    'SiteName' => $site->SiteName,
    'SiteDescription' => $site->SiteDescription,
    'Longitude' => $site->Longitude,
    'Latitude' => $site->Latitude,
    'Area' => $site->Area,
    'CategoryType' => $site->CategoryType,
    'CategoryID' => $site->CategoryID,
    'StateName' => $site->StateName,
    'StateID' => $site->StateID,
    'RegionName' => $site->RegionName,
    'RegionID' => $site->RegionID,
    'YearInscribed' => $site->YearInscribed,
    'YearID' => $site->YearID,
    'DangerStatus' => $site->DangerStatus,
    'DangerID' => $site->DangerID,
    'IsoCode' => $site->IsoCode,
    'IsoID' => $site->IsoID

);

// Make JSON
print_r(json_encode($site_arr));

?>