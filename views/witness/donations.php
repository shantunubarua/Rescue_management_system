<?php require_once "views/partials/header.php"; ?>
<?php require_once "views/partials/sidebar.php"; ?>

<div class="content">

    <div class="donations-page">

        <!-- Page Header -->
        <div class="donations-header">

            <div>
                <span class="page-label">
                    DONATION HISTORY
                </span>

                <h1>My Donations</h1>

                <p>
                    View your donation transactions and payment information.
                </p>
            </div>

            <a
                href="index.php?page=donation-create"
                class="new-donation-btn"
            >
                + Make Donation
            </a>

        </div>


        <?php if (empty($donations)): ?>

            <!-- Empty State -->
            <div class="empty-state">

                <div class="empty-icon">
                    DON
                </div>

                <h2>No Donations Yet</h2>

                <p>
                    You have not made any donations yet.
                </p>

                <a
                    href="index.php?page=donation-create"
                    class="empty-button"
                >
                    Make Your First Donation
                </a>

            </div>

        <?php else: ?>


            <!-- Donation Table -->
            <div class="donation-table-card">

                <div class="table-heading">

                    <div>
                        <h2>Donation Transactions</h2>

                        <p>
                            Total donations:
                            <strong>
                                <?php echo count($donations); ?>
                            </strong>
                        </p>
                    </div>

                </div>


                <div class="table-responsive">

                    <table class="donation-table">

                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Payment</th>
                                <th>Transaction ID</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>

                        </thead>


                        <tbody>

                        <?php foreach ($donations as $donation): ?>

                            <?php

                            /*
                             * Payment Method Display Name
                             */

                            $paymentNames = [
                                'card'  => 'Credit Card',
                                'bkash' => 'bKash',
                                'nagad' => 'Nagad',
                                'bank'  => 'Bank Transfer',
                                'cash'  => 'Cash'
                            ];

                            $paymentMethod =
                                $paymentNames[
                                    $donation['payment_method']
                                ]
                                ?? ucfirst(
                                    $donation['payment_method']
                                );


                            /*
                             * Status
                             */

                            $status =
                                strtolower(
                                    $donation['status'] ?? 'pending'
                                );

                            ?>


                            <tr>

                                <!-- Donation ID -->
                                <td>

                                    <span class="donation-id">
                                        #<?php
                                        echo (int)$donation['id'];
                                        ?>
                                    </span>

                                </td>


                                <!-- Amount -->
                                <td>

                                    <span class="donation-amount">

                                        ৳<?php
                                        echo number_format(
                                            (float)$donation['amount'],
                                            2
                                        );
                                        ?>

                                    </span>

                                </td>


                                <!-- Donation Type -->
                                <td>

                                    <span class="type-badge">

                                        <?php
                                        echo htmlspecialchars(
                                            ucfirst(
                                                $donation['donation_type']
                                            )
                                        );
                                        ?>

                                    </span>

                                </td>


                                <!-- Payment Method -->
                                <td>

                                    <div class="payment-method">

                                        <strong>
                                            <?php
                                            echo htmlspecialchars(
                                                $paymentMethod
                                            );
                                            ?>
                                        </strong>

                                    </div>

                                </td>


                                <!-- Transaction ID -->
                                <td>

                                    <div class="transaction-box">

                                        <span
                                            class="transaction-id"
                                            id="txn-<?php echo (int)$donation['id']; ?>"
                                        >
                                            <?php
                                            echo htmlspecialchars(
                                                $donation['transaction_id']
                                                ?? '-'
                                            );
                                            ?>
                                        </span>


                                        <?php if (!empty($donation['transaction_id'])): ?>

                                            <button
                                                type="button"
                                                class="copy-btn"
                                                data-target="txn-<?php echo (int)$donation['id']; ?>"
                                            >
                                                Copy
                                            </button>

                                        <?php endif; ?>

                                    </div>

                                </td>


                                <!-- Status -->
                                <td>

                                    <span
                                        class="status-badge status-<?php echo htmlspecialchars($status); ?>"
                                    >

                                        <?php
                                        echo htmlspecialchars(
                                            ucfirst($status)
                                        );
                                        ?>

                                    </span>

                                </td>


                                <!-- Date -->
                                <td>

                                    <div class="date-cell">

                                        <?php

                                        if (!empty($donation['created_at'])) {

                                            echo htmlspecialchars(
                                                date(
                                                    'd M Y',
                                                    strtotime(
                                                        $donation['created_at']
                                                    )
                                                )
                                            );

                                            echo '<small>';

                                            echo htmlspecialchars(
                                                date(
                                                    'h:i A',
                                                    strtotime(
                                                        $donation['created_at']
                                                    )
                                                )
                                            );

                                            echo '</small>';

                                        } else {

                                            echo '-';
                                        }

                                        ?>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        <?php endif; ?>

    </div>

