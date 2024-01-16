<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vehicle Rating</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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


    // if ($_SERVER["REQUEST_METHOD"] == "GET") {


    // if (isset($_GET['carId'])) {

    $userId = $_SESSION['userId'];


    $query = "SELECT v.carName, cf.rating, cf.comments
            FROM carfeedback cf
            JOIN vehiclestable v ON cf.carId = v.id
            WHERE v.userId = ?";


    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();



    // Check if there is feedback
    if ($result->num_rows > 0) {

        echo ' <div id="carouselMain" class="carousel slide" data-bs-ride="carousel p-5">';

        echo '<section>';


        echo '<div class="conatiner mx-auto p-5">';
        echo '<div class="row bg-dark rounded">';
        echo '<div class="col p-5 rounded">';
        echo '<div class="card  ">';
        echo '                    <div class="card-body p-md-5">';
        echo '                        <h1 class="headingSignup">Your ratings</h1>';

        echo '<ul class="list-group">';

        // Display feedback for each car
        while ($row = $result->fetch_assoc()) {
            echo '<li class="list-group-item col-md-12">';
            echo '<strong>Car Name:</strong> ' . $row['carName'] . '<br>';
            echo '<strong>Rating:</strong> ' . $row['rating'] . '<br>';
            echo '<strong>Comments:</strong> ' . $row['comments'];
            echo '</li>';
        }

        echo '</ul>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</section>';
        echo '</div>';
    } else {
        echo '<div class="container">';
        echo '<p>No feedback available for Car ID: ' . $carid . '</p>';
        echo '</div>';
    }

    // Close the database connection
    $stmt->close();
    // }
    // }

    ?>



    <!-- <div class="bg-dark card_signup rounded mx-auto my-5 p-5">

        <section>
            <div class="container">
                <div class="col">
                    <div class="card card-registration  mx-auto ">
                        <div class="row">

                            <div class="col">
                                <div class="card-body p-md-5 text-black">
                                    <h1 class="headingSignup">Rate the vehicle!</h1>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

    </div> -->




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>