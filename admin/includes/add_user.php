<?php
    if(isset($_POST['create_user'])){
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        
        $user_role = $_POST['user_role'];
        $user_date = date('d-m-y');
        
        move_uploaded_file($user_image_temp, "../images/$user_image");
        
        $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);
        
        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];
        $hashed_password = crypt($user_password, $salt);
        
        $query = "INSERT INTO users(user_name,user_password,user_firstname,user_lastname,user_email,user_image,user_role, user_date) ";
        $query .= "VALUES('{$user_name}','{$hashed_password}','{$user_firstname}', '{$user_lastname}','{$user_email}','{$user_image}','{$user_role}','now()' ) ";
        
        $create_user_query = mysqli_query($connection, $query);
        
        confirm($create_user_query);
        echo "<h2>User Created</h2>";
    }

?>
   

   
<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="post_title">Username</label><br>
        <input type="text" class="form_control" name="user_name">
    </div>
    
       <div class="form-group">
        <label for="post_title">Password</label><br>
        <input type="password" class="form_control" name="user_password">
    </div>
    
    <div class="form-group">
        <label for="post_title">First Name</label><br>
        <input type="text" class="form_control" name="user_firstname">
    </div>
    
    <div class="form-group">
        <label for="post_title">Last Name</label><br>
        <input type="text" class="form_control" name="user_lastname">
    </div>
    
    <div class="form-group">
        <label for="post_title">Email</label><br>
        <input type="email" class="form_control" name="user_email">
    </div>
    
<!--
    <div class="form-group">
        <label for="post_category">First Name</label><br>
        <select name="user_firstname" id="">            
        <?php 
            
//        $query = "SELECT * FROM categories";
//        $select_categories = mysqli_query($connection, $query); 
//
//        confirm($select_categories);
//
//        while($row = mysqli_fetch_assoc($select_categories)){
//            $cat_id = $row['cat_id'];
//            $cat_title = $row['cat_title'];
//
//            echo "<option value={$cat_id}>{$cat_title}</option>";
//        }
//

        ?>
        </select>
    </div>
-->
    
    <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file" class="form_control" name="user_image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Role</label><br>
        <select class="form_control" name="user_role">
            <option value="subscriber">Subscriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
    </div>
    
</form>