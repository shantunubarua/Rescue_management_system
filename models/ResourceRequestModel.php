<?php

function createResourceRequest(
    $conn,
    $volunteer_id,
    $resource_type,
    $quantity,
    $description
) {
    $sql = "INSERT INTO resource_requests
            (
                volunteer_id,
                resource_type,
                quantity,
                description
            )
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "iiis",
        $volunteer_id,
        $resource_type,
        $quantity,
        $description
    );

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;
}


function getVolunteerResourceRequests(
    $conn,
    $volunteer_id
) {
    $sql = "SELECT *
            FROM resource_requests
            WHERE volunteer_id = ?
            ORDER BY id DESC";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $volunteer_id
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $requests = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $requests[] = $row;
    }

    mysqli_stmt_close($stmt);

    return $requests;
}


function getResourceRequestById(
    $conn,
    $request_id,
    $volunteer_id
) {
    $sql = "SELECT *
            FROM resource_requests
            WHERE id = ?
            AND volunteer_id = ?
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $request_id,
        $volunteer_id
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $request = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $request;
}