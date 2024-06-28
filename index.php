<?php
require_once 'includes/functions.php';
require_once 'views/layout/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

$page = preg_replace('/[^-a-zA-Z0-9_]/', '', $page);

require_once 'controllers/DashboardController.php';

$dashboardController = new DashboardController();

switch ($page) {
    case 'dashboard':
        $pageTitle = "Dashboard";
        $dashboardController->index();
        break;
    case 'normaltable':
        $pageTitle = "Normal Table";
        $dashboardController->normaltable();
        break;
    case 'datatable':
        $pageTitle = "Data Table";
        $dashboardController->datatable();
        break;
    default:
        require_once 'views/error/404.php';
        break;
}

require_once 'views/layout/head.php';

require_once 'views/layout/footer.php';
