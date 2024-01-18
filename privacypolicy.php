<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - CarVoyage Rentals</title>
    <!-- Add your CSS styles or external CSS links here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="lib/style.css" rel="stylesheet">
    <style>
        .with-margin-top {
            margin-top: 2em;
            /* Adjust the value as needed */
        }
    </style>
</head>

<body>

    <?php

    session_start();

    // Check if the 'userType' session variable is set
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

    ?>


    <!-- How It Works Section -->
    <section class="bg-dark card_signup rounded mx-auto p-5 with-margin-top">
        <div class="container card card-registration  mx-auto p-4">
            <h2 class="text-center">Privacy Policy</h2>
            <div class="row px-4 py-3">
                <p>This Privacy Policy describes how CarVoyage Rentals collects, uses, and discloses personal information when you use our car rental services and website.</p>

                <h3>Information We Collect</h3>
                <ul>
                    <li><strong>Contact Information:</strong> Name, email address, phone number.</li>
                    <li><strong>Rental Information:</strong> Pickup and drop-off dates and times, vehicle preferences.</li>
                    <li><strong>Payment Information:</strong> Credit card details for reservation and payment processing.</li>
                    <li><strong>Location Data:</strong> Pickup and drop-off locations.</li>
                </ul>

                <h3>How We Use Your Information</h3>
                <p>We use the collected information for the following purposes:</p>
                <ul>
                    <li><strong>Reservation and Rental Services:</strong> To process your car rental reservations and provide the requested services.</li>
                    <li><strong>Communication:</strong> To communicate with you regarding your reservations, updates, and customer support.</li>
                    <li><strong>Payment Processing:</strong> To facilitate payment for our services.</li>
                    <li><strong>Improvement of Services:</strong> To analyze usage patterns and improve our website and services.</li>
                </ul>

                <h3>Information Sharing</h3>
                <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except for the purpose of providing our services.</p>

                <h3>Data Security</h3>
                <p>We implement security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction.</p>

                <h3>Cookies</h3>
                <p>Our website may use cookies to enhance your experience. You can adjust your browser settings to refuse cookies, but this may affect your ability to use some features of our website.</p>

                <h3>Your Choices</h3>
                <p>You can review, update, or delete your personal information by contacting us. You may also choose not to provide certain information, but this may limit the functionality of our services.</p>

                <h3>Changes to This Policy</h3>
                <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page.</p>

                <h3>Contact Us</h3>
                <p>If you have any questions or concerns about our Privacy Policy, please contact us at (123) 456-7890.</p>
            </div>
        </div>
    </section>


    <?php
    include 'footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Add your JavaScript or external script links here -->

</body>

</html>