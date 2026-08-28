<?php

function getVolunteerEmergencyRequests($conn)
{
    $sql = "SELECT *
            FROM emergency_requests
            WHERE status = 'pending'
            ORDER BY id DESC";

    $result = mysqli_query($conn, $sql);

    $requests = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $requests[] = $row;
    }

    return $requests;
}


function acceptEmergencyRequest($conn, $request_id, $volunteer_id)
{
    $sql = "UPDATE emergency_requests
            SET status = 'assigned',
                volunteer_id = ?,
                accepted_at = NOW()
            WHERE id = ?
            AND status = 'pending'";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $volunteer_id,
        $request_id
    );

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;
}
function getVolunteerActivities($conn, $volunteer_id)
{
    $sql = "SELECT *
            FROM emergency_requests
            WHERE volunteer_id = ?
            AND status = 'assigned'
            ORDER BY accepted_at DESC";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $volunteer_id
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $activities = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $activities[] = $row;
    }

    mysqli_stmt_close($stmt);

    return $activities;
}