<?php
session_start();
if(isset($_SESSION['message']))
{
    ?>
        <div class="alert alert-warning alert-dismissable fade show" role="alert">
            <strong>Important:</strong> <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>


    <?php
    unset($_SESSION['message']);
}


?>