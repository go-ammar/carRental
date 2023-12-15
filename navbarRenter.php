<?php
// navbar.php

// Start or resume the session

// Check if the user clicked on the "Logout" link
if (isset($_GET['logout'])) {
    // Unset specific session variable, replace 'userType' with your actual session variable
    unset($_SESSION['userType']);
    unset($_SESSION['userId']);

    // Alternatively, if you want to destroy the entire session, use:
    // session_destroy();
    // Redirect to the login page or another appropriate page
    header('Location: index.php');
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid sticky-top">
        <a class="navbar-brand" href="index.php">Navbar</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="index.php">Home</a>
                <a class="nav-link active" href="#">About Us</a>
                <a class="nav-link active" href="vehicleListing.php">Vehicles</a>
                <a class="nav-link active" href="#">Contact Us</a>
                <a class="nav-link active" href="#">Our Clients</a>
                <a class="nav-link active" href="#">Blogs</a>
                <a class="nav-link active" href="?logout=true">Sign Out</a>
                <a class="nav-link active" href="#">User</a>
            </div>
        </div>
    </div>
</nav>