<?php
require("includes/config.php");
require_once("includes/classes/previewProvider.php");
require_once("includes/classes/Entity.php");
require_once("includes/classes/categoryContainers.php");
require_once("includes/classes/entityProvider.php");
require_once("includes/classes/errorMessage.php");
require_once("includes/classes/seasonProvider.php");
require_once("includes/classes/season.php");
require_once("includes/classes/video.php");
require_once("includes/classes/videoProvider.php");
require_once("includes/classes/user.php");

if(!isset($_SESSION["userLoggedIn"])){
   header("Location:register.php");
}

$userLoggedIn = $_SESSION["userLoggedIn"];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Webflix</title>
        
        <link rel="stylesheet" type="text/css" href="myStyle.css">

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/14421b335c.js" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
      
    <body>

        <div class="wrapper">

        <?php

        if(!isset($hideNav)){
            include_once("includes/navBar.php");
        }

        ?>
        <!--  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>-->