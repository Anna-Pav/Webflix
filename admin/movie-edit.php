<?php

include_once('connection.php');
include('includesAdmin/header.php');

?>

    <div class="container-fluid px-4">
        <div class="row mt-4">
            <div class="col-md-12">

            <?php include('updateMessage.php') ?>

                <div class="card">
                    <div class="card-header">
                        <h4>Edit Movie/TV Show
                        <a href="movie-view.php" class="btn btn-primary float-end">View Movies/TV Shows</a>
                        </h4>
                            
                    </div>
                    <div class="card-body">


                        <?php
                            if(isset($_GET['id']))
                            {
                                $entity_id = $_GET['id'];
                                $entity_query = "SELECT * FROM videos WHERE id='$entity_id' LIMIT 1";
                                $entity_query_res = mysqli_query($con, $entity_query);

                                if(mysqli_num_rows($entity_query_res)>0)
                                {
                                    while($row = mysqli_fetch_array($entity_query_res, MYSQLI_ASSOC))
                                    {
                         ?>

                                    <form action="update.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="">Movie ID</label>
                                            <input type="text" name="id" value="<?=$row['id'];?>" class="form-control">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="">Movie Title</label>
                                            <input type="text" name="title" value="<?=$row['title'];?>" class="form-control">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="">Summary</label>
                                            <input type="text" name="description" value="<?=$row['description'];?>" class="form-control">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="">Filepath</label>
                                            <input type="hidden" name="old_file" value="<?=$row['filePath'];?>" />
                                            <input type="file" name="filePath"  class="form-control">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="">Type</label>
                                            <select name="isMovie" required class="form-control">
                                                    <option value="">Select Type</option>
                                                    <option value="1" <?=$row['isMovie']== '1' ? 'selected':'' ?> >Movie</option>
                                                    <option value="0" <?=$row['isMovie']== '0' ? 'selected':'' ?> >TV Show</option>
                                                </select>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="">Release Date</label>
                                            <input type="text" name="releaseDate" value="<?=$row['releaseDate'];?>" class="form-control">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="">Duration</label>
                                            <input type="text" name="duration" value="<?=$row['duration'];?>" class="form-control">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="">season</label>
                                            <input type="text" name="season" value="<?=$row['season'];?>" class="form-control">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="">Episode</label>
                                            <input type="text" name="episode" value="<?=$row['episode'];?>" class="form-control">
                                            </div>

                                        <div class="col-md-12 mb-3">
                                            <button type="submit" name="movie_edit" class="btn btn-primary">Save Changes</button>
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