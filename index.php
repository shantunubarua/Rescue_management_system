<?php

require_once "config/database.php";
require_once "helpers/auth.php";

$page = $_GET['page'] ?? 'login';

if ($page === 'login') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        require_once "controllers/AuthController.php";

        $error = loginUser();
    }

    require_once "views/auth/login.php";

} elseif ($page === 'admin-dashboard') {

    requireAdmin();

    require_once "views/admin/dashboard.php";
}
elseif ($page === 'logout') {

    logoutUser();

    header("Location: index.php?page=login");
    exit;
}
elseif ($page === 'notifications') {

    requireAdmin();

    require_once "models/NotificationModel.php";

    $notifications = getAllNotifications($conn);

    require_once "views/admin/notifications/index.php";

}
elseif ($page === 'feedback') {

    requireAdmin();

    require_once "controllers/FeedbackController.php";

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $error = handleUpdateFeedbackStatus($conn);
    }

    $feedback = loadAllFeedback($conn);

    require_once "views/admin/feedback/index.php";
}
elseif ($page === 'rescue-reports') {

    requireAdmin();

    require_once "controllers/RescueReportController.php";

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $error = handleUpdateRescueReportStatus($conn);
    }

    $reports = loadAllRescueReports($conn);

    require_once "views/admin/rescue_reports/index.php";
}

 elseif ($page === 'notification-create') {

    requireAdmin();
    //g

    require_once "controllers/NotificationController.php";

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $error = handleCreateNotification($conn);
    }

    require_once "views/admin/notifications/create.php";
}
elseif ($page === 'notification-edit') {

    requireAdmin();

    require_once "models/NotificationModel.php";
    require_once "controllers/NotificationController.php";

    $id = isset($_GET['id'])
        ? (int)$_GET['id']
        : 0;

    if ($id <= 0) {
        die("Invalid notification ID.");
    }

    $notification = getNotificationById($conn, $id);

    if (!$notification) {
        die("Notification not found.");
    }

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $error = handleUpdateNotification(
            $conn,
            $id
        );

        if ($error !== '') {
            $notification['title'] =
                $_POST['title'] ?? $notification['title'];

            $notification['message'] =
                $_POST['message'] ?? $notification['message'];

            $notification['alert_type'] =
                $_POST['alert_type'] ?? $notification['alert_type'];

            $notification['status'] =
                $_POST['status'] ?? $notification['status'];
        }
    }

    require_once "views/admin/notifications/edit.php";
}
elseif ($page === 'notification-delete') {

    requireAdmin();

    require_once "models/NotificationModel.php";
    require_once "controllers/NotificationController.php";

    $id = isset($_GET['id'])
        ? (int)$_GET['id']
        : 0;

    if ($id <= 0) {
        die("Invalid notification ID.");
    }

    handleDeleteNotification($conn, $id);
}
elseif ($page === 'witness-dashboard') {

    requireWitness();

    require_once "views/witness/dashboard.php";
}

elseif ($page === 'helpseeker-dashboard') {

    requireHelpSeeker();

    require_once "views/helpseeker/dashboard.php";
}
elseif ($page === 'helpseeker-request-create') {

    requireHelpSeeker();

    require_once "controllers/HelpSeekerController.php";

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $error = handleCreateEmergencyRequest($conn);
    }

    require_once "views/helpseeker/create_request.php";
}
elseif ($page === 'witness-report-create') {

    requireWitness();

    require_once "controllers/WitnessController.php";

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $error = handleCreateWitnessReport($conn);
    }

    require_once "views/witness/create_report.php";
}
elseif ($page === 'witness-reports') {

    requireWitness();

    require_once "models/WitnessModel.php";

    $witness_id = $_SESSION['user']['id'];

    $reports = getWitnessReports(
        $conn,
        $witness_id
    );

    require_once "views/witness/reports.php";
}

else {

    echo "Page not found.";
}