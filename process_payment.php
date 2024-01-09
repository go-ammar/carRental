<?php
require 'PayPal-PHP-SDK/autoload.php'; // Adjust the path to the PayPal PHP SDK

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Orders;

$apiContext = new ApiContext(
    new OAuthTokenCredential(
        'AcbE5AUFX3oO0svUNmmL4lhhoAao9Gu94UI6RJgP3BF32z9Vaec_o7tV8_LOmqcIiJ2hGDMHm9MOrLmf',     // Replace with your Client ID
        'ELuQAizTI_6MrKVTOCwwNV3noQxsnq4HCfIvFKGqlX95Euq_g2gKUWqyIE8oS05EIg64Btet5J_x2faF'  // Replace with your Client Secret
    )
);

// Set the mode to sandbox for testing; change to 'live' for production
$apiContext->setConfig(['mode' => 'sandbox']);

// Get the order ID from the request
$orderID = $_GET['orderID'];

try {
    // Retrieve the order by making a GET request
    // $order = Orders::get($orderID, $apiContext);

    // Process the order details as needed (e.g., update your database, fulfill the order, etc.)

    echo 'Payment processed successfully';
} catch (Exception $ex) {
    // Handle exceptions
    echo $ex->getMessage();
}
