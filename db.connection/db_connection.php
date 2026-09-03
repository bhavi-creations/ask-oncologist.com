<?php

mysqli_report(MYSQLI_REPORT_OFF);

$servername = "127.0.0.1";

if (
    $_SERVER['SERVER_NAME'] === 'localhost' ||
    $_SERVER['SERVER_NAME'] === '127.0.0.1'
) {

    // Localhost
    $username = "root";
    $password = "";
    $dbname   = "oncologist";

} else {

    // Live Server
    $username = "YOUR_LIVE_DB_USERNAME";
    $password = "YOUR_LIVE_DB_PASSWORD";
    $dbname   = "YOUR_LIVE_DB_NAME";
}

$conn = @new mysqli(
    $servername,
    $username,
    $password,
    $dbname,
    3306
);

if ($conn->connect_errno) {

    // Database unavailable - don't stop entire website
    $conn = null;
}
?>