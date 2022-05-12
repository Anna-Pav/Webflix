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
                        <h4>View Category
                            <a href="category-add.php" class="btn btn-primary float-end">Add Category</a>
                        </h4>
                    </div>
                    <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-stripe">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $category = "SELECT * FROM categories";
                                    $category_run = mysqli_query($con, $category);
            
                                    if(mysqli_num_rows($category_run)>0)
                                    {
                                        while ( $item = mysqli_fetch_array( $category_run, MYSQLI_ASSOC ))
                                        {
            
                                         ?>
                                            <tr>
                                                <td><?= $item['id']?></td>
                                                <td><?= $item['name']?></td>
                                                <td>
                                                    <a href="category-edit.php?id=<?= $item['id'] ?>" class="btn btn-info">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="update.php" method="POST">
                                                        <button type="submit" name="category_delete" value="<?= $item['id'] ?>" class="btn btn-danger">Delete</button>
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
                                                <td colspan="2">No Record Found</td>
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
</div>

<?php
include('includesAdmin/footer.php');
include('includesAdmin/scripts.php');

?>