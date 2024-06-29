<?php
class Auth {
    public static function user() {
        global $pdo;
        if (isset($_SESSION['user_id'])) {
            return new User($pdo, $_SESSION['user_id']);
        }
        return null;
    }

    public static function login($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->name;
        session_regenerate_id(true);
    }

    public static function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        session_regenerate_id(true);
    }
}
?>
