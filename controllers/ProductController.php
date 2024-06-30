<?php

require_once "models/Product.php";
require_once "controllers/Controller.php";
require_once "classes/Validator.php";

class ProductController extends Controller
{
    private $product;

    public function __construct($pdo)
    {
        parent::__construct();
        $this->product = new Product($pdo);
    }

    public function index()
    {
        $products = $this->product->getAll();
        require_once "views/products/index.php";
    }

    public function store($name, $price)
    {
        $validator = new Validator($_POST);
        $validator->rules([
            'name' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            flash('name', $errors);
            flash('price', $errors);
            redirect('index?page=product');
            return;
        }
        $data = [
            'name' => $name,
            'price' => $price
        ];
        $this->product->create($data);
        flash('success', 'Product successfully added!');
        redirect('index?page=product');
    }

    public function edit($id)
    {
        $product = $this->product->getById($id);
        require_once "views/products/index.php";
    }

    public function update($name, $price, $id)
    {
        $validator = new Validator($_POST);
        $validator->rules([
            'name' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            flash('name', $errors);
            flash('price', $errors);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }
        $data = [
            'name' => $name,
            'price' => $price
        ];
        $this->product->update($id, $data);
        flash('success', 'Product successfully updated!');
        redirect('index?page=product');
    }

    public function destroy($id)
    {
        $this->product->delete($id);
        flash('success', 'Product successfully deleted!');
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
