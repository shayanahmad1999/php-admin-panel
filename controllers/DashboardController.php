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
}