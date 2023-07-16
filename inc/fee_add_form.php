<?php
include 'config.php';

$name = strtolower($_POST['sch_name']);
$amount = $_POST['sch_per'];

$sql = "SELECT * FROM fee WHERE name = '$name' ";

$result =mysqli_query($connect,$sql);

if(mysqli_num_rows($result)>0) {
    echo "Record Already Present!";
}
else{
    $sql2 = "INSERT INTO `fee` (`f_id`, `name`, `percentage`) VALUES ('', '$name', '$amount');";
    $result2 = mysqli_query($connect,$sql2);
    if (!$result2) {
        echo "Error Occurred!";  
    }
    else{
        echo "Record Inserted Successfully!";
    }
}

?>