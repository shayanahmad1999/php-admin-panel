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

    public function store($name, $price, $update_key = null)
    {
        $validator = new Validator($_POST);
        $validator->rules([
            'name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            $response = ['status' => 'error', 'data' => $errors];
            echo json_encode($response);
            exit();

            flash('name', $errors);
            flash('price', $errors);
            redirect('index?page=product');
            return;
        }

        $data = [
            'name' => $name,
            'price' => $price
        ];

        if ($update_key !== null) {
            $this->product->update($update_key, $data);
            $updatedProduct = $this->product->getById($update_key);

            if ($updatedProduct) {
                $statusBadge = ($updatedProduct->status == 0)
                    ?
                    "<a href='javascript:;' class='badge btn-danger' onclick=\"statusChange('" . url('product&action=status&id=' . $updatedProduct->id . '&status=' . $updatedProduct->status) . "', " . $updatedProduct->id . ")\" data-id=\"" . $updatedProduct->id . "\">in Active</a>"
                    :
                    "<a href='javascript:;' class='badge btn-danger' onclick=\"statusChange('" . url('product&action=status&id=' . $updatedProduct->id . '&status=' . $updatedProduct->status) . "', " . $updatedProduct->id . ")\" data-id=\"" . $updatedProduct->id . "\">Active</a>";

                $updatedData = '
                <tr>
                    <td>' . $updatedProduct->id . '</td>
                    <td>' . $updatedProduct->name . '</td>
                    <td>' . $updatedProduct->price . '</td>
                    <td>' . $statusBadge . '</td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="ajaxLoad(\'' . url('product&action=edit&id=' . $updatedProduct->id) . '\', \'' . $updatedProduct->id . '\')" data-id="' . $updatedProduct->id . '">Edit</button>
                        <button  class="btn btn-danger btn-sm" onclick="ajaxLoad(\'' . url('product&action=destroy&id=' . $updatedProduct->id) . '\', \'' . $updatedProduct->id . '\')" data-id="' . $updatedProduct->id . '">Delete</button>
                    </td>
                </tr>';

                $response = ['status' => 'update', 'data' => $updatedData, 'id' => $updatedProduct->id];
                echo json_encode($response);
                exit();
            }
        }

        $this->product->create($data);
        $lastInsertedId = $this->product->lastInsertedId();
        $fetch = $lastInsertedId ? $this->product->getById($lastInsertedId) : null;

        if ($fetch) {
            $statusBadge = ($fetch->status == 0)
                ?
                "<a href='javascript:;' class='badge btn-danger' onclick=\"statusChange('" . url('product&action=status&id=' . $fetch->id . '&status=' . $fetch->status) . "', " . $fetch->id . ")\" data-id=\"" . $fetch->id . "\">in Active</a>"
                :
                "<a href='javascript:;' class='badge btn-danger' onclick=\"statusChange('" . url('product&action=status&id=' . $fetch->id . '&status=' . $fetch->status) . "', " . $fetch->id . ")\" data-id=\"" . $fetch->id . "\">Active</a>";

            $newData = '
                        <tr>
                            <td>' . $fetch->id . '</td>
                            <td>' . $fetch->name . '</td>
                            <td>' . $fetch->price . '</td>
                            <td>' . $statusBadge . '</td>
                            <td>
                                <button class="btn btn-info btn-sm" onclick="ajaxLoad(\'' . url('product&action=edit&id=' . $fetch->id) . '\', \'' . $fetch->id . '\')" data-id="' . $fetch->id . '">Edit</button>
                                <button  class="btn btn-danger btn-sm" onclick="ajaxLoad(\'' . url('product&action=destroy&id=' . $fetch->id) . '\', \'' . $fetch->id . '\')" data-id="' . $fetch->id . '">Delete</button>
                            </td>
                        </tr>';

            $response = ['status' => 'success', 'data' => $newData];
            echo json_encode($response);
            exit();
        }

        flash('success', 'Product successfully ' . ($update_key !== null ? 'updated' : 'added') . '!');
        redirect('index?page=product');
    }


    public function edit($id)
    {
        $product = $this->product->getById($id);
        $response = array('status' => 'edit', 'data' => $product);
        echo json_encode($response);
        exit();
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
        $response = array('status' => 'success');
        echo json_encode($response);
        exit();
        flash('success', 'Product successfully deleted!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function status($id, $status)
    {
        $newStatus = ($status == 0) ? 1 : 0;
        $data = ['status' => $newStatus];
        $this->product->update($id, $data);

        $newData = "
        ";

        if ($newStatus == 0) {
            $newData .= "
                    <a href='javascript:;' class='badge btn-danger' onclick=\"statusChange('" . url('product&action=status&id=' . $id . '&status=' . $newStatus) . "', " . $id . ")\" data-id=\"" . $id . "\">in Active</a>";
        } else {
            $newData .= "
                    <a href='javascript:;' class='badge btn-success' onclick=\"statusChange('" . url('product&action=status&id=' . $id . '&status=' . $newStatus) . "', " . $id . ")\" data-id=\"" . $id . "\">Active</a>";
        }

        $newData .= "
            ";

        $response = array('status' => $newData, 'change' => $newStatus);
        echo json_encode($response);
        exit();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    // $products = $productController->getProductsByConditions(['name' => 'Laptop']);
    // print_r($products);
}
