<?php
include 'config.php';



// Check which form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if ($_POST['check'] == "checked") {
    # code...

    // Process the form data

    // Form 1 was submitted
  

    // $input1 = $_POST['form1_input1'];
    // Process Form 1 data
    $depname = $_POST['depname'];
    $program = $_POST['program'];

    $sql = "SELECT * FROM departments WHERE name ='$depname'";
    $depid =0 ;
    $result = mysqli_query($connect, $sql);
    // Handle the query result
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $depid = $row['dep_id'];
        
    }
    $p_id =0;
    $sql = "SELECT * FROM programs WHERE dep_id ='$depid' and p_name = '$program'";
    $result_program = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result_program) > 0) {
        $row = mysqli_fetch_assoc($result_program);
        $p_id = $row['p_id']; 
    }
    $sem = $_POST['sem'];
    $tuition = $_POST['tuition'];
    $bcard = $_POST['bcard'];
    $cfund = $_POST['cfund'];
    $devfund = $_POST['devfund'];
    $efund = $_POST['efund'];
    $tfund = $_POST['tfund'];
    $lfund = $_POST['lfund'];
    $afund = $_POST['afund'];
    
    $total =$bcard+$cfund+$devfund+$efund+$tfund+$lfund+$afund+$tuition;

    $data="Form Submitted Successfully!";
    echo $data;


    $sql = "INSERT INTO `rules` (`id`, `pro_id`, `sem`, `bus`, `com`, `lab`, `tour`, `dev`, `exam`, `tuition`, `admin`, `total`) VALUES ('', '$p_id', '$sem', '$bcard', '$cfund', '$lfund', '$tfund', '$devfund', '$efund', '$tuition', '$afund', '$total')";
    
    $result_query = mysqli_query($connect, $sql);
    // INSERT INTO `rules` (`id`, `pro_id`, `bus`, `com`, `lab`, `tour`, `dev`, `exam`, `tuition`, `admin`, `total`) VALUES (NULL, '1', '100', '200', '100', '0', '100', '100', '8000', '3000', '11600');
  
} elseif (isset($_POST['form2_input1'])) {
    // Form 2 was submitted
    $input1 = $_POST['form2_input1'];
    // Process Form 2 data
    // ...
}
}
?>