<?php            

	include ( 'includes/header.php' ) ;

	# Check form submitted.
	if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
	{
	  # Connect to the database.
	  require ('includes/config.php'); 
	  
	  # Initialize an error array.
	  $errors = array();

	  # Check for a card number.
	  if (empty( $_POST[ 'card_number' ] ) )
	  { $errors[] = 'Enter your card_number.' ; }
	  else
	  { $card_number = mysqli_real_escape_string( $con, trim( $_POST[ 'card_number' ] ) ) ; }
	  
	  # Check for expiry month.
	  if (empty( $_POST[ 'exp_month' ] ) )
	  { $errors[] = 'Enter card expiry month.' ; }
	  else
	  { $exp_m = mysqli_real_escape_string( $con, trim( $_POST[ 'exp_month' ] ) ) ; }
	  
	  
	  # Check for a expiry year.
	  if (empty( $_POST[ 'exp_year' ] ) )
	  { $errors[] = 'Enter your expiry year.' ; }
	  else
	  { $exp_y = mysqli_real_escape_string( $con, trim( $_POST[ 'exp_year' ] ) ) ; }

    	# Check for a security.
	  if (empty( $_POST[ 'cvv' ] ) )
	  { $errors[] = 'Enter your security on back of card.' ; }
	  else
	  { $cvv = mysqli_real_escape_string( $con, trim( $_POST[ 'cvv' ] ) ) ; }


	  # On success register user inserting into 'users' database table.
	  if ( empty( $errors ) ) 
	  {
      $user = new user($con, $userLoggedIn);
      $user->setIsSubscribed(1);
 echo '<div class="subscribedMessage">
          <h1 style="text-align:center;">Thank you!</h1>
         <p style="text-align:center;">Your Premium Plan is activated</p>
          <p style="text-align:center;"><a href="profile.php">Return to your Account</a></p>
		</div>
          '; 
          
      # Close database connection.
      mysqli_close($con); 

      exit();
	  }
	  # Or report errors.
	  else 
	  {
      echo '<h1>Error!</h1><p id="err_msg">The following error(s) occurred:<br>' ;
      foreach ( $errors as $msg )
      { echo " - $msg<br>" ; }
      echo 'Please try again.</p>';
      # Close database connection.
      mysqli_close( $con );
	  }  
	}
?>

<div class="subscribeForm">
	<div class="column">
	
		<div class="header">
                <h3 style="
                font-size:24px;
                font-weight:400;
                margin:0;
                padding-top:16px;
                color:#000;">Premium Plan</h3>
				<h3>&pound9.99/month</h3>
               

            </div>
		<form  method="post">
		
		<input type="text" name="card_number" placeholder="Card Number" size="20" value="<?php if (isset($_POST['card_number'])) echo $_POST['card_number']; ?>" required>
		<input type="text" name="exp_month" placeholder="Expiry Month"  size="20" value="<?php if (isset($_POST['exp_month'])) echo $_POST['exp_month']; ?>" required>
		<input type="text" name="exp_year" placeholder="Expiry Year"  size="20" value="<?php if (isset($_POST['exp_year'])) echo $_POST['exp_year']; ?>" required>
		<input type="text" name="cvv" placeholder="Security Number"  size="20" value="<?php if (isset($_POST['cvv'])) echo $_POST['cvv']; ?>" required>
		<input class="planButton" type="submit" value="Start Plan">
		</form>
	</div>
</div>

