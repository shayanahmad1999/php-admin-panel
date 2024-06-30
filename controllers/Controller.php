<?php
class Controller {
    public function __construct() {
        $this->checkAuthentication();
    }

    protected function checkAuthentication() {
        require_once 'includes/functions.php';
        if (!isLoggedIn()) {
            redirect('index?page=user&action=userloginView');
        }
    }

    protected function requireAuthentication() {
        $this->checkAuthentication();
    }
}
