<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        Signup Page
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

        $email = $_POST["email"];
        $sql = "SELECT * FROM userinfo WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<script>alert("This email is already registered. Please use a different email:");</script>';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("Invalid email format. Please enter a valid email address.");</script>';
        } elseif (strlen($password) < 6 || !preg_match('/[0-9]/', $password)) {
            echo '<script>alert("Password must be at least 6 characters long and contain at least one number.");</script>';
        } else if ($_POST["password"] == $_POST["confirmpassword"]) {
            $fName = $_POST["fName"];
            $lName = $_POST["lName"];
            $phoneNumber = $_POST["phoneNumber"];
            $city = $_POST["city"];
            $postCode = $_POST["postCode"];
            $password = $_POST['password'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            if ($_POST['userType'] == "carRenter") {
                $userType = "User";
            } else {
                $userType = "Renter";
            }
            $sql = "INSERT INTO userinfo (fName, lName, email, phoneNumber, city, postCode, password, userType) VALUES ('$fName', '$lName', '$email',
        '$phoneNumber','$city', '$postCode','$hashed_password', '$userType')";
            $conn->query($sql);
            header("Location: loginPage.php");
        } else {
            echo '<script>alert("Passwords are not the same.");</script>';
        }
    }

    ?>

    <?php include 'navbar.php'; ?>



    <div class="bg-dark card_signup rounded mx-auto my-5 p-5">


        <section>
            <div class="container">
                <div class="col">
                    <div class="card card-registration mx-auto ">
                        <div class="row">

                            <div class="col">
                                <div class="card-body p-md-5 text-black">
                                    <h1 class="headingSignup">Register your account</h1>

                                    <form class="row g-3" action="" method="post">
                                        <div class="col-md-6">
                                            <label for="fName" class="form-label">First name</label>
                                            <input type="text" class="form-control" id="fName" value="" name="fName" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lName" class="form-label">Last name</label>
                                            <input type="text" class="form-control" id="lName" value="" name="lName" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Select User type</label>

                                            <div class="form-check">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Renter
                                                </label>
                                                <input class="form-check-input" type="radio" id="exampleRadios1" value="carRenter" name="userType" checked>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Car Owner
                                                </label>
                                                <input class="form-check-input" type="radio" id="exampleRadios2" value="carOwner" name="userType">

                                            </div>


                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email
                                                Address</label>
                                            <input type="text" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phoneNumber" class="form-label">Phone
                                                Number</label>
                                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" id="city" name="city" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="postCode" class="form-label">Post Code</label>
                                            <input type="text" class="form-control" id="postCode" name="postCode" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="pwd" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="pwd" value="" name="password" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="confirmPwd" class="form-label">Confirm
                                                Password</label>
                                            <input type="password" class="form-control" id="confirmPwd" name="confirmpassword" value="" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Do you agree to the <a href="termandconditions.php">Terms and Conditions</a></label>

                                            <div class="form-check">
                                                <label class="form-check-label" for="yes">
                                                    Yes
                                                </label>
                                                <input class="form-check-input" type="radio" id="yes" name="agree" value="yes" required>
                                            </div>


                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Register</button>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>