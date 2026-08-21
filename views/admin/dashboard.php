<?php require_once "views/partials/header.php"; ?>

<?php require_once "views/partials/sidebar.php"; ?>

<div class="content">

    <h1>Admin Dashboard</h1>

    <p>
        Welcome,
        <?php echo $_SESSION['user']['name']; ?>
    </p>

    <div class="card">
        <h3>Total Notifications</h3>
        <p>0</p>
    </div>

    <div class="card">
        <h3>Pending Feedback</h3>
        <p>0</p>
    </div>

    <div class="card">
        <h3>Rescue Reports</h3>
        <p>0</p>
    </div>

</div>

<?php require_once "views/partials/footer.php"; ?>