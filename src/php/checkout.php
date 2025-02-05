<?php
session_start();
require "../vendor/autoload.php";
require "secrets.php";
/**
 * @var string $stripeSecretKey
 */
\Stripe\Stripe::setApiKey($stripeSecretKey);
// Get JSON input
$json_data = json_decode($_POST['checkout_data'], true);
$items = [];
if ($json_data === null) {
    header("Location: ../../menu.php");
}
if (count($json_data) === 0) {
    header("Location: ../../menu.php");
}
foreach ($json_data as $item) {
    $item['size'][0] = strtoupper($item['size'][0]);
    $items[] = [
        "quantity" => $item["quantity"],
        "price_data" => [
            "currency" => "sgd",
            "unit_amount" => $item["price"] * 100,
            "product_data" => [
                "name" => $item["title"],
                "tax_code" => "txcd_20030000",
                "description" => "Size: " . $item['size']
            ]
        ]
    ];
}
function getBaseUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    return "$protocol://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
try {
    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => dirname(getBaseUrl(), 3) . "/success.php",
        "cancel_url" => dirname(getBaseUrl(), 3) . "/menu.php",
        "line_items" => [
            $items
        ],
        'automatic_tax' => ['enabled' => true],
    ]);
    
    //$_SESSION['session_id']  = $checkout_session->id;
    http_response_code(303);
    header("Location: " . $checkout_session->url);
    exit();
} catch (Exception $e) {
    echo $e->getMessage();
}