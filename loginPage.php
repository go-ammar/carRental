<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        Login Page
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

    // $userId = $_GET['id']; // Assuming you are passing the user ID through the URL

    // $sql = "SELECT * FROM vehiclestable WHERE id = 3";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    // } else {
    //     echo "0 results";
    // }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $password = $_POST["pwd"];
        $email = $_POST["email"];


        $sql = "SELECT * FROM userinfo WHERE password = '$password' and email = '$email'";
        $result = $conn->query($sql);
        $conn->query($sql);


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['userType'] = $row['userType'];
            $_SESSION['userId'] = $row['id'];

            if ($row['userType'] == "Admin") {
                header("Location: dashboardAdmin.php");
            } else if ($row['userType'] == "User") {
                header("Location: index.php");
            } else if ($row['userType'] == "Renter") {
                header("Location: DashboardRenter.php");
            }
            exit();
        } else {
            echo "Invalid password";
        }
    }

    ?>


    <?php include 'navbar.php'; ?>


    <div class="bg-dark card_signup rounded mx-auto my-5 p-5">

        <section>
            <div class="container">
                <div class="col">
                    <div class="card card-registration  mx-auto ">
                        <div class="row">

                            <div class="col">
                                <div class="card-body p-md-5 text-black">
                                    <h1 class="headingSignup">Login to your account</h1>

                                    <form class="row g-3" action="" method="post">
                                        <div class="col-md-12">
                                            <label for="email" class="form-label">Email
                                                Address</label>
                                            <input type="text" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="pwd" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="pwd" name="pwd" value="" required>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Login</button>
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