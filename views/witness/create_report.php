<?php require_once "views/partials/header.php"; ?>

<?php require_once "views/partials/sidebar.php"; ?>

<div class="content">

    <h1>Report an Incident</h1>

    <?php if (!empty($error)): ?>

        <p style="color: red;">
            <?php echo htmlspecialchars($error); ?>
        </p>

    <?php endif; ?>


    <form
    method="POST"
    action="index.php?page=witness-report-create"
    enctype="multipart/form-data"
>

        <div>

            <label for="title">
                Incident Title
            </label>

            <br>

            <input
                type="text"
                id="title"
                name="title"
                maxlength="150"
                required
            >

        </div>

        <br>


        <div>

            <label for="description">
                Description
            </label>

            <br>

            <textarea
                id="description"
                name="description"
                rows="6"
                required
            ></textarea>

        </div>

        <br>


        <div>

            <label for="incident_type">
                Incident Type
            </label>

            <br>

            <select
                id="incident_type"
                name="incident_type"
                required
            >

                <option value="">
                    Select incident type
                </option>

                <option value="accident">
                    Accident
                </option>

                <option value="fire">
                    Fire
                </option>

                <option value="flood">
                    Flood
                </option>

                <option value="medical">
                    Medical Emergency
                </option>

                <option value="other">
                    Other
                </option>

            </select>

        </div>

        <br>


        <div>

            <label for="location">
                Location
            </label>

            <br>

            <input
                type="text"
                id="location"
                name="location"
                maxlength="255"
                required
            >

        </div>

        <br>

<div>

    <label for="evidence_file">
        Evidence File
    </label>

    <br>

    <input
        type="file"
        id="evidence_file"
        name="evidence_file"
        accept=".jpg,.jpeg,.png,.pdf"
    >

    <br>

    <small>
        Allowed: JPG, JPEG, PNG, PDF
    </small>

</div>

<br>


        <button type="submit">
            Submit Incident Report
        </button>

    </form>

</div>

<?php require_once "views/partials/footer.php"; ?>