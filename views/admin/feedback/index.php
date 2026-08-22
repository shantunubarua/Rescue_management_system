<?php require_once "views/partials/header.php"; ?>

<?php require_once "views/partials/sidebar.php"; ?>

<div class="content">

    <h1>Feedback Management</h1>

    <?php if (empty($feedback)): ?>

        <p>No feedback has been submitted yet.</p>

    <?php else: ?>

        <table border="1" cellpadding="10" cellspacing="0">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Help Seeker</th>
                    <th>Rescue Request ID</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($feedback as $item): ?>

                    <tr>

                        <td>
                            <?php echo (int)$item['id']; ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $item['help_seeker_name']
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo $item['rescue_request_id'] !== null
                                ? (int)$item['rescue_request_id']
                                : 'N/A';
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $item['message']
                            );
                            ?>
                        </td>

                        <td>

    <form
        method="POST"
        action="index.php?page=feedback"
    >

        <input
            type="hidden"
            name="id"
            value="<?php echo (int)$item['id']; ?>"
        >

        <select name="status">

            <option
                value="pending"
                <?php echo $item['status'] === 'pending' ? 'selected' : ''; ?>
            >
                Pending
            </option>

            <option
                value="reviewed"
                <?php echo $item['status'] === 'reviewed' ? 'selected' : ''; ?>
            >
                Reviewed
            </option>

            <option
                value="resolved"
                <?php echo $item['status'] === 'resolved' ? 'selected' : ''; ?>
            >
                Resolved
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
                                $item['created_at']
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