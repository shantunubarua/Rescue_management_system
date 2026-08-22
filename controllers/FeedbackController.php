<?php

require_once "models/FeedbackModel.php";

function loadAllFeedback($conn)
{
    return getAllFeedback($conn);
}

function handleUpdateFeedbackStatus($conn)
{
    $id = isset($_POST['id'])
        ? (int)$_POST['id']
        : 0;

    $status = trim($_POST['status'] ?? '');

    if ($id <= 0) {
        return "Invalid feedback ID.";
    }

    if (
        !updateFeedbackStatus(
            $conn,
            $id,
            $status
        )
    ) {
        return "Failed to update feedback status.";
    }

    return '';
}