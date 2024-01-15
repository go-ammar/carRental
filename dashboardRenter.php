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

    include 'navbarRenter.php';

    ?>


    <div id="carouselMain" class="carousel slide" data-bs-ride="carousel">




        <?php


        $userId = $_SESSION['userId'];
        $sql = "SELECT 
        userinfo.id AS id, 
        userinfo.fName AS fName, 
        userinfo.phoneNumber AS phoneNumber, 
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
        userinfo.id = '$userId'
    GROUP BY 
        userinfo.id, userinfo.fName, userinfo.lName, overall_avg.avgAmountAllUsers;";


        $result = $conn->query($sql);

        $row = $result->fetch_assoc();

        echo $row['fName'] . " " . $row['phoneNumber'];




        ?>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>