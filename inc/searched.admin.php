<?php
include 'config.php';

$opt = $_POST['opt'];
$stext = $_POST['stext'];

$all_prog = array(); // Initialize as an empty array
switch ($opt) {
    
    case '1':
        $check = 1;
        $sql = "SELECT * FROM programs WHERE p_name LIKE '{$stext}%'"; 
        $result = mysqli_query($connect,$sql);
        if (mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_assoc($result);
            $all_prog[] = $row['p_id'];
        }
        else{
            $check = 0;
        }
        break;
    case '2':
        $check = 1;
        $sql = "SELECT * FROM departments WHERE name LIKE '{$stext}%'"; 
        $result = mysqli_query($connect,$sql);
        if (mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_assoc($result);
            $dep_id = $row['dep_id'];
        //    echo $dep_id;
        }
        else{
            $check = 0;
        }
        if ($check !=0) {
            $i = 0;
            $sql2 = "SELECT * FROM programs WHERE dep_id = $dep_id";
            $result2 = mysqli_query($connect, $sql2);
            
            if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $value = $row2['p_id'];
                    $all_prog[$i] = $value;
                    $i++;
                }
            }
            else{
                $check = 0;
            }
            break;
            
        }
        break;

    // case '3':

    //     $i = 0;
    //     $sql3 = "SELECT * FROM rules WHERE sem = $stext "; 
    //     $result3 = mysqli_query($connect, $sql3);
        
    //     if (mysqli_num_rows($result3) > 0) {
    //         while ($row3 = mysqli_fetch_assoc($result3)) {
    //             $value = $row3['pro_id'];
    //             $all_prog[$i] = $value;
    //             $i++;
    //         }
    //     }
    //     else{
    //         $check = 0;
    //     }
    //     break;


}

$conservation = "";
$length = count($all_prog);
if($length > 0){
// Example array of numbers
$pro_ids = implode(',', $all_prog); // Convert array to a comma-separated string

$sql4 = "SELECT * FROM rules WHERE pro_id IN ($pro_ids)";
$result4 = mysqli_query($connect, $sql4);

// Check if there are matching rows
if (mysqli_num_rows($result4) > 0) {
    $conservation .= " <h2>Search Results</h2><table class='table'>
    <thead>
    <tr>
        <th scope='col'>#ID</th> 
        <th scope='col'>Program ID</th>
        <th scope='col'>Department Name</th>
        <th scope='col'>Program Name</th>
        <th scope='col'>Semester</th>

        <th scope='col'>Tuition Fee</th>
        <th scope='col'>Bus Fund</th>
        <th scope='col'>Computer Fund</th>
        <th scope='col'>Lab Fund</th>
        <th scope='col'>Tour Fund</th>
        <th scope='col'>Development Fund</th>
        <th scope='col'>Exam Fee</th>
        <th scope='col'>Admission Fee</th>
        <th scope='col'>Total Fee</th>
        <th scope='col'>Actions</th>
    </tr>
</thead>
</div>
<tbody>";
    while ($row = mysqli_fetch_assoc($result4)) {
        
        $cell = $row['pro_id'];
        $sql = "SELECT * FROM programs WHERE p_id = '$cell' ";
        $result_query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result_query) > 0) {
            $row1 = mysqli_fetch_assoc($result_query);
            $p_name = $row1['p_name'];
            $p_dep = $row1['dep_id'];
        }

        $sql = "SELECT * FROM departments WHERE dep_id = '$p_dep' ";
        $result_dep = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result_dep) > 0) {
            $row2 = mysqli_fetch_assoc($result_dep);
            $dep_name = $row2['name'];
        }
        $conservation .= " <tr>
        <td>{$row['id']}</td>
        <td>{$row['pro_id']}
        <td>$dep_name</td>
        <td>$p_name</td>
        <td>{$row['sem']}</td>

        <td>{$row['tuition']}</td>
        <td>{$row['bus']}</td>
        <td>{$row['com']}</td>
        <td>{$row['lab']}</td>
        <td>{$row['tour']}</td>
        <td>{$row['dev']}</td>
        
        <td>{$row['exam']}</td>
        <td>{$row['admin']}</td>
        <td>{$row['total']}</td>
        <td id='btns'>
        <button data-id='{$row["id"]}' class='edit-btn' id='e-btn'><i class='bi bi-pencil-square'></i></button>
        <a href='inc/del.admin.php?id=$row[id]' class='delete-btn' id='d-btn' data-id='{$row["id"]}'><i class='bi bi-trash3'></i></a>

        </td>
    </tr>'";
    }
    $conservation .= "</tbody></table>";

} else {
    echo "No records found.";
}

echo $conservation;


}
?>