<?php

require_once "models/WitnessModel.php";

function handleCreateWitnessReport($conn)
{
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $incident_type = trim($_POST['incident_type'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $incident_date = trim($_POST['incident_date'] ?? '');

    if (
        $title === '' ||
        $description === '' ||
        $incident_type === '' ||
        $location === '' ||
        $incident_date === ''
    ) {
        return "All required fields must be completed.";
    }

    $allowed_types = [
        'accident',
        'fire',
        'flood',
        'medical',
        'other'
    ];

    if (!in_array($incident_type, $allowed_types, true)) {
        return "Invalid incident type.";
    }

    $witness_id = $_SESSION['user']['id'];

    $evidence_file = null;

    if (
        createWitnessReport(
            $conn,
            $witness_id,
            $title,
            $description,
            $incident_type,
            $location,
            $incident_date,
            $evidence_file
        )
    ) {
        header("Location: index.php?page=witness-reports");
        exit;
    }

    return "Failed to create witness report.";
}