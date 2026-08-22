<?php require_once "views/partials/header.php"; ?>

<?php require_once "views/partials/sidebar.php"; ?>

<div class="content">

    <h1>My Incident Reports</h1>

    <p>

        <a href="index.php?page=witness-report-create">

            Report New Incident

        </a>

    </p>


    <?php if (empty($reports)): ?>

        <p>

            You have not submitted any incident reports yet.

        </p>

    <?php else: ?>

        <table border="1" cellpadding="10">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Title</th>

                    <th>Incident Type</th>

                    <th>Location</th>

                    <th>Incident Date</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($reports as $report): ?>

                    <tr>

                        <td>
                            <?php echo (int)$report['id']; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($report['title']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($report['incident_type']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($report['location']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($report['incident_date']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($report['status']); ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>

<?php require_once "views/partials/footer.php"; ?>