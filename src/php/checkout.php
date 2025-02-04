<?php
session_start();
require "../vendor/autoload.php";
require "secrets.php";
\Stripe\Stripe::setApiKey($stripeSecretKey);
// Get JSON input
$json_data = json_decode($_POST['checkout_data'], true);
$items = [];
if ($json_data === null) {
    header("Location: ../../menu.php");
}
foreach ($json_data as $item) {
    $items[] = [
        "quantity" => $item["quantity"],
        "price_data" => [
            "currency" => "sgd",
            "unit_amount" => $item["price"] * 100,
            "product_data" => [
                "name" => $item["title"]
            ]
        ]
    ];
}
$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/CSAD_Project/success.php",
    "cancel_url" => "http://localhost/CSAD_Project/menu.php",
    //'payment_method_types' => $paymentTypes,
    "line_items" => [
        $items
    ]
]);
http_response_code(303);
header("Location: " . $checkout_session->url);
exit();