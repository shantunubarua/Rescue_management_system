<?php

/*
|--------------------------------------------------------------------------
| Create Donation
|--------------------------------------------------------------------------
*/

function createDonation(
    $conn,
    $witness_id,
    $amount,
    $donation_type,
    $payment_method,
    $transaction_id,
    $message
) {
    $sql = "INSERT INTO donations
            (
                witness_id,
                amount,
                donation_type,
                payment_method,
                transaction_id,
                message,
                status
            )
            VALUES (?, ?, ?, ?, ?, ?, 'pending')";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param(
        $stmt,
        "idssss",
        $witness_id,
        $amount,
        $donation_type,
        $payment_method,
        $transaction_id,
        $message
    );

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;
}


/*
|--------------------------------------------------------------------------
| Get Witness Donations
|--------------------------------------------------------------------------
*/

function getWitnessDonations(
    $conn,
    $witness_id
) {
    $sql = "SELECT
                id,
                witness_id,
                amount,
                donation_type,
                payment_method,
                transaction_id,
                message,
                status,
                created_at
            FROM donations
            WHERE witness_id = ?
            ORDER BY id DESC";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return [];
    }

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $witness_id
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $donations = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $donations[] = $row;
    }

    mysqli_stmt_close($stmt);

    return $donations;
}


/*
|--------------------------------------------------------------------------
| Get Donation By ID
|--------------------------------------------------------------------------
*/

function getDonationById(
    $conn,
    $donation_id,
    $witness_id
) {
    $sql = "SELECT
                id,
                witness_id,
                amount,
                donation_type,
                payment_method,
                transaction_id,
                message,
                status,
                created_at
            FROM donations
            WHERE id = ?
            AND witness_id = ?
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return null;
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $donation_id,
        $witness_id
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $donation = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $donation;
}