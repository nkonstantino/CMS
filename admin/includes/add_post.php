<?php
    if(isset($_POST['create_post'])){
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags, post_status) ";
        $query .= "VALUES({$post_category},'{$post_title}','{$post_author}', now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' ) ";
        
        $create_post_query = mysqli_query($connection, $query);
        
        confirm($create_post_query);
        echo "<h2>Post added</h2>";
    }

?>
   

   
<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="post_title">Title</label><br>
        <input type="text" class="form_control" name="post_title">
    </div>
    
    <div class="form-group">
        <label for="post_category">Category</label><br>
        <select name="post_category" id="">            
        <?php 
            
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query); 

        confirm($select_categories);

        while($row = mysqli_fetch_assoc($select_categories)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<option value={$cat_id}>{$cat_title}</option>";
        }


        ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_author">Author</label><br>
        <input type="text" class="form_control" name="post_author">
    </div>
    
    <div class="form-group">
        <label for="post_status">Status</label><br>
        <input type="text" class="form_control" name="post_status">
    </div>
    
    <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file" class="form_control" name="post_image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Tags</label><br>
        <input type="text" class="form_control" name="post_tags">
    </div>
    
    <div class="form-group">
        <label for="post_content">Content</label><br>
        <textarea class="form_control" name="post_content" id="" cols="50" rows="10"></textarea>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
    
</form>