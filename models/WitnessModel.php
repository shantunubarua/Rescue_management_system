<?php

function createWitnessReport(
    $conn,
    $witness_id,
    $title,
    $description,
    $incident_type,
    $location,
    $incident_date,
    $evidence_file
) {
    $sql = "INSERT INTO witness_reports
            (
                witness_id,
                title,
                description,
                incident_type,
                location,
                incident_date,
                evidence_file
            )
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "issssss",
        $witness_id,
        $title,
        $description,
        $incident_type,
        $location,
        $incident_date,
        $evidence_file
    );

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;
}


function getWitnessReports($conn, $witness_id)
{
    $sql = "SELECT *
            FROM witness_reports
            WHERE witness_id = ?
            ORDER BY id DESC";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $witness_id
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $reports = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $reports[] = $row;
    }

    mysqli_stmt_close($stmt);

    return $reports;
}


function getWitnessReportById(
    $conn,
    $report_id,
    $witness_id
) {
    $sql = "SELECT *
            FROM witness_reports
            WHERE id = ?
            AND witness_id = ?
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $report_id,
        $witness_id
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $report = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $report;
}


function updateWitnessReport(
    $conn,
    $report_id,
    $witness_id,
    $title,
    $description,
    $incident_type,
    $location,
    $incident_date
) {
    $sql = "UPDATE witness_reports
            SET title = ?,
                description = ?,
                incident_type = ?,
                location = ?,
                incident_date = ?
            WHERE id = ?
            AND witness_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssii",
        $title,
        $description,
        $incident_type,
        $location,
        $incident_date,
        $report_id,
        $witness_id
    );

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;
}

function deleteWitnessReport($conn, $report_id, $witness_id)
{
    $sql = "DELETE FROM witness_reports
            WHERE id = ?
            AND witness_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $report_id,
        $witness_id
    );

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;
}