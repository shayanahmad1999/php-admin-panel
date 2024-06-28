<?php 
require_once 'includes/function.php';

require_once 'views/layout/head.php';
require_once 'views/layout/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$page = preg_replace('/[^-a-zA-Z0-9_]/', '', $page);

$controllerFile = 'controllers/' . $page . 'Controller.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
}
else {
    require_once 'views/error/404.php';
}

require_once 'views/layout/footer.php';