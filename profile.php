<?php
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");



$detailsMessage = "";
$passwordMessage = "";
$user = new user($con, $userLoggedIn);
if(isset($_POST["saveDetailsButton"])) {
    $account = new Account($con);

    $firstName = FormSanitizer::sanitizeFormString($_POST["first_name"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["last_name"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);

    if($account->updateDetails($firstName, $lastName, $email, $userLoggedIn)) {
      //data updated succesfully
      $detailsMessage = "<div class='alertSuccess'>
                                Details updated successfully!
                            </div>";
    }
    else {
        //data not updated 
        $errorMessage = $account->getFirstError();

        $detailsMessage = "<div class='alertError'>
                                $errorMessage
                            </div>";
    }
}

if(isset($_POST["savePasswordButton"])) {
    $account = new Account($con);

    $oldPassword = FormSanitizer::sanitizeFormPassword($_POST["oldPassword"]);
    $newPassword = FormSanitizer::sanitizeFormPassword($_POST["newPassword"]);
    $newPassword2 = FormSanitizer::sanitizeFormPassword($_POST["newPassword2"]);


    if($account->updatePassword($oldPassword, $newPassword, $newPassword2, $userLoggedIn)) {
      //data updated succesfully
      $passwordMessage = "<div class='alertSuccess'>
                                Password updated successfully!
                            </div>";
    }
    else {
        //data not updated 
        $errorMessage = $account->getFirstError();

        $passwordMessage = "<div class='alertError'>
                                $errorMessage
                            </div>";
    }
}


?>

<div class="settingsContainer column">

    <div class="formSection">

        <form method="POST">
            <h2>User Details</h2>

            <?php
                $user = new User($con, $userLoggedIn);

                $firstName = isset($_POST["first_name"]) ? $_POST["first_name"] : $user->getFirstName(); 
                
                $lastName = isset($_POST["last_name"]) ? $_POST["last_name"] : $user->getLastName(); 
                
                $email = isset($_POST["email"]) ? $_POST["email"] : $user->getEmail(); 
            ?>

            <input type="text" name="first_name" placeholder="First Name" value="<?php echo $firstName; ?>">
            <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $lastName; ?>">
            <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">

            <div class="message">
                <?php echo $detailsMessage; ?>
            </div>

            <input type="submit" name="saveDetailsButton" value="Save">
            

        </form>

    </div>

    <div class="formSection">

        <form method="POST">
            <h2>Update Password</h2>

            <input type="password" name="oldPassword" placeholder="Old Password">
            <input type="password" name="newPassword" placeholder="New Password">
            <input type="password" name="newPassword2" placeholder="Confirm New Password">

            <div class="message">
                <?php echo $passwordMessage; ?>
            </div>

            <input type="submit" name="savePasswordButton" value="Save">
            

        </form>

    </div>

    <div class="formSection">
        <h2>Subscription</h2>

        <div class="message">
            <?php echo $subscriptionMessage; ?>
        </div>

        <?php

        if($user->getIsSubscribed()) {
            echo "<h3>You are subscribed! Cancel <a href='cancel.php'>Here</a>.</h3>";
        }
        else {
            echo "<a href='billing.php'>Subscribe to Webflix</a><p> To enjoy the best movies and TV shows</p>";
        }
        ?>
    </div>

    <div>
        <h2> Delete your Account </h2>
         <h4>Contact <a href="contactForm.html">customerservice@webflix.com</a></h4>
    </div>
</div>
    <!--delete account window-->




