<?php
session_start();
include_once "admin-topic-controller.class.php";
include_once __DIR__ . '/../connection.class.php';

class AdminTopicsView {

    private $adminTopicController;

    private $topics = null;

    public function getTopics()
    {
        if (empty($this->topics)) {
            $this->topics = AdminTopicController::getTopics();
        }
        return $this->topics;
    }

    public $topic;
    public $name;

    public function __construct()
    {
        $this->adminTopicController = new AdminTopicController();
        $this->initialize();
    }

    public function initialize() {
        if (isset($_POST['create_topic'])) {
            $this->name = $_POST['name'];
            $this->adminTopicController->add($this->name);
        }

        if (isset($_GET['id'])) {
            $this->topic = $this->adminTopicController->getTopicByID($_GET['id']);
        }
        if (isset($_POST['edit_topic'])) {
            $this->adminTopicController->edit($_POST['id'], $_POST['name']);
        }
        if (isset($_GET['delete_id'])) {
            $this->adminTopicController->delete($_GET['delete_id']);
            header("Location: index.php");
        }

    }
}

