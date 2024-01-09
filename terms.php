<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Integration Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .payment-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="payment-form">
                    <h2 class="text-center mb-4">Pay with PayPal</h2>
                    <form id="paymentForm">
                        <!-- Other form fields can be added here -->

                        <!-- PayPal Button -->
                        <div id="paypal-button-container"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- PayPal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AcbE5AUFX3oO0svUNmmL4lhhoAao9Gu94UI6RJgP3BF32z9Vaec_o7tV8_LOmqcIiJ2hGDMHm9MOrLmf"></script>

    <!-- Your custom JavaScript for PayPal integration -->
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                // Set up the transaction
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '10.00', // Replace with the actual payment amount
                            currency_code: 'USD' // Replace with the currency code
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Capture the funds from the transaction
                return actions.order.capture().then(function(details) {
                    // Handle the successful payment
                    console.log(details);
                    alert('Payment successful!');
                });
            },
            onError: function(err) {
                // Handle errors during the transaction
                console.error(err);
                alert('Error during payment. Please try again.');
            }
        }).render('#paypal-button-container');
    </script>

</body>

</html>