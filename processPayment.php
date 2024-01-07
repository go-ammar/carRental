<!DOCTYPE html>
<html lang="zxx">

<head>

    <!-- Include the PayPal JavaScript SDK -->
    <!--script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID"></script-->
    <script src="https://www.paypal.com/sdk/js?client-id=AcbE5AUFX3oO0svUNmmL4lhhoAao9Gu94UI6RJgP3BF32z9Vaec_o7tV8_LOmqcIiJ2hGDMHm9MOrLmf"></script>


</head>

<body>
    <div id="wrapper">

        <!-- page preloader begin -->

        <div class="bg-dark card_signup rounded mx-auto my-5 p-5 ">

            <section>
                <div class="container">
                    <div class="col">
                        <div class="card card-registration  mx-auto mx-0">
                            <div class="row">

                                <div class="col">
                                    <div class="card-body p-md-5 text-black">
                                        <h1 class="headingSignup">Vehicle Details</h1>

                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label for="carModel" class="form-label fw-bold">Model</label>
                                                <p><?php echo $row['model']; ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="carMake" class="form-label fw-bold">Make</label>
                                                <p><?php echo $row['make']; ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="carName" class="form-label fw-bold">Name</label>
                                                <p><?php echo $row['carName']; ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="carMileage" class="form-label fw-bold">Mileage</label>
                                                <p><?php echo $row['mileage']; ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="carNumber" class="form-label fw-bold">Car Number</label>
                                                <p><?php echo $row['carNumber']; ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="dailyRate" class="form-label fw-bold">Rate (GBP per Hour)</label>
                                                <p><?php echo $row['rate']; ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="carPostCode" class="form-label fw-bold">Post Code</label>
                                                <p><?php echo $row['postCode']; ?></p>
                                            </div>
                                            <!-- <div class="col-md-6">
                                    <label for="photosFile" class="form-label">Uploaded Photos</label>
                                    Display file names or other relevant information
                                    <?php
                                    // Assuming you have stored file information in the database
                                    // $photos = explode(",", $row['photos']); // Adjust this based on your actual data structure
                                    // foreach ($photos as $photo) {
                                    // echo "<p>$photo</p>";
                                    // }
                                    ?>
                                </div> -->
                                            <div class="col-md-3">
                                                <label for="vehicleType" class="form-label fw-bold">Vehicle Type</label>
                                                <p><?php echo $row['vehicleType']; ?></p>
                                            </div>



                                            <form class="row g-3" action="" method="post">
                                                <div class="col-md-6">
                                                    <label for="pickUpDate" class="form-label fw-bold">Pick Up Date</label>
                                                    <p><?php echo $row['startDateTime']; ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="pickUpTime" class="form-label fw-bold">Drop off Time</label>
                                                    <p><?php echo $row['endDateTime']; ?></p>
                                                </div>

                                                <div class="col-12">
                                                    <?php
                                                    if (isset($_SESSION['userType'])) {
                                                        if ($_SESSION['userType'] == "Renter" || $_SESSION['userType'] == "Admin") {
                                                            if ($row['status'] == "PENDING") {
                                                                echo '<button class="btn btn-danger" type="submit" name="deleteBooking">Delete Booking</button>';
                                                            } else if ($row['status'] == "COMPLETED") {
                                                                echo '<button class="btn btn-primary" type="submit" name="feedback">Give Feedback</button>';
                                                            }
                                                        } else {
                                                            // echo '<p class="text-muted">This vehicle details are read-only.</p>';
                                                        }
                                                    }
                                                    ?>
                                                    <!-- Add a message indicating that the details are read-only -->
                                                </div>



                                            </form>



                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>



        <div id="de-preloader"></div>
        <!-- page preloader close -->

        <!-- header begin -->
        <!-- header close -->
        <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            <section id="section-hero" aria-label="section" class="jarallax">
                <img src="images/background/2.jpg" class="jarallax-img" alt="">
                <div class="v-center">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-4 offset-lg-4">
                                <div class="padding40 rounded-3 shadow-soft" data-bgcolor="#ffffff">
                                    <h4>Login</h4>
                                    <div class="spacer-10"></div>
                                    <form id="register" class="form-border" method="post" action="account-dashboard.php">

                                        <input type="text" name="hdnNewPt" id="hdnNewPt" class="form-control" value="35.00" /> <!-- to set value from front page -->
                                        <!-- This is where paypal button will show start style="display:none;" -->
                                        <div id="paypal-button-container"></div>
                                        <!-- This is where paypal button will show end-->

                                    </form>
                                    <div class="title-line">Are&nbsp;you&nbsp;new?</div>
                                    <div class="row g-2">
                                        <div class="col-lg-12">
                                            <a class="btn-sc btn-fullwidth mb10" href="register.php">Register with
                                                us</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
        <!-- content close -->

        <!-- Javascript Files
    ================================================== -->
        <script src="js/plugins.js"></script>
        <script src="js/designesia.js"></script>

        <script>
            var val = $('#hdnNewPt').val()
            // Render the PayPal button
            paypal.Buttons({
                createOrder: function(data, actions) {
                    // Set up the transaction
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: val //'10.00' // Replace with your desired amount
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    // Capture the funds from the transaction
                    return actions.order.capture().then(function(details) {
                        // Display a success message to the buyer
                        alert('Transaction completed by ' + details.payer.name.given_name);
                    });

                }
            }).render('#paypal-button-container');
        </script>


</body>

</html>