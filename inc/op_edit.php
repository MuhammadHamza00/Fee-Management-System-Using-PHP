<?php
include 'config.php';

$id = $_POST['id'];
$sql = "SELECT * FROM management WHERE id = $id";

$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $key = $row['skey'];
    $dep_id = $row['dep_id'];
}

$sql2 = "SELECT *FROM departments WHERE dep_id = $dep_id";
$result2 = mysqli_query($connect, $sql2);
if (mysqli_num_rows($result2) > 0) {
    $row = mysqli_fetch_assoc($result2);
    $dep_name = $row['name'];
}

$sent = "";
$sent .= "

<div class='container'id='up_form'>
<input type='hidden' name='progid'id='prog_id'value='$id'>

<div class='row'>


<div class='form-floating mb-3'>
    <input type='text' class='form-control' id='floatingInputDisabled' value='$dep_name' disabled>
    <label for='floatingInputDisabled'>Name</label>
</div>

</div>

<div class='row'>

<div class='mb-3 '>
<label for='recipient-name' class='col-form-label'>Name</label>
<input type='text' name='amount' class='form-control' id='name' placeholder='$name'>
</div>

<div class='mb-3 '>
<label for='recipient-name' class='col-form-label'>Key</label>
<input type='text' name='key' class='form-control' id='key2' placeholder='$key'>
</div>




<div class='modal-footer'>
<button type='button'id='close-btn' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
<button type='submit' id='submitdata2' class='btn btn-primary'>Save Data</button>
</div>

</div>
";

echo $sent;
?>