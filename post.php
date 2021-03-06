<?php include "includes/header.php" ?>
<?php include "includes/nav.php" ?>
   

    <!-- Page Content -->
    <div class="container">
<div class="col-md-8">
        <?php
            if(isset($_GET['p_id'])){
                $post_id = $_GET['p_id'];
                
                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$post_id} ";
                $update_views = mysqli_query($connection, $view_query);
                
                $query = "SELECT * FROM posts where post_id = $post_id";
                
        ?>
            <!-- Blog Entries Column -->
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <!-- First Blog Post -->                       
            <?php 
                    
                    $select_all_posts_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                      ?>  

               <div class="row"> 
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

            </div>
<?php }} else{
            header("Location:index.php");   
            }//close loop ?>
            <!-- Blog Sidebar Widgets Column -->
<hr>
        
                <!-- Blog Comments -->
                <?php //ADD COMMENTS
                    if(isset($_POST['create_comment'])){
                        
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_author'];
                        $comment_content = $_POST['comment_content'];
                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){    
                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($post_id, '{$comment_author}', '{$comment_email}','{$comment_content}', 'unapproved', NOW())";
                        
                        $create_comment_query = mysqli_query($connection, $query);
                        if(!$create_comment_query){
                            die('QUERY FAILED' . mysqli_error($connection));
                        }
                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id ";
                        $update_comment_count = mysqli_query($connection, $query);
                        } else {
                        echo "<script>alert('Fill in all comment fields!');</script>";
                        }
                    }
                
                
                
                ?>
                <!-- Comments Form -->
                
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                       
                       <div class="form-group">
                           <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        
                       <div class="form-group">
                           <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                       
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

            <?php //DISPLAY COMMENTS
                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approved' ORDER BY comment_id DESC";
    
                $select_comment_query = mysqli_query($connection, $query);
                if(!$select_comment_query){
                    die('query failed '. mysqli_error($connection));
                }
                while($row = mysqli_fetch_array($select_comment_query)){
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                    
                    ?>
            
                            <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
            
            
            <?php    }
            ?>
               

        
        
        

        </div>
        <!-- /.row -->
<?php 

    include "includes/sidebar.php"; 

?>
        <hr>
<?php 

    include "includes/footer.php"; 

?>