<?php
require_once 'includes/functions.php';

// Define pages that do not require login
// $publicPages = ['login', 'user'];
// if (!in_array($_GET['page'] ?? 'dashboard', $publicPages) && !isset($_SESSION['user_id'])) {
// Check if the user is logged in
// if (!Auth::user() && (!isset($_GET['page']) || $_GET['page'] !== 'login')) {
//     require_once "views/auth/login.php";
//     exit();
// }

ob_start();

require_once 'routes/web.php'; 

$content = ob_get_clean();

require_once 'views/layout/header.php';
require_once 'views/layout/head.php';

echo $content;

require_once 'views/layout/footer.php';

ob_end_flush();
?>
