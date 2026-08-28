<?php

require_once "views/partials/header.php";
require_once "views/partials/sidebar.php";
require_once "models/ResourceRequestModel.php";

$volunteer_id = (int)$_SESSION['user']['id'];

$requests = getVolunteerResourceRequests(
    $conn,
    $volunteer_id
);

?>

<div class="content">

    <h1>My Resource Requests</h1>

    <p>
        View the resources you have requested.
    </p>

    <p>
        <a href="index.php?page=volunteer-resource-request">
            Request New Resource
        </a>
    </p>

    <?php if (empty($requests)): ?>

        <div class="card">

            <h3>No Resource Requests</h3>

            <p>
                You have not submitted any resource requests yet.
            </p>

        </div>

    <?php else: ?>

        <?php foreach ($requests as $request): ?>

            <div class="card">

                <h3>
                    <?php echo htmlspecialchars(
                        $request['resource_type']
                    ); ?>
                </h3>

                <p>
                    <strong>Quantity:</strong>
                    <?php echo (int)$request['quantity']; ?>
                </p>

                <p>
                    <strong>Description:</strong>
                    <?php echo htmlspecialchars(
                        $request['description'] ?? ''
                    ); ?>
                </p>

                <p>
                    <strong>Status:</strong>
                    <?php echo htmlspecialchars(
                        ucfirst($request['status'])
                    ); ?>
                </p>

                <p>
                    <strong>Requested At:</strong>
                    <?php echo htmlspecialchars(
                        $request['created_at']
                    ); ?>
                </p>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

<?php require_once "views/partials/footer.php"; ?>