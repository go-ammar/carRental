<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Dashboard
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="lib/style.css" rel="stylesheet">

</head>

<body>

    <?php

    session_start();

    include 'connection.php';

    include 'navbarAdmin.php';

    ?>


    <div id="carouselMain" class="carousel slide" data-bs-ride="carousel">


        <?php
        // Assuming you have a database connection established ($conn)
        // Fetch users with userType 0
        $sql = "SELECT * FROM userinfo WHERE userType = 'User'";
        $result = $conn->query($sql);

        // Check if there are users with userType 0
        if ($result->num_rows > 0) {
            echo '<section>';
            echo '    <div class="container">';
            echo '        <div class="col">';
            echo '            <div class="card card-registration rounded my-5 mx-auto">';
            echo '                <div class="row">';
            echo '                    <div class="col">';
            echo '                        <div class="card-body p-md-5 text-black">';
            echo '                            <h1 class="headingSignup">Renters</h1>';

            // Display a form to filter users (if needed)

            // Display the list of users
            echo '                            <ul>';
            while ($row = $result->fetch_assoc()) {
                echo '                                <li>';
                echo '                                    <a href="userDetails.php?userId=' . $row['id'] . '">' . $row['lName'] . '</a>';
                echo '                                </li>';
            }
            echo '                            </ul>';

            echo '                        </div>';
            echo '                    </div>';
            echo '                </div>';
            echo '            </div>';
            echo '        </div>';
            echo '    </div>';
            echo '</section>';
        } else {
            // No users with userType 0 found
            echo '<section>';
            echo '    <div class="container">';
            echo '        <div class="col">';
            echo '            <div class="card card-registration rounded my-5 mx-auto">';
            echo '                <div class="row">';
            echo '                    <div class="col">';
            echo '                        <div class="card-body p-md-5 text-black">';
            echo '                            <h1 class="headingSignup">Renters</h1>';
            echo 'No renters found.';
            echo '                        </div>';
            echo '                    </div>';
            echo '                </div>';
            echo '            </div>';
            echo '        </div>';
            echo '    </div>';
            echo '</section>';
        }
        ?>

        <?php
        // Assuming you have a database connection established ($conn)

        // Fetch users with userType 0
        $sql = "SELECT * FROM userinfo WHERE userType = 'Renter'";
        $result = $conn->query($sql);

        // Check if there are users with userType 0
        if ($result->num_rows > 0) {
            echo '<section>';
            echo '    <div class="container">';
            echo '        <div class="col">';
            echo '            <div class="card card-registration rounded my-5 mx-auto">';
            echo '                <div class="row">';
            echo '                    <div class="col">';
            echo '                        <div class="card-body p-md-5 text-black">';
            echo '                            <h1 class="headingSignup">Drivers</h1>';

            // Display a form to filter users (if needed)

            // Display the list of users
            echo '                            <ul>';
            while ($row = $result->fetch_assoc()) {
                echo '                                <li>';
                echo '                                    <a href="userDetails.php?userId=' . $row['id'] . '">' . $row['lName'] . '</a>';
                echo '                                </li>';
            }
            echo '                            </ul>';

            echo '                        </div>';
            echo '                    </div>';
            echo '                </div>';
            echo '            </div>';
            echo '        </div>';
            echo '    </div>';
            echo '</section>';
        } else {
            // No users with userType 0 found
            echo '<section>';
            echo '    <div class="container">';
            echo '        <div class="col">';
            echo '            <div class="card card-registration rounded my-5 mx-auto">';
            echo '                <div class="row">';
            echo '                    <div class="col">';
            echo '                        <div class="card-body p-md-5 text-black">';
            echo '                            <h1 class="headingSignup">Drivers</h1>';

            echo 'No Drivers found.';
            echo '                        </div>';
            echo '                    </div>';
            echo '                </div>';
            echo '            </div>';
            echo '        </div>';
            echo '    </div>';
            echo '</section>';
        }
        ?>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>