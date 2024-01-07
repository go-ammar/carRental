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

    include 'connection.php';
    session_start();

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

    if (isset($_GET['bookingId'])) {
        $bookingId = $_GET['bookingId'];

        $userId = $_SESSION['userId'];

        $sql = "SELECT a.*, v.*
        FROM appointments a
        INNER JOIN vehiclesTable v ON a.carId = v.id
        WHERE a.id = '$bookingId'
        ORDER BY a.startDateTime";

        // SELECT * FROM appointments WHERE renterId =  ORDER BY startDateTime";
        $result = $conn->query($sql);

        // echo "<script>console.log('Debug Objects: " . $result . "' );</script>";
        // " car is '$result'";
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "0 results";
        }
    } else {
        // Handle the case when cardName parameter is not provided
        echo "Card name parameter not found.";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['deleteBooking'])) {
            // Delete Booking logic
            $sql = "DELETE FROM appointments WHERE id = '$bookingId'";

            if ($conn->query($sql) === TRUE) {
                if ($_SESSION['userType'] == "Renter") {
                    header("Location: bookingListUser.php");
                } else {
                    header("Location: bookingListAdmin.php");
                }
            } else {
                echo "Error deleting car: " . $conn->error;
            }


            echo "Delete Booking button pressed!";
        } elseif (isset($_POST['giveFeedback'])) {
            // Give Feedback logic
            echo "Give Feedback button pressed!";
        }
    }

    ?>

    <div>


        <div class="bg-dark card_signup rounded mx-auto my-5 p-5 ">

            <section>
                <div class="container">
                    <div class="col">
                        <div class="card card-registration  mx-auto mx-0">
                            <div class="row">

                                <div class="col">
                                    <div class="card-body p-md-5 text-black">
                                        <h1 class="headingSignup">Vehicle Details</h1>

                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label for="carModel" class="form-label fw-bold">Model</label>
                                                <p><?php echo $row['model']; ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="carMake" class="form-label fw-bold">Make</label>
                                                <p><?php echo $row['make']; ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="carName" class="form-label fw-bold">Name</label>
                                                <p><?php echo $row['carName']; ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="carMileage" class="form-label fw-bold">Mileage</label>
                                                <p><?php echo $row['mileage']; ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="carNumber" class="form-label fw-bold">Car Number</label>
                                                <p><?php echo $row['carNumber']; ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="dailyRate" class="form-label fw-bold">Rate (GBP per Hour)</label>
                                                <p><?php echo $row['rate']; ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="carPostCode" class="form-label fw-bold">Post Code</label>
                                                <p><?php echo $row['postCode']; ?></p>
                                            </div>
                                            <!-- <div class="col-md-6">
                                                <label for="photosFile" class="form-label">Uploaded Photos</label>
                                                Display file names or other relevant information
                                                <?php
                                                // Assuming you have stored file information in the database
                                                // $photos = explode(",", $row['photos']); // Adjust this based on your actual data structure
                                                // foreach ($photos as $photo) {
                                                // echo "<p>$photo</p>";
                                                // }
                                                ?>
                                            </div> -->
                                            <div class="col-md-3">
                                                <label for="vehicleType" class="form-label fw-bold">Vehicle Type</label>
                                                <p><?php echo $row['vehicleType']; ?></p>
                                            </div>



                                            <form class="row g-3" action="" method="post">
                                                <div class="col-md-6">
                                                    <label for="pickUpDate" class="form-label fw-bold">Pick Up Date</label>
                                                    <p><?php echo $row['startDateTime']; ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="pickUpTime" class="form-label fw-bold">Drop off Time</label>
                                                    <p><?php echo $row['endDateTime']; ?></p>
                                                </div>

                                                <div class="col-12">
                                                    <?php
                                                    if (isset($_SESSION['userType'])) {
                                                        if ($_SESSION['userType'] == "Renter" || $_SESSION['userType'] == "Admin") {
                                                            if ($row['status'] == "PENDING") {
                                                                echo '<button class="btn btn-danger" type="submit" name="deleteBooking">Delete Booking</button>';
                                                            } else if ($row['status'] == "COMPLETED") {
                                                                echo '<button class="btn btn-primary" type="submit" name="feedback">Give Feedback</button>';
                                                            }
                                                        } else {
                                                            // echo '<p class="text-muted">This vehicle details are read-only.</p>';
                                                        }
                                                    }
                                                    ?>
                                                    <!-- Add a message indicating that the details are read-only -->
                                                </div>



                                            </form>



                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>



        <?php
        include 'footer.php';
        ?>





        <script>
            function handleCardClick(cardName) {
                alert('Clicked on ' + cardName);
                window.location.href = 'vehicleDetails.php?cardName=' + encodeURIComponent(cardName);
                // Add your logic for what happens when a card is clicked
                // For example, you might redirect to a details page or show more information
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Get references to the pickUpDate, pickUpTime, dropOffDate, and dropOffTime inputs
                var pickUpDateInput = document.getElementById('pickUpDate');
                var pickUpTimeInput = document.getElementById('pickUpTime');
                var dropOffDateInput = document.getElementById('dropOffDate');
                var dropOffTimeInput = document.getElementById('dropOffTime');

                // Add an event listener to the pickUpDate input
                pickUpDateInput.addEventListener('input', function() {
                    // Set the min attribute of dropOffDate to be the value of pickUpDate
                    dropOffDateInput.min = pickUpDateInput.value;

                    // Set the value of dropOffTime to be the current time
                    dropOffTimeInput.value = pickUpTimeInput.value;
                    checkDropOffTime();
                });

                // Add an event listener to the pickUpTime input
                pickUpTimeInput.addEventListener('input', function() {
                    // Set the value of dropOffTime to be the value of pickUpTime
                    dropOffTimeInput.value = pickUpTimeInput.value;
                    checkDropOffTime();
                });

                // Add an event listener to the dropOffTime input
                dropOffTimeInput.addEventListener('input', function() {
                    checkDropOffTime();
                });

                function checkDropOffTime() {
                    // Check if the date for pickup and dropoff is the same
                    if (pickUpDateInput.value === dropOffDateInput.value) {
                        // If the date is the same, ensure dropoff time is after pickup time
                        if (dropOffTimeInput.value <= pickUpTimeInput.value) {
                            // If not, set dropoff time to be after pickup time
                            dropOffTimeInput.value = pickUpTimeInput.value;
                        }
                    }
                }
            });
        </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>


        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

        <!-- Moment.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>


</body>

</html>