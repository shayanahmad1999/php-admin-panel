<?php

class DashboardController{
    public function index()
    {
        require_once "views/dashboard.php";
    }
    public function normaltable()
    {
        require_once "views/tables/normal-table.php";
    }
    public function datatable()
    {
        require_once "views/tables/data-table.php";
    }
}

$controller = new DashboardController();
$action = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
switch ($action) {
        case 'dashboard' :
            $pageTitle = "Dashboard";
            $controller->index();
            break;
}