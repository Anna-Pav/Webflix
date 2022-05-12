<?php

include_once('connection.php');
include('includesAdmin/header.php');

?>

<div class="container-fluid px-4">
		<h4 class="mt-4">Registered Users</h4>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item">Users</li>
		</ol>
		<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Users</h4>
                    </div>
                    <div class="card-body">

                    <?php
                    if(isset($_GET['id']))
                    {
                        $user_id = $_GET['id'];
                        $users = "SELECT * FROM webflix_users WHERE user_id='$user_id'";
                        $users_run = mysqli_query($con, $users);

                        if(mysqli_num_rows($users_run)>0)
                        {

                            while ( $user = mysqli_fetch_array( $users_run, MYSQLI_ASSOC ))
                            {
                            ?>

                            <form action="update.php" method="POST">
                               
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="">User ID</label>
                                        <input type="text" name="user_id" value="<?=$user['user_id'];?>" class="form-control" readonly>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="">First Name</label>
                                        <input type="text" name="first_name" value="<?=$user['first_name'];?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="">Last Name</label>
                                        <input type="text" name="last_name" value="<?=$user['last_name'];?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="">Email</label>
                                        <input type="text" name="email" value="<?=$user['email'];?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="">Subscription</label>
                                        <select name="isSubscribed" required class="form-control">
                                            <option value="">Select Membership</option>
                                            <option value="1" <?=$user['isSubscribed']== '1' ? 'selected':'' ?> >Premium</option>
                                            <option value="0" <?=$user['isSubscribed']== '0' ? 'selected':'' ?> >Basic</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <button type="submit" name="update_user" class="btn btn-primary">Update User</button>
                                    </div>
                                </div>
                            </form>

                          <?php

                            
                           }
                          }
                        else
                        {
                            ?>
                            <h4>No Record found</h4>
                            <?php
                        }
                   }   
                        ?>
                    </div>
                </div>
            </div>

        </div>
</div>


<?php
include('includesAdmin/footer.php');
include('includesAdmin/scripts.php');

?>