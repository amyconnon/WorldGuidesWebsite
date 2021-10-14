<?php

include("connection.php");
$file = "whc-sites-2019-.csv";
$categoryName = [];
$stateName = [];
$regionName = [];
$yearDate = [];
$isoCodes = [];
$dangerType = [];


if(file_exists($file)) {
    $filepath = fopen($file,"r");

    try {
    fgetcsv($filepath); // skip first line of headings
    while(($line = fgetcsv($filepath)) !== FALSE) {

        // Checking if any variables are empty,if so assigning any empty values with data
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

        $category = $line[0];
        $categoryName[] = $category;

        $state = $line[1];
        $stateName[] = $state;

        $region = $line[2];
        $regionName[] = $region;

        $year = $line[6];
        $yearDate[] = $year;

        $iso = $line[11];
        $isoCodes [] = $iso;

        $danger = $line[7];
        $dangerType[] = $danger;

    }

    $resultName = array_unique($categoryName);
    echo sizeof($resultName)."<br>";
    print_r($resultName);

    foreach ($resultName as $category) {

        $insert = $conn->prepare("INSERT INTO WG_category(CategoryType) 
                    VALUES (?)");
                    
        $insert->bind_param('s', $category);
        $insert->execute();  
    }

    $resultName = array_unique($stateName);
    echo sizeof($resultName)."<br>";
    print_r($resultName);

    foreach ($resultName as $state) {

        $insert = $conn->prepare("INSERT INTO WG_state(StateName) 
                    VALUES (?)");

        $insert->bind_param('s', $state);
        $insert->execute(); 

    }

    $resultName = array_unique($regionName);
    echo sizeof($resultName)."<br>";
    print_r($resultName);

    foreach ($resultName as $region) {

        $insert = $conn->prepare("INSERT INTO WG_region(RegionName) 
                    VALUES (?)");

        $insert->bind_param('s', $region);
        $insert->execute(); 
    }

    $resultName = array_unique($yearDate);
    echo sizeof($resultName)."<br>";
    print_r($resultName);

    foreach ($resultName as $year) {

        $insert = $conn->prepare("INSERT INTO WG_year(YearInscribed) 
                    VALUES (?)");
        
        $insert->bind_param('i', $year);
        $insert->execute();
    }

    $resultName = array_unique($isoCodes);
    echo sizeof($resultName)."<br>";
    print_r($resultName);

    foreach ($resultName as $iso) {

        $insert = $conn->prepare("INSERT INTO WG_iso(IsoCode) 
                    VALUES (?)");
       
               
       $insert->bind_param('s', $iso);
       $insert->execute();
    }

    $resultName = array_unique($dangerType);
    echo sizeof($resultName)."<br>";
    print_r($resultName);

    foreach ($resultName as $danger) {

        $insert = $conn->prepare("INSERT INTO WG_danger(DangerStatus) 
                    VALUES (?)");
       
                        
        $insert->bind_param('i', $danger);
        $insert->execute();
    }

} catch (Exception $e) {
    echo $conn->error;
}
fclose($filepath);
}

?>