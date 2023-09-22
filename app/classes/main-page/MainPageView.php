<?php
namespace App;
session_start();
class MainPageView {

    public RouteParameters $parameters;

    public $mainPageController;
    public $paginationController;
    public $topic;

    public function __construct(RouteParameters $parameters) {
        $this->parameters = $parameters;
        $this->mainPageController = new MainPageController();
        $this->paginationController = new PaginationController();

    }

    public function getTrendingPosts() {
        return $this->mainPageController->getTrendingPosts();;
    }
    public function getPaginatedPosts() {
        if(isset($_GET['page_num'])) {
            $offset = $_GET['page_num'] - 1;
            $this->paginationController->start = $offset * PaginationController::$rowsPerPage;
        }
        return $this->paginationController->getPosts();;
    }
    public function getPostsByCategory() {
        if(isset($this->parameters->Uri[0])) {
            return $this->mainPageController->getPostsByCategory($this->parameters->Uri[0]);
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


}



