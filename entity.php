<?php
require_once("includes/header.php");


if(!isset($_GET["id"])){
    errorMessage::show("No ID passed into page");
}
$entityId = $_GET["id"];
$entity = new entity($con,$entityId);

$preview = new PreviewProvider ($con,$userLoggedIn );
echo $preview->createPreviewVideo($entity);

$seasonProvider = new seasonProvider($con, $userLoggedIn);
echo $seasonProvider->create($entity);


?>