<?php
session_start();
include_once __DIR__ . '/../connection.class.php';
include_once 'single-post-controller.class.php';

class SinglePageView {
    public $singlePostController;
    public $id;
    public function getPost() {
        return $this->singlePostController->getPostByID($this->id);
    }
    public function __construct() {
        $this->singlePostController = new SinglePostController();
        $this->initialize();
    }
    private function initialize() {
        $this->id = $_GET['id'];
    }
}



