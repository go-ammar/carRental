<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Clients - CarVoyage Rentals</title>
    <!-- Add your CSS styles or external CSS links here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">

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

            <section class="container">
                <h1>Our Valued Clients</h1>
                <p>At CarVoyage Rentals, we are proud to have served a diverse range of clients, each contributing to our success and growth. Here are some of the clients who have trusted us for their car rental needs:</p>
            </section>

            <section class="container row g-3">
                <h2>Testimonials</h2>
                <!-- Add client testimonials or quotes here -->
                <div class="testimonial col-md-6">
                    <div class="client-info">
                        <img src="john_doe.jpg" alt="John Doe">
                        <p>John Doe</p>
                    </div>
                    <blockquote>
                        "The best car rental service I've ever used! CarVoyage Rentals made my trip convenient and enjoyable. Highly recommended!"
                    </blockquote>
                </div>

                <div class="testimonial col-md-6">
                    <div class="client-info">
                        <img src="jane_smith.jpg" alt="Jane Smith">
                        <p>Jane Smith</p>
                    </div>
                    <blockquote>
                        "Outstanding fleet, excellent customer service, and affordable rates. CarVoyage Rentals is my go-to for every trip."
                    </blockquote>
                </div>


                <!-- Add more testimonials as needed -->

            </section>

            <section class="container">
                <h2>Our Partnerships</h2>
                <p>We have had the privilege of partnering with renowned organizations and businesses to enhance our services and provide added value to our clients. Our partnerships include collaborations with:</p>
                <ul>
                    <li>Travel Agencies</li>
                    <li>Hotels and Resorts</li>
                    <li>Event Management Companies</li>
                    <!-- Add more partnerships as needed -->
                </ul>
            </section>
        </div>
    </section>


    <?php
    include 'footer.php';
    ?>

    <!-- Add your JavaScript or external script links here -->

</body>

</html>