<?php

require_once "views/partials/header.php";
require_once "views/partials/sidebar.php";

require_once "models/VolunteerModel.php";

$volunteer_id = $_SESSION['user']['id'];

$activities = getVolunteerActivities(
    $conn,
    $volunteer_id
);

?>

<div class="content">

    <h1>My Rescue Activities</h1>

    <p>
        View the emergency requests assigned to you.
    </p>

    <?php if (empty($activities)): ?>

        <div class="card">

            <h3>No Rescue Activities</h3>

            <p>
                You currently have no assigned rescue activities.
            </p>

        </div>

    <?php else: ?>

        <?php foreach ($activities as $activity): ?>

            <div class="card">

                <h3>
                    <?php echo htmlspecialchars(
                        $activity['emergency_type']
                    ); ?>
                </h3>

                <p>
                    <strong>Location:</strong>
                    <?php echo htmlspecialchars(
                        $activity['location']
                    ); ?>
                </p>

                <p>
                    <strong>Description:</strong>
                    <?php echo htmlspecialchars(
                        $activity['description']
                    ); ?>
                </p>

                <p>
                    <strong>Priority:</strong>
                    <?php echo htmlspecialchars(
                        $activity['priority']
                    ); ?>
                </p>

                <p>
                    <strong>Victim Count:</strong>
                    <?php echo htmlspecialchars(
                        $activity['victim_count']
                    ); ?>
                </p>

                <p>
                    <strong>Contact:</strong>
                    <?php echo htmlspecialchars(
                        $activity['contact_information']
                    ); ?>
                </p>

                <p>
                    <strong>Status:</strong>
                    <?php echo htmlspecialchars(
                        $activity['status']
                    ); ?>
                </p>

                <p>
                    <strong>Accepted At:</strong>
                    <?php echo htmlspecialchars(
                        $activity['accepted_at']
                    ); ?>
                </p>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

<?php require_once "views/partials/footer.php"; ?>