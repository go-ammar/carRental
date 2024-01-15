<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs - CarVoyage Rentals</title>
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
            <section class="container">
                <h1>Welcome to Our Blogs</h1>
                <p>Explore the latest trends, travel tips, and exciting adventures in the world of car rentals. Our blogs cover a wide range of topics to enhance your travel experience and keep you informed. Whether you're a road trip enthusiast, a savvy traveler, or simply curious about the world of cars, you'll find something interesting here.</p>
            </section>

            <section class="container">
                <h2>Latest Articles</h2>

                <article>
                    <h3>1. Top Road Trip Destinations for Every Season</h3>
                    <p>Discover the best road trip destinations for every season. From scenic coastal drives to breathtaking mountain routes, we've curated a list of must-visit locations that promise unforgettable journeys.</p>
                </article>

                <article>
                    <h3>2. Choosing the Right Rental Car: A Comprehensive Guide</h3>
                    <p>Confused about which rental car suits your needs? Our guide breaks down the different car types, fuel options, and additional features to help you make an informed decision for your next adventure.</p>
                </article>

                <!-- Add more articles as needed -->

            </section>

            <section class="container">
                <h2>Travel Inspiration</h2>

                <article>
                    <h3>1. Road Trip Diaries: Tales from the Highway</h3>
                    <p>Embark on a virtual road trip with our travel diaries. Follow our team as they share their most memorable moments, stunning landscapes, and unexpected discoveries on the road.</p>
                </article>

                <article>
                    <h3>2. Car Culture Chronicles: Classic Cars and Modern Wonders</h3>
                    <p>Immerse yourself in the world of cars. From classic beauties to cutting-edge innovations, our car culture chronicles celebrate the diversity and artistry of automobiles.</p>
                </article>

                <!-- Add more articles as needed -->

            </section>

            <section class="container">
                <h2>Stay Connected</h2>
                <p>Stay updated with our latest blogs by subscribing to our newsletter. Receive travel insights, special offers, and exclusive content directly to your inbox. Follow us on social media for real-time updates, travel inspiration, and community engagement.</p>
            </section>
        </div>
    </section>


    <?php
    include 'footer.php';
    ?>

    <!-- Add your JavaScript or external script links here -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>