<?php
namespace App;
session_start();


class AdminTopicsView {
    public RouteParameters $parameters;

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

    public function __construct(RouteParameters $parameters) {
        $this->parameters = $parameters;
        $this->adminTopicController = new AdminTopicController();
        $this->initialize();
    }

    public function initialize() {
        if (isset($_POST['create_topic'])) {
            $this->name = $_POST['name'];
            $this->adminTopicController->add($this->name);
        }

        if (isset($this->parameters->Uri[0])) {
            $this->topic = $this->adminTopicController->getTopicByID($this->parameters->Uri[0]);
        }
        if (isset($_POST['edit_topic'])) {
            $this->adminTopicController->edit($_POST['id'], $_POST['name']);
        }
        if ($this->parameters->Uri[1] == 'delete') {
            $this->adminTopicController->delete($this->parameters->Uri[0]);
            header("Location: /topics");
        }

    }
}

