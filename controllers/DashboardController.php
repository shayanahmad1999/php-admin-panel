<?php

class DashboardController{
    public function index()
    {
        require_once "views/dashboard.php";
    }
}

$controller = new DashboardController();
$action = isset($_GET['page']) ? $_GET['page'] : 'index';
switch ($action) {
    case 'index' :
        $controller->index();
        break;
    default :
    die ('Invalid action');
}