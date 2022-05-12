<?php

include_once('connection.php');
include('includesAdmin/header.php');

?>

<div class="container-fluid px-4">
		<h4 class="mt-4">VIEW MOVIES / TV SHOWS</h4>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item">Entities</li>
		</ol>
		<div class="row">
            <div class="col-md-12">
            <?php include('updateMessage.php'); ?>

                <div class="card">
                    <div class="card-header">
                        <h4>Movies / TV Shows</h4>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                               <table class="table table-bordered table-stripe">
                                   <thead>
                                       <tr>
                                           <th>ID</th>
                                           <th>Title</th>
                                           <th>Summary</th>
                                           <th>Filepath</th>
                                           <th>Type</th>
                                           <th>Release Date</th>
                                           <th>Duration</th>
                                           <th>Season</th>
                                           <th>Episode</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <?php
                                            $movies = "SELECT * FROM videos";
                                            $movies_run = mysqli_query($con, $movies);

                                            if(mysqli_num_rows($movies_run)>0)
                                            {
                                                while ( $movie = mysqli_fetch_array( $movies_run, MYSQLI_ASSOC ))
                                                {
                                                    ?>

                                                    <tr>
                                                        <td><?=$movie['id']?></td>
                                                        <td><?=$movie['title']?></td>
                                                        <td><?=$movie['description']?></td>
                                                        <td><?=$movie['filePath']?></td>
                                                        <td>
                                                        <?php
                                                            if ($movie['isMovie']== '1'){
                                                                echo 'Movie';
                                                            } elseif($movie['isMovie']== '0'){
                                                                echo 'TV Show';
                                                            }
                                                        ?>
                                                        </td>
                                                        <td><?=$movie['releaseDate']?></td>
                                                        <td><?=$movie['duration']?></td>
                                                        <td><?=$movie['season']?></td>
                                                        <td><?=$movie['episode']?></td>
                                                        <td>
                                                            <a href="movie-edit.php?id=<?= $movie['id'] ?>" class="btn btn-success">Edit</a>
                                                        </td>
                                                        <td>
                                                        <form action="update.php" method="POST">
                                                          <button type="submit" name="post_delete_btn" value="<?= $movie['id'] ?>" class="btn btn-danger">Delete</button>
                                                          </form>
                                                        </td>
                                                   </tr>

                                                   <?php
                                                }        
                                            }
                                            else
                                            {
                                                ?>
                                                     <tr>
                                                        <td colspan = "9">No Records Found</td>
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