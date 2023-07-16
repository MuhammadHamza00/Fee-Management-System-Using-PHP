<?php
include 'config.php';

$name = "";
$roll = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...
    $name = $_POST['u_name'];
    $roll = $_POST['u_roll'];
    
    $sql = "SELECT *FROM students WHERE name='$name' AND rollno='$roll' ";
    
    $result = mysqli_query($connect,$sql);
    if (mysqli_num_rows($result) > 0) {
        echo "Logged in Successfully";
        $_SESSION['name'] = $name; // Set the user's ID
        $_SESSION['rollno'] = $roll;
        $_SESSION['id'] = $row['id'];
    }
    else{
        echo "Invalid Username or Password!";
    }
}
else{
    echo 1;
}
