<?php

include 'connection.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $carId = $_GET["carId"];
    $startDateTime = $_GET["dateTimeObject"];
    $endDateTime = $_GET["proposedEndDateTime"];
    $amount = $_GET["amount"];

    $userId = $_SESSION['userId'];

    $sql = "INSERT INTO appointments (renterId, status, carId, startDateTime, endDateTime, amount)
            VALUES ('$userId', 'PENDING', '$carId', '$startDateTime', '$endDateTime', '$amount')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    }
}
