<?php
include 'config.php';

$name = "";
$roll = "";
$check=0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...
    $name = $_POST['u_name'];
    $roll = $_POST['u_roll'];
    
    $sql = "SELECT *FROM admin WHERE name='$name' AND skey= '$roll' ";
    
    $result = mysqli_query($connect,$sql);
    if (mysqli_num_rows($result) > 0) {
        $check=0;
    }
    else{
    $check=1;
    }
}
else{
    $check=2;
}
echo $check;