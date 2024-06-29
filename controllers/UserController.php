<?php
require_once 'classes/Auth.php';
require_once 'models/User.php';

class UserController
{
    protected $userModel;
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
    }

    public function index()
    {
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
        require 'views/users/create.php';
    }

    public function store($name, $email, $password)
    {
        $this->userModel->createUser($name, $email, $password);
        require 'views/users/create.php';
    }

    public function edit($id)
    {
        $user = $this->userModel->getUserById($id);
        require 'views/users/edit.php';
    }

    public function update($id, $name, $email)
    {
        $this->userModel->updateUser($id, $name, $email);
        header('Location: index');
    }

    public function destroy($id)
    {
        $this->userModel->deleteUser($id);
        header('Location: index');
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
        Auth::logout();
        require_once "views/auth/login.php";
        exit();
    }
}
