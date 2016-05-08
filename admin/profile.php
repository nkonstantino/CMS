<?php include "includes/header.php" ?>

<div id="wrapper">
<?php
    $query = "SELECT * FROM categories";
    $select_categories_sidebar = mysqli_query($connection, $query);     
?>  
    
    <?php 
    if(isset($_SESSION['username'])){
        $profile_user = $_SESSION['username'];
    }    
    ?>   
    
        <!-- Navigation -->
        <?php include "includes/nav.php" ?>

<div id="page-wrapper">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Nick's Admin
                <small>PHP is cool</small>
            </h1>         
<?php
    $query = "SELECT * FROM users WHERE user_name = '{$profile_user}' "; 
    $select_user_profile = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($select_user_profile)){
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_date = $row['user_date'];
    }            

if(isset($_POST['update_user'])){
    
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
    
    if(empty($user_image)){
        $query = "SELECT * FROM users WHERE user_name = '{$profile_user}' ";
        $select_image = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($select_image)){
            $user_image = $row['user_image'];
        }
    }
    
    $query = "UPDATE users SET user_name = '{$user_name}', user_password = '{$user_password}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_image = '{$user_image}', user_role = '{$user_role}' WHERE user_id = {$user_id} ";
    
    $update_user = mysqli_query($connection, $query);
    
    confirm($update_user);
    
}
?>           
            
<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="post_title">Username</label><br>
        <input value="<?php echo $user_name; ?>" type= "text" class="form_control" name="user_name">
    </div>
    
       <div class="form-group">
        <label for="post_title">Password</label><br>
        <input value="<?php echo $user_password; ?>" type="password" class="form_control" name="user_password">
    </div>
    
    <div class="form-group">
        <label for="post_title">First Name</label><br>
        <input value="<?php echo $user_firstname; ?>" type="text" class="form_control" name="user_firstname">
    </div>
    
    <div class="form-group">
        <label for="post_title">Last Name</label><br>
        <input value="<?php echo $user_lastname; ?>" type="text" class="form_control" name="user_lastname">
    </div>
    
    <div class="form-group">
        <label for="post_title">Email</label><br>
        <input value="<?php echo $user_email; ?>" type="email" class="form_control" name="user_email">
    </div>
    
    <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file" class="form_control" name="user_image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Role</label><br>
        <select class="form_control" name="user_role">            
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php 
            if($user_role == 'admin'){
                echo "<option value='subscriber'>subscriber</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }
            
            
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user" value="Update Profile">
    </div>
    
</form>


        </div><!--col-lg-12-->    
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php" ?>
