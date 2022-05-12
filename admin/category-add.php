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
                        <h4>Add Category
                        <a href="category-view.php" class="btn btn-primary float-end">View Category</a>
                        </h4>
                            
                    </div>
                    <div class="card-body">

                            <form action="update.php" method="POST">
                               
                               <div class="row">
                                   <div class="col-md-12 mb-3">
                                       <label for="">Category ID</label>
                                       <input type="text" name="id" class="form-control">
                                   </div>

                                   <div class="col-md-12 mb-3">
                                       <label for="">Category Name</label>
                                       <input type="text" name="name" class="form-control">
                                   </div>

                                   <div class="col-md-12 mb-3">
                                       <button type="submit" name="category_add" class="btn btn-primary">Add Category</button>
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