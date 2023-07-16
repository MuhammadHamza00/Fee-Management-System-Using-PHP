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

    .bg-con {
        padding: 1rem;
        background-image: url(img/formbg1.jpg);
        /* display: flex;
        flex-direction: row; */
    }
    
    
</style>

<body>


    <!-- Admin Panel Add Data -->
    <div class="modal fade modal-fullscreen-xxl-down addmodel"   class="modal-dialog modal-xl fade addmodel" class="modal-dialog  modal-dialog-centered modal-dialog-scrollable" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- <div class="container bg-con"> -->
           
        <div class="modal-dialog"id="contain-bg">
            <div class="modal-content"id="contain-form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Entry Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="alert alert-danger alert-dismissible fade show form-alert" role="alert">
                    x
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form class="row g-3" id="addform" method="post" action="">
                        <input type="hidden" name="addform" value="addform" />
                        <div class="mb-3 ">
                            <label for="recipient-name" class="col-form-label">Department Name</label>
                            <!-- <input type="text" id="inputField" name="inputField" placeholder="Enter a value"> -->
                            <select id="dropdown" name="dropdown" class="form-select">
                                <option selected>---</option>
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
                                                url: 'inc/fetch_dep_id.php', // Replace with the URL of your PHP script
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
                                            url: "inc/sem.admin.php",
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
                                            url: 'inc/sem.admin2.php', // Replace with the URL of your PHP script to retrieve programs
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
                            <label for="recipient-name" class="col-form-label">Program</label>

                            <select id="dropdown_program" name="dropdown_prog" class="form-select">

                            </select>

                        </div>

                        <div class="col-md-4">
                            <label for="recipient-name" class="col-form-label">Semester</label>
                            <select id="sem_drop" name="dropdown" class="form-select">

                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Bus Card Fee </label>
                            <input type="text" name="bfund" class="form-control" id="bcard">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Computer Fund</label>
                            <input type="text" name="comfund" class="form-control" id="cfund">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Development Fund</label>
                            <input type="text" name="devfund" class="form-control" id="devfund">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Exam Fee</label>
                            <input type="text" name="efund" class="form-control" id="efund">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Tour Fund</label>
                            <input type="text" name="tfund" class="form-control" id="tfund">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Lab Fund</label>
                            <input type="text" name="lfund" class="form-control" id="lfund">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Tuition Fee</label>
                            <input type="text" name="tuition" class="form-control" id="tuition">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="recipient-name" class="col-form-label">Admission Fee</label>
                            <input type="text" name="afund" class="form-control" id="afund">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="submitdata" class="btn btn-primary">Save Data</button>
                        </div>
                    </form>

                    
                </div>
            </div>
        </div>
        
        <!-- <div class="bg-con-img">
            
        </div> -->

    <!-- </div> -->
    </div>

    <!-- end this -->
    <div class="modal" id="edit-form" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"id="close-two" aria-label="Close"></button>
                </div>
                <div class="alert alert-warning" role="alert" id="edit-msg"></div>
                <form action='' id='edit-form2' method='post'>
                    <div class="modal-body" id="get-edit" style="display:flex;flex-direction:row;">


                    </div>
                </form>

            </div>

        </div>

    </div>
    </div>

    <div class="all">

        <?php include 'static/sidebar.admin.php' ?>

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

                    <div class='container' style='display:flex;flex-direction:column;'>
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

                    })
                }
            })
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            function loadchat() {
                $.ajax({
                    url: "loadadmin.php",
                    type: "POST",
                    success: function(data) {
                        $("#content").html(data);
                    }
                });
            }
            loadchat();
            // Update Data
            $(document).on("click", ".edit-btn", function() {
                $("#edit-form").show();
                var id = $(this).data("id");
                $.ajax({
                    url: "inc/edit.admin.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $("#get-edit").html(data)
                    }
                });
            });
            $(document).on("click", "#close-btn", function() {
                $("#edit-form").hide();
            });
            $(document).on("click", "#close-two", function() {
                $("#edit-form").hide();
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#edit-form2').submit(function(event) {
                event.preventDefault();
                var s_prog_id = $('#prog_id').val();
                var s_bus = $('#bus2').val();
                // var sem = $('#sem2').val();
                var s_com = $('#cfund2').val();
                var s_dev = $('#devfund2').val();
                var s_exam = $('#efund2').val();
                var s_tour = $('#tfund2').val();
                var s_lab = $('#lfund2').val();
                var s_tuition = $('#tuition2').val();
                var s_admin = $('#admin2').val();
                console.log(s_bus);
                if (s_bus === '' || s_com === '' || s_dev === '' || s_exam === '' || s_tour === '' || s_lab === '' || s_tuition === '' || s_admin === '') {
                    $('#edit-msg').css('display', 'block');
                    $('#edit-msg').text('Please fill in all fields');
                    return;
                }
                // Submit form data using AJAX
                $.ajax({
                    url: 'inc/edit.admin.update.php', // PHP file that handles form processing
                    type: 'POST',
                    data: {
                        s_prog_id: s_prog_id,
                        s_bus: s_bus,
                        // sem: sem,
                        s_com: s_com,
                        s_dev: s_dev,
                        s_exam: s_exam,
                        s_tour: s_tour,
                        s_lab: s_lab,
                        s_tuition: s_tuition,
                        s_admin: s_admin,
                    },
                    success: function(data) {
                        // Handle response from PHP file
                        $('#edit-msg').css('display', 'block');
                        $('#edit-msg').css('background-color', 'green');
                        $('#edit-msg').text(data);

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
            // Form submission using AJAX
            $('#addform').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                var depname = $('#dropdown').val();
                var program = $('#dropdown_program').val();
                var sem = $("#sem_drop").val();
                var bcard = $('#bcard').val();
                var cfund = $('#cfund').val();
                var devfund = $('#devfund').val();
                var efund = $('#efund').val();
                var tfund = $('#tfund').val();
                var lfund = $('#lfund').val();
                var tuition = $('#tuition').val();
                var afund = $('#afund').val();

                // Validate form inputs (Example: check if fields are not empty)
                if (depname === '' || program === '' || bcard === '' || cfund === '' || devfund === '' || efund === '' || tfund === '' || lfund === '' || tuition === '' || afund === '' || sem === '') {
                    $('.form-alert').css('display', 'block');
                    $('.form-alert').text('Please fill in all fields');
                    return;
                }

                // Submit form data using AJAX
                $.ajax({
                    url: 'inc/process_add_form.php', // PHP file that handles form processing
                    type: 'POST',
                    data: {
                        check: "checked",
                        depname: depname,
                        program: program,
                        sem: sem,
                        bcard: bcard,
                        cfund: cfund,
                        devfund: devfund,
                        efund: efund,
                        tfund: tfund,
                        lfund: lfund,
                        tuition: tuition,
                        afund: afund

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
    <!-- <script>
        $(document).ready(function() {
            jQuery('#addform').validate({
                rules: {
                    dropdown: {
                        required: true
                    },
                    dropdown_prog: {
                        required: true,
                    },
                    bfund: {
                        required: true,

                        number: true
                    },
                    comfund: {
                        required: true,
                        number: true

                    },
                    devfund: {
                        required: true,
                        number: true


                    },
                    efund: {
                        required: true,
                        number: true


                    },
                    tfund: {
                        required: true,
                        number: true


                    },
                    lfund: {
                        required: true,
                        number: true
                    }
                },
                messages: {
                    dropdown: 'Select Department',
                    dropdown_prog: 'Select Program',

                    bfund: {
                        required: 'Please Enter Value.',
                        number: 'Please enter a Number',
                    },
                    comfund: {
                        required: 'Please Enter Value.',
                        number: 'Please enter a Number',
                    },
                    devfund: {
                        required: 'Please Enter Value.',
                        number: 'Please enter a Number',
                    },
                    efund: {
                        required: 'Please Enter Value.',
                        number: 'Please enter a Number',
                    },
                    tfund: {
                        required: 'Please Enter Value.',
                        number: 'Please enter a Number',
                    },
                    lfund: {
                        required: 'Please Enter Value.',
                        number: 'Please enter a Number',
                    }
                },
                submitHandler: function(form) {
                    jQuery("#submitdata").attr("disabled", false);
                    form.submit();
                }
            });
        });
    </script> -->
</body>

</html>