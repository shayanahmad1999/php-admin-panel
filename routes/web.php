<?php

require 'includes/config.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

$page = preg_replace('/[^-a-zA-Z0-9_]/', '', $page);

$controllerFile = 'controllers/' . $page . 'Controller.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($page) . 'Controller';
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass($pdo);

        $action = isset($_GET['action']) ? $_GET['action'] : 'index';
        $action = preg_replace('/[^-a-zA-Z0-9_]/', '', $action);

        switch ($action) {
            case 'index':
                $pageTitle = ucfirst($page) . " List";
                break;
            case 'show':
                $pageTitle = ucfirst($page) . " Details";
                break;
            case 'create':
                $pageTitle = "Create " . ucfirst($page);
                break;
            case 'store':
                $pageTitle = "Store " . ucfirst($page);
                break;
            case 'edit':
                $pageTitle = "Edit " . ucfirst($page);
                break;
            case 'update':
                $pageTitle = "Update " . ucfirst($page);
                break;
            case 'destroy':
                $pageTitle = "Delete " . ucfirst($page);
                break;
            default:
                $pageTitle = ucfirst($page);
                break;
        }

        $params = array_merge($_GET, $_POST);

        unset($params['page'], $params['action']);

        if (method_exists($controller, $action)) {
            ob_start();
            call_user_func_array([$controller, $action], $params);
            ob_end_flush();
        } else {
            require_once 'views/error/404.php';
        }
    } else {
        require_once 'views/error/404.php';
    }
} else {
    require_once 'views/error/404.php';
}
