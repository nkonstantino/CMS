<?php 

function confirm($result){
        global $connection;    
        if(!$result){
            die("QUERY FAILED! " . mysqli_error($connection));
        }
    
}

function create_categories(){
    global $connection;
    if(isset($_POST['submit'])){
                        $cat_title = $_POST['cat_title'];
                        if($cat_title =="" || empty($cat_title)){
                            
                            echo "This shouldn't be empty.";
                            
                        } else {
                            
                            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";
                            $create_category_query = mysqli_query($connection, $query);
                            
                            if(!$create_category_query){
                                die('Failed to create!');
                            }
                        }
                    }
     
}

function read_categories(){
        global $connection;
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);  
        while($row = mysqli_fetch_assoc($select_categories)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete {$cat_title}?'); \" href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
            echo "</tr>";

        }
}

function update_categories(){
        global $connection;
        if(isset($_GET['edit'])){
        $cat_id = $_GET['edit'];

        include "includes/update_categories.php";
   }
}

function delete_categories(){
        global $connection;
        if(isset($_GET['delete'])){
        $del_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$del_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}



?>