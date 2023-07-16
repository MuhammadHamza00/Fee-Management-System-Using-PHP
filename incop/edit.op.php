<?php
include 'config.php';

$id = $_POST['id'];
$sql = "SELECT * FROM students WHERE id = $id";

$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $name = $row['name'];
    $fname = $row['f_name'];
    $session = $row['session'];
    $p_id = $row['p_id'];
    $f_id = $row['f_id'];
    $status = $row['status'];
    $due_date = $row['date'];
    $merit = $row['s_r'];
    $total = $row['total'];
    $rollno = $row['rollno'];
}

 // Get program_id
$prog_id=0;
 $p_name = '';
 $dep_id = 0;
 $depname = '';

 $sql3 = "SELECT * FROM fee WHERE f_id = $f_id";
 $result_fee = mysqli_query($connect, $sql3);
 if (mysqli_num_rows($result_fee) > 0) {
     $row = mysqli_fetch_assoc($result_fee);
     $fee_type = $row['name']; 
     
}


 $sql = "SELECT * FROM programs WHERE p_id = '$p_id'";
 $result_program = mysqli_query($connect, $sql);
 if (mysqli_num_rows($result_program) > 0) {
     $row = mysqli_fetch_assoc($result_program);
     $prog_id = $row['p_id']; 
     $p_name = $row['p_name'];// p_name
     $dep_id = $row['dep_id'];
}

$sql = "SELECT * FROM departments WHERE dep_id = $dep_id";

$result = mysqli_query($connect, $sql);

// Handle the query result
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $depname = $row['name'];//department name
}

$merit_line = "";
if ($merit == 0) {
    $merit_line = "Regular";
}
else{
    $merit_line = "Self";

}

$merit_line = "";
if ($merit == 0) {
    $merit_line = "Regular";
}
else{
    $merit_line = "Self";
}
// Perform the database query to retrieve programs based on phpDepId
// $sql = "SELECT * FROM rules WHERE pro_id = '$prog_id' ";
// $result = mysqli_query($connect, $sql);
// // Handle the query result
// $semArray = array();
// if (mysqli_num_rows($result) > 0) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         // echo "<option>" . $row['sem'] . "</option>";
//         $semArray[] = $row['sem'];
//     }
// } else {
//     // echo "<option>No programs found</option>";
// }

$data = array(
    'name' => $name,
    'fname' => $fname,
    'session' => $session,
    'due_date' => $due_date,
    'total' => $total,
    'rollno' => $rollno,
    'merit_line' => $merit_line,
    'p_name' => $p_name,
    'depname' => $depname,
    'fee_type' => $fee_type,
    'prog_id' => $prog_id

);

// Encode the object as JSON
$jsonData = json_encode($data);

// Set the response header to specify JSON content
header('Content-Type: application/json');

// Send the JSON data as the response
echo $jsonData;

?>

