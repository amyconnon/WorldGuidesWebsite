<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$username="username";

$pw = "password";

$host ="username.lampt.school.uni.ac.uk";

$db = "username";

$conn = new mysqli($host,$username,$pw,$db);

if (!$conn) {
    echo $conn->error;
    die();
} 
