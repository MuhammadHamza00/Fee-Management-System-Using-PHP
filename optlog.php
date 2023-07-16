<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <title>Document</title>
</head>
<style>
    #main {
        background: url(img/formbg2.jpg);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #contain {
        background-color: white;
        opacity: 0.9;
        border-radius: 5rem;
    }

    #form-f {

        opacity: unset;
        height: 70%;
    }

    #sub {
        border: 0.1rem solid #1da1f2;
        background: linear-gradient(to right, #a42af9, #1da1f2);
        height: 3rem;
        width: 100%;
        color: white;
        font-family: 'ABeeZee', sans-serif;
        font-size: x-large;
        transition: all 0.5s ease-in-out;
    }

    #sub:hover {

        background: linear-gradient(to right, white, white);
        color: #a42af9;
        border-image: linear-gradient(to right, #a42af9, #1da1f2);
        /* Define the gradient colors and direction */
        border-image-slice: 1;
    }

   

    #u_name {
        border: 5px solid;
        padding: 1rem;
        border-image: linear-gradient(to right, #a42af9, #1da1f2);
        /* Define the gradient colors and direction */
        border-image-slice: 1;
    }

    #u_roll {
        border: 5px solid;
        padding: 1rem;
        border-image: linear-gradient(to right, #a42af9, #1da1f2);
        /* Define the gradient colors and direction */
        border-image-slice: 1;
    }

    #lab {
        font-size: x-large;
    }
</style>

<body>
    <section class="text-gray-600 body-font" id="main">
        <div class="container px-5 py-24 mx-auto flex flex-wrap items-center" id="contain">
            <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
                <img src="img/login.jpg" width="70%" alt="">
            </div>
            <div class="lg:w-2/6 md:w-1/2  rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0" id="form-f">

                <form method="POST" id="operator-form" action="incstu/oplogin.php">

                    <div class="mb-3">
                        <label for="recipient-name" id="lab" class="col-form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" class="in" id="u_name" id="recipient-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" id="lab" class="col-form-label">Enter Key</label>
                        <input type="text" name="roll" class="form-control" placeholder="Enter Key" class="in" id="u_roll" id="recipient-name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="sub" class="  py-2 px-8 focus:outline-none rounded text-lg">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
<script>
    $('#operator-form').submit(function(event) {
        event.preventDefault();
        var u_name = $("#u_name").val();
        var u_roll = $("#u_roll").val();

        if (u_name === "" || u_roll === "") {
            alert("Cannot be Null!")
            return;
        } else {
            $.ajax({
                url: "incstu/oplogin.php",
                type: "POST",
                data: {
                    u_name: u_name,
                    u_roll: u_roll
                },
                success: function(data) {
                    if (data == 1) {
                        $("#alerts").css("display", "block");
                        $("#alerts").html("Invalid Data Entered!");
                    } else {
                        window.location.href = 'oppannel.php';
                    }
                }

            })
        }
    })
</script>

</html>