<?php

function url($route, $id = null) {
    $url = 'index?page=' . $route;
    if ($id !== null) {
        $url .= '&id=' . $id;
    }
    return $url;
}

function title($pageTitle = "Home", $baseTitle = "Admin Panel | ") {
    return $baseTitle . $pageTitle;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function redirect($url) {
    header("Location: $url");
    exit();
}
