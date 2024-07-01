<?php
class DatabaseManager {
    private $pdo;
    private $table;

    public function __construct(PDO $pdo, $table) {
        $this->pdo = $pdo;
        $this->table = $table;
    }

    public function create($data) {
        try {
            $fields = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_fill(0, count($data), '?'));
            $stmt = $this->pdo->prepare("INSERT INTO $this->table ($fields) VALUES ($placeholders)");
            return $stmt->execute(array_values($data));
        } catch (PDOException $e) {
            return false;
        }
    }

    public function findById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return null;
        }
    }

    public function lastInsertedId() {
        try {
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function findByConditions($conditions = []) {
        try {
            $sql = "SELECT * FROM $this->table";
            $params = [];

            if (!empty($conditions)) {
                $sql .= " WHERE ";

                foreach ($conditions as $key => $value) {
                    $sql .= "$key = ? AND ";
                    $params[] = $value;
                }

                $sql = rtrim($sql, " AND ");
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function findAll() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM $this->table");
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function update($id, $data) {
        try {
            $fields = '';
            $params = [];

            foreach ($data as $key => $value) {
                $fields .= "$key = ?, ";
                $params[] = $value;
            }

            $fields = rtrim($fields, ', ');
            $params[] = $id;

            $stmt = $this->pdo->prepare("UPDATE $this->table SET $fields WHERE id = ?");
            return $stmt->execute($params);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function count() {
        try {
            $stmt = $this->pdo->query("SELECT COUNT(*) as count FROM $this->table");
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return 0; 
        }
    }
    
}
