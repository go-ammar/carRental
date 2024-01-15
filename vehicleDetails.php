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

    if (isset($_GET['carId'])) {
        $carId = $_GET['carId'];

        $sql = "SELECT * FROM vehiclestable where id = '$carId'";
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


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_SESSION['userType'])) {
            $pickupTime = $_POST["pickUpDate"]  . ' ' . $_POST["pickUpTime"];


            $dropOffTime = $_POST["dropOffDate"]  . ' ' . $_POST["dropOffTime"];


            $dateTimeObject =  $pickupTime;
            // DateTime::createFromFormat("Y-m-d H:i", $pickupTime);
            $dateTimeObjectDrop = $dropOffTime;
            // DateTime::createFromFormat("Y-m-d H:i", $dropOffTime);

            $proposedStartDateTime = $dateTimeObject;
            $proposedEndDateTime = $dateTimeObjectDrop;
            $carId = $_GET['carId'];


            // Check for overlapping appointments
            $sql = "SELECT * FROM appointments
    WHERE carId = '$carId' 
    AND (
      ('$proposedStartDateTime' BETWEEN startDateTime AND endDateTime)
      OR ('$proposedEndDateTime' BETWEEN startDateTime AND endDateTime)
      OR (startDateTime BETWEEN '$proposedStartDateTime' AND '$proposedEndDateTime')
      OR (endDateTime BETWEEN '$proposedStartDateTime' AND '$proposedEndDateTime')
    )";

            $resultAppointment = $conn->query($sql);


            if ($resultAppointment->num_rows > 0) {
                $rowApp = $result->fetch_assoc();
                echo "Overlapping appointment exists. Cannot create a new appointment.";
            } else {


                $startTime = new DateTime($dateTimeObject);
                $endTime = new DateTime($proposedEndDateTime);

                // Calculate the difference in hours
                $interval = $startTime->diff($endTime);
                $totalHours = $interval->days * 24 + $interval->h + ($interval->i / 60);

                // Calculate the amount based on the total hours and hourly rate
                $amount = $totalHours * $row['rate'];


                // $userId = $_SESSION['userId'];
                $sql = "INSERT INTO appointments (renterId, status, carId, startDateTime, endDateTime, amount)
                VALUES ('$userId', 'PENDING', '$carId', '$dateTimeObject', '$proposedEndDateTime', '$amount')";
                $appointmentMade = $conn->query($sql);


                $param1 = 'value1';
                $param2 = 'value2';

                // Construct the URL with query parameters
                $nextScreenUrl = 'terms.php?carId=' . urlencode($carId) . '&dateTimeObject=' . urlencode($dateTimeObject)
                    . '&proposedEndDateTime=' . urldecode($proposedEndDateTime) . '&amount=' . urlencode($amount);

                header("Location: $nextScreenUrl");
            }
        } else {
            header("Location: loginPage.php");
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

                                            <?php

                                            if (isset($_SESSION['userType'])) {
                                                // Display the form only if 'userType' is set
                                            ?>
                                                <form class="row g-3" method="post">
                                                    <!-- Your form fields go here -->
                                                    <div class="col-md-6">
                                                        <label for="pickUpDate">Select Pick Up Date:</label>
                                                        <input type="date" class="form-control" id="pickUpDate" name="pickUpDate" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="pickUpTime">Select Pick Up Time:</label>
                                                        <input type="time" class="form-control" id="pickUpTime" name="pickUpTime" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="dropOffDate">Select Drop Off Date:</label>
                                                        <input type="date" class="form-control" id="dropOffDate" name="dropOffDate" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="dropOffTime">Select Drop Off Time:</label>
                                                        <input type="time" class="form-control" id="dropOffTime" name="dropOffTime" required>
                                                    </div>

                                                    <div class="col-12">
                                                        <!-- <div id="paypal-button-container"></div> -->
                                                        <button type="submit" class="btn btn-primary">Book Car</button>
                                                    </div>
                                                </form>
                                            <?php
                                            } else {
                                                // Display the login button if 'userType' is not set
                                            ?>
                                                <div class="col-12">
                                                    <button class="btn btn-primary" onclick="location.href='loginPage.php';">Login First</button>
                                                </div>
                                            <?php
                                            }
                                            ?>



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


        <!-- <script src="https://www.paypal.com/sdk/js?client-id=AcbE5AUFX3oO0svUNmmL4lhhoAao9Gu94UI6RJgP3BF32z9Vaec_o7tV8_LOmqcIiJ2hGDMHm9MOrLmf"></script> -->



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


            // paypal.Buttons({
            //     createOrder: function(data, actions) {
            //         // Set up the transaction
            //         return actions.order.create({
            //             purchase_units: [{
            //                 amount: {
            //                     value: '10.00', // Replace with the actual payment amount
            //                     currency_code: 'USD' // Replace with the currency code
            //                 }
            //             }]
            //         });
            //     },
            //     onApprove: async function(data, actions) {
            //         // Capture the funds from the transaction

            //     },
            //     onError: function(err) {
            //         // Handle errors during the transaction
            //         console.error(err);
            //         alert('Error during payment. Please try again.');
            //     }
            // }).render('#paypal-button-container');
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