</div>


<style>

/* =========================
   Page
========================= */

.donations-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 10px 5px 40px;
}


/* =========================
   Header
========================= */

.donations-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.page-label {
    display: block;
    margin-bottom: 5px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.3px;
    color: #6b7280;
}

.donations-header h1 {
    margin: 0 0 7px;
    color: #1f2937;
    font-size: 30px;
}

.donations-header p {
    margin: 0;
    color: #6b7280;
    font-size: 14px;
}

.new-donation-btn {
    display: inline-block;
    padding: 11px 18px;
    border-radius: 7px;
    background: #26384d;
    color: #ffffff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    transition: 0.2s ease;
}

.new-donation-btn:hover {
    background: #172536;
}


/* =========================
   Table Card
========================= */

.donation-table-card {
    overflow: hidden;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
}

.table-heading {
    padding: 22px 24px;
    border-bottom: 1px solid #e5e7eb;
}

.table-heading h2 {
    margin: 0 0 4px;
    color: #1f2937;
    font-size: 20px;
}

.table-heading p {
    margin: 0;
    color: #6b7280;
    font-size: 13px;
}


/* =========================
   Table
========================= */

.table-responsive {
    width: 100%;
    overflow-x: auto;
}

.donation-table {
    width: 100%;
    border-collapse: collapse;
}

.donation-table thead {
    background: #f8fafc;
}

.donation-table th {
    padding: 14px 16px;
    border-bottom: 1px solid #e5e7eb;
    color: #475569;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.3px;
    text-align: left;
    white-space: nowrap;
}

.donation-table td {
    padding: 17px 16px;
    border-bottom: 1px solid #eef0f2;
    color: #374151;
    font-size: 14px;
    vertical-align: middle;
}

.donation-table tbody tr {
    transition: background 0.2s ease;
}

.donation-table tbody tr:hover {
    background: #fafbfc;
}

.donation-table tbody tr:last-child td {
    border-bottom: none;
}


/* =========================
   Donation ID
========================= */

.donation-id {
    font-weight: 700;
    color: #475569;
}


/* =========================
   Amount
========================= */

.donation-amount {
    color: #111827;
    font-size: 15px;
    font-weight: 800;
}


/* =========================
   Donation Type
========================= */

.type-badge {
    display: inline-block;
    padding: 6px 10px;
    background: #f1f5f9;
    border-radius: 6px;
    color: #475569;
    font-size: 12px;
    font-weight: 700;
}


/* =========================
   Payment
========================= */

.payment-method strong {
    color: #374151;
    font-size: 13px;
}


/* =========================
   Transaction
========================= */

.transaction-box {
    display: flex;
    align-items: center;
    gap: 8px;
}

.transaction-id {
    display: inline-block;
    padding: 6px 8px;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 5px;
    color: #334155;
    font-family: Consolas, monospace;
    font-size: 12px;
    white-space: nowrap;
}

