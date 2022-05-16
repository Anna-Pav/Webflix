<?php
$hideNav = true;
require_once ("includes/header.php");

#if there is no ID display error
if(!isset($_GET["id"])){
    errorMessage::show("No ID passed into page");
}

$user = new User($con, $userLoggedIn);
if(!$user->getIsSubscribed()){
    ErrorMessage::show("You must be subscribed to see this.
                    <a href='profile.php'>Click here to subscribe</a>");
}

$video = new video($con, $_GET["id"]);
$video->incrementViews();

$upNextVideo = videoProvider::getUpNext($con,$video);

?>

<div class="watchContainer">

    <div class="videoControls watchNav">
        <!-- back Button not there lesson 75-77-->
 
    <h1><?php echo $video->getTitle();?></h1>
    

    </div>

    <div class="videoControls upNext" style="display:none;">
        <button onclick="restartVideo();" class="replay">Replay</button>

        <div class="upNextContainer">
            <h2>Up next: </h2>
            <h3><?php echo $upNextVideo->getTitle(); ?></h3>
            <h3><?php echo $upNextVideo->getSeasonAndEpisode(); ?></h3>

            <button class="playNext" onclick="watchVideo(<?php echo $upNextVideo->getId(); ?>)">Play</button>

        </div>

    </div>

    <video controls autoplay onended="showUpNext()">
    <source src='<?php echo $video->getFilePath(); ?>' type="video/mp4">
    </video>
</div>

<script>
       initVideo("<?php echo $video->getId(); ?>", "<?php echo $userLoggedIn; ?>"); 
</script>