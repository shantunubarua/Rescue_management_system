<?php

require_once "views/partials/header.php";
require_once "views/partials/sidebar.php";

require_once "models/VolunteerModel.php";

$volunteer_id = $_SESSION['user']['id'];

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $availability = $_POST['availability'] ?? '';

    if (
        $availability === 'available' ||
        $availability === 'unavailable'
    ) {

        $sql = "UPDATE users
                SET availability = ?
                WHERE id = ?
                AND role = 'volunteer'";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $availability,
            $volunteer_id
        );

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        $message = "Availability updated successfully.";
    }
}

$sql = "SELECT availability
        FROM users
        WHERE id = ?
        AND role = 'volunteer'
        LIMIT 1";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $volunteer_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

$current_availability = $user['availability'] ?? 'available';

?>

<div class="content">

    <h1>My Availability</h1>

    <p>
        Update your current availability status.
    </p>

    <?php if ($message): ?>

        <div class="card">
            <p>
                <?php echo htmlspecialchars($message); ?>
            </p>
        </div>

    <?php endif; ?>

    <div class="card">

        <h3>Availability Status</h3>

        <form method="POST">

            <div>

                <label for="availability">
                    Current Availability
                </label>

                <select
                    name="availability"
                    id="availability"
                >

                    <option
                        value="available"
                        <?php
                        echo $current_availability === 'available'
                            ? 'selected'
                            : '';
                        ?>
                    >
                        Available
                    </option>

                    <option
                        value="unavailable"
                        <?php
                        echo $current_availability === 'unavailable'
                            ? 'selected'
                            : '';
                        ?>
                    >
                        Unavailable
                    </option>

                </select>

            </div>

            <button type="submit">
                Update Availability
            </button>

        </form>

    </div>

</div>

<?php require_once "views/partials/footer.php"; ?>