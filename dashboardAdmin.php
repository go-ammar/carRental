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


        $sql = "SELECT 
        userinfo.id AS id, 
        userinfo.fName AS fName, 
        userinfo.lName AS lName,
        COUNT(DISTINCT appointments.id) AS numberOfBookings,
        COUNT(DISTINCT vehiclestable.id) AS numberOfCars,
        COALESCE(SUM(appointments.amount), 0) AS totalAmount,
        COALESCE(AVG(appointments.amount), 0) AS avgAmount,
        COALESCE(overall_avg.avgAmountAllUsers, 0) AS overallAvg
    FROM 
        userinfo
    LEFT JOIN vehiclestable ON userinfo.id = vehiclestable.userId
    LEFT JOIN appointments ON vehiclestable.id = appointments.carId
    CROSS JOIN (SELECT AVG(amount) AS avgAmountAllUsers FROM appointments) AS overall_avg
    WHERE 
        userinfo.userType = 'Renter'
    GROUP BY 
        userinfo.id, userinfo.fName, userinfo.lName, overall_avg.avgAmountAllUsers;";


        $result = $conn->query($sql);

        // Check if there are users with userType 0
        if ($result->num_rows > 0) {
            echo '<section>';
            echo '    <div class="container">';
            echo '        <div class="row">';
            echo '            <div class="col">';
            echo '                <div class="card my-5">';
            echo '                    <div class="card-body p-md-5">';
            echo '                        <h1 class="headingSignup">Drivers</h1>';
            echo '                        <div class="table-responsive">';
            echo '                            <table class="table table-hover">';
            echo '                                <thead>';
            echo '                                    <tr class ="text-center">';
            echo '                                        <th>Name</th>';
            echo '                                        <th>Number of Cars</th>';
            echo '                                        <th>Number of Bookings</th>';
            echo '                                        <th>Average Amount per Booking</th>';
            echo '                                        <th>Total Amount Earned</th>';
            echo '                                        <th>Action</th>';
            echo '                                    </tr>';
            echo '                                </thead>';
            echo '                                <tbody>';

            $rowCount = 0;
            $totalRows = $result->num_rows;

            // Display the list of users
            while ($row = $result->fetch_assoc()) {
                echo '                                <tr class ="text-center">';
                echo '                                    <td  class ="py-3">' . $row['fName'] . " " . $row['lName'] . '</a></td>';
                echo '                                    <td class ="py-3">' . $row['numberOfCars'] . '</td>'; // Assuming 'numberOfCars' is a field in your database
                echo '                                    <td class ="py-3">' . $row['numberOfBookings'] . '</td>'; // Assuming 'numberOfCars' is a field in your database
                echo '                                    <td class="py-3">';
                echo '                                        <span';

                // Check if avgAmount is greater than overallAvg
                if ($row['avgAmount'] >= $row['overallAvg']) {
                    echo ' class="custom-teal text-dark rounded-pill py-2 px-3"'; // Add dark text and rounded corners class
                } elseif ($row['avgAmount'] >= 0.8 * $row['overallAvg']) {
                    echo ' class="bg-warning text-dark rounded-pill py-2 px-3"'; // Add a warning background, dark text, and rounded corners class
                } else {
                    echo ' class="bg-danger text-dark rounded-pill py-2 px-3"'; // Add a danger background, dark text, and rounded corners class
                }

                echo '>' . number_format($row['avgAmount'], 2) . '</span></td>';
                echo '                                    <td class ="py-3">' . number_format($row['totalAmount'], 2) . '</td>'; // Assuming 'amountEarned' is a field in your database
                echo '                                    <td class ="py-3"><a href="userDetails.php?userId=' . $row['id'] . '">View Details</a></td>';
                echo '                                </tr>';

                // Check if it's not the last row
                // if (++$rowCount !== $totalRows) {
                //     echo '                                <tr class="spacer"><td colspan="5"></td></tr>'; // Add a spacer row
                // }
            }

            echo '                                </tbody>';
            echo '                            </table>';
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


        <?php
        // Assuming you have a database connection established ($conn)
        // Fetch users with userType User
        $sql = "SELECT * FROM userinfo WHERE userType = '0'";
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
            // echo '<section>';
            // echo '    <div class="container">';
            // echo '        <div class="col">';
            // echo '            <div class="card card-registration rounded my-5 mx-auto">';
            // echo '                <div class="row">';
            // echo '                    <div class="col">';
            // echo '                        <div class="card-body p-md-5 text-black">';
            // echo '                            <h1 class="headingSignup">Renters</h1>';
            // echo 'No renters found.';
            // echo '                        </div>';
            // echo '                    </div>';
            // echo '                </div>';
            // echo '            </div>';
            // echo '        </div>';
            // echo '    </div>';
            // echo '</section>';
        }
        ?>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>