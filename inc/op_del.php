<?php
include 'config.php';


$id = $_GET['id'];

$sql = "DELETE FROM management WHERE id = $id";
if (!mysqli_query($connect, $sql)) {
    echo "Error" . mysqli_error($connect);
}

// After delete redirect to Home, so that latest user list will be displayed.
header("Location: ../operator.admin.php");
?>
