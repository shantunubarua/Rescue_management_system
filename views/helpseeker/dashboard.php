<?php

require_once "views/partials/header.php";
require_once "views/partials/sidebar.php";

?>

<div class="content">

    <h1>Help Seeker Dashboard</h1>

    <p>
        Welcome,
        <?php
        echo htmlspecialchars(
            $_SESSION['user']['name'] ?? 'Help Seeker'
        );
        ?>
    </p>


    <div class="card">

        <h3>Request Rescue</h3>

        <p>
            Create a new emergency rescue request when you need help.
        </p>

        <a href="index.php?page=helpseeker-request-create">
            Request Rescue
        </a>

    </div>


    <div class="card">

        <h3>My Emergency Requests</h3>

        <p>
            View all emergency requests you have submitted.
        </p>

        <a href="index.php?page=helpseeker-requests">
            View My Requests
        </a>

    </div>


    <div class="card">

        <h3>Request Status</h3>

        <p>
            Track pending, assigned, ongoing and completed rescue requests.
        </p>

        <a href="index.php?page=helpseeker-requests">
            Check Request Status
        </a>

    </div>

</div>

<?php require_once "views/partials/footer.php"; ?>