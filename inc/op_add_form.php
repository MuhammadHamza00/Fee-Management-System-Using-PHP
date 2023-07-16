<?php
include 'config.php';

$name = strtolower($_POST['name']);
$key = strtolower($_POST['key']);
$dep = $_POST['dep'];


$sql = "SELECT * FROM departments WHERE name  = '$dep'";
$result_query = mysqli_query($connect,$sql);

if (mysqli_num_rows($result_query) > 0) {
    $row1 = mysqli_fetch_assoc($result_query);
    $dep_id = $row1['dep_id'];
}
$sql2 = "INSERT INTO `management` (`id`, `dep_id`, `name`,`skey`) VALUES ('', $dep_id, '$name','$key');";
$result2 = mysqli_query($connect,$sql2);
if (!$result2) {
    echo "Error Occurred!";  
}
else{
    echo "Record Inserted Successfully!";
}

?>