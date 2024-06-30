<?php
require_once "controllers/Controller.php";
require_once 'models/User.php';
require_once 'models/Product.php';
class DashboardController extends Controller{
    private $userModel;
    private $productModel;
    protected $pdo;
    public function __construct($pdo) {
        parent::__construct();
        $this->pdo = $pdo;
        $this->userModel = new User($pdo, 1);
        $this->productModel = new Product($pdo);
    }
    public function index()
    {
        $users = $this->userModel->countUsers();
        $products = $this->productModel->count();
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
    public function form1()
    {
        require_once "views/forms/form1.php";
    }
    public function form2()
    {
        require_once "views/forms/form2.php";
    }
    public function form3()
    {
        require_once "views/forms/form3.php";
    }
    public function notifications()
    {
        require_once "views/appviews/notifications.php";
    }
    public function alerts()
    {
        require_once "views/appviews/alerts.php";
    }
    public function modals()
    {
        require_once "views/appviews/modals.php";
    }
    public function buttons()
    {
        require_once "views/appviews/buttons.php";
    }
    public function tabs()
    {
        require_once "views/appviews/tabs.php";
    }
    public function accordian()
    {
        require_once "views/appviews/accordian.php";
    }
    public function dialogs()
    {
        require_once "views/appviews/dialogs.php";
    }
}
