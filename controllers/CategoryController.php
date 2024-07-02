<?php

require_once "models/Category.php";
require_once "models/Product.php";
require_once "controllers/Controller.php";
require_once "classes/Validator.php";

class CategoryController extends Controller
{
    private $category;
    private $product;

    public function __construct($pdo)
    {
        parent::__construct();
        $this->category = new Category($pdo);
        $this->product = new Product($pdo);
    }

    public function index()
    {
        $categories = $this->category->getAll();
        $products = $this->product->getAll();
        foreach ($categories as $category) {
            $product_id = $category->product_id;
            // $category->products = $category->products(); 
        }
        require_once "views/categories/index.php";
    }

    public function store($name, $description, $products = [], $update_key = null)
    {
        $validator = new Validator($_POST);
        $validator->rules([
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            $response = ['status' => 'error', 'data' => $errors];
            echo json_encode($response);
            exit();

            flash('name', $errors);
            flash('description', $errors);
            redirect('index?page=category');
            return;
        }
        $productIds = implode(',', $products);
        $data = [
            'name' => $name,
            'description' => $description,
            'product_id' => $productIds, 
        ];


        if ($update_key !== null) {
            $this->category->update($update_key, $data);
            $updatedcategory = $this->category->getById($update_key);

            if ($updatedcategory) {
                $updatedData = '
                <tr>
                    <td>' . $updatedcategory->id . '</td>
                    <td>' . $updatedcategory->name . '</td>
                    <td>' . $updatedcategory->description . '</td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="ajaxLoad(\'' . url('category&action=edit&id=' . $updatedcategory->id) . '\', \'' . $updatedcategory->id . '\')" data-id="' . $updatedcategory->id . '">Edit</button>
                        <button  class="btn btn-danger btn-sm" onclick="ajaxLoad(\'' . url('category&action=destroy&id=' . $updatedcategory->id) . '\', \'' . $updatedcategory->id . '\')" data-id="' . $updatedcategory->id . '">Delete</button>
                    </td>
                </tr>';

                $response = ['status' => 'update', 'data' => $updatedData, 'id' => $updatedcategory->id];
                echo json_encode($response);
                exit();
            }
        }

        $this->category->create($data);
        $lastInsertedId = $this->category->lastInsertedId();
        $fetch = $lastInsertedId ? $this->category->getById($lastInsertedId) : null;

        if ($fetch) {
            $newData = '
                        <tr>
                            <td>' . $fetch->id . '</td>
                            <td>' . $fetch->name . '</td>
                            <td>' . $fetch->description . '</td>
                            <td>
                                <button class="btn btn-info btn-sm" onclick="ajaxLoad(\'' . url('category&action=edit&id=' . $fetch->id) . '\', \'' . $fetch->id . '\')" data-id="' . $fetch->id . '">Edit</button>
                                <button  class="btn btn-danger btn-sm" onclick="ajaxLoad(\'' . url('category&action=destroy&id=' . $fetch->id) . '\', \'' . $fetch->id . '\')" data-id="' . $fetch->id . '">Delete</button>
                            </td>
                        </tr>';

            $response = ['status' => 'success', 'data' => $newData];
            echo json_encode($response);
            exit();
        }

        flash('success', 'category successfully ' . ($update_key !== null ? 'updated' : 'added') . '!');
        redirect('index?page=category');
    }

    public function edit($id)
    {
        $category = $this->category->getById($id);
        $response = array('status' => 'edit', 'data' => $category);
        echo json_encode($response);
        exit();
        require_once "views/categories/index.php";
    }

    public function destroy($id)
    {
        $this->category->delete($id);
        $response = array('status' => 'success');
        echo json_encode($response);
        exit();
        flash('success', 'category successfully deleted!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

}
