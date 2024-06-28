<?php
require_once 'includes/functions.php';
require_once 'views/layout/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

$page = preg_replace('/[^-a-zA-Z0-9_]/', '', $page);

$controllerFile = 'controllers/' . $page . 'Controller.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
} else {
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
        case 'form1':
            $pageTitle = "Forms 1";
            $dashboardController->form1();
            break;
        case 'form2':
            $pageTitle = "Forms 2";
            $dashboardController->form2();
            break;
        case 'form3':
            $pageTitle = "Forms 3";
            $dashboardController->form3();
            break;
        case 'notifications':
            $pageTitle = "Notifications";
            $dashboardController->notifications();
            break;
        case 'alerts':
            $pageTitle = "alerts";
            $dashboardController->alerts();
            break;
        case 'modals':
            $pageTitle = "modals";
            $dashboardController->modals();
            break;
        case 'buttons':
            $pageTitle = "buttons";
            $dashboardController->buttons();
            break;
        case 'tabs':
            $pageTitle = "tabs";
            $dashboardController->tabs();
            break;
        case 'accordian':
            $pageTitle = "accordian";
            $dashboardController->accordian();
            break;
        case 'dialogs':
            $pageTitle = "dialogs";
            $dashboardController->dialogs();
            break;
        case 'dropdowns':
            $pageTitle = "dropdowns";
            $dashboardController->dropdowns();
            break;
        default:
            require_once 'views/error/404.php';
            break;
    }
}



require_once 'views/layout/head.php';

require_once 'views/layout/footer.php';
