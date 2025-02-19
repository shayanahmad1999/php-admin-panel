<?php

class User {
    private $pdo;
    private $user;

    public $id;
    public $name;
    public $email;

    public function __construct($pdo, $userId) {
        $this->pdo = $pdo;
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $this->user = $stmt->fetch(PDO::FETCH_OBJ);

        if ($this->user) {
            $this->id = $this->user->id;
            $this->name = $this->user->name;
            $this->email = $this->user->email;
        }
    }

    public function name() {
        return $this->user->name;
    }

    public function id() {
        return $this->user->id;
    }


    public function getAllUsers() {
        $stmt = $this->pdo->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createUser($name, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO users (name, email, password, opassword) VALUES (:name, :email, :password, :opassword)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':opassword', $password);
        return $stmt->execute();
    }

    public function updateUser($id, $name, $email) {
        $stmt = $this->pdo->prepare('UPDATE users SET name = ?, email = ? WHERE id = ?');
        return $stmt->execute([$name, $email, $id]);
    }

    public function deleteUser($id) {
        $loggedInUserId = Auth::user()->id;
        if($loggedInUserId == $id) {
            $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = ?');
            $result = $stmt->execute([$id]);
            if($stmt->rowCount()){
                Auth::logout();
                redirect('index?page=user&action=userloginView');
            }
        } else {
            $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = ?');
            return $stmt->execute([$id]);
        }
    }

    public function countUsers() {
        $stmt = $this->pdo->query('SELECT COUNT(*) as total_users FROM users');
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function loginAction($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
}

?>
