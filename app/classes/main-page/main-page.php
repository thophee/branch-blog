<?php
session_start();
include_once __DIR__ .  '/../topics/admin-topic-controller.class.php';
include_once __DIR__ .  '/../main-page/main-page-controller.class.php';
include_once __DIR__ .  '/../pagination/pagination-controller.class.php';

class MainPageView {
    public $mainPageController;
    public $paginationController;
    public $topic;

    public function getTrendingPosts() {
        return $this->mainPageController->getTrendingPosts();;
    }
    public function getPaginatedPosts() {
        if(isset($_GET['page_num'])) {
            $offset = $_GET['page_num'] - 1;
            $this->paginationController->start = $offset * Pagination::$rowsPerPage;
        }
        return $this->paginationController->getPosts();;
    }
    public function getPostsByCategory() {
        if(isset($_GET['id'])) {
            return $this->mainPageController->getPostsByCategory($_GET['id']);
        }
    }
    public function getTopics() {
            return AdminTopicController::getTopics();;
    }
    public function getTopicByID(){
        if(isset($_GET['id'])) {
            return AdminTopicController::getTopicByID($_GET['id']);
        }
    }

    public function __construct() {
        $this->mainPageController = new MainPageController();
        $this->paginationController = new Pagination();
    }
}



