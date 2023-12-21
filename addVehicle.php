<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        Add a Vehicle
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="lib/style.css" rel="stylesheet">

</head>

<body>

    <?php
    include 'connection.php';

    session_start();


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $carModel = $_POST["carModel"];
        $carMake = $_POST["carMake"];
        $carNumber = $_POST["carNumber"];
        $carMileage = $_POST["carMileage"];
        $carName = $_POST["carName"];
        $dailyRate = $_POST["dailyRate"];
        $carPostCode = $_POST["carPostCode"];
        $vehicleType = $_POST["vehicleType"];
        $userId = $_SESSION["userId"];


        $sql = "INSERT INTO vehiclestable (model, make, carName, mileage, rate, postCode, userId, vehicleType, carNumber)
         VALUES ('$carModel', '$carMake', '$carName',
        '$carMileage','$dailyRate', '$carPostCode','$userId', '$vehicleType', '$carNumber')";
        $conn->query($sql);

        header("Location: myVehicles.php");
    }

    ?>

    <?php include 'navbarOwner.php'; ?>


    <div class="bg-dark card_signup rounded mx-auto my-5 p-5 ">

        <section>
            <div class="container">
                <div class="col">
                    <div class="card card-registration  mx-auto mx-0">
                        <div class="row">

                            <div class="col">
                                <div class="card-body p-md-5 text-black">
                                    <h1 class="headingSignup">Add Vehicle</h1>

                                    <form class="row g-3" action="" method="post">
                                        <div class="col-md-4">
                                            <label for="carModel" class="form-label">Model</label>
                                            <input type="number" class="form-control" id="carModel" name="carModel" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="carMake" class="form-label">Make</label>
                                            <select class="form-select" id="carMake" name="carMake" required>
                                                <?php
                                                // Assuming $conn is your database connection object
                                                $sql = "SELECT * FROM vehiclelisttable"; // Replace your_table_name with the actual table name
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $selected = ($row['make'] == $selectedModel) ? 'selected' : ''; // Assuming $selectedModel is the selected model from the database
                                                        echo "<option value='" . $row['make'] . "' $selected>" . $row['make'] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <!-- <input type="text" class="form-control" id="carMake" name="carMake" value="" required> -->
                                        </div>
                                        <div class="col-md-4">
                                            <label for="carName" class="form-label">Name</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="carName" name="carName" aria-describedby="inputGroupPrepend2" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="carMileage" class="form-label">Mileage</label>
                                            <input type="number" class="form-control" id="carMileage" name="carMileage" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="carNumber" class="form-label">Car Number</label>
                                            <input type="text" class="form-control" id="carNumber" name="carNumber" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="dailyRate" class="form-label">Rate (GBP per
                                                Hour)</label>
                                            <input type="number" class="form-control" id="dailyRate" name="dailyRate" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="carPostCode" class="form-label">Post Code</label>
                                            <input type="text" class="form-control" id="carPostCode" name="carPostCode" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="photosFile" class="form-label">Upload Photos of your
                                                Vehicle</label>
                                            <input class="form-control" type="file" id="photosFile" name="photosFile" multiple>
                                        </div>
                                        <div class="col-md-6">

                                            <label for="vehicleType" class="form-label">Vehicle Type</label>
                                            <select class="form-select" id="vehicleType" name="vehicleType">
                                                <option value="Standard" selected>Standard</option>
                                                <option value="Luxury">Luxury</option>
                                                <option value="SUV">SUV</option>
                                                <option value="Vans">Vans &amp; Coasters</option>

                                            </select>

                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Add Vehicle</button>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>