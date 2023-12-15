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


        <?php
        include 'footer.php';
        ?>



        <script>
            function handleCardClick(carType) {
                window.location.href = 'vehicleListing.php?carType=' + encodeURIComponent(carType);
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>