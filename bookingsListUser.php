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

    <div>



        <div class="container">
            <h2 class="text-white text-center py-4">What type of car are you looking for?</h2>
        </div>

        <?php
        include 'connection.php';


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Retrieve available cars




            $pickUpTime = $_POST["pickUpDate"] . " " . $_POST["pickUpTime"];
            $dropOffTime = $_POST["dropOffDate"] . " " . $_POST["dropOffTime"];
            // $dropOffTime = $_POST["dropOffTime"];

            echo $pickUpTime;
            echo " ---  ";
            echo $dropOffTime;

            $sql = "SELECT vt.id, vt.model, vt.make, vt.carName
FROM vehiclesTable vt
LEFT JOIN appointments a ON vt.id = a.carId
WHERE (a.startDateTime IS NULL OR a.startDateTime > '$dropOffTime' OR a.endDateTime < '$pickUpTime')";

            $result = $conn->query($sql);
            // if ($result->num_rows > 0) {
            //     // Output the available cars
            //     while ($row = $result->fetch_assoc()) {
            //         echo "Car ID: " . $row["id"] . ", Model: " . $row["model"] . ", Make: " . $row["make"] . ", Car Name: " . $row["carName"] . "<br>";
            //     }
            // } else {
            //     echo "No available cars for the specified time range.";
            // }

        } else if (isset($_GET['carType'])) {
            $carType = $_GET['carType'];

            $sql = "SELECT * FROM vehiclestable where vehicleType = '$carType'";
            $result = $conn->query($sql);
        } else {
            $sql = "SELECT * FROM vehiclestable";
            $result = $conn->query($sql);
        }


        if ($result->num_rows > 0) {

            $counter = 0;
            while ($row = $result->fetch_assoc()) {
                // Access individual columns of the current row using $row['column_name']
                $name = $row['carName'];
                $carId = $row['id'];
                // $image = $row['image'];

                if ($counter % 4 == 0) {
                    // Start a new row after every 4 cars
                    echo '<div class="row mx-4 py-4">';
                }

                echo '<div class="col-md-3" onclick="handleCardClick(\'' . $carId . '\')">';
                echo '<div class="card">';
                echo '<img src="assets/luxury.png'  . '" class="card-img-top mx-auto" alt="' . $name . '">';
                echo '<div class="card-body-home">';
                echo '<h5 class="card-title text-center">' . $name . '</h5>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                $counter++;

                if ($counter % 4 == 0) {
                    // Close the row after every 4 cars
                    echo '</div>';
                }
            }
            if ($counter % 4 !== 0) {
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        ?>



        <?php
        include 'footer.php';
        ?>

        <script>
            function handleCardClick(carId) {
                // alert('Clicked on ' + cardName);
                window.location.href = 'vehicleDetails.php?carId=' + encodeURIComponent(carId);
            }
        </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>



</body>

</html>