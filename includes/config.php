<?php
ob_start(); // Turns on output buffering
session_start();

date_default_timezone_set("Europe/London");


#connecting to the database 
try {
    $con = new PDO("mysql:dbname=HNDSOFTSA23;host=localhost", "HNDSOFTSA23", "kApZsxHrUm");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
}
?>