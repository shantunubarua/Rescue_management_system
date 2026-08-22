<?php require_once "views/partials/header.php"; ?>

<?php require_once "views/partials/sidebar.php"; ?>

<div class="content">

    <h1>Witness Dashboard</h1>

    <p>
        Welcome,
        <?php echo htmlspecialchars($_SESSION['user']['name']); ?>
    </p>


    <div class="card">

        <h3>My Incident Reports</h3>

        <p>
            View your submitted incident reports.
        </p>

        <p>
            <a href="index.php?page=witness-reports">
                View Reports
            </a>
        </p>

    </div>


    <div class="card">

        <h3>Report New Incident</h3>

        <p>
            Submit a new witness incident report.
        </p>

        <p>
            <a href="index.php?page=witness-report-create">
                Create Report
            </a>
        </p>

    </div>

</div>

<?php require_once "views/partials/footer.php"; ?>