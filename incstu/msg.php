<?php
include 'config.php';

$name = "";
$email = "";
$msg = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...
    $name = $_POST['u_name'];
    $email = $_POST['u_email'];
    $msg = $_POST['u_msg'];
    $u_id = rand();
    
    $sql = "INSERT INTO `msgs` (`id`, `stu_id`, `name`, `msg`,`email`) VALUES (NULL, '$u_id', '$name', ' $msg ','$email');";
    
    $result = mysqli_query($connect,$sql);
    if ($result) {
        echo "Data Inserted Successfully";
    }
    else{
        echo "Invalid Data!";
    }
}
else{
    echo "None";
}
?>