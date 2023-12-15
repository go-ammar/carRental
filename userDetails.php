<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        My Vehicles
    </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="lib/style.css" rel="stylesheet">



</head>

<body>

    <?php

    session_start();

    include 'navbarAdmin.php';

    ?>

    <div>



        <div class="container">
            <h2 class="text-white text-center py-4">User Details</h2>
        </div>



        <?php
        include 'connection.php';

        if (isset($_GET['userId'])) {
            $userId = $_GET['userId'];
        }

        $sql = "SELECT * FROM vehiclestable where userId = '$userId'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $counter = 0;
            while ($row = $result->fetch_assoc()) {
                // Access individual columns of the current row using $row['column_name']
                $name = $row['carName'];
                $carId = $row['id'];
                // $image = $row['image'];

                if ($counter % 4 == 0) {
                    // Start a new row after every 4 cars
                    echo '<div class="row mx-5 py-4">';
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

        <button class="fab" onclick="handleFabClick()"><i class="fas fa-plus"></i></button>



        <?php
        include 'footer.php';
        ?>


        <script>
            function handleFabClick() {
                // Add your logic for what happens when the FAB is clicked
                window.location.href = 'addVehicle.php';
            }

            function handleCardClick(carId) {
                window.location.href = 'editVehicle.php?carId=' + encodeURIComponent(carId);
            }
        </script>


        <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>