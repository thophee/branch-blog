<?php
namespace App;
class UserController {
    public function signInValidation($login, $password) {
        if(empty($login) || empty($password)) {
            ErrorHandler::add('empty_fields');
            return false;
        }
        return true;
    }
    public function signInDBValidation($user, $password) {
        if(empty($user)) {
            ErrorHandler::add('user_not_found');
            return false;
        }
        if(md5(md5($password)) != $user->hashPassword) {
            ErrorHandler::add('wrong_password');
            return false;
        }
        return true;
    }
    public function signUpValidation($login, $password, $passwordRepeat) {
        if(empty($login) || empty($password) || empty($passwordRepeat)) {
            ErrorHandler::add('empty_fields');
            return false;
        }
        $isValid = true;
        if($password !== $passwordRepeat && $passwordRepeat !== null) {
            ErrorHandler::add('password_not_match');
            $isValid = false;
        }
        if (strlen($login) < 3) {
            ErrorHandler::add('short_username');
            return false;
        }
        if(preg_match("/^[a-zA-Z0-9]$/", $login)) {
            ErrorHandler::add('restricted_chars');
            return false;
        }
        if($this->userExists($login)) {
            ErrorHandler::add('user_exists');
            return false;
        }
        return $isValid;
    }
    public static function isLoggedIn() {
        if($_SESSION['isLoggedIn']){
            return true;
        } else {
            return false;
        }
    }
    public function signUp($login, $password, $passwordRepeat) {
         if(!self::signUpValidation($login, $password, $passwordRepeat)) {
            return;
        }
        $this->addDBUser($login, $password);
         header('Location: login.php');
    }

    public function userExists($login) {
        $stmt = Connection::getInstance()->prepare('SELECT login FROM user WHERE login = ?;');
        $stmt->execute(array($login));
        return $stmt->rowCount() > 0;
    }

    public function addDBUser($login, $password) {
        $stmt = Connection::getInstance()->prepare('INSERT INTO user (login, password) VALUES (?,?);');
        $hashedPwd = md5(md5($password));
        $stmt->execute(array($login, $hashedPwd));
    }
    public function signIn($login, $password) {
        if(!self::signInValidation($login, $password)) {
            return;
        }
        $user = User::getByLogin($login);
        if(!self::signInDBValidation($user, $password)) {
            return;
        }
        session_start();
        $_SESSION['popup'] = 1;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_login'] = $user->login;
        $_SESSION['admin'] = $user->admin;
        $_SESSION['isLoggedIn'] = true;
        setcookie("login", $user->login, time()+60*60*24*30, "/");
        header("Location: /");
    }
}



