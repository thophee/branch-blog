<?php
namespace App;
session_start();
class AdminUsersView {
    public RouteParameters $parameters;
    private $adminUserController;

    public $users;
    public function getUsers() {
        if(empty($this->users)) {
            $this->users = $this->adminUserController->getUsers();
        }
        return $this->users;
    }
    public $user;
    public function __construct(RouteParameters $parameters) {
        $this->parameters = $parameters;
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

        if  (isset($this->parameters->Uri[0])) {
            $this->user = $this->adminUserController->getUserByID($this->parameters->Uri[0]);
        }
        if(isset($_POST['edit_user'])) {
            $id = $_POST['id'];
            $login = $_POST['login'];
            $password = $_POST['password'];
            $passwordRepeat = $_POST['password_confirmation'];
            $admin = isset($_POST['admin']) ? 1 : 0;

            $this->adminUserController->edit($id, $login, $password, $passwordRepeat, $admin);

            header('Location: /users');
        }
        if ($this->parameters->Uri[1] == 'delete') {
            $id = $this->parameters->Uri[0];
            $this->adminUserController->deleteUser($id);
            header("Location: /users");
        }
    }
}
