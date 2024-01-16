<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Rent a Car Website
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="lib/style.css" rel="stylesheet">

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


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    }


    ?>


    <div id="carouselMain" class="carousel slide" data-bs-ride="carousel">


        <?php
        // Check if $_SESSION['userType'] is not set or is equal to "User"
        if (!isset($_SESSION['userType']) || $_SESSION['userType'] == "User") {
        ?>
            <section>
                <div class="container mainSearchBox">
                    <div class="col">
                        <div class="card card-registration  mx-auto mx-0">
                            <div class="row">
                                <div class="col">
                                    <div class="card-body p-md-5 text-black">
                                        <form class="row g-3" action="vehicleListing.php" method="post">
                                            <div class="col-md-3">
                                                <label for="pickUpDate">Select Pick Up Date:</label>
                                                <input type="date" class="form-control" id="pickUpDate" name="pickUpDate" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="pickUpTime">Select Pick Up Time:</label>
                                                <input type="time" class="form-control" id="pickUpTime" name="pickUpTime" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="dropOffDate">Select Drop Off Date:</label>
                                                <input type="date" class="form-control" id="dropOffDate" name="dropOffDate" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="dropOffTime">Select Drop Off Time:</label>
                                                <input type="time" class="form-control" id="dropOffTime" name="dropOffTime" required>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary" type="submit">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="assets/porsche.avif" class="d-block w-100 mw-25" alt="...">
                    </div>

                    <div class="carousel-item">
                        <img src="assets/unsplash-car.jpg" class="d-block w-100 mw-25" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/lady.jpg" class="d-block w-100 mw-25" alt="...">

                    </div>
                </div>

            </div>

            <div class="container">
                <h2 class="text-white text-center py-4">What type of car are you looking for?</h2>
            </div>

            <div class="container">
                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-md-3">
                        <div class="card" onclick="handleCardClick('Standard')">
                            <img src="assets/standard.png" class="card-img-top mx-auto" alt="Car 1">
                            <div class="card-body-home">
                                <h5 class="card-title text-center">Standard</h5>
                            </div>

                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-3">
                        <div class="card" onclick="handleCardClick('Luxury')">
                            <img src="assets/luxury.png" class="card-img-top mx-auto" alt="Car 2">
                            <div class="card-body-home">
                                <h5 class="card-title text-center">Luxury</h5>
                            </div>

                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-3">
                        <div class="card" onclick="handleCardClick('SUV')">
                            <img src="assets/suv.png" class="card-img-top mx-auto" alt="Car 3">
                            <div class="card-body-home">
                                <h5 class="card-title text-center">SUV</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-md-3" onclick="handleCardClick('Vans')">
                        <div class="card">
                            <img src="assets/van.png" class="card-img-top mx-auto" alt="Car 4">
                            <div class="card-body-home">
                                <h5 class="card-title text-center">Vans &amp; Coasters</h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <section class="bg-dark card_signup rounded mx-auto my-5 p-5">
                <div class="container card card-registration  mx-auto p-4">
                    <h2 class="text-center">How It Works</h2>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <h4>1. Search & Reserve</h4>
                            <p>Use our simple search tool to find the perfect car for your needs. Select pick-up and drop-off
                                dates and times, then hit "Search".</p>
                        </div>
                        <div class="col-md-4">
                            <h4>2. Choose Your Car</h4>
                            <p>Explore our diverse range of vehicles, including Standard, Luxury, SUVs, and Vans. Click on a
                                category to view available options.</p>
                        </div>
                        <div class="col-md-4">
                            <h4>3. Book & Enjoy</h4>
                            <p>Complete the reservation process, and you're ready to enjoy your journey. Our team is here to
                                assist you at every step.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Additional Section - About Us -->
            <section class="bg-dark card_signup rounded mx-auto my-5 p-5">
                <div class="container card card-registration mx-auto p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>About Our Car Rental Service</h2>
                            <br>
                            <p>
                                Welcome to CarVoyage Rentals, your go-to destination for hassle-free and reliable car rentals.
                                At CarVoyage Rentals, we pride ourselves on providing top-notch vehicles and excellent service
                                to make your journeys memorable.
                            </p>
                            <p>
                                Our extensive fleet of cars includes a variety of options to suit your needs, whether you're
                                looking for a standard car, a luxurious ride, a spacious SUV, or practical vans and coasters.
                                We offer flexible rental durations, competitive rates, and a seamless booking experience.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <img src="assets/about-us.png" class="img-fluid" alt="About Us Image">
                        </div>
                    </div>
                </div>
            </section>
        <?php
        } else {

        ?>

            <section class="bg-dark card_signup rounded mx-auto my-5 p-5">
                <div class="container card card-registration  mx-auto p-4">
                    <h2 class="text-center">How It Works</h2>
                    <br>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <h4>Register &amp; List Your Car</h4>
                            <p>Sign up and create your account as a car owner.
                                Access the car listing section to add details about your vehicle.
                                Provide information such as make, model, year, and any special features.</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>Set Availability &amp; Pricing</h4>
                            <p>Choose the dates and times when your car will be available for rent.
                                Set pricing details, including daily or hourly rates.
                                Specify any additional fees or conditions for renters.</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <h4>Prepare Your Car</h4>
                            <p>Coordinate with the renter to arrange the pick-up location and handover details.
                                Ensure your car is clean, fueled, and ready for the renter.</p>
                        </div>
                        <div class="col-md-12 mx-auto text-center">
                            <h4>Earn &amp; Get Feedback</h4>
                            <p>Earn money for each successful rental.
                                Receive feedback from renters to build trust and improve your car's reputation.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Additional Section - About Us -->
            <section class="bg-dark card_signup rounded mx-auto my-5 p-5">
                <div class="container card card-registration mx-auto p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>About Our Car Rental Service</h2>
                            <br>
                            <p>
                                Welcome to CarVoyage Rentals, your go-to destination for hassle-free and reliable car rentals.
                                At CarVoyage Rentals, we pride ourselves on providing top-notch vehicles and excellent service
                                to make your journeys memorable.
                            </p>
                            <p>
                                Our extensive fleet of cars includes a variety of options to suit your needs, whether you're
                                looking for a standard car, a luxurious ride, a spacious SUV, or practical vans and coasters.
                                We offer flexible rental durations, competitive rates, and a seamless booking experience.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <img src="assets/about-us.png" class="img-fluid" alt="About Us Image">
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
        ?>







        <!-- How It Works Section -->




        <?php
        include 'footer.php';
        ?>



        <script>
            function handleCardClick(carType) {
                window.location.href = 'vehicleListing.php?carType=' + encodeURIComponent(carType);
            }
        </script>


        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>