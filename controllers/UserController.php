<?php
require_once 'classes/Auth.php';
require_once 'models/User.php';
require_once "controllers/Controller.php";
require_once "classes/Validator.php";

class UserController extends Controller
{
    protected $userModel;
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo, $this->getCurrentUserId());
        // $this->userModel = new User($pdo);
    }

    private function getCurrentUserId() {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    public function index()
    {
        $this->requireAuthentication();
        $users = $this->userModel->getAllUsers();
        require 'views/users/index.php';
    }

    public function show($id)
    {
        $user = $this->userModel->getUserById($id);
        require 'views/users/show.php';
    }

    public function create()
    {
        $this->requireAuthentication();
        require 'views/users/create.php';
    }

    public function store($name, $email, $password)
    {
        $validator = new Validator($_POST);
        $validator->rules([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            flash('name', $errors);
            flash('email', $errors);
            flash('password', $errors);
            redirect('index?page=user&action=create');
            return;
        }
        $this->userModel->createUser($name, $email, $password);
        flash('success', 'User successfully created!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function edit($id)
    {
        $this->requireAuthentication();
        $user = $this->userModel->getUserById($id);
        require 'views/users/edit.php';
    }

    public function update($id, $name, $email)
    {
        $validator = new Validator($_POST);
        $validator->rules([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            flash('name', $errors);
            flash('email', $errors);
            flash('password', $errors);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }
        $this->userModel->updateUser($id, $name, $email);
        flash('success', 'User successfully updated!');
        redirect('index?page=user');
    }

    public function destroy($id)
    {
        $this->requireAuthentication();
        $this->userModel->deleteUser($id);
        flash('success', 'User successfully deleted!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function userloginView()
    {
        require 'views/auth/login.php';
    }

    public function userlogin($email, $password)
    {
        $user = $this->userModel->loginAction($email, $password);
        if ($user) {
            Auth::login($user);
            header('Location: index?page=dashboard');
            exit();
        } else {
            
            $existingUser = $this->userModel->getUserByEmail($email); 

            if ($existingUser) {
                $_SESSION['error'] = 'Incorrect password.';
            } else {
                $_SESSION['error'] = 'Email not found.';
            }

            require_once "views/auth/login.php";
        }
    }
    public function userlogout()
    {
        $this->requireAuthentication();
        Auth::logout();
        redirect('index?page=user&action=userloginView');
        exit();
    }
}
