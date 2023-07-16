<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Other meta tags, CSS, and title -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Your custom CSS -->

    <!-- jQuery and jQuery Validate scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<?php
// if($_SERVER["REQUEST_METHOD"]=="POST"){

//     $p_images = $_FILES['p_image']['name'];
//     $target = "incop/" .basename($p_images);
//     echo $target;
//     // connection to Database
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $database = "image_upload";

//     $connect2 = mysqli_connect($servername, $username, $password, $database);
//     if (!$connect2) {
//         echo "Unable to Connect with Database".$database;
//     }

//     $sql = "INSERT INTO `gallery` (`id`, `filename`) VALUES (NULL, '$p_images')";

//     mysqli_query($connect2, $sql);

// }
?>

<style>
    .all {
        display: flex;
        flex-direction: row;
    }

    .grow ul li a:hover {
        background-color: #0d6efd;
    }

    .right {
        width: 100%;
    }

    #content {
        font-size: smaller;
    }

    .edit-btn {
        font-size: large;
        padding: 3px;
    }

    .delete-btn {
        margin-left: 20px;
        font-size: large;
    }

    #u-btn {
        margin-right: 13px;
        font-size: 1.1rem;
        margin-top: 4px;

    }

    #btns {
        display: flex;
        flex-direction: row;
        margin-top: 9px;

        /* border: 1px solid red; */
    }

    #e-btn i {
        color: #0d6efd;
        border: none;
        outline: none;
        background-color: white;
    }

    #e-btn {
        border: none;
        outline: none;
        background-color: white;
    }

    #d-btn i {
        color: red;
    }

    .error {
        color: red;
    }

    .addmodel {
        width: 100%;

    }

    .form-alert {
        display: none;
    }

    #edit-msg {
        display: none;
    }

    #s-msg {
        display: none;
    }

    #s-data {
        display: none;
        font-size: smaller;
    }
</style>

