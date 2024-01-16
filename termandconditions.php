<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions - CarVoyage Rentals</title>
    <!-- Add your CSS styles or external CSS links here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="lib/style.css" rel="stylesheet">
    <style>
        .with-margin-top {
            margin-top: 2em;
            /* Adjust the value as needed */
        }
    </style>
</head>

<body>

    <?php

    session_start();

    // Check if the 'userType' session variable is set
    if (isset($_SESSION['userType'])) {
        if ($_SESSION['userType'] == "User") {
            include 'navbarRenter.php';
        } else if ($_SESSION['userType'] == "Renter") {
            include 'navbarOwner.php';
        } else {
            include 'navbarAdmin.php';
        }
    } else {
        include 'navbar.php';
    }

    ?>


    <!-- How It Works Section -->
    <section class="bg-dark card_signup rounded mx-auto p-5 with-margin-top">
        <div class="container card card-registration  mx-auto p-4">
            <h2 class="text-center">Terms and Conditions</h2>
            <br>
            <div class="row">
                <br>
                <p>Please read these terms and conditions carefully before using our car rental services.</p>
                <p>By accessing or using our services, you agree to comply with and be bound by these terms. If you do not
                    agree with any part of these terms, you may not use our services.</p>
                <h4>1. Rental Agreement</h4>
                <p>Your use of our car rental services is subject to the terms of the rental agreement provided at the time
                    of booking. Ensure you review and understand the terms outlined in the agreement.</p>
                <h4>2. Booking and Payments</h4>
                <p>All bookings are subject to availability. Payments, including rental fees and any additional charges, must
                    be made in accordance with the payment terms specified during the booking process.</p>
                <h4>3. Cancellation and Refunds</h4>
                <p>Review our cancellation and refund policy for information on canceling a booking and the applicable refund
                    process.</p>
                <h4>4. Vehicle Return</h4>
                <p>Return the rented vehicle on or before the agreed-upon drop-off time. Late returns may incur additional
                    charges.</p>
            </div>
        </div>
    </section>


    <?php
    include 'footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Add your JavaScript or external script links here -->

</body>

</html>