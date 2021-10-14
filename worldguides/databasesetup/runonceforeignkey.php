<?php

include("connection.php");

// Setting up forgein keys
$insertCategoryFK = "UPDATE WG_site INNER JOIN WG_category ON WG_site.Category = WG_category.CategoryType SET WG_site.CategoryID = WG_category.ID WHERE WG_site.Category = WG_category.CategoryType"; 
$result = $conn->query($insertCategoryFK);

$insertStateFK = "UPDATE WG_site INNER JOIN WG_state ON WG_site.StateName = WG_state.StateName SET WG_site.StateID = WG_state.ID WHERE WG_site.StateName = WG_state.StateName";
$result = $conn->query($insertStateFK);

$insertRegionFK = "UPDATE WG_site INNER JOIN WG_region ON WG_site.Region = WG_region.RegionName SET WG_site.RegionID = WG_region.ID WHERE  WG_site.Region = WG_region.RegionName";
$result = $conn->query($insertRegionFK);

$insertYearFK = "UPDATE WG_site INNER JOIN WG_year ON WG_site.YearDate = WG_year.YearInscribed SET WG_site.YearID = WG_year.ID WHERE WG_site.YearDate = WG_year.YearInscribed";
$result = $conn->query($insertYearFK);

$insertIsoFK = "UPDATE WG_site INNER JOIN WG_iso ON WG_site.Iso = WG_iso.IsoCode SET WG_site.IsoID = WG_iso.ID WHERE  WG_site.Iso = WG_iso.IsoCode";
$result = $conn->query($insertIsoFK);

$insertDangerFK = "UPDATE WG_site INNER JOIN WG_danger ON WG_site.Danger = WG_danger.DangerStatus SET WG_site.DangerID = WG_danger.ID WHERE  WG_site.Danger = WG_danger.DangerStatus";
$result = $conn->query($insertDangerFK);

?>