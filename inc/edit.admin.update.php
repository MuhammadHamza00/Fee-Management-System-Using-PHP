<?php
include 'config.php';

$s_prog_id= $_POST['s_prog_id'];
$s_bus= $_POST['s_bus'];
$s_com= $_POST['s_com'];
$s_dev= $_POST['s_dev'];
$s_exam= $_POST['s_exam'];
$s_tour= $_POST['s_tour'];
$s_lab= $_POST['s_lab'];
$s_tuition= $_POST['s_tuition'];
$s_admin= $_POST['s_admin'];


$s_total =$s_bus+$s_com+$s_dev+$s_exam+$s_tour+$s_lab+$s_admin+$s_tuition;
// UPDATE Customers

// SET ContactName = 'Alfred Schmidt', City= 'Frankfurt'
// WHERE CustomerID = 1;
$sql = "UPDATE rules
SET bus = $s_bus, com = $s_com, lab = $s_lab, tour = $s_tour, dev = $s_dev, exam = $s_exam, tuition = $s_tuition, admin = $s_admin, total = $s_total
WHERE id=$s_prog_id;
";
$result = mysqli_query($connect, $sql);
if ($result) {
    // echo "Data Updated Successfully!";
echo "Data Updated Successfully!";
}
?>