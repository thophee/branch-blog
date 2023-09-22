<?php
namespace App;
session_start();
include_once __DIR__ . '/../include/image.php';

class UserPostView {
    public RouteParameters $parameters;
    private $userPostController;
    public $userID;

    public function getPosts() {
            return $this->userPostController->getPostsByUserID($this->userID);
    }
    public function getTopics() {
        return  AdminTopicController::getTopics();
    }
    public $post;
    public $title;
    public $content;

    public function __construct(RouteParameters $parameters) {
        $this->parameters = $parameters;
        $this->userPostController = new UserPostController();
        $this->initialize();
    }
    public function initialize() {
        $this->userID = $_SESSION['user_id'];
        if(isset($_POST['create_user_post'])) {
            $this->title = $_POST['title'];
            $this->content = $_POST['content'];
            $image = $_POST['img'];
            $topic = $_POST['topic'];
            $published = $_POST['publish'];
            $userID = $_SESSION['user_id'];
            $trending = $_POST['trending'] != null ? 1 : 0;
            $this->userPostController->add( $this->title, $this->content, $image, $topic, $userID, $trending, $published);
        }

        if  (isset($this->parameters->Uri[0])) {
            $this->post = AdminPostController::getPostByID($this->parameters->Uri[0]);
        }
        if(isset($_POST['edit_user_post'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_POST['img'];
            $topic = $_POST['topic'];
            $published = $_POST['publish'] != null ? 1 : 0;
            $trending = $_POST['trending'] != null ? 1: 0;

            $this->userPostController->edit($title, $content, $topic, $image, $id);
        }
        if ($this->parameters->Uri[1] == 'delete') {
            $this->userPostController->delete($this->parameters->Uri[0]);
        }
    }
}
