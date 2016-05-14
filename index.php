<?php include "includes/header.php" ?>
<?php include "includes/nav.php" ?>
   

    <!-- Page Content -->
    <div class="container">
<div class="col-md-8">
        

            <!-- Blog Entries Column -->
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <!-- First Blog Post -->                       
            <?php 
                if(isset($_GET['author_id'])){
                    $author_id = $_GET['author_id'];
                    $query = "SELECT * FROM posts WHERE post_author =  '{$author_id}' ";
                    $count_posts_query = "SELECT * FROM posts";
                    $find_count = mysqli_query($connection,$count_posts_query);
                    $post_count = mysqli_num_rows($find_count);
                    
                    $post_count = ceil($post_count / 5);
            }else{
                    $count_posts_query = "SELECT * FROM posts";
                    $find_count = mysqli_query($connection,$count_posts_query);
                    $post_count = mysqli_num_rows($find_count);
                    
                    $post_count = ceil($post_count / 5);
                    
                    $query = "SELECT * FROM posts ";
                }
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    $page_posts = ($page * 5) - 5;
                    $query = $query . "LIMIT $page_posts, 5";
                }else{
                    $page = "1";
                    $query = $query . "LIMIT 0, 5";
                }
                    $select_all_posts_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0, 50)."...";
                        $post_status = $row['post_status'];
                      
                        if($post_status == 'published'){
                            
                            
                            
                            
                        
            ?>  

               <div class="row"> 
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php?author_id=<?php echo $post_author ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            </div>
<?php } } //close loop ?>
            <!-- Blog Sidebar Widgets Column -->

        <hr>
        <ul class="pager">
        <?php 
        for($i=1; $i <= $post_count; $i++){
            if(isset($_GET['author_id'])){
                if($i == $page){
                    echo "<li><a class='active_link' href='index.php?author_id={$author_id}&page={$i}'>{$i}</a></li>";
                }else{
                    echo "<li><a href='index.php?author_id={$author_id}&page={$i}'>{$i}</a></li>";
                }
            }else{
                if($i == $page){
                    echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                }else{
                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                }
            }
        }    
        ?>
        </ul>
        </div>
        <!-- /.row -->
<?php 

    include "includes/sidebar.php"; 

?>

<?php 

    include "includes/footer.php"; 

?>