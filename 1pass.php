<?php 
$salt = "$2y$10&22char22char22char22ch";
$password = "123";
$hashed_pass = crypt($password, $salt);
$unhased_pass = crypt($hashed_pass, $password);

echo $hashed_pass ."<br>";
echo $unhased_pass . "<br>";
?>