<?php

require_once "models/DonationModel.php";


/*
|--------------------------------------------------------------------------
| Create Donation
|--------------------------------------------------------------------------
*/

function handleCreateDonation($conn)
{
    /*
     * Get form data
     */

    $amount =
        trim($_POST['amount'] ?? '');

    $donation_type =
        trim($_POST['donation_type'] ?? '');

    $payment_method =
        trim($_POST['payment_method'] ?? '');

    $message =
        trim($_POST['message'] ?? '');


    /*
     |--------------------------------------------------------------------------
     | Required Fields Validation
     |--------------------------------------------------------------------------
     */

    if (
        $amount === '' ||
        $donation_type === '' ||
        $payment_method === ''
    ) {
        return "All required fields must be completed.";
    }


    /*
     |--------------------------------------------------------------------------
     | Amount Validation
     |--------------------------------------------------------------------------
     */

    if (
        !is_numeric($amount) ||
        (float)$amount <= 0
    ) {
        return "Donation amount must be greater than 0.";
    }

    $amount = (float)$amount;


    /*
     |--------------------------------------------------------------------------
     | Donation Type Validation
     |--------------------------------------------------------------------------
     */

    $allowed_types = [
        'money',
        'food',
        'medicine',
        'clothes',
        'other'
    ];

    if (
        !in_array(
            $donation_type,
            $allowed_types,
            true
        )
    ) {
        return "Invalid donation type.";
    }


    /*
     |--------------------------------------------------------------------------
     | Payment Method Validation
     |--------------------------------------------------------------------------
     */

    $allowed_payment_methods = [
        'cash',
        'card',
        'bkash',
        'bank'
    ];

    if (
        !in_array(
            $payment_method,
            $allowed_payment_methods,
            true
        )
    ) {
        return "Invalid payment method.";
    }


    /*
     |--------------------------------------------------------------------------
     | Get Logged-in Witness ID
     |--------------------------------------------------------------------------
     */

    $witness_id =
        (int)(
            $_SESSION['user']['id'] ?? 0
        );

    if ($witness_id <= 0) {
        return "Invalid witness account.";
    }


    /*
     |--------------------------------------------------------------------------
     | Save Donation
     |--------------------------------------------------------------------------
     */

    $success = createDonation(
        $conn,
        $witness_id,
        $amount,
        $donation_type,
        $payment_method,
        $message
    );

    if ($success) {

        header(
            "Location: index.php?page=donations"
        );

        exit;
    }


    /*
     |--------------------------------------------------------------------------
     | Database Error
     |--------------------------------------------------------------------------
     */

    return "Failed to create donation.";
}