<?php

$role = $_SESSION['user']['role'] ?? '';

?>

<div class="sidebar">

    <?php if ($role === 'admin'): ?>

        <h2>Admin Panel</h2>

        <ul>

            <li>
                <a href="index.php?page=admin-dashboard">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="index.php?page=notifications">
                    Notifications
                </a>
            </li>

            <li>
                <a href="index.php?page=feedback">
                    Feedback
                </a>
            </li>

            <li>
                <a href="index.php?page=rescue-reports">
                    Rescue Reports
                </a>
            </li>

            <li>
                <a href="index.php?page=logout">
                    Logout
                </a>
            </li>

        </ul>


    <?php elseif ($role === 'witness'): ?>

        <h2>Witness Panel</h2>

        <ul>

            <li>
    <a href="index.php?page=witness-dashboard">
        Dashboard
    </a>
</li>

            <li>
                <a href="index.php?page=witness-report-create">
                    Report Incident
                </a>
            </li>
            <li>
    <a href="index.php?page=witness-reports">
        My Reports
    </a>
</li>

            <li>
                <a href="index.php?page=logout">
                    Logout
                </a>
            </li>
        

        </ul>


    <?php elseif ($role === 'volunteer'): ?>

        <h2>Volunteer Panel</h2>

        <ul>

            <li>
                <a href="index.php?page=logout">
                    Logout
                </a>
            </li>

        </ul>


    <?php elseif ($role === 'help_seeker'): ?>

        <h2>Help Seeker Panel</h2>

        <ul>

            <li>
                <a href="index.php?page=logout">
                    Logout
                </a>
            </li>

        </ul>

    <?php endif; ?>

</div>