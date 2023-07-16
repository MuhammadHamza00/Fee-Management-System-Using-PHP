<?php
include 'config.php';

$name = "";
$roll = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...
    $name = $_POST['u_name'];
    $roll = $_POST['u_roll'];
    
    $sql = "SELECT *FROM management WHERE name='$name' AND skey='$roll' ";
    
    $result = mysqli_query($connect,$sql);
    if (mysqli_num_rows($result) > 0) {
       echo 0;
    }
    else{
        echo 1;
    }
}
else{
    echo "None";
}
?>