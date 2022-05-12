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
                        <h4>Add Movie
                        <a href="movie-add.php" class="btn btn-primary float-end">Add Movies/TV Shows</a>
                        </h4>
                            
                    </div>
                    <div class="card-body">

                            <form action="update.php" method="POST" enctype="multipart/form-data">
                               <div class="row">
                                   <div class="col-md-12 mb-3">
                                       <label for="">Movie ID</label>
                                       <input type="text" name="id" class="form-control">
                                   </div>

                                   <div class="col-md-12 mb-3">
                                       <label for="">Movie Title</label>
                                       <input type="text" name="title" class="form-control">
                                   </div>

                                   <div class="col-md-12 mb-3">
                                       <label for="">Summary</label>
                                       <input type="text" name="description" class="form-control">
                                   </div>

                                   <div class="col-md-12 mb-3">
                                       <label for="">Filepath</label>
                                       <input type="file" name="filePath" class="form-control">
                                   </div>

                                   <div class="col-md-12 mb-3">
                                       <label for="">Type</label>
                                       <select name="isMovie" required class="form-control">
                                       <option value="">Select Type of Entity</option>
                                            <option value="1" <?=$user['isMovie']== '1' ? 'selected':'' ?> >Movie</option>
                                            <option value="0" <?=$user['isMovie']== '0' ? 'selected':'' ?> >TV Show</option>
                                        </select>
                                   </div>

                                   <div class="col-md-12 mb-3">
                                       <label for="">Release Date</label>
                                       <input type="text" name="releaseDate" class="form-control">
                                   </div>

                                   <div class="col-md-12 mb-3">
                                       <label for="">Duration</label>
                                       <input type="text" name="duration" class="form-control">
                                   </div>

                                   <div class="col-md-12 mb-3">
                                       <label for="">season</label>
                                       <input type="text" name="season" class="form-control">
                                   </div>

                                   <div class="col-md-12 mb-3">
                                       <label for="">Episode</label>
                                       <input type="text" name="episode" class="form-control">
                                    </div>

                                   <div class="col-md-12 mb-3">
                                       <button type="submit" name="movie_add" class="btn btn-primary">Add Movie</button>
                                   </div>
                               </div>
                           </form>

                    </div>
                </div>
            </div>

        </div>
</div>

<?php
include('includesAdmin/footer.php');
include('includesAdmin/scripts.php');

?>