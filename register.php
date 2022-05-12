<?php
require("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");

    #instance of the class
    $account = New Account($con);

        #if user pressed the submit button
        if(isset($_POST["submitButton"])){

            #calling the functions from class "FormSanitizer" and passing the input value
            #re-using them with multiple parameters - OOP
            $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
            $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
            $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
            $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
            $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
            $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
            $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

            #calling the register functions that holds the validation functions
            $success = $account->register($firstName,$lastName,$username,$email,$email2,$password,$password2);

            #if user is registered take them to index.php page 
            if($success){
                $_SESSION["userLoggedIn"] = $username;
                header("Location: index.php");
            }
        }


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Webflix</title>
        <link rel="stylesheet" type="text/css" href="myStyle.css">
    </head>
    <body>

    <!-- Sign in form  -->
    <div class="signInContainer">
        <div class="column">
            <div class="header">
            <img src="images/logo.png" title="logo" alt="Site logo">
                <h3 style="
                font-size:24px;
                font-weight:400;
                margin:0;
                padding-top:16px;
                color:#000;">Sign Up</h3>
               

            </div>
            <form method="POST">

                <?php echo $account->getError(Constants::$firstNameCharacters); ?> 
                <input type="text" name="firstName" placeholder="First name" required>

                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                <input type="text" name="lastName" placeholder="Last name" required>

                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <?php echo $account->getError(Constants::$usernameTaken); ?>
                <input type="text" name="username" placeholder="Username" required>

                <?php echo $account->getError(Constants::$emailsDontMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <input type="email" name="email" placeholder="Email" required>

                <input type="email" name="email2" placeholder="Confirm Email" required>

                <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                <?php echo $account->getError(Constants::$passwordLength); ?>
                <input type="password" name="password" placeholder="Password" required>
          
                <input type="password" name="password2" placeholder="Confirm Password" required>

                <input type="submit" name="submitButton" value="Submit" >
                
            </form>

            <a href="login.php" class="signInMessage">Already a member? Sign in!</a>
        </div>
    </div>
    </body>
</html>