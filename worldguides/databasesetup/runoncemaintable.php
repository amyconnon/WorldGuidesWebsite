<?php

include("connection.php");
$file = "whc-sites-2019-.csv";


if(file_exists($file)) {
    $filepath = fopen($file,"r");
    fgetcsv($filepath); // skip first line of headings
    $counter = 0;

    try {

    while(($line = fgetcsv($filepath)) !== FALSE) {

        $uniqueNumber = $line[3];
        $siteName = $line[4];
        $siteDescription = $line[5];
        $longitude = $line[8];
        $latitude = $line[9];
        $area = $line[10];
        $category = $line[0];
        $stateName = $line[1];
        $region = $line[2];
        $yearDate = $line[6];
        $danger = $line[7];
        $iso = $line[11];

        // Below ids are hardcoded for now, will update with sql once FK's are set up
        $categoryID = 1;
        $stateID = 2;
        $regionID = 3;
        $yearID = 4;
        $dangerID = 5;
        $isoID = 6;

        // Checking if any variables are empty,if so assigning any empty values with data
        // Checking if uniqueNumber is empty data, if so assign a random unused unique number
        $uniqueNumberArray [] = $uniqueNumber;
        $resultName = array_unique($uniqueNumberArray);
        if(empty($uniqueNumber)) {
            $counter = 1;
            $uniqueNumber = $counter;
            $counter++;
            if(is_array($uniqueNumber)){
                continue;
            }
        }

        if(empty($siteName)){
            $siteName = "Unknown";
        }

        if(empty($longitude)){
            $longitude = 10.00;
        }

        if(empty($latitude)){
            $latitude = 10.00;
        }

        if(empty($area)) {
            $area = 10.00;
        }
        
        if(empty($category)){
            $category= "Mixed";
        }

        if(empty($state)) {
            $state = "Africa";
        }

        if(empty($region)){
            $region= "Albania";
        }

        if(empty($year)) {
            $year = 2003;
        }

        if(empty($danger)){
            $danger = 0;
        }

        if(empty($iso)){
            $iso = "af";
        }

        $insert = $conn->prepare("INSERT INTO 
        WG_site(UniqueNumber,SiteName,SiteDescription,Longitude,Latitude,Area,
        CategoryID,StateID,RegionID,YearID,DangerID,IsoID,
        Category,StateName,Region,YearDate,Danger,Iso) 
        VALUES 
        (?,?,?,?,?,?,
        ?,?,?,?,?,?,
        ?,?,?,?,?,?)");

        $insert->bind_param('sssdddiiiiiisssiis', $uniqueNumber, $siteName, $siteDescription, $longitude, $latitude, $area,
        $categoryID, $stateID ,$regionID, $yearID, $dangerID, $isoID,
        $category, $stateName, $region, $yearDate, $danger, $iso);

        $insert->execute();

        }
    } catch (Exception $e) {
        echo $conn->error;
       }
    
fclose($filepath);
}

?>