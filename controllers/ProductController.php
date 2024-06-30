<?php

require_once "models/Product.php";

class ProductController
{
    private $product;

    public function __construct($pdo)
    {
        $this->product = new Product($pdo);
    }

    public function index()
    {
        $products = $this->product->getAll();
        require_once "views/products/index.php";
    }

    public function store($name, $price)
    {
        $data = [
            'name' => $name,
            'price' => $price
        ];
        $this->product->create($data);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function edit($id)
    {
        $product = $this->product->getById($id);
        require_once "views/products/index.php";
    }

    public function update($name, $price, $id)
    {
        $data = [
            'name' => $name,
            'price' => $price
        ];
        $this->product->update($id, $data);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function destroy($id)
    {
        $this->product->delete($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function status($id, $status)
    {
        $newStatus = ($status == 0) ? 1 : 0;
        $data = ['status' => $newStatus];
        $this->product->update($id, $data);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    // $products = $productController->getProductsByConditions(['name' => 'Laptop']);
    // print_r($products);
}
