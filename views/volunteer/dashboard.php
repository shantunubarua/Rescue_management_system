<?php require_once "views/partials/header.php"; ?>

<?php require_once "views/partials/sidebar.php"; ?>

<div class="content">

    <h1>Volunteer Dashboard</h1>

    <p>
        Welcome,
        <?php echo htmlspecialchars($_SESSION['user']['name']); ?>
    </p>

    <div class="card">

        <h3>Emergency Requests</h3>

        <p>
            View emergency requests that need volunteer assistance.
        </p>

        <a href="#">
            View Requests
        </a>

    </div>

    <div class="card">

        <h3>My Rescue Activities</h3>

        <p>
            View the rescue activities assigned to you.
        </p>

        <a href="#">
            View My Activities
        </a>

    </div>

    <div class="card">

        <h3>My Availability</h3>

        <p>
            Update your current availability status.
        </p>

        <a href="#">
            Update Availability
        </a>

    </div>

</div>

<?php require_once "views/partials/footer.php"; ?>