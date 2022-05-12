<?php
# Access session.
session_start() ;
include('includes/header.php');


# Open database connection.
    require ( 'includes/config.php' ) ;
	
	if ( isset( $_GET['pass'] ) ) $pass = $_GET['pass'] ;
	
	$sql = "DELETE FROM webflix_users WHERE pass='$pass'";
 if ($con->query($sql) === TRUE) {
      
	   echo '<div class="container">';
			echo '<div class="alert alert-danger" alert-dismissible fade show" role="alert">
					  
					   <div>
					   <h3 style="text-align:center;">Your account is now deleted</h3>
						<h3 style="text-align:center;">Card details safely deleted.</h3>
						</div>
						
				</div>
				<h1 style="text-align:center"> Haste ye back!</h1>' ;		
    } else {
        echo "Error deleting record: " . $con->error;
    }