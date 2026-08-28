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

    require_once "models/AdminDashboardModel.php";

    $dashboardCounts = getAdminDashboardCounts($conn);

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
elseif ($page === 'feedback-delete') {

    requireAdmin();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die("Invalid request method.");
    }

    require_once "controllers/FeedbackController.php";

    handleDeleteFeedback($conn);
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
elseif ($page === 'rescue-report-create') {

    requireAdmin();

    require_once "controllers/RescueReportController.php";

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $error = handleCreateRescueReport(
            $conn
        );
    }

    require_once "views/admin/rescue_reports/create.php";
}
elseif ($page === 'rescue-report-edit') {

    requireAdmin();

    require_once "models/RescueReportModel.php";
    require_once "controllers/RescueReportController.php";

    $id = isset($_GET['id'])
        ? (int)$_GET['id']
        : 0;

    if ($id <= 0) {
        die("Invalid rescue report ID.");
    }

    $report = getRescueReportById(
        $conn,
        $id
    );

    if (!$report) {
        die("Rescue report not found.");
    }

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $error = handleEditRescueReport(
            $conn,
            $id
        );

        if ($error !== '') {

            $report['rescue_status'] =
                $_POST['rescue_status']
                ?? $report['rescue_status'];

            $report['description'] =
                $_POST['description']
                ?? $report['description'];
        }
    }

    require_once "views/admin/rescue_reports/edit.php";
}
elseif ($page === 'rescue-report-delete') {

    requireAdmin();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die("Invalid request method.");
    }

    require_once "controllers/RescueReportController.php";

    handleDeleteRescueReport($conn);
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

elseif ($page === 'volunteer-dashboard') {

    requireVolunteer();

    require_once "views/volunteer/dashboard.php";
}
elseif ($page === 'volunteer-activities') {

    requireVolunteer();

    require_once "views/volunteer/activities.php";
}
elseif ($page === 'volunteer-update-status') {

    requireVolunteer();

    require_once "models/VolunteerModel.php";

    $request_id = (int)($_POST['request_id'] ?? 0);
    $status = $_POST['status'] ?? '';
    $volunteer_id = (int)($_SESSION['user']['id'] ?? 0);

    if ($request_id <= 0 || $volunteer_id <= 0) {
        die("Invalid request.");
    }

    updateRescueActivityStatus(
        $conn,
        $request_id,
        $volunteer_id,
        $status
    );

    header("Location: index.php?page=volunteer-activities");
    exit;
}
elseif ($page === 'volunteer-availability') {

    requireVolunteer();

    require_once "views/volunteer/availability.php";
}

elseif ($page === 'volunteer-resource-request') {

    requireVolunteer();

    require_once "controllers/ResourceRequestController.php";

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $error = handleCreateResourceRequest($conn);
    }

    require_once "views/volunteer/resource_request_create.php";
}

elseif ($page === 'volunteer-resource-requests') {

    requireVolunteer();

    require_once "models/ResourceRequestModel.php";

    $volunteer_id = (int)$_SESSION['user']['id'];

    $requests = getVolunteerResourceRequests(
        $conn,
        $volunteer_id
    );

    require_once "views/volunteer/resource_requests.php";
}

elseif ($page === 'volunteer-accept-request') {

    requireVolunteer();

    require_once "views/volunteer/accept_request.php";
}
elseif ($page === 'volunteer-emergency-requests') {

    requireVolunteer();

    require_once "views/volunteer/emergency_requests.php";
}
elseif ($page === 'volunteer-profile') {

    requireVolunteer();

    require_once "views/volunteer/profile.php";
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