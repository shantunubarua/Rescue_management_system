<?php

require_once "views/partials/header.php";
require_once "views/partials/sidebar.php";

?>

<div class="content">

    <h1>Edit Incident Report</h1>

    <?php if (!empty($error)): ?>

        <p class="error-message">
            <?php echo htmlspecialchars($error); ?>
        </p>

    <?php endif; ?>

    <form method="POST">

        <div>
            <label for="title">
                Title *
            </label>

            <input
                type="text"
                id="title"
                name="title"
                value="<?php
                    echo htmlspecialchars(
                        $report['title'] ?? ''
                    );
                ?>"
                required
            >
        </div>

        <div>
            <label for="description">
                Description *
            </label>

            <textarea
                id="description"
                name="description"
                required
            ><?php
                echo htmlspecialchars(
                    $report['description'] ?? ''
                );
            ?></textarea>
        </div>

        <div>
            <label for="incident_type">
                Incident Type *
            </label>

            <select
                id="incident_type"
                name="incident_type"
                required
            >

                <option value="">
                    Select Incident Type
                </option>

                <?php

                $allowed_types = [
                    'accident',
                    'fire',
                    'flood',
                    'medical',
                    'other'
                ];

                foreach ($allowed_types as $type):

                ?>

                    <option
                        value="<?php echo $type; ?>"
                        <?php
                        echo (
                            ($report['incident_type'] ?? '')
                            === $type
                        ) ? 'selected' : '';
                        ?>
                    >
                        <?php
                        echo ucfirst($type);
                        ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </div>

        <div>
            <label for="location">
                Location *
            </label>

            <input
                type="text"
                id="location"
                name="location"
                value="<?php
                    echo htmlspecialchars(
                        $report['location'] ?? ''
                    );
                ?>"
                required
            >
        </div>

        <div>
            <label for="incident_date">
                Incident Date *
            </label>

            <input
                type="date"
                id="incident_date"
                name="incident_date"
                value="<?php
                    echo htmlspecialchars(
                        $report['incident_date'] ?? ''
                    );
                ?>"
                required
            >
        </div>

        <br>

        <button type="submit">
            Update Report
        </button>

        <a href="index.php?page=witness-reports">
            Cancel
        </a>

    </form>

</div>

<?php require_once "views/partials/footer.php"; ?>