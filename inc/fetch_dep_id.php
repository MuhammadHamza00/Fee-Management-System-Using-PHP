<?php
include 'config.php';
    // Retrieve the selected option from the AJAX request
    $selectedOption = $_POST['selectedOption'];
    // echo $selectedOption;
    // Perform the database query
    // Modify the database connection and query as per your setup
    $sql = "SELECT dep_id FROM departments WHERE name = '$selectedOption'";
    $result = mysqli_query($connect, $sql);
    // Handle the query result
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $depId = $row['dep_id'];
        // Return the dep_id as the response
        echo $depId;
    } else {
        // If dep_id not found, return an appropriate response
        echo '';
    }
?>
