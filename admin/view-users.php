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
            <?php include('updateMessage.php'); ?>

                <div class="card">
                    <div class="card-header">
                        <h4>Registered Users</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>User ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>email</th>
                                <th>Subscription</th>
                              
                            </thead>
                            <tbody>
                                <?php
                                
                                    $query = "SELECT * FROM webflix_users";

                                    $query_run = mysqli_query($con, $query);
                                  
                                    if(mysqli_num_rows($query_run)>0)
                                    {

                                        while ( $row = mysqli_fetch_array( $query_run, MYSQLI_ASSOC ))
                                        {
                                           
                                            ?>
                                            <tr>
                                                <td><?= $row['user_id']; ?></td>
                                                <td><?= $row['first_name']; ?></td>
                                                <td><?= $row['last_name']; ?></td>
                                                <td><?= $row['email']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['isSubscribed']== '1'){
                                                        echo 'premium';
                                                    } elseif($row['isSubscribed']== '0'){
                                                        echo 'Basic';
                                                    }
                                                    ?>
                                                </td>
                                                <td><a href="edit-user.php?id=<?= $row['user_id']; ?>" class="btn btn-success">Edit</a></td>
                                                <td>
                                                    <form action="update.php" method="POST">
                                                    <button style="background-color:red;" type="submit" name="user_delete" value="<?= $row['user_id']; ?>" class="btn btn-success">Delete</button>
                                                </td>
                                       
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td colspan="4">No record found </td>
                                        </tr>
                                        <?php
                                        
                                    }
                                ?>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
</div>


<?php
include('includesAdmin/footer.php');
include('includesAdmin/scripts.php');

?>