<?php
session_start();

if (!isset($_SESSION['name']) && !isset($_SESSION['rollno']) && !isset($_SESSION['id'])) {
    $_SESSION['name'] = "";
    $_SESSION['rollno'] = "";
    $_SESSION['id'] = "";
}
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
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="homecss.css">
    <title>Document</title>
</head>


<body>
    <!-- Button trigger modal -->
    <!-- Form Login -->



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="alert alert-danger" role="alert" class="a-alert">

                </div>
                <div class="modal-body">
                    <form method="POST" id="login-form" action="incstu/login.php">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="s_name" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Roll no</label>
                            <input type="text" name="roll" class="form-control" id="s_roll" id="recipient-name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="sub-close" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="sub">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            function set(u_name, roll) {
                var u_name = u_name;
                var u_roll = roll;
                $.ajax({
                    url: "incstu/set.php",
                    type: "POST",
                    data: {
                        u_name: u_name,
                        u_roll: u_roll
                    },
                    success: function(data) {

                    }

                })
            }
            $('#login-form').submit(function(event) {
                event.preventDefault();
                var u_name = $("#s_name").val();
                var u_roll = $("#s_roll").val();
                if (u_name === "" || u_roll === "") {
                    alert("Cannot be Null!")
                    return;
                } else {
                    $.ajax({
                        url: "incstu/login.php",
                        type: "POST",
                        data: {
                            u_name: u_name,
                            u_roll: u_roll
                        },
                        success: function(data) {
                            $(".a-alert").css("display", "block");
                            $(".a-alert").html(data);
                            const btn2 = document.getElementById('log');
                            btn2.innerText = 'Logout';
                            set(u_name, u_roll);
                        }

                    })
                }
            })

        })
    </script>

    <header>
        <div class="logo">
            <!-- <img src="img/Log.jpg" alt=""> -->
        </div>
        <div class="nav">
            <ul class="ull">
                <li class="list"><a href="#">Home</a></li>
                <li class="list"><a href="#steps">Guide</a></li>
                <li class="list"><a href="#sabout">Overview</a></li>
            </ul>
        </div>

        <div class="btns">
            <?php
            if (isset($_SESSION['name']) && $_SESSION['name'] != "") {
                echo "<button type='button' class='logout' id='log'>Log Out</button>";
            } else {
                echo "<button type='button' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='@mdo' id='log'>Log In</button>";
            }
            ?>
            <button type="submit" id="contact"><i class="bi bi-telephone"></i><a href="contactus.php">Contact Us</a></button>
        </div>
        <style>
            .profile {
                display: flex;
                border: 0.1rem solid #1da1f2;
                background: linear-gradient(to right, #a42af9, #1da1f2);
                color: white;
                flex-direction: row;
                justify-content: space-evenly;
                align-items: center;
                width: 15%;
                height: min-content;
                border-radius: 7rem;
                margin-top: 1.6rem;
            }

            .nav {
                width: 10rem;

            }

            .profile h3 {
                padding: 2px;
            }
        </style>
        <div class="profile">

            <!-- Clickable element -->
            <i class="bi bi-person-fill" style="font-size:3rem;color:white;"></i>
            <h3 style="font-size:1.5rem;color:white;"><?php echo $_SESSION['name'] ?></h3>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('.logout').click(function() {
                        alert("enetr");
                        $.ajax({
                            url: "incstu/logout.php", // Path to your PHP script
                            method: "POST",
                            success: function(response) {
                                // Handle the response from the PHP script
                                alert("Logged out successfully");
                                // Perform any other actions or redirection if needed
                            },
                            error: function(xhr, status, error) {
                                // Handle the error if the AJAX request fails
                                console.log(xhr.responseText);
                                // Perform any error handling actions if needed
                            }
                        });
                    })
                })
            </script>

            <!-- <button class="btn btn-secondary dropdown-toggle bi bi-person-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false"> -->
            <!-- </button> -->
        </div>
    </header>
    <section class="s-form">
        <div class="search">
            <form action="feeform.php" method="post" id="search-form">
                <input type="search" name="searched" placeholder="Enter Your Roll no" id="s-bar">
                <button type="submit" id="s-btn">Search</button>
            </form>
        </div>

    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#search-form').submit(function(event) {

                var searched = $("#s-bar").val();
                const btn = document.getElementById('log');

                if (searched === "") {
                    $("#s-bar").css("border", "1px solid red");
                    return;
                } else if (btn.innerText == 'Log In') {
                    event.preventDefault();
                    $('#exampleModal').modal('show');
                } else {

                }
            })
        })
    </script>

    <section class="text-gray-600 body-font" id="steps">
        <h1>Steps to Use!</h1>
        <div class="container px-5 py-24 mx-auto flex flex-wrap">
            <div class="flex relative pt-10 pb-20 sm:items-center md:w-2/3 mx-auto">
                <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                </div>
                <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center text-white relative z-10 title-font font-medium text-sm" style="background-color:#1da1f2;">1</div>
                <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                    <div style="background-color:#fffaeb;" class="flex-shrink-0 w-24 h-24  text-indigo-500 rounded-full inline-flex items-center justify-center">
                        <i class="bi bi-box-arrow-in-right icon-inner" style="color:#ecb100"></i>
                    </div>
                    <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                        <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Login Using Rollno</h2>
                        <p class="leading-relaxed">VHS cornhole pop-up, try-hard 8-bit iceland helvetica. Kinfolk bespoke try-hard cliche palo santo offal.</p>
                    </div>
                </div>
            </div>


            <div class="flex relative pb-20 sm:items-center md:w-2/3 mx-auto">
                <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                </div>
                <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center text-white relative z-10 title-font font-medium text-sm" style="background-color:#1da1f2;">2</div>
                <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                    <div style="background-color:#fff3f7;" class="flex-shrink-0 w-24 h-24 bg-indigo-100 text-indigo-500 rounded-full inline-flex items-center justify-center">
                        <i class="bi bi-123 icon-inner" style="color:#fd5f93"></i>
                    </div>
                    <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                        <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Enter Your Rollno</h2>
                        <p class="leading-relaxed">VHS cornhole pop-up, try-hard 8-bit iceland helvetica. Kinfolk bespoke try-hard cliche palo santo offal.</p>
                    </div>
                </div>
            </div>


            <div class="flex relative pb-20 sm:items-center md:w-2/3 mx-auto">
                <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                </div>
                <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center text-white relative z-10 title-font font-medium text-sm" style="background-color:#1da1f2;">3</div>
                <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                    <div style="background-color:#def1e0;" class="flex-shrink-0 w-24 h-24 bg-indigo-100 text-indigo-500 rounded-full inline-flex items-center justify-center">
                        <i class="bi bi-download icon-inner" style="color:green"></i>
                    </div>
                    <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                        <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Download Fee Voucher</h2>
                        <p class="leading-relaxed">VHS cornhole pop-up, try-hard 8-bit iceland helvetica. Kinfolk bespoke try-hard cliche palo santo offal.</p>
                    </div>
                </div>
            </div>


            <div class="flex relative pb-10 sm:items-center md:w-2/3 mx-auto">
                <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                </div>
                <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center  text-white relative z-10 title-font font-medium text-sm" style="background-color:#1da1f2;">4</div>
                <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                    <div class="flex-shrink-0 w-24 h-24 bg-indigo-100 text-indigo-500 rounded-full inline-flex items-center justify-center">
                        <i class="bi bi-check-circle icon-inner"></i>
                    </div>
                    <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                        <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Done!</h2>
                        <p class="leading-relaxed">VHS cornhole pop-up, try-hard 8-bit iceland helvetica. Kinfolk bespoke try-hard cliche palo santo offal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="s-about" id="sabout">

        <h1>OVERVIEW</h1>

        <div class="content">
            <div class="bars">
                <i class="bi bi-fast-forward-fill" id="s-f"></i>
                <h3 class="head">Easy to Use</h3>
                <h5 class="head5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quas ut numquam eveniet fuga modi reiciendis facilis excepturi vel? Incidunt earum est dolore sint accusantium animi facilis perspiciatis dolores velit deleniti?</h5>
            </div>


            <div class="bars">
                <i class="bi bi-search icons" id="s-s"></i>
                <h3 class="head">Quick Search</h3>

                <h5 class="head5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quas ut numquam eveniet fuga modi reiciendis facilis excepturi vel? Incidunt earum est dolore sint accusantium animi facilis perspiciatis dolores velit deleniti?</h5>
            </div>

            <div class="bars">
                <i class="bi bi-pc-display-horizontal" id="s-r"></i>

                <h3 class="head">Fast Results</h3>

                <h5 class="head5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quas ut numquam eveniet fuga modi reiciendis facilis excepturi vel? Incidunt earum est dolore sint accusantium animi facilis perspiciatis dolores velit deleniti?</h5>
            </div>

        </div>
    </section>
    <!-- 
    <section class="text-gray-600 body-font"style="background-color:#f7f9fc;height:100vh;font-family: 'ABeeZee', sans-serif;padding:2rem;margin-top:5rem">
        <div class="container px-5 py-24 mx-auto"class="inner">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="text-2xl title-font mb-4 text-gray-900"style="font-size:5rem; font-family: 'ABeeZee', sans-serif;">OUR TEAM</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base"style="font-size:1rem">Whatever cardigan tote bag tumblr hexagon brooklyn asymmetrical gentrify, subway tile poke farm-to-table. Franzen you probably haven't heard of them.</p>
            </div>
            <div class="flex -m-4"class="inner">
                <div class="p-4 lg:w-1/4 md:w-1/2">
                    <div class="h-full flex flex-col items-center text-center main">
                        <img alt="team" class="flex-shrink-0 rounded-lg w-full h-56 object-cover object-center mb-4" src="img/Favatar_1.jpg">
                        <div class="w-full">
                            <h2 class="title-font font-medium text-lg text-gray-900">Alper Kamu</h2>
                            <h3 class="text-gray-500 mb-3">UI Developer</h3>
                            <p class="mb-4">DIY tote bag drinking vinegar cronut adaptogen squid fanny pack vaporware.</p>
                            <span class="inline-flex">
                                <a class="text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                    </svg>
                                </a>
                                <a class="ml-2 text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                    </svg>
                                </a>
                                <a class="ml-2 text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                    </svg>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-4 lg:w-1/4 md:w-1/2">
                    <div class="h-full flex flex-col items-center text-center main">
                        <img alt="team" class="flex-shrink-0 rounded-lg w-full h-56 object-cover object-center mb-4" src="img/Favatar_1.jpg">
                        <div class="w-full">
                            <h2 class="title-font font-medium text-lg text-gray-900">Holden Caulfield</h2>
                            <h3 class="text-gray-500 mb-3">UI Developer</h3>
                            <p class="mb-4">DIY tote bag drinking vinegar cronut adaptogen squid fanny pack vaporware.</p>
                            <span class="inline-flex">
                                <a class="text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                    </svg>
                                </a>
                                <a class="ml-2 text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                    </svg>
                                </a>
                                <a class="ml-2 text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                    </svg>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-4 lg:w-1/4 md:w-1/2">
                    <div class="h-full flex flex-col items-center text-center main">
                        <img alt="team" class="flex-shrink-0 rounded-lg w-full h-56 object-cover object-center mb-4" src="img/Favatar_1.jpg">
                        <div class="w-full">
                            <h2 class="title-font font-medium text-lg text-gray-900">Atticus Finch</h2>
                            <h3 class="text-gray-500 mb-3">UI Developer</h3>
                            <p class="mb-4">DIY tote bag drinking vinegar cronut adaptogen squid fanny pack vaporware.</p>
                            <span class="inline-flex">
                                <a class="text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                    </svg>
                                </a>
                                <a class="ml-2 text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                    </svg>
                                </a>
                                <a class="ml-2 text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                    </svg>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-4 lg:w-1/4 md:w-1/2">
                    <div class="h-full flex flex-col items-center text-center main">
                        <img alt="team" class="flex-shrink-0 rounded-lg w-full h-56 object-cover object-center mb-4" src="img/Favatar_1.jpg">
                        <div class="w-full">
                            <h2 class="title-font font-medium text-lg text-gray-900">Henry Letham</h2>
                            <h3 class="text-gray-500 mb-3">UI Developer</h3>
                            <p class="mb-4">DIY tote bag drinking vinegar cronut adaptogen squid fanny pack vaporware.</p>
                            <span class="inline-flex">
                                <a class="text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                    </svg>
                                </a>
                                <a class="ml-2 text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                    </svg>
                                </a>
                                <a class="ml-2 text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                    </svg>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="foot">
        <div class="container">
            <footer class="d-flex flex justify-content-between align-items-center py-3 my-4 border-top">
                <p class="col-md-4 mb-0 text-muted">&copy; 2023 FMS, Inc</p>

                <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <!-- <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg> -->
                    <img src="img/logonew.jpg" width="40%" height="40%" alt="">
                </a>

                <ul class="nav  justify-content-center">
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
                </ul>

            </footer>
    </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>