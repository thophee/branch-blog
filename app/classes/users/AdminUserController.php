<?php
namespace App;
use PDO;

class AdminUserController {
    public function addValidation($login, $password, $passwordRepeat) {
        if(empty($login) || empty($password) || empty($passwordRepeat)) {
            ErrorHandler::add('empty_fields');
            return false;
        }
        $isValid = true;
        if($password !== $passwordRepeat && $passwordRepeat !== null) {
            ErrorHandler::add('password_not_match');
            $isValid = false;
        }
        if($this->userExists($login)) {
            ErrorHandler::add('user_exists');
            return false;
        }
        return $isValid;
    }
    public function editValidation($login) {
        if (strlen($login) < 3) {
            ErrorHandler::add('short_username');
            return false;
        }
        return true;
    }
    public function userExists($login) {
        $stmt = Connection::getInstance()->prepare('SELECT login FROM user WHERE login = ?;');
        $stmt->execute(array($login));
        return $stmt->rowCount() > 0;
    }
    public function  getUsers() {
        $result = [];
        $stmt = Connection::getInstance()->prepare('SELECT * FROM user;');
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                array_push($result, User::getByRow($row));
            }
        }
        return $result;
    }
    public function getUserByID($id) {
        $stmt = Connection::getInstance()->prepare("SELECT * FROM user WHERE id=?");
        $stmt->execute(array($id));
        return User::getByRow($stmt->fetch(PDO::FETCH_ASSOC));
    }
    public function add($login, $password, $passwordRepeat, $admin) {
        if(!self::addValidation($login, $password, $passwordRepeat)) {
            return;
        }
        $stmt = Connection::getInstance()->prepare('INSERT INTO user (login, password, admin) VALUES (?,?,?);');
        $hashedPwd = md5(md5($password));
        $stmt->execute(array($login, $hashedPwd, $admin));
        header("Location: /users");
    }
    public function edit($id, $login, $password, $passwordRepeat, $admin) {
        if(!self::editValidation($login)) {
            return;
        }
        $user = $this->getUserByID($id);
        $queryText = 'UPDATE user SET ';
        $queryParams = [];
        if($login !== $user->login) {
            $queryText.='login =?';
            array_push($queryParams, $login);
        }
        $hashPassword = md5(md5($password));
        if(!empty($password) && $password === $passwordRepeat && $hashPassword !== $user->hashPassword) {
            if(count($queryParams)) {
                $queryText.=', ';
            }
            $queryText.='password=?';
            array_push($queryParams, $hashPassword);
        }
        if($admin !== $user->admin) {
            if(count($queryParams)) {
                $queryText.=', ';
            }
            $queryText.='admin=?';
            array_push($queryParams, $admin);
        }
        if (count($queryParams)) {
            $queryText.=' WHERE id=?';
            array_push($queryParams, $id);
            $stmt = Connection::getInstance()->prepare($queryText);
           $stmt->execute($queryParams);
        }
        header('Location: /users');
    }
    public function deleteUser($id) {
        $stmt = Connection::getInstance()->prepare("DELETE FROM user WHERE id=?");
        $stmt->execute(array($id));
    }

}