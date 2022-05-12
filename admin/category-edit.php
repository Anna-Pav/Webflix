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
                        <h4>Edit Category
                        <a href="category-view.php" class="btn btn-primary float-end">View Category</a>
                        </h4>
                            
                    </div>
                    <div class="card-body">

                    <?php
                    if(isset($_GET['id']))
                    {
                        $category_id = $_GET['id'];
                        $category_edit = "SELECT * FROM categories WHERE id='$category_id'";
                        $category_run = mysqli_query($con, $category_edit);

                        if(mysqli_num_rows($category_run)>0)
                        {
                            $row = mysqli_fetch_array($category_run);
                            ?>


                            <form action="update.php" method="POST">
                               
                               <div class="row">
                                   <div class="col-md-12 mb-3">
                                       <label for="">Category ID</label>
                                       <input type="text" name="id" value="<?= $row['id'] ?>" class="form-control" readonly>
                                   </div>

                                   <div class="col-md-12 mb-3">
                                       <label for="">Category Name</label>
                                       <input type="text" name="name" value="<?= $row['name'] ?>" class="form-control">
                                   </div>

                                   <div class="col-md-12 mb-3">
                                       <button type="submit" name="category_update" class="btn btn-primary">Update Category</button>
                                   </div>
                               </div>
                           </form>

                           <?php
                        }
                        else
                        {
                            ?>
                            <h4>No Record Found</h4>
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