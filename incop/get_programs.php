<?php
include 'config.php';

$phpDepId = $_GET['phpDepId'];

// and programs.p_id not in (SELECT pro_id from rules)

// Perform the database query to retrieve programs based on phpDepId
$sql = "SELECT * FROM programs WHERE dep_id = '$phpDepId' ";
// now we want only programs that id is not in rules
$result = mysqli_query($connect, $sql);

// Handle the query result
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option>" . $row['p_name'] . "</option>";
    }
} else {
    echo "<option>No programs found</option>";
}
?>
