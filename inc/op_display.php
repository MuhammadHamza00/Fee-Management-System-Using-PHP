<?php
include 'config.php';


$sql = "SELECT *FROM  management";

$result = mysqli_query($connect, $sql) or die("Query Failed");

$conservation = "";
if (mysqli_num_rows($result) > 0) {
    $conservation = " <h2>All Records</h2>
     <table class='table'>
    <thead>
    <tr>
        <th scope='col'>#ID</th> 
        <th scope='col'>Name</th>
        <th scope='col'>Name of Department</th>
        <th scope='col'>Key</th>
        <th scope='col'>Actions</th>
 
    </tr>
</thead>
</div>
<tbody>
";
    while ($row = mysqli_fetch_assoc($result)) {
        $dep_id = $row['dep_id']; 
        $sql2 = "SELECT *FROM departments WHERE dep_id = '$dep_id'";
        $result2 = mysqli_query($connect, $sql2) or die("Query Failed");
        if (mysqli_num_rows($result2)) {
            $row2 = mysqli_fetch_assoc($result2);
            $dep_name = $row2['name'];
        }

        $conservation .= " <tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>$dep_name</td>
        <td>{$row['skey']}</td>
        
        <td id='btns'>
        <button data-id='{$row["id"]}' class='edit-btn' id='e-btn'><i class='bi bi-pencil-square'></i></button>
        <a href='inc/op_del.php?id=$row[id]' class='delete-btn' id='d-btn' data-id='{$row["id"]}'><i class='bi bi-trash3'></i></a>

        </td>
    </tr>'";
    }
    $conservation .= "</tbody></table>";
}
echo $conservation;
?>