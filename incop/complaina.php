<?php
include "config.php";

$sql = "SELECT *FROM  msgs";

$result = mysqli_query($connect, $sql) or die("Query Failed");

$conservation = "";
if (mysqli_num_rows($result) > 0) {
    $conservation = "
    <h2>All Records</h2> <table class='table'>
    
    <thead>
    <tr>
        <th scope='col'>ID</th> 
        <th scope='col'>Name</th>
        <th scope='col'>Email</th> 
        <th scope='col'>Message</th>
    </tr>
</thead>
</div>
<tbody>
";
    while ($row = mysqli_fetch_assoc($result)) {

        // $id = $row['id'];
        // $name = $row['name'];
        // $email = $row['email'];
        // $msg = $row['msgs'];

        $conservation .= " <tr>
        
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['msg']}</td>

    </tr>'";
    }
    $conservation .= "</tbody></table>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Document</title>
</head>

<body>
    <div class=""style="display:flex;flex-direction:row;">
        <?php include '../static/sidebar.admin.php'?>
        <div class="container table-responsive-sm m-3" id="s-data">
        <?php echo $conservation; ?>
        </div>
    </div>
</body>

</html>