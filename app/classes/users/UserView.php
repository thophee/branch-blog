<?php
namespace App;
session_start();
class UserView {
    public $userController;
    public function __construct() {
        $this->userController = new UserController();
        $this->initialize();
    }
    private function initialize() {
        if(UserController::isLoggedIn()) {
            header('Location: /');
        }
        if(isset($_POST['sign_in'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $this->userController->signIn($login, $password);
        }
        if(isset($_POST['sign_up'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $passwordRepeat = $_POST['repeat-password'];
            $this->userController->signUp($login, $password, $passwordRepeat);
        }
    }
}