<body>

    <!-- <form method="POST" action=""id="frm" enctype="multipart/form-data">
        <div class="col-md-3">
            <label for="Date" class="form-label">Personal Image<span class="text-muted" class="errormsg"></span></label>
            <input type="file" class="form-control" id="pimage" placeholder="" name="p_image" value="">
        </div>
        <button class="w-100 btn btn-primary btn-lg" type="submit"name="submit"id="submit">Register Now</button>
    </form> -->


    <!-- Admin Panel Add Data -->
    <div class="modal fade modal-lg-centered addmodel" class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Entry Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="alert alert-danger alert-dismissible fade show form-alert" role="alert">
                    x
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="addform" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="addform" value="addform" />
                        <div class="mb-3 col">
                            <label for="recipient-name" class="col-form-label">Name </label>
                            <input type="text" name="sname" class="form-control" id="sname">
                        </div>

                        <div class="mb-3 col">
                            <label for="recipient-name" class="col-form-label">Father Name</label>
                            <input type="text" name="fname" class="form-control" id="fname">
                        </div>
                        <div class="mb-3 ">
                            <label for="recipient-name" class="col-form-label">Select Department</label>
                            <!-- <input type="text" id="inputField" name="inputField" placeholder="Enter a value"> -->
                            <select id="dropdown" name="dropdowndep" name="depname" class="form-select">
                                <option selected></option>
                                <?php
                                $sql = "SELECT * FROM departments";
                                $id = null;
                                $result = mysqli_query($connect, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option>" . $row['name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>

                            <script>
                                $(document).ready(function() {

                                    $('#dropdown').change(function() {
                                        var selectedOption = $(this).val();
                                        if (selectedOption) {
                                            // alert(selectedOption);
                                            $.ajax({
                                                type: 'POST',
                                                url: 'incop/fetch_dep_id.php', // Replace with the URL of your PHP script
                                                data: {
                                                    selectedOption: selectedOption
                                                },
                                                success: function(data) {
                                                    var phpDepId = data;
                                                    populateSelectOptions(phpDepId);
                                                },
                                                error: function() {
                                                    console.log('Error occurred while fetching dep ID');
                                                }
                                            });
                                        }
                                    });

                                    function populateSelectOptions(phpDepId) {
                                        $.ajax({
                                            type: 'GET',
                                            url: 'inc/get_programs.php', // Replace with the URL of your PHP script to retrieve programs
                                            data: {
                                                phpDepId: phpDepId
                                            },
                                            success: function(response) {
                                                $('#dropdown_program').html(response);
                                            },
                                            error: function() {
                                                console.log('Error occurred while getting programs');
                                            }
                                        });
                                    }

                                    $("#dropdown_program").on("change", function() {
                                        // Get the selected value from the dropdown
                                        var selectedValue = $(this).val();
                                        // Perform an Ajax request to send the value to another file
                                        $.ajax({
                                            url: "incop/sem.op.php",
                                            type: "POST",
                                            data: {
                                                value: selectedValue
                                            },

                                            success: function(data) {
                                                populate(data);
                                            },
                                            error: function(xhr, status, error) {
                                                console.log("Ajax request failed: " + status);
                                            }
                                        });
                                    });

                                    function populate(prog_id) {
                                        $.ajax({
                                            type: 'GET',
                                            url: 'incop/sem.op2.php', // Replace with the URL of your PHP script to retrieve programs
                                            data: {
                                                prog_id: prog_id
                                            },
                                            success: function(response) {
                                                $('#sem_drop').html(response);
                                            },
                                            error: function() {
                                                console.log('Error occurred while getting programs');
                                            }
                                        });
                                    }

                                });
                            </script>
                        </div>


                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Select Program</label>

                            <select id="dropdown_program" name="dropdown_prog" name="program" class="form-select">

                            </select>

                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="recipient-name" class="col-form-label">Semester</label>
                            <select id="sem_drop" name="dropdown" name="sem" class="form-select">
                            </select>
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="recipient-name" class="col-form-label">Session</label>
                            <select id="session" name="dropdown" name="session" class="form-select">
                                <?php
                                for ($i = 2002; $i <= 2030; $i++) {
                                    echo "<option>" . $i . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Status</label>
                            <select id="status" name="dropdown" name="status" class="form-select">
                                <option value="0">Not Paid</option>
                                <option value="1">Paid</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Merit</label>
                            <select id="merit" name="merit" name="merit" class="form-select">
                                <option value="0">Regular</option>
                                <option value="1">Self</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Fee Type</label>
                            <select id="ftype" name="dropdown-fee" name="f_type" class="form-select">
                                <?php
                                $sql = "SELECT * FROM fee";
                                $id = null;
                                $result = mysqli_query($connect, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option>" . $row['name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="recipient-name" class="col-form-label">Due Date</label>
                            <input type="date" name="d_date" id="due_date" class="form-control">
                        </div>
                        <!-- 
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" name="img_add" id="img_add">
                        </div> -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="upload" id="submitdata" class="btn btn-primary">Save Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    <div class="modal fade modal-lg-centered editmodal" class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Data Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="alert alert-danger alert-dismissible fade show form-alert" role="alert">
                    x
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="edit-form" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="addform" value="addform" />
                        <div class="mb-3 col">
                            <label for="recipient-name" class="col-form-label">Name </label>
                            <input type="text" name="sname" class="form-control" id="sname1">
                        </div>

                        <div class="mb-3 ">
                            <label for="recipient-name" class="col-form-label">Roll no</label>
                            <input type="text" name="rollno" class="form-control" id="rollno1" disabled>
                        </div>

                        <div class="mb-3 ">
                            <label for="recipient-name" class="col-form-label">Father Name</label>
                            <input type="text" name="fname" class="form-control" id="fname1">
                        </div>


                        <div class="mb-3 ">
                            <label for="recipient-name" class="col-form-label">Department</label>
                            <input type="text" name="depname" class="form-control" id="depname1" disabled>
                        </div>


                        <div class="mb-3 ">
                            <label for="recipient-name" class="col-form-label">Program</label>
                            <input type="text" name="pname" class="form-control" id="pname1" disabled>
                        </div>


                        <div class="mb-3 col-md-3">
                            <label for="recipient-name" class="col-form-label">Semester</label>
                            <select id="sem_drop1" name="dropdown" name="sem" class="form-select">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="recipient-name" class="col-form-label">Session</label>
                            <input name="session" id="session1" class="form-control" disabled>

                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Status</label>
                            <select id="status1" name="dropdown" name="status" class="form-select">
                                <option value="0">Not Paid</option>
                                <option value="1">Paid</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Merit</label>
                            <input id="merit1" name="merit" class="form-control" disabled>

                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Fee Type</label>
                            <input id="f_type1" name="f_type" class="form-control" disabled>

                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="recipient-name" class="col-form-label">Due Date</label>
                            <input type="date" name="d_date" id="due_date1" class="form-control">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="upload" id="submitdata" class="btn btn-primary">Save Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end edit form -->
    </div>

    <div class="all">

        <?php include 'static/sidebar.op.php' ?>

        <div class="right">

            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="s-msg">
                <strong>Holy guacamole!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <ul class="nav nav-tabs p-2">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="#">Add Data</a>
                </li>

                <li class="nav-item">

                    <div class='container s-e' style='display:flex;flex-direction:column;'>
                   
                        <form class='d-flex' role='search' id="form-search">
                            <input class='form-control ' type='search' placeholder=' Search' aria-label='Search' id="search-text">

                            <select class="form-select" aria-label="Default select example" id="s-choice">
                                <option selected value="0"></option>
                                <option value="1">Search By Program</option>
                                <option value="2">Search By Department</option>

                            </select>
                            <button class='btn btn-outline-success' style='margin-left:5px;' type='submit' id="s-btn">Search</button>

                        </form>
                    </div>

                </li>
            </ul>
            <div class="container table-responsive-sm m-3" id="s-data">

            </div>

            <div class="container table-responsive-sm m-3" id="content">
                <h2>Rules and Regulations</h2>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {


            $('#form-search').submit(function(event) {
                event.preventDefault();
                var stext = $("#search-text").val();
                var opt = $("#s-choice").val();

                if (opt === "0" || stext === "") {
                    $("#s-msg").css("display", "block");
                    $("#s-msg").html("Fill all fields!");
                    return;
                } else {
                    $.ajax({
                        url: "inc/searched.admin.php",
                        type: "POST",
                        data: {
                            stext: stext,
                            opt: opt
                        },
                        success: function(data) {
                            $("#s-data").css("display", "block");
                            $("#s-data").html(data);
                        }

                    });

                }
            })
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            function populate_op(prog_id) {
                $.ajax({
                    type: 'GET',
                    url: 'incop/sem.op2.php', // Replace with the URL of your PHP script to retrieve programs
                    data: {
                        prog_id: prog_id
                    },
                    success: function(response) {
                        $('#sem_drop1').html(response);
                    },
                    error: function() {
                        console.log('Error occurred while getting programs');
                    }
                });
            }

            function loadchat() {
                $.ajax({
                    url: "incop/display.php",
                    type: "POST",
                    success: function(data) {
                        $("#content").html(data);
                    }
                });
            }
            loadchat();
            // Update Data
            $(document).on("click", ".edit-btn", function() {
                var id = $(this).data("id");

                $.ajax({
                    url: "incop/edit.op.php",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        var pro_id = data.prog_id;
                        populate_op(pro_id);
                        $("#sname1").val(data.name);
                        $("#fname1").val(data.fname);
                        $("#rollno1").val(data.rollno);
                        $("#depname1").val(data.depname);
                        $("#pname1").val(data.p_name);
                        // $("#sem_drop1").val(data.name);
                        $("#session1").val(data.session);
                        $("#status1").val(data.fee_type);
                        $("#merit1").val(data.merit_line);
                        $("#f_type1").val(data.fee_type);
                        $("#due_date1").val(data.due_date1);
                    }
                });
            });
            $(document).on("click", "#close-btn", function() {
                $("#edit-form").hide();
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#edit-form').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                var sname1 = $('#sname1').val();
                var fname1 = $('#fname1').val();
                var rollno1 = $('#rollno1').val();
                var depname1 = $('#depname1').val();
                var pname1 = $("#pname1").val();
                var session1 = $("#session1").val();
                var status1 = $("#status1").val();
                var merit1 = $("#merit1").val();
                var f_type1 = $("#f_type1").val();
                var date1 = $("#due_date1").val();
                var sem1= $("#sem_drop1").val();

                // Validate form inputs (Example: check if fields are not empty)
                if (sname1 === '' || fname1 === ''  || sem1 === '' || status1 === '' ||   date1 === '') {
                    $('.form-alert').css('display', 'block');
                    $('.form-alert').text('Please fill in all fields');
                    return;
                }
                // Submit form data using AJAX
                $.ajax({
                    url: 'incop/update.op.php', // PHP file that handles form processing
                    type: 'POST',
                    data: {
                        sname: sname1,
                        fname: fname1,
                        depname:depname1,
                        pname:pname1,
                        sem: sem1,
                        merit:merit1,
                        status: status1,
                        f_type:f_type1,
                        d_date: date1,
                        rollno1:rollno1,
                        session1:session1

                    },
                    success: function(data) {
                        // Handle response from PHP file
                        $('.form-alert').css('display', 'block');
                        $('.form-alert').css('background-color', 'parrot');
                        $('.form-alert').text(data);
                        $('#addform')[0].reset();
                 
                        // You can perform additional actions here, such as displaying a success message or redirecting to another page.
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Log any errors
                        $('.form-alert').css('display', 'block');
                        $('.form-alert').text('An error occurred. Please try again.');
                    }
                });
            });


        });
    </script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // $(document).ready(function(){

        //     $('.delete-btn').click(function() {
        //     });
        // })
        $(document).ready(function() {
            $('#addform').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                var sname = $('#sname').val();
                var fname = $('#fname').val();
                var depname = $('#dropdown').val();
                var program = $('#dropdown_program').val();
                var sem = $("#sem_drop").val();
                var session = $("#session").val();
                var status = $("#status").val();
                var merit = $("#merit").val();
                var f_type = $("#ftype").val();
                var d_date = $("#due_date").val();

                
                // Validate form inputs (Example: check if fields are not empty)
                if (sname === '' || fname === '' || depname === '' || program === '' || sem === '' || session === '' || status === '' || merit === '' || f_type === '' || d_date === '') {
                    $('.form-alert').css('display', 'block');
                    $('.form-alert').text('Please fill in all fields');
                    return;
                }
                // Submit form data using AJAX
                $.ajax({
                    url: 'incop/process_add_form.php', // PHP file that handles form processing
                    type: 'POST',
                    data: {
                        sname: sname,
                        fname: fname,
                        depname: depname,
                        program: program,
                        sem: sem,
                        session: session,
                        status: status,
                        f_type: f_type,
                        merit: merit,
                        d_date: d_date

                    },
                    success: function(data) {
                        // Handle response from PHP file
                        $('.form-alert').css('display', 'block');
                        $('.form-alert').css('background-color', 'parrot');
                        $('.form-alert').text(data);
                        $('#addform')[0].reset();
                        loadchat();
                        // You can perform additional actions here, such as displaying a success message or redirecting to another page.
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Log any errors
                        $('.form-alert').css('display', 'block');
                        $('.form-alert').text('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
</body>

</html>