<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = $_SESSION['user'] ?? null;

if (!$user) {
    header("Location: index.php?page=login");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Witness Dashboard - Rescue Management System</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }

        .header {
            background: #2c3e50;
            color: white;
            padding: 20px 30px;
        }

        .header h1 {
            margin: 0;
        }

        .container {
            padding: 30px;
        }

        .welcome {
            background: white;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            padding: 25px;
            width: 220px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .card h3 {
            margin-top: 0;
        }

        .card a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout {
            background: #e74c3c !important;
        }
    </style>
</head>

<body>

<div class="header">
    <h1>Witness Dashboard</h1>
</div>

<div class="container">

    <div class="welcome">

        <h2>
            Welcome, <?= htmlspecialchars($user['name']) ?>!
        </h2>

        <p>
            You are logged in as a
            <strong><?= htmlspecialchars($user['role']) ?></strong>.
        </p>

    </div>

    <div class="cards">

        <div class="card">
            <h3>My Reports</h3>
            <p>View your submitted witness reports.</p>

            <a href="index.php?page=witness-reports">
                View Reports
            </a>
        </div>

        <div class="card">
            <h3>Create Report</h3>
            <p>Submit a new witness report.</p>

            <a href="index.php?page=witness-create-report">
                Create Report
            </a>
        </div>

        <div class="card">
            <h3>Incidents</h3>
            <p>View and manage witness incidents.</p>

            <a href="index.php?page=witness-incidents">
                View Incidents
            </a>
        </div>

        <div class="card">
            <h3>Profile</h3>
            <p>View your witness profile.</p>

            <a href="index.php?page=witness-profile">
                My Profile
            </a>
        </div>

        <div class="card">
            <h3>Logout</h3>
            <p>Sign out from your account.</p>

            <a class="logout" href="index.php?page=logout">
                Logout
            </a>
        </div>

    </div>

</div>

</body>
</html>