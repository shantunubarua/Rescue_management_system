<?php require_once "views/partials/header.php"; ?>

<?php require_once "views/partials/sidebar.php"; ?>

<div class="content">

    <h1>Make a Donation</h1>

    <p>
        Enter your donation information and continue to payment.
    </p>


    <?php if (!empty($error)): ?>

        <p style="color: red;">
            <?php echo htmlspecialchars($error); ?>
        </p>

    <?php endif; ?>


    <form
        method="POST"
        action="index.php?page=donation-create"
    >

        <!-- Donation Amount -->

        <div>

            <label for="amount">
                Donation Amount *
            </label>

            <br>

            <input
                type="number"
                id="amount"
                name="amount"
                min="0.01"
                step="0.01"
                required
                value="<?php
                    echo htmlspecialchars(
                        $_POST['amount'] ?? ''
                    );
                ?>"
            >

        </div>

        <br>


        <!-- Donation Type -->

        <div>

            <label for="donation_type">
                Donation Type *
            </label>

            <br>

            <select
                id="donation_type"
                name="donation_type"
                required
            >

                <option value="">
                    Select Donation Type
                </option>


                <option
                    value="money"
                    <?php
                    echo (
                        ($_POST['donation_type'] ?? '')
                        === 'money'
                    ) ? 'selected' : '';
                    ?>
                >
                    Money
                </option>


                <option
                    value="food"
                    <?php
                    echo (
                        ($_POST['donation_type'] ?? '')
                        === 'food'
                    ) ? 'selected' : '';
                    ?>
                >
                    Food
                </option>


                <option
                    value="medicine"
                    <?php
                    echo (
                        ($_POST['donation_type'] ?? '')
                        === 'medicine'
                    ) ? 'selected' : '';
                    ?>
                >
                    Medicine
                </option>


                <option
                    value="clothes"
                    <?php
                    echo (
                        ($_POST['donation_type'] ?? '')
                        === 'clothes'
                    ) ? 'selected' : '';
                    ?>
                >
                    Clothes
                </option>


                <option
                    value="other"
                    <?php
                    echo (
                        ($_POST['donation_type'] ?? '')
                        === 'other'
                    ) ? 'selected' : '';
                    ?>
                >
                    Other
                </option>

            </select>

        </div>

        <br>


        <!-- Message -->

        <div>

            <label for="message">
                Message
            </label>

            <br>

            <textarea
                id="message"
                name="message"
                rows="5"
                maxlength="500"
                placeholder="Write an optional message..."
            ><?php
                echo htmlspecialchars(
                    $_POST['message'] ?? ''
                );
            ?></textarea>

        </div>

        <br>


        <!-- Continue -->

        <button type="submit">
            Continue to Payment
        </button>

    </form>


    <br>

    <p>
        <a href="index.php?page=donations">
            View My Donations
        </a>
    </p>

</div>

<?php require_once "views/partials/footer.php"; ?>