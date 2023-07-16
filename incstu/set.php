<?php
session_start();

$u_name = $_POST['u_name'];
$u_roll = $_POST['u_roll'];

$_SESSION['name'] = $u_name; // Set the user's ID
$_SESSION['rollno'] = $u_roll; // Set the username
 // Set the username



header("Location: home.php");
exit;
?>