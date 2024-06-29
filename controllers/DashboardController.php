<?php

class DashboardController{
    public function index()
    {
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
