<?php
include 'config.php';

$id = $_POST['id'];
$sql = "SELECT * FROM rules WHERE id = $id";

$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // $dep = $row[''];
    $pro = $row['pro_id'];
    $sem = $row['sem'];
    $bus = $row['bus'];
    $com = $row['com'];
    $lab = $row['lab'];
    $tour = $row['tour'];
    $dev = $row['dev'];
    $exam = $row['exam'];
    $tuition = $row['tuition'];
    $admin = $row['admin'];

}
$p_dep='';
$p_name='';
$dep_name='';

$cell = $pro;
$sql = "SELECT * FROM programs WHERE p_id = '$cell' ";
$result_query = mysqli_query($connect, $sql);
if (mysqli_num_rows($result_query) > 0) {
    $row1 = mysqli_fetch_assoc($result_query);
    $p_name = $row1['p_name'];//p_name
    $p_dep = $row1['dep_id'];
}

$sql = "SELECT * FROM departments WHERE dep_id = '$p_dep' ";
$result_dep = mysqli_query($connect, $sql);
if (mysqli_num_rows($result_dep) > 0) {
    $row2 = mysqli_fetch_assoc($result_dep);
    $dep_name = $row2['name'];//dep_name
}

$sent = "";

$sent .= "

<div class='container'id='up_form'>
<input type='hidden' name='progid'id='prog_id'value='$id'>

<div class='row'>

<div class='form-floating mb-3'>
    <input type='text' class='form-control' id='floatingInputDisabled' value='$dep_name' disabled>
    <label for='floatingInputDisabled'>Department Name Name</label>
    </div>

<div class='form-floating mb-3'>
    <input type='text' class='form-control' id='floatingInputDisabled' value='$p_name' disabled>
    <label for='floatingInputDisabled'>Program Name</label>
</div>


<div class='form-floating mb-3'>
    <input type='text' class='form-control' id='floatingInputDisabled' value='$sem' disabled>
    <label for='floatingInputDisabled'>Semester</label>
</div>

</div>

<div class='row'>
<div class='mb-3 col-md-3'>
<label for='recipient-name' class='col-form-label'>Bus Card</label>
<input type='text' name='bfund' class='form-control' id='bus2' placeholder='$bus'>
</div>

<div class='mb-3 col-md-3'>
<label for='recipient-name' class='col-form-label'>Computer Fund</label>
<input type='text' name='comfund' class='form-control' id='cfund2' placeholder='$com'>
</div>

<div class='mb-3 col-md-3'>
<label for='recipient-name' class='col-form-label'>Development Fund</label>
<input type='text' name='devfund' class='form-control' id='devfund2'placeholder='$dev'>
</div>
</div>

<div class='row'>
<div class='mb-3 col-md-3'>
<label for='recipient-name' class='col-form-label'>Exam Fee</label>
<input type='text' name='efund' class='form-control' id='efund2'placeholder='$exam'>
</div>

<div class='mb-3 col-md-3'>
<label for='recipient-name' class='col-form-label'>Tour Fund</label>
<input type='text' name='tfund' class='form-control' id='tfund2'placeholder='$tour'>
</div>

<div class='mb-3 col-md-3'>
<label for='recipient-name' class='col-form-label'>Lab Fund</label>
<input type='text' name='lfund' class='form-control' id='lfund2'placeholder='$lab'>
</div>
</div>

<div class='row'>
<div class='mb-3 col-md-3'>
<label for='recipient-name' class='col-form-label'>Tuition Fee</label>
<input type='text' name='tuition' class='form-control' id='tuition2'placeholder='$tuition'>
</div>

<div class='mb-3 col-md-3'>
<label for='recipient-name' class='col-form-label'>Admission Fee</label>
<input type='text' name='afund' class='form-control' id='admin2' placeholder='$admin'>
</div>
</div>

<div class='modal-footer'>
<button type='button'id='close-btn' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
<button type='submit' id='submitdata2' class='btn btn-primary'>Save Data</button>
</div>
</div>

";

echo $sent;
?>