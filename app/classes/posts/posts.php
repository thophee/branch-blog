<?php
session_start();
include_once "admin-post-controller.class.php";
include_once __DIR__ .  "/../topics/admin-topic-controller.class.php";
include_once __DIR__ . '/../connection.class.php';
include_once __DIR__ . '/../../include/image.php';

class AdminPostsView {
    private $adminPostController;

    private $posts = null;
    public function getPosts() {
        if(empty($this->posts)) {
            $this->posts = AdminPostController::getAdminPosts();
        }
        return $this->posts;
    }
    private $topics = null;
    public function getTopics() {
        if(empty($this->topics)) {
            $this->topics = AdminTopicController::getTopics();
        }
        return $this->topics;
    }
    public $post;
    public $title;
    public $content;

    public function __construct() {
        $this->adminPostController = new AdminPostController();
        $this->initialize();
    }
    public function initialize() {
        if(isset($_POST['create_post'])) {
            $this->title = $_POST['title'];
            $this->content = $_POST['content'];
            $image = $_POST['img'];
            $topic = $_POST['topic'];
            $published = $_POST['publish'];
            $userID = $_SESSION['user_id'];
            $trending = $_POST['trending'] != null ? 1 : 0;

            $this->adminPostController->add( $this->title, $this->content, $image, $topic, $userID, $trending, $published);
        }

        if  (isset($_GET['edit_id'])) {
            $this->post = $this->adminPostController->getPostByID($_GET['edit_id']);
        }
        if(isset($_POST['edit_post'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_POST['img'];
            $topic = $_POST['topic'];
            $published = $_POST['publish'] != null ? 1 : 0;
            $trending = $_POST['trending'] != null ? 1: 0;

            $this->adminPostController->edit($title, $content, $topic, $published, $trending, $image, $id);
        }
        if (isset($_GET['delete_id'])) {
            $this->adminPostController->delete($_GET['delete_id']);
            header("Location: index.php");
        }

        if (isset($_GET['pub_id'])) {
            $this->adminPostController->hide($_GET['pub_id'], $_GET['published']);
            header("Location: index.php");
        }
    }


}
