<?php 

function url($route, $id = null) {
    $url = $route;
    if ($id !== null) {
        $url .= '/' . $id;
    }
    return $url;
}

function title($pageTitle = "Home", $baseTitle = "Admin Panel | ") {
    return $baseTitle . $pageTitle;
}