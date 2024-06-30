<?php
require_once "classes/Database.php";
class Product {
    private $model;

    public function __construct($pdo) {
        $this->model = new DatabaseManager($pdo, 'products');
    }

    public function create($data) {
        return $this->model->create($data);
        
    }

    public function getById($id) {
        return $this->model->findById($id);
    }

    public function getByConditions($conditions = []) {
        return $this->model->findByConditions($conditions);
    }

    public function getAll() {
        return $this->model->findAll();
    }

    public function update($id, $data) {
        return $this->model->update($id, $data);
    }

    public function delete($id) {
        return $this->model->delete($id);
    }
}
