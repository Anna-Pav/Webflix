<?php
	include ( 'includes/header.php' ) ;
    require ('includes/config.php'); 

 $user = new user($con, $userLoggedIn);
 $user->setIsSubscribed(0);
 echo '
 
        <div class="cancellationMessage">
          <h1 style="text-align:center;">You have cancelled your subscription</h1>
         <p style="text-align:center;">Your Premium Plan is de-activated</p>
          <p style="text-align:center;"><a href="profile.php">Return to your Account</a></p>
		</div>

          '; 
?>