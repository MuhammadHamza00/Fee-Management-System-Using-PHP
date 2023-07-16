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

    #edit-form {
        display: none;
    }
</style>

<body>


    <!-- Admin Panel Add Data -->
    <div class="modal fade modal-lg-centered addmodel" class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Entry Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="alert alert-warning alert-dismissible fade show form-alert" role="alert">
                    <strong>Holy guacamole!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    x
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="row g-3" id="addform" method="post" action="">

                        <div class="mb-3 ">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" name="o_name" class="form-control" id="o_name">
                        </div>

                        <div class="mb-3 ">
                            <label for="recipient-name" class="col-form-label">Key</label>
                            <input type="text" name="key" class="form-control" id="key">
                        </div>


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

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="submitdata" class="btn btn-primary">Save Data</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
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
                                <option value="1">Search By Name</option>
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

            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {

            $('#form-search').submit(function(event) {
                event.preventDefault();
                var stext = $("#search-text").val();
                var opt = $("#s-choice").val();
                
                if (stext === "") {
                    $("#s-msg").css("display", "block");
                    $("#s-msg").html("Fill all fields!");
                    return;
                } else {
                    $.ajax({
                        url: "inc/op_fee_searched.php",
                        type: "POST",
                        data: {
                            stext: stext,
                            opt:opt
                        },
                        success: function(data) {
                            $("#s-data").css("display", "block");
                            $("#s-data").html(data);
                        }

                    })
                }
            });

            // Update Data
            $(document).on("click", ".edit-btn", function() {

                $("#edit-form").show();
                var id = $(this).data("id");
                $.ajax({
                    url: "inc/op_edit.php",
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
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#edit-form2').submit(function(event) {
                event.preventDefault();
                var s_prog_id = $('#prog_id').val();
                var name = $('#name').val();
                var key2 = $('#key2').val();
              
                if (name === '' || key2 === '') {
                    $('#edit-msg').css('display', 'block');
                    $('#edit-msg').text('Please fill in all fields');
                    return;
                }
                // Submit form data using AJAX
                $.ajax({
                    url: 'inc/op_edit_update.php', // PHP file that handles form processing
                    type: 'POST',
                    data: {
                        s_prog_id: s_prog_id,
                        name: name,
                        key2:key2
                    },
                    success: function(data) {
                        // Handle response from PHP file
                        $('#edit-msg').css('display', 'block');
                        $('#edit-msg').css('background-color', 'yellow');
                        $('#edit-msg').text(data);

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
    <script type="text/javascript">
        $(document).ready(function() {

            function loadchat() {
                $.ajax({
                    url: "inc/op_display.php",
                    type: "POST",
                    success: function(data) {
                        $("#content").html(data);
                    }
                });
            }
            loadchat();


        });
    </script>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            // Form submission using AJAX
            $('#addform').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                var name = $('#o_name').val();
                var key = $('#key').val();
                var dep = $('#dropdown').val();

                // Validate form inputs (Example: check if fields are not empty)
                if (name === '' || key === '' || dep === '') {
                    $('.form-alert').css('display', 'block');
                    $('.form-alert').text('Please fill in all fields');
                    return;
                }

                // Submit form data using AJAX
                $.ajax({
                    url: 'inc/op_add_form.php', // PHP file that handles form processing
                    type: 'POST',
                    data: {
                        name: name,
                        key: key,
                        dep: dep
                    },
                    success: function(data) {
                        // alert(data);
                        // Handle response from PHP file
                        $('.form-alert').css('display', 'block');
                        $('.form-alert').css('background-color', 'yellow');
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
            // loadchat();

        });
    </script>

</body>

</html>