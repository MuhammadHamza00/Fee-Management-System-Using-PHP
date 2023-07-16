 <?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sname = $_POST['sname'];
    $fname = $_POST['fname'];
    $depname = $_POST['depname'];
    $program = $_POST['program'];
    $sem = $_POST['sem'];
    $session = $_POST['session'];
    $merit = $_POST['merit']; // 0 for reg and 1 for self
    $d_date = $_POST['d_date'];
    $status = $_POST['status']; //0 for non-paid 1 for paid
    $f_type = $_POST['f_type'];
   $image = "Null";

    $sql = "SELECT * FROM departments WHERE name = '$depname'";
    $depid = 0;
    $result = mysqli_query($connect, $sql);

    // Handle the query result
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $depid = $row['dep_id'];
    }

    // Get program_id
    $p_id = 0;
    $sql = "SELECT * FROM programs WHERE dep_id = '$depid' AND p_name = '$program'";
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
    $rollno = $program . $r_session .  $f_type . $s_merit ;

    // Insert data into the database
    $sql4 = "INSERT INTO students (name, f_name, semester, img, session, p_id, f_id, status, date, s_r, total,rollno) VALUES ('$sname', '$fname', '$sem', '$image', '$session', '$p_id', '$f_id', '$status', '$d_date', '$merit', '$total_from_rule','$rollno')";
    $result_query4 = mysqli_query($connect, $sql4);
    

    $sql5 = "SELECT * FROM students ORDER BY id DESC LIMIT 1";
    $result_program5 = mysqli_query($connect, $sql5);
    if (mysqli_num_rows($result_program5) > 0) {
        $row5 = mysqli_fetch_assoc($result_program5);
        $get_id = $row5['id']; 
        $rollno2 = $rollno . $get_id;
        $sql = "UPDATE students SET rollno = '$rollno2' WHERE id = $get_id ";
        mysqli_query($connect,$sql);
    }
    if ($result_program5) {
        echo "Data Submitted Succesfully";
    } else {
        echo "Failed to insert data";
    }
}