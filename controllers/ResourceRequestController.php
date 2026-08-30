<?php

require_once "models/ResourceRequestModel.php";

function handleCreateResourceRequest($conn)
{
    $volunteer_id = (int)($_SESSION['user']['id'] ?? 0);

    $resource_type = trim(
        $_POST['resource_type'] ?? ''
    );

    $quantity = (int)(
        $_POST['quantity'] ?? 0
    );

    $description = trim(
        $_POST['description'] ?? ''
    );

    if (
        $volunteer_id <= 0 ||
        $resource_type === '' ||
        $quantity <= 0
    ) {
        return "Please fill in all required fields correctly.";
    }

    if (
        createResourceRequest(
            $conn,
            $volunteer_id,
            $resource_type,
            $quantity,
            $description
        )
    ) {
        header(
    "Location: index.php?page=volunteer-resource-requests"
);
exit;
    }

    return "Failed to submit resource request.";
}