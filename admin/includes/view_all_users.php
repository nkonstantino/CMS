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
                        <th>Edit</th>
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

                        echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete {$user_name}?'); \" href='users.php?delete={$user_id}'>Delete</a></td>";
//                        echo "</tr>";
                    }
                    
                    
                    
                    ?>
                </tbody>
            </table>
            
<?php 
if(isset($_GET['delete'])){ //DELETE SELECTED POST
    $user_del_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$user_del_id} ";
    $delete_user_query = mysqli_query($connection, $query);
//    $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = $post_id ";
//    $update_comment_count = mysqli_query($connection, $query);
    header("Location: users.php");
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