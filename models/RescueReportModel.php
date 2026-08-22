<?php

function getAllRescueReports($conn)
{
    $sql = "SELECT
                id,
                emergency_request_id,
                admin_id,
                rescue_status,
                description,
                created_at,
                updated_at
            FROM rescue_reports
            ORDER BY id DESC";

    $result = mysqli_query($conn, $sql);

    $reports = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $reports[] = $row;
    }

    return $reports;
}


function getRescueReportById($conn, $id)
{
    $sql = "SELECT
                id,
                emergency_request_id,
                admin_id,
                rescue_status,
                description,
                created_at,
                updated_at
            FROM rescue_reports
            WHERE id = ?
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $id
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $report = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $report;
}
function updateRescueReportStatus($conn, $id, $status)
{
    $allowed_statuses = [
        'pending',
        'ongoing',
        'completed',
        'cancelled'
    ];

    if (!in_array($status, $allowed_statuses, true)) {
        return false;
    }

    $sql = "UPDATE rescue_reports
            SET rescue_status = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "si",
        $status,
        $id
    );

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;
}