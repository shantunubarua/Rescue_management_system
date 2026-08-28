<?php

require_once "models/VolunteerModel.php";

$request_id = (int)($_POST['request_id'] ?? 0);
$volunteer_id = $_SESSION['user']['id'];

if ($request_id <= 0) {
    die("Invalid request.");
}

acceptEmergencyRequest(
    $conn,
    $request_id,
    $volunteer_id
);

header("Location: index.php?page=volunteer-emergency-requests");
exit;