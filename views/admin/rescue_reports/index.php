<?php require_once "views/partials/header.php"; ?>

<?php require_once "views/partials/sidebar.php"; ?>

<div class="content">

    <h1>Rescue Reports</h1>

    <?php if (empty($reports)): ?>

        <p>No rescue reports found.</p>

    <?php else: ?>

        <table border="1" cellpadding="10" cellspacing="0">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Emergency Request ID</th>
                    <th>Admin ID</th>
                    <th>Rescue Status</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($reports as $report): ?>

                    <tr>

                        <td>
                            <?php echo (int)$report['id']; ?>
                        </td>

                        <td>
                            <?php
                            echo (int)$report['emergency_request_id'];
                            ?>
                        </td>

                        <td>
                            <?php
                            echo (int)$report['admin_id'];
                            ?>
                        </td>

                       <td>

    <form
        method="POST"
        action="index.php?page=rescue-reports"
    >

        <input
            type="hidden"
            name="id"
            value="<?php echo (int)$report['id']; ?>"
        >

        <select name="rescue_status">

            <option
                value="pending"
                <?php echo $report['rescue_status'] === 'pending' ? 'selected' : ''; ?>
            >
                Pending
            </option>

            <option
                value="ongoing"
                <?php echo $report['rescue_status'] === 'ongoing' ? 'selected' : ''; ?>
            >
                Ongoing
            </option>

            <option
                value="completed"
                <?php echo $report['rescue_status'] === 'completed' ? 'selected' : ''; ?>
            >
                Completed
            </option>

            <option
                value="cancelled"
                <?php echo $report['rescue_status'] === 'cancelled' ? 'selected' : ''; ?>
            >
                Cancelled
            </option>

        </select>

        <button type="submit">
            Update
        </button>

    </form>

</td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $report['description']
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $report['created_at']
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $report['updated_at']
                            );
                            ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>

<?php require_once "views/partials/footer.php"; ?>