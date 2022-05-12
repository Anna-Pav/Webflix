<?php
require("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");

    #instance of the class
    $account = New Account($con);

    #if user pressed the submit button
    if(isset($_POST["submitButton"])){
                      
        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        
        #calling the register functions that holds the validation functions
        $success = $account->login($username,$password);

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
                color:#000;">Login</h3>
               

            </div>
            <form method="POST">
                <?php echo $account->getError(Constants::$loginFailed);?>
                <input type="text" name="username" placeholder="Username" required>

                <input type="password" name="password" placeholder="Password" required>

                <input type="submit" name="submitButton" value="Submit" >
                
            </form>

        <a href="register.php" class="signInMessage">New member? Sign up!</a>
        </div>
    </div>
    </body>
</html>