.copy-btn {
    padding: 6px 9px;
    background: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 5px;
    color: #475569;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s ease;
}

.copy-btn:hover {
    background: #f1f5f9;
}

.copy-btn.copied {
    background: #ecfdf3;
    border-color: #a6d7b5;
    color: #18794e;
}


/* =========================
   Status
========================= */

.status-badge {
    display: inline-block;
    min-width: 70px;
    padding: 6px 10px;
    border-radius: 20px;
    text-align: center;
    font-size: 11px;
    font-weight: 700;
}

.status-pending {
    background: #fff7e6;
    color: #9a6700;
    border: 1px solid #f3d28b;
}

.status-completed,
.status-approved,
.status-success {
    background: #ecfdf3;
    color: #18794e;
    border: 1px solid #b7e4c7;
}

.status-rejected,
.status-failed,
.status-cancelled {
    background: #fff1f1;
    color: #b42318;
    border: 1px solid #f0b8b8;
}


/* =========================
   Date
========================= */

.date-cell {
    display: flex;
    flex-direction: column;
    gap: 3px;
    white-space: nowrap;
}

.date-cell small {
    color: #9ca3af;
    font-size: 11px;
}


/* =========================
   Empty State
========================= */

.empty-state {
    padding: 55px 25px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    text-align: center;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
}

.empty-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 17px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
    border-radius: 50%;
    color: #475569;
    font-size: 12px;
    font-weight: 800;
}

.empty-state h2 {
    margin: 0 0 8px;
    color: #1f2937;
}

.empty-state p {
    margin: 0 0 20px;
    color: #6b7280;
}

.empty-button {
    display: inline-block;
    padding: 11px 18px;
    background: #26384d;
    border-radius: 7px;
    color: white;
    text-decoration: none;
    font-weight: 700;
}


/* =========================
   Responsive
========================= */

@media (max-width: 700px) {

    .donations-header {
        flex-direction: column;
        align-items: flex-start;
    }

}

/* =========================================
   FIX: Donation Page Text Visibility
========================================= */

/* Make Donation button */
.donations-page .new-donation-btn {
    background: #26384d !important;
    color: #ffffff !important;
}

.donations-page .new-donation-btn:hover {
    background: #172536 !important;
    color: #ffffff !important;
}


/* Table Header */
.donations-page .donation-table thead {
    background: #34495e !important;
}

.donations-page .donation-table thead th {
    background: #34495e !important;
    color: #ffffff !important;
    font-weight: 700 !important;
}


/* Table body text */
.donations-page .donation-table tbody td {
    color: #27364a !important;
}


/* Payment method */
.donations-page .payment-method strong {
    color: #1f2937 !important;
    font-weight: 700;
}


/* Donation ID */
.donations-page .donation-id {
    color: #26384d !important;
    font-weight: 800;
}


/* Type Badge */
.donations-page .type-badge {
    background: #eef2f7 !important;
    color: #26384d !important;
    font-weight: 700;
}

</style>


<script>

/*
|--------------------------------------------------------------------------
| Copy Transaction ID
|--------------------------------------------------------------------------
*/

const copyButtons =
    document.querySelectorAll('.copy-btn');

copyButtons.forEach(function(button) {

    button.addEventListener('click', function() {

        const targetId =
            button.getAttribute('data-target');

        const transactionElement =
            document.getElementById(targetId);

        if (!transactionElement) {
            return;
        }

        const transactionId =
            transactionElement.textContent.trim();


        navigator.clipboard
            .writeText(transactionId)
            .then(function() {

                const oldText =
                    button.textContent;

                button.textContent =
                    'Copied';

                button.classList.add(
                    'copied'
                );


                setTimeout(function() {

                    button.textContent =
                        oldText;

                    button.classList.remove(
                        'copied'
                    );

                }, 1500);

            });

    });

});

</script>


<?php require_once "views/partials/footer.php"; ?>