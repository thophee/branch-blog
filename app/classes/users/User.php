<?php
namespace App;
use PDO;

class User {
    public int $id;
    public string $login;
    public string $hashPassword;
    public bool $admin;

    public static function getByRow($row) {
        if(!$row) {
            return null;
        }
        $user = new User();
        $user->id = $row['id'];
        $user->admin = $row['admin'];
        $user->login = $row['login'];
        $user->hashPassword = $row['password'];
        return $user;
    }
    public static function getByLogin($login) {
        if(empty($login)) {
            return null;
        }
        $stmt = Connection::getInstance()->prepare('SELECT * FROM user WHERE login=?');
        $stmt->execute(array($login));
        return User::getByRow($stmt->fetch(PDO::FETCH_ASSOC));
    }
}
