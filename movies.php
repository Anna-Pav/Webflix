<?php
require_once("includes/header.php");

$preview = new PreviewProvider ($con,$userLoggedIn );
echo $preview->createMoviePreviewVideo(null);

$containers = new categoryContainers ($con,$userLoggedIn );
echo $containers->showMovieCategories();
?>