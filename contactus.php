<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
    <title>Document</title>
</head>

<body>
    <style>
        .all-2{
            display: none;
            border-radius: 5rem;
        }
       
        #s-form {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            background-image: url(img/formbg2.jpg);
            background-position: center;
            background-size: cover;
        }

        .all {
            padding: 2.5rem;
            background-color: #f7f9fc;
            width: 80%;
            height: 80%;
            border-radius: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
        }
       
        .form {
            width: 100%;
            /* border: 1px solid red; */
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 100%;
            padding: 1rem;

        }

        .form h1 {
            font-family: 'ABeeZee', sans-serif;
            font-size: 4rem;
            color: #000051;
            font-weight: bolder;
            /* margin-bottom: 5rem; */
        }

        .img {
            background: url("img/icons.jpg");
            background-position: center;
            background-size: cover;
            border-radius: 1rem;
            background-repeat: no-repeat;
            width: 90%;
            height: 100%;
        }

        #s-img {
            width: 10rem;

        }

        #f-content {
            display: flex;
            flex-direction: column;
            width: 70%;
        }

        .text {
            margin: 1rem;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .text label {
            font-size: larger;
            font-weight: 500;
            color: #000051;
        }

        .f-lab {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 5px;
            outline: none;
            border: none;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            /* margin: 0.5rem; */
        }

        #btn-sub {
            border: 0.1rem solid #1da1f2;
            background: linear-gradient(to right, #a42af9, #1da1f2);
            height: 3rem;
            width: 100%;
            color: white;
            font-family: 'ABeeZee', sans-serif;
            font-size: x-large;
            transition: all 0.5s ease-in-out;
        }

        #btn-sub:hover {
            border: 0.1rem solid #1da1f2;
            background: linear-gradient(to right, white, white);
            color:#1da1f2 ;
        }

        @media screen and (max-width: 1780px) {
            #s-form {
            height:50rem;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            background-image: url(img/formbg2.jpg);
            background-position: center;
            background-size: cover;
        }

        .all {
            padding: 4.5rem;
            background-color: #f7f9fc;
            width: 80%;
            height: 80%;
            border-radius: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
        }
       
        }
    </style>
    <!-- <i class="bi bi-envelope-at-fill"></i> -->

    <section id="s-form">
        <div class="all"id="allid">
            <div class="form">

                <!-- <h1>Ping Us!</h1> -->

                <form action="" method="post" id="f-content">

                    <div class="text">
                        <label for="Name">Name</label>
                        <input type="text" placeholder="<?php echo $_SESSION['name']?>" name="name" id="name" class="f-lab"required>
                    </div>

                    <div class="text">
                        <label for="Name">Email</label>
                        <input type="email" placeholder="Enter Email" name="email" id="email" class="f-lab"required>

                    </div>

                    <div class="text">
                        <label for="Name">Message</label>
                        <textarea name="msg" placeholder="Enter Message" id="msg" cols="30" rows="10" class="f-lab"required></textarea>
                    </div>
                    <div class="text">
                        <button type="submit" id="btn-sub">Send</button>
                    </div>
                </form>
            </div>
            <div class="img">
            </div>
        </div>

        <div class="all-2"id="log"style="background:url('img/thanks.jpg'); background-position: center;
            background-size: cover;background-repeat:no-repeat;">
            <!-- <div class="form"style="background:url('img/thanks.jpg'); background-position: center;
            background-size: cover;background-repeat:no-repeat;"> -->
        </div>

        <script type="text/javascript">
            $(document).ready(function() {

                $('#f-content').submit(function(event) {
                    event.preventDefault();
                    var u_name = $("#name").val();
                    var u_email = $("#email").val();
                    var u_msg = $("#msg").val();

                    if (u_name === "" || u_email==="" || u_msg === "") {
                        alert("Cannot be Null!")
                        return;
                    } else {
                        $.ajax({
                            url: "incstu/msg.php",
                            type: "POST",
                            data: {
                                u_name: u_name,
                                u_email: u_email,
                                u_msg: u_msg
                            },
                            success: function(data) {
                                $("#allid").css("display", "none");
                                $(".all-2").css("display", "block");
                                $(".all-2").css("width", "80%");
                                $(".all-2").css("height", "80%");
                                $(".all-2").css("transition", " all 0.5s ease ");

                            }

                        })
                    }
                })
            })
        </script>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>