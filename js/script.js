$(document).scroll(function() {
    $(".topBar").toggleClass("scrolled", $(this).scrollTop() > $(".topBar").height());
})

function volumeToggle(button) {
    var muted = $(".previewVideo").prop("muted");
    $(".previewVideo").prop("muted", !muted);

    $(button).find("i").toggleClass("fa-volume-mute");
    $(button).find("i").toggleClass("fa-volume-up");
    
}

function previewEnded(){
    $(".previewVideo").toggle();
    $(".previewImage").toggle();
}

//controls disappear after inactivity while watching video
function startHideTimer(){
    var timeout = null;

    $(document).on("mousemove", function(){
        clearTimeout(timeout);
        $(".watchNav").fadeIn();

        timeout = setTimeout(function(){
            $(".watchNav").fadeOut();
        },2000);
    })
}

function initVideo(){
    startHideTimer();
}

function restartVideo(){
    $("video")[0].currentTime = 0;
    $("video")[0].play();
    $(".upNext").fadeOut();
}
function watchVideo(videoId){
    window.location.href = "watch.php?id="+ videoId;
}

function showUpNext(){
    $(".upNext").fadeIn();
}