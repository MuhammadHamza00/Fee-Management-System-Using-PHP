<?php
include 'config.php';

$id = $_POST['id'];
$sql = "SELECT * FROM fee WHERE f_id = $id";

$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $amount = $row['percentage'];
}

$sent = "";

$sent .= "

<div class='container'id='up_form'>
<input type='hidden' name='progid'id='prog_id'value='$id'>

<div class='row'>


<div class='form-floating mb-3'>
    <input type='text' class='form-control' id='floatingInputDisabled' value='$name' disabled>
    <label for='floatingInputDisabled'>Name</label>
</div>

</div>

<div class='row'>
<div class='mb-3 '>
<label for='recipient-name' class='col-form-label'>Amount In %</label>
<input type='text' name='amount' class='form-control' id='amount' placeholder='$amount'>
</div>


<div class='modal-footer'>
<button type='button'id='close-btn' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
<button type='submit' id='submitdata2' class='btn btn-primary'>Save Data</button>
</div>
</div>
";

echo $sent;
?>