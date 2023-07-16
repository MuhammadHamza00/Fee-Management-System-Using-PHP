<div class="d-flex grow flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 25%;height:100vh;border-radius:1rem;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap" />
        </svg>
       
    </a>
    <!-- <img src="Favatar_1.jpg" class="rounded-circle mb-3 " style="width: 150px;" alt="Avatar"> -->
   <div class="admin"style="display:flex;justify-content:center;align-items:center;flex-direction:column;">

       <svg xmlns="http://www.w3.org/2000/svg" width="6rem" height="6rem" fill="currentColor" class="bi bi-person"  viewBox="0 0 16 16">
           <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
       </svg>
   
       <!-- <i class="bi bi-person"></i> -->
       <h5 class="mb-2"><strong>Username</strong></h5>
       <p class="text-muted"><span class="badge bg-primary">Operator</span></p>
   </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">

    <li class="nav-item">
        <a id="fee-constraints-link" href="oppannel.php" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16">
                <use xlink:href="#home" />
            </svg>
            Manage Students
        </a>
    </li>

    <li class="nav-item">
        <a id="complaint-link" href="../form/incop/complain.php" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16">
                <use xlink:href="#table" />
            </svg>
            Complains
        </a>
    </li>

</ul>

<script>
    // Get the current URL
    var currentUrl = window.location.href;

    // Check the current URL and update the active page accordingly
    if (currentUrl.includes("oppannel")) {
        document.getElementById("fee-constraints-link").classList.add("active");
    }else if (currentUrl.includes("complain.op")) {
        document.getElementById("complaint-link").classList.add("active");
    }
    
    // Add more if statements for other pages and links
</script>

    <hr>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Logout</button>
</div>