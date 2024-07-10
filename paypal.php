<?php
$amountValue = $_GET['amount'];
$sku = 'ID' . time();
require 'vendor/autoload.php'; // Path to autoload.php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;

$apiContext = new ApiContext(
    new OAuthTokenCredential(
        'AUlX_LvHG-BsX-XfhH4blTZFkbeFcwTXtYfFwYLakH9suDJ0gaAagKTEFmDDSpgVP3MpyZIQg412guh1',
        'ECiGkIMWbHvzBvVaDMHidzlipHaWU5c9BKdDklR-TU0BCGKHve4ZFaFXLhkQXSCaErxTJfTeZVbOt7Y1'
    )
);

// Set API context settings (sandbox mode)
$apiContext->setConfig([
    'mode' => 'sandbox', // 'live' for production
]);

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$item = new Item();
$item->setName('NAME')
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setSku($sku) // Unique SKU for your product
    ->setPrice($amountValue); // Price of the product

$itemList = new ItemList();
$itemList->setItems([$item]);

$details = new Details();
$details->setShipping(0.00)
    ->setTax(0.00)
    ->setSubtotal($amountValue); // Same as the product price for this example

$amount = new Amount();
$amount->setCurrency('USD')
    ->setTotal($amountValue)
    ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription('DESCRIPTION');

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl('http://localhost/Ecom/capture.php?id=' . $sku) // URL where the user is redirected after payment
    ->setCancelUrl('http://localhost/Ecom/fail.php'); // URL where the user is redirected if they cancel the payment

$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions([$transaction]);

try {
    $payment->create($apiContext);

    // Redirect user to PayPal to approve the payment
    header('Location: ' . $payment->getApprovalLink());
    exit();
} catch (PayPalConnectionException $ex) {
    echo $ex->getMessage(); // Log and handle exception
}
