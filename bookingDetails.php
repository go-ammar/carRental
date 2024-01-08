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
                echo "Error deleting booking: " . $conn->error;
            }


            // echo "Delete Booking button pressed!";
        } else if (isset($_POST['editBooking'])) {



            $pickupTime = $_POST["pickUpDate"]  . ' ' . $_POST["pickUpTime"];
            $dropOffTime = $_POST["dropOffDate"]  . ' ' . $_POST["dropOffTime"];


            $dateTimeObject =  $pickupTime;
            // DateTime::createFromFormat("Y-m-d H:i", $pickupTime);
            $dateTimeObjectDrop = $dropOffTime;
            // DateTime::createFromFormat("Y-m-d H:i", $dropOffTime);

            $proposedStartDateTime = $dateTimeObject;
            $proposedEndDateTime = $dateTimeObjectDrop;
            $carId = $row['carId'];


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
                echo '<script>alert("Overlapping appointment exists. Cannot create a new appointment.");</script>';
            } else {


                $startTime = new DateTime($dateTimeObject);
                $endTime = new DateTime($proposedEndDateTime);

                // Calculate the difference in hours
                $interval = $startTime->diff($endTime);
                $totalHours = $interval->days * 24 + $interval->h + ($interval->i / 60);

                // Calculate the amount based on the total hours and hourly rate
                $amount = $totalHours * $row['rate'];


                $sql = "UPDATE appointments 
                SET startDateTime = '$dateTimeObject', endDateTime = '$proposedEndDateTime', amount = '$amount' 
                WHERE id = '$bookingId'";

                $result = $conn->query($sql);

                if ($result === TRUE) {
                    if ($_SESSION['userType'] == "Renter") {
                        header("Location: bookingListUser.php");
                    } else {
                        header("Location: bookingListAdmin.php");
                    }
                } else {
                    echo "Error updating booking: " . $conn->error;
                }
            }
        } else if (isset($_POST['giveFeedback'])) {
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


                                            <?php
                                            // Assuming you have the dynamic datetime string
                                            $dynamicDateTimeString = $row['startDateTime'];

                                            // Convert the datetime string to a DateTime object
                                            $dateTimeObject = new DateTime($dynamicDateTimeString);

                                            // Format the date and time components
                                            $formattedDate = $dateTimeObject->format("Y-m-d");
                                            $formattedTime = $dateTimeObject->format("H:i");


                                            $dynamicDateTimeStringDropOff = $row['endDateTime'];

                                            // Convert the datetime string to a DateTime object
                                            $dateTimeObject = new DateTime($dynamicDateTimeStringDropOff);

                                            // Format the date and time components
                                            $formattedDateDropOff = $dateTimeObject->format("Y-m-d");
                                            $formattedTimeDropOff = $dateTimeObject->format("H:i");

                                            // HTML form with pre-filled and editable date and time inputs
                                            ?>


                                            <form class="row g-3" action="" method="post">
                                                <div class="col-md-6">
                                                    <label for="pickUpDate" class="form-label fw-bold">Pick Up Date</label>
                                                    <input type="date" class="form-control" id="pickUpDate" name="pickUpDate" value="<?php echo $formattedDate; ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="pickUpTime" class="form-label fw-bold">Drop off Time</label>
                                                    <input type="time" class="form-control" id="pickUpTime" name="pickUpTime" value="<?php echo $formattedTime; ?>" required>
                                                </div>



                                                <div class="col-md-6">
                                                    <label for="dropOffDate" class="form-label fw-bold">Select Drop Off Date:</label>
                                                    <input type="date" class="form-control" id="dropOffDate" name="dropOffDate" value="<?php echo $formattedDateDropOff; ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="dropOffTime" class="form-label fw-bold">Select Drop Off Time:</label>
                                                    <input type="time" class="form-control" id="dropOffTime" name="dropOffTime" value="<?php echo $formattedTimeDropOff; ?>" required>
                                                </div>


                                                <div class="col-12">
                                                    <?php
                                                    if (isset($_SESSION['userType'])) {
                                                        if ($_SESSION['userType'] == "Renter" || $_SESSION['userType'] == "Admin") {
                                                            if ($row['status'] == "PENDING") {
                                                                echo '<button class="btn btn-danger" type="submit" name="deleteBooking">Delete Booking</button>';
                                                                echo '<button class="btn btn-primary mx-3" type="submit" name="editBooking">Edit Booking</button>';
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
            // function handleCardClick(cardName) {
            //     alert('Clicked on ' + cardName);
            //     window.location.href = 'vehicleDetails.php?cardName=' + encodeURIComponent(cardName);
            //     // Add your logic for what happens when a card is clicked
            //     // For example, you might redirect to a details page or show more information
            // }

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