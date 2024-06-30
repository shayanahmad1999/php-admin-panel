<?php
require_once 'includes/functions.php';

ob_start();

require_once 'routes/web.php'; 

$content = ob_get_clean();

if(Auth::user())
{
    require_once 'views/layout/header.php';
}
require_once 'views/layout/head.php';

echo $content;

require_once 'views/layout/footer.php';

ob_end_flush();
?>
