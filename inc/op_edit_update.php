<?php
include 'config.php';

$s_prog_id= $_POST['s_prog_id'];
$name= $_POST['name'];
$key= $_POST['key2'];



$sql = "UPDATE management SET name = '$name', `skey` = '$key' WHERE id = '$s_prog_id' ";

$result = mysqli_query($connect, $sql);

if ($result) {
    // echo "Data Updated Successfully!";
echo "Data Updated Successfully!";
}
else{
echo "Unknown Error Occur!";

}
