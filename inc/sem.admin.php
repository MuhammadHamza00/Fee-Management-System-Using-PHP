<?php
include 'config.php';

$prog = $_POST['value'];

$sql = "SELECT p_id FROM programs WHERE p_name = '$prog'";

$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $prog_id = $row['p_id'];
}
echo $prog_id;

?>