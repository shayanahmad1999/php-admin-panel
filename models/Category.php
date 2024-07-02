<?php
require_once "classes/Database.php";
class Category extends DatabaseManager{
    private $model;

    public function __construct($pdo) {
        $this->model = new DatabaseManager($pdo, 'categories');
    }

    public function create($data) {
        return $this->model->create($data);
        
    }

    public function lastInsertedId() {
        return $this->model->lastInsertedId();
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

    public function count() {
        return $this->model->count();
    }


    public function products() {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }
}
