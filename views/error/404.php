
<div class="error-page-area">
    <div class="error-page-wrap">
        <i class="notika-icon notika-close"></i>
        <h2>ERROR <span class="counter">404</span></h2>
        <p>
            <?php if(isset($action)) {
                echo "Action '$action' not found in controller '$controllerClass'";
            } elseif(isset($controllerClass)) {
                echo "Controller class '$controllerClass' not found.";
                ?> 
            <?php } else { ?>
            Sorry, but the page you are looking for has note been found. Try checking the URL for an error, then hit the refresh button on your browser or try found something else in our app.
            <?php } ?>
        </p>
        <a href="<?= url('dashboard') ?>" class="btn">Dashboard</a>
        <a href="#" class="btn error-btn-mg">Report Problem</a>
    </div>
</div>
