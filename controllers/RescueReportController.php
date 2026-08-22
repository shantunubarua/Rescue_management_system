<?php

require_once "models/RescueReportModel.php";

function loadAllRescueReports($conn)
{
    return getAllRescueReports($conn);
}

function handleUpdateRescueReportStatus($conn)
{
    $id = isset($_POST['id'])
        ? (int)$_POST['id']
        : 0;

    $status = trim($_POST['rescue_status'] ?? '');

    if ($id <= 0) {
        return "Invalid rescue report ID.";
    }

    if (
        !updateRescueReportStatus(
            $conn,
            $id,
            $status
        )
    ) {
        return "Failed to update rescue report status.";
    }

    return '';
}