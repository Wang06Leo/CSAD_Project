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
if (isset($_SESSION['points'])) $_SESSION['used_points'] = $_SESSION['points'] - $_POST['points_data'];
foreach ($json_data as $item) {
    $item['size'][0] = strtoupper($item['size'][0]);
    $items[] = [
        "quantity" => $item["quantity"],
        "price_data" => [
            "currency" => "sgd",
            "unit_amount" => round($item["price"][0] * 100 * 1.09, 0),
            "product_data" => [
                "name" => $item["title"],
                "tax_code" => "txcd_20030000",
                "description" => "Size: " . $item['size']
            ]
        ]
    ];
    if ($item['size'] === "N/A") {
        unset($items[count($items) - 1]["price_data"]["product_data"]["description"]); // remove description added in the same iteration if size if N/A
    }
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
    
    $_SESSION['session_id']  = $checkout_session->id;
    http_response_code(303);
    header("Location: " . $checkout_session->url);
    exit();
} catch (Exception $e) {
    echo $e->getMessage();
}