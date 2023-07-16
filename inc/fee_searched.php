<?php
include 'config.php';

$stext = strtolower($_POST['stext']);

$sql = "SELECT * FROM fee WHERE name = '$stext' ";
$result_query = mysqli_query($connect, $sql);
$conservation = "";

// Check if there are matching rows
if (mysqli_num_rows($result_query) > 0) {
    $conservation = " <h2>Searched Results</h2>
    <table class='table'>
   <thead>
   <tr>
       <th scope='col'>#ID</th> 
       <th scope='col'>Name</th>
       <th scope='col'>Scholarship Amount</th>
   </tr>
</thead>
</div>
<tbody>
";
    while ($row = mysqli_fetch_assoc($result_query)) {

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

} else {
    echo "No records found.";
}

echo $conservation;
?>