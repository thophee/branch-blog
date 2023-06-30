<?php
session_start();
include_once "user-post-controller.class.php";
include_once __DIR__ .  "/../classes/topics/admin-topic-controller.class.php";
include_once __DIR__ .  "/../classes/posts/admin-posts-controller.class.php";
include_once __DIR__ . '/../classes/connection.class.php';
include_once __DIR__ . '/../include/image.php';

class UserPostView {
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

    public function __construct() {
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

        if  (isset($_GET['edit_id'])) {
            $this->post = AdminPostController::getPostByID($_GET['edit_id']);
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
        if (isset($_GET['delete_id'])) {
            $this->userPostController->delete($_GET['delete_id']);
        }
    }
}
