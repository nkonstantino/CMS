 <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Date</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                   
                   <?php //SEARCH ALL POSTS FOR INFORMATION
                    $query = "SELECT * FROM users"; 
                    $select_users = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_users)){
                        $user_id = $row['user_id'];
                        $user_name = $row['user_name'];
                        $user_password = $row['user_password'];
                        $user_firstname = $row['user_firstname'];
                        $user_lastname = $row['user_lastname'];
                        $user_email = $row['user_email'];
                        $user_image = $row['user_image'];
                        $user_role = $row['user_role'];
                        $user_date = "04/24/16";//$row['user_date'];
                    
                        echo "<tr>"; 
                        echo "<td>{$user_id}</td>";
                        echo "<td>{$user_name}</td>";
                        echo "<td>{$user_firstname}</td>";
                        echo "<td>{$user_lastname}</td>";
                        echo "<td>{$user_email}</td>";
                        echo "<td>{$user_role}</td>";
                        echo "<td>{$user_date}</td>";
//                        //DISPLAY POST TITLES                        
//                        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
//                        $select_post_id_query = mysqli_query($connection, $query);
//                        while($row = mysqli_fetch_assoc($select_post_id_query)){
//                            $post_id = $row['post_id'];
//                            $post_title = $row['post_title'];
//                            
//                            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
//                        }
//                        
//                        echo "<td>{$comment_date}</td>";
//                        echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                        echo "<td><a href='users.php?edit={$user_id}'>Edit</a></td>";
                        echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
//                        echo "</tr>";
                    }
                    
                    
                    
                    ?>
                </tbody>
            </table>
            
<?php 
if(isset($_GET['delete'])){ //DELETE SELECTED POST
    $comment_del_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$comment_del_id} ";
    $deletequery = mysqli_query($connection, $query);
//    $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = $post_id ";
//    $update_comment_count = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if(isset($_GET['approve'])){ //APPROVE SELECTED POST
    $comment_approve_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status='approved' WHERE comment_id = {$comment_approve_id} ";
    $approvequery = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if(isset($_GET['unapprove'])){ //UNAPPROVE SELECTED POST
    $comment_unapprove_id = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id = {$comment_unapprove_id} ";
    $unapprovequery = mysqli_query($connection, $query);
    header("Location: comments.php");
}

?>