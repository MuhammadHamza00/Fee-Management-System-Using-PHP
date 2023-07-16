<?php
include 'config.php';

$s_prog_id= $_POST['s_prog_id'];
$amount= $_POST['amount'];


$sql = "UPDATE fee SET percentage = $amount WHERE f_id= '$s_prog_id';
";

$result = mysqli_query($connect, $sql);

if ($result) {
    // echo "Data Updated Successfully!";
echo "Data Updated Successfully!";
}
else{
echo "Unknown Error Occur!";

}
