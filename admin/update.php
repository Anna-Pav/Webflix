<?php
session_start();

include_once('connection.php');

//query to delete movie/TV Show
if(isset($_POST['post_delete_btn'])){

    $id = $_POST['post_delete_btn'];

    $check_file_query = "SELECT * FROM videos WHERE id='$id' LIMIT 1";
    $file_res =  mysqli_query($con,$check_file_query);
    $res_data = mysqli_fetch_array($file_res);

    $file = $res_data['filePath'];

    $query = "DELETE FROM videos WHERE id='$id' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
            if(file_exists('../uploads/posts/'.$file)){
                unlink("../uploads/posts/'".$file);
        }
        $_SESSION['message'] = "Movie/TV show deleted Successfully";
        header('Location: movie-view.php');
        exit(0);
    
    }
    else{
        $_SESSION['message'] = "Something went wrong!";
        header('Location: movie-view.php');
        exit(0);
    }
}


//query and message to edit videos
if(isset($_POST['movie_edit'])){

    $video_id = $_POST['id'];
    $title = $_POST['title'];
    $summary = $_POST['description'];
    
    $releaseDate = $_POST['releaseDate'];
    $duration = $_POST['duration'];
    $season = $_POST['season'];
    $episode = $_POST['episode'];

    $old_filename= $_POST['old_file'];
    $filepath = $_FILES['filePath']['name'];

    $update_filename = "";
    if($filepath != NULL){

    //rename the file
        $image_extension = pathinfo($filepath, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_extension;
        $update_filename =  $filename;
    }
    else{
        $update_filename =  $old_filename;
    }

    $type = $_POST['isMovie'] == true ? '1' : '0';

    
    $query = "UPDATE videos SET id='$video_id',title='$title',description='$summary',filePath='$update_filename',isMovie='$type',releaseDate='$releaseDate',
                    duration='$duration',season='$season',episode='$episode' WHERE id='$video_id'";
               

    $query_run = mysqli_query($con, $query);
    
    if($query_run){
        if($filepath != NULL){
            if(file_exists('../uploads/posts/'.$old_filename)){
                unlink("../uploads/posts/".$old_filename);
            }
        move_uploaded_file($_FILES['filePath']['tmp_name'], '../uploads/posts/'.$update_filename);
        }
        $_SESSION['message'] = "Movie/TV show updated Successfully";
        header('Location: movie-edit.php?id='.$video_id);
        exit(0);
    }
    else{
        $_SESSION['message'] = "Something went wrong!";
        header('Location: movie-edit.php?id='.$video_id);
        exit(0);
    }
}

//query and message to add videos
if(isset($_POST['movie_add'])){

    $video_id = $_POST['id'];
    $title = $_POST['title'];
    $summary = $_POST['description'];
    
    $releaseDate = $_POST['releaseDate'];
    $duration = $_POST['duration'];
    $season = $_POST['season'];
    $episode = $_POST['episode'];

    $filepath = $_FILES['filePath']['name'];
    //rename the file
    $image_extension = pathinfo($filepath, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_extension;

    $type = $_POST['isMovie'] == true ? '1' : '0';

    
    $query = "INSERT INTO videos (id,title,description,filePath,isMovie,releaseDate,duration,season,episode)
                VALUES ('$video_id', '$title','$summary','$filename','$type','$releaseDate','$duration','$season','$episode')";

    $query_run = mysqli_query($con, $query);
    
    if($query_run){
        move_uploaded_file($_FILES['filePath']['tmp_name'], '../uploads/posts/'.$filename);
        $_SESSION['message'] = "Movie added Successfully";
        header('Location: movie-view.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = "Something went wrong!";
        header('Location: movie-view.php');
        exit(0);
    }
}

//query and message to delete categories
if(isset($_POST['category_delete'])){

    $category_id = $_POST['category_delete'];
    
    $query = "DELETE FROM categories WHERE id='$category_id'";

    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "Category deleted Successfully";
        header('Location: category-view.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = "Something went wrong!";
        header('Location: category-view.php?');
        exit(0);
    }
}

//query and message to update categories
if(isset($_POST['category_update'])){

    $category_id = $_POST['id'];
    $name = $_POST['name'];
    
    
    $query = "UPDATE categories SET name='$name' 
                WHERE id='$category_id'";

    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "Category updated Successfully";
        header('Location: category-edit.php?id='.$category_id);
        exit(0);
    }
    else{
        $_SESSION['message'] = "Something went wrong!";
        header('Location: category-edit.php?id='.$category_id);
        exit(0);
    }
}

//query and message for adding category
if(isset($_POST['category_add'])){
    $name = $_POST['name'];
    $id = $_POST['id'];

    $query = "INSERT INTO categories (id,name) VALUES ('$id','$name')";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "Category added Successfully";
        header('Location: category-add.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = "Something went wrong!";
        header('Location: category-add.php');
        exit(0);
    }
}

//query and message for deleting user
if(isset($_POST['user_delete'])){
    $user_id = $_POST['user_delete'];
    $query = "DELETE FROM webflix_users WHERE user_id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "User deleted Successfully";
        header('Location: view-users.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = "Something went wrong!";
        header('Location: view-users.php');
        exit(0);
    }
}

//query and Message for updating user
if(isset($_POST['update_user']))
{
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $subscription = $_POST['isSubscribed'];

    $query = "UPDATE webflix_users SET user_id='$user_id', first_name='$first_name', last_name='$last_name', email='$email', isSubscribed='$subscription' 
                WHERE user_id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "User updated Successfully";
        header('Location: view-users.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = "Something went wrong!";
        header('Location: view-users.php');
        exit(0);
    }

}


?>