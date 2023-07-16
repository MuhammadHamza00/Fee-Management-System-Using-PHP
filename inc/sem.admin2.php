<?php
include 'config.php';


$prog_id = $_GET['prog_id'];

// and programs.p_id not in (SELECT pro_id from rules)

// Perform the database query to retrieve programs based on phpDepId
$sql = "SELECT * FROM rules WHERE pro_id = '$prog_id' ";
// we get all programs that we want to display 
// now we want only programs that id is not in rules
$result = mysqli_query($connect, $sql);


// Handle the query result
$semArray = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // echo "<option>" . $row['sem'] . "</option>";
        $semArray[] = $row['sem'];
    }
} else {
    // echo "<option>No programs found</option>";
}

for ($i = 1; $i <= 8; $i++) {
    if (!in_array($i, $semArray)) {
        echo "<option>" . $i . "</option>";
    }
}
?>