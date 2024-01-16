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


    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if (isset($_GET['carId'])) {
            $userId = $_SESSION['userId'];
            $carId = $_GET['carId'];
            $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
            $comments = isset($_POST['comments']) ? htmlspecialchars($_POST['comments']) : '';
            $sql = "INSERT INTO carFeedback (carId, userId, rating, comments) VALUES ('$carId', '$userId', '$rating', '$comments')";

            if ($conn->query($sql) === TRUE) {
                // echo "Feedback submitted successfully";
                $isTrue = true;
                $bookingId = $_GET['bookingId'];
                $sql = "UPDATE appointments 
                SET feedbackGiven = '$isTrue' 
                WHERE id = '$bookingId'";

                if ($conn->query($sql) === TRUE) {
                    header("Location: index.php");
                }
            } else {
                echo "Error submitting feedback: " . $conn->error;
            }
        }
    }

    ?>



    <div class="bg-dark card_signup rounded mx-auto my-5 p-5">

        <section>
            <div class="container">
                <div class="col">
                    <div class="card card-registration  mx-auto ">
                        <div class="row">

                            <div class="col">
                                <div class="card-body p-md-5 text-black">
                                    <h1 class="headingSignup">Rate the vehicle!</h1>

                                    <form class="row g-3" action="" method="post">

                                        <div class="form-group">
                                            <label for="rating">Rating:</label>
                                            <div class="rating">
                                                <span class="star"></span>
                                                <span class="star empty"></span>
                                                <span class="star empty"></span>
                                                <span class="star empty"></span>
                                                <span class="star empty"></span>
                                                <input type="hidden" id="rating" name="rating" value="1"> <!-- Hidden input to store the rating value -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="comments">Comments:</label>
                                            <textarea class="form-control" id="comments" name="comments" rows="4"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit Feedback</button>

                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

    </div>



    <script>
        // JavaScript code to handle the star rating
        const stars = document.querySelectorAll('.rating .star');
        const ratingInput = document.getElementById('rating');

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                // Update the hidden input value
                ratingInput.value = index + 1;

                // Reset all stars
                stars.forEach((s, i) => {
                    s.classList.toggle('empty', i >= index + 1);
                });
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>