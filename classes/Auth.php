<?php
class Auth {
    public static function user() {
        if (isset($_SESSION['user_id'])) {
            return User::auth($_SESSION['user_id']);
        }
        return null;
    }

    public static function login($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->name;
    }

    public static function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
    }
}
?>
