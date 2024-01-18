<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Rent a Car Website
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            <h2 class="text-white text-center py-4">Which car are you looking for?</h2>
        </div>

        <div class="row mx-4 py-4">
            <form method="post" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2 py-2 text-center" type="text" name="carName" placeholder="Search by Car Name" required>
                <!-- <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button> -->
            </form>
        </div>

        <?php
        include 'connection.php';


        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pickUpDate"])) {

            $pickUpTime = $_POST["pickUpDate"] . " " . $_POST["pickUpTime"];
            $dropOffTime = $_POST["dropOffDate"] . " " . $_POST["dropOffTime"];
            $sql = "SELECT
            vt.id,
            vt.model,
            vt.make,
            vt.carName,
            AVG(cf.rating) AS avgRating
        FROM
            vehiclesTable vt
        LEFT JOIN
            appointments a ON vt.id = a.carId
        LEFT JOIN
            carFeedback cf ON vt.id = cf.carId
        WHERE
            (a.startDateTime IS NULL OR a.startDateTime > '$dropOffTime' OR a.endDateTime < '$pickUpTime')
        GROUP BY
            vt.id, vt.model, vt.make, vt.carName;";

            $result = $conn->query($sql);
        } else if (isset($_GET['carType'])) {
            $carType = $_GET['carType'];

            $sql = "SELECT
            v.*,
            (SELECT AVG(cf.rating) FROM carFeedback cf WHERE cf.carId = v.id) AS avgRating
        FROM
            vehiclestable v
        WHERE
            v.vehicleType = '$carType'";
            $result = $conn->query($sql);
        } else if (isset($_POST["carName"])) {
            $searchTerm = $_POST["carName"];
            // Sanitize the input to prevent SQL injection (you can use prepared statements)
            $searchTerm = mysqli_real_escape_string($conn, $searchTerm);
            $sql = "SELECT * FROM vehiclesTable WHERE carName LIKE '%$searchTerm%'";
            $result = $conn->query($sql);
        } else {

            $sql = "SELECT
            v.*, 
            AVG(cf.rating) AS avgRating
        FROM
            vehiclestable v
        LEFT JOIN
            carFeedback cf ON v.id = cf.carId
        GROUP BY
            v.id;";
            $result = $conn->query($sql);
        }


        if ($result->num_rows > 0) {

            $counter = 0;
            while ($row = $result->fetch_assoc()) {
                // Access individual columns of the current row using $row['column_name']
                $name = $row['carName'];
                $carId = $row['id'];
                $carRating = $row['avgRating'];
                // $image = $row['image'];

                if ($counter % 4 == 0) {
                    // Start a new row after every 4 cars
                    echo '<div class="row mx-4 py-4">';
                }

                echo '<div class="col-md-3" onclick="handleCardClick(\'' . $carId . '\')">';
                echo '<div class="card">';
                echo '<img src="assets/luxury.png'  . '" class="card-img-top mx-auto" alt="' . $name . '">';
                echo '<div class="card-body-home">';
                echo '<h5 class="card-title text-center">' . $name . ' <span class="Simplestar">' . ' &#9733 ' . ' </span>' . round($carRating, 1) . '</h5>';

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
            var userType = "<?php echo isset($_SESSION['userType']) ? $_SESSION['userType'] : ''; ?>";

            function handleCardClick(carId) {
                // alert('Clicked on ' + cardName);

                if (userType == "User") {
                    window.location.href = 'vehicleDetails.php?carId=' + encodeURIComponent(carId);
                } else if (userType == "Admin") {
                    window.location.href = 'editVehicle.php?carId=' + encodeURIComponent(carId);
                } else {
                    window.location.href = 'vehicleDetails.php?carId=' + encodeURIComponent(carId);
                }
            }
        </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>


        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>