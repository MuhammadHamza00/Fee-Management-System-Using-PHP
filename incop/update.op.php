<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sname = $_POST['sname'];
    $fname = $_POST['fname'];
    $depname = $_POST['depname'];
    $program = $_POST['pname'];
    $sem = $_POST['sem'];
    $session = $_POST['session1'];
    $merit = $_POST['merit']; // 0 for reg and 1 for self
    $d_date = $_POST['d_date'];
    $status = $_POST['status']; //0 for non-paid 1 for paid
    $f_type = $_POST['f_type'];
    $rollno = $_POST['rollno1'];

    $p_id = 0;
    $sql = "SELECT * FROM programs WHERE p_name = '$program'";
    $result_program = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result_program) > 0) {
        $row = mysqli_fetch_assoc($result_program);
        $p_id = $row['p_id']; // This is p_id
    }

    // Get fee constraints
    $f_id = 0;
    $sql2 = "SELECT * FROM fee WHERE name = '$f_type'";
    $result_program2 = mysqli_query($connect, $sql2);
    if (mysqli_num_rows($result_program2) > 0) {
        $row2 = mysqli_fetch_assoc($result_program2);
        $f_id = $row2['f_id']; // This is f_id
        $f_name = $row2['name']; // This is name
        $amount = $row2['percentage']; // This is amount
    }

    // Get total_from_rule
    $total_from_rule = 0;
    $sql3 = "SELECT * FROM rules WHERE sem = $sem AND pro_id = $p_id";
    $result_program3 = mysqli_query($connect, $sql3);
    if (mysqli_num_rows($result_program3) > 0) {
        $row3 = mysqli_fetch_assoc($result_program3);
        $prog_id = $row3['pro_id']; // ID
        $total_from_rule = $row3['total']; // Total
    }

    // Calculate total_from_rule based on merit
    if ($merit == 1) {
        $total_from_rule = $total_from_rule * 2;
    }


    $total_from_rule = $total_from_rule * ($amount / 100);


    $s_merit = "";
    
    // Program + session + sem + ftype + 
    $r_session = substr($session,-2);
    // $r_fee = substr($session,0,2);
    if ($merit == 0) {
        $s_merit = "r";
    }
    else{
        $merit = "s";
    }

    // $rollno = $program . $r_session .  $f_type . $s_merit ;

    // Insert data into the database
    $sql4 = "UPDATE students SET name = '$sname' , f_name ='$fname', semester = $sem, status=$status, date = '$d_date' , total = $total_from_rule where rollno = '$rollno' ";
    $result_query4 = mysqli_query($connect, $sql4);
    

    if ($result_query4) {
        echo  "Data Updated Successfully!";
    } else {
        echo "Failed to insert data";
    }
}