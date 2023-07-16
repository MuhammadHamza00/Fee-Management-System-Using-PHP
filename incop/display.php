<?php
include "config.php";

$sql = "SELECT *FROM  students";

$result = mysqli_query($connect, $sql) or die("Query Failed");

$conservation = "";
if (mysqli_num_rows($result) > 0) {
    $conservation = "
    <h2>All Records</h2> <table class='table'>
    
    <thead>
    <tr>
        <th scope='col'>Rollno</th> 
        <th scope='col'>Department Name</th>
        <th scope='col'>Program Name</th>
        <th scope='col'>Name</th> 
        <th scope='col'>Father Name</th> 
        <th scope='col'>Session</th> 
        <th scope='col'>Semester</th> 
        <th scope='col'>Fee Type</th>
        <th scope='col'>Merit</th>
        <th scope='col'>Status</th>
        <th scope='col'>Due Date</th>
        <th scope='col'>Total Fee</th>
        <th scope='col'>Actions</th>
    </tr>
</thead>
</div>
<tbody>
";
    while ($row = mysqli_fetch_assoc($result)) {

        $cell = $row['p_id'];
        $cell2 = $row['f_id'];
        $merit_chk = $row['s_r'];
        $status = $row['status'];
        // $img = $row['img'];



        // Get program
        $sql = "SELECT * FROM programs WHERE p_id = '$cell' ";
        $result_query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result_query) > 0) {
            $row1 = mysqli_fetch_assoc($result_query);
            $p_name = $row1['p_name'];
            $p_dep = $row1['dep_id'];
        }

        // get department
        $sql2 = "SELECT * FROM departments WHERE dep_id = '$p_dep' ";
        $result_query2 = mysqli_query($connect, $sql2);
        if (mysqli_num_rows($result_query2) > 0) {
            $row2 = mysqli_fetch_assoc($result_query2);
            $dep_name = $row2['name'];
        }

        // get fee type name
        $sql = "SELECT * FROM fee WHERE f_id = '$cell2' ";
        $result_dep = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result_dep) > 0) {
            $row3 = mysqli_fetch_assoc($result_dep);
            $get_f_id = $row3['f_id'];
            $get_name = $row3['name'];
        }


        $merit_line="";
        if ($merit_chk == 0) {
            $merit_line = "Regular";
        } else {
            $merit_line = "Self";
        }

        $status_line = "";
        if ($status == 0) {
            $status_line = "Not Paid";
        } else {
            $status_line = "Paid";
        }

        $conservation .= " <tr>
        
        <td>{$row['rollno']}</td>
        <td>$dep_name</td>
        <td>$p_name</td>
        <td>{$row['name']}</td>
        <td>{$row['f_name']}</td>
        <td>{$row['session']}</td>
        <td>{$row['semester']}</td>

        <td>$get_name</td>
        <td> $merit_line</td>
        <td>$status_line</td>
        <td>{$row['date']}</td>
        <td>{$row['total']}</td>

        <td id='btns'>
        
        <button data-id='{$row["id"]}' class='edit-btn' id='e-btn'> <a class='bi bi-pencil-square' data-bs-toggle='modal' data-bs-target='#exampleModal1' data-bs-whatever='@mdo' href='#'></a></button>

        <a href='inc/del.admin.php?id=$row[id]' class='upload bi bi-upload' id='u-btn' style='margin-left:10px;' data-id='{$row["id"]}'></a>
        
        <a href='incop/del.php?id=$row[id]' class='delete-btn' id='d-btn' style='margin-left:10px; data-id='{$row["id"]}'><i class='bi bi-trash3'></i></a>
        
        </td>
    </tr>'";
    }
    $conservation .= "</tbody></table>";
}
echo $conservation;
