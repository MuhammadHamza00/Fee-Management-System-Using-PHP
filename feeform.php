<?php
include 'config.php';

$searched = "";
$name = "";
$fname = "";
$session = "";
$semester = "";
$date = "";

$bus = "";
$com = "";
$lab = "";
$dev = "";
$tour = "";
$exam = "";
$admin = "";
$tuition = "";
$grand = "";

$status_line = "";
$p_name = "";
$merit_line = "";
$dep_name = "";
$get_name = "";
$main_id = "";

$img = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searched = $_POST['searched'];
    $sql = "SELECT *FROM  students WHERE rollno = '$searched'";

    $result = mysqli_query($connect, $sql) or die("Query Failed");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $cell = $row['p_id'];
        $main_id = $row['id']; //main id
        $cell2 = $row['f_id'];
        $img = $row['img'];
        $merit_chk = $row['s_r'];
        $status = $row['status'];

        $name = $row['name'];
        $fname = $row['f_name'];
        $session = $row['session'];
        $semester = $row['semester'];
        $date = $row['date'];
        $grand = $row['total'];

        $usql = "SELECT *FROM rules WHERE pro_id = '$cell' and sem = '$semester'";
        $resultu = mysqli_query($connect, $usql) or die("Query Failed");
        if (mysqli_num_rows($resultu) > 0) {
            $rowu = mysqli_fetch_assoc($resultu);
            $bus = $rowu['bus'];
            $com = $rowu['com'];
            $lab = $rowu['lab'];
            $tour = $rowu['tour'];
            $dev = $rowu['dev'];
            $exam = $rowu['exam'];
            $admin = $rowu['admin'];
            $total2 = $rowu['total'];
            $tuition = $rowu['tuition'];
        }

        // Get program
        $sql = "SELECT * FROM programs WHERE p_id = '$cell' ";
        $result_query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result_query) > 0) {
            $row1 = mysqli_fetch_assoc($result_query);
            $p_name = $row1['p_name']; //program
            $p_dep = $row1['dep_id'];
        }

        // get department
        $sql2 = "SELECT * FROM departments WHERE dep_id = '$p_dep' ";
        $result_query2 = mysqli_query($connect, $sql2);
        if (mysqli_num_rows($result_query2) > 0) {
            $row2 = mysqli_fetch_assoc($result_query2);
            $dep_name = $row2['name']; //depname
        }

        // get fee type name
        $sql = "SELECT * FROM fee WHERE f_id = '$cell2' ";
        $result_dep = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result_dep) > 0) {
            $row3 = mysqli_fetch_assoc($result_dep);
            $get_f_id = $row3['f_id'];
            $get_name = $row3['name']; //fee name
        }


        $merit_line = "";
        if ($merit_chk == 0) {
            $merit_line = "Regular"; //merit
        } else {
            $merit_line = "Self";
        }

        $status_line = "";
        if ($status == 0) {
            $status_line = "Not Paid"; //status
        } else {
            $status_line = "Paid";
        }
    } else {
        header("Location: home.php");
    }
} else {
    // echo "none";
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<style>
    /* #stu{
    height: 100%;
} */
    #stu2 {
        height: 100%;
        padding: 1rem;
        border-radius: 5rem;
    }

    #sec {
        height: 100vh;

    }

    #stu3 {
        height: 100%;
        padding: 3rem;
        border-radius: 5rem;
    }

    .img1 {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<body>
    <div class="modal fade" id="imgget"style="padding:3rem;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="post"style="padding:3rem;display:flex;justify-content:center;align-items:center;flex-direction:column;" action="img2/insert2.php" enctype="multipart/form-data">
                    <!-- <input type="file" name="file"> <br><br> -->
                    <div class="mb-3">
                        <label for="formFile" class="form-label"></label>
                        <input class="form-control" name="file"type="file" id="formFile">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $main_id ?>"> <br><br>
<!-- <button type="button" class="btn btn-primary">Primary</button> -->
                    <input type="submit"  class="btn btn-primary"name="btn" value="upload">
                </form>

            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
    </div>

    <section style="background-color: #eee;" id="sec">
        <div class="container py-5">
            <div class="row">

                <div class="col-lg-4" id="stu">
                    <div class="card mb-4" id="stu2">
                        <div class="card-body text-center">
                            <img src="img2/<?php echo $img ?> " class="rounded-circle img-fluid" style="width: 150px;">
                            <!-- <img src="img/Favatar_1.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;"> -->
                            <h4 class="my-3"><?php echo $name ?></h4>
                            <div class="d-flex justify-content-center mb-2">

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#imgget">Change Image</button>
                            </div>
                            <div class="spec">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0">Department</p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"><?php echo $dep_name ?></p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Program</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $p_name ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Rollno</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $searched ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Session</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $session ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Merit</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $merit_line ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0">Semester</p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"><?php echo $semester ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0">Fee Type</p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"><?php echo $get_name ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card mb-3" id="stu3">
                        <div class="img1">
                            <img src="img/logonew.jpg" width="100%" alt="" id="">
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Voucher ID</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $main_id ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Due Date</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $date ?></p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Status</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $status_line ?></p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Bus Fee</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $bus ?></p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Computer Fund</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $com ?></p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Lab Fund</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $lab ?></p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Development Fund</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $dev ?></p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Tour Fund</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $tour ?></p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Exam Fund</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $exam ?></p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Admission Fee</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $admin ?></p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Tuition Fee</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $tuition ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Grand Total</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo  $grand ?></p>
                                </div>
                            </div>
                            <hr>

                        </div>
                    </div>


                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>