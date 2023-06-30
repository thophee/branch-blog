<?php

session_start();
include_once "user-controller.class.php";
include_once "admin-user-controller.class.php";
include_once __DIR__ . '/../connection.class.php';

class AdminUsersView {
    private $adminUserController;

    public $users;
    public function getUsers() {
        if(empty($this->users)) {
            $this->users = $this->adminUserController->getUsers();
        }
        return $this->users;
    }
    public $user;
    public function __construct() {
        $this->adminUserController = new AdminUserController();
        $this->initialize();
    }
    public function initialize() {
        if(isset($_POST['create_user'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $passwordRepeat = $_POST['password_confirmation'];
            $admin = $_POST['admin'] != null ? 1 : 0;
            $this->adminUserController->add($login, $password, $passwordRepeat, $admin);
        }

        if  (isset($_GET['edit_id'])) {
            $this->user = $this->adminUserController->getUserByID($_GET['edit_id']);
        }
        if(isset($_POST['edit_user'])) {
            $id = $_POST['id'];
            $login = $_POST['login'];
            $password = $_POST['password'];
            $passwordRepeat = $_POST['password_confirmation'];
            $admin = isset($_POST['admin']) ? 1 : 0;

            $this->adminUserController->edit($id, $login, $password, $passwordRepeat, $admin);

            header('Location: index.php');
        }
        if (isset($_GET['delete_id'])) {
            $id = $_GET['delete_id'];
            $this->adminUserController->deleteUser($id);
            header("Location: index.php");
        }
    }
}
