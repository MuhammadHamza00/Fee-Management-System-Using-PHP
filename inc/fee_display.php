<?php
include 'config.php';


$sql = "SELECT *FROM  fee";

$result = mysqli_query($connect, $sql) or die("Query Failed");

$conservation = "";
if (mysqli_num_rows($result) > 0) {
    $conservation = " <h2>All Records</h2>
     <table class='table'>
    <thead>
    <tr>
        <th scope='col'>#ID</th> 
        <th scope='col'>Name</th>
        <th scope='col'>Scholarship Amount</th>
        <th scope='col'>Actions</th>

    </tr>
</thead>
</div>
<tbody>
";
    while ($row = mysqli_fetch_assoc($result)) {

        $conservation .= " <tr>
        <td>{$row['f_id']}</td>
        <td>{$row['name']}
        <td>{$row['percentage']}</td>

        <td id='btns'>
        <button data-id='{$row["f_id"]}' class='edit-btn' id='e-btn'><i class='bi bi-pencil-square'></i></button>
        <a href='inc/fee_del.php?id=$row[f_id]' class='delete-btn' id='d-btn' data-id='{$row["f_id"]}'><i class='bi bi-trash3'></i></a>

        </td>
    </tr>'";
    }
    $conservation .= "</tbody></table>";
}
echo $conservation;
?>